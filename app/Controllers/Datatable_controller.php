<?php 
namespace App\Controllers;
use App\Models\Usuarios_model;
use CodeIgniter\Controller;

class Datatable_controller extends Controller
{
    // Show users list
    public function index(){
        $userModel = new Usuarios_model();
        $baja='NO';
        $data['usuarios'] = $userModel->getUsBaja($baja);
        $dato['titulo']='Lista de Usuarios'; 
        
        echo view('templates/cabecera',$dato);
         echo view('usuarios/usuarios_view', $data);
          echo view('templates/footer');
       
    } 

    public function editar($id){

        $userModel=new Usuarios_model();
        $data=$userModel->getUsuario($id);
        $dato['titulo']='Editar Usuario';
        echo view('templates/cabecera',$dato);
         echo view('usuarios/editarUsuarios_view',compact('data'));
          echo view('templates/footer');
       
   }

   public function editoMisDatos($id){

        $userModel=new Usuarios_model();
        $data=$userModel->getUsuario($id);
        $dato['titulo']='Editar Usuario';
        echo view('templates/cabecera',$dato);
         echo view('usuarios/editoMisDatos_view',compact('data'));
          echo view('templates/footer');
       
   }

}