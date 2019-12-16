<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class CourseCloMarksScheme extends Model
{
    protected $table = 'clo_view';
    protected $primaryKey = 'clo_sem_id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

        'assignments_weightage',
        'quizes_weightage',
        'project_weightage',
        'class_participation_weightage',
        'mid_weightage',
        'final_weightage'
              
    ];

    
    
}
