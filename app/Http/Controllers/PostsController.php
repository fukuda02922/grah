<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Jobs\ZipApploadJob;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;


class PostsController extends Controller
{
    //

    /**
     * @return $this
     */
    public function index()
    {
        // 記事の全件
        $posts = Post::latest('created_at')->take(10)->paginate(10);
        session(['telop' => "最新の記事10件"]);
        return view('posts.index')->with('posts', $posts);
    }

    public function search(Request $request)
    {
        // バリテーション
        $this->validate($request, [
            'keyword' => 'required',
        ]);

        try {
            // キーワードによる記事の検索
            $posts = Post::latest('created_at')
                ->where('title', 'LIKE', "%$request->keyword%")
                ->orWhere('body', 'LIKE', "%$request->keyword%")->get();
            // 取得件数
            $count = $posts->count();
            session(['telop' => "「" . $request->keyword . "」に関連する記事が" . $count . "件見つかりました。"]);
            return view('posts.index')->with('posts', $posts);
        } catch (\Exception $e) {

        }
    }

    public function size(Request $request)
    {
        if ($request->size == 'all') {
            $posts = Post::latest('created_at')->paginate(10);
            session(['telop' => "全ての記事"]);
        } else {
            $size = intval($request->size);
            $posts = Post::latest('created_at')->take($size)->paginate(10);
            session(['telop' => "最新の記事" . $size . "件"]);
        }
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function mypage(Request $request)
    {
        // ユーザーが投稿した記事の検索
        $posts = Post::where('mem_no', Auth::id())->latest('created_at')->get();
        session(['telop' => "ホーム"]);
        return view('posts.mypage')->with('posts', $posts);
    }

    /**
     * @param $id
     * @return $this
     */
    public function show($id)
    {
        // 記事の詳細
        $post = Post::findOrFail($id);
        session(['telop' => $post->title . "の詳細"]);
        return view('posts.show')->with('post', $post);
    }

    /**
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        // 記事の編集
        $post = Post::findOrFail($id);
        session(['telop' => $post->title . "の編集"]);
        return view('posts.edit')->with('post', $post);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        session(['telop' => "記事の作成"]);
        return view('posts.create');
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
//        $this->validate($request, [
//            'title' => 'required|min:3',
//            'body' => 'required'
//        ]);

        // 記事の作成
        $imageUrl = '';
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'mem_no' => Auth::id(),
            'image_url' => $imageUrl,
            'user_id' => Auth::user()->user_id,
        ]);
        // 記事にアップロードファイルがあれば保存
        if ($request->hasFile('image')) {
            $fileName = $_FILES['image']['name'];
            $extension = pathinfo($fileName, PATHINFO_EXTENSION); //拡張子取得
            if($extension != 'zip') {
                $file = $request->file('image');
                $uniqName = Carbon::now()->format('Ymd') . md5(uniqid(microtime(), 1)) . session_id() . "." . $extension;
                $request->file('image')->storeAs('public/image', $uniqName);
                $post->image_url = 'storage/image/' . $uniqName;
                $post->save();
            } else {
                dispatch(new ZipApploadJob($post));
            }
        }
        return redirect('/mypage')->with('flash_message', '記事を投稿しました！');
    }

    /**
     * @param PostRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, $id)
    {
//        $this->validate($request, [
//            'title' => 'required|min:3',
//            'body' => 'required'
//        ]);
        // 記事の更新
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return redirect('/mypage')->with('flash_message', "$post->title の記事を編集しました！");
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // 記事の削除
        $title = '';
        $post = Post::findOrFail($id);
        $title = $post->title;
        $post->delete();
        return redirect('/mypage')->with('flash_message', "$title の記事を削除しました！");
    }
}