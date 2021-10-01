<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SessionController extends Controller
{
    public function login(Request $request){
        $response = Http::post('http://localhost/konecta-app/public/api/auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        if ($response->successful()){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->withErrors(['The password or email is incorrect', '']);
        }
    }

    public function logout(){
        $response = Http::post('http://localhost/konecta-app/public/api/auth/logout');
        if ($response->successful()){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->withErrors(['Check the token', '']);
        }
    }

    public function sing_up(){
        return view('create');
    }

    public function registerForm(Request $request){
        $response = Http::post('http://localhost/konecta-app/public/api/auth/register',[
            'email' => $request->email,
            'password' => $request->password
        ]);
        if ($response->successful()){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->withErrors(['Check the token', '']);
        }
    }

    public function dashboard(){
        $getUsers = Http::get('http://localhost/konecta-app/public/api/users/all');
        $getClients = Http::get('http://localhost/konecta-app/public/api/clients/all');
        $users = $getUsers->json();
        $clients = $getClients->json();
        return view('dashboard',compact('users','clients'));
    }
}
