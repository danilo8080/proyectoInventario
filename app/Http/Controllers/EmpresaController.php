<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
    private $empresa;

    public function __construct()
    {
        $this->middleware('auth');
        $this->empresa = new Empresa();
    }
    
    public function getEmpresas(Request $request)
    {
        $empresas = $this->empresa->getEmpresas($request);

        return response()->json([
            'empresas' => $empresas,
        ]);
    }

    public function crearEmpresa(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'empresaId' => 'required|integer|unique:empresas',
            'nombre'    => 'required|max:50',
            'contacto'  => 'required|integer'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else
        {
            if(!empty(trim($request->input('correo'))))
            {
                $validator = Validator::make($request->all(),[
                    'correo'    => 'email'
                ]);
        
                if($validator->fails()){
                    return response()->json([
                        'status' => 400,
                        'errors' => $validator->messages(),
                    ]);
                }
            }
            $this->empresa->crearEmpresa($request);
            return response()->json([
                'status'  => 200,
                'message' => 'Empresa agregada con exito!!',
            ]);
        }
    }

    public function editarEmpresa($id){
        $empresa = $this->empresa->getEmpresaPorId($id);
        if($empresa){
            return response()->json([
                'status'  => 200,
                'empresa' => $empresa,
            ]);
        }
        else{
            return response()->json([
                'status'  => 404,
                'message' => 'Empresa no encontrada',
            ]);
        }
    }

    public function actualizarEmpresa(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'nombre'    => 'required|max:50',
            'contacto'  => 'required|integer'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        if(!empty(trim($request->input('correo'))))
        {
            $validator = Validator::make($request->all(),[
                'correo'    => 'email'
            ]);
    
            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            }
        }

        else
        {
            $this->empresa->editarEmpresa($request, $id);
            return response()->json([
                'status'  => 200,
                'message' => 'Empresa editada con exito!!',
            ]);
        }
    }

    public function eliminarEmpresa($id)
    {
        $empresa = $this->empresa->getEmpresaPorId($id);
        if($empresa){
            $this->empresa->eliminarEmpresa($id);
            return response()->json([
                'status'  => 200,
                'message' => 'Empresa eliminada con exito',
            ]);
        }
        else{
            return response()->json([
                'status'  => 404,
                'message' => 'Empresa no encontrada',
            ]);
        }
    }
}
