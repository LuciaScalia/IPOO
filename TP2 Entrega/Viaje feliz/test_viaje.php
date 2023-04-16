<?php

include_once "viaje.php";
include_once "Viaje feliz\pasajero.php";
include_once "Viaje feliz\ResponsableV.php";

do {
    echo "
1- Viaje nuevo.
2- Ingresar un pasajero.
3- Modificar la información de un pasajero.
4- Modificar la información del viaje.
5- Mostrar pasajeros.
6- Mostrar toda la información del viaje
7- Salir.
    
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
            echo "Datos del responsable del viaje:\n";
            echo "Número de empleado: ";
            $numEmpleado = trim(fgets(STDIN));
            echo "Número de licencia: ";
            $numLicencia = trim(fgets(STDIN));
            echo "Nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "Apellido: ";
            $apellido = trim(fgets(STDIN));

            $responsableV = new ResponsableV($numEmpleado, $numLicencia, $nombre, $apellido);
            $objViaje = new Viaje($codigo, $destino, $responsableV, $cantPasajeros);
            break;
        case 2:
            if (count($objViaje->getColeccionPasajeros()) == $objViaje->getCantPasajeros()) {
                echo "Limite de pasajeros alcanzado.\n";
            } else {
                echo "Número de documento: ";
                $numDocumento = trim(fgets(STDIN));
                if ($objViaje->buscarPasajero($numDocumento)) {
                    echo "Nombre: ";
                    $nombre = trim(fgets(STDIN));
                    echo "Apellido: ";
                    $apellido = trim(fgets(STDIN));
                    echo "Número de teléfono: ";
                    $numTelefono = trim(fgets(STDIN));
                    $nuevoPasajero = new Pasajero($nombre, $apellido, $numDocumento, $numTelefono);
                    $objViaje->agregarPasajero($nuevoPasajero);
                } else {
                    echo "El pasajero ya se encuentra en el sistema.\n";
                }
            }
            break;
        case 3;
            echo $objViaje->mostrarPasajeros();
            echo "Número de pasajero a modificar: ";
            $numPasajero = trim(fgets(STDIN));
            while ($numPasajero < 1 || $numPasajero > count($objViaje->getColeccionPasajeros())) {
                echo "Número de pasajero inválido. Ingrese otro: ";
                $numPasajero = trim(fgets(STDIN));
            }

            echo "1- Cambiar nombre. 2- Cambiar apellido. 3- Cambiar núm. de documento 4- Cambiar núm de teléfono 5- Cambiar todos los datos. Opción: ";
            $numOpcion = trim(fgets(STDIN));
            $todosLosPasajeros = $objViaje->getColeccionPasajeros();
            switch ($numOpcion) {
                case 1:
                    echo "Nuevo nombre: ";
                    $nombre = trim(fgets(STDIN));
                    $todosLosPasajeros[$numPasajero - 1]->setNombre($nombre);
                    $objViaje->setColeccionPasajeros($todosLosPasajeros);
                    break;
                case 2:
                    echo "Nuevo apellido: ";
                    $apellido = trim(fgets(STDIN));
                    $todosLosPasajeros[$numPasajero - 1]->setApellido($apellido);
                    $objViaje->setColeccionPasajeros($todosLosPasajeros);
                    break;
                case 3:
                    echo "Nuevo núm. de documento: ";
                    $numDocumento = trim(fgets(STDIN));
                    $todosLosPasajeros[$numPasajero - 1]->setNumDoc($numDocumento);
                    $objViaje->setColeccionPasajeros($todosLosPasajeros);
                    break;
                case 4:
                    echo "Nuevo núm de teléfono: ";
                    $numTelefono = trim(fgets(STDIN));
                    $todosLosPasajeros[$numPasajero - 1]->setTelefono($numTelefono);
                    $objViaje->setColeccionPasajeros($todosLosPasajeros);
                    break;
                case 5:
                    echo "Nuevo nombre: ";
                    $nombre = trim(fgets(STDIN));
                    echo "Nuevo apellido: ";
                    $apellido = trim(fgets(STDIN));
                    echo "Nuevo núm. de documento: ";
                    $numDocumento = trim(fgets(STDIN));
                    echo "Nuevo núm de teléfono: ";
                    $numTelefono = trim(fgets(STDIN));
                    $todosLosPasajeros[$numPasajero - 1]->setNombre($nombre);
                    $todosLosPasajeros[$numPasajero - 1]->setApellido($apellido);
                    $todosLosPasajeros[$numPasajero - 1]->setNumDoc($numDocumento);
                    $todosLosPasajeros[$numPasajero - 1]->setTelefono($numTelefono);
                    $objViaje->setColeccionPasajeros($todosLosPasajeros);
                    break;
            }
            break;
        case 4:
            echo "1- Cambiar el código. 2- Cambiar destino. 3- Cambiar cantidad de pasajeros. 4- Cambiar todos los datos. 5- Cambiar responsable del viaje.  Opción: ";
            $numOpcion = trim(fgets(STDIN));
            switch ($numOpcion) {
                case 1:
                    echo "Código nuevo: ";
                    $codigo = trim(fgets(STDIN));
                    $objViaje->setCodigoViaje($codigo);
                    break;
                case 2:
                    echo "Nuevo destino: ";
                    $destino = trim(fgets(STDIN));
                    $objViaje->setDestinoViaje($destino);
                    break;
                case 3:
                    echo "Cantidad de pasajeros: ";
                    $cantPasajeros = trim(fgets(STDIN));
                    $objViaje->setCantPasajeros($cantPasajeros);
                    break;
                case 4:
                    echo "Código nuevo: ";
                    $codigo = trim(fgets(STDIN));
                    echo "Nuevo destino: ";
                    $destino = trim(fgets(STDIN));
                    echo "Cantidad de pasajeros: ";
                    $cantPasajeros = trim(fgets(STDIN));
                    $objViaje->setCodigoViaje($codigo);
                    $objViaje->setDestinoViaje($destino);
                    $objViaje->setCantPasajeros($cantPasajeros);
                    break;
                case 5:
                    echo "1- Núm. de empleado. 2- Núm de licencia. 3- Nombre. 4- Apellido. 5- Todos los datos. Opción: ";
                    $numOpcion = trim(fgets(STDIN));
                    $responsableV = $objViaje->getResponsableV();
                    switch ($numOpcion) {
                        case 1:
                            echo "Nuevo núm. de empleado: ";
                            $numEmpleado = trim(fgets(STDIN));
                            $responsableV->setNumEmpleado($numEmpleado);
                            break;
                        case 2:
                            echo "Nuevo núm. de licencia: ";
                            $numLicencia = trim(fgets(STDIN));
                            $responsableV->setNumLicencia($numLicencia);
                            break;
                        case 3:
                            echo "Nuevo nombre: ";
                            $nombre = trim(fgets(STDIN));
                            $responsableV->setNombre($nombre);
                            break;
                        case 4:
                            echo "Nuevo apellido: ";
                            $apellido = trim(fgets(STDIN));
                            $responsableV->setApellido($apellido);
                            break;
                        case 5:
                            echo "Nuevo núm. de empleado: ";
                            $numEmpleado = trim(fgets(STDIN));
                            echo "Nuevo núm. de licencia: ";
                            $numLicencia = trim(fgets(STDIN));
                            echo "Nuevo nombre: ";
                            $nombre = trim(fgets(STDIN));
                            echo "Nuevo apellido: ";
                            $apellido = trim(fgets(STDIN));
                            $responsableV->setNumEmpleado($numEmpleado);
                            $responsableV->setNumLicencia($numLicencia);
                            $responsableV->setNombre($nombre);
                            $responsableV->setApellido($apellido);
                            break;
                    }
            }
            break;
        case 5:
            echo $objViaje->mostrarPasajeros();
            break;
        case 6:
            echo $objViaje;
            break;
    }
} while ($opcion != 7);
