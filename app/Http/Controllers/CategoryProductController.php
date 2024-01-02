<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class CategoryProductController extends Controller
{
    public function create_category_product()
    {
        return view('Admin.CategoryProduct.create_category_product');
    }

    public function store_category_product(Request $request)
    {
        $request->validate([
            'name_category_products' => 'required',
            'image_category_products' => 'required'
        ]);
        $file = $request->file('image_category_products');
        $path = time() . '_' . $request->name_category_products . '.' . $file->getClientOriginalExtension(); 
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        CategoryProduct::create([
            'name_category_products' => $request->name_category_products,
            'image_category_products' => $path
        ]);
        return Redirect::route('admin.index_category_product');
        
    }

    public function index_category_product(CategoryProduct $categoryproduct)
    {
        $categoryproduct = CategoryProduct::all();
        return view('Admin.CategoryProduct.index_category_product', compact('categoryproduct'));}

    public function edit_category_product(CategoryProduct $categoryproduct)
    {
        return view('Admin.CategoryProduct.edit_category_product', compact('categoryproduct'));}
        
    public function update_category_product(CategoryProduct $categoryproduct,Request $request)
    {
        $request->validate([
            'name_category_products' => 'required',
            'image_category_products' => 'required'
        ]);
        $file = $request->file('image_category_products');
        $path = time() . '_' . $request->name_category_products . '.' . $file->getClientOriginalExtension(); 
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $categoryproduct->update([
            'name_category_products' => $request->name_category_products,
            'image_category_products' => $path
        ]);
        return Redirect::route('admin.index_category_product', $categoryproduct);
    }

      public function delete_category_product(CategoryProduct $categoryproduct, Request $request)
    {

        Storage::delete('public/storage/'. $categoryproduct->image_category_products);
        $categoryproduct->delete();
        return Redirect::route('admin.index_category_product');}

    public function searchcategoryproduct(Request $request)
{
    $search = $request->input('search');
    $categoryproduct = CategoryProduct::where('name_category_products', 'like', '%' . $search . '%')->paginate();

    
		return view('Admin.CategoryProduct.index_category_product',['categoryproduct' => $categoryproduct]);
}
}