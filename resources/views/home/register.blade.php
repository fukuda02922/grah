@extends('layouts.default')

@section('title', 'アカウント新規作成')

@section('content')
    <style>
        #content:before {
            color: white;
            position: relative;
            content: attr(message);
            max-width: 50%;
            height: auto;
        }

        #contentmin {
            position: absolute;
            top: 100px;
            content: "";
            border: 10px;
        }
    </style>
    <div class="panel panel-default" style="background-color: #ffe8a1">
        <div class="panel-heading" style="background-color: #ffe8a1">アカウント作成</div>
        <div class="panel-body text-dark">
            <div class="col-md-10">
                <form id="registerform" class="form-horizontal" onsubmit="disableSubmit(this)"
                      enctype="multipart/form-data" method="POST" action="{{ url('/customer/register') }}">
                    {{ csrf_field() }}
                    <div id="drag-drop-area">
                        <div class="profile">
                        </div>
                    </div>
                    <input id="fileInput" type="file" value="ファイルを選択" name="profile">

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">ユーザーID</label>

                        <input id="name" type="text" class="form-control" name="user_id" value="{{ old('name') }}"
                               placeholder="ユーザーID" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('mail_ad') ? ' has-error' : '' }}">
                        <label for="mail_ad" class="control-label">メールアドレス</label>
                        <input id="mail_ad" type="email" class="form-control" name="mail_ad"
                               value="{{ old('mail_ad') }}" placeholder="e-mail" required>

                        @if ($errors->has('mail_ad'))
                            <span class="help-block">
                            <strong>{{ $errors->first('mail_ad') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">パスワード</label>
                        <input id="password" onkeyup="checkPassword()" type="password" class="form-control"
                               name="password" placeholder="半角英数8文字以上" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <p id="content">
                    <div id="contentmin"></div>
                    </p>

                    <div class="form-group">
                        <label for="password-confirm" class="control-label">パスワードの確認</label>
                        <input id="password-confirm" onkeyup="checkPassword()" type="password" class="form-control"
                               name="password_confirmation" placeholder="password" required>
                    </div>

                    <div class="custom-checkbox">
                        <label>
                            <input type="checkbox" value="remember_me" {{ old('remember') ? 'checked' : '' }}><span
                                    class="text-info small">ログイン状態を保存する</span>
                        </label>
                    </div>

                    <div class="">
                        <button id="submit" type="submit" class="btn btn-warning center-block w-50" disabled>
                            登録
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var password = document.getElementById("password");
        var password_confirm = document.getElementById("password-confirm");
        var message = "";
        var submit = document.getElementById("submit");
        var content = document.getElementById("content");
        var contentmin = document.getElementById("contentmin");

        function checkPassword() {
            content.style.borderRadius = "5px";
            if (password.value.length > 7) {
                if (password.value == password_confirm.value) {
                    password.style.backgroundColor = "rgba(184, 242, 140, 0.9)";
                    password.style.borderColor = "rgba(0, 255, 65, 1.0)";
                    password_confirm.style.backgroundColor = "rgba(184, 242, 140, 0.9)";
                    password_confirm.style.borderColor = "rgba(0, 255, 65, 1.0)";
                    submit.disabled = false;
                    message = "・このパスワードは大丈夫です。";
                    content.style.backgroundColor = "limegreen";
                    contentmin.borderBottomColor = "limegreen";
                    content.setAttribute("message", message);
                    return;
                } else {
                    message = "・パスワードが一致していません。";
                }
            } else {
                message = "・8文字以上で入力してください。";
            }
            password.style.backgroundColor = "rgba(242, 216, 223, 0.9)";
            password.style.borderColor = "rgba(255, 29, 0, 1.0)";
            password_confirm.style.backgroundColor = "rgba(242, 216, 223, 0.9)";
            password_confirm.style.borderColor = "rgba(255, 29, 0, 1.0)";
            submit.disabled = true;
            content.style.backgroundColor = "red";
            contentmin.borderBottomColor = "red";
            content.setAttribute("message", message);
        }
    </script>
@endsection
