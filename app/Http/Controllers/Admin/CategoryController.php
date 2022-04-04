<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    protected $categoryRepo;
    protected $songRepo;

    public function __construct(
        CategoryRepositoryInterface $categoryRepo,
        SongRepositoryInterface $songRepo
    ) {
        $this->categoryRepo = $categoryRepo;
        $this->songRepo = $songRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepo
            ->getAllWithPaginate(config('admin.paginate.category'));

        return view('admin.categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $request->flash();
        $category = $this->categoryRepo
            ->create($request->only(['name', 'description']));

        return redirect()->route('admin.categories.index')
            ->with('success', __('create_category_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category = $this->categoryRepo->find($id);
            $currentSongsInCategory = $category->songs->pluck('id')->toArray();
            $songs = $this->songRepo->whereNotIn('id', $currentSongsInCategory);
        } catch (Exception $e) {
            return redirect()->route('admin.categories.index')->with('error', __('no_data'));
        }

        return view('admin.categories.show', compact('category', 'songs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = $this->categoryRepo->find($id);
        } catch (Exception $e) {
            return redirect()->route('admin.categories.index')->with('error', __('no_data'));
        }

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        try {
            $category = $this->categoryRepo
                ->update($id, $request->only(['name', 'description']));
        } catch (Exception $e) {
            return redirect()->route('admin.categories.index')->with('error', __('no_data'));
        }

        return redirect()
            ->route('admin.categories.show', ['category' => $category->id])
            ->with('success', __('update_category_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $this->categoryRepo->deleteSongsOfCategory($id);
            $this->categoryRepo->delete($id);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.categories.index')
                ->with('error', __('have_error'));
        }

        return redirect()->route('admin.categories.index')
            ->with('success', __('delete_category_success'));
    }

    public function addSongToCategory(Request $request)
    {
        $category = $request->input('category_id');
        $songs = $request->only('song_id');
        try {
            DB::beginTransaction();

            foreach ($songs as $song) {
                $this->categoryRepo->addSongToCategory((int)$category, $song);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', __('have_error'));
        }

        return redirect()->back()->with('success', __('add_song_success'));
    }

    public function removeFromCategory(Request $request)
    {
        try {
            DB::beginTransaction();

            $category = $request->input('category_id');
            $songs = $request->only('song_id');
            $this->categoryRepo->removeSongFromCategory((int) $category, $songs);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', __('have_error'));
        }

        return redirect()->back()->with('success', __('delete_success'));
    }
}
