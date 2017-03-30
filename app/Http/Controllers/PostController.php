<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Post;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $objpost=new Post;
        if($objpost)
        {
            return Response::json(['data'=>$objpost::all()]);
        }
        return Response::json(['No Value'],404);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule=
        [
            'file_id'=>'Nullable|numeric|min:1',
            'user_id'=>'required|numeric|min:1',
            'title'=>'required',
            'text'=>'required'
        ];
        $validator=Validator::make($request->input(),$rule);
        if($validator->fails())
        {
            $message=$validator->messages();
            return Response::json(['data'=>$message],404);
        }
        else {
            $objpost = new Post;
            $create = $objpost::create([
            'title'=> $request->input('title'),
            'text' => $request->input('text'),
            'user_id'=>$request->input('user_id'),
            'file_id'=>$request->input('file_id'),
            ]);
            return Response::json(['data'=>$create->orderBy('id','desc')->first()],201);
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
     $findpost=Post::find($id);
        if(!$findpost)
        {
            return Response::json(['errmsg'=>'Not found'],404);
        }
        else
        {
            $findpost->categories;
            $findpost->comments;
            $findpost->user;
             return Response::json([
                 'id'=>$findpost->id,
                 'title'=>$findpost->title,'text'=>$findpost->text,
                 'cat'=> $findpost->categories()->get(['categories.id','categories.name',]),
                 'comment'=>$findpost->comments()->get(['comments.id','comments.text',
                 'comments.from','comments.email']),
                 'users'=>$findpost->user()->get(['users.id','users.name']),
                 'files'=>$findpost->files()->get(['files.id','files.name'])
             ],200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rule=
            [
                'file_id'=>'Nullable|numeric|min:1',
                'user_id'=>'required|numeric|min:1',
                'title'=>'required',
                'text'=>'required'
            ];
        $validator=Validator::make($request->input(),$rule);
        if($validator->fails())
        {
            $message=$validator->messages();
            return Response::json(['data'=>$message],404);
        }
        else
        {
            $object=Post::find($id);
            if (! $object)
            {
                return Response::json(['errmsg'=>'Not found'],404);
            }
            $object->update([
                'title'=> $request->input('title'),
                'text' => $request->input('text'),
                'user_id'=>$request->input('user_id'),
                'file_id'=>$request->input('file_id'),
            ]);
            return Response::json(['data'=>$object::orderBy('id','desc')->first()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $des=Post::find($id);
        if(!$des)
        {
            return Response::json(['msg'=>'Not found'],404);
        }
        else
        {
            $des->delete;
            return Response::json(['msg'=>'Deleted!!!'],200);
        }
    }
}
