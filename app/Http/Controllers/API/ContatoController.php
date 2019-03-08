<?php

namespace App\Http\Controllers\API;

use App\Contato;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContatoController extends Controller
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
    public function index( $origem, $tipo, $origen_id )
    {
        return Contato::where( 'origem_id', '=', $origen_id )
            ->where( 'origem', '=', $origem )
            ->where( 'tipo', '=', $tipo )
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation( $request );
        return Contato::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Contato::findOrFail( $id );
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
        $this->validation( $request );
        $contato = Contato::findOrFail( $id );

        $contato->update( $request->all() );
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
        $contato = Contato::findOrFail( $id );
        $contato->delete();

        return [ 'message' => 'contato_deleted' ];
    }

    private function validation(  Request $request ){
        $this->validate( $request, [
            'origem'  => 'required|string',
            'contato' => 'required|string',
            'tipo'    => 'required|string'
        ] );

    }
}
