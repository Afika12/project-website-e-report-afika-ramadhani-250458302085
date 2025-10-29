<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataUserController extends Controller
{
   public function index(){
    $user = user::all();
     return view('Admin.data-user.indexDataUser', compact('user'));
   }
   public function formDataUser(){
      return view('admin.data-user.createDataUser');
   }
   public function createDataUser(Request $request){
      // validasi input
      $request->validate([
         'name' => 'required|string|max:255',
         'username' => 'required|string|max:255|unique:users',
         'email' => 'required|string|email|max:255|unique:users',
         'password' => 'required|string|min:5',
         'jenis_kelamin' => 'required|in:P,L',
         'telp' => 'nullable|string|max:13'
      ]);
      User::create([
         'name' => $request->name,
         'email' => $request->email,
         'username' => $request->username,
         'jenis_kelamin' => $request->jenis_kelamin,
         'telp' => $request->telp,
         'role' => 2,
         'password' => Hash::make($request->password),
      ]);

      return redirect()->route('index.data-user');
   }
      public function editDataUser(request $request){
      $user = User::findOrFail($request->id);
      return view('admin.data-user.editDataUser', compact('user'));
  
  
   }

   public function updateDataUser(request $request){
      $user = User::findOrfail($request->id);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->telp = $request->telp;
      $user->jenis_kelamin = $request->jenis_kelamin;
      $user->username = $request->username;
      if($request->password){
         $user->password = Hash::make($request->password);
      }
      $user->update();
      return redirect()->route('index.data-user');
   }
   public function deleteDataUser(request $request){
      $user = User::findOrfail($request->id);
      $user->delete();
      return redirect()->back();
   }
   
}
