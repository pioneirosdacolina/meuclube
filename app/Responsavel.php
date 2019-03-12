<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    protected $fillable =
        [ "membro_id", 'nome', 'cpf', 'img_cpf_id', 'rg', 'img_rg_id' ];

    public $timestamps = false;
}
