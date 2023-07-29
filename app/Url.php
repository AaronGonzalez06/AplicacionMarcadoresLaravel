<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = 'urls';

    public function categoria(){
        return $this->belongsTo('App\Categoria','categoria_id');
    }
}

