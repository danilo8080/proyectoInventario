<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caracteristica;
use Illuminate\Support\Facades\Validator;

class CaracteristicaController extends Controller
{
    private $caracteristica;

    public function __construct()
    {
        $this->middleware('auth');
        $this->caracteristica = new Caracteristica();
    }
    
    public function getCaracteristicas(Request $request)
    {
        $caracteristicas = $this->caracteristica->getCaracteristicas($request);

        return response()->json([
            'caracteristicas' => $caracteristicas,
        ]);
    }

    public function crearCaracteristica(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'caracteristicaId' => 'required|integer|unique:caracteristicas',
            'nombre'           => 'required|max:50',
            'descripcion'      => 'required|max:150',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else
        {
            $this->caracteristica->crearCaracteristica($request);
            return response()->json([
                'status'  => 200,
                'message' => 'Caracteristica agregada con exito!!',
            ]);
        }
    }

    public function editarCaracteristica($id){
        $caracteristica = $this->caracteristica->getCaracteristicaPorId($id);
        if($caracteristica){
            return response()->json([
                'status'  => 200,
                'caracteristica' => $caracteristica,
            ]);
        }
        else{
            return response()->json([
                'status'  => 404,
                'message' => 'Caracteristica no encontrada',
            ]);
        }
    }

    public function actualizarCaracteristica(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'nombre'      => 'required|max:50',
            'descripcion' => 'required|max:150'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else
        {
            $this->caracteristica->editarCaracteristica($request, $id);
            return response()->json([
                'status'  => 200,
                'message' => 'Caracteristica editada con exito!!',
            ]);
        }
    }

    public function eliminarCaracteristica($id)
    {
        $caracteristica = $this->caracteristica->getCaracteristicaPorId($id);
        if($caracteristica){
            $this->caracteristica->eliminarCaracteristica($id);
            return response()->json([
                'status'  => 200,
                'message' => 'Caracteristica eliminada con exito',
            ]);
        }
        else{
            return response()->json([
                'status'  => 404,
                'message' => 'Caracteristica no encontrada',
            ]);
        }
    }
}
