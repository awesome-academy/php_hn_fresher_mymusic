<?php

namespace Tests\Unit\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AlbumController;
use App\Http\Requests\Admin\AlbumOfAuthorRequest;
use App\Http\Requests\Admin\AlbumStoreRequest;
use App\Http\Requests\Admin\AlbumUpdateRequest;
use App\Models\Album;
use App\Models\Author;
use App\Repositories\Admin\Album\AlbumRepoInterface;
use App\Repositories\Admin\Author\AuthorRepoInterface;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class AlbumControllerTest extends TestCase
{
    protected $albumOfAuthorRequest;
    protected $updateRequest;
    protected $storeRequest;
    protected $controller;
    protected $repository;
    protected $authorRepo;
    protected $albumRepo;
    protected $songRepo;
    protected $request;
    protected $albums;
    protected $album;
    protected $authors;

    public function setup(): void
    {
        parent::setUp();
        $this->albumRepo = Mockery::mock(AlbumRepoInterface::class)
            ->makePartial();
        $this->songRepo = Mockery::mock(SongRepositoryInterface::class)
            ->makePartial();
        $this->authorRepo = Mockery::mock(AuthorRepoInterface::class)
            ->makePartial();
        $this->albumOfAuthorRequest = Mockery::mock(AlbumOfAuthorRequest::class);
        $this->storeRequest = Mockery::mock(AlbumStoreRequest::class);
        $this->updateRequest = Mockery::mock(AlbumUpdateRequest::class);
        $this->authors = Author::factory()->count(10)->make();
        $this->albums = Album::factory()->count(15)->make();
        $this->request = Mockery::mock(Request::class);
        $this->album = $this->albums->first();
        $this->album->id = 1;
        $this->controller = new AlbumController(
            $this->albumRepo,
            $this->authorRepo,
            $this->songRepo
        );
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->controller);
        parent::tearDown();
    }

    // This method test index function return list all albums view
    public function testIndexReturnView()
    {
        $this->albumRepo->shouldReceive('getAllWithRelationPaginate')->andReturn($this->albums);

        $view = $this->controller->index();

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.album.list', $view->getName());
        $this->assertArrayHasKey('albums', $view->getData());
    }

    // This method test create function return create view
    public function testCreateView()
    {
        $this->authorRepo->shouldReceive('getAll')->andReturn($this->authors);

        $view = $this->controller->create();

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.album.create', $view->getName());
    }

    // This method test store function success and return success
    public function testAlbumStoreSuccess()
    {
        $this->storeRequest->shouldReceive('except')->andReturn($this->album->toArray());
        $this->albumRepo->shouldReceive('create')->andReturn(true);

        $response = $this->controller->store($this->storeRequest);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertArrayHasKey('success', session()->all());
    }

    // This method test store function fails and return error session
    public function testAlbumStoreFail()
    {
        $this->storeRequest->shouldReceive('except')->andReturn($this->album->toArray());
        $this->albumRepo->shouldReceive('create')->andReturn(false);

        $response = $this->controller->store($this->storeRequest);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertArrayHasKey('error', session()->all());
    }

    // This method test show function return detail album view
    public function testShowView()
    {
        $this->authorRepo->shouldReceive('getAuthorWithSongAndAlbum')->andReturn($this->authors);
        $this->albumRepo->shouldReceive('find')->andReturn($this->album);

        $view = $this->controller->show($this->album->id);

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.album.view', $view->getName());
        $this->assertArrayHasKey('album', $view->getData());
        $this->assertArrayHasKey('author', $view->getData());
    }

    /**
     * This method test edit function return edit view
     */
    public function testEditView()
    {
        $this->authorRepo->shouldReceive('getAll')->andReturn($this->authors);
        $this->albumRepo->shouldReceive('find')->andReturn($this->album);

        $view = $this->controller->edit($this->album->id);

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.album.edit', $view->getName());
        $this->assertArrayHasKey('album', $view->getData());
    }

    // This method test update album function success
    public function testAlbumUpdateSuccess()
    {
        $this->updateRequest->shouldReceive('except')->andReturn($this->album->toArray());
        $this->albumRepo->shouldReceive('update')->andReturn(true);

        $response = $this->controller->update($this->updateRequest, $this->album->id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertArrayHasKey('success', session()->all());
    }

    // This method test update album function fails and return session error
    public function testAlbumUpdateFail()
    {
        $this->updateRequest->shouldReceive('except')->andReturn($this->album->toArray());
        $this->albumRepo->shouldReceive('update')->andReturn(false);

        $response = $this->controller->update($this->updateRequest, $this->album->id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertArrayHasKey('error', session()->all());
    }

    // This method test update album function success
    public function testGetAlbumsOfAuthors()
    {
        $albumId = json_encode([1]);
        $this->albumOfAuthorRequest->shouldReceive('query')->andReturn($albumId);
        $this->albumRepo->shouldReceive('getRecordByWhereIn')->andReturn($this->albums);

        $response = $this->controller->getAlbumsOfAuthors($this->albumOfAuthorRequest);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('albums', (array) json_decode($response->getContent()));
    }

    // This method test delete album function success
    public function testDestroyAlbumSuccess()
    {
        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();
        $this->albumRepo->shouldReceive('deleteSongOfAlbum')->andReturn(true);
        $this->albumRepo->shouldReceive('delete')->andReturn(true);
        DB::partialMock()->shouldReceive('commit')->andReturnTrue();

        $response = $this->controller->destroy($this->album->id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertArrayHasKey('success', session()->all());
    }

    //This method test delete album function have exception and return false
    public function testDestroyAlbumFail()
    {
        $this->albumRepo->shouldReceive('deleteSongOfAlbum')->andReturn(true);
        $this->albumRepo->shouldReceive('delete')->andThrow(new Exception());

        $response = $this->controller->destroy($this->album->id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertArrayHasKey('error', session()->all());
    }

    // This method test add song from album function success
    public function testAddSongToAlbumSuccess()
    {
        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();
        $albums = ["album_id" => 1];
        $songIds = ["song_id" => 1];
        $this->request->shouldReceive('input')->andReturn($albums);
        $this->request->shouldReceive('only')->andReturn($songIds);
        $this->songRepo->shouldReceive('update')->andReturn(true);
        DB::partialMock()->shouldReceive('commit')->andReturnTrue();

        $response = $this->controller->addSongToAlbum($this->request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertArrayHasKey('success', session()->all());
    }

    // This method test add song from album function fails and return error session
    public function testAddSongToAlbumFail()
    {
        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();
        $albums = ["album_id" => 1];
        $songIds = ["song_id" => 1];
        $this->request->shouldReceive('input')->andReturn($albums);
        $this->request->shouldReceive('only')->andReturn($songIds);
        $this->songRepo->shouldReceive('update')->andThrow(new Exception());
        DB::partialMock()->shouldReceive('rollback')->andReturnTrue();

        $response = $this->controller->addSongToAlbum($this->request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertArrayHasKey('error', session()->all());
    }

    // This method test remove song from album function success
    public function testRemoveSongFromAlbumSuccess()
    {
        $albums = ["album_id" => null];
        $songIds = ["song_id" => 1];
        $this->request->shouldReceive('input')->andReturn($songIds);
        $this->songRepo->shouldReceive('update')->andReturn(true);

        $response = $this->controller->removeSongFromAlbum($this->request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertArrayHasKey('success', session()->all());
    }

    // This method test remove song from album function fails and return error session
    public function testRemoveSongToAlbumFail()
    {
        $albums = ["album_id" => null];
        $songIds = ["song_id" => 1];
        $this->request->shouldReceive('input')->andReturn($songIds);
        $this->songRepo->shouldReceive('update')->andReturn(false);

        $response = $this->controller->removeSongFromAlbum($this->request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertArrayHasKey('error', session()->all());
    }
}
