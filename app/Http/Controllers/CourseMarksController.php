<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\CoursesMarksScheme;

class CourseMarksController extends Controller
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
        $id =  DB::table('instructor_courses')->where('instructor_id', $cid)->value('sem_course_id');

        // $data = DB::table('courses_marks_scheme')->get();
        // $data = DB::select('select * from student_clo_marks');
        if(is_array($id)){
            $size = count($id);
       
        $size = count($id);

 
        for ($i = 0; $i < $size; $i++)
        { $a  = $id[$i]->semester_course_id;
            $courses = DB::table('courses_marks_schemes')->where('semester_course_id',$a)->get();
     
        // $data = DB::table('courses_marks_scheme')->get();
        // $data = DB::select('select * from student_clo_marks');
        
 

        
        }

    }
    else{
        $courses = DB::table('courses_marks_schemes')->where('semester_course_id',$id)->get();


    }
        return view('coursesmarks.index', compact('courses'));
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
    public function edit($semester_course_id)
    {
        $course = CoursesMarksScheme::find($semester_course_id);
        return view('coursesmarks.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $semester_course_id)
    {
        $request->validate([
            
            'assignments_weightage'=>'required',
            'quizes_weightage'=>'required',
            'project_weightage'=>'required',
            'class_participation_weightage'=>'required',
            'mid_weightage'=>'required',
            'final_weightage'=>'required',

        
        ]);

        $course = CoursesMarksScheme::find($semester_course_id);
        $course->assignments_weightage =  $request->get('assignments_weightage');
        $course->quizes_weightage =  $request->get('quizes_weightage');
        $course->project_weightage = $request->get('project_weightage');
        $course->class_participation_weightage = $request->get('class_participation_weightage');
        $course->mid_weightage =  $request->get('mid_weightage');
        $course->final_weightage = $request->get('final_weightage');
        $course->save();

        return redirect('/coursesmarks');
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
