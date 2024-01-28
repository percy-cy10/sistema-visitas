<div class="flex flex-col gap-6">
    <div class=" flex flex-wrap -mx-3 mb-2 ">
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="dni">
                DNI: {{$dni}}
            </label>
            <input class="appearance-none block w-full bg-white-200 text-gray-700 border border-black-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:change="addDni($event.target.value)" id="dni" name="dni" type="number" maxlength="8" placeholder="Ingrese DNI" required>
            <!-- @error('dni')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror -->
            @error('dni')
            <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: '{{ $message }}',
                    showConfirmButton: false,
                    timer: 3000
                })
            </script>
            @enderror

        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase  tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombres">
                NOMBRES<span class="text-red-500">*</span>
            </label>
            <input class="appearance-none uppercase  block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="nombres" name="nombres" type="text" placeholder="" value="{{$nombre}}" required>
            @error('nombres')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="apellidos">
                APELLIDOS<span class="text-red-500">*</span>
            </label>
            <input class="appearance-none uppercase block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="apellidos" name="apellidos" type="text" placeholder="" value="{{$apellido}}" required>
            @error('apellidos')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class=" flex flex-wrap -mx-3 mb-2 ">

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="empresa">
                ENTIDAD VISITANTE (opcional)
            </label>
            <input class="uppercase block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="empresa" name="empresa" type="text" placeholder="" value="{{$empresa}}">
            @error('empresa')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="motivo">
                MOTIVO
                <span class="text-red-500">*</span>
            </label>
            <input class="uppercase block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="motivo" name="motivo" type="text" placeholder="" value="{{$motivo}}">
            @error('motivo')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="funcionario">
                FUNCIONARIO VISITADO
                <span class="text-red-500">*</span>
            </label>
            <div class="">
                <input type="hidden" name="user-name" wire:model="nombreFuncionario">
                <input type="hidden" name="funcionario" wire:model="funcionarioId">

                <x-lwa::autocomplete class="appearance-none uppercase block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" style="width: 100%;" wire:model-text="nombreFuncionario" wire:model-id="funcionarioId" wire:model-results="funcionarios" :options="[
                        'text'=> 'nombre',
                        'allow-new'=> 'false',
                        ]" />
            </div>
            @error('funcionario')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror

        </div>

    </div>
    <div class="flex flex-wrap -mx-3 mb-2">

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cargo">
                CARGO
                <span class="text-red-500">*</span>
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="cargo" name="cargo" type="text" placeholder="" value="{{$cargo}}" readonly>
            @error('cargo')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="oficina">
                OFICINA
                <span class="text-red-500">*</span>
            </label>
            <div class="relative">

                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="oficina" name="oficina" type="text" value="{{$oficina_user}}" readonly>

                @error('oficina')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sede">
                SEDE
                <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input type="text" value="{{$name_sede}}" class="appearance-none capitalize block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" readonly>
            </div>
        </div>

    </div>
    <div class=" flex flex-wrap -mx-3 mb-2">

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="piso">
                PISO
                <span class="text-red-500">*</span>
            </label>
            <input class="appearance-none capitalize block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="piso" type="text" value="{{$piso}}" readonly>
        </div>

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fecha_y_hora">
                REGISTRO DE ENTRADA
                <span class="text-red-500">*</span>
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="fecha_y_hora" name="fecha_y_hora" type="datetime-local" placeholder="" value="{{ $fecha_y_hora }}" readonly>
            @error('fecha_y_hora')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="personero_id">
                PERSONERO
                <span class="text-red-500">*</span>
            </label>
            <input type="hidden" name="personero_id" value="{{  Auth::user()->id }}" readonly>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="personero_id" type="text" value="{{ Auth::user()->name }}" readonly>
        </div>

    </div>

    <script>
        const select = document.getElementById("oficina-select");

        function selectOficina() {
            const selectedOficina = select.value;
            // Puedes hacer algo con el valor seleccionado aquí, como mostrarlo en otro lugar de la página o realizar una acción basada en la selección.
        }
    </script>

    @if(session('message'))
    <script>
        Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Se registro correctamente la visita.',
            showConfirmButton: false,
            timer: 1000
        })
    </script>
    @endif
    <script>
        let oficina = document.getElementById('empresa');
        document.getElementById('dni').addEventListener('keypress', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();

                oficina.focus();
            }
        });
    </script>

</div>
