<x-app-layout>
    <nav>
        <div class="p-2 sm:ml-64">
            <div class="border-gray-200 rounded-lg dark:border-gray-700 mt-[4.5rem]">
                <div id='recipients' class="py-8 px-4 mt-6 lg:mt-0 rounded shadow bg-white font-sans">
                    <div>
                        <h2 class="h-16 text-center md:text-3xl text-md text-gray-900 font-sans"><strong>AGREGAR FUNCIONARIO</strong></h2>
                    </div>
                    <div class="pb-10 relative flex items-center">
                        <div class="flex-grow border-t border-gray-400"></div>
                            <span class="flex-shrink mx-4 text-gray-400">Gobierno Regional de Puno</span>
                        <div class="flex-grow border-t border-gray-400"></div>
                    </div>

                    @if(session('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert" id="success-message">
                        <strong class="font-bold">¡Éxito!</strong>
                        <span class="block sm:inline">{{ session('message') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a.999.999 0 1 0-1.414 1.414L11 8.414l-1.934 1.934a.999.999 0 1 0 1.414 1.414L12.414 10l1.934 1.934a.999.999 0 1 0 1.414-1.414L13.828 10l1.52-1.52a.999.999 0 0 0 0-1.414z"/></svg>
                        </span>
                    </div>
                    <script>
                    
                    const successMessage = document.getElementById('success-message');

                    if (successMessage) {
                        setTimeout(() => {
                            successMessage.remove();
                        }, 3000);
                    }
                </script>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert" id="error-message">
                        <strong class="font-bold">¡Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a.999.999 0 1 0-1.414 1.414L11 8.414l-1.934 1.934a.999.999 0 1 0 1.414 1.414L12.414 10l1.934 1.934a.999.999 0 1 0 1.414-1.414L13.828 10l1.52-1.52a.999.999 0 0 0 0-1.414z"/></svg>
                        </span>
                    </div>
                    <script>
                    
                    const errorMessage = document.getElementById('error-message');

                    if (errorMessage) {
                        setTimeout(() => {
                            errorMessage.remove();
                        }, 3000);
                    }
                </script>
                @endif
                <form class="" method="POST" action="{{ route('agregar-funcionario.store') }}" id="formRegistrarFuncionario">
                    @csrf    
                        <div class="grid gap-6 mb-6 md:grid-cols-3">
                            <div>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="dni">
                                    DNI:
                                </label>
                                <input type="text" id="dni" class="block appearance-none w-full bg-gray-200 border border-black-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingrese la Nombre" name="dni" required>
                            </div>
                            <div>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
                                    NOMBRES:
                                </label>
                                <input type="text" id="nombre" class="block appearance-none w-full bg-gray-200 border border-black-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingrese la Nombre" name="nombre" required>
                            </div>
                            <div>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="personero_id">
                                    APELLIDO PATERNO:
                                </label>
                                <input type="text" id="apellido_paterno" class="block appearance-none w-full bg-gray-200 border border-black-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingrese la Apellido Paterno" name="apellido_paterno" required>
                            </div>
                            <div>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="personero_id">
                                    APELLIDO MATERNO:
                                </label>
                                <input type="text" id="apellido_materno" class="block appearance-none w-full bg-gray-200 border border-black-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingrese la Apellido Materno" name="apellido_materno" required>
                            </div>

                            <div>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cargo">
                                    CARGO:
                                </label>
                                <input type="text" id="cargo" class="block appearance-none w-full bg-gray-200 border border-black-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingrese el Cargo"  name="cargo" required>
                            </div>
                            <div>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" 
                                    for="oficina">
                                    OFICINA:
                                </label>
                                <select
                                    class="block appearance-none w-full bg-gray-200 border border-black-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="oficina" name="oficina" required >
                                    <option value="" disabled selected>Seleccione...</option>
                                    @foreach (\App\Models\Oficinas::all() as $oficinas)
                                        <option value="{{ $oficinas->id }}">{{ $oficinas->nombre_oficina }}</option>
                                    @endforeach
                                </select>
                                @error('oficina')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col py-7">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 rounded-lg">
                                    Agregar
                                </button>
                            </div>
                        </div>
                </form>

                <!--Card-->
                <div id='recipients' class="table-responsive">
                    <table id="tabla03" class="display table table-striped table-bordered stripe hover font-sans" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <h3 class="py-2 text-center text-2xl text-gray-900 font-extrabold"><strong>TABLA DE REGISTRO DE FUNCIONARIOS</strong></h3>
                        <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-white">
                            <tr>
                                <th>N.</th>
                                <th>NOMBRES</th>
                                <th>APELLIDOS</th>
                                <th>CARGO</th>
                                <th>OFICINA</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($funcionario as $funcionarios)
                            <tr>
                                <td class="font-medium text-gray-900 dark:text-black">{{$funcionarios->id}}</td>
                                <td class="font-medium text-gray-900 dark:text-black capitalize">{{$funcionarios->nombre}}</td>
                                <td class="font-medium text-gray-900 dark:text-black capitalize">{{$funcionarios->apellido_paterno}} {{$funcionarios->apellido_materno}}</td>
                                <td class="font-medium text-gray-900 dark:text-black capitalize">{{$funcionarios->cargo}}</td>
                                <td class="font-medium text-gray-900 dark:text-black capitalize">
                                    @foreach (\App\Models\oficinas::where('id',$funcionarios->oficina)->get() as $oficinas)
                                        {{ $oficinas->nombre_oficina }}
                                    @endforeach
                                </td>
                                <td>
                                    <div class="flex">
                                        <a href="{{ route('agregar-funcionario.edit', $funcionarios->id) }}" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            Editar
                                        </a>
                                        {{-- <form action="{{ route('agregar-funcionario.destroy', $funcionarios->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                Eliminar
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                      
                </div>
            </div>
        </div>
    </nav>


        <script src="plugins/js/jquery-3.5.1.js"></script>
        <script src="plugins/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#tabla03').DataTable( {
                    responsive: true,
                    "language": {
                "paginate": {
                    "first":      "Primera",
                    "last":       "Última ",
                    "next":       "Siguiente",
                    "previous":   "Anterior" ,                  
                },
                "lengthMenu": "MOSTRAR _MENU_",
                "emptyTable": "No hay datos disponibles en la tabla",
                "search":     "BUSCAR"
            }
                } );
                $('select').css('width','100%');
            } );
                addEventListener("load", (event) => {
                    document.getElementById('formRegistrarVisita').addEventListener('submit', () => {
                        
                    })
                });

        </script>

        @if(session('message'))
            <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: "{{session('message')}}",
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
        @endif
        @if(session('error'))
            <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: "{{session('error')}}",
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
        @endif

   
    </x-app-layout>
