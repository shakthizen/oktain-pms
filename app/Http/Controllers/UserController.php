<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login(Request $request){
        //$request->merge(json_decode($request->json()->all(),true));
        $validator = Validator::make($request->json()->all(), [
            'username'=>'required',
            'password'=>'required|min:5'
        ]);

        if ($validator->passes()) {
            $user = User::where('username',$request->json()->get('username'))->first();
            if($user && Hash::check($request->json('password'),$user->password)){
                return response()->json(['status'=>'Success', 'api_token'=>$user->api_token, 'user'=>$user]);
            }else{
                return response()->json(['status'=>'Failed']);
            }
        } else {
            return response()->json(['status'=>'Validation Error']);
        }
    }

    public function register(Request $request){
        //$request->merge(json_decode($request->json()->all(),true));
        $validator = Validator::make($request->json()->all(), [
            'name'=>'required',
            'username'=>'required|min:5',
            'mobile'=>'required|min:5',
            'password'=>'required|min:5'
        ]);

        if ($validator->passes()) {

            $user = new User();
            $user->name=$request->json('name');
            $user->username=$request->json('username');
            $user->mobile=$request->json('mobile');
            $user->password=Hash::make($request->json('password'));
            $user->api_token=str_random(60);

            if($user->save()){
                return response()->json(['status'=>'Success', 'api_token'=>$user->api_token, 'user'=>$user]);
            }else{
                return response()->json(['status'=>'Failed']);
            }
        } else {
            return response()->json(['status'=>'Validation Error']);
        }
    }

    public function getAll(){
        return response()->json(User::all());
    }

    public function checkToken(Request $request){
        //dd($request);

        $user = Auth::user();
        if($user){
            return response()->json(['status'=>'Success', 'user'=>$user]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }
}
