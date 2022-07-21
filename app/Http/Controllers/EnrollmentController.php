<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\UserCourse;
use App\Enrollments;
use App\User;
use Auth;

class EnrollmentController extends Controller
{
    public function getMyCourse(){
        $user = Auth::user();
        $myCourses = $user->courses;
        dd($myCourses);
    }

    public function approve(User $user, Course $course)
    {
        $usercourse = UserCourse::create(
            [
                'user_id' => $user->id,
                'course_id' => $course->id,
                'course_enrolled' => 1,
                'course_completed' => 0
            ]
        );
        $usercourse->save();
        Enrollments::where('user_id', '=', $user->id)
                    ->where('course_id', '=', $course->id)
                    ->delete();
        \Session::flash('flash_message', '登録リクエストが承認されました');
        return redirect(route('dashboard'));
    }

    public function disapprove(User $user, Course $course)
    {
        $enrollment = Enrollments::where('user_id', '=', $user->id)
                    ->where('course_id', '=', $course->id)
                    ->delete();
        \Session::flash('flash_message', '登録リクエストは不承認になりました!');
        return redirect(route('dashboard'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        $enrollments = $user->enrollements;
        // $courses = Course::where('user_id', '=', $user->id);
        // $courses = $courses->pluck('id')->all();
        // $enrollments = Enrollments::whereIn('course_id', $courses)->get();
        return view('dashboard', compact('enrollments'));
    }
}
