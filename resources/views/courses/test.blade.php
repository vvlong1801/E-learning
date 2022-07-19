@extends('layouts.index')
@section('content')
<div class="bg-info">testtt</div>
<a href="{{route('course.show',['5'])}}" class="btn btn-primary mr-5">戻る</a>
<a href="{{route('course.show',['5'])}}" class="btn btn-primary">完成</a>
@endsection
