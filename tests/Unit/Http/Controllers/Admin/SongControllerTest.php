<?php

namespace Tests\Unit\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Admin\SongController;
use App\Http\Requests\Admin\SongStoreRequest;
use App\Http\Requests\Admin\SongUpdateRequest;
use App\Models\Author;
use App\Models\Song;
use App\Repositories\Admin\Album\AlbumRepoInterface;
use App\Repositories\Admin\Author\AuthorRepoInterface;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Mockery;
use Tests\TestCase;

class SongControllerTest extends TestCase
{
    const FAKE_SONG_THUMBNAIL = 'storage/song/thumbnail/ai-no-1647600744.jpg';
    const FAKE_SONG_PATH = 'storage/song/source/blue-bigbang-6292792-1647665312.mp3';
    const FAKE_FILE_PATH = 'C:\Users\speed\AppData\Local\Temp';
    const FAKE_ORIGINAL_FILE_NAME = 'ai-no-1647600744.jpg';
    const FAKE_AUTHORS_ID = [1, 2, 3, 4, 5];
    const FAKE_ID = 1;

    protected $songs;
    protected $authors;
    protected $authorRepo;
    protected $albumRepo;
    protected $songRepo;
    protected $songController;
    protected $songStoreRequest;
    protected $songUpdateRequest;
    protected $helpers;

    /**
     * This method is called before each test.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->songStoreRequest = Mockery::mock(SongStoreRequest::class);

        $this->songUpdateRequest = Mockery::mock(SongUpdateRequest::class);

        $this->helpers = Mockery::mock('alias:' . Helpers::class);

        $this->authorRepo = Mockery::mock(AuthorRepoInterface::class)
            ->makePartial();

        $this->albumRepo = Mockery::mock(AlbumRepoInterface::class)
            ->makePartial();

        $this->songRepo = Mockery::mock(SongRepositoryInterface::class)
            ->makePartial();

        $this->songs = Song::factory()
            ->count(config('admin.paginate.song'))
            ->make();

        $this->authors = Author::factory()
            ->count(config('admin.paginate.author'))
            ->make();

        $this->songController = new SongController(
            $this->authorRepo,
            $this->albumRepo,
            $this->songRepo
        );
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        Mockery::close();
        unset($this->songs);
        unset($this->authorRepo);
        unset($this->albumRepo);
        unset($this->songRepo);
        unset($this->songStoreRequest);
        unset($this->songUpdateRequest);
        unset($this->songController);
        parent::tearDown();
    }

    /**
     * Test case method 'index' return exact view
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testIndexMethodReturnExactView()
    {
        $this->songRepo->shouldReceive('getAllWithRelationPaginate')
            ->andReturn($this->songs);

        $view = $this->songController->index();

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.songs.list', $view->getName());
        $this->assertArrayHasKey('songs', $view->getData());
    }

    /**
     * Test case method 'create' return exact view
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testCreateMethodReturnExactView()
    {
        $this->authorRepo->shouldReceive('getAll')
            ->andReturn($this->authors);

        $view = $this->songController->create();

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.songs.create', $view->getName());
        $this->assertArrayHasKey('authors', $view->getData());
    }

    /**
     * Test case method 'store' create record successfully
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testStoreMethodCreateRecordSuccessfully()
    {
        $uploadedFile = UploadedFile::fake()->image(static::FAKE_ORIGINAL_FILE_NAME);
        $requestParam = array_filter($this->songs->first()->toArray(), function ($key) {
            return in_array($key, [
                'name',
                'description',
                'album_id',
                'durations',
            ]);
        }, ARRAY_FILTER_USE_KEY);

        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();
        $this->songStoreRequest->shouldReceive('file')->andReturn($uploadedFile);
        $this->helpers->shouldReceive('storeSongThumbnail')->andReturn(static::FAKE_SONG_THUMBNAIL);
        $this->helpers->shouldReceive('storeSong')->andReturn(static::FAKE_SONG_PATH);
        $this->songStoreRequest->shouldReceive('only')->andReturn($requestParam);
        $this->songStoreRequest->shouldReceive('input')->andReturn(static::FAKE_AUTHORS_ID);
        $this->songRepo->shouldReceive('createNewSong')->andReturn($this->songs->first());
        DB::partialMock()->shouldReceive('commit')->andReturnTrue();

        $this->songController->store($this->songStoreRequest);

        $this->assertArrayHasKey('success', session()->all());
    }

    /**
     * Test case method 'store' get error
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testStoreMethodGetError()
    {
        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();
        $this->songRepo->shouldReceive('createNewSong')->andThrow(new Exception());
        DB::partialMock()->shouldReceive('rollback')->andReturnTrue();

        $this->songController->store($this->songStoreRequest);

        $this->assertArrayHasKey('error', session()->all());
    }

    /**
     * Test case method 'show' return exact view
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testShowMethodReturnExactView()
    {
        $song = $this->songs->first();
        $this->songRepo->shouldReceive('find')->andReturn($song);

        $view = $this->songController->show(static::FAKE_ID);

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.songs.show', $view->getName());
        $this->assertArrayHasKey('song', $view->getData());
    }

    /**
     * Test case method 'show' cannot find id of song
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testShowMethodNotFindSongId()
    {
        $this->songRepo->shouldReceive('find')->andThrow(
            new ModelNotFoundException()
        );

        $view = $this->songController->show(static::FAKE_ID);

        $this->assertEquals(route('admin.songs.index'), $view->headers->get('Location'));
        $this->assertArrayHasKey('error', session()->all());
    }

    /**
     * Test case method 'edit' return exact view
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testEditMethodReturnExactView()
    {
        $song = $this->songs->first();

        $this->songRepo->shouldReceive('find')->andReturn($song);
        $this->authorRepo->shouldReceive('getAll')->andReturn($this->authors);

        $view = $this->songController->edit(static::FAKE_ID);

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.songs.edit', $view->getName());
        $this->assertArrayHasKey('song', $view->getData());
        $this->assertArrayHasKey('authors', $view->getData());
    }

    /**
     * Test case method 'edit' cannot find id of song
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testEditMethodNotFindSongId()
    {
        $this->songRepo->shouldReceive('find')->andThrow(
            new ModelNotFoundException()
        );

        $view = $this->songController->edit(static::FAKE_ID);

        $this->assertEquals(route('admin.songs.index'), $view->headers->get('Location'));
        $this->assertArrayHasKey('error', session()->all());
    }

    /**
     * Test case method 'update' run successfully
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testUpdateMethodRunSuccessfully()
    {
        $uploadedFile = UploadedFile::fake()->image(static::FAKE_ORIGINAL_FILE_NAME);
        $requestParam = array_filter($this->songs->first()->toArray(), function ($key) {
            return in_array($key, [
                'name',
                'description',
                'album_id',
                'durations',
            ]);
        }, ARRAY_FILTER_USE_KEY);

        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();
        $this->songUpdateRequest->shouldReceive('only')->andReturn($requestParam);
        $this->songUpdateRequest->shouldReceive('file')->andReturn($uploadedFile);
        $this->helpers->shouldReceive('storeSongThumbnail')->andReturn(static::FAKE_SONG_THUMBNAIL);
        $this->helpers->shouldReceive('storeSong')->andReturn(static::FAKE_SONG_PATH);
        $this->songUpdateRequest->shouldReceive('input')->andReturn(static::FAKE_AUTHORS_ID);
        $this->songRepo->shouldReceive('updateSong')->andReturn(true);
        DB::partialMock()->shouldReceive('commit')->andReturnTrue();

        $this->songController->update($this->songUpdateRequest, static::FAKE_ID);

        $this->assertArrayHasKey('success', session()->all());
    }

    /**
     * Test case method 'update' catch exception
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testUpdateMethodCatchException()
    {
        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();
        $this->songRepo->shouldReceive('updateSong')->andThrow(new Exception());
        DB::partialMock()->shouldReceive('rollback')->andReturnTrue();

        $this->songController->update($this->songUpdateRequest, static::FAKE_ID);

        $this->assertArrayHasKey('error', session()->all());
    }

    /**
     * Test case method 'destroy' delete song successfully
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testDestroyMethodDeleteSongSuccess()
    {
        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();
        $this->songRepo->shouldReceive('deleteSong')->andReturn(true);
        DB::partialMock()->shouldReceive('commit')->andReturnTrue();

        $this->songController->destroy(static::FAKE_ID);

        $this->assertArrayHasKey('success', session()->all());
    }

    /**
     * Test case method 'destroy' cannot find song id
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testDestroyMethodNotFindSongId()
    {
        DB::partialMock()->shouldReceive('beginTransaction')->andReturnTrue();

        $this->songRepo->shouldReceive('deleteSong')->andThrow(
            new ModelNotFoundException()
        );

        DB::partialMock()->shouldReceive('rollback')->andReturnTrue();

        $response = $this->songController->destroy(static::FAKE_ID);

        $this->assertEquals(route('admin.songs.index'), $response->headers->get('Location'));
        $this->assertArrayHasKey('error', session()->all());
    }
}
