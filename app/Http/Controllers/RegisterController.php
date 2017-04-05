<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function login(Request $request)
    {
        $u = User::where('name', $request->input('name'));
        $user = $u->first();

        if (!empty($user))
        {
            if (Hash::check($request->input('password'), $user->password))
            {
                return Response::json('The User Find!!', 200);
            }
            else
            {
                return Response::json('The User is Not Found', 404);
            }
        }
        else
        {
            return Response::json('The User is Not Found', 404);
        }
    }

    public function logout()
    {
        redirect('/');
        return Response::json('The user exit',200);

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

        if ($validator->fails())
        {
            return Response::json($validator->messages(), 403);
        }

        else

        {
            $finduser = DB::table('users')->where('name', $request->input('name'))->count();
            $findemail = DB::table('users')->where('email', $request->input('email'))->count();

            if ($finduser == 0 && $findemail == 0) {
                $create = $user::create([
                    'name' => $request->input('name'),
                    'password' => bcrypt($request->input('password')),
                    'email' => $request->input('email'),
                ]);
                return Response::json($create->orderBy('id', 'desc')->first(), 200);
            }
            else
            {
                return Response::json(['User already exists !'], 403);
            }

        }
    }
    
    public function alluser()
    {
        $users= new \App\User;
        return Response::json($users->paginate(15),200);
    }
    
    public function adminreg(Request $request)
    {
        $user = new \App\User;

        $rule = [
            'name' => 'required|min:5',
            'email' => 'required|E-Mail',
            'password' => 'required|min:6',
            'access' => 'boolean'
        ];

        $validator = Validator::make($request->input(), $rule);

        if ($validator->fails())
        {
            return Response::json($validator->messages(), 403);
        }

        else
        {
            $finduser = DB::table('users')->where('name', $request->input('name'))->count();
            $findemail = DB::table('users')->where('email', $request->input('email'))->count();

            if ($finduser == 0 && $findemail == 0) {
                $create = $user::create([
                    'name' => $request->input('name'),
                    'password' => bcrypt($request->input('password')),
                    'email' => $request->input('email'),
                    'access' => $request->input('access'),
                ]);
                return Response::json($create->orderBy('id', 'desc')->first(), 200);
            }

            else
            {
                return Response::json(['User already exists !'], 403);
            }

        }
    }
}