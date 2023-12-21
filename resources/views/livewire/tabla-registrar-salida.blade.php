<div id='recipients' >
    <table id="tabla10" class="display table table-striped table-bordered stripe hover font-sans" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
        <h3 class="py-3 text-center md:text-2xl text-md text-gray-900 font-extrabold">
            @role('supervisor')
                    TABLA DE VISITAS EN CURSO
                    @else
                    TABLA DE REGISTRO DE SALIDA
                    @endrole
           </h3>
        {{-- <div class="flex justify-start">
            <input wire:keydown="search"  type="text" placeholder="search" class="text-lg px-2 py-2 rounded-md my-2"> 
            <input wire:model.debounce.500ms="search"  type="text" placeholder="Buscar" class="text-lg px-2 py-1 rounded-md my-2">
        </div> --}}
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 h-10 rounded-md ">
            <tr>
                <th>N.</th>
                <th>DNI</th>
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('guardiania'))
                <th class="text-xs">AGREGAR</th>
                <th>MARCAR</th>
                @endif
                <th>NOMBRES</th>
                <th>APELLIDOS</th>
                <th>ENTRADA</th>
                <th>OFICINA</th>
                <th>PISO</th>
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('guardiania'))
                <th>ACCION</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if($reportes->count() > 0)
                @foreach($reportes as $id=>$reporte)
                    <tr :wire:key="{{ now()->timestamp.$reporte->id }}" >
                        <td class="text-xs px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">{{ $id+1 }}</td>
                        <td class="text-xs px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">{{$reporte->dni}}</td>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('guardiania'))
                        <td class="text-xs px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                            @if(Auth::user()->roles->first()->name  != 'supervisor')
                            @if($reporte->observaciones)
                                <button wire:click.prevent="$emit('selectReport', {{$reporte}})" type="button" class="flex items-center gap-2 text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-md text-sm px-2 py-1 text-center dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800" >
                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                        <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                          <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                          <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z"/>
                                        </g>
                                      </svg>
                                     Obs.
                                </button>
                            @else
                                <button wire:click.prevent="$emit('selectReport', {{$reporte}})" type="button" class=" flex items-center gap-2 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm px-2 py-1 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" >
                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                      </svg>
                                    Obs.
                                </button>
                                
                            @endif
                        @else
                            <div class="uppercase font-bold text-center">Restricted</div>
                        @endif
                        </td>
                        <td class="text-xs px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                        @if(Auth::user()->roles->first()->name  != 'supervisor')
                            <a href="{{route('registrar-salida.edit', $reporte->id)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-3 py-1 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="registrarSalida">Salida</a>   
                        @else
                            <div class="uppercase font-bold text-center">Restricted</div>
                        @endif
                        </td>
                        @endif
                        <td class="text-xs px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">{{$reporte->nombres}}</td>
                        <td class="text-xs px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">{{$reporte->apellidos}}</td>
                        <td class="text-xs px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">{{$reporte->fecha_y_hora}}</td>
                        <td class="text-xs px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black capitalize">{{$reporte->oficina->nombre_oficina}}</td>
                        <td class="text-xs px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black capitalize">{{$reporte->oficina->piso}}</td>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('guardiania'))
                        <td class="text-xs px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                        @if(Auth::user()->roles->first()->name  != 'supervisor')
                            <!-- <a href="{{route('registrar-salida.edit', $reporte->id)}}" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-3 py-1 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Eliminar</a>    -->
                            <form action="{{ route('registrar-salida.destroy', $reporte->id) }}" method="POST" id="eliminarRegistroSalida">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm px-3 py-1 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                    Eliminar
                                </button>
                            </form>
                        @else
                            <div class="uppercase font-bold text-center">Restricted</div>
                        @endif

                           
                        </td>
                        @endif
                        
                    </tr>
                @endforeach
            
            @endif
            
        </tbody>
    </table>
    @if($reportes->count() == 0)
        <div class="text-center font-bold py-5">
        No hay Registros
        </div>
    @endif

    @if($isModalLivewire) 
        <div class="fixed top-0 left-0 right-0 bottom-0 w-screen h-screen bg-black/70 z-50 grid place-items-center overflow-hidden px-4 md:px-0">
            <div class="w-full md:w-2/3 lg:w-2/4  relative bg-white rounded-lg shadow dark:bg-gray-700">           
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white uppercase">
                        Observaciones para usuario con DNI: {{$dni}}
                    </h3>
                    <button type="button" wire:click="setIsModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                
                <form action="{{route('registrar-salida.update', $selectedId)}}" method="POST" >
                    @method('PUT')
                    @csrf
                    <div class="p-6 space-y-6">
                        <label for="observaciones" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tus observaciones.</label>
                        <textarea value="{{$observaciones}}" id="observaciones" name="observaciones"  rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe tus pensamientos aquí...">{{$observaciones}}</textarea>
                        @error('observaciones')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror


                    </div>
                    
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button  type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
                        <button  type="button" wire:click="setIsModal" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                    </div>
                </form>


            </div>
        </div>
        
    @endif
    @if(session('message'))
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '{{$message}}',
                showConfirmButton: false,
                timer: 1000
            })
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: '{{$message}}',
                showConfirmButton: false,
                timer: 1000
            })
        </script>
    @endif
</div>
