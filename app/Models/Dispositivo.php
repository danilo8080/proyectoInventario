<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Dispositivo extends Model
{
    use HasFactory;

    protected $primaryKey = "dispositivoId";

    protected $fillable = ['dispositivoId', 'nombre', 'empresaId'];


    public function getDispositivos(Request $request){
        $dispositivoId = $request->input('buscarId');
        $nombre        = $request->input('buscarNombre');
        $empresaId     = $request->input('buscarEmpresaId');
        $nombreEmpresa = $request->input('buscarNombreEmpresa');

        $dispositivos = Dispositivo::where('dispositivoId','like',"$dispositivoId%")
                                    ->where('nombre','like',"%$nombre%")
                                    ->get();

        foreach($dispositivos as $dispositivo)
        {
            $dispositivo->empresaId     = $dispositivo->empresa->empresaId;
            $dispositivo->nombreEmpresa = $dispositivo->empresa->nombre;
        }

        if(!empty(trim($empresaId)))
        {
            $dispositivos = $dispositivos->where('empresaId', $empresaId);
        }
        if(!empty(trim($nombreEmpresa)))
        {
            $dispositivos = $dispositivos->where('nombreEmpresa', $nombreEmpresa);
        }

        return $dispositivos;
    }

    public function crearDispositivo(Request $request){
        
        $dispositivo = new Dispositivo;
        $dispositivo->dispositivoId = $request->input('dispositivoId');
        $dispositivo->nombre        = $request->input('nombre');
        $dispositivo->empresaId     = $request->input('empresaId');

        return $dispositivo->save();
    }

    public function editarDispositivo(Request $request, $id){

        $dispositivo = Dispositivo::where('dispositivoId', $id)->first();

        if($dispositivo){
            // $dispositivo->dispositivoId = $request->input('dispositivoId');
            $dispositivo->nombre    = $request->input('nombre');
            $dispositivo->empresaId = $request->input('empresaId');
            $dispositivo->update();
        }
    }

    public function eliminarDispositivo($id)
    {
        $dispositivo = Dispositivo::where('dispositivoId', $id)->first();
        $dispositivo->delete();
    }

    public function getDispositivoPorId(int $id)
    {
        return Dispositivo::where('dispositivoId', $id)->first();
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresaId');
    }
}
