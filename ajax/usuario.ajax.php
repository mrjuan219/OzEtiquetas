<?php
//session_start();

require_once('../controlador/sessionControlador.php');
require_once('../controlador/usuarioControlador.php');
require_once('../controlador/productosControlador.php');
require_once('../modelos/conexion.php');
require_once('../modelos/usuario.php');
require_once('../modelos/productos.php');

date_default_timezone_set('America/Monterrey');
// Unix
setlocale(LC_TIME, 'es_ES.UTF-8');

class UsuarioAjax
{

    public function loginAjax()
    {
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        $respuesta = ControladorUsuario::loginCtr($usuario, $contraseña);

        if ($respuesta['ok'] == 1) {
            $sesion = new Sesiones();
            $sesion->setSesion('login', '1');
            $sesion->setSesion('id', $respuesta['id']);
            $sesion->setSesion('nombre', $respuesta['nombre']);
            $sesion->setSesion('usuario', $respuesta['usuario']);
            $sesion->setSesion('perfil', $respuesta['perfil']);
            echo $sesion->getSesion('usuario');
        } else {
            print_r($respuesta);
        }
    }

    public function registroAjax()
    {
        $usuario = strtolower($_POST['usuario']);
        $nombre = $_POST['nombre'];
        $contraseña = $_POST['contraseña'];
        $correo =  strtolower($_POST['correo']);
        $telefono = $_POST['telefono'];

        $respuesta = ControladorUsuario::registroCtr($usuario, $nombre, $contraseña, $telefono, $correo);

        if ($respuesta == $usuario) {
            $sesion = new Sesiones();
            $sesion->setSesion('login', '1');
            $sesion->setSesion('nombre', $respuesta['nombre']);
            echo $sesion->getSesion('usuario');
        }
        //echo $respuesta;
    }

    public function registro_adminAjax()
    {
        $usuario = strtolower($_POST['usuario']);
        $nombre = $_POST['nombre'];
        $contraseña = $_POST['contraseña'];
        $correo =  strtolower($_POST['correo']);
        $telefono = $_POST['telefono'];
        $tipo = $_POST['tipo'];
        $sucursal = $_POST['sucursal'];

        $disponibilidad = ControladorUsuario::verificarDisponibilidadCtr($usuario, $correo);

        if ($disponibilidad == 'Disponible') {
            $respuesta = ControladorUsuario::registroCtr($usuario, $nombre, $contraseña, $telefono, $correo, $tipo, $sucursal);
            if ($respuesta == $usuario) {
                echo 'Success';
            }
            //echo $respuesta;
        } else {
            echo $disponibilidad;
        }
    }

    public function registroUbicacionAjax()
    {
        $usuario = $_SESSION['usuario'];
        $nombre_ubicacion = $_POST['nombre_ubicacion'];
        $calle = $_POST['calle'];
        $numero = $_POST['numero'];
        $colonia =  $_POST['colonia'];
        $codigo_postal =  $_POST['codigo_postal'];
        $municipio = $_POST['municipio'];
        $estado = $_POST['estado'];
        $pais = $_POST['pais'];
        $principal = $_POST['principal'];
        $comentarios = $_POST['comentarios'];

        if ($principal == 'true') {
            $principal = 1;
        } else if ($principal == 'false') {
            $principal = 0;
        }

        $respuesta = ControladorUsuario::registroDireccionCtr($usuario, $nombre_ubicacion, $calle, $numero, $colonia, $codigo_postal, $municipio, $estado, $pais, $principal, $comentarios);

        print_r($respuesta);
    }

    public function verificarDisponibilidad()
    {
        $usuario = strtolower($_POST['usuario']);
        $correo = strtolower($_POST['correo']);

        $respuesta = ControladorUsuario::verificarDisponibilidadCtr($usuario, $correo);

        echo $respuesta;
    }

    public function cerrarSesion()
    {
        if ($_POST['cerrarSesion'] == 1) {
            $sesion = new Sesiones();
            $sesion->termina_Sesion();
        }
    }

    public function traerInformacionUsuario()
    {

        $usuario = $_POST['usuarioInformacion'];

        $respuesta = ControladorUsuario::traerDatosUsuarioCtr($usuario);

        echo json_encode($respuesta);
    }

    public function traerPedidosAjax()
    {

        $usuario = $_SESSION['usuario'];
        $id = $_POST['id_pedido'];

        if ($id == null) {
            $id = 0;
        }

        if ($_SESSION['ruta'] == 'Pedidos_panel') {
            $usuario = 'todos';
        }

        //print_r($_SESSION);

        $respuesta = ControladorUsuario::traerPedidosCtr($usuario, $id);

        //print_r($respuesta);

        if ($id == null || $id == 0) {
            echo json_encode($respuesta);
        }

        if ($id > 0) {
            $compra = $respuesta[0];
            $direccion = explode(",", $compra['direccion']);
            //$calle_arreglo = explode(" ", $direccion);
            $calle = $direccion[0];
            $colonia = $direccion[1];
            $cp = $direccion[2];
            $municipio = $direccion[3];
            $estado = $direccion[4];
            $pais = $direccion[5];
            $descripcion = $direccion[6];
            $json = json_decode($compra['json_articulos'], true);

            //print_r($json);

            echo '
                    <h3>
                        Mi Compra
                    </h3>

                    <div class="contenedor_tabla">
                        <table class="table">
                            <thead>
                                <tr class="bg-azul">
                                    <th scope="col">Fecha de compra</th>
                                    <th scope="col">Pedido</th>
                                    <th scope="col" style="width: 30%;">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">' . strftime("%d/%m/%Y", strtotime($compra['fecha_pedido'])) . '</th>
                                    <td>#' . $compra['folio_pedido'] . '</td>
                                    <td>' . $compra['estado'] . '</td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="bar__container">
                        <ul class="bar" id="bar">
                        ';

            $paso1 = 'active';
            $paso2 = '';
            $paso3 = '';
            $paso4 = '';
            $paso5 = '';

            if ($compra['entregado'] == '1') {
                $paso5 = 'active';
            }
            if ($compra['enviado'] == '1') {
                $paso4 = 'active';
            }
            if ($compra['empacado'] == '1') {
                $paso3 = 'active';
            }
            if ($compra['pagado'] == '1') {
                $paso2 = 'active';
            }

            if ($_SESSION['ruta'] == 'Pedidos_panel') {
                $onclick_pagado = 'onclick="marcarComo(' . "'$id'" . ',' . "'pagado'" . ', ' . "this" . ')"';
                $onclick_empaquetado = 'onclick="marcarComo(' . "'$id'" . ',' . "'empacado'" . ', ' . "this" . ')"';
                $onclick_enviado = 'onclick="marcarComo(' . "'$id'" . ',' . "'enviado'" . ', ' . "this" . ')"';
                $onclick_entregado = 'onclick="marcarComo(' . "'$id'" . ',' . "'entregado'" . ', ' . "this" . ')"';
            } else {
                $onclick_pagado = '';
                $onclick_empaquetado = '';
                $onclick_enviado = '';
                $onclick_entregado = '';
            }

            echo '
                            <li class="' . $paso1 . '">
                                <h4>
                                    Completado
                                </h4>
                            </li>
                            <li class="' . $paso2 . '" ' . $onclick_pagado . '>
                                <h4>
                                    Pagado
                                </h4>
                            </li>
                            <li class="' . $paso3 . '" ' . $onclick_empaquetado . '>
                                <h4>
                                    Empacado
                                </h4>
                            </li>
                            <li class="' . $paso4 . '" ' . $onclick_enviado . '>
                                <h4>
                                    Enviado
                                </h4>
                            </li>
                            <li class="' . $paso5 . '" ' . $onclick_entregado . '>
                                <h4>
                                    Recibido
                                </h4>
                            </li>
                        </ul>
                    </div>

                    <h3 style="margin-top: 10rem;">
                        Entrega
                    </h3>

                    <div class="contenedor_direcciones_entrega">
                        <div class="direcciones_entrega">
                            <div class="contenedor_titulo_direccion">
                                <h3>
                                    Direccion de envio
                                </h3>
                            </div>
                            <div class="subcontenedor_direccion">
                                <h4>
                                    Luis Sanchez
                                </h4>
                                <p>
                                    Nombre: Sucursal Sanvite
                                </p>
                                <p>
                                    Direccion: Av mariano otero #1500
                                </p>
                                <p>
                                    Colonia: Del sol
                                </p>
                                <p>
                                    CP: 46600
                                </p>
                                <p>
                                    Zapopan, Jalisco, Mexico
                                </p>
                                <p>
                                    Telefono: 3317458602
                                </p>
                                <p>
                                    Correo: Luissanchezb35@gmail.com
                                </p>
                            </div>
                        </div>
                        <div class="direcciones_entrega">
                            <div class="contenedor_titulo_direccion">
                                <h3>
                                    Direccion de entrega
                                </h3>
                            </div>
                            <div class="subcontenedor_direccion">
                                <h4>
                                    ' . $compra['usuario'] . '
                                </h4>
                                <p>
                                    Direccion: ' . $calle . '
                                </p>
                                <p>
                                    Colonia: ' . $colonia . '
                                </p>
                                <p>
                                    CP: ' . intval(preg_replace('/[^0-9]+/', '', $cp), 10) . '
                                </p>
                                <p>
                                    ' . $municipio . ', ' . $estado . ', ' . $pais . '
                                </p>
                                <p>
                                    Descripcion: ' . $descripcion . '
                                </p>
                                <p>
                                    Telefono: ' . $compra['telefono'] . '
                                </p>
                                <p>
                                    Correo: ' . $compra['correo'] . '
                                </p>
                            </div>
                        </div>
                    </div>

                    <h3 style="margin-top: 3rem;">
                        Resumen
                    </h3>

                    <div class="contenedor_tabla">
                        <table class="table">
                            <thead>
                                <tr class="bg-azul">
                                    <th scope="col">Producto</th>
                                    <th scope="col">Pedido</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody
                            ';
            foreach ($json as $articulo) {
                $id_producto = $articulo['id'];

                $producto = ControladorProductos::traerProductosCtr(0, 2, $id_producto);

                if (empty($producto)) {
                    $producto[0]['titulo'] = 'Producto No Disponible';
                    $producto[0]['precio'] = $articulo['precio'];
                }

                $producto = $producto[0];
                //print_r($articulo);

                $imagenes = ControladorProductos::traerImagenesCtr($id_producto);
                $img = $imagenes[0]['ruta'];

                echo '
                                <tr>
                                    <th scope="row">
                                        <div class="contenedor_img_producto_resumen">
                                            <img src=".' . $img . '" alt="Producto">
                                            <p>
                                                ' . $producto['titulo'] . '
                                            </p>
                                        </div>
                                    </th>
                                    <td>
                                        $' . number_format($articulo['precio'], 2, '.', ' ') . '
                                    </td>
                                    <td>
                                        ' . $articulo['cantidad'] . '
                                    </td>
                                    <td>
                                        $' . number_format($articulo['precio'], 2, '.', ' ') * $articulo['cantidad'] . '
                                    </td>
                                    <td>
                                        <div onclick="window.location.search=' . "'" . "?ruta=Articulo&id=$id_producto" . "'" . '" class="btn btn-detalles-compra">Detalles de producto</div>
                                    </td>
                                </tr>';
            }

            echo '
                            </tbody>
                        </table>

                        <table class="table" style="margin-top: 3rem;">
                            <thead>
                                <tr class="bg-azul">
                                    <th scope="col" style="width: 85%;">Cantidad con impuestos incluidos de tu pedido</th>
                                    <th scope="col" style="width: 15%;">$ ' . number_format($compra['precio_total'], 2, '.', ' ') . '</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
            ';
        }
    }

    public function agregarAlCarritoAjax()
    {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        $carrito = $_SESSION['carrito'];

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $tamaño = $_POST['tamaño'];
        $id_tamaño = $_POST['id_tamaño'];

        $contador_carrito = count($carrito);
        $contador_carrito = $contador_carrito + 1;

        $carrito[] = array("id" => "$id", "nombre" => "$nombre", "precio" => "$precio", "cantidad" => "$cantidad", "tamaño" => "$tamaño", "id_tamaño" => "$id_tamaño", "posicion" => "$contador_carrito");

        $_SESSION['carrito'] = $carrito;

        echo 'guardado';
    }

    public function eliminarDelCarrito()
    {
        $posicion = $_POST['eliminarDelCarrito'];
        unset($_SESSION['carrito'][$posicion]);

        echo 'eliminado';
    }

    public function nuevoPedidoAjax()
    {
        $fecha_pedido = date('Y-m-d H:i:s');
        $usuario = $_SESSION['usuario'];
        $direccion = $_POST['direccion'];
        $carrito = $_SESSION['carrito'];

        $cantidad_articulos = 0;

        foreach ($carrito as $item) {
            $cantidad_articulos = $item['cantidad'] + $cantidad_articulos;
        }

        foreach ($_SESSION['carrito'] as $key => $articulo) {
            $id_articulo = $articulo['id'];

            if ($articulo['tamaño'] == 'presencial' || $articulo['tamaño'] == 'online') {
                $insertarTabla = ModeloUsuario::insertarEnCursosMdl($_SESSION['id'], $id_articulo);
            }
        }

        $precio_total = $_SESSION['total_pagar'];

        $json_articulos = json_encode($carrito, JSON_UNESCAPED_UNICODE);

        $folio = strftime("%d%m%Y%H%M%S", strtotime($fecha_pedido)) . $usuario;

        $respuesta = ControladorUsuario::nuevoPedidoCtr($folio, $fecha_pedido, $cantidad_articulos, $precio_total, $json_articulos, $usuario, $direccion);
        print_r($respuesta);
    }

    public function actualizarInfoPersonalAjax()
    {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $facebook = $_POST['facebook'];
        $linkedin = $_POST['linkedin'];

        $respuesta = ControladorUsuario::actualizarInfoPerfilCtr($nombre, $correo, $telefono, $facebook, $linkedin);

        print_r($respuesta);
    }

    public function agendarCitaSedeAjax()
    {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $sede = $_POST['sede'];
        $motivo = $_POST['motivo'];
        $horario = $_POST['horario'];
        $fecha = $_POST['fecha'];

        $respuesta = ControladorUsuario::agendarCitaSedeCtr($nombre, $correo, $telefono, $sede, $motivo, $horario, $fecha);

        print_r($respuesta);
    }

    public function actualizarPerfilAdminAjax()
    {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $contraseña = $_POST['contraseña'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $sucursal = $_POST['sucursal'];
        $tipo = $_POST['tipo'];

        $respuesta = ControladorUsuario::actualizarPerfilAdminCtr($usuario, $nombre, $contraseña, $correo, $telefono, $sucursal, $tipo);

        print_r($respuesta);
    }

    public function traerSucursalAjax()
    {
        $id = $_POST['traerSucursal'];

        $respuesta = modelo_productos::traerMdl('sucursales', "WHERE id = '$id'");

        echo json_encode($respuesta);
    }

    public function traerUsuarioJsonAjax()
    {
        $id = $_POST['traerUsuarioJson'];

        $respuesta = modelo_productos::traerMdl('usuarios', "WHERE id = '$id'");

        echo json_encode($respuesta);
    }

    public function eliminarAjax()
    {
        $id = $_POST['id'];

        $respuesta = modelo_productos::eliminarMdl('usuarios', $id);

        print_r($respuesta);
    }

    public function marcarComoDireccionPrincipalAjax()
    {
        $id = $_POST['id'];

        $respuesta = ModeloUsuario::marcarComoDireccionPrincipalMdl($id);

        print_r($respuesta);
    }

    public function cambiarEstatusPedidoAjax()
    {
        $id = $_POST['id_pedido'];
        $estatus = $_POST['estatus'];
        $bool = $_POST['bool'];
        $paqueteria = $_POST['paqueteria'];
        $id_rastreo = $_POST['id_rastreo'];

        $respuesta = ControladorUsuario::cambiarEstatusPedidoCtr($id, $estatus, $bool, $paqueteria, $id_rastreo);

        print_r($respuesta);
    }

    public function registrarSucursalAjax()
    {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $apertura = $_POST['apertura'];
        $cierre = $_POST['cierre'];
        $latitud = $_POST['latitud'];
        $longitud = $_POST['longitud'];

        $respuesta = ControladorUsuario::registrarSucursalCtr($nombre, $direccion, $apertura, $cierre, $latitud, $longitud);

        print_r($respuesta);
    }

    public function actualizarSucursalAjax()
    {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $apertura = $_POST['apertura'];
        $cierre = $_POST['cierre'];
        $latitud = $_POST['latitud'];
        $longitud = $_POST['longitud'];
        $id = $_POST['id_sucursal'];

        $respuesta = ControladorUsuario::actualizarSucursalCtr($nombre, $direccion, $apertura, $cierre, $latitud, $longitud, $id);

        print_r($respuesta);
    }

    public function citaCompletadaAjax()
    {
        $id = $_POST['id_cita'];
        $nombre = $_POST['nombre'];
        $fecha = date('Y-m-d H:i:s');
        $usuario = $_SESSION['usuario'];

        $respuesta = ControladorUsuario::registrarCitaCompletadaCtr($nombre, $fecha, $usuario, $id);

        print_r($respuesta);
    }

    public function generarTokenAjax()
    {
        $token = rand(100000, 999999);

        $fecha_formatear = $_POST['fecha'];
        $correo = $_POST['correo'];

        $fecha = ucfirst(strftime("%A %d de %B del %Y", strtotime($fecha_formatear)));

        $arreglo['token'] = $token;
        $arreglo['fecha'] = $fecha;

        $json = json_encode($arreglo);

        $para      = $correo;
        $titulo = 'Cita | Verificación';
        $mensaje = '
Gracias por tu interes en agendar una cita!

Con el siguiente codigo puedes validar tu cita en la pagina web, si no hiciste esta peticion sólo ignora este correo.
        
-----------------------------------
    Codigo: ' . $token . '
-----------------------------------

        ';

        $encabezado = 'From:noreply@cemarketing.mx' . "\r\n";

        mail($para, $titulo, $mensaje, $encabezado);

        echo $json;
    }

    public function cambiarFotoPerfilAjax()
    {
        print_r($_POST);
        print_r($_FILES);
        $validar = 0;

        echo '<br>|<br>';

        $nombreUsuario = $_SESSION['usuario'];

        foreach ($_FILES as $archivo) {
            //Carga de imagenes
            $cargarImagen = 'true';

            $tamaño_archivo = $archivo['size'];
            $tipo_archivo = $archivo['type'];

            if ($tamaño_archivo > 2000000) {
                $msg = 'El archivo es mayor que 2MB, debes reduzcirlo antes de subirlo';
                $cargarImagen = 'false';
            }

            if (!($tipo_archivo == 'image/jpeg' or $tipo_archivo == 'image/gif' or $tipo_archivo == 'image/png')) {
                $msg = 'Tu archivo tiene que ser JPG o GIF o PNG. Otros archivos no son permitidos' . $tipo_archivo;
                $cargarImagen = 'false';
            }

            $raiz = dirname(__DIR__, 1);
            $carpeta = "/" . "Subidas" . "/" . "fotos_perfil" . "/";
            $ruta_interna = $carpeta . $nombreUsuario . "/";
            $ruta = $raiz . $ruta_interna;
            $tipoArch = explode('/', $tipo_archivo);
            $tipoArchivo = $tipoArch[1];
            $nombreArchivo = $nombreUsuario . '.';
            $ruta_final = $ruta . $nombreArchivo . $tipoArchivo;
            $ruta_db = $ruta_interna . $nombreArchivo . $tipoArchivo;
            echo $ruta_final . " | \n";

            if (!file_exists($ruta)) {
                mkdir($ruta, 0777, true);
            }

            if ($cargarImagen == 'true') {

                if (move_uploaded_file($archivo['tmp_name'], "$ruta_final")) {
                    echo 'Se insertó: ' . $nombreUsuario . " | ";
                    $validar++;

                    $respuestaImagen = ModeloUsuario::actualizarRutaPerfil($nombreUsuario, $ruta_db);

                    if ($respuestaImagen == 'subidaDB') {
                        return 'success';
                    }
                } else {
                    echo "No se subió: " . $nombreUsuario;
                }
            } else {
                echo $msg;
            }
        }
    }
}


if (isset($_POST['actualizar_admin'])) {
    $ajax = new UsuarioAjax();
    $ajax->actualizarPerfilAdminAjax();
}

if (isset($_POST['traerUsuarioJson'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerUsuarioJsonAjax();
}

if (isset($_POST['guardarCitaCompletada'])) {
    $ajax = new UsuarioAjax();
    $ajax->citaCompletadaAjax();
}

if (isset($_POST['actualizar_sucursal'])) {
    $ajax = new UsuarioAjax();
    $ajax->actualizarSucursalAjax();
}

if (isset($_POST['traerSucursal'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerSucursalAjax();
}

if (isset($_POST['registrar_sucursal'])) {
    $ajax = new UsuarioAjax();
    $ajax->registrarSucursalAjax();
}

if (isset($_POST['marcarComoDireccionPrincipal'])) {
    $ajax = new UsuarioAjax();
    $ajax->marcarComoDireccionPrincipalAjax();
}

if (isset($_POST['generarToken'])) {
    $ajax = new UsuarioAjax();
    $ajax->generarTokenAjax();
}

if (isset($_POST['enviarCita'])) {
    $ajax = new UsuarioAjax();
    $ajax->agendarCitaSedeAjax();
}

if (isset($_POST['eliminar_id'])) {
    $ajax = new UsuarioAjax();
    $ajax->eliminarAjax();
}

if (isset($_POST['registro_admin'])) {
    $ajax = new UsuarioAjax();
    $ajax->registro_adminAjax();
}

if (isset($_POST['usuarioInformacion'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerInformacionUsuario();
}

if (isset($_POST['actualizarEstatus'])) {
    $ajax = new UsuarioAjax();
    $ajax->cambiarEstatusPedidoAjax();
}

if (isset($_POST['subirFotoPerfil'])) {
    $ajax = new UsuarioAjax();
    $ajax->cambiarFotoPerfilAjax();
}

if (isset($_POST['traerPedidos'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerPedidosAjax();
}

if (isset($_POST['nuevoPedido'])) {
    $ajax = new UsuarioAjax();
    $ajax->nuevoPedidoAjax();
}

if (isset($_POST['actualizarInfoPersonal'])) {
    $ajax = new UsuarioAjax();
    $ajax->actualizarInfoPersonalAjax();
}

if (isset($_POST['eliminarDelCarrito'])) {
    $ajax = new UsuarioAjax();
    $ajax->eliminarDelCarrito();
}

if (isset($_POST['añadirCarrito'])) {
    $ajax = new UsuarioAjax();
    $ajax->agregarAlCarritoAjax();
}

if (isset($_POST['registroUbicacion'])) {
    $ajax = new UsuarioAjax();
    $ajax->registroUbicacionAjax();
}

if (isset($_POST['login'])) {
    $ajax = new UsuarioAjax();
    $ajax->loginAjax();
}

if (isset($_POST['registro'])) {
    $ajax = new UsuarioAjax();
    $ajax->registroAjax();
}

if (isset($_POST['verificarD'])) {
    $ajax = new UsuarioAjax();
    $ajax->verificarDisponibilidad();
}

if (isset($_POST['cerrarSesion'])) {
    $ajax = new UsuarioAjax();
    $ajax->cerrarSesion();
}
