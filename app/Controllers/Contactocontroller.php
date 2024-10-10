<?php

namespace App\Controllers;
use App\Models\FormModel;
use CodeIgniter\Controller;

class Contactocontroller extends BaseController
{
    public function index()
    {
    	echo view('header');
    	echo view('nav_view');
         echo view('contacto');
          echo view('footer');
    }

    
    // Show consultas list
    public function Datos_consultas(){
        $consulModel = new FormModel();
        $estado = 'Pendiente';
        $data['consultas'] = $consulModel->getConsultas($estado);
        $dato['titulo']='Listado de Consultas'; 
        
        echo view('templates/cabecera',$dato);
         echo view('usuarios/consultas_view', $data);
          echo view('templates/footer');
       
    }

    public function ConsultaDetalle($id){
      $Model = new FormModel();
      $data=$Model->getConsulta($id);
            $dato['titulo']='Detalle Consulta'; 
                echo view('templates/cabecera',$dato);
                echo view('usuarios/DetalleConsulta_view',compact('data'));
                echo view('templates/footer');
    }

    public function deleteConsulta($id){
    
        $Model=new FormModel();
        $data=$Model->getConsulta($id);
        $datos=[
                'id' => 'id',
                'estado'  => 'Resuelta',
                
            ];
        $Model->update($id,$datos);

        session()->setFlashdata('msg','Consulta Resuelta');

        return redirect()->to(base_url('consultas'));
    }

    public function habilitarConsulta($id){
    
        $Model=new FormModel();
        $data=$Model->getConsulta($id);
        $datos=[
                'id' => 'id',
                'estado'  => 'Pendiente',
                
            ];
        $Model->update($id,$datos);

        session()->setFlashdata('msg','Consulta Habilitada Nuevamente');

        return redirect()->to(base_url('consultasResueltas'));
    }

    public function Datos_consultasResueltas(){
        $consulModel = new FormModel();
        $estado = 'Resuelta';
        $data['consultas'] = $consulModel->getConsultas($estado);
        $dato['titulo']='Listado de Consultas';
        
        echo view('templates/cabecera',$dato);
         echo view('usuarios/consultasResueltas_view', $data);
         echo view('templates/footer');
       
    }
	
 }