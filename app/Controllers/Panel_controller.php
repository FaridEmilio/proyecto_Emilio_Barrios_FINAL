<?php 
namespace App\Controllers;
  
use CodeIgniter\Controller;
  
class Panel_controller extends Controller
{
    public function index()
    {
        
        
         $dato['titulo']='Panel del Usuario'; 
        echo view('templates/cabecera',$dato);
        echo view('index');
        echo view('templates/footer');
     
    }
}