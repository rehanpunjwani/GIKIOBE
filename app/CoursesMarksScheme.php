<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursesMarksScheme extends Model
{
    protected $primaryKey = 'semester_course_id';
    public $timestamps = false;
    protected $fillable = [

        'assignments_weightage',
        'quizes_weightage',
        'project_weightage',
        'class_participation_weightage',
        'mid_weightage',
        'final_weightage'
              
    ];
    public function setTableName()
    {
        $this->setTable('course_clo_marks_schemes');
    }

}
