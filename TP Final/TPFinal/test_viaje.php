<?php

include_once "Empresa.php";
include_once "Responsable.php";
include_once "Pasajero.php";
include_once "Viaje.php";

function mostrarTodo($todo)
{
    foreach ($todo as $i => $uno) {
        echo $i + 1 . ") " . $uno->__toString() . "\n\n";
    }
}

function menu()
{
    echo "\n\n--------------------------INGRESAR--------------------------";
    echo "\n1- Ingresar una empresa.\n2- Ingresar un responsable.\n3- Ingresar un viaje.\n4- Ingresar un pasajero.";
    echo "\n--------------------------ELIMINAR--------------------------";
    echo "\n5- Eliminar una empresa. \n6- Eliminar un responsable. \n7- Eliminar un viaje. \n8- Eliminar un pasajero.";
    echo "\n--------------------------MODIFICAR--------------------------";
    echo "\n9- Modificar una empresa. \n10- Modificar un responsable. \n11- Modificar un viaje. \n12- Modificar un pasajero.";
    echo "\n--------------------------MOSTRAR----------------------------";
    echo "\n13- Mostrar empresas.\n14- Mostrar responsables.\n15- Mostrar viajes.\n16- Mostrar pasajeros.\n17- Mostrar todos los datos.";
    echo "\n-------------------------------------------------------------\n18- Salir.\n\nOpcion: ";
    $opcion = trim(fgets(STDIN));
    while ($opcion < 0 || $opcion > 18) {
        echo "Numero de opcion invalido. Ingrese otro: ";
        $opcion = trim(fgets(STDIN));
    }
    return $opcion;
}

$objEmpresa = new Empresa();
$objResponsable = new Responsable();
$objPasajero = new Pasajero();
$objViaje = new Viaje();

do {
    $opcion = menu();
    $todasLasEmpresas = $objEmpresa->Listar();
    $todosLosViajes = $objViaje->Listar();
    $todosLosRes = $objResponsable->Listar();
    $todosLosPasajeros = $objPasajero->Listar();

    switch ($opcion) {
        case 1:
            echo "\nDatos de la empresa\n";
            echo "Nombre: ";
            $nombreEmpresa = trim(fgets(STDIN));
            echo "Direccion: ";
            $direccionEmpresa = trim(fgets(STDIN));

            $objEmpresa->Cargar(0, $nombreEmpresa, $direccionEmpresa);
            $i = 0;
            $existe = false;
            while ($i < count($todasLasEmpresas) && !$existe) {
                $unaEmpresa = $todasLasEmpresas[$i];
                if ($unaEmpresa->get_enombre() == $nombreEmpresa && $unaEmpresa->get_edireccion() == $direccionEmpresa) {
                    $existe = true;
                }
                $i++;
            }

            if (!$existe) {
                $consultaInsertar = $objEmpresa->Insertar();
                if ($consultaInsertar) {
                    echo "\nLA EMPRESA FUE INGRESADA A LA BASE DE DATOS CORRECTAMENTE";
                } else {
                    echo "\nLA EMPRESA NO PUDO SER INGRESADA A LA BASE DE DATOS";
                }
            } else {
                echo "\nLA EMPRESA YA SE ENCUENTRA EN LA BASE DE DATOS";
            }
            break;
        case 2:
            echo "\nDatos del responsable\n";
            echo "Numero de licencia: ";
            $numLicencia = trim(fgets(STDIN));
            echo "Nombre: ";
            $nombreRes = trim(fgets(STDIN));
            echo "Apellido: ";
            $apellidoRes = trim(fgets(STDIN));

            $objResponsable->Cargar(0, $numLicencia, $nombreRes, $apellidoRes);

            if ($objResponsable->Insertar()) {
                echo "\nEL RESPONSABLE FUE INGRESADO A LA BASE DE DATOS CORRECTAMENTE";
            } else {
                echo "\nEL RESPONSABLE NO PUDO SER INGRESADO A LA BASE DE DATOS";
            }
            break;
        case 3:
            echo "\nDatos del viaje\n";
            echo "Destino: ";
            $destinoViaje = trim(fgets(STDIN));
            echo "Cantidad maxima de pasajeros: ";
            $cantMaxPasajeros = trim(fgets(STDIN));
            echo "Importe: $";
            $importeViaje = trim(fgets(STDIN));
            echo "\nTodas las empresas\n";
            mostrarTodo($todasLasEmpresas);
            echo "\nID empresa: ";
            $idEmpresa = trim(fgets(STDIN));
            echo "\nTodos los responsables\n";
            mostrarTodo($todosLosRes);
            echo "Numero de empleado del responsable: ";
            $numRes = trim(fgets(STDIN));

            if ($objEmpresa->Buscar($idEmpresa) && $objResponsable->Buscar($numRes)) {
                $empresa = $objEmpresa->Listar('idempresa=' . $idEmpresa);
                $responsable = $objResponsable->Listar('rnumeroempleado=' . $numRes);
                $objViaje->Cargar($destinoViaje, $cantMaxPasajeros, $empresa[0], $responsable[0], $importeViaje, []);
                if ($objViaje->Insertar()) {
                    echo "\nEL VIAJE FUE INGRESADO A LA BASE DE DATOS CORRECTAMENTE";
                } else {
                    echo "\nEL VIAJE NO PUDO SER INGRESADO A LA BASE DE DATOS";
                }
            } else {
                echo "\nDATOS INGRESADOS INVALIDOS (ID EMPRESA/NUMERO EMPLEADO)";
            }
            break;
        case 4:
            echo "Datos del pasajero\n";
            echo "Numero de documento: ";
            $numDocPasajero = trim(fgets(STDIN));
            echo "Nombre: ";
            $nombrePasajero = trim(fgets(STDIN));
            echo "Apellido: ";
            $apellidoPasajero = trim(fgets(STDIN));
            echo "Telefono: ";
            $telefono = trim(fgets(STDIN));
            echo "\nTodos los viajes\n";
            mostrarTodo($todosLosViajes);
            echo "\nID del viaje: ";
            $idViaje = trim(fgets(STDIN));

            if ($objViaje->Buscar($idViaje)) {
                $pasajerosViaje = $objPasajero->Listar('idviaje=' . $idViaje);
                $viaje = $objViaje->Listar('idviaje=' . $idViaje);
                $viaje = $viaje[0];
                if (!$objPasajero->Buscar($numDocPasajero)) {
                    if (count($pasajerosViaje) < $viaje->get_vcantmaxpasajeros()) {
                        $objPasajero->Cargar($nombrePasajero, $apellidoPasajero, $numDocPasajero, $telefono, $idViaje);
                        if ($objPasajero->Insertar()) {
                            echo "\nEL PASAJERO FUE INGRESADO A LA BASE DE DATOS CORRECTAMENTE";
                        }
                    } else {
                        echo "\nCANTIDAD MAXIMA DE PASAJEROS ALCANZADA";
                    }
                } else {
                    echo "\nEL PASAJERO NO PUDO SER INGRESADO DE LA BASE DE DATOS";
                }
            } else {
                echo "\nEL VIAJE INGRESADO NO SE ENCUENTRA EN LA BASE DE DATOS";
            }
            break;
        case 5:
            echo "\nTodas las empresas:\n";
            mostrarTodo($todasLasEmpresas);

            echo "\nID de empresa a eliminar: ";
            $idEmpresa = trim(fgets(STDIN));

            if ($objEmpresa->Buscar($idEmpresa)) {
                $pudoEliminar = true;
                $empresa = $objEmpresa->Listar('idempresa=' . $idEmpresa);
                $empresa = $empresa[0];
                $viajesEmpresa = $objViaje->Listar('idempresa=' . $empresa->get_idempresa());
                $datos = [];
                if (count($viajesEmpresa) > 0) {
                    foreach ($viajesEmpresa as $unViaje) {
                        $pasajerosViaje = $objPasajero->Listar('idviaje=' . $unViaje->get_idviaje());
                        if (count($pasajerosViaje) > 0) {
                            foreach ($pasajerosViaje as $unPasajero) {
                                array_push($datos, $unPasajero);
                            }
                        }
                    }
                    foreach ($viajesEmpresa as $unViaje) {
                        array_push($datos, $unViaje);
                    }
                }
                array_push($datos, $empresa);
                echo "\nAL BORRAR ESTA EMPRESA TAMBIEN SE ELIMINARAN TODOS LOS DATOS RELACIONADOS A ELLA (VIAJES/PASAJEROS DE LOS VIAJE)";
                echo "\n¿DESEA CONTINUAR? \n\n1)SI 2)NO\n\nOPCION: ";
                $respuesta = trim(fgets(STDIN));
                if ($respuesta == 1) {
                    if (count($datos) > 1) {
                        $i = 0;
                        while ($i < count($datos) && $pudoEliminar) {
                            $eliminar = $datos[$i]->Eliminar();
                            if (!$eliminar) {
                                $pudoEliminar = false;
                            }
                            $i++;
                        }
                    } else {
                        if (!$empresa->Eliminar()) {
                            $pudoEliminar = false;
                        }
                    }

                    if ($pudoEliminar) {
                        echo "\nLOS DATOS FUERON ELIMINADOS DE LA BASE DE DATOS CORRECTAMENTE";
                    } else {
                        echo "\nLOS DATOS NO PUDIERON SER ELIMINADADOS DE LA BASE DE DATOS";
                    }
                }
            } else {
                echo "\nLA EMPRESA INGRESADA NO SE ENCUENTRA EN LA BASE DE DATOS";
            }
            break;
        case 6:
            echo "\nTodos los responsables\n";
            mostrarTodo($todosLosRes);
            echo "\nNumero de empleado: ";
            $numRes = trim(fgets(STDIN));
            if ($objResponsable->Buscar($numRes)) {
                echo "\nAL ALIMINAR ESTE RESPONSABLE DE LA BASE DE DATOS TAMBIEN SE ELIMINARAN LOS VIAJES RELACIONADOS A EL";
                echo "\n¿DESEA CONTINUAR? \n\n1)SI 2)NO\n\nOPCION: ";
                $respuesta = trim(fgets(STDIN));
                if ($respuesta == 1) {
                    $responsable = $objResponsable->Listar('rnumeroempleado=' . $numRes);
                    $responsable = $responsable[0];
                    if ($responsable->Eliminar()) {
                        echo "\nEL RESPONSABLE FUE ELIMINADO DE LA BASE DE DATOS CORRECTAMENTE";
                    } else {
                        echo "\nEL RESPONSABLE NO PUDO SER ELIMINADO DE LA BASE DE DATOS";
                    }
                }
            } else {
                echo "\nEL RESPONSABLE INGRESADO NO SE ENCUENTRA EN LA BASE DE DATOS";
            }
            break;
        case 7:
            echo "\nTodos los viajes\n";
            mostrarTodo($todosLosViajes);
            echo "ID de viaje: ";
            $idViaje = trim(fgets(STDIN));

            if ($objViaje->Buscar($idViaje)) {
                echo "\nAL BORRAR ESTE VIAJE TAMBIEN SE ELIMINARAN TODOS LOS PASAJEROS DEL VIAJE";
                echo "\n¿DESEA CONTINUAR? \n\n1)SI 2)NO\n\nOPCION: ";
                $respuesta = trim(fgets(STDIN));
                if ($respuesta == 1) {
                    $pudoEliminar = true;
                    $viaje = $objViaje->Listar('idviaje=' . $idViaje);
                    $pasajeros = $objPasajero->Listar('idviaje=' . $idViaje);
                    if (count($pasajeros) > 0) {
                        array_push($pasajeros, $viaje[0]);
                        $datos = $pasajeros;
                        $i = 0;
                        while ($i < count($datos) && $pudoEliminar) {
                            if (!$datos[$i]->Eliminar()) {
                                $pudoEliminar = false;
                            }
                            $i++;
                        }
                    } else {
                        if (!$viaje[0]->Eliminar()) {
                            $pudoEliminar = false;
                        }
                    }
                    if ($pudoEliminar) {
                        echo "\nLOS DATOS FUERON ELIMINADOS DE LA BASE DE DATOS CORRECTAMENTE";
                    } else {
                        echo "\nLOS DATOS NO PUDIERON SER ELIMINADOS";
                    }
                }
            } else {
                echo "\nEL VIAJE INGRESADO NO SE ENCUENTRA EN LA BASE DE DATOS";
            }
            break;
        case 8:
            echo "\nTodos los pasajeros\n";
            mostrarTodo($todosLosPasajeros);
            echo "Numero de documento: ";
            $numDocPasajero = trim(fgets(STDIN));
            if ($objPasajero->Buscar($numDocPasajero)) {
                $pasajero = $objPasajero->Listar('pdocumento=' . $numDocPasajero);
                $pasajero = $pasajero[0];
                if ($pasajero->Eliminar()) {
                    echo "\nEL PASAJERO SE ELIMINO DE LA BASE DE DATOS CORRECTAMENTE";
                } else {
                    echo "\nEL PASAJERO NO PUDO SER ELIMINADO DE LA BASE DE DATOS CORRECTAMENTE";
                }
            } else {
                echo "\nEL PASAJERO INGRESADO NO SE ENCUENTRA EN LA BASE DE DATOS";
            }
            break;
        case 9:
            echo "\nTodas las empresas\n";
            mostrarTodo($todasLasEmpresas);
            echo "\nID de la empresa: ";
            $idEmpresa = trim(fgets(STDIN));

            if ($objEmpresa->Buscar($idEmpresa)) {
                $empresa = $objEmpresa->Listar('idempresa=' . $idEmpresa);
                $empresa = $empresa[0];
                echo "1- Modificar nombre. 2- Modificar direccion 3- Modificar todos los datos.\nOpcion: ";
                $opcionM = trim(fgets(STDIN));

                switch ($opcionM) {
                    case 1:
                        echo "Nombre nuevo: ";
                        $nombreEmpresa = trim(fgets(STDIN));
                        $empresa->set_enombre($nombreEmpresa);
                        break;
                    case 2:
                        echo "Nueva direccion: ";
                        $direccionEmpresa = trim(fgets(STDIN));
                        $empresa->set_edireccion($direccionEmpresa);
                        break;
                    case 3;
                        echo "Nombre nuevo: ";
                        $nombreEmpresa = trim(fgets(STDIN));
                        echo "Nueva direccion: ";
                        $direccionEmpresa = trim(fgets(STDIN));
                        $empresa->set_enombre($nombreEmpresa);
                        $empresa->set_edireccion($direccionEmpresa);
                        break;
                }
                if ($empresa->Modificar()) {
                    echo "\nLOS DATOS DE LA EMPRESA SE HAN ACTUALIZADO CORRECTAMENTE";
                } else {
                    echo "\nLOS DATOS DE LA EMPRESA NO PUDIERON ACTUALIZARSE";
                }
            } else {
                echo "\nLA EMPRESA INGRESADA NO SE ENCUENTRA EN LA BASE DE DATOS";
            }
            break;
        case 10:
            echo "\nTodos los responsables\n";
            mostrarTodo($todosLosRes);
            echo "\nNumero de empleado: ";
            $numRes = trim(fgets(STDIN));
            if ($objResponsable->Buscar($numRes)) {
                $responsable = $objResponsable->Listar('rnumeroempleado=' . $numRes);
                $responsable = $responsable[0];
                echo "1- Modificar numero de licencia. 2- Modificar nombre. 3- Modificar apellido. 4- Modificar todos los datos.\nOpcion: ";
                $opcionM = trim(fgets(STDIN));

                switch ($opcionM) {
                    case 1:
                        echo "Numero de licencia nuevo: ";
                        $numLicencia = trim(fgets(STDIN));
                        $responsable->set_rnumerolicencia($numLicencia);
                        break;
                    case 2:
                        echo "Nombre nuevo: ";
                        $nombreRes = trim(fgets(STDIN));
                        $responsable->set_rnombre($nombreRes);
                        break;
                    case 3:
                        echo "Apellido nuevo: ";
                        $apellidoRes = trim(fgets(STDIN));
                        $responsable->set_rapellido($apellidoRes);
                        break;
                    case 4:
                        echo "Numero de licencia nuevo: ";
                        $numLicencia = trim(fgets(STDIN));
                        echo "Nombre nuevo: ";
                        $nombreRes = trim(fgets(STDIN));
                        echo "Apellido nuevo: ";
                        $apellidoRes = trim(fgets(STDIN));
                        $responsable->set_rnumerolicencia($numLicencia);
                        $responsable->set_rnombre($nombreRes);
                        $responsable->set_rapellido($apellidoRes);
                }
                if ($responsable->Modificar()) {
                    echo "\nLOS DATOS DEL RESPONSABLE SE HAN ACTUALIZADO CORRECTAMENTE";
                } else {
                    echo "\nLOS DATOS DEL RESPONSABLE NO PUDIERON ACTUALIZARSE";
                }
            } else {
                echo "\nEL RESPONSABLE INGRESADO NO SE ENCUENTRA EN LA BASE DE DATOS";
            }
            break;
        case 11:
            echo "\nTodos los viajes\n";
            mostrarTodo($todosLosViajes);
            echo "\nID del viaje: ";
            $idViaje = trim(fgets(STDIN));

            if ($objViaje->Buscar($idViaje)) {
                $encontro = false;
                $viaje = $objViaje->Listar('idviaje=' . $idViaje);
                $pasajerosViaje = $objPasajero->Listar('idviaje=' . $idViaje);
                $viaje = $viaje[0];
                echo "\n1- Modificar destino. 2- Modificar la cant. max. de pasajeros. 3- Modificar ID de empresa.\n\n4- Modificar numero de empleado. 5- Modificar importe. 6- Modificar todos los datos.\n\nOpcion: ";
                $opcionM = trim(fgets(STDIN));

                switch ($opcionM) {
                    case 1:
                        echo "Nuevo destino: ";
                        $destinoViaje = trim(fgets(STDIN));
                        $viaje->set_vdestino($destinoViaje);
                        break;
                    case 2:
                        echo "Nueva cant. max.: ";
                        $cantMaxPasajeros = trim(fgets(STDIN));
                        if ($cantMaxPasajeros < count($pasajerosViaje)) {
                            echo "\nLA CANTIDAD NO PUEDE SER MENOR A LA CANTIDAD DE PASAJEROS EXISTENTES. CANT PASAJEROS: " . count($pasajerosViaje);
                        } else {
                            $encontro = true;
                            $viaje->set_vcantmaxpasajeros($cantMaxPasajeros);
                        }
                        break;
                    case 3:
                        echo "\nTodas las empresas\n";
                        mostrarTodo($todasLasEmpresas);
                        echo "\nID de la empresa nueva: ";
                        $idEmpresa = trim(fgets(STDIN));

                        if ($objEmpresa->Buscar($idEmpresa)) {
                            $empresa = $objEmpresa->Listar('idempresa=' . $idEmpresa);
                            $viaje->set_objempresa($empresa[0]);
                            $encontro = true;
                        } else {
                            echo "\nID EMPRESA INVALIDA";
                        }
                        break;
                    case 4:
                        echo "\nTodos los responsables\n";
                        mostrarTodo($todosLosRes);
                        echo "\nNuevo numero de empleado: ";
                        $numRes = trim(fgets(STDIN));

                        if ($objResponsable->Buscar($numRes)) {
                            $responsable = $objResponsable->Listar('rnumeroempleado=' . $numRes);
                            $viaje->set_objempleado($responsable[0]);
                            $encontro = true;
                        } else {
                            echo "\nNUMERO DE EMPLEADO INVALIDO";
                        }
                        break;
                    case 5:
                        echo "Nuevo importe: $";
                        $importeViaje = trim(fgets(STDIN));
                        $viaje->set_vimporte($importeViaje);
                        break;
                    case 6:
                        echo "\nTodas las empresas\n";
                        mostrarTodo($todasLasEmpresas);
                        echo "\nID de la empresa nueva: ";
                        $idEmpresa = trim(fgets(STDIN));

                        echo "\nTodos los responsables\n";
                        mostrarTodo($todosLosRes);
                        echo "\nNuevo numero de empleado: ";
                        $numRes = trim(fgets(STDIN));

                        if ($objEmpresa->Buscar($idEmpresa) && $objResponsable->Buscar($numRes)) {
                            $empresa = $objEmpresa->Listar('idempresa=' . $idEmpresa);
                            $responsable = $objResponsable->Listar('rnumeroempleado=' . $numRes);
                            echo "Nueva cant. max.: ";
                            $cantMaxPasajeros = trim(fgets(STDIN));
                            if ($cantMaxPasajeros < count($pasajerosViaje)) {
                                echo "\nLA CANTIDAD NO PUEDE SER MENOR O IGUAL A LA CANTIDAD DE PASAJEROS EXISTENTES. CANT PASAJEROS: " . count($pasajerosViaje);
                            } else {
                                echo "Nuevo destino: ";
                                $destinoViaje = trim(fgets(STDIN));
                                echo "Nuevo importe: $";
                                $importeViaje = trim(fgets(STDIN));
                                $viaje->set_vimporte($importeViaje);
                                $viaje->set_vdestino($destinoViaje);
                                $viaje->set_objempresa($empresa[0]);
                                $viaje->set_objempleado($responsable[0]);
                                $viaje->set_vcantmaxpasajeros($cantMaxPasajeros);
                                $encontro = true;
                            }
                        } else {
                            echo "\nDATOS INVALIDOS";
                        }
                        break;
                }
                if ((($opcionM == 2 || $opcionM == 3 || $opcionM == 4 || $opcionM == 6) && $encontro) || $opcionM == 1 ||  $opcionM == 5) {
                    if ($viaje->Modificar()) {
                        echo "\nLOS DATOS DEL VIAJE SE ACTUALIZARON CORRECTAMENTE";
                    } else {
                        echo "\nLOS DATOS DEL VIAJE NO PUDIERON ACTUALIZARSE";
                    }
                }
            } else {
                echo "\nEL VIAJE INGRESADO NO SE ENCUENTRA EN LA BASE DE DATOS";
            }
            break;
        case 12:
            echo "\nTodos los pasajeros\n";
            mostrarTodo($todosLosPasajeros);
            echo "Numero de documeto: ";
            $numDocPasajero = trim(fgets(STDIN));

            if ($objPasajero->Buscar($numDocPasajero)) {
                $encontro = false;
                $pasajero = $objPasajero->Listar('pdocumento=' . $numDocPasajero);
                $pasajero = $pasajero[0];
                echo "1- Modificar nombre. 2- Modificar apellido. 3- Modificar telefono. 4- Modificar ID viaje. 5- Modificar todos los datos.\nOpcion: ";
                $opcionM = trim(fgets(STDIN));

                switch ($opcionM) {
                    case 1:
                        echo "Nombre nuevo: ";
                        $nombrePasajero = trim(fgets(STDIN));
                        $pasajero->set_pnombre($nombrePasajero);
                        break;
                    case 2:
                        echo "Apellido nuevo: ";
                        $apellidoPasajero = trim(fgets(STDIN));
                        $pasajero->set_papellido($apellidoPasajero);
                        break;
                    case 3:
                        echo "Telefono nuevo: ";
                        $telefono = trim(fgets(STDIN));
                        $pasajero->set_ptelefono($telefono);
                        break;
                    case 4:
                        echo "\nTodos los viajes\n";
                        mostrarTodo($todosLosViajes);
                        echo "\nNuevo ID del viaje: ";
                        $idViaje = trim(fgets(STDIN));

                        if ($objViaje->Buscar($idViaje)) {
                            $viaje = $objViaje->Listar('idviaje=' . $idViaje);
                            $viaje = $viaje[0];
                            $pasajerosViaje = $objPasajero->Listar('idviaje=' . $idViaje);
                            if (count($pasajerosViaje) < $viaje->get_vcantmaxpasajeros()) {
                                $pasajero->set_idviaje($idViaje);
                                $encontro = true;
                            } else {
                                echo "\nCANTIDAD MAXIMA DE PASAJEROS ALCANZADA";
                            }
                        } else {
                            echo "\nEL VIAJE INGRESADO NO SE ENCUENTRA EN LA BASE DE DATOS";
                        }
                        break;
                    case 5:
                        echo "\nTodos los viajes\n";
                        mostrarTodo($todosLosViajes);
                        echo "\nNuevo ID del viaje: ";
                        $idViaje = trim(fgets(STDIN));

                        if ($objViaje->Buscar($idViaje)) {
                            $viaje = $objViaje->Listar('idviaje=' . $idViaje);
                            $viaje = $viaje[0];
                            $pasajerosViaje = $objPasajero->Listar('idviaje=' . $idViaje);
                            if (count($pasajerosViaje) < $viaje->get_vcantmaxpasajeros()) {
                                echo "Nombre nuevo: ";
                                $nombrePasajero = trim(fgets(STDIN));
                                echo "Apellido nuevo: ";
                                $apellidoPasajero = trim(fgets(STDIN));
                                echo "Telefono nuevo: ";
                                $telefono = trim(fgets(STDIN));

                                $pasajero->set_idviaje($idViaje);
                                $pasajero->set_ptelefono($telefono);
                                $pasajero->set_papellido($apellidoPasajero);
                                $pasajero->set_pnombre($nombrePasajero);
                                $encontro = true;
                            } else {
                                echo "\nCANTIDAD MAXIMA DE PASAJEROS ALCANZADA";
                            }
                        } else {
                            echo "\nEL VIAJE INGRESADO NO SE ENCUENTRA EN LA BASE DE DATOS";
                        }
                        break;
                }
                if ((($opcionM == 4 || $opcionM == 5) && $encontro) || ($opcionM == 1 || $opcionM == 2 || $opcionM == 3)) {
                    if ($pasajero->Modificar()) {
                        echo "\nLOS DATOS DEL PASAJERO SE ACTUALIZARON CORRECTAMENTE";
                    } else {
                        echo "\nLOS DATOS DEL PASAJERO NO PUDIERON ACTUALIZARSE";
                    }
                }
            } else {
                echo "\nEL PASAJERO INGRESADO NO SE ENCUENTRA EN LA BASE DE DATOS";
            }
            break;
        case 13:
            echo "\n------------------------\n";
            echo "        EMPRESAS         ";
            echo "\n------------------------\n";
            mostrarTodo($todasLasEmpresas);
            break;
        case 14:
            echo "\n------------------------\n";
            echo "      RESPONSABLES         ";
            echo "\n------------------------\n";
            mostrarTodo($todosLosRes);
            break;
        case 15:
            echo "\n------------------------\n";
            echo "        VIAJES         ";
            echo "\n------------------------\n";
            mostrarTodo($todosLosViajes);
            break;
        case 16:
            echo "\n------------------------\n";
            echo "       PASAJEROS         ";
            echo "\n------------------------\n";
            mostrarTodo($todosLosPasajeros);
            break;
        case 17:
            echo "\n------------------------\n";
            echo "     TODOS LOS DATOS     ";
            echo "\n------------------------\n";
            echo "\nEMPRESAS:\n";
            mostrarTodo($todasLasEmpresas) . "\n";
            echo "\nRESPONSABLES:\n";
            mostrarTodo($todosLosRes) . "\n";
            echo "\nVIAJES:\n";
            mostrarTodo($todosLosViajes) . "\n";
            echo "\nPASAJEROS:\n";
            mostrarTodo($todosLosPasajeros) . "\n";
            break;
    }
} while ($opcion != 18);
