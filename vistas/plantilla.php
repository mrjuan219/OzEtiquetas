<?php
if (!isset($_COOKIE["PHPSESSID"])) {
    session_start();
}

date_default_timezone_set('America/Monterrey');
// Unix
setlocale(LC_TIME, 'es_CO.UTF-8');

//Datos de empresa
$Nombre_Empresa = "Oz Etiquetas";
$Logo = "imagenes/Iconos/logo-01.png";
$Favicon = "imagenes/Iconos/favicon.ico";
$Facebook = "https://www.facebook.com/Oz Etiquetas";
$Whatsapp = "3336758864";
$Twitter = "#";
$Youtube = "#";
$Instagram = "#";

//Forzar carga sin cache con query string
$version = 'Final12012024';
$version = rand(1, 10000);

//Variables accesibles para otros archivos
$sesion = new Sesiones();
$sesion->setSesion('logo', $Logo);
$sesion->setSesion('nombreEmpresa', $Nombre_Empresa);

//Redireccion
if (!isset($_GET['ruta'])) {
    $_GET['ruta'] = 'Inicio';

    $redireccion = '
    <script>
        window.location.search = "ruta=Inicio";
    </script>
    ';

    echo $redireccion;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="organization" content="<?php echo $Nombre_Empresa ?>" />
    <meta name="lang" content="es-ES" />

    <!-- Miniatura pestaña -->
    <link rel="icon" type="image/png" href="<?php echo $Favicon; ?>" />

    <title>
        <?php
        echo $Nombre_Empresa . "&nbsp;|&nbsp;" . $_GET['ruta'];
        ?>
    </title>

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

    <!-- SWEET ALERT -->
    <script src="js/sweetalert2.all.min.js"></script>

    <!-- POPPER JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" crossorigin="anonymous"></script>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <!-- JQUERY COOKIE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

    <!-- FONT AWESOME ICONOS -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- OWL - CAROUSEL -->
    <link rel="stylesheet" href="css/owl/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous"></script>

    <!-- SELECT 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- MAPS -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_HNy3kwH5XCnrwLu6EXsjIsFbDasw828&callback=initMap"></script>

    <!-- Estilos -->
    <link rel="stylesheet" href="css/General.css?<?php echo $version ?>">
    <link rel="stylesheet" href="css/BootstrapMod.css?<?php echo $version ?>">
    <link rel="stylesheet" href="css/loader.css?<?php echo $version ?>">
    <link rel="stylesheet" href="css/fonts.css?<?php echo $version ?>">
    <link rel="stylesheet" href="css/modales.css?<?php echo $version ?>">
    <link rel="stylesheet" href="css/estilos.css?<?php echo $version ?>">
    <link rel="stylesheet" href="css/moviles.css?<?php echo $version ?>">
    <link rel="stylesheet" href="css/sidebar.css?<?php echo $version ?>">
    <script src="js/Login_registro.js" ?<?php echo $version ?>></script>
    <script src="js/slimmenu.js"></script>
    <script src="js/servicios.js?<?php echo $version ?>"></script>
    <script src="js/productos.js?<?php echo $version ?>"></script>



</head>

<body>

    <div id="loader">
        <div class="loader-wrapper">
            <div class="loader">
                <div class="roller"></div>
                <div class="roller"></div>
            </div>

            <div id="loader2" class="loader">
                <div class="roller"></div>
                <div class="roller"></div>
            </div>

            <div id="loader3" class="loader">
                <div class="roller"></div>
                <div class="roller"></div>
            </div>
        </div>
    </div>

    <?php
    $mvc = new ControladorPlantilla();


    //Cargar Menu
    $mvc->ctrMenu();
    //Cargar Contenido
    $mvc->ctrEnlaces();
    //Cargar Footer
    $mvc->ctrFooter();

    ?>
    <script>
        <?php
        if (isset($_GET['alerta'])) {
            if ($_GET['alerta'] == 'IniciarSesion' && !isset($_SESSION['perfil'])) {
                echo "$('#modalLogin').modal('show');";
            }
        }
        ?>
    </script>

    <script>
        window.onload = function() {
            $('#loader').slideUp(300);
            AOS.init();
        };
    </script>

    <?php
    if ($_GET['ruta'] != '') {
        echo '
    <div class="icon-barslide" style="z-index: 99999999;" data-aos="fade-right" data-aos-delay="300" data-aos-duration="600">

        <a href="' . $Facebook . '" rel="noopener" target="_blank" class="facebook">
            <img src="imagenes/sidebar/ffacebook.png" class="imgbarlog">
        </a>

        <a hidden href="' . $Instagram . '" target="_blank" rel="noopener" class="intagram">
            <img src="imagenes/sidebar/intragram.png" class="imgbarlog">
        </a>

        <a hidden href="' . $Twitter . '" target="_blank" rel="noopener" class="fmesseger">
            <img src="imagenes/sidebar/twitter_blanco.png" class="imgbarlog">
        </a>

        <a href="https://wa.me/' . $Whatsapp . '" target="_blank" rel="noopener" class="whatsapp">
            <img src="imagenes/sidebar/whatsapp.png" class="imgbarlog">
        </a>
        
        <a href="tel:' . $Whatsapp . '" target="_blank" rel="noopener" class="telefono">
            <img src="imagenes/sidebar/telefono.png" class="imgbarlog">
        </a>

    </div>
    ';
    }
    ?>
</body>

</html>