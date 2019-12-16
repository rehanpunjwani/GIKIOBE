<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Semester::all();
        return view('semesters.index', compact('courses'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('semesters.create');
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
            'semester_type'=>'required',
            'semester_year'=>'required',
         
       
        ]);

        $contact = new Semester([
            'semester_type' => $request->get('semester_type'),
            'semester_year' => $request->get('semester_year'),
        
        ]);
        $contact->save();
        return redirect('/semesters')->with('success', 'Contact saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($semester_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($semester_id)
    {
        $course = Semester::find($semester_id);
        return view('semesters.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $semester_id)
    {
        $request->validate([
            'semester_type'=>'required',
            'semester_year'=>'required',
         
       
        ]);

        $contact = Semester::find($semester_id);
        $contact->semester_type =  $request->get('semester_type');
        $contact->semester_year = $request->get('semester_year');
      ;
        $contact->save();

        return redirect('/semesters')->with('success', 'Contact updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($semester_id)
    {
        $course = Semester::find($semester_id);
        $course->delete();

        return redirect('/semesters')->with('success', 'Contact deleted!');
    }
}
