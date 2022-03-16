<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Album\AlbumRepoInterface;
use App\Repositories\Admin\Author\AuthorRepoInterface;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use App\Repositories\Admin\Song\SongRepositoryInterface;

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

    public function showHomePage()
    {
        $songs = $this->songRepo->getAllSongWithAuthors();

        $categories = $this->categoryRepo->getAllCategoryWithSong();

        $authors = $this->authorRepo->getAll();

        $albums = $this->albumRepo->getAllAlbumWithSong();

        return view('welcome', compact('songs', 'categories', 'authors', 'albums'));
    }
}
