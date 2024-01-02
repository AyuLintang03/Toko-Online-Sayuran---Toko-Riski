<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryResep;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class CategoryResepController extends Controller
{
    public function create_category_resep()
    {
        return view('Admin.CategoryResep.create_category_resep');
    }

    public function store_category_resep(Request $request)
    {
        $request->validate([
            'name_category_resep' => 'required',
            'image_category_resep' => 'required'
        ]);
        $file = $request->file('image_category_resep');
        $path = time() . '_' . $request->name_category_resep . '.' . $file->getClientOriginalExtension(); 
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        CategoryResep::create([
            'name_category_resep' => $request->name_category_resep,
            'image_category_resep' => $path
        ]);
        return Redirect::route('admin.index_category_resep');
    }
    public function index_category_resep()
    {
        $categoryreseps = CategoryResep::all();
        return view('Admin.CategoryResep.index_category_resep', compact('categoryreseps'));
    }

    public function edit_category_resep(CategoryResep $categoryresep)
    {
        return view('Admin.CategoryResep.edit_category_resep', compact('categoryresep'));}

        
    public function update_category_resep(CategoryResep $categoryresep,Request $request)
    {
        $request->validate([
            'name_category_resep' => 'required',
            'image_category_resep' => 'required'
        ]);
        $file = $request->file('image_category_resep');
        $path = time() . '_' . $request->name_category_resep . '.' . $file->getClientOriginalExtension(); 
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $categoryresep->update([
            'name_category_resep' => $request->name_category_resep,
            'image_category_resep' => $path
        ]);
        return Redirect::route('admin.index_category_resep', $categoryresep);
    }

    

      public function delete_category_resep(CategoryResep $categoryresep)
    {

        Storage::delete('public/storage/'. $categoryresep->image_category_resep);
        $categoryresep->delete();
        return Redirect::route('admin.index_category_resep');}

        public function searchcategoryresep(Request $request)
{
    $search = $request->input('search');
    $categoryreseps = Categoryresep::where('name_category_resep', 'like', '%' . $search . '%')->paginate();

    
		return view('Admin.CategoryResep.index_category_resep',['categoryreseps' => $categoryreseps]);
}

}
