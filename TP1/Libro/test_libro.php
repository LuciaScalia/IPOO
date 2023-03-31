<?php

include "libro.php";

/**
 * @param string $libro
 * @param array $coleccionLibros
 * @return boolean
 */

function iguales($libro, $coleccionLibros)
{
    $cantLibros = count($coleccionLibros);
    $estaEnColeccion = true;
    $i = 0;
    
    while ($i < $cantLibros && $libro != $coleccionLibros[$i]->getTitulo()) {
        $i++;
    }

    if ($i == $cantLibros) {
        $estaEnColeccion = false;
    }

    return $estaEnColeccion;
}

/**
 * @param array $coleccionLibros
 * @param string $nombreEditorial
 * @return array
 */

function libroEditoriales($coleccionLibros, $nombreEditorial)
{
    $coleccionAutor = [];
    foreach ($coleccionLibros as $libro) {
        if ($libro->perteneceEditorial($nombreEditorial)) {
            array_push($coleccionAutor, $libro->getTitulo());
        }
    }
    return $coleccionAutor;
}

echo "Cant. de libros a ingresar: ";
$cantLibros = trim(fgets(STDIN));

$librosIngresados = [];
for ($i = 0; $i < $cantLibros; $i++) {
    echo "\nLibro " . $i + 1 . ":\n\n";
    echo "Título: ";
    $tituloLibro = trim(fgets(STDIN));
    $enColeccion = iguales($tituloLibro, $librosIngresados);

    while($enColeccion) {
        echo "El libro ya está en colección. Nuevo libro: ";
        $tituloLibro = trim(fgets(STDIN));
        $enColeccion = iguales($tituloLibro, $librosIngresados);
    }

    echo "Año de edición: ";
    $anioEdicionLibro = trim(fgets(STDIN));
    echo "Nombre de editorial: ";
    $editorialNombre = trim(fgets(STDIN));
    echo "Nombre de autor: ";
    $nombreAutorLibro = trim(fgets(STDIN));
    echo "Apellido de autor: ";
    $apellidoAutorLibro = trim(fgets(STDIN));

    $nuevoLibro = new Libro($tituloLibro, $anioEdicionLibro, $editorialNombre, $nombreAutorLibro, $apellidoAutorLibro);

    array_push($librosIngresados, $nuevoLibro);
}

echo "\n\nIngrese el año actual: ";
$anioActual = trim(fgets(STDIN));

foreach ($librosIngresados as $libro) {
    $aniosTranscurridos = $libro->aniosDesdeEdicion($anioActual);
    echo "Libro: '" . $libro->getTitulo() . "'  Años transcurridos desde su edición: " . $aniosTranscurridos . "\n";
}

//echo $librosIngresados[0]->__toString()."\n";
//echo $librosIngresados[1]->__toString();

$librosMismaEditorial = libroEditoriales($librosIngresados, "editorial1");
print_r($librosMismaEditorial);