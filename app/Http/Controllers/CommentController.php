<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{

    public function index()
    {
        $comment= \App\Comment::paginate(10);
        return Response::json(['data'=>$comment],200);
    }

    
    public function showCommentsbyPost($id)
    {
        $comfind =\App\Comment::where('post_id','=',$id)->get();
        if ($comfind)
        {
        return Response::json($comfind, 200);
        }
        else
        return Response::json(['error-->Not found !!'],404);
    }
  
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


    public function show($id)
    {
        $find = Comment::find($id);

        if (!$find) {
            return Response::json(['errmsg' => 'Not Found'], 404);
        } else {
            $find->childs->each(function ($c) {
                $c->childs;
            });
            return Response::json($find, 200);
        }
    }


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