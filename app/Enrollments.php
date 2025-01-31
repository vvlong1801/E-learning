<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollments extends Model
{
    protected $fillable = [
        'user_id', 'course_id', 'status'
    ];

    protected $table = "enrollments";

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Course','course_id');
    }

    protected $primaryKey  = ['user_id','course_id'];
    
    public $incrementing = false;
}
