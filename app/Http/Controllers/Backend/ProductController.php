<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Validate;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'color' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $input = $request->all();
        $data['name'] = $input['name'];
        $data['category_id'] = $input['category_id'];
        $data['subcategory_id'] = $input['subcategory_id'];
        $data['image'] = $input['image'];
        $data['color'] = $input['color'];
        $data['price'] = $input['price'];
        $data['quantity'] = $input['quantity'];

        Product::create($data);

        return response()->json(['msg' => 'product saved successfully']);
    }
}
