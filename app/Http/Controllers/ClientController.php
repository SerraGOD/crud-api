<?php

namespace App\Http\Controllers;
use App\Mail\WelcomeMail;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.   
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::all();
        return $client;
    }

    public function createClient(Request $request){
        $request->validate([
            "name" => 'required|string|max:35',
            "surname" => 'required|string|max:35',
            "direction" => 'required|string|max:75',
            "phone" => 'required|string|max:25',
            "email" => "required|string|email|max:255|unique:users"
        ]);

        $client = Client::create([
            "name" => $request->name,
            "surname" => $request->surname,
            "direction" => $request->direction,
            "phone" => $request->phone,
            "email" =>$request->email
        ]);

        $client->save();

        Mail::to($client->email)->send(new WelcomeMail());
        return response()
        ->json([
                "status" => 1,
                "msg" => "Cliente Creado Exitosamente",
                'data'=> $client]);
      
    }
    public function showClient($id){
        if(Client::where(["id"=>$id])->exists()){
            $client = Client::find($id);  
            return response()->json([
                "status" => 1,
                "msg" => "Cliente Actualizado Encontrado",
                "data"=> $client,
            ],201);
        }
        else{
            return response()->json([
                "status" => 0,
                "msg" => "Cliente No Encontrado o No existe",               
            ],404);
        }
    }
    public function updateClient(Request $request, $id){
        if(Client::where(["id"=>$id])->exists()){
            $client = Client::find($id);          

            $client->name = isset($request->name) ? $request->name : $client->name;
            $client->surname = isset($request->surname) ? $request->surname : $client->surname;
            $client->direction = isset($request->direction) ? $request->direction : $client->direction;
            $client->phone = isset($request->phone) ? $request->phone : $client->phone;
            $client->email = isset($request->email) ? $request->email : $client->email;

            $client->save();

            return response([
                "status" => 1,
                "msg" => "Cliente Actualizado Correctamente",
            ]);
        }
        else{
            return response([
                "status" => 0,
                "msg" => "No se encontro el cliente",
            ],404);
        }
        
    }
    public function deleteClient($id){
        if(Client::where(["id"=>$id])->exists()){
            $client = Client::find($id);  
            $client->delete();
            return response()->json([
                "status" => 1,
                "msg" => "Cliente Fue eliminado",
                "data"=> $client,
            ],201);
        }
        else{
            return response()->json([
                "status" => 0,
                "msg" => "Cliente No Encontrado o No existe",               
            ],404);
        }
    }    
}
