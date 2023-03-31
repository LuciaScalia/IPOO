<?php

include "login.php";

$login1 = new Login("lucia", 123, "la playa");
$login2 = new Login("laura", 321, "una bicicleta");
$login3 = new Login("daniel", 321, "messi");
$usuarios = [$login1, $login2, $login3];

do {
    echo "
\n\n1- Validar contraseña.
2- Cambiar contraseña.
3- Recordar contraseña.
4- Salir.

\nOpción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:
            echo "Ingrese la contraseña: ";
            $contrasenia = trim(fgets(STDIN));

            $contraseniaValida = $$login1->validarContrasenia($contrasenia);
            if ($contraseniaValida) {
                echo "Contraseña válida.\n";
            } else {
                echo "Contraseña inválida.\n";
            }
            break;
        case 2:
            echo "Ingrese la contraseña: ";
            $contrasenia = trim(fgets(STDIN));

            $cambioDeContra = $login1->cambiarContrasenia($contrasenia);
            while ($cambioDeContra == 1) {
                echo "Contraseña inválida. Nueva contraseña: ";
                $contrasenia = trim(fgets(STDIN));
                $cambioDeContra = $login1->cambiarContrasenia($contrasenia);
            }
            print_r($login1->getContraAlmacenadas());
            break;
        case 3:
            echo "Ingrese su nombre: ";
            $nombre = trim(fgets(STDIN));
            
            $cantUsuarios = count($usuarios);
            for ($i = 0; $i < $cantUsuarios-1; $i++) {
                $usuario = $usuarios[$i]->recordarContrasenia($nombre, $usuarios);
            }

            echo "\n--" . $usuario . "--";
    }
} while ($opcion != 4);
