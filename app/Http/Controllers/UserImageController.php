<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;


class UserImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image64:jpeg,jpg,png',
            'width' => 'required|integer|min:400',
            'height' => 'required|integer|min:400',
            'size' => 'required|integer|max:10485760',
        ]);
        //Divides the image name into filename and extension
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        //We save a version in its original size or bigger to use in classifieds.show zoom
        $image = (Image::make($request->image)->save('storage/uploads/original' . $fileName)->save());
        //This smaller version will be used for classifieds.show
        $image = (Image::make($request->image)->save('storage/uploads/small' . $fileName)->resize(null, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->save());
        //This tiny version will be used for edits, questions, etc.
        $image = (Image::make($request->image)->save('storage/uploads/' . $fileName)->fit(200,200)->save());
        return $fileName;
    }

    public function destroy(Request $request){
        $images = $request->images;
        foreach($images as $image){
            if(File::exists("storage/uploads/" . $image['URI'])){
                File::delete("storage/uploads/" . $image['URI']);
            }
        }
    }
}

