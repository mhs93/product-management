<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $type = $request->type ?? 'product';

        $data = [];
        if ($type == 'product'){
            $data = $this->productList();
        }elseif ($type == 'category'){
            $data = $this->categoryList();
        }elseif ($type == 'subcategory'){
            $data = $this->subCategoryList();
        }

        return view('frontend.dashboard',compact(['data','type']));
    }

    public function productList()
    {
        return $products = Product::all();
    }

    public function categoryList()
    {
        return $categories = Category::all();
    }

    public function subCategoryList()
    {
        return $subcategories = SubCategory::all();
    }
}
