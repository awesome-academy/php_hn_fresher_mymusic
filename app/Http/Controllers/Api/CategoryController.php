<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryStoreRequest;
use App\Http\Requests\Api\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use DB;

class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
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

        return response()->json([
            'categories' => CategoryResource::collection($categories),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $data = $request->only(['name', 'description']);
        $category = $this->categoryRepo->create($data);

        return response()->json([
            'message' => __('create_success'),
            'category' => new CategoryResource($category),
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
        $category = $this->categoryRepo->find($id);

        return response()->json([
            'category' => new CategoryResource($category),
        ], 200);
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
        $data = $request->only(['name', 'description']);
        $category = $this->categoryRepo->update($id, $data);

        return response()->json([
            'message' => __('update_success'),
            'category' => new CategoryResource($category),
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

            $this->categoryRepo->deleteSongsOfCategory($id);
            $this->categoryRepo->delete($id);

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
