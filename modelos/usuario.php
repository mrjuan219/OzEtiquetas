<?php
session_start();
class ModeloUsuario
{

    public static function loginMdl($usuario, $contraseña, $tabla)
    {
        $sql = "SELECT id, usuario, nombre, perfil, contraseña FROM $tabla WHERE usuario = '$usuario'";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);

            //var_dump($respuesta);

            if ($respuesta != false && !empty($respuesta) && $respuesta['contraseña'] == $contraseña) {
                $respuesta['ok'] = '1';
                $hora = date('Y-m-d H:i:s');
                ModeloUsuario::actualizarUltimaVezLogin($hora, $usuario);
                return $respuesta;
            } else {
                echo 'error';
            }
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function actualizarUltimaVezLogin($hora, $usuario)
    {
        $sql = "UPDATE usuarios SET ultimo_login = '$hora' WHERE usuario = '$usuario'";
        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $_SESSION['ultimo_login'] = $hora;
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function traerDatosUsuarioMdl($usuario, $tabla)
    {
        $sql = "SELECT * FROM $tabla WHERE usuario = '$usuario'";
        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function verificarDisponibilidadMdl($usuario, $correo, $tabla)
    {
        $sql = "SELECT usuario, correo FROM $tabla WHERE usuario = '$usuario' OR correo = '$correo'";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($respuesta)) {
                return 'Disponible';
            } {
                return 'Ocupado';
            }
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function traerDireccionesMdl($usuario, $tabla)
    {
        $sql = "SELECT * FROM $tabla WHERE usuario = '$usuario' ORDER BY principal DESC";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function traerPedidosMdl($usuario, $tabla, $id = 0)
    {
        $inner_join = "INNER JOIN usuarios AS b ON a.usuario = b.usuario ";

        $sql = "SELECT a.*, b.correo, b.perfil, b.telefono, b.ultimo_login, b.foto_perfil FROM $tabla AS a $inner_join WHERE a.usuario = '$usuario'";

        if ($id != 0) {
            $sql = "SELECT a.*, b.correo, b.perfil, b.telefono, b.ultimo_login, b.foto_perfil FROM $tabla AS a $inner_join WHERE a.usuario = '$usuario' AND a.id = '$id'";
        }

        if ($usuario == 'todos' && $id != 0) {
            $sql = "SELECT a.*, b.correo, b.perfil, b.telefono, b.ultimo_login, b.foto_perfil FROM $tabla AS a $inner_join WHERE a.id = '$id'";
        }

        if ($usuario == 'todos' && $id == 0) {
            $sql = "SELECT a.*, b.correo, b.perfil, b.telefono, b.ultimo_login, b.foto_perfil FROM $tabla AS a $inner_join";
        }

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function actualizarCantidadTamañosMld($cantidad, $id)
    {
        $sql = "UPDATE tamaños SET cantidad = '$cantidad' WHERE id = '$id'";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return 'success';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function nuevoPedidoMdl($folio, $fecha_pedido, $cantidad_articulos, $precio_total, $json_articulos, $usuario, $direccion, $tabla, $estado = 'Orden Recibida')
    {
        $sql = "INSERT INTO $tabla (
            folio_pedido, 
            fecha_pedido, 
            cantidad_articulos, 
            precio_total, 
            json_articulos, 
            usuario, 
            direccion,
            estado
            ) VALUES (
                \"$folio\", 
                \"$fecha_pedido\", 
                \"$cantidad_articulos\", 
                \"$precio_total\", 
                '$json_articulos', 
                \"$usuario\", 
                \"$direccion\", 
                \"$estado\"
            )";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            unset($_SESSION['carrito']);

            $arreglo_articulos = json_decode($json_articulos, true);

            foreach ($arreglo_articulos as $articulo) {
                $cantidad = $articulo['cantidad'];
                $id = $articulo['id_tamaño'];

                $actualizar_cantidad = ModeloUsuario::actualizarCantidadTamañosMld($cantidad, $id);
            }

            return 'success';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function registroMdl($usuario, $nombre, $contraseña, $telefono, $correo, $perfil, $sucursal, $tabla)
    {
        if ($perfil == null || $perfil == '') {
            $perfil = "0";
        }
        if ($sucursal == null || $sucursal == '') {
            $sucursal = "0";
        }

        $sql = "INSERT INTO $tabla (
            usuario, 
            nombre, 
            correo, 
            contraseña, 
            telefono,
            perfil,
            id_sucursal
            ) VALUES (
                \"$usuario\", 
                \"$nombre\", 
                \"$correo\", 
                \"$contraseña\", 
                \"$telefono\",
                \"$perfil\",
                \"$sucursal\"
            )";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario;
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function agendarCitaSedeMdl($nombre, $correo, $telefono, $sede, $motivo, $horario, $fecha, $tabla)
    {
        $sql = "INSERT INTO $tabla (
            nombre, 
            correo, 
            telefono, 
            sede, 
            motivo, 
            horario,
            fecha
            ) VALUES (
                \"$nombre\", 
                \"$correo\", 
                \"$telefono\", 
                \"$sede\", 
                \"$motivo\", 
                \"$horario\",
                \"$fecha\"
            )";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return 'insertó';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function registrarSucursalMdl($nombre, $direccion, $apertura, $cierre, $latitud, $longitud, $tabla)
    {
        $sql = "INSERT INTO $tabla (
            nombre_sucursal, 
            latitud, 
            longitud, 
            direccion, 
            horario_inicio,
            horario_fin
            ) VALUES (
                \"$nombre\", 
                \"$latitud\", 
                \"$longitud\", 
                \"$direccion\", 
                \"$apertura\",
                \"$cierre\"
            )";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return 'success';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function actualizarSucursalMdl($nombre, $direccion, $apertura, $cierre, $latitud, $longitud, $id, $tabla)
    {

        $sql = "UPDATE $tabla 
                SET nombre_sucursal = '$nombre', 
                    latitud = '$latitud',
                    longitud = '$longitud',
                    direccion = '$direccion',
                    horario_inicio = '$apertura',
                    horario_fin = '$cierre'
                WHERE id = '$id'";

        echo $sql;
        
        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return 'success';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function registroDireccionMdl($usuario, $nombre_ubicacion, $calle, $numero, $colonia, $codigo_postal, $municipio, $estado, $pais, $principal, $comentarios, $tabla)
    {
        if ($principal == 1) {
            $respuesta_principal = ModeloUsuario::quitarPrincipalesMdl($usuario, 'ubicaciones');

            if ($respuesta_principal == 'success') {
                //
            }
        }

        $sql = "INSERT INTO $tabla (
            usuario, 
            nombre_ubicacion, 
            calle, 
            numero, 
            colonia, 
            codigo_postal, 
            municipio, 
            estado,
            pais,
            principal
            ) VALUES (
                \"$usuario\", 
                \"$nombre_ubicacion\", 
                \"$calle\", 
                \"$numero\", 
                \"$colonia\", 
                \"$codigo_postal\", 
                \"$municipio\", 
                \"$estado\",
                \"$pais\",
                \"$principal\"
            )";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return 'success';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function insertarEnCursosMdl($usuario, $id_curso)
    {
        $sql = "INSERT INTO cursos_usuario (
            id_usuario, 
            id_curso, 
            status
            ) VALUES (
                \"$usuario\", 
                \"$id_curso\",
                \"1\"
            )";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return 'success';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function actualizarInfoPerfilMdl($nombre, $correo, $telefono, $facebook, $linkedin, $tabla)
    {
        $usuario = $_SESSION['usuario'];
        $sql1 = "UPDATE $tabla SET nombre = '$nombre' WHERE usuario = '$usuario'";
        $sql2 = "UPDATE $tabla SET correo = '$correo' WHERE usuario = '$usuario'";
        $sql3 = "UPDATE $tabla SET telefono = '$telefono' WHERE usuario = '$usuario'";
        $sql4 = "UPDATE $tabla SET facebook = '$facebook' WHERE usuario = '$usuario'";
        $sql5 = "UPDATE $tabla SET linkedin = '$linkedin' WHERE usuario = '$usuario'";

        $stmt = conexion::conectar()->query($sql1);
        $stmt = conexion::conectar()->query($sql2);
        $stmt = conexion::conectar()->query($sql3);
        $stmt = conexion::conectar()->query($sql4);
        $stmt = conexion::conectar()->query($sql5);

        return 'actualizado';

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function actualizarPerfilAdminMdl($usuario, $nombre, $contraseña, $correo, $telefono, $sucursal, $tipo, $tabla)
    {
        $sql1 = "UPDATE $tabla SET nombre = '$nombre' WHERE usuario = '$usuario'";
        $sql6 = "UPDATE $tabla SET contraseña = '$contraseña' WHERE usuario = '$usuario'";
        $sql2 = "UPDATE $tabla SET correo = '$correo' WHERE usuario = '$usuario'";
        $sql3 = "UPDATE $tabla SET telefono = '$telefono' WHERE usuario = '$usuario'";
        $sql4 = "UPDATE $tabla SET sucursal = '$sucursal' WHERE usuario = '$usuario'";
        $sql5 = "UPDATE $tabla SET tipo = '$tipo' WHERE usuario = '$usuario'";

        $stmt = conexion::conectar()->query($sql1);
        $stmt = conexion::conectar()->query($sql2);
        $stmt = conexion::conectar()->query($sql3);
        $stmt = conexion::conectar()->query($sql4);
        $stmt = conexion::conectar()->query($sql5);
        $stmt = conexion::conectar()->query($sql6);

        return 'actualizado';

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function registrarCitaCompletadaMdl($nombre, $fecha, $usuario, $id, $tabla)
    {
        $sql1 = "UPDATE $tabla SET fecha_atendida = '$fecha' WHERE id = '$id'";
        $sql2 = "UPDATE $tabla SET nombre_atendida = '$nombre' WHERE id = '$id'";
        $sql3 = "UPDATE $tabla SET estatus_cita = '1' WHERE id = '$id'";
        $sql4 = "UPDATE $tabla SET usuario_modifico = '$usuario' WHERE id = '$id'";

        $stmt = conexion::conectar()->query($sql1);
        $stmt = conexion::conectar()->query($sql2);
        $stmt = conexion::conectar()->query($sql3);
        $stmt = conexion::conectar()->query($sql4);

        return 'insertó';

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function actualizarRutaPerfil($nombreUsuario, $ruta_db)
    {

        $sql = "UPDATE usuarios SET foto_perfil = '$ruta_db' WHERE usuario = '$nombreUsuario'";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return 'success';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function cambiarEstatusPedidoMdl($id, $estatus, $bool, $paqueteria, $id_rastreo, $tabla)
    {
        if ($estatus == 'pagado') {
            $stmt1 = conexion::conectar()->query("UPDATE $tabla SET empacado = '0' WHERE id = '$id'");
            //Desmarcar empaquetado
            $stmt2 = conexion::conectar()->query("UPDATE $tabla SET enviado = '0' WHERE id = '$id'");
            //Desmarcar enviado
            $stmt3 = conexion::conectar()->query("UPDATE $tabla SET entregado = '0' WHERE id = '$id'");
            //Desmarcar entregado
            //
        } else if ($estatus == 'empacado') {
            $stmt1 = conexion::conectar()->query("UPDATE $tabla SET enviado = '0' WHERE id = '$id'");
            //Desmarcar enviado
            $stmt2 = conexion::conectar()->query("UPDATE $tabla SET entregado = '0' WHERE id = '$id'");
            //Desmarcar entregado
            //
        } else if ($estatus == 'enviado') {
            $stmt1 = conexion::conectar()->query("UPDATE $tabla SET entregado = '0' WHERE id = '$id'");
            //Desmarcar entregado
            //
        }

        if ($paqueteria != 0 && $id_rastreo != 0) {
            $stmt_paqueteria = conexion::conectar()->query("UPDATE $tabla SET paqueteria = '$paqueteria' WHERE id = '$id'");
            $stmt_rastreo = conexion::conectar()->query("UPDATE $tabla SET id_rastreo = '$id_rastreo' WHERE id = '$id'");
        }

        $sql = "UPDATE $tabla SET $estatus = '$bool' WHERE id = '$id'";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return 'success';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function quitarPrincipalesMdl($usuario, $tabla)
    {

        $sql = "UPDATE $tabla SET principal = '0' WHERE usuario = '$usuario'";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return 'success';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }


    public static function marcarComoDireccionPrincipalMdl($id)
    {
        $sql = "UPDATE ubicaciones set principal = '1' WHERE id = '$id'";
        $quitar = ModeloUsuario::quitarPrincipalesMdl($_SESSION['usuario'], 'ubicaciones');
        //echo $sql."\n";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            return 'success';
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function agregarPrincipalesMdl($id, $tabla)
    {

        $sql = "UPDATE $tabla SET principal = '1' WHERE id = '$id'";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return 'success';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }
}
