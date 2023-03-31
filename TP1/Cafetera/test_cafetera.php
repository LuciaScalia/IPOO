<?php

include "cafetera.php";

echo "Capacidad máxima cafetera: ";
$capacidadMaxima  = trim(fgets(STDIN));
echo "Cantidad actual cafetera: ";
$cantidadActual  = trim(fgets(STDIN));

$cafetera = new Cafetera($capacidadMaxima, $cantidadActual);

do {
    echo "
\n\n1- Llenar cafetera.
2- Vaciar cafetera.
3- Servir.
4- Agregar café a la cafetera.
6- Salir.
    
\nOpción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:
            $cafetera->llenarCafetera();
            break;
        case 2:
            $cafetera->vaciarCafetera();
            break;
        case 3:
            echo "Cant. a servir: ";
            $cant = trim(fgets(STDIN));

            $tazaServida = $cafetera->servirTaza($cant);
            if ($cant != $tazaServida) {
                echo "Cantidad de café insuficiente. Se sirvió todo lo que quedaba: $tazaServida\n";
            }
            break;
        case 4:
            echo "Cant. a agregar: ";
            $cant = trim(fgets(STDIN));
            while ($cafetera->getCantActual() + $cant > $cafetera->getCantMax()) {
                echo "Capacidad excedida. Disminuya la cantidad. Capacidad máxima: " . $cafetera->getCantMax() . " Cant. actual: " . $cafetera->getCantActual() . "\n";
                echo "Nueva cant: ";
                $cant = trim(fgets(STDIN));
            }
            $cafetera->agregarCafe($cant);
    }
} while ($opcion != 6);

//echo $cafetera->__toString();
