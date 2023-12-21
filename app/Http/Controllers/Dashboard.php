<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Oficinas;
use App\Models\Sedes;
use App\Models\User;
use App\Models\Visitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
// use Laravel\Jetstream\Rules\Role;
use Spatie\Permission\Models\Role;

class Dashboard extends Controller
{
    public function index()
    {
        // $visitas = Visitas::count();
        // $oficinas = Oficinas::count();
        // $sedes = Sedes::count();
        
        
        
        // return view('dashboard', ['visitas' => $visitas, 'oficinas' => $oficinas, 'sedes' => $sedes, 'personeros' => $personeros]);
        
        // $user = auth()->id();
            $user = Auth::user();

        $roles = Role::pluck('name');
        $userRoles = Auth::user()->getRoleNames();
        $visitas = Visitas::count();
        $oficinas = Oficinas::count();
        $sedes = Sedes::count();
        $personeros = User::whereHas('roles', function ($query) {
            return $query->where('name', 'guardiania');
        })->count();

        if (in_array('supervisor', $userRoles->toArray())) {
            return Redirect::route('registrar-salida.index');

        } 
        else if (in_array('guardiania', $userRoles->toArray())) {
            return Redirect::route('registrar-visita.index');
        } 
        else{
            return view('dashboard', ['visitas' => $visitas, 'oficinas' => $oficinas, 'sedes' => $sedes, 'personeros' => $personeros]);

        }




        // $personeros = User::whereHas('roles', function ($query) {
        //     return $query->where('name', 'guardiania');
        // })->count();

    
        // if (auth()->hasRole('guardian')) {
        //     // El usuario autenticado tiene el rol 'guardian'
        //     return redirect()->route('ver-usuarios')->with('error', 'No se encontro el usuario en la  base de datos.');
        // } else {
        //     // El usuario no tiene el rol 'guardian'
        //     return view('dashboard', ['visitas' => $visitas, 'oficinas' => $oficinas, 'sedes' => $sedes, 'personeros' => $personeros]);

        // }
    }
}
