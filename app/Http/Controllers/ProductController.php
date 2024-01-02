<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\CartProduct;
use App\Models\CartResep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
class ProductController extends Controller
{
     public function create_product()
    {
        
        $categoryproducts = CategoryProduct::pluck('name_category_products','id');
        $product=Product::all();
        return view('Admin.Product.create_product',compact('categoryproducts','product'));
    }

    public function store_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description'=> 'required',
            'price'=>'required',
            'stock'=>'required',
            'image' => 'required',
            'jenis' => 'required',
            'satuan' => 'required', 
           
        ]);
        $file = $request->file('image');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension(); 
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $path,
            'jenis' => $request->jenis,
            'satuan' => $request->satuan,
            'category_product_id'=>$request->category_product_id

        ]);

        //foreach ($request->product_id as $key => $product_id) {
        //$product = Product::find($product_id);
        //Unit::create([
          //  'satuan' => $request->satuan_unit[$key],
            //'price' => $request->price_unit[$key],
            //'product_id' => $product_id,
        //]);
        
    //}
    
        return Redirect::route('admin.index_product');
}

    public function index_product()
    {
        $categoryproducts = CategoryProduct::pluck('name_category_products','id');
        $products = Product::all();
        return view('Admin.Product.index_product', compact('products','categoryproducts'));
    }

    public function product_list(CategoryProduct $categoryproduct)
    {
        $products = $categoryproduct->products;
        $category = CategoryProduct::find($categoryproduct->id); $user_id = Auth::id();
        $cartTotal = CartProduct::where('user_id', $user_id)->count('product_id')
            + CartResep::where('user_id', $user_id)->count('resep_id');
        return view('product_list', compact('products','category','cartTotal'));
    }

    
    public function product_detail(Product $product) 
    {
        $user_id = Auth::id();
        $cartTotal = CartProduct::where('user_id', $user_id)->count('product_id')
            + CartResep::where('user_id', $user_id)->count('resep_id');
        return view('product_detail', compact('product','cartTotal'));
    }



    public function edit_product(Product $product)
    {
        $categoryproducts = CategoryProduct::pluck('name_category_products','id');
        return view('Admin.Product.edit_product', compact('product','categoryproducts'));}
     
        

    public function update_product(Product $product,Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description'=> 'required',
            'price'=>'required',
            'stock'=>'required',
            'image' => 'required',
            'jenis' => 'required',
            'satuan' => 'required'
        ]);
        $file = $request->file('image');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension(); 
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $path,
            'jenis' => $request->jenis,
            'satuan' => $request->satuan,
            'category_product_id'=>$request->category_product_id
        ]);
        return Redirect::route('admin.index_product', $product);
    }

      public function delete_product(Product $product)
    {

        Storage::delete('public/storage/'. $product->image);
        $product->delete();
        
        return Redirect::route('admin.index_product');}

        public function searchproduct(Request $request)
{
    $search = $request->input('search');
    $products = Product::where('name', 'like', '%' . $search . '%')->paginate();

    
		return view('Admin.Product.index_product',['products' => $products]);
}
    
}
