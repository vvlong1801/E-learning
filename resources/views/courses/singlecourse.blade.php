@extends('layouts.index')
@section('content')

    @if (session('flash_message'))
        <div class="card-body">
            <div class="alert alert-success">
                {{ session('flash_message') }}
            </div>
        </div>
    @endif

    @if (Auth::check() && Auth::id() == $author->id)
        <a href="{{ route('course.edit', [$course->id]) }}" class="btn btn-secondary" id="course_button">Edit Course</a>
        {!! Form::open(['method' => 'delete', 'route' => ['course.destroy', $course->id]]) !!}
        <input type="submit" value="Delete Course" class="btn btn-danger" id="course_button">
        {!! Form::close() !!}
    @endif
    <div class="container">
        <div class="course-title">
            <h1 class="display-4">{{ $course->title }}</h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="img-course">
                    <img class="card-img-top img-course" src="{{ asset('storage/' . $course->thumbnail) }}" alt="">
                </div>
                <br/>
                <div class="published">
                    <h6>作成日: {{ $course->created_at->toFormattedDateString() }}</h6>
                </div>
                <div class="author">
                    <h6 class="lead">作者: {{ $author->name }}</h6>
                </div>
                @if ($enroll == true && Auth::user()->role->first()->name == 'Student')
                    <div class="course-content">
                        <p class="lead">{{ $course->description }}</p>
                    </div>
                    <div class="course-button">
                        <a href="{{ route('course.unenroll', [$course->id]) }}" type="button"
                            class="btn btn-primary btn-lg mr-2">Unenroll</a>
                        @if ($complete == false)
                            <a href="{{ route('course.test',[$course->id]) }}" type="button"
                                class="btn btn-primary btn-lg mr-2">テスト</a>
                            <a href="{{ route('course.complete', [$course->id]) }}" type="button"
                                class="btn btn-primary btn-lg">完成</a>
                            <br />
                            <a href="{{route('course')}}" class="btn btn-primary mt-5">戻る</a>
                        @endif
                    </div>
                @else
                    @if ($complete == false)
                        <a href="{{ route('course.enroll', [$course->id]) }}" type="button"
                            class="btn btn-primary btn-lg">参加</a>
                    @endif
                @endif
            </div>
            <div class="col-md-6">
                <div>
                    <b>コースの紹介</b>
                </div>
                PHPはラスマス・ラードフが個人的にCで開発していたCGIプログラムである
                 "Personal Home Page Tools" （短縮されて "PHP Tools" と呼ばれていた）
                 を起源とする[6]。 元々はラードフ自身のWebサイトで簡単な動的Webページを作成する
                 ために用いられていたが、その後データベースへのアクセス機能などを追加したPHP Toolsを
                 1995年にGPLの下で公開した[7]。 オープンソースライセンスの下で公開されたことにより同ツール
                 の利用者が増加し、機能の追加を行う開発者たちの貢献もあって、幾度かの大きなバージョンアップ
                 を経て今日に至っている。 PHPの再帰的頭字語が PHP: Hypertext Preprocessor となったのは2017年現在の文法の基礎が確立したPHP 3から[6]である。
                <br/>
                <br/>
                <div>
                    <b>コースの紹介</b>
                </div>
                先に述べたように、PHPは動的なWebページを生成するツールを起源としているため、公式の処理系にはWebアプリケーション開発に関する機能が豊富に組み込まれている。 元々PHPはプログラミン
                グ言語と言えるものではなく、単にテンプレート的な処理を行うだけであったが、度重なる機能追加やコードの書き直しにより、...
            </div>
        <div>
    </div>
@endsection
