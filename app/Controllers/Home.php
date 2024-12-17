<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * Función para renderizar vistas con cabecera y footer
     *
     * @param string $view Nombre de la vista principal
     * @param array $data Datos a pasar a las vistas
     * @return string
     */
    private function render($view, $data = [])
    {
        return view('templates/cabecera', $data)
            . view($view, $data)
            . view('templates/footer', $data);
    }

    public function index()
    {
        $data = ['titulo' => 'Inicio'];
        return $this->render('index', $data);
    }

    public function quienes_Somos()
    {
        $data = ['titulo' => 'Quiénes Somos'];
        return $this->render('about', $data);
    }

    public function contacto()
    {
        $data = ['titulo' => 'Contacto'];
        return $this->render('contacto', $data);
    }

    public function comercializacion()
    {
        $data = ['titulo' => 'Comercialización'];
        return $this->render('comercializacion', $data);
    }

    public function terminosYUsos()
    {
        $data = ['titulo' => 'Términos y Usos'];
        return $this->render('terminos', $data);
    }

    public function politicasPrivacidad()
    {
        $data = ['titulo' => 'Política de Privacidad'];
        return $this->render('politicas', $data);
    }

    public function preguntas()
    {
        $data = ['titulo' => 'Preguntas Frecuentes'];
        return $this->render('preguntas', $data);
    }

    public function login()
    {
        $data = ['titulo' => 'Login'];
        return $this->render('login', $data);
    }

    public function productos()
    {
        $data = ['titulo' => 'Productos'];
        return $this->render('productos', $data);
    }
}
