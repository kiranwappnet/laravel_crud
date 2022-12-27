<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\BaseController;
use App\Models\Employee;
use App\Http\Resources\Employees;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("employee",[EmployeeController::class,'index']);
Route::resource('employee',EmployeeController::class);

Route::post('/employee', [EmployeeController::class, 'store']);
Route::put("/employee/employee",[EmployeeController::class,'update']);

