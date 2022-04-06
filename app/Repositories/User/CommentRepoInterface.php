<?php

namespace App\Repositories\User;

use App\Repositories\Admin\BaseRepositoryInterface;

interface CommentRepoInterface extends BaseRepositoryInterface
{
    //get comment with user information
    public function getCommentWithUser($id);

    //get all comment with user information from song
    public function getAllCommentWithUserFromSongId($id);

    //get all reply comment with user information from song
    public function getAllReplyWithUserFromSongId($id);

    //delete replies comment
    public function deleteRepliesComment($id);
}
