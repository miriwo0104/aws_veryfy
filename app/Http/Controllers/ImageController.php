<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageController extends Controller
{
    public function input()
    {
        return view('images.input');
    }

    public function upload(Request $request)
    {        
        $this->validate($request, [
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
        ]);

        if ($request->file('file')->isValid([])) {
                 
            $filepath = Storage::putFile('images', $request->file('file'), 'public');
            $filename = $request->file('file')->getClientOriginalName(). '.' . $request->file('file')->getClientOriginalExtension();
            $input_info = new Image();

            $input_info->filepath = $filepath;
            $input_info->filename = $filename;
            $input_info->save();
            return redirect('/');
        }else{
            return redirect('/upload/image');
        }
    }

    public function output()
    {
        $image_infos = Image::select('*')->get();
        return view('images.output', ['image_infos' => $image_infos]);
    }
}
