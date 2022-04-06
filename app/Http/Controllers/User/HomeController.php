<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Album\AlbumRepoInterface;
use App\Repositories\Admin\Author\AuthorRepoInterface;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use App\Repositories\Admin\Playlist\PlaylistRepoInterface;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use App\Repositories\User\CommentRepoInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $songRepo;
    protected $categoryRepo;
    protected $albumRepo;
    protected $authorRepo;
    protected $playlistRepo;
    protected $commentRepo;

    public function __construct(
        SongRepositoryInterface $songRepo,
        CategoryRepositoryInterface $categoryRepo,
        AlbumRepoInterface $albumRepo,
        AuthorRepoInterface $authorRepo,
        PlaylistRepoInterface $playlistRepo,
        CommentRepoInterface $commentRepo
    ) {
        $this->songRepo = $songRepo;
        $this->categoryRepo = $categoryRepo;
        $this->albumRepo = $albumRepo;
        $this->authorRepo = $authorRepo;
        $this->playlistRepo = $playlistRepo;
        $this->commentRepo = $commentRepo;
    }

    public function index()
    {
        return view('welcome', $this->loadDataForHomePage());
    }

    public function showHomePage()
    {
        return response()->view('user.homepage', $this->loadDataForHomePage());
    }

    public function showCategory(Request $request)
    {
        $category = $this->categoryRepo->find($request->id);

        $favorite = $this->playlistRepo->getFavoritePlaylist();

        return response()->view('user.category', compact('category', 'favorite'));
    }

    public function showAlbum(Request $request)
    {
        $album = $this->albumRepo->find($request->id);

        $relatedAlbum = $this->albumRepo->findByWhere([
            ['author_id', $album->author->id],
            ['id', '<>', $request->id],
        ]);

        $favorite = $this->playlistRepo->getFavoritePlaylist();

        return response()->view('user.album', compact('album', 'relatedAlbum', 'favorite'));
    }

    public function showAuthor(Request $request)
    {
        $author = $this->authorRepo->find($request->id);

        $albums = $this->albumRepo->findByWhere([['author_id', $request->id]]);

        $favorite = $this->playlistRepo->getFavoritePlaylist();

        return response()->view('user.author', compact('author', 'albums', 'favorite'));
    }

    public function showSong(Request $request)
    {
        $song = $this->songRepo->find($request->id);

        $relatedSongs = $this->songRepo->getRelatedSong($song);

        $favorite = $this->playlistRepo->getFavoritePlaylist();

        $comments = $this->commentRepo->getAllCommentWithUserFromSongId($request->id);

        $replies = $this->commentRepo->getAllReplyWithUserFromSongId($request->id);

        return response()->view('user.song', compact('song', 'favorite', 'comments', 'replies', 'relatedSongs'));
    }

    public function loadDataForHomePage()
    {
        $songs = $this->songRepo->getAllSongWithAuthors();

        $categories = $this->categoryRepo->getAllCategoryWithSong();

        $authors = $this->authorRepo->getAll();

        $albums = $this->albumRepo->getAllAlbumWithSong();

        $favorite = $this->playlistRepo->getFavoritePlaylist();

        return [
            'songs' => $songs,
            'categories' => $categories,
            'authors' => $authors,
            'albums' => $albums,
            'favorite' => $favorite,
        ];
    }
}
