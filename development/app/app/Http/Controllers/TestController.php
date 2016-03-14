<?php

namespace App\Http\Controllers;

use DB;
use App\Book;
use Illuminate\Http\Response;

class TestController extends Controller
{
    public function getTest()
    {
        $book = Book::find(1);
        $autors = $book->autors;

        return response()->json($autors);
    }
}
