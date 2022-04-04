<?php

namespace Tests\Unit\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Song;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Mockery as m;

class CategoryControllerTest extends TestCase
{
    protected $songs;
    protected $categories;
    protected $request;
    protected $categoryStoreRequest;
    protected $categoryUpdateRequest;
    protected $categoryRepo;
    protected $songRepo;
    protected $categoryController;

    public function setUp(): void
    {
        parent::setUp();
        $this->songs = Song::factory()->count(10)->make();
        $this->categories = Category::factory()->count(10)->make();
        $this->request = m::mock(Request::class);
        $this->categoryStoreRequest = m::mock(CategoryStoreRequest::class);
        $this->categoryUpdateRequest = m::mock(CategoryUpdateRequest::class);
        $this->categoryRepo = m::mock(CategoryRepositoryInterface::class)->makePartial();
        $this->songRepo = m::mock(SongRepositoryInterface::class)->makePartial();
        $this->categoryController = new CategoryController($this->categoryRepo, $this->songRepo);
    }

    public function tearDown(): void
    {
        unset($this->songs);
        unset($this->categories);
        unset($this->categoryStoreRequest);
        unset($this->categoryUpdateRequest);
        unset($this->categoryRepo);
        unset($this->songRepo);
        unset($this->categoryController);
        parent::tearDown();
    }

    public function testMethodIndex()
    {
        $this->categoryRepo->shouldReceive('getAllWithPaginate')
            ->andReturn($this->categories);

        $view = $this->categoryController->index();

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.categories.list', $view->getName());
        $this->assertArrayHasKey('categories', $view->getData());
    }

    public function testMethodCreate()
    {
        $view = $this->categoryController->create();

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.categories.create', $view->getName());
    }

    public function getRequestParams()
    {
        $category = $this->categories->first()->toArray();
        $requestParam = array_filter($category, function ($key) {
            return in_array($key, ['name', 'description']);
        }, ARRAY_FILTER_USE_KEY);

        return $requestParam;
    }

    public function testMethodStore()
    {
        $requestParams = $this->getRequestParams();

        $this->categoryStoreRequest->shouldReceive('flash');
        $this->categoryStoreRequest->shouldReceive('only')->andReturn($requestParams);
        $this->categoryRepo->shouldReceive('create')->andReturn($requestParams);

        $response = $this->categoryController->store($this->categoryStoreRequest);

        $this->assertEquals(route('admin.categories.index'), $response->headers->get('Location'));
        $this->assertArrayHasKey('success', session()->all());
    }

    public function testMethodShowSuccess()
    {
        $category = $this->categories->first();

        $this->categoryRepo->shouldReceive('find')->andReturn($category);
        $this->songRepo->shouldReceive('whereNotIn')->andReturn($this->songs);

        $view = $this->categoryController->show(1);

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.categories.show', $view->getName());
        $this->assertArrayHasKey('category', $view->getData());
        $this->assertArrayHasKey('songs', $view->getData());
    }

    public function testMethodShowNotFoundId()
    {
        $this->categoryRepo->shouldReceive('find')->andThrow(new Exception());

        $response = $this->categoryController->show(1);

        $this->assertArrayHasKey('error', session()->all());
        $this->assertEquals(route('admin.categories.index'), $response->headers->get('Location'));
    }

    public function testMethodEditSuccess()
    {
        $category = $this->categories->first();

        $this->categoryRepo->shouldReceive('find')->andReturn($category);

        $view = $this->categoryController->edit(1);

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.categories.edit', $view->getName());
        $this->assertArrayHasKey('category', $view->getData());
    }

    public function testMethodEditNotFoundId()
    {
        $this->categoryRepo->shouldReceive('find')->andThrow(new Exception());

        $response = $this->categoryController->edit(1);

        $this->assertArrayHasKey('error', session()->all());
        $this->assertEquals(route('admin.categories.index'), $response->headers->get('Location'));
    }

    public function testMethodUpdateSucess()
    {
        $requestParams = $this->getRequestParams();
        $updatedRecord = $this->categories->first();
        $updatedRecord->id = 1;

        $this->categoryUpdateRequest->shouldReceive('only')->andReturn($requestParams);
        $this->categoryRepo->shouldReceive('update')->andReturn($updatedRecord);

        $response = $this->categoryController->update($this->categoryUpdateRequest, 1);

        $this->assertArrayHasKey('success', session()->all());
        $this->assertEquals(
            route('admin.categories.show', ['category' => 1]),
            $response->headers->get('Location')
        );
    }

    public function testMethodUpdateNotfoundCategoryId()
    {
        $requestParams = $this->getRequestParams();

        $this->categoryUpdateRequest->shouldReceive('only')->andReturn($requestParams);
        $this->categoryRepo->shouldReceive('update')->andThrow(new Exception());

        $response = $this->categoryController->update($this->categoryUpdateRequest, 1);

        $this->assertArrayHasKey('error', session()->all());
        $this->assertEquals(route('admin.categories.index'), $response->headers->get('Location'));
    }

    public function testMethodDestroySuccess()
    {
        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();

        $this->categoryRepo->shouldReceive('deleteSongsOfCategory');
        $this->categoryRepo->shouldReceive('delete');

        DB::partialMock()->shouldReceive('commit')->andReturnTrue();

        $res = $this->categoryController->destroy(1);

        $this->assertEquals(route('admin.categories.index'), $res->headers->get('Location'));
        $this->assertArrayHasKey('success', session()->all());
    }

    public function testMethodDestroyNotFoundCategoryId()
    {
        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();

        $this->categoryRepo->shouldReceive('deleteSongsOfCategory')->andThrow(new Exception());
        $this->categoryRepo->shouldReceive('delete')->andThrow(new Exception());

        DB::partialMock()->shouldReceive('rollBack')->andReturnTrue();

        $res = $this->categoryController->destroy(1);

        $this->assertEquals(route('admin.categories.index'), $res->headers->get('Location'));
        $this->assertArrayHasKey('error', session()->all());
    }

    public function testMethodAddSongToCategorySuccess()
    {
        $this->request->shouldReceive('input')->andReturn(1);
        $this->request->shouldReceive('only')->andReturn([1, 2, 3]);

        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();

        $this->categoryRepo->shouldReceive('addSongToCategory');

        DB::partialMock()->shouldReceive('commit')->andReturnTrue();

        $this->categoryController->addSongToCategory($this->request);

        $this->assertArrayHasKey('success', session()->all());
    }

    public function testMethodAddSongToCategoryFailed()
    {
        $this->request->shouldReceive('input')->andReturn(1);
        $this->request->shouldReceive('only')->andReturn([1, 2, 3]);

        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();

        $this->categoryRepo->shouldReceive('addSongToCategory')->andThrow(new Exception());

        DB::partialMock()->shouldReceive('rollBack')->andReturnTrue();

        $this->categoryController->addSongToCategory($this->request);

        $this->assertArrayHasKey('error', session()->all());
    }

    public function testMethodRemoveFromCategorySuccess()
    {
        $this->request->shouldReceive('input')->andReturn(1);
        $this->request->shouldReceive('only')->andReturn([1, 2, 3]);

        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();

        $this->categoryRepo->shouldReceive('removeSongFromCategory');

        DB::partialMock()->shouldReceive('commit')->andReturnTrue();

        $this->categoryController->removeFromCategory($this->request);

        $this->assertArrayHasKey('success', session()->all());
    }

    public function testMethodRemoveFromCategoryFailed()
    {
        $this->request->shouldReceive('input')->andReturn(1);
        $this->request->shouldReceive('only')->andReturn([1, 2, 3]);

        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();

        $this->categoryRepo->shouldReceive('removeSongFromCategory')->andThrow(new Exception());

        DB::partialMock()->shouldReceive('rollBack')->andReturnTrue();

        $this->categoryController->removeFromCategory($this->request);

        $this->assertArrayHasKey('error', session()->all());
    }
}
