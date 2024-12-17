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

    /**
     * Función para centralizar reglas de validación
     */
    private function getValidationRules($isEdit = false)
    {
        $rules = [
            'nombre'   => 'required|alpha_space|min_length[3]|max_length[20]',
            'apellido' => 'required|alpha_space|min_length[3]|max_length[20]',
            'email'    => 'required|min_length[4]|max_length[50]|valid_email',
            'usuario'  => 'required|min_length[3]',
            'telefono' => 'required|numeric|min_length[10]|max_length[10]',
            'direccion' => 'required|max_length[50]',
            'pass'     => !$isEdit ? 'required|min_length[8]|max_length[16]' : 'permit_empty|min_length[8]|max_length[16]',
        ];

        // Solo se agrega la validación de email único en creación, no en edición
        if (!$isEdit) {
            $rules['email'] .= '|is_unique[usuarios.email]';
        }

        return $rules;
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

    /**
     * Renderiza las vistas con cabecera y footer
     */
    private function render($view, $data = [])
    {
        return view('templates/cabecera', $data)
            . view($view, $data)
            . view('templates/footer', $data);
    }

    /**
     * Página de registro
     */
    public function create()
    {
        $data['titulo'] = 'Registro';
        return $this->render('register/registrarse', $data);
    }

    /**
     * Validación y registro de usuario
     */
    public function formValidation()
    {
        $validationRules = $this->getValidationRules();

        if (!$this->validate($validationRules)) {
            $data['titulo'] = 'Registro';
            return $this->render('register/registrarse', ['validation' => $this->validator]);
        }

        // Validar email con la función personalizada
        $email = $this->request->getVar('email');
        if (!$this->isEmailValido($email)) {
            $data['titulo'] = 'Registro';
            session()->setFlashdata('fail', 'El email ingresado no es válido.');
            return $this->render('register/registrarse');
        }

        if ($this->request->getVar('perfil_id')) {
            $validationRules['perfil_id'] = 'required|in_list[1,2]';
        }

        $usuarioModel = new Usuarios_model();

        $usuarioModel->save([
            'nombre'    => esc($this->request->getVar('nombre')),
            'apellido'  => esc($this->request->getVar('apellido')),
            'usuario'   => esc($this->request->getVar('usuario')),
            'telefono'  => esc($this->request->getVar('telefono')),
            'direccion' => esc($this->request->getVar('direccion')),
            'email'     => esc($this->request->getVar('email')),
            'pass'      => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
            'perfil_id' => $this->request->getVar('perfil_id') ?? 2, // Si no se define, por defecto es cliente (2)

        ]);

        session()->setFlashdata('success', 'Registro completado con éxito');
        return redirect()->to(base_url('/login'));
    }

    /**
     * Validación y edición de usuario
     */
    public function formValidationEdit()
    {
        $id = $this->request->getVar('id');
        if (!$id) {
            session()->setFlashdata('fail', 'ID de usuario no válido');
            return redirect()->back();
        }

        $usuarioModel = new Usuarios_model();
        $existingUser = $usuarioModel->find($id);

        if (!$existingUser) {
            session()->setFlashdata('fail', 'Usuario no encontrado');
            return redirect()->back();
        }

        $validationRules = $this->getValidationRules(true);
        $validationRules['email'] = "required|valid_email|is_unique[usuarios.email,id,{$id}]";


        if (!$this->validate($validationRules)) {
            $data['titulo'] = 'Editar Usuario';
            return $this->render('usuarios/editarUsuarios_view', ['validation' => $this->validator, 'data' => $existingUser]);
        }

        $datos = [
            'nombre'    => esc($this->request->getVar('nombre')),
            'apellido'  => esc($this->request->getVar('apellido')),
            'usuario'   => esc($this->request->getVar('usuario')),
            'telefono'  => esc($this->request->getVar('telefono')),
            'direccion' => esc($this->request->getVar('direccion')),
            'email'     => esc($this->request->getVar('email')),
            'perfil_id'     => esc($this->request->getVar('perfil_id')),
        ];

        $newPass = $this->request->getVar('pass');
        if (!empty($newPass)) {
            $datos['pass'] = password_hash($newPass, PASSWORD_DEFAULT);
        }

        $usuarioModel->update($id, $datos);

        session()->setFlashdata('success', 'Usuario editado con éxito');
        return redirect()->to(base_url('usuarios-list'));
    }

    /**
     * Página para crear un nuevo usuario (solo para administradores).
     */
    public function nuevoUsuario()
    {
        $data['titulo'] = 'Nuevo Usuario';
        return $this->render('admin/creoNuevoUsuario_view', $data);
    }

    /**
     * Validación y creación de usuario por administrador.
     */
    public function formValidationAdmin()
    {
        // Reglas de validación extendidas para incluir el campo `perfil_id`
        $validationRules = $this->getValidationRules();
        $validationRules['perfil_id'] = 'required|in_list[1,2]'; // Solo Admin o Cliente

        // Validar los datos recibidos
        if (!$this->validate($validationRules)) {
            $data['titulo'] = 'Nuevo Usuario';
            return $this->render('admin/creoNuevoUsuario_view', ['validation' => $this->validator]);
        }

        // Validar email con la función personalizada (extra seguridad)
        $email = $this->request->getVar('email');
        if (!$this->isEmailValido($email)) {
            session()->setFlashdata('fail', 'El email ingresado no es válido.');
            return $this->render('admin/creoNuevoUsuario_view');
        }

        // Guardar los datos del nuevo usuario
        $usuarioModel = new Usuarios_model();
        $usuarioModel->save([
            'nombre'    => esc($this->request->getVar('nombre')),
            'apellido'  => esc($this->request->getVar('apellido')),
            'usuario'   => esc($this->request->getVar('usuario')),
            'telefono'  => esc($this->request->getVar('telefono')),
            'direccion' => esc($this->request->getVar('direccion')),
            'email'     => esc($this->request->getVar('email')),
            'pass'      => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
            'perfil_id' => $this->request->getVar('perfil_id'), // Admin o Cliente
        ]);

        // Mensaje de éxito y redirección
        session()->setFlashdata('success', 'Usuario creado con éxito.');
        return redirect()->to(base_url('usuarios-list'));
    }

    /**
     * Eliminar usuario lógicamente (marcar como baja)
     */
    public function delete($id)
    {
        if (!$id) {
            session()->setFlashdata('fail', 'ID de usuario no válido');
            return redirect()->back();
        }

        $usuarioModel = new Usuarios_model();

        $usuario = $usuarioModel->find($id);
        if (!$usuario) {
            session()->setFlashdata('fail', 'Usuario no encontrado');
            return redirect()->to(base_url('usuarios-list'));
        }

        $usuarioModel->update($id, ['baja' => 'SI']);
        session()->setFlashdata('success', 'Usuario eliminado con éxito');
        return redirect()->to(base_url('usuarios-list'));
    }

    /**
     * Habilitar usuario (marcar como no baja)
     */
    public function habilitar($id)
    {
        if (!$id) {
            session()->setFlashdata('fail', 'ID de usuario no válido');
            return redirect()->back();
        }

        $usuarioModel = new Usuarios_model();

        $usuario = $usuarioModel->find($id);
        if (!$usuario) {
            session()->setFlashdata('fail', 'Usuario no encontrado');
            return redirect()->to(base_url('eliminados'));
        }

        $usuarioModel->update($id, ['baja' => 'NO']);
        session()->setFlashdata('success', 'Usuario habilitado con éxito');
        return redirect()->to(base_url('eliminados'));
    }

    /**
     * Usuarios eliminados
     */
    public function usuariosEliminados()
    {
        $usuarioModel = new Usuarios_model();
        $data['usuarios'] = $usuarioModel->where('baja', 'SI')->findAll();
        $dato['titulo'] = 'Usuarios Eliminados';
        return $this->render('usuarios/listUS_Eliminados_view', $data);
    }

    public function usuarioEdit()
    {
        $id = $this->request->getVar('id');

        // Verificar si el ID es válido
        if (!$id) {
            session()->setFlashdata('fail', 'ID de usuario no válido');
            return redirect()->back();
        }

        $usuarioModel = new Usuarios_model();
        $existingUser = $usuarioModel->find($id);

        // Verificar si el usuario existe
        if (!$existingUser) {
            session()->setFlashdata('fail', 'Usuario no encontrado');
            return redirect()->back();
        }

        // Obtener las reglas de validación para edición
        $validationRules = $this->getValidationRules(true);

        // Validar que el email sea único, excluyendo el usuario actual
        $validationRules['email'] = "required|valid_email|is_unique[usuarios.email,id,{$id}]";

        // Validar los datos recibidos
        if (!$this->validate($validationRules)) {
            // Guardar errores en Flashdata y retornar
            return redirect()->back()
                ->withInput()
                ->with('validationErrors', $this->validator->getErrors());
        }

        // Preparar los datos para la actualización
        $datos = [
            'nombre'    => esc($this->request->getVar('nombre')),
            'apellido'  => esc($this->request->getVar('apellido')),
            'usuario'   => esc($this->request->getVar('usuario')),
            'telefono'  => esc($this->request->getVar('telefono')),
            'direccion' => esc($this->request->getVar('direccion')),
            'email'     => esc($this->request->getVar('email')),
        ];

        // Actualizar contraseña solo si se envía un nuevo valor
        $newPass = $this->request->getVar('pass');
        if (!empty($newPass)) {
            $datos['pass'] = password_hash($newPass, PASSWORD_DEFAULT);
        }

        // Actualizar el usuario en la base de datos
        $usuarioModel->update($id, $datos);

        // Mensaje de éxito
        session()->setFlashdata('success', 'Perfil editado con éxito');
        return redirect()->to(base_url('catalogo'));
    }
}
