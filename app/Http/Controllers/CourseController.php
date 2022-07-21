<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use App\Course;
use Auth;
use App\UserCourse;
use App\Enrollments;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $usercourse = UserCourse::where('user_id', '=', Auth::id())
                ->get();
            $courses = [];
            foreach ($usercourse as $row) {
                $courses[] = $row->course;
            }
            $courses = collect($courses);
        } else {
            $courses = Course::all();
        }
        if ($courses->isEmpty()) {
            \Session::flash('course', 'Not enrolled to any courses');
        }
        return view('courses', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $submitbuttontext = "Create";
        return view('courses.create', compact('submitbuttontext'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        dd($request->file('thumbnail')->store('public/images'));
        $input['thumbnail'] = str_replace('public/', '', $request->file('thumbnail')->store('public/images'));
        $input['user_id'] = Auth::id();
        $course = Course::create($input);
        \Session::flash('flash_message', 'A new course has been created!');
        $author = User::find($course->user_id);
        return redirect(route('home'));
    }

    public function filter(Category $category)
    {
        $courses = $category->courses;
        return view('courses', ['courses' => $courses, 'categoryId' => $category->id]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $text = UserCourse::where('user_id', '=', $user->id)->where('course_id', '=', $course->id)->get()->first();
            $enroll = (isset($text)) ? $text->course_enrolled : '';
            $comp = UserCourse::where('user_id', '=', $user->id)->where('course_id', '=', $course->id)->get()->first();
            $complete = (isset($comp) && $comp->course_completed == 1) ? $comp->course_completed : false;
        } else {
            $enroll = false;
            $complete = false;
        }
        $author = User::find($course->user_id);
        return view('courses.singlecourse', compact('course', 'author', 'enroll', 'complete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $submitbuttontext = "Edit Course";
        return view('courses.edit', compact('course', 'submitbuttontext'));
    }

    /**
     * user enroll course
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function enroll(Course $course)
    {
        if (Auth::guest()) {
            return redirect(route('login'));
        }
        //add enroll request to admin dashboard
        $enrollment = Enrollments::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'status' => 0,
        ]);
        $enrollment->save();
        \Session::flash('flash_message', 'Your request has been submitted, You will be able to see the course content after admin approves your request!');
        return redirect(route('home'));
    }

    public function unenroll(Course $course)
    {
        //detach record from user-course.
        UserCourse::where('user_id', '=', Auth::id())
            ->where('course_id', '=', $course->id)
            ->delete();
        \Session::flash('flash_message', 'You have been unenrolled from the course!');
        return redirect(route('home'));
    }

    public function complete(Course $course)
    {
        UserCourse::where('user_id', '=', Auth::id())
            ->where('course_id', '=', $course->id)
            ->update(['course_completed' => 1]);
        \Session::flash('flash_message', 'Course marked as completed!');
        return redirect(route('course.show', [$course->id]));
    }

    public function search(Request $request){
        $text = $request->get('course_search_box')?? null;
        if($text === null){
            return redirect()->route('course');
        }else{
            $userCourses = Auth::user()->userCourse->filter(function($userCourse) use ($text){
                $course = $userCourse->course;
                return str_contains($course->title, $text) ? true : false;
            });
            $courses = $userCourses->map(function($userCourse) {
                return $userCourse->course;
            });
            return view('courses', compact('courses'));
        }
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function update(Course $course, Request $request)
    {
        $input = $request->all();
        $input['thumbnail'] = $request->file('thumbnail')->store('images');
        $course->update($input);
        \Session::flash('flash_message', 'The course has been updated!');
        return redirect(route('course.edit', [$course['id']]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function destroy($r)
    {
        $course = Course::find($r);
        $course->delete();
        \Session::flash('flash_message', 'Course Deleted!');
        // dd($course);
        return redirect(route('course'));
    }
}
