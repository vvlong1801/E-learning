@extends('layouts.index')

@section('content')
    @if (session('flash_message'))
        <div class="card-body">
            <div class="alert alert-success">
                {{ session('flash_message') }}
            </div>
        </div>
    @endif
    @if (Auth::check() &&
        (Auth::user()->role->first()->name == 'Author' or Auth::user()->role->first()->name == 'Admin'))
        <a href="{{ route('course.create') }}" class="btn btn-secondary" id="course_button">Add New Course</a>
    @endif
    <div class="container" id="coursescontent">
        <div class="row">
            {{--  <div class="col-md-12">
                
            </div>  --}}
            @if ($courses->isEmpty())
                    @if (session('course'))
                        <div class="card-body">
                            <h2 class="alert alert-info">
                                {{ session('course') }}
                            </h2>
                        </div>
                    @endif
                @else
                    <div class="col-md-12"><h1 class="my-4">All Courses</h1></div>
                    @foreach ($courses as $course)
                        <div class="col-md-3 card mr-4 mb-4">
                            {{-- <img class="card-img-top" src="" alt="{{ $course['thumbnail'] }}"> --}}
                            <a href="{{ route('course.show', [$course->id]) }}">
                                <img class="card-img-top img-course" src="{{ asset('storage/' . $course->thumbnail) }}"
                                    alt="">
                            </a>
                            <div class="card-body">
                                <h2 class="card-title"><a
                                        href="{{ route('course.show', [$course->id]) }}">{{ $course['title'] }}</a></h2>
                                {{-- <p class="card-text">{{ $course['description'] }}</p> --}}
                            </div>
                            <div class="card-footer text-muted">
                                Author: {{ $course->author['name'] }}
                            </div>
                        </div>
                    @endforeach
                @endif
        </div>
    </div>


@endsection
