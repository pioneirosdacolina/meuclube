<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponsavelMembro extends Model
{
    protected $fillable =
        [ "membros_id",  "responsavels_id", "parentesco" ];

    public $timestamps = false;

    public function responsavel(){
        return $this->belongsTo('App\Responsavel' );
    }
}
