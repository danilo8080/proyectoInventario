<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Caracteristica extends Model
{
    use HasFactory;

    protected $primaryKey = "caracteristicaId";

    protected $fillable = ['caracteristicaId', 'nombre', 'descripcion', 'dispositivoId'];

    public function getCaracteristicas(Request $request){
        $caracteristicaId  = $request->input('buscarId');
        $nombre            = $request->input('buscarNombre');
        $descripcion       = $request->input('buscarDescripcion');
        $dispositivoId     = $request->input('buscarDispositivoId');
        $nombreDispositivo = $request->input('buscarNombreDispositivo');

        $caracteristicas = Caracteristica::where('caracteristicaId','like',"$caracteristicaId%")
                            ->where('nombre','like',"%$nombre%")
                            ->where('descripcion','like',"%$descripcion%")
                            ->get();

        foreach($caracteristicas as $caracteristica)
        {
            $caracteristica->dispositivoId     = $caracteristica->dispositivo->dispositivoId;
            $caracteristica->nombreDispositivo = $caracteristica->dispositivo->nombre;
        }

        if(!empty(trim($dispositivoId)))
        {
            $caracteristicas = $caracteristicas->where('dispositivoId', $dispositivoId);
        }
        if(!empty(trim($nombreDispositivo)))
        {
            $caracteristicas = $caracteristicas->where('nombreDispositivo', $nombreDispositivo);
        }

        return $caracteristicas;
    }

    public function crearCaracteristica(Request $request){
        
        $empresa = new Caracteristica;
        $empresa->caracteristicaId = $request->input('caracteristicaId');
        $empresa->nombre           = $request->input('nombre');
        $empresa->descripcion      = $request->input('descripcion');
        $empresa->dispositivoId    = $request->input('dispositivoId');

        return $empresa->save();
    }

    public function editarCaracteristica(Request $request, $id){

        $empresa = Caracteristica::where('caracteristicaId', $id)->first();

        if($empresa){
            // $empresa->caracteristicaId = $request->input('caracteristicaId');
            $empresa->nombre        = $request->input('nombre');
            $empresa->descripcion   = $request->input('descripcion');
            $empresa->dispositivoId = $request->input('dispositivoId');
            $empresa->update();
        }
    }

    public function eliminarCaracteristica($id)
    {
        $empresa = Caracteristica::where('caracteristicaId', $id)->first();
        $empresa->delete();
    }

    public function getCaracteristicaPorId(int $id)
    {
        return Caracteristica::where('caracteristicaId', $id)->first();
    }

    public function dispositivo(){
        return $this->belongsTo(Dispositivo::class, 'dispositivoId');
    }
}
