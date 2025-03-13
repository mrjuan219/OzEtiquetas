<?php

class ControladorProductos
{

	public static function ctrNuevoProducto($nombre, $descripcion, $categoria, $subcategoria, $stock)
	{
		$tabla = "productos";

		$respuesta = modelo_productos::nuevoProductoMdl($nombre, $descripcion, $categoria, $subcategoria, $stock, $tabla);

		return $respuesta;
	}

	public static function contarProductosDisponiblesCtr()
	{

		$tablaProductos = "productos";

		$respuesta = modelo_productos::contarProductosDisponiblesMdl($tablaProductos);

		return $respuesta;
	}
	
	public static function guardarVisualizacionCtr($id)
	{

		$tablaServicios = "productos";

		$respuesta = modelo_servicios::guardarVisualizacionMdl($id, $tablaServicios);

		return $respuesta;
	}

	public static function editarProductoCtr($nombre, $descripcion, $categoria, $subcategoria, $id)
	{

		$tablaProductos = "productos";

		$respuesta = modelo_productos::editarProductoMdl($nombre, $descripcion, $categoria, $subcategoria, $id, $tablaProductos);

		return $respuesta;
	}

	public static function traerImagenesCtr($id)
	{

		$tabla = "imagenes_productos";

		$respuesta = modelo_productos::traerImagenesMdl($id, $tabla);

		return $respuesta;
	}

	public static function traerProductosCtr($min = 0, $max = 1000, $idProducto = 'todos', $categoria = 'todos', $subcategoria = 'todos')
	{

		if (!is_numeric($idProducto) || $idProducto == 0) {
			$id = 'todos';
		}

		if ($categoria == '0') {
			$categoria = 'todos';
		}

		if ($subcategoria == '0') {
			$subcategoria = 'todos';
		}

		if ($categoria != 'todos' && $subcategoria != 'todos' && $idProducto != 'todos') {
			$condicion = "WHERE categoria = '$categoria' AND subcategoria = '$subcategoria' AND '$idProducto'";
			//Cuando la categoria está definida al igual que subcategoria y el id del producto
			//
		} else if ($categoria != 'todos' && $subcategoria != 'todos' && $idProducto == 'todos') {
			$condicion = "WHERE categoria = '$categoria' AND subcategoria = '$subcategoria'";
			//Cuando la categoria está definida y tambien la subcategoria pero no el id del producto
			//
		} else if ($categoria != 'todos' && $subcategoria == 'todos' && $idProducto == 'todos') {
			$condicion = "WHERE categoria = '$categoria'";
			//Cuando solo la categoria está definida
			//
		} else if ($categoria == 'todos' && $subcategoria != 'todos' && $idProducto == 'todos') {
			$condicion = "WHERE a.subcategoria = '$subcategoria'";
			//Cuando solo la subcategoria está definida
			//
		} else if ($categoria != 'todos') {
			$condicion = "WHERE a.categoria = '$categoria'";
			//Cuando solo la categoria está definida
			//
		} else if ($subcategoria != 'todos') {
			$condicion =  "WHERE a.subcategoria = '$subcategoria'";
			//Cuando solo la subcategoria está definida
			//
		} else if ($idProducto != 'todos') {
			$condicion = "WHERE a.id = '$idProducto'";
			//Cuando solo el id producto está definido
			//
		} else {
			if ($_GET['ruta'] != 'Tienda_panel') {
				$condicion = "WHERE activo != '0'";
			} else {
				$condicion = '';
			}
		}

		$condicion .= " ORDER BY activo DESC LIMIT $min, $max";

		$tablaProductos = "productos";
		$tablaUsuarios = "usuarios";

		$respuesta = modelo_Productos::traerProductosMdl($tablaProductos, $tablaUsuarios, $condicion);

		return $respuesta;
	}

	public static function traerProductosBusquedaCtr($busqueda)
	{
		$tabla = "productos";
		$tablaUsuarios = "usuarios";

		$respuesta = modelo_productos::traerProductosBusquedaMdl($busqueda, $tabla, $tablaUsuarios);

		return $respuesta;
	}

	public static function publicarProductoCtr($publicar, $id)
	{

		$tablaProductos = "productos";

		$respuesta = modelo_productos::publicarProductoMdl($tablaProductos, $publicar, $id);

		return $respuesta;
	}

	public static function traerProductosDestacadosCtr()
	{

		$tablaProductos = "productos";

		$respuesta = modelo_productos::traerProductosDestacadosMdl($tablaProductos);

		return $respuesta;
	}

	public static function recomendarProductoCtr($recomendar, $id)
	{

		$tablaProductos = "productos";

		$respuesta = modelo_productos::recomendarProductoMdl($tablaProductos, $recomendar, $id);

		return $respuesta;
	}

	public static function traerTamañosCtr($id = '', $id_tamaño = '')
	{
		if($id != ''){
			$condicion = "WHERE a.id_producto = '$id'";
		}else{
			$condicion = '';
		}

		if($id_tamaño != ''){
			$condicion = "WHERE a.id = '$id_tamaño'";
		}else{
			$condicion = '';
		}

		$tabla = "tamaños";

		$respuesta = modelo_productos::traerTamañoMdl($tabla, $condicion);

		return $respuesta;
	}

	public static function traerCursoCtr($id = '')
	{
		if($id != ''){
			$condicion = "WHERE curso_id = '$id'";
		}else{
			$condicion = '';
		}

		$tabla = "cursos";

		$respuesta = modelo_productos::traerMdl($tabla, $condicion);

		return $respuesta;
	}

	public static function nuevoTamañoCtr($tamaño, $precio, $cantidad, $descuento, $producto)
	{
		$tabla = "tamaños";

		$respuesta = modelo_productos::nuevoTamañoMdl($tabla, $tamaño, $precio, $cantidad, $descuento, $producto);

		return $respuesta;
	}

	public static function eliminarTamañoCtr($tamaño)
	{
		$tabla = "tamaños";

		$respuesta = modelo_productos::eliminarMdl($tabla, $tamaño);

		return $respuesta;
	}

	public static function eliminarProductoCtr($id)
	{
		$tabla = "productos";

		$respuesta = modelo_productos::eliminarMdl($tabla, $id);

		return $respuesta;
	}

	public static function ctrModificarProducto()
	{
	}

	public static function UltimoIdCtr()
	{
		$tabla = 'productos';

		$respuesta = modelo_productos::obtenerUltimoIdMdl($tabla);

		return $respuesta;
	}


	public static function subirImagenTablaCtr($id, $ruta_db, $descripcion, $tamaño_archivo)
	{

		$tablaProductos = "imagenes_productos";

		$respuesta = modelo_productos::subirImagenTablaMdl($id, $ruta_db, $descripcion, $tamaño_archivo, $tablaProductos);

		return $respuesta;
	}

}
