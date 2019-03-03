<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosPessoais extends Model
{
    protected $fillable = [
        'userId', 'nome', 'data_nascimento', 'sexo', 'estado_civil', 'certidao', 'rg', 'orgao_expeditor',
        'data_expedicao_rg', 'cpf', 'is_cadastro_completo', 'is_membro', 'codigo_sgc'
    ];

    protected $dates = [
        'data_nascimento',
    ];

}
