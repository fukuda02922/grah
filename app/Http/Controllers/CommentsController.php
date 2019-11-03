<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    //
    /**
     * @param Request $request
     * @param $postId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $postId)
    {
        // コメントのバリデーション
        $this->validate($request, [
            'body' => 'required'
        ]);

        try {
            // Postテーブルに記事があるか検索
            $post = Post::findOrFail($postId);
            // 記事があればリクエストからコメントを取得しDBに保存
            $post->comments()->create([
                'body' => $request->body,
                'user_id' => Auth::user()->user_id,
                'profile_url' => Auth::user()->profile,
            ]);
        } catch (ModelNotFoundException $e) {
            // 記事がなければ記事の詳細画面に戻る
            return redirect('/')->with('flash_message', '記事がありませんでした。');
        }
        return redirect()->action('PostsController@show', $post->id);
    }

    /**
     * @param $postId
     * @param $commentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($postId, $commentId)
    {
        // コメントを削除
        $post = Post::findOrFail($postId);
        $post->comments()->findOrFail($commentId)->delete();

        return redirect()->action('PostsController@show', $post->id);
    }

    /**
     * @param $body
     * @return string
     */
    private function checkAndGetSendUser($body)
    {
        // ユーザーへのコメントがあるかの判定
        if (strpos($body, '[To:') !== false) {
            if (strpos($body, ']') !== false) {
                // ユーザーIDのlengthを取得
                $index = mb_strpos($body, ']', 0, UTF-8);

                // ユーザーIDの取得
                return $user_id = mb_substr($body, 4, ($index - 1), UTF-8);
            }
        }
        // ユーザーへのコメントではない場合
        return false;
    }

    /**
     * @param $body
     */
    private function sendUser($body){
        $userId = $this->checkAndGetSendUser($body);
        if (!$userId) {
            return;
        }
        try {

        } catch (\Exception $e) {
            return new throwException($e);
        }
    }
}
