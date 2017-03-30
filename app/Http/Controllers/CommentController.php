<?php

namespace App\Http\Controllers;

use App\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::json(['data'=>Comment::all()],200);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule=[
          'post_id'=>'required|Numeric|min:1',
          'parent_id' =>'Numeric|Nullable|min:1',
          'text'=>'required',
          'from'=>'required',
          'email'=>'required|E-Mail'
        ];
        $validator=Validator::make($request->input(),$rule);
            if($validator->fails())
            {
                $errmsg=$validator->messages();
                return Response::json(['errormsg'=>$errmsg]);
            }
        else
        {
            $comment=new Comment();
            $create=$comment::create([
                'post_id'=>$request->input('post_id'),
                'parent_id '=>$request->input('parent_id'),
                'text'=>$request->input('text'),
                'from'=>$request->input('from'),
                'email'=>$request->input('email'),
            ]);
            $create->save();
            return Response::json(['data'=>$create->orderBy('id','desc')->first()],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $find=Comment::find($id);
        if(!$find)
        {
            return Response::json(['errmsg'=>'Not Found'],404);
        }
        else
        {
            $find->childs;
            return Response::json(['id'=>$find],200);
        }

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy=Comment::find($id);
        if ($destroy)
        {
            $destroy->delete();
            $destroy->childs()->delete();
            return Response::json(['msg'=>'Deleted!!'],200);
        }
        else
        {
            return Response::json(['errmsg'=>'Not found'],404);

        }
    }
}