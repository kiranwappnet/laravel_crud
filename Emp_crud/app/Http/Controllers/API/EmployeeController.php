<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Models\Employee;
use App\Http\Resources\Employees as EmployeeResource;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\JsonResponse;

class EmployeeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $employee = Employee::orderBy('created_at', 'asc')->get();
        return response()->json($this->sendResponse(EmployeeResource::collection($employee),'Employee Found.'));

    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user'=>'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'dob' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:10|numeric',
            'address' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg |max:4096',
            'file' => "required|mimes:pdf|max:10000",
            'state' => 'required',
            'city' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($this->sendError($validator->errors()));       
        }

       
        $employee = Employee::create($input);
        
        return Response()->json($this->sendResponse(new EmployeeResource($employee), 'Employee created.'));
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
     * @return \Illuminate\Http\JsonResponse
     */
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) {
        return Response()->json(Employee::findorFail($id)); //searches for the object in the database using its id and returns it.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user'=>'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'dob' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:10|numeric',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($this->sendError($validator->errors()));       
        }
        $employee->user = $input['user'];
        $employee->firstname = $input['firstname'];
        $employee->middlename = $input['middlename'];
        $employee->lastname = $input['lastname'];
        $employee->dob = $input['dob'];
        $employee->email = $input['email'];
        $employee->mobile = $input['mobile'];
        $employee->address = $input['address'];
        $employee->state = $input['state'];
        $employee->city = $input['city'];
        $employee->save();
        
        return Response()->json($this->sendResponse(new EmployeeResource($employee), 'Employee updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    
    public function destroy(Employee $employees)

    {
        $employees->delete();
        return Response()->json($this->sendResponse([], 'Employee Deleted'));

    }
}
