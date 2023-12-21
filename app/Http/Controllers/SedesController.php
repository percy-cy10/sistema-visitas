<?php

namespace App\Http\Controllers;

use App\Models\Sedes;
use Illuminate\Http\Request;

class SedesController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

    public function index()
    {
        $sedes = Sedes::all();
        // dd($oficinas);

        return view('modulos.agregar-sedes', ['sedes' => $sedes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_sede' => 'required',
            'direccion' => 'required',
            
        ], [
            'nombre_sede.required' => 'El campo Sede es obligatorio.',
            'direccion.required' => 'El campo Direccion es obligatorio.',
            
        ]);
        
        $oficina = new Sedes();
        $oficina->nombre_sede = $request->input('nombre_sede');
        $oficina->direccion = $request->input('direccion');

        if($oficina->save()){
            return redirect()->route('agregar-sedes.index')->with('message', 'Se registro exitosamente la sede.');
        }else{
            return redirect()->route('agregar-sedes.index')->with('error', 'Ocurrió un error al registrar la sede.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(sedes $sedes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sede = Sedes::findOrFail($id);
        return view('modulos.editar-sede', ['sede' => $sede]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nombre_sede' => 'required',
            'direccion' => 'required',
        ], [
            'nombre_sede.required' => 'El campo Sede es obligatorio.',
            'direccion.required' => 'El campo Direccion es obligatorio.',
        ]);
    
        $sede = Sedes::findOrFail($id);
        $sede->nombre_sede = $request->input('nombre_sede');
        $sede->direccion = $request->input('direccion');
    
        if ($sede->save()) {
            return redirect()->route('agregar-sedes.index')->with('message', 'Se actualizó exitosamente la sede.');
        } else {
            return redirect()->route('agregar-sedes.index')->with('error', 'Ocurrió un error al actualizar la sede.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sede = Sedes::findOrFail($id);
        $sede->delete();

        if($sede){
            return redirect()->route('agregar-sedes.index')->with('message', 'Se elimino correctamente la sede.');
        }else{
            return redirect()->route('agregar-sedes.index')->with('error', 'Ocurrió un error al eliminar la sede.');
        }
    }
}
