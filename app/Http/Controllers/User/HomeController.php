<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Album\AlbumRepoInterface;
use App\Repositories\Admin\Author\AuthorRepoInterface;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $songRepo;
    protected $categoryRepo;
    protected $albumRepo;
    protected $authorRepo;

    public function __construct(
        SongRepositoryInterface $songRepo,
        CategoryRepositoryInterface $categoryRepo,
        AlbumRepoInterface $albumRepo,
        AuthorRepoInterface $authorRepo
    ) {
        $this->songRepo = $songRepo;
        $this->categoryRepo = $categoryRepo;
        $this->albumRepo = $albumRepo;
        $this->authorRepo = $authorRepo;
    }

    public function index()
    {
        return view('welcome', $this->loadDataForHomePage());
    }

    public function showHomePage()
    {
        return response()->view('user.homepage', $this->loadDataForHomePage());
    }

    public function showSearchPage()
    {
        return response()->view('user.search');
    }

    public function showCategory(Request $request)
    {
        $category = $this->categoryRepo->find($request->id);

        return response()->view('user.category', compact('category'));
    }

    public function loadDataForHomePage()
    {
        $songs = $this->songRepo->getAllSongWithAuthors();

        $categories = $this->categoryRepo->getAllCategoryWithSong();

        $authors = $this->authorRepo->getAll();

        $albums = $this->albumRepo->getAllAlbumWithSong();

        return [
            'songs' => $songs,
            'categories' => $categories,
            'authors' => $authors,
            'albums' => $albums,
        ];
    }
}
