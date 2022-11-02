<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dispositivo;
use Illuminate\Support\Facades\Validator;

class DispositivoController extends Controller
{
    private $dispositivo;

    public function __construct()
    {
        $this->middleware('auth');
        $this->dispositivo = new Dispositivo();
    }
    
    public function getDispositivos(Request $request)
    {
        $dispositivos = $this->dispositivo->getDispositivos($request);

        return response()->json([
            'dispositivos' => $dispositivos
        ]);
    }

    public function crearDispositivo(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'dispositivoId' => 'required|integer|unique:dispositivos',
            'nombre'        => 'required|max:50'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else
        {
            $this->dispositivo->crearDispositivo($request);
            return response()->json([
                'status'  => 200,
                'message' => 'Dispositivo agregado con exito!!',
            ]);
        }
    }

    public function editarDispositivo($id){
        $dispositivo = $this->dispositivo->getDispositivoPorId($id);
        if($dispositivo){
            return response()->json([
                'status'  => 200,
                'dispositivo' => $dispositivo,
            ]);
        }
        else{
            return response()->json([
                'status'  => 404,
                'message' => 'Dispositivo no encontrado',
            ]);
        }
    }

    public function actualizarDispositivo(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'nombre'        => 'required|max:50'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else
        {
            $this->dispositivo->editarDispositivo($request, $id);
            return response()->json([
                'status'  => 200,
                'message' => 'Dispositivo editado con exito!!',
            ]);
        }
    }

    public function eliminarDispositivo($id)
    {
        $dispositivo = $this->dispositivo->getDispositivoPorId($id);
        if($dispositivo){
            $this->dispositivo->eliminarDispositivo($id);
            return response()->json([
                'status'  => 200,
                'message' => 'Dispositivo eliminado con exito',
            ]);
        }
        else{
            return response()->json([
                'status'  => 404,
                'message' => 'Dispositivo no encontrado',
            ]);
        }
    }


}
