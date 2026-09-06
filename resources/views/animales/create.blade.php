@extends('layouts.app')

@section('content')
 <div class=" max-w-4xl mx-auto space-y-8 bg-gray-800 rounded-xl shadow-xl p-6 border border-gray-700">
        <h2 class="text-2xl font-bold  mb-4 flex items-center gap-2">
            Registra a tu mascota
        </h2>

         <p class="text-gray-200 text-lg mb-4">
        Completa todos los datos para registrar el nuevo animal.
        </p>
       
        <form action="{{ route('animales.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <!--para proteger el envio de datos -->
            @csrf
            <!--Campo  Nombre -->
            <div class="flex flex-col">
                <label for="nombre" class="text-sm font-semibold text-white mb-1"></label>
                <input type="text" name="nombre" id="nombre" 
                       class="bg-gray-700 border  text-white rounded-lg px-4 py-2 focus:outline-none focus:border-fuchsia-400 focus:ring-1 focus:ring-teal-500 transition"
                       placeholder="Nombre" required>
            </div>

            <!-- Select -->
            <div class="flex flex-col">
                <label for="especie" class="text-sm font-semibold text-gray-400 mb-1"></label>
                <select name="especie" id="especie" 
                        class="bg-gray-700 border  text-white rounded-lg px-4 py-2 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition appearance-none cursor-pointer"
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

@endsection