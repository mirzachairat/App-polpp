<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerdaController extends Controller
{
    public function index(){
        return view('Pages.Perda.perda');
    }
}
