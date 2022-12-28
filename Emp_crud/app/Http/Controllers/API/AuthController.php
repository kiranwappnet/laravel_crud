<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordReset;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Str;


class AuthController extends BaseController
{
    
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password'
        ]);
   
        if($validator->fails()){
            return Response()->json($this->sendError('Error validation', $validator->errors()));       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return Response()->json($this->sendResponse($success, 'User created successfully.'));
    }

    public function signin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $authUser = Auth::user(); 
            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken; 
            $success['name'] =  $authUser->name;
   
            return Response()->json($this->sendResponse($success, 'User signed in'));
        } 
        else{ 
            return Response()->json($this->sendError('Unauthorised.', ['error'=>'Unauthorised']));
        } 
    }


    // forgot password api method
    public function forgot_password(Request $request)
    {
        try{

            $user = User::where('email',$request->email)->get();
            if(count($user) > 0){
                $token = Str::random(40);
                $domain = URL::to('/'); 
                $url = $domain.'/reset-password?token='.$token;
                $data['url'] = $url;
                $data['email'] = $request->email;
                $data['title'] = "Password Reset";
                $data['body'] = "Please Click on below link";

                Mail::send('forgetpasswordmail',['data'=>$data],function($message) use ($data){

                    $message->to($data['email'])->subject($data['title']);

                });
                $datetime = Carbon::now()->format('y-m-d H:i:s');
                PasswordReset::updateOrCreate(
                    ['email' => $request->email],
                    [
                        
                        'token' => $token,
                        'created_at' => $datetime
                    ]
                    );
                    return response()->json(['success'=>true,'msg'=>'Please Check Your Mail to reset']);


            }
            else{
                return response()->json(['success'=>false,'msg'=>'User not found']);
            }

        }
        catch (\Exception $e){
        return response()->json(['success'=>false,'msg'=>$e->getMessage()]);

        }
       
    }

    public function resetpasswordview(Request $request)
    {
        $resetdata = PasswordReset::where('token',$request->token)->get();
        if(isset($request->token) && count($resetdata) > 0)
        {
            $user = User::where('email',$resetdata[0]['email'])->get();
            return view('reset-password',compact('user'));
        }
        else{
            return view('404');
        }
    }

    public function resetpassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed'
        ]);
        $user = User::find($request->id);
        $user->password = $request->password;
        $user->save();

        PasswordReset::where('email',$user->email)->delete();

        return "<h1>Your Password has been reset successfully</h1>";
    }

}
