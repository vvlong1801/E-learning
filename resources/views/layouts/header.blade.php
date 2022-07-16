@section('header')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" id="navbar-logo">{{ Html::image('images/logo.png', 'LOGO', ['class' => 'logo']) }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @if (Auth::check() &&
                    (Auth::user()->role()->first()->name = 'Author'))
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('dashboard') }}">ダッシュボード</a>
                    </li>
                @endif
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ route('home') }}">ホーム</a>
                </li>
                @if (Auth::check() &&
                    Auth::user()->role()->first()->name == 'Student')
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('course.index') }}">私のコース</a>
                    </li>
                @endif
                @if (Auth::check() &&
                    Auth::user()->role()->first()->name == 'Admin')
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('user.index') }}">ユーザ</a>
                    </li>
                @endif
                @if (Auth::check())
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('user.account', [Auth::id()]) }}">アカウント情報</a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href=" {{ route('login') }}">ロギン</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=" {{ route('register') }}">登録</a>
                    </li>
                @else
                    <li class="nav-item text-light mr-5">
                        {{Auth::user()->name}}
                    </li>
                    <li class="nav-item">
                        {{-- {!! Form::open(["method" => "post", "action" =>  route('logout') ]) !!} --}}
                        {{-- <a class="nav-link" href=" {{ route('logout') }}">Logout</a> --}}
                        {{-- {!! Form::submit('Logout', ['class' => 'nav-link', 'id' => 'logoutbutton']) !!} --}}
                        {{-- {!! Form::close() !!} --}}
                        <a class="nav-link" id="logoutbutton" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                 document.getElementById('logoutform').submit();">
                            ログアウト
                        </a>
                        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
