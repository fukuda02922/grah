<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiPostsRequest;
use App\Post;
use Illuminate\Http\Request;
use Validator;


class ApiPostsControllers extends Controller
{
    //
    /**
     * posts新規作成
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // バリテーションチェック
        $validation = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'body' => 'required',
            'mem_no' => 'required',
        ]);
        $response = [];
        // バリテーションエラー
        if ($validation->fails()) {
            $response = CreateJson::validateError(
                ['403', 'Posts'],
                [null]
            );
            return $response;
        }
        try {
            // 新規作成処理
            $imageUrl = '';
            $post = new Post();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = $file->getFilename();
                $extension = pathinfo($fileName, PATHINFO_EXTENSION); //拡張子取得
                $uniqName = Carbon::now()->format('Ymd') . md5(uniqid(microtime(), 1)) . session_id() . "." . $extension;
                $request->file('image')->storeAs('public/image', $uniqName);
                $imageUrl = 'storage/image/' . $uniqName;
            }
            $post->create([
                'title' => $request->title,
                'body' => $request->body,
                'mem_no' => $request->id,
                'image_url' => $imageUrl,
            ]);
            // 正常に新規作成
            $response = CreateJson::normal(
                ['200', 'Posts Insert'],
                ['id' => $post->id, 'title' => $post->title, 'body' => $post->body,
                    'created_at' => $post->created_d, 'updated_at' => $post->updated_at]
            );
        } catch (\Exception $e) {
            \Log::error($e);
            // 新規作成中に例外
            CreateJson::error(
                ['403', 'Posts Insert'],
                [null]
            );
            return $response;
        }
        return $response;
    }

    /**
     * posts更新
     *
     * @param ApiPostsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(ApiPostsRequest $request)
    {
        // バリテーションチェック
        $validation = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'body' => 'required',
        ]);

        $response = [];
        // バリテーションエラー
        if ($validation->fails()) {
            $response = CreateJson::validateError(
                ['403', 'Posts Update'],
                [null]
            );
            return $response;
        }
        try {
            // 更新処理
            $post = Post::findOrFail($request->id);
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();
            // 更新できた場合
            $response = CreateJson::normal(
                ['200', 'Posts Update'],
                ['id' => $post->id, 'title' => $post->title, 'body' => $post->body,]
            );
        } catch (\Exception $e) {
            \Log::error($e);
            // 更新処理中に例外
            $response = CreateJson::error(
                ['403', 'Posts Update'],
                [null]
            );
            return $response;
        }
        return $response;
    }

    /**
     * posts削除
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        // バリテーションチェック
        $validation = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        $response = [];
        // バリテーションエラー
        if ($validation->fails()) {
            CreateJson::validateError(
                ['403', 'Posts'],
                ['id' => $request->id,]
            );
            return $response;
        }
        try {
            // 削除処理
            $post = Post::findOrFail($request->id);
            $post->delete();
            $response = CreateJson::normal(
                ['200', 'Posts Delete'],
                ['id' => $request->id,]
            );
        } catch (\Exception $e) {
            \Log::error($e);
            // 削除処理中に例外
            $response = CreateJson::error(
                ['403', 'Posts Delete'],
                ['id' => $request->id,]
            );
            return $response;
        }
        return $response;
    }
}
