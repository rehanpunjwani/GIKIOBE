<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\SemesterCourseView;
class SemesterCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = DB::table('semester_courses_view')->where('offered_status','1')->get();
        

        $id = DB::table('latest_semester')->value('semester_id');
        $offered_courses = DB::table('semester_courses')->where('semester_id', $id)->get();

        return view('semestercourses.index', compact(['courses','offered_courses']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($row_id)
    {
        $course = SemesterCourseView::find($row_id);

        DB::table('degree_plans')->where('degree_year_plan_id',$course->degree_year_plan_id)->where('course_id',$course->course_id)->update(['offered_status'=>0]);
        DB::table('semester_courses')->insert(['semester_id' => $course->semester_id,'course_id'=>  $course->course_id , 'instructor_id' => $course->instructor_id ]);
       $id = DB::table('semester_courses')->select('semester_course_id')->where('course_id',$course->course_id)->where('semester_id',$course->semester_id)->where('instructor_id',$course->instructor_id)->value('semester_course_id');
       DB::table('courses_marks_schemes')->insert(['semester_course_id' => $id]);


        // DB::table('courses_marks_schemes')->where('');

        return redirect('/semestercourses');
 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($semester_course_id)
    {
        
    }
}
