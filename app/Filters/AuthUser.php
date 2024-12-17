<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthUser implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Verifica si el usuario está autenticado
        if (!$session->get('logged_in') || $session->get('perfil_id') !== '2') {
            return redirect()->to('/login_controller')->with('error', 'Debes iniciar sesión para acceder.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No es necesario hacer nada después en este caso
    }
}
