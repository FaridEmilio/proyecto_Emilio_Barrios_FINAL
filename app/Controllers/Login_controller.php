<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios_model;

class Login_controller extends Controller
{
    public function index()
    {
        helper(['form', 'url']);
        $dato['titulo'] = 'login';
        echo view('templates/cabecera', $dato);
        echo view('login/login');
        echo view('templates/footer');
    }

    public function auth()
    {
        $session = session();
        $model = new Usuarios_model();

        // Obtener datos del formulario
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('pass');

        if (!$this->isEmailValido($email)) {
            session()->setFlashdata('error', 'El email ingresado no es válido.');
            return redirect()->to('/login_controller');
        }

        // Validar existencia del usuario
        $data = $model->where('email', $email)->first();

        if ($data) {
            // Verificar contraseña
            $hashedPassword = $data['pass'];
            if (password_verify($password, $hashedPassword)) {
                // Verificar si el usuario está dado de baja
                if ($data['baja'] == 'SI') {
                    $session->setFlashdata('msg', 'El usuario ha sido eliminado');
                    return redirect()->to('/login_controller');
                }

                // Configurar datos de sesión
                $ses_data = [
                    'id'        => $data['id'],
                    'nombre'    => $data['nombre'],
                    'apellido'  => $data['apellido'],
                    'email'     => $data['email'],
                    'usuario'   => $data['usuario'],
                    'telefono'  => $data['telefono'],
                    'direccion' => $data['direccion'],
                    'perfil_id' => $data['perfil_id'], // 1: Admin, 2: Usuario, etc.
                    'logged_in' => TRUE,
                ];

                $session->set($ses_data);

                // Redirigir según el perfil
                if ($data['perfil_id'] == 1) {
                    return redirect()->to('panel'); // Ruta para administradores
                } elseif ($data['perfil_id'] == 2) {
                    return redirect()->to('catalogo'); // Ruta para usuarios regulares
                } else {
                    $session->setFlashdata('msg', 'Usuario sin perfil asignado');
                    return redirect()->to('/login_controller');
                }
            } else {
                $session->setFlashdata('msg', 'Contraseña incorrecta. Por favor ingrese nuevamente');
                return redirect()->to('/login_controller');
            }
        } else {
            $session->setFlashdata('msg', 'No existe un usuario con el email proporcionado');
            return redirect()->to('/login_controller');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login_controller');
    }


    public function isEmailValido($email)
    {
        // Usar filtro de PHP para validar email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false; // Retorna falso si no es un email válido
        }

        // Validar que no contenga caracteres prohibidos (seguridad extra)
        $regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($regex, $email)) {
            return false; // Retorna falso si no cumple con el formato
        }

        return true; // Email válido
    }
}
