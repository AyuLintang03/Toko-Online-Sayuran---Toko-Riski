<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Product;
use App\Models\CategoryResep;
use App\Models\CartProduct;
use App\Models\CartResep;
use App\Models\ResepProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ResepController extends Controller
{
    public function create_resep()
    {
        
        $categoryreseps = CategoryResep::pluck('name_category_resep','id');
        $products = Product::pluck('name','id');
        return view('Admin.Resep.create_resep',compact('categoryreseps','products'));
    }

public function store_resep(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'required',
        'price'=>'required',
        'category_resep_id' => 'required',
        'jenis' => 'required|array',
        'product_amount' => 'required|array',
        'product_id' => 'required|array',
    ]);

    $file = $request->file('image');
    $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
    Storage::disk('local')->put('public/' . $path, file_get_contents($file));

    $resep = Resep::create([
        'name' => $request->name,
        'description' => $request->description,
        'image' => $path,
        'price'=>$request->price,
        'category_resep_id' => $request->category_resep_id,
    ]);

   // $totalProductPrice = 0;

    foreach ($request->product_id as $key => $product_id) {
        $product = Product::find($product_id);
       // $totalProductPrice += $product->price * $request->product_amount[$key];
        
     
        ResepProduct::create([
            'amount' => $request->product_amount[$key],
            'jenis' => $request->jenis[$key],
            'resep_id' => $resep->id,
            'product_id' => $product_id,
        ]);
    }

    //$resep->update([
      //  'price' => $totalProductPrice,
    //]);

    return Redirect::route('admin.index_resep');
}



    public function index_resep()
    {
        $categoryreseps = CategoryResep::pluck('name_category_resep','id');
        $reseps = Resep::all();
        return view('Admin.Resep.index_resep', compact('reseps','categoryreseps'));
    }

    public function resep_list(CategoryResep $categoryresep)
    {
        $reseps = $categoryresep->reseps;
        $category = CategoryResep::find($categoryresep->id);
        $user_id = Auth::id();
        $cartTotal = CartProduct::where('user_id', $user_id)->count('product_id')
            + CartResep::where('user_id', $user_id)->count('resep_id');
         return view('resep_list', compact('reseps','category','cartTotal'));
    }

    public function edit_resep(Resep $resep)
    {
        $categoryreseps = CategoryResep::pluck('name_category_resep', 'id');
        $products = Product::pluck('name', 'id');
        $resepProducts = ResepProduct::where('resep_id', $resep->id)->get();
        
    return view('Admin.Resep.edit_resep', compact('resep', 'categoryreseps', 'products', 'resepProducts'));;}
     
    
     public function resep_detail(Resep $resep) 
    {
        
        $user_id = Auth::id();
        $reseps=Resep::all();
        $cartTotal = CartProduct::where('user_id', $user_id)->count('product_id')
            + CartResep::where('user_id', $user_id)->count('resep_id');
       $resepProducts = ResepProduct::where('resep_id', $resep->id)->get();
        return view('resep_detail', compact('resep','cartTotal','reseps','resepProducts'));
    }

    public function update_resep(Resep $resep,Request $request)
    {
      $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'required',
        'category_resep_id' => 'required',
        'jenis' => 'required|array',
        'price'=>'required',
        'product_amount' => 'required|array',
        'product_id' => 'required|array',
    ]);

    $file = $request->file('image');
    $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
    Storage::disk('local')->put('public/' . $path, file_get_contents($file));

    $resep->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'image' => $path,
        'category_resep_id' => $request->category_resep_id,
    ]);

   

    foreach ($request->product_id as $key => $product_id) {
        $product = Product::find($product_id);
        $resepProduct = ResepProduct::where('resep_id', $resep->id)
            ->where('product_id', $product_id)
            ->first();

        if ($resepProduct) {
            $resepProduct->update([
                'amount' => $request->product_amount[$key],
                'jenis' => $request->jenis[$key],
            ]);
        }
    }

    // Perbarui harga total resep
    //$resep->update([
      //  'price' => $totalProductPrice,
    //]);

    return Redirect::route('admin.index_resep', $resep);
    }
    
      public function delete_resep(Resep $resep)
    {

        Storage::delete('public/storage/'. $resep->image);
        $resep->delete();
        return Redirect::route('admin.index_resep');}

    public function searchresep(Request $request)
{
    $search = $request->input('search');
    $reseps =Resep::where('name', 'like', '%' . $search . '%')->paginate();

    
		return view('Admin.Resep.index_resep',['reseps' => $reseps]);
}

}
