<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class HomeControllers extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewRegister()
    {
        session(['telop' => "新規登録"]);
        return view('home.register');
    }

    /**
     * @param HomeRequest|Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        // バリテーションチェック
        $this->validate($request, [
            'mail_ad' => 'required|max:40',
            'password' => 'required|max:15'
        ]);

        // login処理
        try {

            // ユーザーが登録されているか確認
            $user = User::where('mail_ad', $request->mail_ad)->first();
            if (is_null($user) || !Hash::check($request->password, $user->password)) {
                // ユーザーが無ければログイン画面に戻る
                return redirect('/customer/login')->with('flash_message', 'メールアドレス又はパスワードが間違っています。');
            } else {
                // ユーザーが確認できればマイページに移動
                session(['user_id' => $user->user_id, 'mem_no' => $user->mem_no, 'profile' => $user->profile_url]);
                $userid = session('user_id');
                return redirect('/mypage')->with('flash_message', "ようこそ$userid さん");
            }
        } catch (\Exception $e) {
            // ログイン中に何かしらのエラーが発生
            \Log::error($e);
            return redirect('/')->with('flash_message', 'ログイン処理中に何かしらの例外が発生しました。');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewLogin()
    {
        session(['telop' => "ログイン"]);
        return view('home.login');
    }

    public function accountRegister(Request $request)
    {
        // バリテーションチェック
        $this->validate($request, [
            'user_id' => 'required|max:15',
            'mail_ad' => 'required|max:40',
            'password' => 'required|max:15'
        ]);

        try {
            // ユーザーの作成
            $hashedPw = Hash::make($request->password);
            $profileUrl = '';
            // プロフィール画像があれば保存
            if ($request->hasFile('profile')) {
                $fileName = $_FILES['profile']['name'];
                $extension = pathinfo($fileName, PATHINFO_EXTENSION); //拡張子取得
                $uniqName = Carbon::now()->format('Ymd') . md5(uniqid(microtime(), 1)) . session_id() . "." . $extension;
                $request->file('profile')->storeAs('public/profile', $uniqName);
                $profileUrl = 'storage/profile/' . $uniqName;
            } else {
                // プロフィール画像をアップロードしなければデフォルト画像
                $profileUrl = 'storage/profile/noimageaccount.png';
            }
            User::create([
                'user_id' => $request->user_id,
                'mail_ad' => $request->mail_ad,
                'password' => $hashedPw,
                'profile_url' => $profileUrl,
            ]);
            return $this->login($request);
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect('/customer/register')->with('flash_message', '既にこのメールアドレスは登録されています。');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // ログアウト　セッションを破棄
        $request->session()->flush();
        return redirect('/')->with('flash_message', 'ログアウトしました。');
    }
}
