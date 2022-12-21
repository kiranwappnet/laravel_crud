<?php

namespace App\Http\Controllers;
use App\Models\States;
use App\Models\City;

use Illuminate\Http\Request;

class DropdownController extends Controller
{
    //

    public function state()
    {
        $data['states'] = States::get(["statename", "st_id"]);
        return view('employees', $data);
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)
                                    ->get(["cityname", "id"]);
                                      
        return response()->json($data);
    }
}
