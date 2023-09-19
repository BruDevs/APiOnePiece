<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Mugiwaras;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Http\Controllers;


class StrawHatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosMugiwaras = Mugiwaras::all();
        $contador = $dadosMugiwaras->count();

        return 'Membros do chapéu de palha: ' . $contador . Response()-json([], response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosMugiwaras = $request->all();

        $valida = Validator::make($dadosMugiwaras,
        [
            'integrante'=> 'required',
            'funcao'=> 'required',
        ]);

        if($valida->fails())
    {
        return 'Dados inválidos'.$valida->errors(true). 500;
    }

    $mugiwaraBanco = Mugiwaras::create($valida);

    if($mugiwaraBanco){
        return 'Integrante agregado '. Response()-json([], response::HTTP_NO_CONTENT);
    }
    else
    {
        return 'Integrante não agregado '. Response()-json([], response::HTTP_NO_CONTENT);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mugiwaraBanco = Mugiwaras::find($id);
        $contador = $mugiwaraBanco->count();

        if($mugiwaraBanco){
            return 'Bebidas  encontradas: '.$contador.' - '.$mugiwaraBanco.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'Bebidas Não localizadas.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mugiwaraDados = $request->All();
        $valida = Validator::make($mugiwaraDados,[
            'integrante' => 'required',
            'funcao' => 'required',
        ]);

        if($valida->fails()){
            return 'Dados incompletos '.$valida->errors(true). 500;

        }

        $mugiwaraBanco = Mugiwaras::find($id);
        $mugiwaraBanco->integrante = $mugiwaraDados['integrante'];
        $mugiwaraBanco->funcao = $mugiwaraDados['funcao'];

        $RegistrosMugiwaras = $mugiwaraBanco->save();
        if($RegistrosMugiwaras){
            return 'Dados alterados com sucesso.'.Response()->json([], Response::HTTP_NO_CONTENT);
        }else{  
            return 'Dados não cadastrados no banco de dados'.Response()->json([], Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mugiwaraBanco = Mugiwaras::find($id);
        if($mugiwaraBanco){
            $mugiwaraBanco->delete();
            return 'Membro dispensado do bando'.response()->json([],Response::HTTP_NO_CONTENT);
        }else {
            return 'Membro não dispensado'.response()->json([],Response::HTTP_NO_CONTENT);
        }
    }
}
