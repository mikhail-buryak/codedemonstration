<?php
namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use Illuminate\Http\Response;

class ImageController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getImageCover($filename) {

        $pathToFile = storage_path('images/covers/' .$filename);

        if (file_exists($pathToFile))
            return response()->file($pathToFile);
        else
            abort(404);
    }
}