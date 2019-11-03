@extends('layouts.default')

@section('title', '再設定用メール送信')

@section('content')
    <div class="panel panel-default" style="background-color: palegreen">
        <div class="panel-heading" style="background-color: palegreen">パスワードの再設定</div>
        <div class="panel-body  text-dark">
            <div class="col-md-9">
                <form class="form-horizontal" method="POST" action="{{ url('/mails/pwreset') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('mail_ad') ? ' has-error' : '' }}">
                        <label for="mail_ad" class="control-label">メールアドレス</label>
                        <input id="mail_ad" type="email" class="form-control" name="mail_ad"
                               value="{{ old('mail_ad') }}" placeholder="e-mail" required>

                        @if ($errors->has('mail_ad'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mail_ad') }}</strong></span>
                        @endif
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-success center-block w-50">
                            送信
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection