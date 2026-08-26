<?php

// Ejemplo de una función simple
function saludar(string $nombre) {
    return "Hola, " . $nombre . "!";
}

// Ejemplo de una función con parámetros opcionales
function calcularArea(float $base, ?float $altura = null) {
    if ($altura === null) {
        $altura = $base;
    }
    return $base * $altura;
}

// Llamada a la función saludar
echo saludar("Juan") . "\n";

// Llamada a la función calcularArea con ambos parámetros
echo "Área del rectángulo: " . calcularArea(5, 10) . "\n";

// Llamada a la función calcularArea con solo el parámetro base, usando el valor por defecto para altura
echo "Área del cuadrado: " . calcularArea(4) . "\n";