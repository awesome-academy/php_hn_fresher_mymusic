<?php

namespace App\Repositories\User;

use App\Models\Comment;
use App\Repositories\Admin\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepoInterface
{
    const PARENT = 0;

    public function getModel()
    {
        return Comment::class;
    }

    public function getCommentWithUser($id)
    {
        return $this->model->with('user')->where('id', $id)->first();
    }

    public function getAllCommentWithUserFromSongId($id)
    {
        return $this->model->with('user')->where([
            ['song_id', $id],
            ['parent_id', self::PARENT],
        ])->get();
    }

    public function getAllReplyWithUserFromSongId($id)
    {
        return $this->model->with('user')->where([
            ['song_id', $id],
            ['parent_id', '!=', self::PARENT],
        ])->get();
    }
}
