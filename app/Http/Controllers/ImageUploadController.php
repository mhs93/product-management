<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use function PHPUnit\Runner\validate;

class ImageUploadController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('frontend.images.images',compact('images'));
    }

    public function store(Request $request)
    {
        validate([
            'image' => 'required',
            'name' => 'required',
        ]);

        $image = $request->image;
        $name = $request->name;

    }
}
