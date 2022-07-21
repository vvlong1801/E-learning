@extends('layouts.index')
@section('content')
<div class="container bg-info">
    <div class="row">
        <div class="leftcolumn">
            <div class="card">
                <h5>Câu hỏi 1:...</h5>
                <p>A. </p>
                <p>B.</p>
                <p>C.</p>
                <p>D.</p>
                <button onclick="myFunction()">answer </button>
                <p id="answer"></p>
            </div>
        </div>
    </div>
</div>
<a href="{{route('course.show',['5'])}}" class="btn btn-primary mr-5">戻る</a>
<a href="{{route('course.show',['5'])}}" class="btn btn-primary">完成</a>
@endsection

@push('js')
<script>
    function myFunction() {
        document.getElementById("answer").innerHTML = "Đáp án: B";
    }
</script>
@endpush