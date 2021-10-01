<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    //API
    public function all(){
        $user = DB::table('users')->get();
        return response()->json($user,200);
    }
    public function show($id){
        $user = DB::table('users')->where('id',$id)->get();
        return response()->json($user,200);
    }
    
    public function edit($id, Request $request){
        $user = DB::table('users')->where('id',$id)->get();
        return response()->json($user,200);
    }

    public function update($id, Request $request){
        $user = DB::table('users')->where('id',$id)->update(['name' => $request->name]);
        return response()->json($user,200);
    }

    public function delete($id){
        DB::table('users')->where('id',$id)->delete();
        return response()->json(200);
    }

    public function search(Request $request){
        DB::table('users')
            ->where('email', 'LIKE', '%' . $request->query . '%')
            ->get();    
        return response()->json(200);
    }
    //WEB
    public function createForm(Request $request){
        $res = Http::post('http://localhost/konecta-app/public/api/auth/register', [
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);
        if ($res->successful()){
           return redirect()->route('dashboard');
        }else{
            return redirect()->back()->withErrors(['The password or email is incorrect', '']);
        }
    }

    public function deleteForm($id){
        $res = Http::delete('http://localhost/konecta-app/public/api/users/'.$id);
        if ($res->successful()){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->withErrors(['The password or email is incorrect', '']);
        }
    }
    
}
