<?php
class ControladorUsuario
{

    public static function loginCtr($usuario, $contraseña)
    {
        $tabla = 'usuarios';

        $respuesta = ModeloUsuario::loginMdl($usuario, $contraseña, $tabla);

        return $respuesta;
    }

    public static function registroCtr($usuario, $nombre, $contraseña, $telefono, $correo, $perfil = '', $sucursal = '')
    {
        $tabla = 'usuarios';

        $respuesta = ModeloUsuario::registroMdl($usuario, $nombre, $contraseña, $telefono, $correo, $perfil, $sucursal, $tabla);

        return $respuesta;
    }

    public static function registroDireccionCtr($usuario, $nombre_ubicacion, $calle, $numero, $colonia, $cp, $municipio, $estado, $pais, $principal, $comentarios)
    {
        $tabla = 'ubicaciones';

        $respuesta = ModeloUsuario::registroDireccionMdl($usuario, $nombre_ubicacion, $calle, $numero, $colonia, $cp, $municipio, $estado, $pais, $principal, $comentarios, $tabla);

        return $respuesta;
    }

    public static function traerUsuariosCtr()
    {
        $tabla = 'usuarios';

        $respuesta = modelo_productos::traerMdl($tabla);

        return $respuesta;
    }

    public static function traerDireccionesCtr($usuario)
    {
        $tabla = 'ubicaciones';

        $respuesta = ModeloUsuario::traerDireccionesMdl($usuario, $tabla);

        return $respuesta;
    }

    public static function verificarDisponibilidadCtr($usuario, $correo)
    {
        $tabla = 'usuarios';

        $respuesta = ModeloUsuario::verificarDisponibilidadMdl($usuario, $correo, $tabla);

        return $respuesta;
    }

    public static function traerDatosUsuarioCtr($usuario)
    {
        $tabla = 'usuarios';

        $respuesta = ModeloUsuario::traerDatosUsuarioMdl($usuario, $tabla);

        return $respuesta;
    }

    public static function actualizarInfoPerfilCtr($nombre, $correo, $telefono, $facebook, $linkedin)
    {
        $tabla = 'usuarios';

        $respuesta = ModeloUsuario::actualizarInfoPerfilMdl($nombre, $correo, $telefono, $facebook, $linkedin, $tabla);

        return $respuesta;
    }

    public static function actualizarPerfilAdminCtr($usuario, $nombre, $contraseña, $correo, $telefono, $sucursal, $tipo)
    {
        $tabla = 'usuarios';

        $respuesta = ModeloUsuario::actualizarPerfilAdminMdl($usuario, $nombre, $contraseña, $correo, $telefono, $sucursal, $tipo, $tabla);

        return $respuesta;
    }

    public static function agendarCitaSedeCtr($nombre, $correo, $telefono, $sede, $motivo, $horario, $fecha)
    {
        $tabla = 'citas';

        $respuesta = ModeloUsuario::agendarCitaSedeMdl($nombre, $correo, $telefono, $sede, $motivo, $horario, $fecha, $tabla);

        return $respuesta;
    }

    public static function registrarCitaCompletadaCtr($nombre, $fecha, $usuario, $id)
    {
        $tabla = 'citas';

        $respuesta = ModeloUsuario::registrarCitaCompletadaMdl($nombre, $fecha, $usuario, $id, $tabla);

        return $respuesta;
    }

    public static function cambiarEstatusPedidoCtr($id, $estatus, $bool, $paqueteria, $id_rastreo)
    {
        $tabla = 'pedidos';

        $respuesta = ModeloUsuario::cambiarEstatusPedidoMdl($id, $estatus, $bool, $paqueteria, $id_rastreo, $tabla);

        return $respuesta;
    }

    public static function registrarSucursalCtr($nombre, $direccion, $apertura, $cierre, $latitud, $longitud)
    {
        $tabla = 'sucursales';

        $respuesta = ModeloUsuario::registrarSucursalMdl($nombre, $direccion, $apertura, $cierre, $latitud, $longitud, $tabla);

        return $respuesta;
    }

    public static function actualizarSucursalCtr($nombre, $direccion, $apertura, $cierre, $latitud, $longitud, $id)
    {
        $tabla = 'sucursales';

        $respuesta = ModeloUsuario::actualizarSucursalMdl($nombre, $direccion, $apertura, $cierre, $latitud, $longitud, $id, $tabla);

        return $respuesta;
    }

    public static function traerPedidosCtr($usuario, $id = 0)
    {
        $tabla = 'pedidos';

        $respuesta = ModeloUsuario::traerPedidosMdl($usuario, $tabla, $id);

        return $respuesta;
    }

    public static function nuevoPedidoCtr($folio, $fecha_pedido, $cantidad_articulos, $precio_total, $json_articulos, $usuario, $direccion)
    {
        $tabla = 'pedidos';

        $respuesta = ModeloUsuario::nuevoPedidoMdl($folio, $fecha_pedido, $cantidad_articulos, $precio_total, $json_articulos, $usuario, $direccion, $tabla);

        return $respuesta;
    }

    public static function detectarTipoDispositivo()
    {
        $tablet_browser = 0;
        $mobile_browser = 0;

        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $tablet_browser++;
        }

        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
        }

        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $mobile_browser++;
        }

        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'
        );

        if (in_array($mobile_ua, $mobile_agents)) {
            $mobile_browser++;
        }

        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
            $mobile_browser++;
            //Check for tablets on opera mini alternative headers
            $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
                $tablet_browser++;
            }
        }
        if ($tablet_browser > 0) {
           return 'tablet';
        } else if ($mobile_browser > 0) {
            return 'movil';
        } else {
            return 'escritorio';
        }
    }
}
