<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\EmployeeJoined;
use App\Mail\EmployeeWelcomeMail;
use App\Models\Employee;
use App\Models\User;
use App\Models\States;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{


   
    public function index()
    {
        $user_id = Auth::user()->id;
        $employees = User::find($user_id)->employees()->orderBy('emp_id', 'asc')->get();
        $data = compact("employees");
        $data['states'] = States::get(["statename", "st_id"]);
        return view('employees', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'dob' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:10|numeric',
            'address' => 'required',
            'profile' => 'required|mimes:jpeg,png,jpg |max:4096',
            'resume' => "required|mimes:pdf|max:10000",
            'state' => 'required',
            'city' => 'required',
        ],

        $messages = [
            'profile.required' =>'Profile Picture is required.',
            'resume.required' => 'File is required.',
            'profile.mimes' => 'Only Jpeg,png and jpg files are allowed',

            'resume.mimes' => 'Only PDF files are allowed.',
            'state.required' => 'Please Select State',
            'city.required' => 'Please Select City',
        ]
    
    );

        $user_id = Auth::user()->id;

        $employee = new Employee();
        $employee->user = $user_id;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->lastname = $request->lastname;
        $employee->dob = $request->dob;
        $employee->email = $request->email;
        $employee->mobile = $request->mobile;
        $employee->address = $request->address;
        $employee->state = $request->state;
        $employee->city = $request->city;
        $profile = $request->file('profile')->getclientoriginalName();
        $request->profile->move('public/images',$profile);

        $employee->image = $profile;

        $resume = $request->file('resume')->getClientOriginalName();
        $request->resume->move('public/images',$resume);

        $employee->file = $resume;
        
        

        if ($employee->save()) {
            $email = $employee->email;
            $mail = [
                "template" => "employeejoined",
                "email" => $email,
                "body" =>  [
                    "name" => $employee->firstname,
                    "company" => Auth::user()->name,
                    "url" => url('/')
                ]
            ];
            SendEmail::dispatch($mail);
            return redirect()->route('employees');
        } else {
            return redirect()->route('employees')->withErrors(["error" => "Failed to create Employee"]);
        }
    }


   

    public function delete(Employee $employee)
    {
        $employee->delete();
        return redirect()->route("employees");
    }

    public function edit(Employee $employee)
    {
        $data = compact("employee");
        $data['states'] = States::get(["statename", "st_id"]);
        return view('employees', $data);
    }

    public function update(Employee $employee, Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'dob' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:10|numeric',
            'address' => 'required',
            'profile' => 'required|mimes:jpeg,png,jpg |max:4096',
            'resume' => "required|mimes:pdf|max:10000"
        ],

        $messages = [
            'profile.required' =>'Profile Picture is required.',
            'resume.required' => 'File is required.',
            'profile.mimes' => 'Only Jpeg,png and jpg files are allowed',

            'resume.mimes' => 'Only PDF files are allowed.',
        ]
    
    );
       

        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->lastname = $request->lastname;
        $employee->dob = $request->dob;
        $employee->email = $request->email;
        $employee->mobile = $request->mobile;
        $employee->address = $request->address;
        $employee->state = $request->state;
        $employee->city = $request->city;
        $profile = $request->file('profile')->getclientoriginalName();
        $request->profile->move('public/images',$profile);
        $employee->image = $profile;
        $employee->save();
        return redirect()->route('employees');
    }
}
