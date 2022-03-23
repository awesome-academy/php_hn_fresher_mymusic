<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlbumOfAuthorRequest;
use App\Http\Requests\Admin\AlbumStoreRequest;
use App\Http\Requests\Admin\AlbumUpdateRequest;
use App\Repositories\Admin\Album\AlbumRepoInterface;
use App\Repositories\Admin\Author\AuthorRepoInterface;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use DB;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    protected $albumRepo;
    protected $authorRepo;
    protected $songRepo;

    public function __construct(
        AlbumRepoInterface $albumRepo,
        AuthorRepoInterface $authorRepo,
        SongRepositoryInterface $songRepo
    ) {
        $this->albumRepo = $albumRepo;
        $this->authorRepo = $authorRepo;
        $this->songRepo = $songRepo;
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
        $album = $this->albumRepo->find($id);

        $author = $this->authorRepo->getAuthorWithSongAndAlbum($album->author_id);

        return view('admin.album.view', compact('album', 'author'));
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

    public function getAlbumsOfAuthors(AlbumOfAuthorRequest $request)
    {
        $data = json_decode($request->query('author_id'));

        $albums = $this->albumRepo
            ->getRecordByWhereIn('author_id', $data);

        return response()->json(compact('albums'));
    }

    public function addSongToAlbum(Request $request)
    {
        $album = $request->only('album_id');
        $songIds = $request->input('song_id');
        try {
            DB::beginTransaction();

            foreach ($songIds as $item) {
                $this->songRepo->update((int) $item, $album);
            }

            DB::commit();

            return back()->with('success', __('create_success'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('error', __('have_error'));
        }
    }

    public function removeSongFromAlbum(Request $request)
    {
        $albums = ["album_id" => null];
        $songId = $request->input('song_id');
        $rs = $this->songRepo->update((int) $songId, $albums);

        return redirect()->back()->with('success', __('delete_success'));
    }

    public function redirect($rs, $mess)
    {
        if ($rs) {
            return back()->with('success', $mess);
        }

        return back()->with('error', __('have_error'));
    }
}
