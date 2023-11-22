<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {

        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if (empty($errores)) {
                //Verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    //Verificar si el usuario existe MENSAJE DE ERROR
                    $errores = Admin::getErrores();
                } else {
                    //Veririficar contraseña
                    $autenticado = $auth->comprobarPassword($resultado);
                    
                    if ($autenticado) {
                        //autenticar el usuario
                        $auth->autenticar();
                    } else {
                        //Verificar si la contraseña existe MENSAJE DE ERROR
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('/auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout()
    {
        if (!isset($_SESSION)) {
            session_start();

        }
        
        $_SESSION = [];

        header('Location: /');
    }
}
