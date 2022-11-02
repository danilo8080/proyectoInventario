<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Dispositivo;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->password = Hash::make('admin');
        $user->save();

        $empresa = new Empresa();
        $empresa->empresaId = 11;
        $empresa->nombre = 'distri';
        $empresa->contacto = 3201254578;
        $empresa->save();

        $empresa = new Empresa();
        $empresa->empresaId = 12;
        $empresa->nombre = 'doce';
        $empresa->contacto = 111111111;
        $empresa->save();

        $empresa = new Empresa();
        $empresa->empresaId = 13;
        $empresa->nombre = 'doce';
        $empresa->contacto = 71113335;
        $empresa->save();

        $dispositivo = new Dispositivo();
        $dispositivo->dispositivoId = 8888;
        $dispositivo->nombre = 'tv';
        $dispositivo->empresaId = 11;
        $dispositivo->save();

        $dispositivo = new Dispositivo();
        $dispositivo->dispositivoId = 8877;
        $dispositivo->nombre = 'equipo';
        $dispositivo->empresaId = 11;
        $dispositivo->save();

        $dispositivo = new Dispositivo();
        $dispositivo->dispositivoId = 8899;
        $dispositivo->nombre = 'impresora';
        $dispositivo->empresaId = 12;
        $dispositivo->save();

        $dispositivo = new Dispositivo();
        $dispositivo->dispositivoId = 5555;
        $dispositivo->nombre = 'mause';
        $dispositivo->empresaId = 13;
        $dispositivo->save();


    }
}
