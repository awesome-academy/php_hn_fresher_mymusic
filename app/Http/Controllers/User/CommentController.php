<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\CommentRepoInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepo;
    protected $songRepo;

    public function __construct(CommentRepoInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function storeComment(Request $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = auth()->user()->id;
        $comment = $this->commentRepo->create($data);
        $comment = $this->commentRepo->getCommentWithUser($comment->id);

        return response()->json(compact('comment'));
    }
}
