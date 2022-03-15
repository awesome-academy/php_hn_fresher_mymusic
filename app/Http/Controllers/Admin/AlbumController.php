<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlbumStoreRequest;
use App\Http\Requests\Admin\AlbumUpdateRequest;
use App\Repositories\Admin\Album\AlbumRepoInterface;
use App\Repositories\Admin\Author\AuthorRepoInterface;
use DB;

class AlbumController extends Controller
{
    protected $albumRepo;
    protected $authorRepo;

    public function __construct(AlbumRepoInterface $albumRepo, AuthorRepoInterface $authorRepo)
    {
        $this->albumRepo = $albumRepo;
        $this->authorRepo = $authorRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = $this->albumRepo
            ->getAllWithRelationPaginate(config('admin.paginate.album'), ['author']);

        return view('admin.album.list', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = $this->authorRepo->getAll();

        return view('admin.album.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumStoreRequest $request)
    {
        $data = $request->except('_token');
        $rs = $this->albumRepo->create($data);

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
        $album = $this->albumRepo->getAlbumWithSong($id);

        return view('admin.album.view', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authors = $this->authorRepo->getAll();
        $album = $this->albumRepo->find($id);

        return view('admin.album.edit', compact('authors', 'album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumUpdateRequest $request, $id)
    {
        $data = $request->except('_token');
        $rs = $this->albumRepo->update($id, $data);

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

            $this->albumRepo->deleteSongOfAlbum($id);
            $this->albumRepo->delete($id);

            DB::commit();

            return back()->with('success', __('delete_success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', __('have_error'));
        }
    }

    public function redirect($rs, $mess)
    {
        if ($rs) {
            return back()->with('success', $mess);
        }

        return back()->with('error', __('have_error'));
    }
}
