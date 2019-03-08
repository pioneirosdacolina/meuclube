<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'origem_id', 'origem', 'cep', 'logradouro',  'numero', 'bairro', 'complemento', 'referencia', 'localidade', 'uf' ];


    public function getCep(){
        return str_pad( $this->cep, 8, '0', STR_PAD_LEFT );
    }
    public $timestamps = false;

}
