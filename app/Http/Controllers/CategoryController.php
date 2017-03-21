<?php

namespace App\Http\Controllers;
use App\Category;
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
        return $all->all();
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
            'parent_id'=>'required'
        ];
        $validator=Validator::make($request->input(),$rule);
        if ($validator->fails())
        {
            return 'data is invalid !!!';
        }
        else
        {
            $objcat=new Category;
            $create=$objcat::create([
                'name'=>$request->input('name'),
                'parent_id'=>$request->input('parent_id')
            ]);
            return $create->orderBy('id','desc')->first();

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
        $objcat=new Category;
        $findone=$objcat->find($id);
        return $findone;
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
            'parent_id' => 'required'
        ];
        $validator = Validator::make($request->input(), $rule);
        if ($validator->fails()) {
            return 'data is invalid !!!';
        } else {
            $object=Category::find($id);
            $object->update([
                'name' => $request->input('name'),
                'parent_id' => $request->input('parent_id')
            ]);
            return $object->find($id);

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
         Category::destroy($id);
    }
}