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
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('pass');
        $data = $model->where('email', $email)->first();
        if ($data) {
            $pass = $data['pass'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                if ($data['baja'] == 'SI') {
                    $session->setFlashdata('msg', 'Usted fue dado de Baja');
                    return redirect()->to('/login_controller');
                } else {
                    $ses_data = [
                        'id' => $data['id'],
                        'nombre' => $data['nombre'],
                        'apellido' => $data['apellido'],
                        'email' =>  $data['email'],
                        'usuario' => $data['usuario'],
                        'telefono' => $data['telefono'],
                        'direccion' => $data['direccion'],
                        'perfil_id' => $data['perfil_id'],
                        'logged_in'     => TRUE
                    ];
                    $session->set($ses_data);

                    return redirect()->to('panel');
                }
            } else {
                $session->setFlashdata('msg', 'Password Incorrecta');
                return redirect()->to('/login_controller');
            }
        } else {
            $session->setFlashdata('msg', 'Email Incorrecto');
            return redirect()->to('/login_controller');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login_controller');
    }
}
