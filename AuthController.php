<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\student;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    protected $guardName = 'student';
    protected $maxAttempts = 300;
    protected $decayMinutes = 200;
    protected $loginRoute;
    
    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
        $this->loginRoute = route('login');    
    }
    
    public function Login(){
        return view('student.login');
    }
    public function register(){
        return view('student.register');
    }
    public function registerstudent(Request $request){
        //dd('hi');
          $this->validate($request, [
              'name' => ['required', 'string', 'max:255'],
              'email'    => ['required', 'string', 'email', 'max:255', 'unique:student'],
              'password' => ['required', 'string', 'min:8','confirmed'],
            ]);
          $student = \App\student::create([
              'name' => $request->name,
              'phone' => $request->phone,
              'email' => $request->email,
              'password' => Hash::make($request->password),
            ]);
            if($student) {
              return redirect()->route('login')->with('msg', 'content page Add successfully ');
            } else {
              return redirect()->back()->with('error', 'Something went wrong while creating the course, please try again');
            }   
      }
    public function loginsubmit(Request $request){
       // dd('hii');
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        $credential = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
       // dd($credential);
        if (Auth::guard($this->guardName)->attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->route('index');
        } 
         else {
            //$this->incrementLoginAttempts($request);

            return redirect()->back()
                ->withInput()
                ->withErrors(["Incorrect user login details!"]);
        }
    }
   
    public function logout(){
       //  dd('hii');
        Auth::guard($this->guardName)->logout();
        Session::flush();
        return redirect()->guest($this->loginRoute);
    }

}
