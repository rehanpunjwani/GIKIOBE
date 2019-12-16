<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\course;
use DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'course_id'=>'required',
            'offered_by_faculty'=>'required',
            'courseName'=>'required',
            'degree_year_plan_id'=>'required',
            'semester_no'=>'required',
            'semester_type'=>'required',


        ]);

        $course = new Course([
            'course_id' => $request->get('course_id'),
            'offered_by_faculty' => $request->get('offered_by_faculty'),
            'courseName' => $request->get('courseName'),
            'degree_year_plan_id' => $request->get('degree_year_plan_id'),
            'semester_no' => $request->get('semester_no'),
            'semester_type' => $request->get('semester_type'),
            'pre_requisite_course' => $request->get('pre_requisite_course'),



        ]);
        DB::table('courses')->insert(['course_id' => $course->course_id,'offered_by_faculty'=>  $course->offered_by_faculty , 'courseName' => $course->courseName ]);
        DB::table('degree_plans')->insert(['course_id' => $course->course_id,'degree_year_plan_id'=>  $course->degree_year_plan_id , 
        'semester_no' => $course->semester_no,'semester_type' => $course->semester_type,'course_type' =>1,'pre_requisite_course' => $course->pre_requisite_course  ]);

        return redirect('/courses')->with('success', 'Course saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courses = Course::all();

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($row_id)
    {
        //
        $course = Course::find($row_id);
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $row_id)
    {
        $request->validate([
            
            'course_id'=>'required',
            'offered_by_faculty'=>'required',
            'courseName'=>'required',
      
        

        
        ]);

        $course = Course::find($row_id);
        $course->course_id =  $request->get('course_id');
        $course->offered_by_faculty =  $request->get('offered_by_faculty');
        $course->courseName = $request->get('courseName');
       
    
       
 
       DB::table('courses')->where('course_id',$course->course_id)->where('offered_by_faculty',$course->offered_by_faculty)->update(['course_id' => $course->course_id,
       'offered_by_faculty' => $course->offered_by_faculty, 'courseName' => $course->courseName ]);

        return redirect('/courses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($row_id)
    {
        $course = Course::find($row_id);
        DB::table('courses')->where('course_id',$course->course_id)->where('offered_by_faculty',$course->offered_by_faculty)->delete();

        return redirect('/courses')->with('success', 'Contact deleted!');
        
    }
    public function fun(){
        $cid ='1';
        // $id = DB::select("select sem_course_id  from instructor_courses where instructor_id='$cid' ")->value();
        $id =  DB::table('instructor_courses')->where('instructor_id', $cid)->value('sem_course_id');

        // $data = DB::table('courses_marks_scheme')->get();
        // $data = DB::select('select * from student_clo_marks');
        $data = DB::table('courses_marks_schemes')->where('semester_course_id',$id)->get();
 
        return($data);
    }
}
