<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
class UserController extends Controller
{
    public function index()
    {
        $users = auth()->user();
        
        return response()->json([
            'users' => $users,
            'status' => 200
        ]);
    }

    public function index_user()
    {
        $users = User::all();
        return view('Admin.User.index_user', compact('users'));
    }

     public function showProfile()
    {
        $user = Auth::user();

        return view('user_profile', compact('user'));
    }
    

    public function update_profile(User $user, Request $request)
{

    $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|email|max:255|unique:users,email,' . $user->id, 
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ]);
    
        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $path = time() . '_' . $request->username . '.' . $file->getClientOriginalExtension(); 
        Storage::disk('public')->put($path, file_get_contents($file));
    } else {
        $path = $user->image; 
    }

    $user->update([
        'username' => $request->username,
        'email' => $request->email,
        'image' => $path,
    ]);

    

    return redirect()->route('user_profile')->with('success', 'Profile updated successfully.');
}
 
    public function searchUser(Request $request)
    {
    $search = $request->input('search');
    $users = User::where('username', 'like', '%' . $search . '%')->paginate();

    
		return view('Admin.User.index_user',['users' => $users]);
    }

    public function delete_user(User $user)
    {
        Storage::delete('public/storage/'. $user->image);
        $user->delete();
        return Redirect::route('admin.index_user');}

    public function edit_user(User $user)
    {
        return view('Admin.Resep.edit_user', compact('users'));}
     
    
    public function update_user(User $user, Request $request)
    {
        $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|email|max:255|unique:users,email,' . $user->id, 
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        'use_default_image' => 'nullable|boolean', 
    ]);
    
    // ...

    if ($request->hasFile('image')) {
    } elseif ($request->has('use_default_image') && $request->input('use_default_image')) {
        $path = 'build/assets/img/default-profile-image.png';
    } else {
        $path = $user->image;
    }
    $user->update([
        'username' => $request->username,
        'email' => $request->email,
        'image' => $path,
    ]);
        return Redirect::route('admin.index_resep', $resep);
    }

     
}
