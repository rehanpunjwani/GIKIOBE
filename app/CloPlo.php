<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CloPlo extends Model
{
    protected $table = 'clo_plo_view';
    protected $primaryKey = 'row_id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'course_id',
        'clo_id',
        'plo_id',
        'deg_year_id',

              
    ];
}
