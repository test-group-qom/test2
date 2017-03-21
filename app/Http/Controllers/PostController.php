<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Post;
use Illuminate\Http\Request;

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
        return $objpost::all();
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
            'title'=>'required',
            'text'=>'required'
        ];
        $validator=Validator::make($request->input(),$rule);
        if($validator->fails())
        {
            return 'invalid data!!';
        }
        else {
            $objpost = new Post;
            $create = $objpost::create([
            'title'=> $request->input('title'),
            'text' => $request->input('text')
            ]);
            return  $create->orderBy('id','desc')->first();
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
     return $findpost;
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
                'title'=>'required',
                'text'=>'required'
            ];
        $validator=Validator::make($request->input(),$rule);
        if($validator->fails())
        {
            return 'invalid data!!';
        }
        else {

            $object=Post::find($id);
             $object->update([
                'title' => $request->input('title'),
                'text' => $request->input('text')
            ]);
            $object->update();
            return 'Updated!!';
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
        Post::destroy($id);
    }
}