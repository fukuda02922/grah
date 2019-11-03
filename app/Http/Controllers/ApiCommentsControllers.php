<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Validator;

class ApiCommentsControllers extends Controller
{
    /**
     * comments新規作成
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // バリテーションチェック
        $validation = Validator::make($request->all(), [
            'body' => 'required',
        ]);
        // JSONが返らない
//        $this->validate($request, [
//            'body' => 'required',
//            ]);

        $response = [];
        // バリテーションエラー
        if ($validation->fails()) {
            $response = CreateJson::validateError(
                ['403', 'Comment'],
                ['postId' => $request->postId, 'commentId' => $request->commentId]
            );
            return $response;
        }
        try {
            // 新規作成処理
            $comment = new Comment(['body' => $request->body]);
            $post = Post::findOrFail($request->postId);
            $post->comments()->save($comment);
            $response = CreateJson::normal(
                ['200', 'Comment Insert'],
                ['postId' => $request->postId, 'commentId' => $comment->id, 'body' => $request->body]
            );
        } catch (\Exception $e) {
            \Log::error($e);
            // 新規作成中に例外
            $response = CreateJson::error(
                ['403', 'Comment Insert'],
                ['postId' => $request->postId, 'body' => $request->body]
            );
            return $response;
        }
        return $response;
    }

    /**
     * commentsの削除
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        // バリテーションチェック
        $validation = Validator::make($request->all(), [
            'postId' => 'required',
            'commentId' => 'required',
        ]);
        $response = [];
        // バリテーションエラー
        if ($validation->fails()) {
            $response = CreateJson::validateError(
                ['403', 'Comment'],
                ['postId' => $request->postId, 'commentId' => $request->commentId]
            );
            return $response;
        }
        try {
            // 削除処理
            $post = Post::findOrFail($request->postId);
            $comment = $post->comments()->findOrFail($request->commentId);
            $comment->delete();
            $response = CreateJson::normal(
                ['200', 'Comment Delete'],
                ['postId' => $request->postId, 'commentId' => $comment->id,]
            );
        } catch (\Exception $e) {
            \Log::error($e);
            // 削除処理中に例外
            CreateJson::error(
                ['403', 'Comment Delete'],
                ['postId' => $request->postId, 'commentId' => $comment->id,]
            );
            return $response;
        }
        return $response;
    }
}
