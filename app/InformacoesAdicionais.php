<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformacoesAdicionais extends Model
{
    protected $fillable =
        [ "membros_id", "camiseta", "batizado", "religiao", "outro_clube", "nome_clube" ];

    public $timestamps = false;
}
