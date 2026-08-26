<?php
// Tarea 1: Crear una función que haga búsqueda secuencial por DNI,
// Tarea 2: Crear una función que haga búsqueda binaria por DNI,
// Tarea 3: Crear una función que haga búsqueda secuencial por nombre,

$personas = [
    [
        "dni" => "12503000",
        "nombre" => "Juan",
        "edad" => 30,
        "ciudad" => "San Juan"
    ],
    [
        "dni" => "47304000",
        "nombre" => "Trinidada",
        "edad" => 20,
        "ciudad" => "San Luis"
    ],
    [
        "dni" => "1250200",
        "nombre" => "María",
        "edad" => 25,
        "ciudad" => "Mendoza"
    ],
    [
        "dni" => "27809000",
        "nombre" => "Lautaro",
        "edad" => 45,
        "ciudad" => "Cordoba"
    ]
];
//busqueda sequencial por dni 
function buscar_dni_sec(array $personas, string $dni_busca)
{
    $i = 0;
    $cant = count($personas);
    while ($i < $cant) {
        if ($personas[$i]["dni"] == $dni_busca) {
            return 1;
        }
        $i++;
    }
    return 0;
}
echo "\n--- RESULTADO BÚSQUEDA SECUNCIAL POR DNI  ---\n";
$dni = "1250200";
$valor = buscar_dni_sec($personas, $dni);
if ($valor == 1) {
    echo " El  " . $dni . " exite " . "\n";
} else {
    echo "No se enocontro el dni " . $dni . "\dni";
}



//busqueda secuencial por nom 
function buscar_nom_sec(array $personas, string $nom_busca): int
{
    $i = 0;
    $cant = count($personas);
    while ($i < $cant) {
        if (strtolower($personas[$i]["nombre"]) == (strtolower($nom_busca))) {
            return $i;
        }
        $i++;
    }
    return -1;
}

$nom = "carlos";
$valor = buscar_nom_sec($personas, $nom);

echo "\n--- RESULTADO BÚSQUEDA SECUNCIAL POR NOMBRE  ---\n";
if ($valor >= 0) {
    echo "Nombre encontrado " . $personas[$valor];
} else {
    echo "No exite el nombre :" . $nom;
}







#ordenado por lo culumno de dni 
usort($personas, function ($a, $b) {
    return $a['dni'] <=> $b['dni'];
});

echo "\n--- Arreglo ordenado asendentemente  ---\n";

for ($i = 0; $i < count($personas); $i++) {
    echo "DNI: " . $personas[$i]['dni'] . " - Nombre: " . $personas[$i]['nombre'] . "\n";
}

function buscar_dni_bin($personas, $dni_buscar)
{
    $inf = 0;
    $sup = count($personas) - 1;
    $mitad = intdiv($inf + $sup, 2);

    while ($inf <= $sup && $dni_buscar != $personas[$mitad]['dni']) {
        if ($dni_buscar < $personas[$mitad]['dni']) {
            $sup = $mitad - 1;
        } else {
            $inf = $mitad + 1;
        }
        $mitad = intdiv($inf + $sup, 2);
    }
    if ($inf <= $sup) {
        return $mitad;

    } else {
        return -1;
    }
}
echo "\n--- RESULTADO BÚSQUEDA BINARIA ---\n";
$resultado = buscar_dni_bin($personas, "12");
if ($resultado != -1) {
    echo "Dni encontrado" . $personas[$resultado]['nombre'];
} else {
    echo "Dni no encontrado";
}





