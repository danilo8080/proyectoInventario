<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Empresa extends Model
{
    use HasFactory;

    protected $primaryKey = "empresaId";

    protected $fillable = ['empresaId', 'nombre', 'contacto', 'correo'];


    public function getEmpresas(Request $request = null){
        if($request != null){
            $empresaId = $request->input('buscarId');
            $nombre    = $request->input('buscarNombre');
        }
        else{
            $empresaId = '';
            $nombre    = '';
        }
              
        $empresas = Empresa::where('empresaId','like',"$empresaId%")
                            ->where('nombre','like',"%$nombre%")
                            ->get();

        return $empresas;
    }

    public function crearEmpresa(Request $request){
        
        $empresa = new Empresa;
        $empresa->empresaId = $request->input('empresaId');
        $empresa->nombre    = $request->input('nombre');
        $empresa->contacto  = $request->input('contacto');
        $empresa->correo    = $request->input('correo');

        return $empresa->save();
    }

    public function editarEmpresa(Request $request, $id){

        $empresa = Empresa::where('empresaId', $id)->first();

        if($empresa){
            // $empresa->empresaId = $request->input('empresaId');
            $empresa->nombre    = $request->input('nombre');
            $empresa->contacto  = $request->input('contacto');
            $empresa->correo    = $request->input('correo');
            $empresa->update();
        }
    }

    public function eliminarEmpresa($id)
    {
        $empresa = Empresa::where('empresaId', $id)->first();
        $empresa->delete();
    }

    public function getEmpresaPorId(int $id)
    {
        return Empresa::where('empresaId', $id)->first();
    }

}
