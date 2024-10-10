<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {

        echo view('templates/cabecera');
        echo view('index');
        echo view('templates/footer');
    }

    public function quienes_Somos()
    {

        echo view('templates/cabecera');
        echo view('about');
        echo view('templates/footer');
    }

    public function contacto()
    {

        echo view('templates/cabecera');
        echo view('contacto');
        echo view('templates/footer');
    }

    public function comercializacion()
    {

        echo view('templates/cabecera');
        echo view('comercializacion');
        echo view('templates/footer');
    }

    public function terminosYUsos()
    {

        echo view('templates/cabecera');
        echo view('terminos');
        echo view('templates/footer');
    }

    public function politicasPrivacidad()
    {

        echo view('templates/cabecera');
        echo view('politicas');
        echo view('templates/footer');
    }

    public function preguntas()
    {

        echo view('templates/cabecera');
        echo view('preguntas');
        echo view('templates/footer');
    }
    public function login()
    {

        echo view('templates/cabecera');
        echo view('templates/footer');
    }
    public function productos()
    {

        echo view('templates/cabecera');
        echo view('templates/footer');
    }
}
