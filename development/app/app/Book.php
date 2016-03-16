<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Book extends Model
{
    protected $table = 'books';

    public function autor()
    {
        return $this->belongsTo('App\Autor');
    }

    public function deleteCover()
    {
        $pathToFile = storage_path('images/covers/' .$this->preview);

        if ($this->preview && file_exists($pathToFile))
            unlink($pathToFile);

        return true;
    }
}
