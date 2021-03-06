<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::get();

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //filled -> verifica se o campo está preenchido
        //has -> verifica se o campo existe
        //if($request->filled(['name','age'])){
        //    dd('Está preenchido o nome e a idade');
      //  }
       // dd('Não esta!');

        //pega o model, depois chama a variavel pegando os dados 
        $client = new Client;

        //hasFile -> verifica se tem o arquivo para upload
        if($request->hasFile('photo')){
            $client->photo = $request->photo->store('public');
        }

        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->age = $request->input('age');
        $client->save();
        
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);

        return view('clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $client = Client::findOrFail($id);
         //hasFile -> verifica se tem o arquivo para upload
         if($request->hasFile('photo')){
            $client->photo = $request->photo->store('public');
        }
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->age = $request->input('age');
        $client->save();

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        if($client->delete()){
            return redirect()->route('clients.index');
        }
    }
}
