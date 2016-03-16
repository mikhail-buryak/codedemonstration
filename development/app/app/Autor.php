<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autors';

    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
