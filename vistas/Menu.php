<link rel="apple-touch-icon" sizes="180x180" href="./imagenes/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="./imagenes/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="./imagenes/favicon/favicon-16x16.png">
<link rel="manifest" href="./imagenes/favicon/site.webmanifest">
<link rel="mask-icon" href="./imagenes/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
<?php
$item1 = '';
$item2 = '';
$item3 = '';
$item4 = '';
$item5 = '';
$item6 = '';

if ($_GET['ruta'] == 'Inicio') {
    $item1 = 'activo';
} else if ($_GET['ruta'] == 'Nosotros') {
    $item2 = 'activo';
} else if ($_GET['ruta'] == 'Servicio') {
    $item3 = 'activo';
} else if ($_GET['ruta'] == 'EtiquetasPersonalizadas') {
    $item3 = 'activo';
} else if ($_GET['ruta'] == 'EtiquetasBlancas') {
    $item3 = 'activo';
} else if ($_GET['ruta'] == 'EquiposdeImpresión') {
    $item3 = 'activo';
} else if ($_GET['ruta'] == 'EtiquetadoraAutomatica') {
    $item3 = 'activo';
} else if ($_GET['ruta'] == 'Contacto') {
    $item4 = 'activo';
}
?>
<nav id="navbar" data-aos="fade-down">
    <div class="contenedor-logo">
        <img src="<?php echo $_SESSION['logo'] ?>" alt="Logotipo <?php echo $_SESSION['nombreEmpresa'] ?>">
    </div>
    <div class="contenedor-barra" style="justify-content: flex-end;">
        <ul class="izquierda" style="width: 70%;">
            <li class="pointer <?php echo $item1 ?>" onclick="window.location.search = '?ruta=Inicio'">
                Inicio
            </li>
            <li class="pointer <?php echo $item2 ?>" onclick="window.location.search = '?ruta=Nosotros'">
                Oz Etiquetas
            </li>
            <li class="pointer dropdown dropdown-toggle <?php echo $item3 ?>" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                <span class="nav-label">
                    Productos/Servicios
                </span>
                <span class="caret"></span>
                <ul class="dropdown-menu">
                    <li onclick="window.location.search='?ruta=EtiquetasPersonalizadas'">Etiquetas Personalizadas</li>
                    <li onclick="window.location.search='?ruta=EtiquetasBlancas'">Etiquetas Blancas y Ribbones</li>
                    <li onclick="window.location.search='?ruta=EtiquetadoraAutomatica'">Etiquetadora Automatica de Frutos</li>
                    <li onclick="window.location.search='?ruta=EquiposdeImpresión'">Equipos de Impresión</li>
                    <?php /*?> <?php
                        $categorias = ControladorServicios::traerCategoriasCtr();

                        foreach($categorias as $categoria){
                            $id = $categoria['id'];
                            $nombre = $categoria['nombre_categoria'];

                            echo "
                                
                            ";
                        }
                    ?><?php */ ?>

                </ul>
            </li>
            <li class="pointer <?php echo $item4 ?>" onclick="window.location.search = '?ruta=Contacto'">
                Contacto
            </li>
            <?php
            if (!isset($_SESSION['login'])) {
                echo '
                    <div hidden class="iniciarSesion pointer" data-toggle="modal" data-target="#modalLogin">
                        Iniciar Sesión&nbsp;
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    ';
            } else if ($_SESSION['login'] == 1) {
                echo '
                    <div hidden class="iniciarSesion pointer" data-toggle="modal">
                        <button type="button" class="btn-none dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Bienvenido ' . $_SESSION['usuario'] . '&nbsp;
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </button>    
                        <div class="dropdown-menu">
                        ';

                if ($_SESSION['perfil'] == 'Admin') {
                    echo '
                            <a class="dropdown-item" onclick="window.location.search=' . "'?ruta=Panel'" . '">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                Panel administrativo
                            </a>
                            ';
                } else if ($_SESSION['perfil'] == 'Comun') {
                    echo '
                            <a class="dropdown-item" onclick="window.location.search=' . "'?ruta=MisAnuncios'" . '">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                Administrar anuncios
                            </a>
                            ';
                }

                echo '
                            <a hidden class="dropdown-item" onclick="window.location.search=' . "'?ruta=Perfil'" . '">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Modificar perfil
                            </a>
                            <a class="dropdown-item" onclick="cerrarSesion()">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                Salir
                            </a>

                        </div>
                    </div>

                    ';
            }
            ?>

        </ul>
        <ul hidden class="derecha">
            <li class="pointer carrito-icono" onclick="window.location.search = '?ruta=Carrito'">
                <i class="fa fa-shopping-cart"></i>
            </li>
        </ul>

        <div id="cerrar" class="pointer" style="display: none;" onclick="menu()">
            X
        </div>
    </div>
    <div style="display: none;" id="hamburgesa" onclick="menu()">
        <i class="fas fa-bars"></i>
    </div>
</nav>

<script>
    function hacerscroll(hash) {
        $('html, body').animate({
            scrollTop: $(hash).offset().top - 80
        }, 800, function() {

        });
    };
</script>
<?php

if (isset($_GET['dpx'])) {
    print_r($_SESSION);
}
?>