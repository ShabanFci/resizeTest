<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mxmm\ImageResize\Facade as ImageResize;
use Intervention\Image\ImageManagerStatic as Image;

class ImageResizeController extends Controller
{

	public function imageResize(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $sizes=array(100,100,200,200,300,300);
        for($i=0;$i<=4;$i++){
	        $image       = $request->file('image');
		    $filename    = time().'.'.$i.'.'.$image->getClientOriginalName();
		    $image_resize1 = Image::make($image->getRealPath());              
		    $image_resize1->resize($sizes[$i], $sizes[$i+1]);
		    $i++;
		    $image_resize1->save(public_path('images/' .$filename));
		    
        }
        
        return back()->with('success','You have successfully upload image.');       
    }
}