<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SemesterCourseView extends Model
{
    protected $table = 'semester_courses_view';
    protected $primaryKey = 'row_id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

        
    'course_id',
    'instructor_id',
    'degree_name',
    'semester_year',
    'plan_year',
    'semester_type',
    'semester_id',
    'offered_status',
   
              
    ];
}
