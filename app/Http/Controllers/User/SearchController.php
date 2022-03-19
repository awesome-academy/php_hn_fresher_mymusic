<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Album\AlbumRepoInterface;
use App\Repositories\Admin\Author\AuthorRepoInterface;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $songRepo;

    protected $albumRepo;

    protected $authorRepo;

    public function __construct(
        SongRepositoryInterface $songRepo,
        AlbumRepoInterface $albumRepo,
        AuthorRepoInterface $authorRepo
    ) {
        $this->songRepo = $songRepo;
        $this->albumRepo = $albumRepo;
        $this->authorRepo = $authorRepo;
    }

    public function showSearchPage()
    {
        $songs = $this->songRepo
            ->getRandomRecords(config('search.randomNumber.songs'), ['authors']);

        $albums = $this->albumRepo
            ->getRandomRecords(config('search.randomNumber.albums'), ['author', 'songs']);

        $authors = $this->authorRepo
            ->getRandomRecords(config('search.randomNumber.authors'));

        return response()->view('user.search', compact('songs', 'authors', 'albums'));
    }

    public function search(Request $request)
    {
        $input = $request->query('value') ?? '';
        $songs = $this->songRepo->findByWhereLike([['name', $input]], ['authors']);
        $authors = $this->authorRepo->findByWhereLike([['name', $input]]);
        $albums = $this->albumRepo->findByWhereLike([['title', $input]], ['author', 'songs']);

        return response()->json(compact('songs', 'authors', 'albums'));
    }
}
