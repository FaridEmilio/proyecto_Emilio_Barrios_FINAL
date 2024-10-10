<?php

namespace App\Controllers;

use App\Models\Usuarios_model;
use CodeIgniter\Controller;

class Usuario_controller extends Controller
{

    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function create()
    {
        $data['titulo'] = 'Registro';
        echo view('templates/cabecera', $data);
        echo view('register/registrarse');
        echo view('templates/footer');
    }

    public function formValidation()
    {
        //helper(['form', 'url']);

        $input = $this->validate([
            'nombre'   => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'email'    => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'usuario'  => 'required|min_length[3]',
            'telefono'  => 'required|min_length[10]|max_length[10]',
            'direccion'  => 'required|max_length[100]',
            'pass'     => 'required|min_length[3]|max_length[10]'
        ]);
        $formModel = new Usuarios_model();

        if (!$input) {
            $data['titulo'] = 'Registro';
            echo view('templates/cabecera', $data);
            echo view('register/registrarse', ['validation' => $this->validator]);
            echo view('templates/footer');
        } else {
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'usuario' => $this->request->getVar('usuario'),
                'telefono' => $this->request->getVar('telefono'),
                'direccion' => $this->request->getVar('direccion'),
                'email'  => $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
            ]);
            session()->setFlashdata('msg', 'Registro completado con éxito');
            return $this->response->redirect(site_url(''));
        }
    }


    public function nuevoUsuario()
    {
        $data['titulo'] = 'Crear Nuevo Usuario';
        echo view('templates/cabecera', $data);
        echo view('admin/creoNuevoUsuario_view');
        echo view('templates/footer');
    }

    public function formValidationAdmin()
    {
        //helper(['form', 'url']);

        $input = $this->validate([
            'nombre'   => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'email'    => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'usuario'  => 'required|min_length[3]',
            'telefono'  => 'required|min_length[10]|max_length[10]',
            'direccion'  => 'required|max_length[100]',
            'pass'     => 'required|min_length[3]|max_length[10]',
            'perfil_id' => 'required|max_length[1]'

        ]);
        $formModel = new Usuarios_model();

        if (!$input) {
            $data['titulo'] = 'Registro';
            echo view('header', $data);
            echo view('cabecera');
            echo view('back/Admin/creoNuevoUsuario_view', ['validation' => $this->validator]);
            echo view('footer');
        } else {
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'usuario' => $this->request->getVar('usuario'),
                'telefono' => $this->request->getVar('telefono'),
                'direccion' => $this->request->getVar('direccion'),
                'email'  => $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
                'perfil_id'  => $this->request->getVar('perfil_id'),

            ]);
            session()->setFlashdata('msg', 'Usuario creado con éxito');
            return redirect()->to(base_url('usuarios-list'));
        }
    }

    public function formValidationEdit()
    {

        //print_r($_POST);exit;

        $input = $this->validate([
            'nombre'   => 'required|min_length[3]|max_length[25]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'email'    => 'required|min_length[4]|max_length[100]|valid_email',
            'usuario'  => 'required|min_length[3]',
            'telefono'  => 'required|min_length[10]|max_length[10]',
            'direccion'  => 'required|max_length[100]',
            'perfil_id' => 'max_length[1]',
            'baja'  => 'required|max_length[2]'
        ]);
        $Model = new Usuarios_model();
        $id = $_POST['id'];
        if (!$input) {
            $data = $Model->getUsuario($id);
            $dato['titulo'] = 'Editar Usuario';
            echo view('templates/cabecera', $dato);
            echo view('usuarios/editarUsuarios_view', compact('data'));
            echo view('templates/footer');
        } else {
            //print_r($_POST);exit;
            $data = $Model->getUsuario($id);
            $pass = $data['pass'];
            $hash = $_POST['pass'];
            if ($hash == NULL) {
                $datos = [
                    'nombre' => $_POST['nombre'],
                    'apellido' => $_POST['apellido'],
                    'email' => $_POST['email'],
                    'usuario'  => $_POST['usuario'],
                    'telefono'  => $_POST['telefono'],
                    'direccion'  => $_POST['direccion'],
                    'perfil_id'  => $_POST['perfil_id'],
                    'baja'  => $_POST['baja'],

                ];
            } else {
                $datos = [
                    'id' => $_POST['id'],
                    'nombre' => $_POST['nombre'],
                    'apellido' => $_POST['apellido'],
                    'email' => $_POST['email'],
                    'usuario'  => $_POST['usuario'],
                    'telefono'  => $_POST['telefono'],
                    'direccion'  => $_POST['direccion'],
                    'pass' => password_hash($_POST['pass'], PASSWORD_DEFAULT),

                ];
            }

            // Actualizar en la base de datos
            $Model->update($id, $datos);

            session()->setFlashdata('msg', 'Usuario editado con éxito');

            return redirect()->to(base_url('usuarios-list'));
        }
    }
    public function usuariosEliminados()
    {
        $userModel = new Usuarios_model();
        $baja = 'SI';
        $data['usuarios'] = $userModel->getUsBaja($baja);
        $dato['titulo'] = 'Usuarios Eliminados';
        echo view('templates/cabecera', $dato);
        echo view('usuarios/listUS_Eliminados_view', $data);
        echo view('templates/footer');
    }

    public function usuarioEdit()
    {

        //print_r($_POST);exit;

        $input = $this->validate([
            'nombre'   => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'email'    => 'required|min_length[4]|max_length[100]|valid_email',
            'usuario'  => 'required|min_length[3]',
            'telefono'  => 'required|min_length[10]|max_length[10]',
            'direccion'  => 'required|max_length[100]',

        ]);
        $Model = new Usuarios_model();
        $id = $_POST['id'];
        if (!$input) {
            $data = $Model->getUsuario($id);
            $dato['titulo'] = 'Editar Usuario';
            echo view('templates/cabecera', $dato);
            echo view('usuarios/editoMisDatos_view', compact('data'));
            echo view('templates/footer');
        } else {
            $data = $Model->getUsuario($id);
            $pass = $data['pass'];
            $hash = $_POST['pass'];
            if ($hash == NULL) {
                $datos = [
                    'id' => $_POST['id'],
                    'nombre' => $_POST['nombre'],
                    'apellido' => $_POST['apellido'],
                    'email' => $_POST['email'],
                    'usuario'  => $_POST['usuario'],
                    'telefono'  => $_POST['telefono'],
                    'direccion'  => $_POST['direccion'],

                ];
            } else {
                $datos = [
                    'id' => $_POST['id'],
                    'nombre' => $_POST['nombre'],
                    'apellido' => $_POST['apellido'],
                    'email' => $_POST['email'],
                    'usuario'  => $_POST['usuario'],
                    'telefono'  => $_POST['telefono'],
                    'direccion'  => $_POST['direccion'],
                    'pass' => password_hash($_POST['pass'], PASSWORD_DEFAULT),

                ];
            }


            $Model->update($id, $datos);

            session()->setFlashdata('msg', 'Datos editados con éxito');

            return redirect()->to(base_url('/'));
        }
    }

    public function delete($id)
    {

        $Model = new Usuarios_model();
        $data = $Model->getUsuario($id);
        $datos = [
            'id' => 'id',
            'baja'  => 'SI',

        ];
        $Model->update($id, $datos);

        session()->setFlashdata('msg', 'Usuario eliminado con éxito');

        return redirect()->to(base_url('usuarios-list'));
    }

    public function habilitar($id)
    {

        $Model = new Usuarios_model();
        $data = $Model->getUsuario($id);
        $datos = [
            'id' => 'id',
            'baja'  => 'NO',

        ];
        $Model->update($id, $datos);

        session()->setFlashdata('msg', 'Usuario habilitado con éxito');

        return redirect()->to(base_url('eliminados'));
    }
}
