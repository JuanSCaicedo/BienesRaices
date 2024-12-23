<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index( Router $router ) {

        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router) {
        $router->render('/paginas/nosotros');
    }

    public static function propiedades( Router $router ) {

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {

        $id = validarORedireccionar('/propiedades');

        //Buscar por su id
        $propiedad = Propiedad::find($id);
       
        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog( Router $router ) {

        $router->render('paginas/blog');
    }

    public static function entrada( Router $router ) {
        $router->render('paginas/entrada');
    }


    public static function contacto( Router $router ) {

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validar 
            $respuesta = $_POST['contacto'];
           
            //Crear una instancia de PHP mailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure= 'tls';
            $mail->Port = $_ENV['EMAIL_PORT'];

            //Configurar contenido de email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p> Tienes un nuevo mensaje </p>';
            $contenido .= '<p> Nombre: ' . $respuesta['nombre'] . ' </p>';

            //Enviar de forma condicional campos de email y telefono
            if($respuesta['contacto'] === 'telefono') {
                $contenido .= '<p>Eligió ser contactado por teléfono </p>';
                $contenido .= '<p> Teléfono: ' . $respuesta['telefono'] . ' </p>';
                $contenido .= '<p> Fecha contacto: ' . $respuesta['fecha'] . ' </p>';
                $contenido .= '<p> Hora: ' . $respuesta['hora'] . ' </p>';
            } else {
                $contenido .= '<p>Eligió ser contactado por email </p>';
                $contenido .= '<p> Email: ' . $respuesta['email'] . ' </p>';
            }

            $contenido .= '<p> Mensaje: ' . $respuesta['mensaje'] . ' </p>';
            $contenido .= '<p> Vende o Compra: ' . $respuesta['tipo'] . ' </p>';
            $contenido .= '<p> Precio o Presupuesto: $' . $respuesta['precio'] . ' </p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            //Enviar email
            if($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "Mensaje no enviado";
            }

        }
        
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}