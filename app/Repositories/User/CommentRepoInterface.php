<?php

namespace App\Repositories\User;

use App\Repositories\Admin\BaseRepositoryInterface;

interface CommentRepoInterface extends BaseRepositoryInterface
{
    public function getCommentWithUser($id);
    public function getAllCommentWithUserFromSongId($id);
    public function getAllReplyWithUserFromSongId($id);
}
