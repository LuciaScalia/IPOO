<?php

include_once "NecesidadEspecial.php";
include_once "Pasajero.php";
include_once "ResponsableV.php";
include_once "Viaje.php";
include_once "Vip.php";

do {
    echo "
1- Viaje nuevo.
2- Vender pasaje.
3- Modificar la información de un pasajero.
4- Modificar la información del viaje.
5- Mostrar pasajeros.
6- Mostrar toda la información del viaje.
7- Salir.
    
Opción: ";
    $opcionMenu = trim(fgets(STDIN));

    switch ($opcionMenu) {
        case 1:
            echo "Código de viaje: ";
            $codigo = trim(fgets(STDIN));
            echo "Destino: ";
            $destino = trim(fgets(STDIN));
            echo "Precio: ";
            $precio = trim(fgets(STDIN));
            echo "Cantidad máxima de pasajeros: ";
            $maxPasajeros = trim(fgets(STDIN));
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
            $objViaje = new Viaje($codigo, $destino, $responsableV, $maxPasajeros, [], $precio);
            break;
        case 2:
            if ($objViaje->hayPasajesDisponibles()) {
                echo "1- Pasajero estandar 2- Pasajero VIP 3- Pasajero con necesidades especiales. Opción: ";
                $opcion = trim(fgets(STDIN));
                echo "Nombre: ";
                $nombre = trim(fgets(STDIN));
                echo "Apellido: ";
                $apellido = trim(fgets(STDIN));
                echo "Número de documento: ";
                $numDocumento = trim(fgets(STDIN));
                echo "Número de teléfono: ";
                $numTelefono = trim(fgets(STDIN));
                echo "Número de asiento: ";
                $numAsiento = trim(fgets(STDIN));
                echo "Número de ticket: ";
                $numTicket = trim(fgets(STDIN));
                if ($objViaje->ventaValida($numDocumento, $numAsiento, $numTicket)) {
                    switch ($opcion) {
                        case 1:
                            $nuevoPasajero = new Pasajero($nombre, $apellido, $numDocumento, $numTelefono, $numAsiento, $numTicket);
                            break;
                        case 2:
                            echo "Número de viajero frecuente: ";
                            $numViajeroFrecuente = trim(fgets(STDIN));
                            echo "Cantidad de millas: ";
                            $cantMillas = trim(fgets(STDIN));
                            $nuevoPasajero = new Vip($nombre, $apellido, $numDocumento, $numTelefono, $numAsiento, $numTicket, $numViajeroFrecuente, $cantMillas);
                            break;
                        case 3:
                            $servicios = [];
                            echo "\nServicios: \n-Silla de ruedas. \n-Asistencia para el embarque o desembarque. \n-Comidas especiales.
                            \nCantidad de servicios requeridos (1 a 3): ";
                            $cantServicios = trim(fgets(STDIN));
                            while ($cantServicios < 1 || $cantServicios > 3) {
                                echo "Cantidad inválida. Vuelva a ingresarla: ";
                                $cantServicios = trim(fgets(STDIN));
                            }
                            if ($cantServicios == 3) {
                                $servicios = ["Silla de ruedas", "Asistencia para el embarque o desembarque", "Comidas especiales"];
                            } else {
                                for ($i = 1; $i <= $cantServicios; $i++) {
                                    echo "Ingrese un servicio (escríbalo): ";
                                    $unServicio = trim(fgets(STDIN));
                                    array_push($servicios, $unServicio);
                                }
                            }
                            $nuevoPasajero = new NecesidadEspecial($nombre, $apellido, $numDocumento, $numTelefono, $numAsiento, $numTicket, $servicios);
                            break;
                    }
                    $objViaje->venderPasaje($nuevoPasajero);
                } else {
                    echo "\nNúmero de butaca, número de documento o número de ticket inválido.\n";
                }
            } else {
                echo "Limite de pasajeros alcanzado.\n";
            }
            break;
        case 3;
            echo "Número de documento del pasajero: ";
            $numDocumento = trim(fgets(STDIN));
            $todosLosPasajeros = $objViaje->getColeccionPasajeros();
            $numPasajero = $objViaje->buscarPasajero($numDocumento);
            $pasajero = $todosLosPasajeros[$numPasajero];
            if ($numPasajero != null || $numPasajero == 0) {
                echo "1- Pasajero estandar 2- Pasajero VIP 3- Pasajero con necesidades especiales. Opción: ";
                $opcionTipoP = trim(fgets(STDIN));
                while ($opcionTipoP < 1 || $opcionTipoP > 3) {
                    echo "Opción inválida. Vuelva a ingresarla: ";
                    $opcionTipoP = trim(fgets(STDIN));
                }
                switch ($opcionTipoP) {
                    case 1:
                        echo "0- Cambiar número de asiento/ticket 1- Cambiar nombre. 2- Cambiar apellido. 3- Cambiar núm. de documento 4- Cambiar núm de teléfono 5- Cambiar todos los datos. Opción: ";
                        $opcion = trim(fgets(STDIN));
                        break;
                    case 2:
                        echo "0- Cambiar número de asiento/ticket 1- Cambiar nombre. 2- Cambiar apellido. 3- Cambiar núm. de documento 4- Cambiar núm de teléfono 5- Cambiar todos los datos. 6- Cambiar núm. de viajero frecuente 7- Cambiar cantidad de millas. Opción: ";
                        $opcion = trim(fgets(STDIN));
                        break;
                    case 3:
                        echo "0- Cambiar número de asiento/ticket 1- Cambiar nombre. 2- Cambiar apellido. 3- Cambiar núm. de documento 4- Cambiar núm de teléfono 5- Cambiar todos los datos. 6- Cambiar servicios. Opción: ";
                        $opcion = trim(fgets(STDIN));
                }
                switch ($opcion) {
                    case 0:
                        echo "Nuevo número de asiento: ";
                        $numAsiento = trim(fgets(STDIN));
                        echo "Nuevo númeo de ticket: ";
                        $numTicket = trim(fgets(STDIN));
                        while (!$objViaje->ventaValida(null, $numAsiento, $numTicket)) {
                            echo "Datos inválidos. Nuevo número de asiento: ";
                            $numAsiento = trim(fgets(STDIN));
                            echo "Nuevo númeo de ticket: ";
                            $numTicket = trim(fgets(STDIN));
                        }
                        $todosLosPasajeros[$numPasajero]->set_numAsiento($numAsiento);
                        $todosLosPasajeros[$numPasajero]->set_numTicket($numTicket);
                    case 1:
                        echo "Nuevo nombre: ";
                        $nombre = trim(fgets(STDIN));
                        $todosLosPasajeros[$numPasajero]->set_nombre($nombre);
                        break;
                    case 2:
                        echo "Nuevo apellido: ";
                        $apellido = trim(fgets(STDIN));
                        $todosLosPasajeros[$numPasajero]->set_apellido($apellido);
                        break;
                    case 3:
                        echo "Nuevo núm. de documento: ";
                        $numDocumento = trim(fgets(STDIN));
                        $todosLosPasajeros[$numPasajero]->set_numDoc($numDocumento);
                        break;
                    case 4:
                        echo "Nuevo núm de teléfono: ";
                        $numTelefono = trim(fgets(STDIN));
                        $todosLosPasajeros[$numPasajero]->setTelefono($numTelefono);
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
                        echo "Nuevo número de asiento: ";
                        $numAsiento = trim(fgets(STDIN));
                        echo "Nuevo númeo de ticket: ";
                        $numTicket = trim(fgets(STDIN));
                        while (!$objViaje->ventaValida($numDocumento, $numAsiento, $numTicket)) {
                            echo "Datos inválidos:\n";
                            echo "Nuevo núm. de documento: ";
                            $numDocumento = trim(fgets(STDIN));
                            echo "Datos inválidos. Nuevo número de asiento: ";
                            $numAsiento = trim(fgets(STDIN));
                            echo "Nuevo númeo de ticket: ";
                            $numTicket = trim(fgets(STDIN));
                        }
                        $todosLosPasajeros[$numPasajero]->set_nombre($nombre);
                        $todosLosPasajeros[$numPasajero]->set_apellido($apellido);
                        $todosLosPasajeros[$numPasajero]->set_numDoc($numDocumento);
                        $todosLosPasajeros[$numPasajero]->setTelefono($numTelefono);
                        $todosLosPasajeros[$numPasajero]->set_numAsiento($numAsiento);
                        $todosLosPasajeros[$numPasajero]->set_numTicket($numTicket);
                        switch ($opcionTipoP) {
                            case 2:
                                echo "Nuevo número de viajero frecuente: ";
                                $numViajeroFrecuente = trim(fgets(STDIN));
                                echo "Cambiar cantidad de millas recorridas: ";
                                $cantMillas = trim(fgets(STDIN));
                                $todosLosPasajeros[$numPasajero]->set_numViajeroFrecuente($numViajeroFrecuente);
                                $todosLosPasajeros[$numPasajero]->set_cantMillas($cantMillas);
                                break;
                            case 3:
                                echo "Cantidad de servicios requeridos: ";
                                $cantServicios = trim(fgets(STDIN));
                                $servicios = [];
                                echo "\nServicios: \n-Silla de ruedas. \n-Asistencia para el embarque o desembarque. \n-Comidas especiales.
                                \nCantidad de servicios requeridos (1 a 3): ";
                                $cantServicios = trim(fgets(STDIN));
                                while ($cantServicios < 1 || $cantServicios > 3) {
                                    echo "Cantidad inválida. Vuelva a ingresarla: ";
                                    $cantServicios = trim(fgets(STDIN));
                                }
                                if ($cantServicios == 3) {
                                    $servicios = ["Silla de ruedas", "Asistencia para el embarque o desembarque", "Comidas especiales"];
                                } else {
                                    for ($i = 1; $i <= $cantServicios; $i++) {
                                        echo "Ingrese un servicio (escríbalo): ";
                                        $unServicio = trim(fgets(STDIN));
                                        array_push($servicios, $unServicio);
                                    }
                                }
                                $todosLosPasajeros[$numPasajero]->set_servicios($servicios);
                                break;
                        }
                        break;
                    case 6:
                        switch ($opcionTipoP) {
                            case 2:
                                echo "Nuevo número de viajero frecuente: ";
                                $numViajeroFrecuente = trim(fgets(STDIN));
                                $todosLosPasajeros[$numPasajero]->set_numViajeroFrecuente($numViajeroFrecuente);
                                break;
                            case 3:
                                echo "Cantidad de servicios requeridos: ";
                                $cantServicios = trim(fgets(STDIN));
                                $servicios = [];
                                echo "\nServicios: \n-Silla de ruedas. \n-Asistencia para el embarque o desembarque. \n-Comidas especiales.
                                \nCantidad de servicios requeridos (1 a 3): ";
                                $cantServicios = trim(fgets(STDIN));
                                while ($cantServicios < 1 || $cantServicios > 3) {
                                    echo "Cantidad inválida. Vuelva a ingresarla: ";
                                    $cantServicios = trim(fgets(STDIN));
                                }
                                if ($cantServicios == 3) {
                                    $servicios = ["Silla de ruedas", "Asistencia para el embarque o desembarque", "Comidas especiales"];
                                } else {
                                    for ($i = 1; $i <= $cantServicios; $i++) {
                                        echo "Ingrese un servicio (escríbalo): ";
                                        $unServicio = trim(fgets(STDIN));
                                        array_push($servicios, $unServicio);
                                    }
                                }
                                $todosLosPasajeros[$numPasajero]->set_servicios($servicios);
                                break;
                        }
                    case 7:
                        if ($opcionTipoP == 2) {
                            echo "Nueva cantidad de millas recorridas: ";
                            $cantMillas = trim(fgets(STDIN));
                            $todosLosPasajeros[$numPasajero]->set_cantMillas($cantMillas);
                        }
                        break;
                }
                $objViaje->setColeccionPasajeros($todosLosPasajeros);
            } else {
                echo "El pasajero no se encuentra en el sistema.";
            }
            break;
        case 4:
            echo "1- Cambiar el código. 2- Cambiar destino. 3- Cambiar cantidad de pasajeros. 4- Cambiar todos los datos. 5- Cambiar responsable del viaje. 6- Cambiar precio. Opción: ";
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
                    $maxPasajeros = trim(fgets(STDIN));
                    $objViaje->setMaxPasajeros($maxPasajeros);
                    break;
                case 4:
                    echo "Código nuevo: ";
                    $codigo = trim(fgets(STDIN));
                    echo "Nuevo destino: ";
                    $destino = trim(fgets(STDIN));
                    echo "Cantidad de pasajeros: ";
                    $maxPasajeros = trim(fgets(STDIN));
                    $objViaje->setCodigoViaje($codigo);
                    $objViaje->setDestinoViaje($destino);
                    $objViaje->setMaxPasajeros($maxPasajeros);
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
                    break;
                case 6:
                    echo "Nuevo precio: ";
                    $precio = trim(fgets(STDIN));
                    $objViaje->setPrecio($precio);
                    break;
            }
        case 5:
            echo $objViaje->mostrarPasajeros();
            break;
        case 6:
            echo $objViaje;
            break;
    }
} while ($opcionMenu != 7);
