<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sgc extends Model
{
    protected $fillable =
        [ 'codigo_usuario', 'nome', 'cargo', 'lider', 'estado_civil', 'data_nascimento', 'sexo', 'certidao', 'rg',
          'orgao_expeditor', 'cpf', 'cpf_responsavel', 'telefone_usuario', 'celular_usuario', 'email', 'endereco',
          'bairro', 'cep', 'nome_pai', 'email_pai', 'telefone_pai', 'nome_mae', 'email_mae', 'telefone_mae',
          'responsavel', 'vinculo', 'email_responsavel', 'telefone_responsavel', 'tamanho', 'batizado',
          'codigo_unidade', 'unidade', 'cidade' ];

}
