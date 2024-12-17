<?php

namespace App\Controllers;

use App\Models\Productos_model;
use CodeIgniter\Controller;

class Producto_controller extends Controller
{

    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function nuevoProducto()
    {

        $data['titulo'] = 'Nuevo Producto';
        echo view('templates/cabecera', $data);
        echo view('productos/nuevoProducto_view');
        echo view('templates/footer');
    }

    public function ProductoValidation()
    {

        $input = $this->validate([
            'nombre'   => 'required|min_length[3]',
            'descripcion'   => 'required',
            'categoria_id' => 'required|min_length[1]|max_length[20]',
            'precio'    => 'required|min_length[2]|max_length[10]',
            'precio_vta'  => 'required|min_length[2]',
            'stock'     => 'required|min_length[1]|max_length[10]',
            'stock_min'     => 'required|min_length[1]|max_length[10]',


        ]);
        $ProductoModel = new Productos_model();

        if (!$input) {
            $data['titulo'] = 'Nuevo Producto';
            echo view('templates/cabecera', $data);
            echo view('productos/nuevoProducto_view', ['validation' => $this->validator]);
            echo view('templates/footer');
        } else {

            $img = $this->request->getFile('imagen');
            $nombre_aleatorio = $img->getRandomName();
            $img->move(ROOTPATH . 'assets/uploads', $nombre_aleatorio);

            $ProductoModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'descripcion' => $this->request->getVar('descripcion'),
                'imagen' => $img->getName(),
                'categoria_id' => $this->request->getVar('categoria_id'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta'  => $this->request->getVar('precio_vta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock_min'),
                'eliminado' => 'NO',

            ]);
            session()->setFlashdata('msg', 'Producto creado exitosamente');
            return redirect()->to(base_url('Lista_Productos'));
        }
    }

    public function ListaProductos()
    {
        $ProductosModel = new Productos_model();
        $eliminado = 'NO';
        $data['productos'] = $ProductosModel->getProdBaja($eliminado);
        $dato['titulo'] = 'Lista de Productos';

        echo view('templates/cabecera', $dato);
        echo view('productos/Productos_view', $data);
        echo view('templates/footer');
    }

    public function ProductosDisp()
    {
        $ProductosModel = new Productos_model();
        $eliminado = 'NO';
        $data['productos'] = $ProductosModel->getProdBaja($eliminado);
        $dato['titulo'] = 'Productos Disponibles';
        echo view('templates/cabecera', $dato);
        echo view('carrito/ProductosCart_view', $data);
        echo view('templates/footer');
    }

    public function Mantequilla_Mani()
    {
        $ProductosModel = new Productos_model();
        $tipo = '1';
        $data['productos'] = $ProductosModel->getTipo($tipo);
        $dato['titulo'] = 'Productos Disponibles';

        echo view('templates/cabecera', $dato);
        echo view('carrito/ProductosCart_view', $data);
        echo view('templates/footer');
    }

    public function Snack()
    {
        $ProductosModel = new Productos_model();
        $tipo = '2';
        $data['productos'] = $ProductosModel->getTipo($tipo);
        $dato['titulo'] = 'Productos Disponibles';

        echo view('templates/cabecera', $dato);
        echo view('carrito/ProductosCart_view', $data);
        echo view('templates/footer');
    }

    public function Cafe()
    {
        $ProductosModel = new Productos_model();
        $tipo = '3';
        $data['productos'] = $ProductosModel->getTipo($tipo);
        $dato['titulo'] = 'Productos Disponibles';

        echo view('templates/cabecera', $dato);
        echo view('carrito/ProductosCart_view', $data);
        echo view('templates/footer');
    }

    public function Otros()
    {
        $ProductosModel = new Productos_model();
        $tipo = '4';
        $data['productos'] = $ProductosModel->getTipo($tipo);
        $dato['titulo'] = 'Productos Disponibles';

        echo view('templates/cabecera', $dato);
        echo view('carrito/ProductosCart_view', $data);
        echo view('templates/footer');
    }

    public function getProductoEdit($id)
    {
        $Model = new Productos_model();
        $data = $Model->getProducto($id);

        // Mapear los IDs de categorías a sus nombres
        $categorias = [
            1 => 'Mantequilla de maní',
            2 => 'Snack',
            3 => 'Café',
            4 => 'Otros',
        ];

        // Obtener el nombre de la categoría actual
        $categoria = isset($categorias[$data['categoria_id']]) ? $categorias[$data['categoria_id']] : 'Sin categoría';

        $dato['titulo'] = 'Editar Producto';
        echo view('templates/cabecera', $dato);
        echo view('productos/editarProducto_view', compact('data', 'categoria'));
        echo view('templates/footer');
    }


    public function ProdValidationEdit()
    {
        $input = $this->validate([
            'nombre'   => 'required|min_length[3]',
            'descripcion'   => 'required',
            'categoria_id' => 'required|min_length[1]|max_length[20]',
            'precio'    => 'required|min_length[2]|max_length[10]',
            'precio_vta'  => 'required|min_length[2]',
            'stock'     => 'required|min_length[1]|max_length[10]',
            'stock_min'     => 'required|min_length[1]|max_length[10]',
            'eliminado' => 'required|in_list[NO,SI]',
        ]);

        $Model = new Productos_model();
        $id = $this->request->getPost('id'); // Obtener ID del producto

        if (!$input) {
            // Si falla la validación
            $data = $Model->getProducto($id);
            $dato['titulo'] = 'Editar Producto';
            $validation = $this->validator;

            return view('templates/cabecera', $dato)
                . view('productos/editarProducto_view', compact('data', 'validation'))
                . view('templates/footer');
        } else {
            // Si los datos son válidos
            $datos = [
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_id' => $this->request->getPost('categoria_id'),
                'precio' => $this->request->getPost('precio'),
                'precio_vta' => $this->request->getPost('precio_vta'),
                'stock' => $this->request->getPost('stock'),
                'stock_min' => $this->request->getPost('stock_min'),
                'eliminado' => $this->request->getPost('eliminado'),
            ];

            // Si hay una imagen nueva
            if ($this->request->getFile('imagen')->isValid()) {
                $img = $this->request->getFile('imagen');
                $nombre_aleatorio = $img->getRandomName();
                $img->move(ROOTPATH . 'assets/uploads', $nombre_aleatorio);
                $datos['imagen'] = $img->getName();
            }

            $Model->updateDatosProd($id, $datos);

            session()->setFlashdata('msg', 'Producto actualizado con éxito');
            return redirect()->to(base_url('Lista_Productos'));
        }
    }


    public function deleteProd($id)
    {

        $Model = new Productos_model();
        $data = $Model->getProducto($id);
        $datos = [
            'id' => 'id',
            'eliminado'  => 'SI',

        ];
        $Model->update($id, $datos);

        session()->setFlashdata('msg', 'Producto eliminado con éxito');

        return redirect()->to(base_url('Lista_Productos'));
    }

    public function ListaProductosElim()
    {
        $userModel = new Productos_model();
        $eliminado = 'SI';
        $data['productos'] = $userModel->getProdBaja($eliminado);
        $dato['titulo'] = 'Productos Eliminados';
        echo view('templates/cabecera', $dato);
        echo view('productos/listProd_Eliminados_view', $data);
        echo view('templates/footer');
    }

    public function habilitarProd($id)
    {

        $Model = new Productos_model();
        $data = $Model->getProducto($id);
        $datos = [
            'id' => 'id',
            'eliminado'  => 'NO',

        ];
        $Model->update($id, $datos);

        session()->setFlashdata('msg', 'Producto Habilitado');

        return redirect()->to(base_url('eliminadosProd'));
    }
}
