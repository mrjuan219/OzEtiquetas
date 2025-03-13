<?php

class ControladorPlantilla
{

	public function ctrPlantilla()
	{
		include 'vistas/plantilla.php';
	}

	public function ctrMenu()
	{
		include 'vistas/Menu.php';
	}

	public function ctrEnlaces()
	{
		if (isset($_GET['ruta'])) {
			$enlace = $_GET['ruta'];
			$_SESSION['ruta'] = $_GET['ruta'];
		} else {
			$enlace = "Inicio";
		}


		if ($_GET['ruta'] == 'Perfil' && $_SESSION['login'] == null) {
			include 'vistas/403.php';
		}

		if ($_GET['ruta'] == 'Direcciones' && $_SESSION['login'] == null) {
			include 'vistas/403.php';
		}

		if ($_GET['ruta'] == 'Tienda_panel' && $_SESSION['perfil'] != 'Admin' && $_SESSION['perfil'] != 'DireccionComercial') {
			include 'vistas/403.php';
		}
		if ($_GET['ruta'] == 'Pedidos_panel' && $_SESSION['perfil'] != 'Admin' && $_SESSION['perfil'] != 'DireccionComercial' && $_SESSION['perfil'] != 'Almacenista') {
			include 'vistas/403.php';
		}
		if ($_GET['ruta'] == 'Usuarios_panel' && $_SESSION['perfil'] != 'Admin' && $_SESSION['perfil'] != 'DireccionComercial' && $_SESSION['perfil'] != 'DireccionAcademica') {
			include 'vistas/403.php';
		}
		if ($_GET['ruta'] == 'Sucursales_panel' && $_SESSION['perfil'] != 'Admin' && $_SESSION['perfil'] != 'DireccionComercial') {
			include 'vistas/403.php';
		}
		if ($_GET['ruta'] == 'Citas_panel' && $_SESSION['perfil'] != 'Admin' && $_SESSION['perfil'] != 'DireccionComercial' && $_SESSION['perfil'] != 'Sucursal') {
			include 'vistas/403.php';
		}




		$respuesta = Paginas::mdlEnlacesModulos($enlace);

		include $respuesta;
	}

	public function ctrFooter()
	{
		include 'vistas/Footer.php';
	}
}
