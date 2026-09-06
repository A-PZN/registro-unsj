<!--Herencia de palntillas se usa los estilos base -->
@extends('layouts.app')

<!--Se inyectara todo lo de este archivo dentro de @yiedl-->
@section('content')
<div class="max-w-4xl mx-auto space-y-8">

    <!-- Mensajes de  error/exito -->
    <!--Busca en la session si exite una clave llameda succes si es asi muetra el en mensaje-->
    @if(session('success'))
        <div class="bg-green-600 text-white p-4 rounded-lg shadow-lg flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-white font-bold">&times;</button>
        </div>
    @endif

   
    <div class="bg-gray-800 rounded-xl shadow-xl p-6 border border-gray-700">
        <h2 class="text-2xl font-bold  mb-4 flex items-center gap-2">
             Registra a tu mascota
        </h2>
    <!--Usamo post por que creamos un nuevo animal -->
        <form action="{{ route('animales.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        <!--para proteger el envio de datos -->
            @csrf
        <!--cuerpo del formulario-->
                <!--Campo Nombre-->
            <div class="flex flex-col">
                <label for="nombre" class="text-sm font-semibold text-gray-400 mb-1"></label>
                <input type="text" name="nombre" id="nombre" 
                       class="bg-gray-700 border border-fuchsia-400 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-fuchsia-400 focus:ring-1 focus:ring-teal-500 transition"
                       placeholder="Nombre" required>
            </div>
            <!--selec-->
            <div class="flex flex-col">
                <label for="especie" class="text-sm font-semibold text-gray-400 mb-1"></label>
                <select name="especie" id="especie" 
                        class="bg-gray-700 border fuchsia-400 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition appearance-none cursor-pointer"
                        required>
                    <option value="" disabled selected>Seleccionar...</option>
                    <option value="Perro">Perro</option>
                    <option value="Gato">Gato</option>
                    <option value="Ave">Ave</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>

            <!--Botón se envía el formulario-- -->
            <div>
                <button type="submit"class="px-4 py-2  font-semibold  mb-1 border border-fuchsia-400 text-fuchsia-400 hover:bg-fuchsia-400 hover:text-gray-900 rounded-md text-sm font-semibold transition">
                    Registrar
                </button>
            </div>
        </form>
    </div>

    <!--La lista de animales -->
    <div class="bg-gray-800 rounded-xl shadow-xl p-6 border border-gray-700">
        <div class="flex justify-between items-center mb-6 border-b border-gray-700 pb-4">
            <h2 class="text-xl font-bold text-white">Mis Animales Registrados</h2>
            <span class="text-sm text-gray-400">{{ count($animales) }} registros</span>
        </div>

        @if(count($animales) === 0)
            <!--Si esta vacia la lista muetra un mensaje-->
            <div class="text-center py-10">
                <div class="text-6xl mb-4 opacity-50">🐕</div>
                <p class="text-gray-400 text-lg">No hay animales registrados aún.</p>
                <p class="text-gray-500 text-sm">Registra uno arriba y lo verás aquí.</p>
            </div>
        @else
            <!--Sino mostar la lista -->
            <ul class="space-y-3">
            <!--Recorre el array para tomar el animal actual en cada iteración-->
                @foreach($animales as $animal)
                <li class="flex items-center justify-between bg-gray-700 hover:bg-gray-600 p-4 rounded-lg transition group">
                    <!-- Info del Animal -->
                    <div class="flex items-center gap-4">
                        <div class="bg-gray-800 p-2 rounded-full text-teal-400">
                            <!-- Icono según especie -->
                            @if($animal['especie'] == 'Perro') 🐶
                            @elseif($animal['especie'] == 'Gato') 🐱
                            @elseif($animal['especie'] == 'Ave') 🐦
                            @else 🐾 @endif
                        </div>
                        <div>
                            <h3 class="font-bold text-white text-lg">{{ $animal['nombre'] }}</h3>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">{{ $animal['especie'] }}</p>
                        </div>
                    </div>

                 
                    <div class="flex space-x-3">
                        <!-- Botón Editar se envia el id  -->
                        <a href="{{ route('animales.edit', $animal['id']) }}" 
                           class="px-3 py-1 border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-gray-900 rounded-md text-sm font-semibold transition">
                            Editar
                        </a>
                        
                        <!-- Botón Eliminar -->
                        <form action="{{ route('animales.destroy', $animal['id']) }}" method="POST" class="inline">
                        <!--token de seguridad y la directiva de simulación delete-->
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-1 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded-md text-sm font-semibold transition"
                                    onclick="return confirm('¿Eliminar a {{ $animal['nombre'] }}?')">
                                Eliminar
                            </button>
                        </form>
                    </div>

                </li>
                @endforeach
            </ul>
        @endif
    </div>

</div>
@endsection