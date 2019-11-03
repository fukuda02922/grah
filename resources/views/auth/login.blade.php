@extends('layouts.default')

@section('title', 'ログイン画面')

@section('content')


    <div class="panel panel-default" style="background-color: palegreen">
        <div class="panel-heading" style="background-color: palegreen">ログイン</div>
        <div class="panel-body  text-dark">
            <div class="col-md-9">
                <form class="form-horizontal" method="POST" action="{{ url('login') }}"
                      onsubmit="disableSubmit(this)">
                    {{ csrf_field() }}
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
                        <input id="password" type="password" class="form-control" name="password" placeholder="password"
                               required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                        @endif
                    </div>

                    <div class="custom-checkbox">
                        <label>
                            <input type="checkbox" value="remember_me" {{ old('remember') ? 'checked' : '' }}>
                            <span class="text-info small">ログイン状態を保存する</span>
                        </label>
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-success center-block w-50">
                            ログイン
                        </button>
                    </div>
                </form>
                <a style="font-size: 8px" href="{{ url('/home/pwreset') }}" class="text">
                    パスワードを忘れましたか？
                </a>
            </div>
        </div>
    </div>
@endsection