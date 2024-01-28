<?php

namespace App\Http\Livewire;

use App\Models\Oficinas;
use App\Models\Funcionario;
use App\Models\Sedes;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RegistrarVisita2 extends Component
{
    public $dni = '';
    public $nombre = '';
    public $apellido = '';
    public $empresa = '';
    public $motivo = '';
    // public $funcionario = [];
    public $cargo = '';
    public $oficina_user = '';
    public $oficinas = [];

    public $nombreOficina = '';
    public $nombreFuncionario = '';
    public $name_sede = '';
    public $piso = '';

    public $searchQuery = '';
    public $fecha_y_hora;

    // public $name;
    public $funcionarioId;
    public $funcionarios;

    public $funcionario;

    protected $rules = [
        'funcionarios.*.id' => '',
        'funcionarios.*.nombre' => '',

        'funcionario.id' => '',
        'funcionario.nombre' => '',
    ];

    public function addDni(string $dni)
    {
        try {
            $this->dni = $dni;

            // Validating the input field with name dni
            $this->validate([
                'dni' => 'required'
            ]);

            if ($this->dni != '') {
                $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InBlcmN5Y29uZG9yaTExeUBnbWFpbC5jb20ifQ.37MzpAZnxLUBidAfPfnTV5E3ex1T9cr8PHL2oHTDl7k';

                $response = Http::get('https://dniruc.apisperu.com/api/v1/dni/' . $this->dni, [
                    'token' => $token,
                ]);

                if ($response->successful()) {
                    $dataDni = $response->json();

                    // Extraer datos del DNI
                    $this->nombre = $dataDni['nombres'];
                    $this->apellido = $dataDni['apellidoPaterno'] . ' ' . $dataDni['apellidoMaterno'];
                } else {
                    $this->dni = '';
                    $this->nombre = '';
                    $this->apellido = '';
                    $this->addError('dni', 'El DNI ingresado no existe');
                }
            }
        } catch (Exception $e) {
            $this->dni = '';
            $this->nombre = '';
            $this->apellido = '';
            $this->addError('dni', 'Error de consulta');
        }
    }


    /*public function updatedNombreOficina($name)
    {
        $oficinaName = Oficinas::where('nombre_oficina', $name)->first();
        // dd($oficinaName);

        if (isset($oficinaName)) {
            $this->name_sede = $oficinaName->sede->nombre_sede;
            $this->piso = $oficinaName->piso;
        } else {
            $this->piso = '';
            $this->name_sede = '';
            $this->addError('oficina', 'La oficina ingresada no existe');
        }
    }*/


    private function seperar($nombre)
    {
        $arr = explode(' ', $nombre);
        if (count($arr) <= 1) {
            return [$nombre, null, null];
        }
        $ap_m = array_splice($arr, -1);
        $ap_p = array_splice($arr, -1);
        return [implode(' ', $arr), $ap_p[0], $ap_m[0]];
    }

    public function updatedNombreFuncionario()
    {
        try {
            if (is_null($this->nombreFuncionario) || $this->nombreFuncionario === '') {
                throw new Exception('Error-1');
            }

            // Utilizar la función de separación para obtener los nombres y apellidos
            $nombres_ = $this->seperar($this->nombreFuncionario);

            // Buscar al funcionario por nombres y apellidos
            $funcionarioName = Funcionario::where('nombre', $nombres_[0])
                ->where('apellido_paterno', $nombres_[1])
                ->where('apellido_materno', $nombres_[2])
                ->first();

            // Obtener la oficina relacionada con el funcionario
            $oficinaName = Oficinas::find($funcionarioName->oficina);

            if (isset($funcionarioName) && isset($oficinaName)) {
                $this->cargo = $funcionarioName->cargo;
                $this->oficina_user = $oficinaName->nombre_oficina;
                $this->name_sede = $oficinaName->sede->nombre_sede;
                $this->piso = $oficinaName->piso;
                $this->fecha_y_hora = Carbon::now()->toDateTimeString();
                $this->funcionarioId = $funcionarioName->id; // Agregar esta línea para establecer el ID del funcionario
            } else {
                throw new Exception('Error-1');
            }
        } catch (Exception $e) {
            if ($e->getMessage() == 'Error-1') {
                $this->cargo = '';
                $this->piso = '';
                $this->name_sede = '';
                $this->oficina_user = '';
                $this->funcionarioId = null; // Agregar esta línea para limpiar el ID del funcionario si no se encuentra
                $this->getUsers();
            } else {
                $this->cargo = '';
                $this->addError('funcionario', 'El funcionario ingresado no existe');
                $this->piso = '';
                $this->name_sede = '';
                $this->oficina_user = '';
                $this->funcionarioId = null; // Agregar esta línea para limpiar el ID del funcionario si no se encuentra
                $this->addError('oficina', 'La oficina ingresada no existe');
            }
        }
    }

    public function render()
    {
        return view('livewire.registrar-visita2');
    }

    public function mount()
    {
        $this->getUsers();
    }

    public function updatedFuncionarioId()
    {
        $this->FuncionarioId = Funcionario::find($this->funcionarioId);
    }

    public function updatedName()
    {
    }

    public function getUsers()
    {
        $this->funcionarios = Funcionario::query()
            ->when($this->nombreFuncionario, function ($query, $nombreFuncionario) {
                $nombres_ = $this->seperar($nombreFuncionario);
                $query->where('nombre', 'LIKE', '%' . $nombres_[0] . '%');
                $query->orWhere('apellido_paterno', 'LIKE', '%' . $nombres_[0]  . '%');
                $query->orWhere('apellido_materno', 'LIKE', '%' . $nombres_[0] . '%');
                return $query;
            })
            ->orderBy('nombre')
            ->get();
        $this->funcionarios->each(function ($obj) {
            $obj->nombre = $obj->nombre . ' ' . $obj->apellido_paterno . ' ' . $obj->apellido_materno;
        });
    }
}
