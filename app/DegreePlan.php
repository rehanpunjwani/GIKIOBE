<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DegreePlan extends Model
{
    
    protected $table = 'degree_plan_dean_view';
    protected $primaryKey = 'row_id';
    public $timestamps = false;
    public $incrementing = false;

 
}
