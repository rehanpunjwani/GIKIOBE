<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\CloPlo;
class CloPloController extends Controller
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
        $courses =  DB::table('clo_plo_view')->where('offered_by_faculty', $id)->get();
    

        return view('cloplos.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cloplos.create');
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
            'clo_id'=>'required',
            'plo_id'=>'required',
            'deg_year_id'=>'required',
            'course_id'=>'required',
            
            // 'job_title'=>'required'
        ]);

        $course = new CloPlo([
           
          
            'clo_id'=> $request->get('clo_id'),
            'plo_id'=>  $request->get('plo_id'),
            'deg_year_id'=> $request->get('deg_year_id'),
            'course_id'=> $request->get('course_id'),
       
        ]);

        $sem_course_id = DB::table('clo_plo_view')->select('sem_course_id')->where('course_id',$course->course_id)->value('sem_course_id');
        // DB::table('course_clo_marks_schemes')->insert(['sem_course_id' => $sem_course_id,'clo_id'=>  $course->clo_id ]);

        DB::table('course_clo_marks_schemes')->insert(['sem_course_id' => $sem_course_id,'clo_id'=>  $course->clo_id ]);

        DB::table('courses_clo_plos')->insert(['sem_course_id' => $sem_course_id,'clo_id'=>  $course->clo_id , 'plo_id' => $course->plo_id,'deg_year_id'=>$course->deg_year_id  ]);

        return redirect('/cloplos')->with('success', 'Contact saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($row_id)
    {
         $course = CloPlo::find($row_id);
        return view('cloplos.edit', compact('course'));
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
            
            'clo_id'=>'required',
            'plo_id'=>'required',
        

        
        ]);

        $course = CloPlo::find($row_id);
        $course->clo_id =  $request->get('clo_id');
        $course->plo_id = $request->get('plo_id');
        
       
 
       DB::table('courses_clo_plos')->where('sem_course_id',$course->sem_course_id)->where('clo_id',$course->clo_id)->where('plo_id',$course->plo_id)->where('deg_year_id',$course->deg_year_id)->update([
       'clo_id' => $course->clo_id, 'plo_id' => $course->plo_id ]);

        return redirect('/cloplos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($row_id)
    {
        $course = CloPlo::find($row_id);
        DB::table('courses_clo_plos')->where('sem_course_id',$course->sem_course_id)->where('clo_id',$course->clo_id)->where('plo_id',$course->plo_id)->delete();

        return redirect('/cloplos')->with('success', 'Contact deleted!');
    }
}
