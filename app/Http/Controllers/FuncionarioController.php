<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Oficinas;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

    public function index()
    {
        $funcionario = Funcionario::all();
        // dd($oficinas);

        return view('modulos.agregar-funcionario', ['funcionario' => $funcionario]);
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
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'cargo' =>'required', // Asegura que el campo "cargo" sea único en la tabla "funcionarios"
            'oficina' => 'required',
        ], [
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'apellido_paterno.required' => 'El campo Apellido Paterno es obligatorio.',
            'apellido_materno.required' => 'El campo Apellido Materno es obligatorio.',
            'cargo.required' => 'El campo Cargo es obligatorio.',
            'cargo.unique' => 'El cargo ya existe en la base de datos.', // Mensaje personalizado para la regla "unique"
            'oficina.required' => 'El campo Oficina es obligatorio.',
        ]);
        
        $funcionarios = new Funcionario();
        $funcionarios->dni = $request->input('dni');
        $funcionarios->nombre = $request->input('nombre');
        $funcionarios->apellido_paterno = $request->input('apellido_paterno');
        $funcionarios->apellido_materno = $request->input('apellido_materno');
        $funcionarios->cargo = $request->input('cargo');
        $funcionarios->oficina = $request->input('oficina');
    
        if($funcionarios->save()){
            return redirect()->route('agregar-funcionario.index')->with('message', 'Se registró exitosamente el funcionario.');
        } else {
            return redirect()->route('agregar-funcionario.index')->with('error', 'Ocurrió un error al registrar el funcionario.');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(funcionario $funcionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $oficinaName = Oficinas::where('id', $funcionario->oficina)->first();


        return view('modulos.editar-funcionario', [
            'funcionario' => $funcionario,
            'oficinaName' => $oficinaName,
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'cargo' => 'required|unique:funcionario,cargo,' . $funcionario->id, // Excluir el funcionario actual de la regla "unique"
            'oficina' => 'required',
        ], [
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'apellido_paterno.required' => 'El campo Apellido Paterno es obligatorio.',
            'apellido_materno.required' => 'El campo Apellido Materno es obligatorio.',
            'cargo.required' => 'El campo Cargo es obligatorio.',
            'cargo.unique' => 'El cargo ya existe en la base de datos.',
            'oficina.required' => 'El campo Oficina es obligatorio.',
        ]);
        $funcionario->dni->$request->input('dni');
        $funcionario->nombre = $request->input('nombre');
        $funcionario->apellido_paterno = $request->input('apellido_paterno');
        $funcionario->apellido_materno = $request->input('apellido_materno');
        $funcionario->cargo = $request->input('cargo');
        $funcionario->oficina = $request->input('oficina');

        if ($funcionario->save()) {
            return redirect()->route('agregar-funcionario.index')->with('message', 'Se actualizó exitosamente el funcionario.');
        } else {
            return redirect()->route('agregar-funcionario.index')->with('error', 'Ocurrió un error al actualizar el funcionario.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();

        if($funcionario){
            return redirect()->route('agregar-funcionario.index')->with('message', 'Se elimino correctamente el funcionario.');
        }else{
            return redirect()->route('agregar-funcionario.index')->with('error', 'Ocurrió un error al eliminar el funcionario.');
        }
    }
}
