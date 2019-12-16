<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course_view';
    protected $primaryKey = 'row_id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'course_id',
        'offered_by_faculty',
        'courseName',
        'degree_year_plan_id',
        'semester_no',
        'semester_type',
        'pre_requisite_course'

              
    ];
}
