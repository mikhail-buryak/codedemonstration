<?php

namespace App\Http\Controllers;

use DB;

class TestController extends Controller
{
    public function getTest()
    {
        $users = DB::table('users')->get();

        return view('user.index', ['users' => $users]);
    }
}
