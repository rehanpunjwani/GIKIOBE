<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CloController extends Controller
{
    //
   
    public function index()
    {
      
        //
        $cid ='1';
        // $id = DB::select("select sem_course_id  from instructor_courses where instructor_id='$cid' ")->value();
        $id =  DB::table('instructor_courses')->where('instructor_id', $cid)->value('sem_course_id');

        // $data = DB::table('courses_marks_scheme')->get();
        // $data = DB::select('select * from student_clo_marks');
        $courses = DB::table('course_clo_marks_schemes')->where('sem_course_id',$id)->get();
 
        
        
        return view('coursesmarks.index', compact('courses'));
    }
    public function edit($sem_course_id,$clo_id){
        $course = DB::table('course_clo_marks_schemes')->where('sem_course_id',$sem_course_id)->where('clo_id',$clo_id)->get();
        return view('courses.edit', compact('course'));
        // return $course;

    }
    public function update(Request $request, $sem_course_id, $clo_id){
        
        $courses = DB::table('course_clo_marks_schemes')->where('sem_course_id',$sem_course_id)->where('clo_id',$clo_id)->get();
        $course->assignments_weightage =  $request->get('assignments_weightage');
        $course->quizes_weightage =  $request->get('quizes_weightage');
        $course->project_weightage = $request->get('project_weightage');
        $course->class_participation_weightage = $request->get('class_participation_weightage');
        $course->mid_weightage =  $request->get('mid_weightage');
        $course->final_weightage = $request->get('final_weightage');
        $course->save();

        return $course;

    }
}
