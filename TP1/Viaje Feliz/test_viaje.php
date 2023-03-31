<?php

include "viaje.php";

do {
    echo "
1- Viaje nuevo.
2- Ingresar pasajeros.
3- Modificar la información de un pasajero.
4- Modificar la información del viaje.
5- Mostrar pasajeros.
6- Salir.
    
Opción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:
            echo "Código de viaje: ";
            $codigo = trim(fgets(STDIN));
            echo "Destino: ";
            $destino = trim(fgets(STDIN));
            echo "Cantidad de pasajeros: ";
            $cantPasajeros = trim(fgets(STDIN));

            $nuevoViaje = new Viaje($codigo, $destino, $cantPasajeros);
            break;
        case 2:
            for ($i = 1; $i <= $cantPasajeros; $i++) {
                echo "\n\nPasajero N°" . $i . ": \n";
                echo "Nombre: ";
                $nombre = trim(fgets(STDIN));
                echo "Apellido: ";
                $apellido = trim(fgets(STDIN));
                echo "Número de documento: ";
                $numDocumento = trim(fgets(STDIN));
                $nuevoViaje->setPasajero($i, $nombre, $apellido, $numDocumento);
            }
            print_r($nuevoViaje->getPasajero());
            break;
        case 3;
            $cantidadPasajeros = count($nuevoViaje->getPasajero());
            echo "Cantidad de pasajeros: " . $cantidadPasajeros - 1 . ". Número de pasajero a modificar: ";
            $numPasajero = trim(fgets(STDIN));

            echo "1- Cambiar nombre. 2- Cambiar apellido. 3- Cambiar núm. de documento 4- Cambiar todos los datos. Opción: ";
            $numOpcion = trim(fgets(STDIN));
            switch ($numOpcion) {
                case 1:
                    echo "Nuevo nombre: ";
                    $nombre = trim(fgets(STDIN));
                    $nuevoViaje->setNombre($numPasajero, $nombre);
                    break;
                case 2:
                    echo "Nuevo apellido: ";
                    $apellido = trim(fgets(STDIN));
                    $nuevoViaje->setApellido($numPasajero, $apellido);
                    break;
                case 3:
                    echo "Nuevo núm. de documento: ";
                    $numDocumento = trim(fgets(STDIN));
                    $nuevoViaje->setDocumento($numPasajero, $numDocumento);
                    break;
                case 4:
                    echo "Nuevo nombre: ";
                    $nombre = trim(fgets(STDIN));
                    $nuevoViaje->setNombre($numPasajero, $nombre);
                    echo "Nuevo apellido: ";
                    $apellido = trim(fgets(STDIN));
                    $nuevoViaje->setApellido($numPasajero, $apellido);
                    echo "Nuevo núm. de documento: ";
                    $numDocumento = trim(fgets(STDIN));
                    $nuevoViaje->setDocumento($numPasajero, $numDocumento);
            }
            break;
        case 4:
            echo "1- Cambiar el código. 2- Cambiar destino. 3- Cambiar cantidad de pasajeros. 4- Cambiar todos los datos. Opción: ";
            $numOpcion = trim(fgets(STDIN));
            switch ($numOpcion) {
                case 1:
                    echo "Código nuevo: ";
                    $codigo = trim(fgets(STDIN));
                    $nuevoViaje->setCodigoViaje($codigo);
                    break;
                case 2:
                    echo "Nuevo destino: ";
                    $destino = trim(fgets(STDIN));
                    $nuevoViaje->setDestinoViaje($destino);
                    break;
                case 3:
                    echo "Cantidad de pasajeros: ";
                    $cantPasajeros = trim(fgets(STDIN));
                    $nuevoViaje->setCantPasajeros($cantPasajeros);
                    break;
                case 4:
                    echo "Código nuevo: ";
                    $codigo = trim(fgets(STDIN));
                    echo "Nuevo destino: ";
                    $destino = trim(fgets(STDIN));
                    echo "Cantidad de pasajeros: ";
                    $cantPasajeros = trim(fgets(STDIN));

                    $nuevoViaje->setViaje($codigo, $destino, $cantPasajeros);
            }
            break;
        case 5:
            $cantidadPasajeros = count($nuevoViaje->getPasajero());
            $pasajeros = $nuevoViaje->mostrarPasajeros();
            for ($i = 0; $i < $cantidadPasajeros - 1; $i++) {
                echo $pasajeros[$i];
            }
            break;
    }
} while ($opcion != 6);

// print_r($nuevoViaje->getViaje());
//print_r($nuevoViaje->getPasajero());
//$nuevoViaje->__toString();