<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Verifica si el usuario está autenticado y es administrador
        if (!$session->get('logged_in') || $session->get('perfil_id') !== '1') {
            return redirect()->to('/login_controller')->with('error', 'Acceso denegado. Solo administradores.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No es necesario hacer nada después en este caso
    }
}
