<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function login(Request $request)
    {
        $u = User::where('name',$request->input('name'));
        $user = $u->first();
        if(!empty($user))
        {
            if(Hash::check($request->input('password'),$user->password))
            {
                return Response::json('The User Find!!',200);
            }
            else
            {
                return Response::json('The User is Not Found',404);
            }
        }
        else
        {
            return Response::json('The User is Not Found',404);
        }
    }

    public function logout()
    {
        
    }

    public function register(Request $request)
    {
        $user = new \App\User;
        $rule = [
            'name' => 'required|min:5',
            'email' => 'required|E-Mail',
            'password' => 'required|min:6',
        ];
        $validator = Validator::make($request->input(), $rule);
        if ($validator->fails()) {
            return Response::json($validator->messages(), 403);
        } else {
            $create = $user::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);
            return Response::json($create->orderBy('id', 'desc')->first(), 200);
        }
    }


        public function adminreg(Request $request)
    {
        $user=new \App\User;
        $rule=[
            'name'=> 'required|min:5',
            'email'=>'required|E-Mail',
            'password'=>'required|min:6',
            'access'=>'boolean'
        ];
        $validator=Validator::make($request->input() , $rule);
        if($validator->fails())
        {
            return Response::json($validator->messages(),403);
        }
        else
        {

            if($user::sea||$user->name==$request->input('name')) {
                $create = $user::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'access' => $request->input('access')
                ]);
                return Response::json($create->orderBy('id', 'desc')->first(), 200);
            }
        }
    }
}