<?php

class ControladorServicios
{

	public static function traerPaisesCtr()
	{
		$tabla = "paises";

		$respuesta = modelo_servicios::traerPaisesMdl($tabla);

		return $respuesta;
	}

	public static function traerEstadosCtr($pais)
	{

		if ($pais == 'MX') {
			$tabla = "estados";
		} else {
			return 'No disponible';
		}

		$respuesta = modelo_servicios::traerEstadosMdl($tabla);

		return $respuesta;
	}

	public static function traerMunicipiosCtr($estadoID)
	{
		$tabla = "estados_municipios";

		$respuesta = modelo_servicios::traerMunicipiosMdl($tabla, $estadoID);

		return $respuesta;
	}

	public static function traerCategoriasCtr($nombre = 'todos', $id = 'todos')
	{
		$tabla = "categorias";

		$respuesta = modelo_servicios::traerCategoriasMdl($tabla, $nombre, $id);

		return $respuesta;
	}

	public static function traerSubCategoriasCtr($id = 'todos', $nombre = 'todos', $idsub = 'todos')
	{
		$tabla = "subcategorias";

		$respuesta = modelo_servicios::traerSubCategoriasMdl($tabla, $id, $nombre, $idsub);

		return $respuesta;
	}

	public static function traerServiciosBusquedaCtr($busqueda)
	{
		$tabla = "servicios";
		$tablaUsuarios = "usuarios";

		$respuesta = modelo_servicios::traerServiciosBusquedaMdl($busqueda, $tabla, $tablaUsuarios);

		return $respuesta;
	}

	public static function traerServiciosCtr($min = 0, $max = 1000, $idServicio = 'todos', $usuario = 'todos', $categoria = 'todos', $subcategoria = 'todos')
	{

		if (!is_numeric($idServicio) || $idServicio == 0) {
			$id = 'todos';
		}

		if ($usuario == '0') {
			$usuario = 'todos';
		}

		if ($categoria == '0') {
			$categoria = 'todos';
		}

		if ($subcategoria == '0') {
			$subcategoria = 'todos';
		}

		if ($usuario != 'todos' && $categoria != 'todos' && $subcategoria != 'todos' && $idServicio != 'todos') {
			$condicion = "WHERE a.usuario = '$usuario' AND categoria = '$categoria' AND subcategoria = '$subcategoria' AND '$idServicio'";
		} else if ($usuario != 'todos' && $categoria != 'todos' && $subcategoria != 'todos' && $idServicio == 'todos') {
			$condicion = "WHERE a.usuario = '$usuario' AND categoria = '$categoria' AND subcategoria = '$subcategoria'";
		} else if ($usuario != 'todos' && $categoria != 'todos' && $subcategoria == 'todos' && $idServicio == 'todos') {
			$condicion = "WHERE a.usuario = '$usuario' AND categoria = '$categoria'";
		} else if ($usuario != 'todos' && $categoria == 'todos' && $subcategoria == 'todos' && $idServicio == 'todos') {
			$condicion = "WHERE a.usuario = '$usuario'";
		} else if ($usuario == 'todos' && $categoria != 'todos' && $subcategoria == 'todos' && $idServicio == 'todos') {
			$condicion = "WHERE a.categoria = '$categoria'";
		} else if ($usuario == 'todos' && $categoria == 'todos' && $subcategoria != 'todos' && $idServicio == 'todos') {
			$condicion = "WHERE a.subcategoria = '$subcategoria'";
		} else if ($usuario != 'todos') {
			$condicion = "WHERE a.usuario = '$usuario'";
		} else if ($categoria != 'todos') {
			$condicion = "WHERE a.categoria = '$categoria'";
		} else if ($subcategoria != 'todos') {
			$condicion =  "WHERE a.subcategoria = '$subcategoria'";
		} else if ($idServicio != 'todos') {
			$condicion = "WHERE a.id = '$idServicio'";
		} else {
			if ($_GET['ruta'] != 'MisAnuncios' && $_GET['ruta'] != 'Panel') {
				$condicion = "WHERE estatus != '0'";
			} else {
				$condicion = '';
			}
		}

		$condicion .= " ORDER BY estatus DESC LIMIT $min, $max";

		$tablaServicios = "servicios";
		$tablaUsuarios = "usuarios";

		$respuesta = modelo_servicios::traerServiciosMdl($tablaServicios, $tablaUsuarios, $condicion);

		return $respuesta;
	}

	public static function traerServiciosFiltroCtr($municipio, $estado, $busqueda)
	{

		$tablaServicios = "servicios";
		$tablaUsuarios = "usuarios";
		$substringInicial = substr($busqueda, 1, 4);
		$municipio = preg_replace('/[.,]/', '', $municipio);
		$estado = preg_replace('/[.,]/', '', $estado);


		if (strlen($estado) > 1 && strlen($municipio) > 1) {
			//Si estado y municipio
			$condicion = "WHERE d.municipio = '$municipio' AND c.estado = '$estado' 
							AND (a.titulo LIKE '%$busqueda%' AND a.estatus = 1
								OR (a.descripcion LIKE '%$busqueda%' AND a.estatus = 1)  
								OR (e.nombre_categoria LIKE '%$busqueda%' AND a.estatus = 1) 
								OR (f.nombre_subcategoria LIKE '%$busqueda%' AND a.estatus = 1) 
								OR (e.palabras_clave LIKE '%$busqueda%' AND a.estatus = 1)
								OR (f.palabras_clave_sub LIKE '%$busqueda%' AND a.estatus = 1)
							)";
			//
		} else if (strlen($estado) > 1 && strlen($municipio) < 1) {
			//Si estado pero no municipio
			$condicion = "WHERE c.estado = '$estado'
							AND (a.titulo LIKE '%$busqueda%' AND a.estatus = 1
							OR (a.descripcion LIKE '%$busqueda%' AND a.estatus = 1) 
							OR (e.nombre_categoria LIKE '%$busqueda%' AND a.estatus = 1) 
							OR (f.nombre_subcategoria LIKE '%$busqueda%' AND a.estatus = 1)
							OR (e.palabras_clave LIKE '%$busqueda%' AND a.estatus = 1)
							OR (f.palabras_clave_sub LIKE '%$busqueda%' AND a.estatus = 1))";
			//
		} else if (strlen($estado) < 1 && strlen($municipio) > 1) {
			//Si Municipio pero no estado
			$condicion = "WHERE d.municipio = '$municipio' 
							AND (a.titulo LIKE '%$busqueda%' AND a.estatus = 1
							OR (a.descripcion LIKE '%$busqueda%'AND a.estatus = 1) 
							OR (e.nombre_categoria LIKE '%$busqueda%' AND a.estatus = 1) 
							OR (f.nombre_subcategoria LIKE '%$busqueda%' AND a.estatus = 1) 
							OR (e.palabras_clave LIKE '%$busqueda%' AND a.estatus = 1)
							OR (f.palabras_clave_sub LIKE '%$busqueda%' AND a.estatus = 1))";
			//
		} else if (strlen($busqueda) > 1 && $estado == '' && $municipio == '') {
			//Si ninguno más que la busqueda
			$condicion = "WHERE a.descripcion LIKE '%$busqueda%' 
							OR (a.titulo LIKE '%$busqueda%' AND a.estatus = 1)
							OR (e.nombre_categoria LIKE '%$busqueda%' AND a.estatus = 1) 
							OR (e.palabras_clave LIKE '%$busqueda%' AND a.estatus = 1)
							OR (f.nombre_subcategoria LIKE '%$busqueda%' AND a.estatus = 1) 
							OR (f.palabras_clave_sub LIKE '%$busqueda%' AND a.estatus = 1)";
		}

		$respuesta = modelo_servicios::traerServiciosMdl($tablaServicios, $tablaUsuarios, $condicion);

		return $respuesta;
	}

	public static function contarServiciosDisponiblesCtr()
	{

		$tablaServicios = "servicios";

		$respuesta = modelo_servicios::contarServiciosDisponiblesMdl($tablaServicios);

		return $respuesta;
	}

	public static function traerServiciosSanviteCtr($id = 'todos')
	{

		$tablaServicios = "servicios_sanvite";

		if($id != 'todos'){
			$condicion = "WHERE id = '$id'";
		}else{
			$condicion = "";
		}

		$respuesta = modelo_servicios::traerServiciosSanviteMdl($condicion, $tablaServicios);

		return $respuesta;
	}

	public static function enviarContactoCtr($nombre, $telefono, $correo)
	{

		$respuesta = modelo_servicios::enviarContactoMdl($nombre, $telefono, $correo);

		return $respuesta;
	}

	public static function ultimoIdCtr()
	{

		$tablaServicios = "servicios";

		$respuesta = modelo_servicios::ultimoIdMdl($tablaServicios);

		return $respuesta;
	}

	public static function guardarVisualizacionCtr($id)
	{

		$tablaServicios = "servicios";

		$respuesta = modelo_servicios::guardarVisualizacionMdl($id, $tablaServicios);

		return $respuesta;
	}

	public static function subirImagenTablaCtr($id, $ruta_db, $descripcion, $tamaño_archivo)
	{

		$tablaServicios = "imagenes";

		$respuesta = modelo_servicios::subirImagenTablaMdl($id, $ruta_db, $descripcion, $tamaño_archivo, $tablaServicios);

		return $respuesta;
	}

	public static function traerImagenesCtr($id)
	{

		$tabla = "imagenes";

		$respuesta = modelo_servicios::traerImagenesMdl($id, $tabla);

		return $respuesta;
	}

	public static function eliminarImagenCtr($id)
	{
		$tabla = "imagenes_productos";

		$respuesta = modelo_servicios::eliminarImagenMdl($id, $tabla);

		return $respuesta;
	}

	public static function traerTestimoniosCtr($id)
	{

		$tabla = "calificaciones";

		$respuesta = modelo_servicios::traerTestimoniosMdl($tabla, $id);

		return $respuesta;
	}

	public static function publicarServicioCtr($publicar, $id)
	{

		$tablaServicios = "servicios";

		$respuesta = modelo_servicios::publicarServicioMdl($tablaServicios, $publicar, $id);

		return $respuesta;
	}

	public static function traerServiciosRecomendadosCtr()
	{

		$tablaServicios = "servicios";

		$respuesta = modelo_servicios::traerServiciosRecomendadosMdl($tablaServicios);

		return $respuesta;
	}

	public static function recomendarServicioCtr($recomendar, $id)
	{

		$tablaServicios = "servicios";

		$respuesta = modelo_servicios::recomendarServicioMdl($tablaServicios, $recomendar, $id);

		return $respuesta;
	}

	public static function nuevaCategoriaCtr($nombreCategoria, $ruta_db, $textos)
	{

		$tabla = "categorias";

		$respuesta = modelo_servicios::nuevaCategoriaMdl($nombreCategoria, $ruta_db, $textos, $tabla);

		return $respuesta;
	}

	public static function enviarTestimonioCtr($estrellas, $comentario, $idServicio, $usuario, $fecha)
	{

		$tabla = "calificaciones";

		$respuesta = modelo_servicios::enviarTestimonioMdl($estrellas, $comentario, $idServicio, $usuario, $fecha, $tabla);

		return $respuesta;
	}

	public static function nuevaSubCategoriaCtr($nombre, $idCategoria, $textos)
	{

		$tabla = "subcategorias";

		$respuesta = modelo_servicios::nuevaSubCategoriaMdl($nombre, $idCategoria, $textos, $tabla);

		return $respuesta;
	}

	public static function eliminarCategoriaCtr($idCategoria)
	{

		$tabla = "categorias";

		$respuesta = modelo_servicios::eliminarMdl($idCategoria, $tabla);

		return $respuesta;
	}

	public static function eliminarSubCategoriaCtr($idCategoria)
	{

		$tabla = "subcategorias";

		$respuesta = modelo_servicios::eliminarMdl($idCategoria, $tabla);

		return $respuesta;
	}

	public static function enviarContraseñaCorreoCtr($correo)
	{
		$tabla = "usuarios";

		$respuesta = modelo_servicios::enviarContraseñaCorreoMdl($correo, $tabla);

		return $respuesta;
	}

	public static function eliminarServicioCtr($id)
	{

		$tabla = "servicios";

		$respuesta = modelo_servicios::eliminarMdl($id, $tabla);

		return $respuesta;
	}

	public static function insertarServicioCtr($nombre, $pais, $estado, $municipio, $direccion, $latitud, $longitud, $descripcion, $usuario, $img_principal, $categoria, $subcategoria, $facebook, $whatsapp)
	{
		$tabla = "servicios";

		$respuesta = modelo_servicios::insertarServicioMdl($nombre, $pais, $estado, $municipio, $direccion, $latitud, $longitud, $descripcion, $tabla, $usuario, $img_principal, $categoria, $subcategoria, $facebook, $whatsapp);

		return $respuesta;
	}

	public static function editarServicioCtr($id, $nombreServicio, $pais, $estado, $municipio, $direccion, $descripcion, $categoria, $subcategoria, $facebook, $whatsapp, $latitud, $longitud)
	{
		$tabla = "servicios";

		$respuesta = modelo_servicios::editarServicioMdl($id, $nombreServicio, $pais, $estado, $municipio, $direccion, $descripcion, $categoria, $subcategoria, $facebook, $whatsapp, $latitud, $longitud, $tabla);

		return $respuesta;
	}
}
