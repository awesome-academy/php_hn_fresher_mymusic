<?php

namespace Tests\Unit\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Requests\Admin\AuthorStoreRequest;
use App\Http\Requests\Admin\AuthorUpdateRequest;
use App\Models\Author;
use App\Repositories\Admin\Author\AuthorRepoInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\DB;
use Mockery as m;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    const FAKE_THUMBNAIL_PATH = 'authors/thumbnail/author.png';
    const FAKE_EXCEL_NAME = 'author.xlsx';

    protected $authors;
    protected $authorStoreRequest;
    protected $authorUpdateRequest;
    protected $authorRepo;
    protected $authorController;
    protected $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->authors = Author::factory()->count(10)->make();
        $this->authorStoreRequest = m::mock(AuthorStoreRequest::class);
        $this->authorUpdateRequest = m::mock(AuthorUpdateRequest::class);
        $this->request = m::mock(Request::class);
        $this->authorRepo = m::mock(AuthorRepoInterface::class)->makePartial();
        $this->authorController = new AuthorController($this->authorRepo);
    }

    public function tearDown(): void
    {
        unset($this->authors);
        unset($this->authorStoreRequest);
        unset($this->authorUpdateRequest);
        unset($this->authorRepo);
        unset($this->authorController);
        parent::tearDown();
    }

    public function testIndexMethod()
    {
        $this->authorRepo->shouldReceive('getAllWithPaginate')->andReturn($this->authors);

        $view = $this->authorController->index();

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.author.list', $view->getName());
        $this->assertArrayHasKey('authors', $view->getData());
    }

    public function testCreateMethod()
    {
        $view = $this->authorController->create();

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.author.create', $view->getName());
    }

    public function getRequestParams()
    {
        $author = $this->authors->first()->toArray();
        $requestParam = array_filter($author, function ($key) {
            return in_array($key, ['name', 'description']);
        }, ARRAY_FILTER_USE_KEY);

        return $requestParam;
    }

    public function testStoreMethodSuccess()
    {
        $image = UploadedFile::fake()->image('fake_file.png');
        $requestParam = $this->getRequestParams();

        $this->authorStoreRequest->shouldReceive('except')->andReturn($requestParam);
        $this->authorStoreRequest->shouldReceive('file')->andReturn($image);
        $this->authorRepo->shouldReceive('storeAsImageAuthor')->andReturn(static::FAKE_THUMBNAIL_PATH);
        $this->authorRepo->shouldReceive('create')->andReturn($this->authors->first());
        $this->authorController->store($this->authorStoreRequest);

        $this->assertArrayHasKey('success', session()->all());
    }

    public function testStoreMethodFailed()
    {
        $image = UploadedFile::fake()->image('fake_file.png');
        $requestParam = $this->getRequestParams();

        $this->authorStoreRequest->shouldReceive('except')->andReturn($requestParam);
        $this->authorStoreRequest->shouldReceive('file')->andReturn($image);
        $this->authorRepo->shouldReceive('storeAsImageAuthor')->andReturn(static::FAKE_THUMBNAIL_PATH);
        $this->authorRepo->shouldReceive('create')->andThrow(new Exception());
        $this->authorController->store($this->authorStoreRequest);

        $this->assertArrayHasKey('error', session()->all());
    }

    public function testShowMethodSuccess()
    {
        $author = $this->authors->first();

        $this->authorRepo->shouldReceive('getAuthorWithSongAndAlbum')->andReturn($author);

        $view = $this->authorController->show(1);

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.author.view', $view->getName());
        $this->assertArrayHasKey('author', $view->getData());
    }

    public function testShowMethodNotFoundAuthorId()
    {
        $this->authorRepo->shouldReceive('getAuthorWithSongAndAlbum')->andThrow(new Exception());

        $response = $this->authorController->show(1);

        $this->assertArrayHasKey('error', session()->all());
        $this->assertEquals(route('admin.authors.index'), $response->headers->get('Location'));
    }

    public function testEditMethodSuccess()
    {
        $author = $this->authors->first();

        $this->authorRepo->shouldReceive('find')->andReturn($author);

        $view = $this->authorController->edit(1);

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.author.edit', $view->getName());
        $this->assertArrayHasKey('author', $view->getData());
    }

    public function testEditMethodNotFoundAuthorId()
    {
        $this->authorRepo->shouldReceive('find')->andThrow(new Exception());

        $response = $this->authorController->edit(1);

        $this->assertArrayHasKey('error', session()->all());
        $this->assertEquals(route('admin.authors.index'), $response->headers->get('Location'));
    }

    public function testUpdateMethodSuccessWithThumbnail()
    {
        $author = $this->authors->first();
        $file = UploadedFile::fake()->image('fake_thumbnail.png');
        $requestParam = $this->getRequestParams();

        $this->authorUpdateRequest->shouldReceive('except')->andReturn($requestParam);
        $this->authorUpdateRequest->shouldReceive('file')->andReturn($file);
        $this->authorRepo->shouldReceive('storeAsImageAuthor')->andReturn(static::FAKE_THUMBNAIL_PATH);
        $this->authorRepo->shouldReceive('update')->andReturn($author);
        $this->authorController->update($this->authorUpdateRequest, 1);

        $this->assertArrayHasKey('success', session()->all());
    }

    public function testUpdateMethodSuccessWithoutThumbnail()
    {
        $author = $this->authors->first();
        $requestParam = $this->getRequestParams();

        $this->authorUpdateRequest->shouldReceive('except')->andReturn($requestParam);
        $this->authorUpdateRequest->shouldReceive('file')->andReturn(null);
        $this->authorRepo->shouldReceive('find')->andReturn($author);
        $this->authorRepo->shouldReceive('update')->andReturn($author);
        $this->authorController->update($this->authorUpdateRequest, 1);

        $this->assertArrayHasKey('success', session()->all());
    }

    public function testUpdateMethodSuccessNotFoundAuthorId()
    {
        $requestParam = $this->getRequestParams();

        $this->authorUpdateRequest->shouldReceive('except')->andReturn($requestParam);
        $this->authorUpdateRequest->shouldReceive('file')->andReturn(null);
        $this->authorRepo->shouldReceive('find')->andThrow(new Exception());
        $this->authorRepo->shouldReceive('update')->andThrow(new Exception());
        $this->authorController->update($this->authorUpdateRequest, 1);

        $this->assertArrayHasKey('error', session()->all());
    }

    public function testDestroyMethodSucess()
    {
        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();

        $this->authorRepo->shouldReceive('deleteSongOfAuthor')->andReturn(true);
        $this->authorRepo->shouldReceive('deleteALbumsOfAuthor')->andReturn(true);
        $this->authorRepo->shouldReceive('delete')->andReturn(true);

        DB::partialMock()->shouldReceive('commit')->andReturnTrue();

        $this->authorController->destroy(1);

        $this->assertArrayHasKey('success', session()->all());
    }

    public function testDestroyMethodFailed()
    {
        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();

        $this->authorRepo->shouldReceive('deleteSongOfAuthor')->andThrow(new Exception());
        $this->authorRepo->shouldReceive('deleteALbumsOfAuthor')->andThrow(new Exception());
        $this->authorRepo->shouldReceive('delete')->andThrow(new Exception());

        DB::partialMock()->shouldReceive('rollBack')->andReturnTrue();

        $this->authorController->destroy(1);

        $this->assertArrayHasKey('error', session()->all());
    }

    public function testImportExcel()
    {
        $file = UploadedFile::fake()->create(self::FAKE_EXCEL_NAME);
        $this->request->shouldReceive('only')->andReturn($file);
        Excel::fake();

        $this->authorController->importExcel($this->request);

        Excel::assertImported(self::FAKE_EXCEL_NAME);
        $this->assertArrayHasKey('success', session()->all());
    }
}
