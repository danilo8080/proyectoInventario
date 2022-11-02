<?php

namespace App\Http\Controllers;

use App\Models\Dispositivo;
use Illuminate\Http\Request;
use App\Models\Empresa;

class DashboardController extends Controller
{
    public function __construct()
    {        
        $this->middleware('auth');
    }

    public function index(){
        return view('index');
    }

    public function dispositivos(){
        $empresas = Empresa::all();
        return view('dispositivos', compact('empresas'));
    }

    public function caracteristicas(){
        $dispositivos = Dispositivo::all();
        return view('caracteristicas', compact('dispositivos'));
    }
}
