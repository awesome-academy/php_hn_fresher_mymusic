<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\CommentRepoInterface;
use Illuminate\Http\Request;
use DB;

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

    public function updateComment(Request $request)
    {
        $data = $request->only('content');
        $data['user_id'] = auth()->user()->id;
        $comment = $this->commentRepo->update((int) $request->id, $data);
        $comment = $this->commentRepo->getCommentWithUser($comment->id);

        return response()->json(compact('comment'));
    }

    public function deleteComment(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->commentRepo->deleteRepliesComment($request->id);
            $this->commentRepo->delete((int) $request->id);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'error' => $th->getMessage(),
            ], 500);
        }

        return response()->json(['deleted' => true]);
    }
}
