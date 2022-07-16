<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'thumbnail', 'user_id', 'authorname', 'description', 'category_id'
    ];

    protected $table ='courses';

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_course', 'course_id');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function enrollments()
    {
        return $this->hasMany('App\Enrollments');
    }

    public function userCourse()
    {
        return $this->hasMany('App\UserCourse');
    }
}
