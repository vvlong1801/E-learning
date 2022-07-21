@extends('layouts.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <h5>質問1:HTMLは...の略です。</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question1">
                        <label>A.Hyperlinks and Text Markup Language</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question1">
                        <label>B.Hyper Text Markup Language</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question1">
                        <label>C.Home Tool Markup Language</label>
                    </div>
                    <button class="btn" onclick="question1()">答えをチェック </button>
                    <hr>
                    <p id="answer1"></p>

                </div>
                <div class="card">
                    <h5>質問2:javascriptプログラムを書く方法は？</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question2">
                        <label>A.別のページを書く</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question2">
                        <label>B.HTMLとの共著</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question2">
                        <label>C.AとBの両方のフォーム</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question2">
                        <label>D.形はありません</label>
                    </div>
                    <button class="btn" onclick="question2()">答えをチェック </button>
                    <hr>
                    <p id="answer2"></p>
                </div>
                <div class="card">
                    <h5>質問3:Javascriptでは、OnUnloadイベントはいつ実行されますか？</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question3">
                        <label>A.プログラムの最後に</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question3">
                        <label>B.クリックすると</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question3">
                        <label>C.プログラム実行を開始するとき</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question3">
                        <label>D.マウスを上に移動するとき</label>
                    </div>
                    <button class="btn" onclick="question3()">答えをチェック </button>
                    <hr>
                    <p id="answer3"></p>
                </div>
                <div class="card">
                    <h5>質問4:Javascriptでは、Onclickイベントはいつ発生しますか？</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question4">
                        <label>A.フォーム内のオブジェクトがフォーカスを失ったとき</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question4">
                        <label>B.フォーム内のオブジェクトにフォーカスがある場合</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question4">
                        <label>C.フォーム内のオブジェクトをクリックしたとき</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question4">
                        <label>D.コマンドボタンをクリックすると</label>
                    </div>
                    <button class="btn" onclick="question4()">答えをチェック </button>
                    <hr>
                    <p id="answer4"></p>
                </div>
                <div class="card">
                    <h5>質問5:CSSは？</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question5">
                        <label>A.Creative Style Sheets</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question5">
                        <label>B.Computer Style Sheets</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question5">
                        <label>C.Cascading Style Sheets</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question5">
                        <label>D.Colorful Style Sheets</label>
                    </div>
                    <button class="btn" onclick="question5()">答えをチェック </button>
                    <hr>
                    <p id="answer5"></p>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row mt-5">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <a href="{{ route('course.show', [$id]) }}" class="btn btn-primary mr-5">戻る</a>
                <a href="{{ route('course.show', [$id]) }}" class="btn btn-primary" style="float:right">完成</a>    
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function question1(props) {
            document.getElementById("answer1").innerHTML = "答え:B";
        }

        function question2(props) {
            document.getElementById("answer2").innerHTML = "答え:C";
        }

        function question3(props) {
            document.getElementById("answer3").innerHTML = "答え:A";
        }

        function question4(props) {
            document.getElementById("answer4").innerHTML = "答え:D";
        }

        function question5(props) {
            document.getElementById("answer5").innerHTML = "答え:C";
        }
    </script>
@endpush

@push('css')
    <style>
        .card {
            background-color: white;
            padding: 20px;
            margin: 50px auto;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        @media screen and (max-width: 800px) {
            .rightcolumn {
                width: 100%;
                padding: 0;
            }
        }
    </style>
@endpush
