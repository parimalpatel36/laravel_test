<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Controllers\student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
class student extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:student');
    }
    public function index(){
        // $student = \App\student::all();
        
        $student =  \App\student::where("id",Auth::guard('student')->user()->id)->get();
        //dd($student);
        if(Auth::user()->role == 1){
          $student = \App\student::all();
        }
        return view('student.index',compact('student'));
    }

    public function destroy($id){
   
        $stu = \App\student::find($id);
        $stu->delete();
        return response()->json([
          'message' => 'Data deleted successfully!'
        ]);
    }
    public function edit($id){
      $student = \App\student::find($id);
      if($student) {
        return view('student.edit', compact('student'));
      } else {
        return redirect()->back()->with('error', 'Student not found, please try again');
      }
    }
    public function update(Request $request,$id){ 
      //dd('hii');
      $students = \App\student::find($id);
      if($students) {
        $students->name  = $request->name;
        $students->phone  = $request->phone;
        $students->email  = $request->email;  
        $students->save();
  
        // return redirect()->route('index')->with('msg', 'Student update successfully ');
      }
      // else
      // {
      //   return redirect()->back()->with('error', 'Student not found, please try again');
      // }
     

    }
}
