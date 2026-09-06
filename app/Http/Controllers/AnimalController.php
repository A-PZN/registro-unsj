<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
   
    private $animales;

    public function __construct()
    {
        // Se cargan los datos en la sesión o un array vacío si no hay nada
        $this->animales = session('animales', []);
    }

    public function index()
    {
        // No se carga la sesión porque ya lo hizo el constructor
        // Pasamos los datos a la vista
        return view('animales.index', ['animales' => $this->animales]);
    }

    // Devuelve el formulario vacío para que el usuario agregue un animal
    public function create()
    {
        return view('animales.create');
    }

    // Recibe los datos del formulario, valida y los guarda
    public function store(Request $request)
    {
        // Validamos que los datos lleguen correctos
        $validateData = $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
        ]);

        // En un arreglo creamos un nuevo animal y su id único
        $nuevoAnimal = [
            'id' => uniqid(),
            'nombre' => $validateData['nombre'],
            'especie' => $validateData['especie'],
        ];

        // Agregamos el nuevo animal a la lista
        $this->animales[] = $nuevoAnimal;

        // Se guarda la lista actualizada de vuelta en la sesión
        session(['animales' => $this->animales]);

        // Redirigimos al usuario a la lista de animales
        return redirect()->route('animales.index')->with('success', 'Animal creado correctamente');
    }

    // Buscamos el animal en la lista con su id
    public function edit($id)
    {
        // Se usa collect para convertir una lista en una colección
        // y firstWhere para buscar el elemento donde el id es igual al que recibimos
        $animal = collect($this->animales)->firstWhere('id', $id);

        // Verifica si existe un animal con ese id, si no existe lo redirigimos al inicio
        if (!$animal) {
            return redirect()->route('animales.index')->with('error', 'Animal no encontrado');
        }

        // Se envían los datos a la vista con la variable animal
        return view('animales.edit', ['animal' => $animal]);
    }

    // Recibe los datos modificados del formulario y actualiza el animal
    public function update(Request $request, $id)
    {
        // Valida que los datos sean correctos
        $validateData = $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
        ]);

        // Con array_map crea un nuevo array, recorre cada animal y si coincide el id lo actualizamos
        // devuelve array_merge con el animal actualizado
        $this->animales = array_map(function ($animal) use ($id, $validateData) {
            return ($animal['id'] == $id)
                // Si el animal es el que buscamos lo actualiza, sino lo deja igual
                ? array_merge($animal, $validateData)
                : $animal;
        }, $this->animales);

        // Guardar en sesión
        session(['animales' => $this->animales]);

        // Redirigir
        return redirect()->route('animales.index')->with('success', 'Animal actualizado correctamente');
    }

    // Elimina el animal de la lista
    public function destroy($id)
    {
        // En una lista guardamos los animales que NO queremos eliminar
        $RestoAnimal = [];

        // Por cada animal en la lista actual
        foreach ($this->animales as $animal) {
            // Preguntamos que el id sea distinto al que recibimos
            if ($animal['id'] != $id) {
                // Se agregan los que cumplen la condición
                $RestoAnimal[] = $animal;
            }
            // Si no, se ignora
        }

        // Se actualiza la lista
        $this->animales = $RestoAnimal;

        // Guardar la lista actualizada en la sesión
        session(['animales' => $this->animales]);

        return redirect()->route('animales.index')->with('success', 'Animal eliminado correctamente');
    }
}