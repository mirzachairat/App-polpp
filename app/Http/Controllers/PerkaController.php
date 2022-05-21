<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerkaController extends Controller
{
    public function index(){
        return view('Pages.Perka.perka');
    }
}
