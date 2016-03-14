<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    public function autors()
    {
        return $this->belongsToMany('App\Autor', 'books_autors', 'book_id', 'autor_id');
    }
}
