<?php

namespace App\Http\Controllers;

class WorkflowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('workflow');
    }
}
