<?php

namespace App\Http\Controllers\API;

use App\InformacoesAdicionais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformacoesAdicionaisController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO adicionar persistência de dados
        return InformacoesAdicionais::create( $request->all() );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO verificar acesso do usuário logado aos dados abaixos
        return InformacoesAdicionais::findOrFail( $id );
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
        // TODO adicionar persistência de dados
        // TODO remover o campo membros_id do request, para não alterar o dono da informação.
        $informacoesadicionais =
            InformacoesAdicionais::findOrFail( $id );
        $informacoesadicionais->update(  $request->all() );

        return $informacoesadicionais;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO verificar acesso do usuário logado aos dados abaixos
        $informacoesadicionais =
            InformacoesAdicionais::findOrFail( $id );
        $informacoesadicionais->delete();

        return  ["message" => "Informações apagadas", "success" => "deleted" ];
    }
}
