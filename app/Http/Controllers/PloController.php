<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PloTranscript;
class PloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('plotranscript.index');
    }
    public function fun(Request $request)
    {
        $id = $request->input('student_id');
        $courses = DB::select("select * from plo_trascript_view where student_id = '$id'"); 
        return view('plotranscript.edit', compact('courses'));

    }
  
}
