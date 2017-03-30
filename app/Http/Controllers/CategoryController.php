<?php

namespace App\Http\Controllers;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all= new Category();
        $result= $all::all();
        return Response::json(['data'=>$result],200);
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
        $rule=[
            'name'=>'required',
            'parent_id'=>'Nullable|numeric|min:1'
        ];
        $validator=Validator::make($request->input(),$rule);
        if ($validator->fails())
        {
            $message=$validator->messages();
            return Response::json(['error'=>$message],404);
        }
        else
        {
            $objcat=new Category;
            $create=$objcat::create([
                'name'=>$request->input('name'),
                'parent_id'=>$request->input('parent_id'),
                'created_at'=>Carbon::now()
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
        $objcat= new Category;
        $findone= $objcat->find($id);
        $findone-> posts;
        $findone->childs;
        return Response::json(['id'=>$findone->id,'name'=> $findone->name,
            'Childs'=>$findone->childs()->get(['categories.id','categories.name'])],200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $rule = [
            'name' => 'required',
            'parent_id' => 'Nullable|Numeric|min:1'
        ];
        $validator = Validator::make($request->input(), $rule);
        if ($validator->fails())
        {
            $message=$validator->messages();
            return Response::json(['error'=>$message],404);
        }
        else
        {
            $object=Category::find($id);
            if (! $object)
            {
                return Response::json(['msgerr'=>'Not Found!!'],404);
            }
            else
            {
            $object->update([
                'name' => $request->input('name'),
                'parent_id' => $request->input('parent_id')
            ]);
            return Response::json(['data'=> $object->find($id)],200);
            }
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

        $destroy=Category::find($id);
        if( $destroy->deleted_at==null)
        {
            return Response::json(['errmsg'=>'Not Found'],404);
        }
        else
        {
            $destroy->delete;
            return Response::json(['mesg'=>$destroy->name . 'Deleted!!'] ,200);
        }
    }
}