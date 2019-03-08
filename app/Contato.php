<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $fillable =
        [ 'origem_id', 'origem', 'tipo', 'is_principal',  'contato' ];
}
