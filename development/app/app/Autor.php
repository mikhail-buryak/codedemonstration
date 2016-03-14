<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autors';

    public function books()
    {
        return $this->belongsToMany('App\Book', 'books_autors', 'autor_id', 'book_id');
    }
}
