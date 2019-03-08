<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membros extends Model
{
    protected $fillable = [
        'nome','data_nascimento', 'idade' , 'sexo', 'unidade', 'estado_civil', 'cpf', 'img_cpf_id', 'rg', 'img_rg_id',
        'certidao', 'img_certidao_id', 'user_create', 'user_id', 'codigo_sgc' ];

    protected $dateFormat = 'Y-m-d';

    public $timestamps = false;
}
