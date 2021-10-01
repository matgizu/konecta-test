<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    //API
    public function all(){
        $client = DB::table('clients')->get();
        return response()->json($client,200);
    }
    public function create(Request $request){
        $client = DB::table('clients')
                ->insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'identification' => $request->identification,
                    'address' => $request->address
                ]);
        return response()->json(["clients" => $client],200);
    }

    public function show($id){
        $client = DB::table('clients')->where('id',$id)->get();
        return response()->json($client,200);
    }
    /*
    public function edit($id, Request $request){
        $client = DB::table('clients')->where('id',$id)->get();
        return response()->json($client,200);
    }
*/
    public function update($id, Request $request){
        $client = DB::table('clients')->where('id',$id)
                ->update([
                    'name' => $request->name,
                    'identification' =>$request->identification,
                    'email' => $request->email,
                    'address' => $request->address
                ]);
        return response()->json($client,200);
    }

    public function delete($id){
        DB::table('clients')->where('id',$id)->delete();
        return response()->json(200);
    }

    //WEB

    public function createForm(Request $request){
        $res = Http::post('http://localhost/konecta-app/public/api/clients/create', [
            'name' => $request->name,
            'email' => $request->email,
            'identification' => $request->identification,
            'address' => $request->address,
        ]);
        if ($res->successful()){
           return redirect()->route('dashboard');
        }else{
            return redirect()->back()->withErrors(['The password or email is incorrect', '']);
        }
    }
    
    public function deleteForm($id){
        $res = Http::delete('http://localhost/konecta-app/public/api/clients/'.$id);
        if ($res->successful()){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->withErrors(['The password or email is incorrect', '']);
        }
    }

    public function edit($id){
       $client = DB::Table('clients')->where('id',$id)->first();
       return view('clients.edit',compact('client'));
    }

    public function updateForm(Request $request){
        $res = Http::put('http://localhost/konecta-app/public/api/clients/'.$request->id, [
            'name' => $request->name,
            'email' => $request->email,
            'identification' => $request->identification,
            'address' => $request->address,
        ]);
        if ($res->successful()){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->withErrors(['The password or email is incorrect', '']);
        }
    }

}
