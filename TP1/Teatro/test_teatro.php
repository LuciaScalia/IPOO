<?php

include "teatro.php";

/**
 * Controla que el usuario ingrese un núm de función válido.
 * @param int $numeroDeFuncion
 * @return int
 */
function limiteFunciones($numeroDeFuncion)
{
    while ($numeroDeFuncion > 4 || $numeroDeFuncion < 0) {
        echo "Número inválido. \n";
        echo "Nuevo número de función: ";
        $numeroDeFuncion = trim(fgets(STDIN));
    }
    return $numeroDeFuncion;
}

$teatro = new Teatro("Teatro Colón", "Cerrito 628");

do {
    echo
    "\n\n1- Mostrar funciones.
2- Agregar función.
3- Cambiar nombre de una función.
4- Cambiar precio de una función.
5- Cambiar nombre del teatro.
6- Cambiar dirección del teatro.
7- Salir.

\nOpción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:
            $funciones = $teatro->mostrarFunciones();
            for ($i = 0; $i < 4; $i++) {
                echo $funciones[$i];
            }
            break;
        case 2:
            echo "Elija el núm. de función que desea cambiar: ";
            $numFuncion = trim(fgets(STDIN));
            limiteFunciones($numFuncion);

            echo "Nombre de función: ";
            $nombreFuncion = trim(fgets(STDIN));
            echo "Precio: ";
            $precioFuncion = trim(fgets(STDIN));

            $teatro->cambiarFuncion($nombreFuncion, $precioFuncion, $numFuncion);
            break;
        case 3:
            echo "Elija el núm. de función que desea cambiar: ";
            $numFuncion = trim(fgets(STDIN));
            limiteFunciones($numFuncion);

            echo "Nombre nuevo de la función: ";
            $nuevoNombre = trim(fgets(STDIN));

            $teatro->cambiarNombre($numFuncion, $nuevoNombre);
            $teatro->getFunciones();
            break;
        case 4:
            echo "Elija el núm. de función que desea cambiar: ";
            $numFuncion = trim(fgets(STDIN));
            limiteFunciones($numFuncion);

            echo "Precio nuevo de la función: ";
            $nuevoPrecio = trim(fgets(STDIN));

            $teatro->cambiarPrecio($numFuncion, $nuevoPrecio);
            break;
        case 5:
            echo "Nombre del teatro: ";
            $teatroNuevo = trim(fgets(STDIN));

            $teatro->setNombre($teatroNuevo);
            break;
        case 6:
            echo "Dirección del teatro: ";
            $direccionNueva = trim(fgets(STDIN));

            $teatro->setDireccion($direccionNueva);
    }
} while ($opcion != 7);

//echo $teatro-> __toString();