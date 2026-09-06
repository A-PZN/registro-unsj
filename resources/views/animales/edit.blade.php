@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-md">
    
    <div class="bg-slate-800 rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold mb-6 text-white">Editar Datos </h1>
        <p class="text-gray-200 text-lg mb-6">
            Modifica los datos del animal.
        </p>

        <!-- Envía los datos a la ruta 'animales.update' pasando el ID
           method: Usamos @method('PUT') para simular la petición PUT
           y con el token de seguridad-->
        <form action="{{ route('animales.update', $animal['id']) }}" method="POST">
            @csrf
            @method('PUT') 
            
            <div class="mb-4">
                <label for="nombre" class="block text-gray-300 font-bold mb-2"></label>
                <input type="text" name="nombre" id="nombre" 
                       value="{{ $animal['nombre'] }}" 
                       class="w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded text-white focus:outline-none focus:border-yellow-500"
                       placeholder="Nombre" required>
            </div>

            
            <div class="mb-6">
                <label for="especie" class="block text-gray-300 font-bold mb-2"></label>
                <select name="especie" id="especie" 
                        class="w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded text-white focus:outline-none focus:border-yellow-500"
                        required>
                    <option value="">Selecciona una especie</option>
                    <!-- 
                     si la opción coincide con la especie actual, se marca como 'selected'.
                    -->
                    <option value="Perro" {{ $animal['especie'] == 'Perro' ? 'selected' : '' }}>Perro</option>
                    <option value="Gato" {{ $animal['especie'] == 'Gato' ? 'selected' : '' }}>Gato</option>
                    <option value="Ave" {{ $animal['especie'] == 'Ave' ? 'selected' : '' }}>Ave</option>
                    <option value="Otro" {{ $animal['especie'] == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

              <!-- Botón Cancelar  -->
            <div class="flex justify-between items-center">
                <a href="{{ route('animales.index') }}"class="px-3 py-1 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded-md text-sm font-semibold transition">Cancelar</a>
                <!-- Botón Actualizar  -->
                <button type="submit" class="px-3 py-1 border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-gray-900 rounded-md text-sm font-semibold transition">Actualizar</button> 
            </div>
        </form>
    </div>
</div>
@endsection