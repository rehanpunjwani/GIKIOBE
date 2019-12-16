<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\DegreePlan; 

class DegreePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cid = Auth::id();
      
        $id =  DB::table('instructors')->select('instructor_faculty')->where('instructor_id', $cid)->value('instructor_faculty');
        $courses =  DB::table('degree_plan_dean_view')->where('offered_by_faculty', $id)->get();

        return view('degreeplans.index', compact('courses'));

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
        $course = DegreePlan::find($row_id);
        return view('degreeplans.edit', compact('course'));
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
            'semester_type'=>'required',
            'offered_status'=>'required',
            'instructor_id'=>'required',
        

        
        ]);

        $course = DegreePlan::find($row_id);
        $course->course_id =  $request->get('course_id');
        $course->semester_type =  $request->get('semester_type');
        $course->offered_status = $request->get('offered_status');
        $course->pre_requisite_course = $request->get('pre_requisite_course');
        $course->instructor_id =  $request->get('instructor_id');
    
       
 
       DB::table('degree_plans')->where('course_id',$course->course_id)->where('degree_year_plan_id',$course->degree_year_plan_id)->update(['course_id' => $course->course_id,
       'semester_type' => $course->semester_type, 'offered_status' => $course->offered_status,'pre_requisite_course' => $course->pre_requisite_course,'instructor_id' => $course->instructor_id ]);

        return redirect('/degreeplans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($row_id)
    {
        $course = DegreePlan::find($row_id);
        DB::table('degree_plans')->where('course_id',$course->course_id)->where('degree_year_plan_id',$course->degree_year_plan_id)->delete();

        return redirect('/degreeplans')->with('success', 'Contact deleted!');
    }
}
