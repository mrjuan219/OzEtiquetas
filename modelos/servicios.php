<?php

class modelo_servicios
{

    public static function traerPaisesMdl($tabla)
    {
        $sql = "SELECT iso AS iniciales, nombre FROM $tabla WHERE iso != 'MX'";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //print_r($respuesta);
            return $respuesta;
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function traerEstadosMdl($tabla)
    {
        $sql = "SELECT * FROM $tabla";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function traerMunicipiosMdl($tabla, $estadoID)
    {
        $sql = "SELECT a.id, a.municipio, b.municipios_id, b.estados_id FROM municipios AS a INNER JOIN $tabla AS b ON b.municipios_id = a.id WHERE b.estados_id = '$estadoID'";

        echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function traerServiciosBusquedaMdl($busqueda, $tablaServicios, $tablaUsuarios)
    {
        $substringInicial = substr($busqueda, 1, 4);

        $sql = "SELECT a.id, a.vistas, a.titulo, a.pais, a.estado AS estadoID, a.municipio AS municipioID, a.direccion, a.usuario, .a.descripcion, a.estatus, a.img_principal, a.imagenes, a.categoria AS idCategoriaa, a.subcategoria AS idSubCategoria, b.nombre, b.correo, b.telefono, c.estado, d.municipio, e.id AS idCategoria, e.nombre_categoria AS categoria, e.palabras_clave, f.id AS idSubcategoria, f.nombre_subcategoria, f.palabras_clave_sub AS subcategoria 
        FROM $tablaServicios AS a 
        INNER JOIN $tablaUsuarios AS b ON b.usuario = a.usuario 
        INNER JOIN estados AS c ON c.id = a.estado 
        INNER JOIN municipios AS d ON a.municipio = d.id 
        INNER JOIN categorias AS e ON e.id = a.categoria 
        INNER JOIN subcategorias AS f ON f.categoria_id = e.id 
        WHERE estatus = '1' AND titulo LIKE '%$busqueda%' 
        OR (nombre_categoria LIKE '%$busqueda%' AND estatus = '1') 
        OR (palabras_clave LIKE '%$busqueda%' AND estatus = '1')
        OR (palabras_clave_sub LIKE '%$busqueda%' AND estatus = '1')
        OR (nombre_subcategoria LIKE '%$busqueda%' AND estatus = '1') 
        OR (descripcion LIKE '%$busqueda%' AND estatus = '1')";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function contarServiciosDisponiblesMdl($tabla)
    {
        $sql = "SELECT count(id) as id FROM $tabla WHERE estatus = '1'";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta[0]['id'];
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function traerServiciosSanviteMdl($condicion, $tabla)
    {
        $sql = "SELECT * FROM $tabla $condicion";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function enviarContactoMdl($nombre, $telefono, $correo)
    {
        $from = $correo;
        $to = 'contacto@buscaoh.com';
        $subject =  'Contacto Pagina Web BuscaOH';
        $message = 'Buen dia, mi nombre es ' . $nombre . ', y mi correo es' . $correo . ' ademas mi telefono es: ' . $telefono . ' espero se comuniquen conmigo, gracias';
        $headers = 'From:' . $from;
        mail($to, $subject, $message, $headers);
    }

    public static function traerTestimoniosMdl($tabla, $id)
    {
        $sql = "SELECT comentario, usuario, calificacion, servicio_id FROM $tabla WHERE servicio_id = '$id'";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function traerCategoriasMdl($tabla, $nombre, $id)
    {
        if ($nombre != 'todos') {
            $sql = "SELECT * FROM $tabla WHERE nombre_categoria = '$nombre'";
        } else if ($nombre == 'todos' && $id != 'todos') {
            $sql = "SELECT * FROM $tabla WHERE id = '$id'";
        } else {
            $sql = "SELECT * FROM $tabla";
        }

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function nuevaCategoriaMdl($nombreCategoria, $ruta_db, $textos, $tabla)
    {
        $sql = "INSERT INTO $tabla (nombre_categoria, img, palabras_clave) VALUES (\"$nombreCategoria\", \"$ruta_db\", \"$textos\")";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            echo 'success';
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function enviarTestimonioMdl($estrellas, $comentario, $idServicio, $usuario, $fecha, $tabla)
    {
        $sql = "INSERT INTO $tabla 
        (
            usuario, 
            servicio_id,
            calificacion,
            comentario,
            fecha

        ) VALUES (
            \"$usuario\", 
            \"$idServicio\",
            \"$estrellas\",
            \"$comentario\",
            \"$fecha\"
        
        )";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            echo 'guardado';
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function nuevaSubCategoriaMdl($nombreSubCategoria, $id, $textos, $tabla)
    {
        $sql = "INSERT INTO $tabla (nombre_subcategoria, categoria_id, palabras_clave_sub) VALUES (\"$nombreSubCategoria\", \"$id\", \"$textos\")";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            echo 'success';
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function enviarContraseñaCorreoMdl($correo, $tabla)
    {
        $sql = "SELECT nombre, usuario, correo, contraseña FROM $tabla WHERE correo = '$correo'";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $correoDB = $respuesta[0]['correo'];
            $usuario = $respuesta[0]['usuario'];
            $nombre = $respuesta[0]['nombre'];
            $contraseña = $respuesta[0]['contraseña'];

            if ($correoDB != '' || $correoDB != null) {
                $from = 'contacto@buscaoh.com';
                $to = $correoDB;
                $subject =  'Contraseña Pagina Web Busca OH';
                $message = "Buen dia $nombre, <br><br> Tus datos para iniciar sesión son los siguientes: <br><br> 
                            Usuario: $usuario <br>
                            Contraseña: $contraseña";
                $headers = 'From:' . $from . "\n";
                $headers .= "Content-type: text/html;  charset=utf-8";
                mail($to, $subject, $message, $headers);

                return 'enviado';
            } else {
                return 'no';
            }
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function eliminarMdl($id, $tabla)
    {
        $sql = "DELETE FROM $tabla WHERE id = '$id'";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            echo 'SCategoria--';
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function guardarVisualizacionMdl($id, $tabla)
    {
        $sql = "UPDATE $tabla SET vistas = vistas + 1 WHERE id = '$id'";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function ultimoIdMdl($tabla)
    {
        $sql = "SELECT MAX(id) AS id FROM $tabla";

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function traerSubCategoriasMdl($tabla, $id, $nombre, $idsub)
    {
        if ($nombre != 'todos' && $id != 'todos') {
            $sql = "SELECT * FROM $tabla WHERE nombre_subcategoria = '$nombre' AND categoria_id = '$id'";
            //
        } else if ($nombre != 'todos' && $id == 'todos') {
            $sql = "SELECT * FROM $tabla WHERE nombre_subcategoria = '$nombre'";
            //
        } else if ($nombre == 'todos' && $id != 'todos') {
            $sql = "SELECT * FROM $tabla WHERE categoria_id = '$id'";
            //
        } else if ($nombre == 'todos' && $id == 'todos' && $idsub != 'todos') {
            $sql = "SELECT * FROM $tabla WHERE id = '$idsub'";
            //
        } else {
            $sql = "SELECT * FROM $tabla";
        }

        //echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function traerServiciosMdl($tablaServicios, $tablaUsuarios, $condicion)
    {
        $sql = "SELECT 
        a.id, 
        a.vistas, 
        a.titulo, 
        a.pais, 
        a.estado AS estadoID, 
        a.municipio AS municipioID, 
        a.direccion, 
        a.usuario, 
        a.descripcion, 
        a.estatus, 
        a.recomendado, 
        a.img_principal, 
        a.imagenes, 
        a.categoria AS idCategoria, 
        a.subcategoria AS idSubcategoria, 
        a.facebook, 
        a.whatsapp, 
        a.longitud, 
        a.latitud, 
        b.nombre, 
        b.correo, 
        b.telefono, 
        c.estado, 
        d.municipio, 
        e.id AS idCategoriaTabla, 
        e.nombre_categoria AS categoria, 
        f.id AS idSubcategoriaTabla, 
        f.nombre_subcategoria AS subcategoria 
        FROM $tablaServicios AS a 
        INNER JOIN $tablaUsuarios AS b ON b.usuario = a.usuario 
        INNER JOIN estados AS c ON c.id = a.estado 
        INNER JOIN municipios AS d ON a.municipio = d.id 
        INNER JOIN categorias AS e ON e.id = a.categoria 
        INNER JOIN subcategorias AS f ON f.id = a.subcategoria 
        $condicion";

        //echo $sql."\n";
        //echo '<br>';
        //echo $condicion;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public function eliminarImagenMdl($id, $tabla)
    {
        $sql = "SELECT ruta FROM $tabla WHERE id = '$id'";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $ruta_img = $respuesta[0]['ruta'];

            unlink("../$ruta_img");

            $sql2 = "DELETE FROM $tabla WHERE id = '$id'";

            $stmt2 = conexion::conectar()->prepare($sql2);

            if ($stmt2->execute()) {
                return 'eliminado';
            } else {
                return
                    $stmt2->errorInfo();
            }

            $stmt2->closeCursor();
            $stmt2 = null;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public function traerImagenesMdl($id, $tabla)
    {
        $sql = "SELECT * FROM $tabla WHERE servicio_id = '$id'";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public function traerServiciosRecomendadosMdl($tablaServicios)
    {

        $sql = "SELECT 
        a.id, 
        a.vistas, 
        a.titulo, 
        a.pais, 
        a.estado AS estadoID, 
        a.municipio AS municipioID, 
        a.direccion, 
        a.usuario, 
        a.descripcion, 
        a.estatus, 
        a.recomendado, 
        a.img_principal, 
        a.imagenes, 
        a.categoria AS idCategoria, 
        a.subcategoria AS idSubcategoria, 
        a.facebook, 
        a.whatsapp, 
        a.longitud, 
        a.latitud, 
        b.nombre, 
        b.correo, 
        b.telefono, 
        c.estado, 
        d.municipio, 
        e.id AS idCategoriaTabla, 
        e.nombre_categoria AS categoria, 
        f.id AS idSubcategoriaTabla, 
        f.nombre_subcategoria AS subcategoria 
        FROM $tablaServicios AS a 
        INNER JOIN usuarios AS b ON b.usuario = a.usuario 
        INNER JOIN estados AS c ON c.id = a.estado 
        INNER JOIN municipios AS d ON a.municipio = d.id 
        INNER JOIN categorias AS e ON e.id = a.categoria 
        INNER JOIN subcategorias AS f ON f.id = a.subcategoria  WHERE recomendado = '1' AND estatus = '1'";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function publicarServicioMdl($tabla, $estatus, $id)
    {
        $sql = "UPDATE $tabla set estatus = '$estatus' WHERE id = '$id'";
        $verificacion = "SELECT estatus FROM $tabla WHERE id = '$id'";

        //echo $sql."\n";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $verificacionQuery = conexion::conectar()->prepare($verificacion);

            if ($verificacionQuery->execute()) {

                $respuesta = $verificacionQuery->fetch(PDO::FETCH_ASSOC);
                //($respuesta);
                return $respuesta['estatus'];
            } else {
                return
                    $verificacionQuery->errorInfo();
            }

            $verificacionQuery = null;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function recomendarServicioMdl($tabla, $estatus, $id)
    {
        $sql = "UPDATE $tabla set recomendado = '$estatus' WHERE id = '$id'";
        $verificacion = "SELECT recomendado FROM $tabla WHERE id = '$id'";

        //echo $sql."\n";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $verificacionQuery = conexion::conectar()->prepare($verificacion);

            if ($verificacionQuery->execute()) {

                $respuesta = $verificacionQuery->fetch(PDO::FETCH_ASSOC);
                //($respuesta);
                return $respuesta['recomendado'];
            } else {
                return
                    $verificacionQuery->errorInfo();
            }

            $verificacionQuery = null;
        } else {
            return
                $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }


    public static function insertarServicioMdl($nombre, $pais, $estado, $municipio, $direccion, $latitud, $longitud, $descripcion, $tabla, $usuario, $img_principal, $categoria, $subcategoria, $facebook, $whatsapp)
    {
        echo "\n\n";
        $sql = "INSERT INTO $tabla (
            titulo, 
            pais, 
            estado, 
            municipio, 
            direccion, 
            latitud, 
            longitud, 
            descripcion,
            usuario,
            img_principal,
            categoria,
            subcategoria,
            facebook,
            whatsapp
            ) VALUES (
                \"$nombre\", 
                \"$pais\", 
                \"$estado\", 
                \"$municipio\", 
                \"$direccion\", 
                \"$latitud\", 
                \"$longitud\", 
                \"$descripcion\",
                \"$usuario\",
                \"$img_principal\",
                '$categoria',
                '$subcategoria',
                '$facebook',
                '$whatsapp'
            )";

        echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return 'success';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function subirImagenTablaMdl($id, $ruta_db, $descripcion, $tamaño_archivo, $tablaServicios)
    {
        echo "\n\n";
        $sql = "INSERT INTO $tablaServicios (
            servicio_id,
            ruta,
            descripcion,
            tamaño
            ) VALUES (
                \"$id\", 
                \"$ruta_db\", 
                \"$descripcion\",
                \"$tamaño_archivo\"
            )";

        echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            print_r($respuesta);

            return 'subidaDB';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function editarServicioMdl($id, $nombre, $pais, $estado, $municipio, $direccion, $descripcion, $categoria, $subcategoria, $facebook, $whatsapp, $latitud, $longitud, $tabla)
    {

        $sql = "UPDATE $tabla 
                    SET titulo = '$nombre', 
                        pais = '$pais',
                        estado = '$estado',
                        municipio = '$municipio',
                        direccion = '$direccion',
                        descripcion = '$descripcion',
                        latitud = '$latitud',
                        longitud = '$longitud',
                        facebook = '$facebook',
                        whatsapp = '$whatsapp',
                        categoria =  '$categoria',
                        subcategoria = '$subcategoria'
                    WHERE id = '$id'";

        echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return 'success';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }
}
