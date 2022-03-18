<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SongStoreRequest;
use App\Http\Requests\Admin\SongUpdateRequest;
use App\Repositories\Admin\Album\AlbumRepoInterface;
use App\Repositories\Admin\Author\AuthorRepoInterface;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    protected $authorRepo;

    protected $albumRepo;

    protected $songRepo;

    public function __construct(
        AuthorRepoInterface $authorRepo,
        AlbumRepoInterface $albumRepo,
        SongRepositoryInterface $songRepo
    ) {
        $this->authorRepo = $authorRepo;
        $this->albumRepo = $albumRepo;
        $this->songRepo = $songRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = $this->songRepo
            ->getAllWithRelationPaginate(config('admin.paginate.song'), [
                'authors',
                'album',
            ]);

        return view('admin.songs.list', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = $this->authorRepo->getAll();

        return view('admin.songs.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SongStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $thumbnail = Helpers::storeSongThumbnail($request->file('thumbnail'));
            $song = Helpers::storeSong($request->file('song'));
            $data = array_merge(
                $request->only([
                    'name',
                    'description',
                    'album_id',
                    'durations',
                ]),
                [
                    'thumbnail' => $thumbnail,
                    'path' => $song,
                ]
            );

            $song = $this->songRepo
                ->createNewSong($data, $request->input('author_id') ?? []);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            abort(500);
        }

        return redirect()->back()->with('success', __('create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $song = $this->songRepo->find($id);

        return view('admin.songs.show', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $song = $this->songRepo->find($id);
        $authors = $this->authorRepo->getAll();

        return view('admin.songs.edit', compact('song', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SongUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->only([
                'name',
                'description',
                'album_id',
                'durations',
            ]);

            $thumbnail = $request->file('thumbnail')
                ? Helpers::storeSongThumbnail($request->file('thumbnail'))
                : null;

            $song = $request->file('song')
                ? Helpers::storeSong($request->file('song'))
                : null;

            if ($thumbnail) {
                $data = array_merge($data, [
                    'thumbnail' => $thumbnail,
                ]);
            }

            if ($song) {
                $data = array_merge($data, [
                    'path' => $song,
                ]);
            }

            $song = $this->songRepo
                ->updateSong($id, $data, $request->input('author_id') ?? []);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            abort(500);
        }

        return redirect()->back()->with('success', __('update_success'));
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

            $this->songRepo->deleteSong($id);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(500);
        }

        return redirect()->back()->with('success', __('delete_success'));
    }
}
