<?php
require "Estilos-panel.php";
$datos = ControladorUsuario::traerDatosUsuarioCtr($_SESSION['usuario']);
if ($datos['facebook'] == '' || $datos['facebook'] == null) {
    //$datos['facebook'] = 'Ingresa tu usuario';
}
if ($datos['telefono'] == '' || $datos['telefono'] == null) {
    //$datos['telefono'] = 'Ingresa tu telefono';
}
if ($datos['correo'] == '' || $datos['correo'] == null) {
    //$datos['correo'] = 'Ingresa tu correo';
}
if ($datos['linkedin'] == '' || $datos['linkedin'] == null) {
    //$datos['linkedin'] = 'Ingresa tu enlace';
}

//print_r($datos);
?>
<div class="side-bar">
    <div class="user-info">
        <img class="img-profile img-circle img-responsive center-block" src=".<?php echo $datos['foto_perfil']; ?>" alt="Foto de perfil">
        <ul class="meta list list-unstyled">
            <br>
            <li class="name"><?php echo $_SESSION['nombre'] ?>
                <label class="label label-info">
                    <?php echo $datos['rol'] ?></label>
            </li>
            <li class="email">
                <a href="mailto: <?php echo $datos['correo'] ?>" style="word-break: break-word;">
                    <?php echo $datos['correo'] ?>
                </a>
            </li>
            <li class="activity">Utlimo inicio de sesión: <?php echo ucfirst(strftime("%A %d de %B del %Y a las %l:%M %p", strtotime($_SESSION['ultimo_login']))) ?></li>
        </ul>
    </div>
    <nav class="side-menu">
        <ul class="nav">
            <?php
            $itemBarra1 = '';
            $itemBarra2 = '';
            $itemBarra3 = '';
            $itemBarra4 = '';
            $itemBarra5 = '';
            $itemBarra6 = '';
            $itemBarra7 = '';
            $itemBarra8 = '';

            if ($_GET['ruta'] == 'Perfil') {
                $itemBarra1 = 'class="active"';
            } else if ($_GET['ruta'] == 'Direcciones') {
                $itemBarra2 = 'class="active"';
            } else if ($_GET['ruta'] == 'Tienda_panel') {
                $itemBarra3 = 'class="active"';
            } else if ($_GET['ruta'] == 'Pedidos_panel') {
                $itemBarra4 = 'class="active"';
            } else if ($_GET['ruta'] == 'Usuarios_panel') {
                $itemBarra5 = 'class="active"';
            } else if ($_GET['ruta'] == 'Sucursales_panel') {
                $itemBarra6 = 'class="active"';
            } else if ($_GET['ruta'] == 'Citas_panel') {
                $itemBarra7 = 'class="active"';
            }

            echo '
            <li ' . $itemBarra1 . ' >
                <a onclick="window.location.search=' . "'" . '?ruta=Perfil' . "'" . '">
                    <span class="fa fa-user"></span> &nbsp;
                    Mi Perfil
                </a>
            </li>
            ';

            echo '
            <li $itemBarra2 >
                <a onclick="window.location.search=' . "'" . '?ruta=Direcciones' . "'" . '">
                    <span class="fa fa-home" aria-hidden="true"></span>&nbsp;
                    Mis Direcciones
                </a>
            </li>
            ';
            
		if($_SESSION['perfil'] == 'Admin' && $_SESSION['perfil'] == 'DireccionComercial') {
			
            echo '
            <li ' . $itemBarra3 . ' >
                <a onclick="window.location.search=' . "'" . '?ruta=Tienda_panel' . "'" . '">
                    <span class="fa fa-shopping-bag" aria-hidden="true"></span>&nbsp;
                    Tienda en linea
                </a>
            </li>
            ';
		}

		if ($_SESSION['perfil'] == 'Admin' || $_SESSION['perfil'] == 'DireccionComercial' || $_SESSION['perfil'] == 'Almacenista') {
			
            echo '
            <li ' . $itemBarra4 . '>
                <a onclick="window.location.search=' . "'" . '?ruta=Pedidos_panel' . "'" . '">
                    <span class="fa fa-truck" aria-hidden="true"></span>&nbsp;
                    Administrar pedidos
                </a>
            </li>
            ';
		}

		if ($_SESSION['perfil'] == 'Admin' || $_SESSION['perfil'] == 'DireccionComercial' || $_SESSION['perfil'] == 'DireccionAcademica') {
			
            echo '
            <li ' . $itemBarra5 . '>
                <a onclick="window.location.search=' . "'" . '?ruta=Usuarios_panel' . "'" . '">
                    <span class="fa fa-users" aria-hidden="true"></span>&nbsp;
                    Administrar usuarios
                </a>
            </li>
            ';
		}

		if ($_SESSION['perfil'] == 'Admin' || $_SESSION['perfil'] == 'DireccionComercial') {
			
            echo '
            <li ' . $itemBarra6 . '>
                <a onclick="window.location.search=' . "'" . '?ruta=Sucursales_panel' . "'" . '">
                    <span class="fa fa-map-marker-alt" aria-hidden="true"></span>&nbsp;
                    Administrar sucursales
                </a>
            </li>
            ';
		}

		if ($_SESSION['perfil'] == 'Admin' || $_SESSION['perfil'] == 'DireccionComercial' || $_SESSION['perfil'] == 'Sucursal') {

            echo '
            <li ' . $itemBarra7 . '>
                <a onclick="window.location.search=' . "'" . '?ruta=Citas_panel' . "'" . '">
                    <span class="fa fa-clock-o" aria-hidden="true"></span>&nbsp;
                    Administrar citas
                </a>
            </li>
            ';
		}




            ?>

            <!-- Hoy a las 2:18pm
                            <li>
                                <a href="#">
                                    <span class="fa fa-credit-card"></span> Billing
                                </a>
                            </li>
                            <li>
                                < a href="#">
                                    <span class="fa fa-envelope"></span>
                                    Messages
                                </a>
                            </li>
                            
                            <li><a href="user-drive.html"><span class="fa fa-th"></span> Drive</a></li>
                            <li><a href="#"><span class="fa fa-clock-o"></span> Reminders</a></li>
                        -->
        </ul>
    </nav>
</div>