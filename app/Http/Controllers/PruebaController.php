<?php

namespace ByeTweets\Http\Controllers;

use ByeTweets\Models\Prueba;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    
    
    public function getPrueba()
    {
        $p = new Prueba();
        $prueba = $p->getPrueba();
        
        return view('prueba', compact('prueba'));
    }
}
