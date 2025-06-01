<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Segmentos;

class SegmentoController extends Controller
{
    public  function index(){
        $segmentos = Segmentos::all();
        return response()->json(['segmentos' => $segmentos]);
    }
}
