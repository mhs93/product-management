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


//        switch ($type){
//            case 'product':
//                $data = $this->productList();
//            case 'category':
//                $data = $this->categoryList();
//            case 'subcategory':
//                $data = $this->subCategoryList();
//                break;
//        }


        $data = [];
        if ($type == 'product'){
            $data['products'] = $this->productList();
            $data['categories'] = $this->categoryList();
            $data['subcategories'] = $this->subCategoryList();
        }elseif ($type == 'category'){
            $data['categories'] = $this->categoryList();
        }elseif ($type == 'subcategory'){
            $data['subcategories'] = $this->subCategoryList();
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
