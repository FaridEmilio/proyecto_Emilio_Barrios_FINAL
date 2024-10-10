<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
  
class Perfil_controller extends Controller
{
	//$session = \Config\Services::session($config)
    public function index()
    {

        $session = session();
        $name = $session->get('nombre');
        $id=$session->get('id');
  
       
        $dato['titulo']='usuario'; 
        echo view('front/head_view',$dato);
        echo view('front/nav_view');
       
         echo "Hola : ".$id;
         echo $session->get('nombre');
       echo view('front/footer_view');
     
     
    }
}
