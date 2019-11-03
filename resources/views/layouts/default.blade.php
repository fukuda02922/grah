<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://propeller.in/components/typography/css/typography.css">
    <link rel="stylesheet" href="http://propeller.in/components/navbar/css/navbar.css">
    <link rel="stylesheet" href="http://propeller.in/components/dropdown/css/dropdown.css">
    <link rel="stylesheet" href="http://propeller.in/components/button/css/button.css">
    <link rel="stylesheet" href="http://propeller.in/components/list/css/list.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="http://propeller.in/components/icons/css/google-icons.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<!-- ナビゲーション -->
<nav class="navbar navbar-inverse navbar-fixed-top pmd-navbar pmd-z-depth">
    <div class="container-fluid">
        <!-- ユーザー情報 -->
        <div class="dropdown pmd-dropdown pmd-user-info pull-right">
            <a href="javascript:void(0);" class="btn-user dropdown-toggle media" data-toggle="dropdown" aria-expanded="false">
                <div class="media-left">
                    <img src="http://propeller.in/assets/images/avatar-icon-40x40.png" width="40" height="40" alt="avatar">
                </div>
                <div class="media-body media-middle">
                    User
                </div>
                <div class="media-right media-middle">
                    <i class="material-icons pmd-sm">more_vert</i>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <li><a href="javascript:void(0);">Edit Profile</a></li>
                <li><a href="javascript:void(0);">Logout</a></li>
            </ul>
        </div>
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="javascript:void(0);" class="navbar-brand navbar-brand-custome pmd-ripple-effect">
                <img src="{{ asset('image/blog-board1.jpg') }}" class="blog img-responsive"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
            <form method="post"name="logout" action="{{ url('logout') }}">
                {{ csrf_field() }}
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                        <li class="pmd-ripple-effect"><a href="{{ url('/mypage') }}">ホーム</a></li>
                        <li class="pmd-ripple-effect"><a href="{{ url('#') }}">アカウント設定</a></li>
                        <li class="pmd-ripple-effect"><a href="javascript:logout.submit()">ログアウト</a></li>
                    @else
                        <li class="pmd-ripple-effect"><a href="{{ url('login') }}">ログイン</a></li>
                        <li class="pmd-ripple-effect"><a href="{{ url('register') }}">新規登録</a></li>
                    @endif
                    <li class="pmd-ripple-effect"><a href="{{ url('/') }}">トップページ</a></li>
                </ul>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    <div class="pmd-sidebar-overlay"></div>
</nav>
<div class="container" style="margin-top: 100px">
    <h3>{{session('telop')}}</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    @yield('content')
                </div>
                <div class="col-md-4">
                    <label for="search">Post検索</label>
                    <div class="common">
                        <div class="search">
                            <form method="post" action="{{ url('/posts/search') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-6">

                                    </div>

                                    <div class="col-md-7">
                                        <input type="text" name="keyword" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="submit" value="post検索">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <label for="notice">お知らせ</label>
                    <div class="common">
                        <div class="notice">
                            <ul>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                    @yield('subContent')
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 footer">
</div>
<!-- Jquery js -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Bootstrap js -->
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- Sidebar js -->
<script type="text/javascript" language="javascript" src="http://propeller.in/components/sidebar/js/sidebar.js"></script>

<!-- Propeller Dropdown js -->
<script type="text/javascript" language="javascript" src="http://propeller.in/components/dropdown/js/dropdown.js"></script>

<!-- Propeller ripple effect js -->
<script type="text/javascript" language="javascript" src="http://propeller.in/components/button/js/ripple-effect.js"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
</body>
</html>
