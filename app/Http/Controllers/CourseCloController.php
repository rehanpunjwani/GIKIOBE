<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\CourseCloMarksScheme;
class CourseCloController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cid =Auth::id();
        // $id = DB::select("select sem_course_id  from instructor_courses where instructor_id='$cid' ")->value();
        $id =  DB::table('instructor_courses')->select('sem_course_id')->where('instructor_id', $cid)->get();
        
       
       


        $size = sizeof($id);
   
print_r($size);
    
      for ($i = 0; $i < $size; $i++)
        { $a  = $id[$i]->sem_course_id;
           
         $courses[$i] = DB::table('clo_view')->where('sem_course_id',$a)->get();
         $course_name[$i] = DB::table('course_id_view')->where('semester_course_id', $a)->value('course_id');

     
        // $data = DB::table('courses_marks_scheme')->get();
        // $data = DB::select('select * from student_clo_marks');
        
 

        
        }
    // }
//     else{
        
// print_r($id);
//         $id =  DB::table('instructor_courses')->select('sem_course_id')->where('instructor_id', $cid)->value('sem_course_id');
//         $courses = DB::table('clo_view')->where('sem_course_id',$id)->get();
//          $course_name = DB::table('course_id_view')->where('semester_course_id', $id)->value('course_id');
//     }

         return view('clomarks.index', compact(['courses','course_name']));
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
        $request->validate([
            'assignments_weightage'=>'required',
            'quizes_weightage'=>'required',
            'project_weightage'=>'required',
            'class_participation_weightage'=>'required',
            'mid_weightage'=>'required',
            'final_weightage'=>'required',
            // 'job_title'=>'required'
        ]);

        $contact = new CoursesMarksScheme([
           
          
            'assignments_weightage'=> $request->get('assignments_weightage'),
            'quizes_weightage'=>  $request->get('quizes_weightage'),
            'project_weightage'=> $request->get('project_weightage'),
            'class_participation_weightage'=> $request->get('class_participation_weightage'),
            'mid_weightage'=> $request->get('mid_weightage'),
            'final_weightage'=>  $request->get('final_weightage')
        ]);
        $contact->save();
        return redirect('/coursesmarks')->with('success', 'Contact saved!');
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
    public function edit($clo_sem_id)
    {
        $course = CourseCloMarksScheme::find($clo_sem_id);
        return view('clomarks.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clo_sem_id)
    {
        $request->validate([
            
            'assignments_weightage'=>'required',
            'quizes_weightage'=>'required',
            'project_weightage'=>'required',
            'class_participation_weightage'=>'required',
            'mid_weightage'=>'required',
            'final_weightage'=>'required',

        
        ]);

        $course = CourseCloMarksScheme::find($clo_sem_id);
        $course->assignments_weightage =  $request->get('assignments_weightage');
        $course->quizes_weightage =  $request->get('quizes_weightage');
        $course->project_weightage = $request->get('project_weightage');
        $course->class_participation_weightage = $request->get('class_participation_weightage');
        $course->mid_weightage =  $request->get('mid_weightage');
        $course->final_weightage = $request->get('final_weightage');
        $course->setTable('course_clo_marks_schemes');
 
       DB::table('course_clo_marks_schemes')->where('sem_course_id',$course->sem_course_id)->where('clo_id',$course->clo_id)->update(['assignments_weightage' => $course->assignments_weightage,'quizes_weightage'=>  $course->quizes_weightage ,
        'project_weightage' => $course->project_weightage, 'class_participation_weightage' => $course->class_participation_weightage,'mid_weightage' => $course->mid_weightage,'final_weightage' => $course->final_weightage ]);
    

        return redirect('/clomarks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($semester_course_id)
    {
        //
        $contact = CoursesMarksScheme::find($semester_course_id);
        $contact->delete();

        return redirect('/coursesmarks')->with('success', 'Contact deleted!');
    }

}
