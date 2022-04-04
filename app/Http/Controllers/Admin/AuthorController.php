<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthorStoreRequest;
use App\Http\Requests\Admin\AuthorUpdateRequest;
use App\Imports\AuthorImport;
use App\Repositories\Admin\Author\AuthorRepoInterface;
use DB;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AuthorController extends Controller
{
    protected $authorRepo;
    public function __construct(AuthorRepoInterface $authorRepo)
    {
        $this->authorRepo = $authorRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = $this->authorRepo->getAllWithPaginate(config('admin.paginate.author'));

        return view('admin.author.list', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorStoreRequest $request)
    {
        try {
            $data = $request->except('_token');
            $thumbnail = $request->file('thumbnail');
            $path = $this->authorRepo->storeAsImageAuthor($thumbnail);
            $data['thumbnail'] = $path;
            $rs = $this->authorRepo->create($data);
        } catch (Exception $e) {
            return $this->redirect();
        }

        return $this->redirect($rs, __('create_success'));
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
            $author = $this->authorRepo->getAuthorWithSongAndAlbum($id);
        } catch (Exception $e) {
            return redirect()->route('admin.authors.index')->with('error', __('no_data'));
        }

        return view('admin.author.view', compact('author'));
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
            $author = $this->authorRepo->find($id);
        } catch (Exception $e) {
            return redirect()->route('admin.authors.index')->with('error', __('no_data'));
        }

        return view('admin.author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorUpdateRequest $request, $id)
    {
        try {
            $data = $request->except('_token');
            $thumbnail = $request->file('thumbnail');
            if (!$thumbnail) {
                $data['thumbnail'] = $this->authorRepo->find($id)->thumbnail;
            } else {
                $path = $this->authorRepo->storeAsImageAuthor($thumbnail);
                $data['thumbnail'] = $path;
            }
            $rs = $this->authorRepo->update($id, $data);
        } catch (Exception $e) {
            return $this->redirect();
        }

        return $this->redirect($rs, __('update_success'));
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

            $this->authorRepo->deleteSongOfAuthor($id);
            $this->authorRepo->deleteALbumsOfAuthor($id);
            $this->authorRepo->delete($id);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with('error', __('have_error'));
        }

        return back()->with('success', __('delete_success'));
    }

    public function importExcel(Request $request)
    {
        $file = $request->only('author_file');
        $rs = Excel::import(new AuthorImport($this->authorRepo), $file);

        return back()->with('success', __('create_success'));
    }

    public function redirect($rs = null, $mess = '')
    {
        if ($rs) {
            return back()->with('success', $mess);
        }

        return back()->with('error', __('have_error'));
    }
}
