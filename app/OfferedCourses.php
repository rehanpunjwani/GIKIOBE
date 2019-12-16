<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferedCourses extends Model
{
    protected $table = 'semester_courses';
        protected $primaryKey = 'semester_course_id';
}
