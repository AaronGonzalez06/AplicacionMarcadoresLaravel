<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    public function urls(){
        return $this->hasMany('App\Url');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
