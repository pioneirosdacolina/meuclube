<?php

namespace App\Http\Controllers\API;

use App\Contato;
use App\Endereco;
use App\Escolaridade;
use App\Membros;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MembroController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('api')->user();

        if ($user->isDiretoria()) {
            return Membros::all();
        } else {
            return Membros::where('user_create', '=', $user->getAuthIdentifier())->get();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO adicionar validações
        $this->validate($request, [
            'nome' => 'required|string|max:191',
            'data_nascimento' => 'required|date',
            'unidade' => 'required',
            'idade' => 'required',
            'sexo' => 'required',
            'estado_civil' => 'required',
        ]);

        return Membros::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // TODO adicionar validações
        $this->validate($request, [
            'nome' => 'required|string|max:191',
            'data_nascimento' => 'required|date',
            'unidade' => 'required',
            'idade' => 'required',
            'sexo' => 'required',
            'estado_civil' => 'required',
        ]);

        $membro = Membros::findOrFail($id);

        $membro->update($request->all());

        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getEscolaridade( $id ){
        return Escolaridade::where( 'membro_id', '=', $id)->first();
    }

    public function createEscolaridade(Request $request)
    {
        return Escolaridade::create($request->all());
    }

    public function saveEscolaridade(Request $request, $id)
    {
        $escolaridade = Escolaridade::findOrFail( $id );

        $escolaridade->update( $request->all() );
        return $request->all();
    }

    public function getEndereco( $id ){
        return Endereco::where( 'origem_id', '=', $id)->where('origem', '=', 'membro')->first();
    }

    public function createEndereco(Request $request)
    {
        $dadosEndereco = $request->all();

        $dadosEndereco["cep"] = str_pad( str_replace( "-", "", $dadosEndereco["cep"]), 8, '0', STR_PAD_LEFT );

        return Endereco::create($dadosEndereco);
    }

    public function saveEndereco(Request $request, $id)
    {
        $endereco = Endereco::findOrFail( $id );

        $endereco->update( $request->all() );
        return $request->all();
    }

    public function getTelefone( $id ){
    }

    public function getEmail( $id ){
        return Contato::where( 'origem_id', '=', $id)
            ->where('origem', '=', 'membro')
            ->where( 'tipo', '=', 'email')
            ->get();
    }

    public function createContato(Request $request)
    {
        return Contato::create($request->all());
    }

    public function saveContato(Request $request, $id)
    {
        $telefone = Contato::findOrFail( $id );

        $telefone->update( $request->all() );
        return $request->all();
    }
}