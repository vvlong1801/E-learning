@extends('layouts.index')
@inject('category', 'App\Http\Controllers\CategoryController')
@php
    $categories = $category->index();
    $categoryId = isset($categoryId)===true ? $categoryId : 0 ;
@endphp
@section('content')
    @if (session('flash_message'))
        <div class="card-body">
            <div class="alert alert-success">
                {{ session('flash_message') }}
            </div>
        </div>
    @endif
    <form method="POST" style="text-align: center;" class="my-4">
        <input type="text" id="course_search_box" name="course_search_box" class="search-box" placeholder="欲しいコースのタイトルを入力" />
        <button id="search-button" type="submit" class="btn btn-primary">検索</button>
    </form>
    <div class="container-fluid" id="coursescontent">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                @if (Auth::check() &&
                    (Auth::user()->role->first()->name == 'Author' or Auth::user()->role->first()->name == 'Admin'))
                    <div class="col-md-4">
                        <a href="{{ route('course.create') }}" class="btn btn-secondary" id="course_button">新しいコース</a>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <h1 class="my-4">カテゴリー</h1>
                </div>
                <div class="row mr-4" style="">
                    <ul class="list-group w-100">
                        <a href="{{route('course.index')}}">
                            <li class="list-group-item {{ $categoryId===0 ? 'active' : '' }}">全コース</li>
                        </a>
                        @foreach ($categories as $category)
                            <a class="list-group-item 
                            {{ $categoryId === $category->id ? 'active' : '' }}"
                                href="{{ route('course.filter', [$category->id]) }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                        {{-- <li class="list-group-item">ウェブ開発</li>
                        <li class="list-group-item">ウェブデザイン</li>
                        <li class="list-group-item">モバイルアプリ</li>
                        <li class="list-group-item">インターネット</li>
                        <li class="list-group-item">IOT</li> --}}
                    </ul>
                </div>
            </div>
            @if ($courses->isEmpty())
                @if (session('course'))
                    <div class="card-body">
                        <h2 class="alert alert-info">
                            {{ session('course') }}
                        </h2>
                    </div>
                @endif
            @else
                <div class="col-md-9">
                    <div class="row">
                        <h1 class="my-4">全コース</h1>
                    </div>
                    <div class="row">
                        @foreach ($courses as $course)
                            <div class="col-md-3 card mr-4 mb-4">
                                {{-- <img class="card-img-top" src="" alt="{{ $course['thumbnail'] }}"> --}}
                                <a href="{{ route('course.show', [$course->id]) }}">
                                    <img class="card-img-top img-course"
                                        src="{{ asset('storage/' . $course->thumbnail) }}" alt="">
                                </a>
                                <div class="card-body">
                                    <h2 class="card-title"><a
                                            href="{{ route('course.show', [$course->id]) }}">{{ $course['title'] }}</a>
                                    </h2>
                                    {{-- <p class="card-text">{{ $course['description'] }}</p> --}}
                                </div>
                                <div class="card-footer text-muted">
                                    作者: {{ $course->author['name'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>


@endsection
