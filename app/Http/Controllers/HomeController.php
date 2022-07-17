<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        foreach ($courses as $course) {
            $course->author = User::find($course->user_id);
        }
        if ($courses->isEmpty()) {
            \Session::flash('course', 'No Courses Created.');
        }
        return view('courses', compact('courses'));
    }

    public function search(Request $request)
    {
        $text = $request->get('course_search_box') ?? null;
        if ($text === null) {
            return redirect()->route('home');
        } else {
            $courses = Course::where('title', 'like', '%' . $text . '%')->get();
            return view('courses', compact('courses'));
        }
    }
}
