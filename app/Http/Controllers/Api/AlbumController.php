<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AlbumStoreRequest;
use App\Http\Requests\Api\AlbumUpdateRequest;
use App\Http\Resources\AlbumResource;
use App\Repositories\Admin\Album\AlbumRepoInterface;
use DB;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    protected $albumRepo;

    public function __construct(AlbumRepoInterface $albumRepo)
    {
        $this->albumRepo = $albumRepo;
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

        return response()->json([
            'albums' => AlbumResource::collection($albums),
        ], 200);
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
        $album = $this->albumRepo->create($data);

        return response()->json([
            'message' => __('create_success'),
            'album' => new AlbumResource($album),
        ], 200);
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

        return response()->json([
            'album' => new AlbumResource($album),
        ], 200);
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
        $album = $this->albumRepo->update($id, $data);

        return response()->json([
            'message' => __('update_success'),
            'album' => new AlbumResource($album),
        ], 200);
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
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => __('have_error'),
            ], 500);
        }

        return response()->json([
            'message' => __('delete_success'),
        ], 200);
    }
}
