<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DuremController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('Durem/durem');
    }

}
