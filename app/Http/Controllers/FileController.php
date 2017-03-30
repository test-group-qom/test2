<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $rule = [
            'file' => 'required|max:100000|mimes:jpeg,jpg,png,mp4,avi,bmp'
        ];
        $validator = Validator::make($request->file(), $rule);
        if ($validator->fails())
        {
            return Response::json(['errmsg' => $validator->messages()],404);
        }
        else
        {
            $objfile = new File();
            $file = $request->file('file');
            $fileinfo = pathinfo($file->getClientOriginalName());
            $objfile->name = $fileinfo['filename'];
            $objfile->extention = $file->getClientOriginalExtension();
            $objfile->path = env('APP_URL') . '/upload/' . $fileinfo['basename'];
            $objfile->save();
            $request->file('file')->move(public_path('upload'), $fileinfo['basename']);
            return Response::json(['Success' => 'File is Uploaded!!','name'=>$objfile->name,
            'Link'=>$objfile->path,'extention'=>$objfile->extention], 201);
        }

    }
    public function all()
    {
        $showfile= File::all();
        return Response::json([$showfile]);
    }
    public function destroy($id)
    {
        $destroy=\App\File::find($id);
        if($destroy)
        {
            $destroy->delete();
            return Response::json(['Success' => 'File is Deleted!!']);
        }
        else
        {
            return Response::json(['error' => 'File is Not Found!!']);
        }

    }

}
