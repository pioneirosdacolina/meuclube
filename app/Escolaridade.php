<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escolaridade extends Model
{
    protected $fillable = [
        'membro_id', 'nome_escola', 'serie', 'periodo' ];

    public $timestamps = false;
}
