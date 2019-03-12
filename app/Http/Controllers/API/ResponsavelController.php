<?php

namespace App\Http\Controllers\API;

use App\Membros;
use App\Responsavel;
use App\ResponsavelMembro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResponsavelController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate( $request, [
            'nome'       => 'required|string',
            'cpf'        => 'required|string',
            'rg'         => 'required|string',
            'parentesco' => 'required|string'
        ] );

        $dados = $request->all();
        $responsavel = Responsavel::create( $request->all() );

        if(  $responsavel != null ){
            $dados["responsavels_id"] = $responsavel->id;
            $responsavelMembro = ResponsavelMembro::create( $dados );
            $dados['id'] = $responsavelMembro->id;

            return $dados;

        }
        return $request->all();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id is id of member (membro_id)
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::table('responsavels' )
                ->join( 'responsavel_membros', 'responsavel_membros.responsavels_id', '=', 'responsavels.id' )
                ->where( 'responsavel_membros.membros_id', '=', $id )
                ->select([
                    'responsavel_membros.id',
                    'responsavels.nome',
                    'responsavels.cpf',
                    'responsavels.rg',
                    'responsavel_membros.parentesco',
                    'responsavel_membros.membros_id',
                    'responsavel_membros.responsavels_id'
                ])
                ->latest( 'responsavels.id' )
            ->paginate( 10 );
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
        $responsavelMembro = ResponsavelMembro::findOrFail( $id );
        $responsavelMembro->update( $request->all() );

        $responsavel = Responsavel::findOrFail( $request->responsavels_id );
        $responsavel->update($request->all());

        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $responsavel = ResponsavelMembro::findOrFail( $id );
        $responsavel->delete();
        // TODO Verificar se o responsável possui outros vínculos e, do contrário, apagar o responsável.

        return [ "message" => "Deleted success", "success" => "deleted" ];
    }
}
