<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController {

    public static function index(Router $router) {

        estadoAutenticado();

        $vendedores = Vendedor::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('vendedores/index', [
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router) {

        estadoAutenticado();

        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;

        // Ejecutar el código después de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            estadoAutenticado();

            /** Crea una nueva instancia */
            $vendedor = new Vendedor($_POST['vendedor']);

            // Validar
            $errores = $vendedor->validar();


            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function actualizar(Router $router) {

        estadoAutenticado();

        $id = validarORedireccionar('/admin');

        // Obtener los datos de la propiedad
        $vendedor = Vendedor::find($id);

        // Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            estadoAutenticado();

            // Asignar los atributos
            $args = $_POST['vendedor'];
            $vendedor->sincronizar($args);

            // Validación
            $errores = $vendedor->validar();
            
            //Guardar
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar()
    {

        estadoAutenticado();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            estadoAutenticado();
            //Validar el id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                //Validar tipo a eliminar
                $tipo = $_POST['tipo'];

                if(validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}