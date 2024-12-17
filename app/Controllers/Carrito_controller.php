<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Productos_model;
use App\Models\Cabecera_model;
use App\Models\VentaDetalle_model;
//use Dompdf\Dompdf;

class Carrito_controller extends Controller
{

	public function __construct()
	{
		helper(['form', 'url']);
	}
	//Rescato las ventas cabeceras y muestro.
	public function ListComprasCabecera()
	{
		//Me conecto a la base de datos
		$db = db_connect();
		//Me ubico en la tabla ventas_cabecera y genero un alias "u" y guardo su contenido en $bluider
		$builder = $db->table('ventas_cabecera u');
		//Selecciono de ambas tablas (Cabecera y Detalle) los campos que necesito mostrar en la vista
		$builder->select('u.id , d.nombre , d.apellido, d.telefono , d.direccion , u.total_venta , u.fecha , u.tipo_pago');
		//Con un Join relaciono los "id" de ambas tablas para generar una sola con todos los datos
		$builder->join('usuarios d', 'u.usuario_id = d.id');
		//Guardo el contenido de la relacion de ambas tablas en la variable $ventas
		$ventas = $builder->get();
		//Vuelvo a guardar toda la info pero en la forma de un array para mejor manejo.
		$datos['ventas'] = $ventas->getResultArray();
		//print_r($datos);
		//exit;

		$data['titulo'] = 'Listado de Compras';
		echo view('templates/cabecera', $data);
		echo view('usuarios/ListaCompras_view', $datos);
		echo view('templates/footer');
	}

	//Rescato las ventas cabeceras de este cliente y muestro.
	public function ListComprasCabeceraCliente($id)
	{
		$session = session();

		// Validar si el usuario está autenticado
		if (!$session->has('id')) {
			return redirect()->to(base_url('login'))->with('fail', 'Debes iniciar sesión.');
		}

		$usuario_id = $session->get('id'); // Obtener ID del usuario en sesión

		// Validar que el ID en la URL sea el mismo que el del usuario en sesión
		if ($id != $usuario_id || !is_numeric($id)) {
			return redirect()->to(base_url('catalogo'))->with('fail', 'Acceso no autorizado.');
		}

		// Continuar con la lógica original si la validación pasa
		// Me conecto a la base de datos
		$db = db_connect();

		// Me ubico en la tabla ventas_cabecera y genero un alias "u" y guardo su contenido en $builder
		$builder = $db->table('ventas_cabecera u');

		// Filtro las ventas para que solo rescate las ventas de este Cliente mediante su id.
		$builder->where('u.usuario_id', $id);

		// Selecciono de ambas tablas (Cabecera y Detalle) los campos que necesito mostrar en la vista
		$builder->select('u.id, d.nombre, d.apellido, d.telefono, d.direccion, u.total_venta, u.fecha, u.tipo_pago');

		// Con un Join relaciono los "id" de ambas tablas para generar una sola con todos los datos
		$builder->join('usuarios d', 'u.usuario_id = d.id');

		// Guardo el contenido de la relación de ambas tablas en la variable $ventas
		$ventas = $builder->get();

		// Vuelvo a guardar toda la info pero en la forma de un array para mejor manejo.
		$datos['ventas'] = $ventas->getResultArray();

		// Preparar y mostrar la vista
		$data['titulo'] = 'Listado de Compras';
		echo view('templates/cabecera', $data);
		echo view('usuarios/ListaCompras_view', $datos);
		echo view('templates/footer');
	}


	public function ListCompraDetalle($id)
	{
		$session = session();

		// Validar si el usuario está autenticado
		if (!$session->has('id')) {
			return redirect()->to(base_url('login'))->with('error', 'Debes iniciar sesión para ver esta información.');
		}

		$usuario_id = $session->get('id');       // ID del usuario autenticado
		$perfil_id  = $session->get('perfil_id'); // Perfil del usuario (1 = Admin, 2 = Cliente)

		$db = db_connect();

		// Si el usuario no es admin, verificar si la venta pertenece al usuario autenticado
		if ($perfil_id != 1) {
			$builder = $db->table('ventas_cabecera');
			$builder->where('id', $id);
			$builder->where('usuario_id', $usuario_id);
			$venta = $builder->get()->getRow();

			if (!$venta) {
				// Si la venta no pertenece al usuario autenticado, redirigir con error
				return redirect()->to(base_url('catalogo'))->with('fail', 'No tienes permiso para ver los detalles de la compra.');
			}
		}

		// Si es admin o la validación de cliente pasa, obtener los detalles de la venta
		$builder = $db->table('ventas_detalle u');
		$builder->where('venta_id', $id);
		$builder->select('d.id, d.nombre, u.cantidad, u.precio, u.total');
		$builder->join('productos d', 'u.producto_id = d.id');
		$ventas = $builder->get();

		$datos['ventas'] = $ventas->getResultArray();

		// Cargar las vistas con los datos
		$data['titulo'] = 'Detalle de la Compra';
		echo view('templates/cabecera', $data);
		echo view('usuarios/CompraDetalle_view', $datos);
		echo view('templates/footer');
	}



	// Muestra los productos en el carrito
	public function productosAgregados()
	{
		$cart = \Config\Services::cart();
		$carrito['carrito'] = $cart->contents(); // Obtener los contenidos del carrito
		$data['titulo'] = 'Productos en el Carrito';

		// Si el carrito está vacío, pasar un array vacío
		if (empty($carrito['carrito'])) {
			$carrito['carrito'] = [];
		}

		// Renderizar las vistas
		return view('templates/cabecera', $data)
			. view('carrito/ProductosEnCarrito', $carrito)
			. view('templates/footer');
	}
	// Agrega elemento al carrito
	public function add()
	{
		$cart = \Config\Services::cart();
		$productoModel = new Productos_model();

		$data = $this->request->getJSON();
		$productoId = $data->id;
		$productoNombre = $data->nombre;
		$productoPrecio = $data->precio_vta;

		// Validar existencia del producto
		$producto = $productoModel->getProducto($productoId);

		if (!$producto || $producto['stock'] <= 0) {
			return $this->response->setJSON(['message' => 'Producto no disponible']);
		}

		// Verificar si el producto ya está en el carrito
		foreach ($cart->contents() as $item) {
			if ($item['id'] === $productoId) {
				return $this->response->setJSON(['message' => 'El producto ya está en el carrito']);
			}
		}

		// Agregar al carrito
		$cart->insert([
			'id' => $productoId,
			'qty' => 1,
			'price' => $productoPrecio,
			'name' => $productoNombre,
		]);

		return $this->response->setJSON(['message' => 'Producto añadido al carrito']);
	}
	public function Carrito_sync()
	{
		$cart = \Config\Services::cart();
		$data = $this->request->getJSON(true); // Obtener datos en formato JSON

		if (isset($data['cart']) && is_array($data['cart'])) {
			// Vaciar el carrito actual
			$cart->destroy();

			// Recorrer los datos del carrito enviados desde localStorage
			foreach ($data['cart'] as $item) {
				$cart->insert([
					'id'    => $item['id'],
					'qty'   => 1, // Si no tienes cantidad en localStorage, ajusta aquí
					'price' => $item['price'],
					'name'  => $item['name'],
				]);
			}

			return $this->response->setJSON(['success' => true, 'message' => 'Carrito sincronizado']);
		}

		return $this->response->setJSON(['success' => false, 'message' => 'Datos inválidos']);
	}


	//Elimina elemento del carrito o el carrito entero
	// Elimina elemento del carrito o el carrito entero
	public function remove($rowid)
	{
		$cart = \Config\Services::cart();
		if ($rowid === "all") {
			$cart->destroy(); // Vaciar el carrito
			session()->setFlashdata('msg', 'Carrito vaciado.');
		} else {
			$cart->remove($rowid); // Eliminar un producto
			session()->setFlashdata('msg', 'Producto eliminado del carrito.');
		}
		return redirect()->to(base_url('CarritoList'));
	}


	//Actualiza el carrito que se muestra
	public function actualiza_carrito()
	{
		$cart = \Config\Services::cart();
		$productosModel = new Productos_model();
		$cart_info = $this->request->getPost('cart');

		foreach ($cart_info as $rowid => $carrito) {
			$producto = $productosModel->getProducto($carrito['id']);
			$stock = $producto['stock'];

			if ($carrito['qty'] <= $stock) {
				$cart->update([
					'rowid' => $rowid,
					'qty'   => $carrito['qty'],
				]);
			} else {
				session()->setFlashdata('fail', "La cantidad para {$producto['nombre']} excede el stock disponible.");
			}
		}

		session()->setFlashdata('msg', 'Carrito actualizado.');
		return redirect()->to(base_url('CarritoList'));
	}


	//Muestra los detalles de la venta y confirma(función guarda_compra())
	public function confirmar_compra()
	{
		$session = session();
		$cartData = $this->request->getPost('cart_data') ? json_decode($this->request->getPost('cart_data'), true) : [];


		// Si no hay carrito, redirigir al listado del carrito
		if (empty($cartData)) {
			return redirect()->to(base_url('CarritoList'))->with('error', 'El carrito está vacío.');
		}

		// Guardar los datos en la sesión (para persistencia si fuera necesario)
		$session->set('cart_confirm', $cartData);

		// Preparar datos para la vista
		$data = [
			'titulo' => 'Resumen de la Compra',
			'cart' => $cartData, // Asegurarse de que el array 'cart' sea enviado
		];

		// echo '<pre>';
		// print_r($cartData);
		// echo '</pre>';
		// exit;


		// Cargar la vista con los datos
		echo view('templates/cabecera', $data);
		echo view('carrito/confirmar_compra', $data);
		echo view('templates/footer');
	}

	//Guarda los datos de la venta en la base de datos
	public function guarda_compra()
	{
		$session = session();
		$productosModel = new Productos_model();

		// Obtener y decodificar el carrito desde el formulario
		$cartData = $this->request->getPost('cart_data');
		$cartData = $cartData ? json_decode($cartData, true) : [];

		// Validar si el carrito está vacío
		if (empty($cartData)) {
			return redirect()->to(base_url('CarritoList'))
				->with('error', 'No hay productos en el carrito para confirmar.');
		}

		// Validar si el usuario está autenticado
		$usuario_id = $session->get('id');
		if (!$usuario_id) {
			return redirect()->to(base_url('login'))
				->with('error', 'Debes iniciar sesión para completar la compra.');
		}

		// Validar método de pago
		$tipo_Pago = $this->request->getPost('tipo_pago');
		if (empty($tipo_Pago)) {
			return redirect()->to(base_url('comprar'))
				->with('error', 'Debe seleccionar un método de pago.');
		}

		// Validar stock y stock mínimo para cada producto
		foreach ($cartData as $item) {
			$producto = $productosModel->getProducto($item['id']);
			$cantidad = $item['qty'] ?? 1;

			if (!$producto) {
				return redirect()->to(base_url('CarritoList'))
					->with('error', "El producto con ID {$item['id']} no existe.");
			}

			$stock_disponible = $producto['stock'];
			$stock_minimo = $producto['stock_min'];

			// Validaciones de stock
			if ($cantidad > $stock_disponible) {
				return redirect()->to(base_url('CarritoList'))
					->with('error', "No hay suficiente stock disponible para el producto {$item['name']}. Stock actual: {$stock_disponible}.");
			}

			if (($stock_disponible - $cantidad) < $stock_minimo) {
				return redirect()->to(base_url('CarritoList'))
					->with('error', "No se puede comprar {$cantidad} unidades del producto {$item['name']}");
			}
		}


		// Calcular el total de la compra
		$total = array_reduce($cartData, function ($sum, $item) {
			return $sum + ($item['price'] * ($item['qty'] ?? 1));
		}, 0);

		// Guardar en la tabla de cabecera
		$cabecera_model = new Cabecera_model();
		$ventaId = $cabecera_model->insert([
			'fecha' => date('Y-m-d H:i:s'),
			'usuario_id' => $usuario_id,
			'total_venta' => $total,
			'tipo_pago' => $tipo_Pago,
		]);

		// Validar si la cabecera se guardó correctamente
		if (!$ventaId) {
			return redirect()->to(base_url('CarritoList'))
				->with('error', 'No se pudo registrar la compra. Inténtalo de nuevo.');
		}

		// Guardar cada detalle de la compra
		$detalle_model = new VentaDetalle_model();
		foreach ($cartData as $item) {
			$detalle_model->insert([
				'venta_id' => $ventaId,
				'producto_id' => $item['id'],
				'cantidad' => $item['qty'] ?? 1,
				'precio' => $item['price'],
				'total' => $item['price'] * ($item['qty'] ?? 1),
			]);

			// Actualizar el stock del producto
			$producto = $productosModel->getProducto($item['id']);
			$nuevo_stock = $producto['stock'] - $cantidad;
			$productosModel->update($item['id'], ['stock' => $nuevo_stock]);
		}

		// Limpiar datos temporales
		$session->remove('cart_confirm');
		return redirect()->to(base_url('Gracias'))->with('msg', 'Compra realizada con éxito.');
	}


	//Muestra los detalles de la venta y confirma(función guarda_compra())
	function GraciasPorSuCompra()
	{
		$data['titulo'] = 'Gracias por tu compra';

		echo view('templates/cabecera', $data);
		echo view('carrito/GraciasCompra_view');
		echo view('templates/footer');
	}


	function FacturaAdmin($id)
	{
		//$dompdf = new Dompdf();

		$db = db_connect();
		$builder2 = $db->table('ventas_cabecera a');
		$builder2->where('a.id', $id);
		$builder2->select('a.id , c.nombre , c.apellido, c.telefono , c.direccion , a.total_venta , a.fecha , a.tipo_pago');
		$builder2->join('usuarios c', 'a.usuario_id = c.id');
		$ventas2 = $builder2->get();
		$datos2['datos'] = $ventas2->getResultArray();
		//print_r($datos2);
		//exit;

		$builder = $db->table('ventas_detalle u');
		$builder->where('venta_id', $id);
		$builder->select('d.id , d.nombre , u.cantidad , u.precio , u.total ,');
		$builder->join('productos d', 'u.producto_id = d.id');
		$ventas = $builder->get();
		$datos['ventas'] = $ventas->getResultArray();
		//print_r($datos);
		//exit;

		$data['titulo'] = 'Factura';

		echo view('templates/cabecera', $data);
		echo view('usuarios/facturacion_view', $datos2 + $datos);
		echo view('templates/footer');

		//$html = view('back/Admin/facturacion_view',$datos2+$datos);
		//$dompdf->loadHtml('Hola loco');
		//$dompdf->setPaper('A4', 'landscape');
		//$dompdf->render();
		//$dompdf->stream('demoFactura.pdf',['attachment' => false]);
	}

	public function FacturaCliente($id)
	{
		$session = session();

		// Verificar si el usuario está autenticado
		if (!$session->has('id')) {
			return redirect()->to(base_url('login'))->with('error', 'Debes iniciar sesión para ver esta factura.');
		}

		$usuario_id = $session->get('id');       // ID del usuario autenticado
		$perfil_id  = $session->get('perfil_id'); // Perfil del usuario (1 = Admin, 2 = Cliente)

		// Verificar si el ID es válido
		if (!$id || !is_numeric($id)) {
			session()->setFlashdata('fail', 'ID de factura no válido.');
			return redirect()->to('/compras');
		}

		$db = db_connect();

		// Si no es administrador, validar que la factura pertenece al usuario autenticado
		if ($perfil_id != 1) {
			$builder = $db->table('ventas_cabecera');
			$builder->where('id', $id);
			$builder->where('usuario_id', $usuario_id);
			$venta = $builder->get()->getRow();

			if (!$venta) {
				session()->setFlashdata('fail', 'No tienes permiso para ver esta factura.');
				return redirect()->to('/compras');
			}
		}

		// Obtener datos de la cabecera de la venta
		$builder2 = $db->table('ventas_cabecera a');
		$builder2->where('a.id', $id);
		$builder2->select('a.id, c.nombre, c.apellido, c.telefono, c.direccion, a.total_venta, a.fecha, a.tipo_pago');
		$builder2->join('usuarios c', 'a.usuario_id = c.id');
		$ventas2 = $builder2->get();
		$cabeceraVenta = $ventas2->getResultArray();

		// Validar cabecera
		if (empty($cabeceraVenta)) {
			session()->setFlashdata('fail', 'No se encontraron datos para la factura.');
			return redirect()->to('/compras');
		}

		// Obtener detalles de la venta
		$builder = $db->table('ventas_detalle u');
		$builder->where('venta_id', $id);
		$builder->select('d.id, d.nombre, u.cantidad, u.precio, u.total');
		$builder->join('productos d', 'u.producto_id = d.id');
		$ventas = $builder->get();
		$detalleVenta = $ventas->getResultArray();

		// Validar detalles
		if (empty($detalleVenta)) {
			session()->setFlashdata('fail', 'No se encontraron detalles para la factura.');
			return redirect()->to('/compras');
		}

		// Preparar datos para la vista
		$data['titulo'] = 'Factura';
		$datosVista = [
			'datos' => $cabeceraVenta,
			'ventas' => $detalleVenta,
			'venta_id' => $id
		];

		echo view('templates/cabecera', $data);
		echo view('usuarios/facturacion_view', $datosVista);
		echo view('templates/footer');
	}
}
