<?php

class modelo_productos
{

    public function obtenerIP()
    {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        return $_SERVER['REMOTE_ADDR'];
    }

    public static function nuevoProductoMdl($nombre, $descripcion, $categoria, $subcategoria, $stock, $tabla, $destacado = 0, $activo = 0)
    {
        echo "\n\n";
        $sql = "INSERT INTO $tabla (
            titulo, 
            descripcion, 
            destacado, 
            categoria, 
            subcategoria, 
            activo
            ) VALUES (
                \"$nombre\", 
                \"$descripcion\", 
                \"$destacado\",
                \"$categoria\", 
                \"$subcategoria\", 
                \"$activo\"
            )";

        echo $sql;

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $tamaños = modelo_productos::insertarTamañosMdl($stock, $nombre, $descripcion);
            print_r($tamaños);
            return 'succesds';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    public static function insertarTamañosMdl($stock, $titulo, $descripcion, $tabla = 'tamaños')
    {
        $sql2 = "SELECT id FROM productos WHERE titulo = '$titulo' AND descripcion = '$descripcion' ORDER BY id DESC";

        $stmt2 = conexion::conectar()->prepare($sql2);

        if ($stmt2->execute()) {
            $id = $stmt2->fetch(PDO::FETCH_ASSOC);
            $id = $id['id'];

            foreach($stock as $tamaños){
                $tamaño = $tamaños['tamaño'];
                $cantidad = $tamaños['cantidad'];
                $precio = $tamaños['precio'];
                $descuento = $tamaños['descuento'];

                $sql = "INSERT INTO $tabla (
                    tamaño, 
                    id_producto, 
                    cantidad,
                    precio,
                    descuento
                    ) VALUES (
                        \"$tamaño\", 
                        \"$id\",
                        \"$cantidad\",
                        \"$precio\",
                        \"$descuento\"
                    )";
                
                    $stmt = conexion::conectar()->prepare($sql);
        
                    if ($stmt->execute()) {
                        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        return $stmt->errorInfo();
                    }
        
                    $stmt->closeCursor();
                    $stmt = null;
            }

        } else {
            return $stmt2->errorInfo();
        }

        $stmt2->closeCursor();
        $stmt2 = null;
    }

    public static function contarProductosDisponiblesMdl($tabla)
    {
        $sql = "SELECT count(id) as id FROM $tabla WHERE activo = '1'";

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

    public static function traerImagenesMdl($id, $tabla)
    {
        $sql = "SELECT * FROM $tabla WHERE producto_id = '$id'";

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

    public static function traerProductosMdl($tablaProductos, $tablaUsuarios, $condicion)
    {
        $sql = "SELECT 
        a.id, 
        a.titulo, 
        a.descripcion, 
        a.destacado, 
        a.activo, 
        a.vistas, 
        a.categoria AS idCategoria, 
        a.subcategoria AS idSubcategoria, 
        b.id AS idCategoriaTabla, 
        b.nombre_categoria AS categoria, 
        c.id AS idSubcategoriaTabla, 
        c.nombre_subcategoria AS subcategoria 
        FROM $tablaProductos AS a 
        INNER JOIN categorias AS b ON b.id = a.categoria 
        INNER JOIN subcategorias AS c ON c.id = a.subcategoria 
        $condicion";

        //echo $sql;
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


    public static function traerProductosBusquedaMdl($busqueda, $tablaProductos, $tablaUsuarios)
    {
        $substringInicial = substr($busqueda, 1, 4);

        $sql = "SELECT 
        a.id, 
        a.titulo, 
        a.descripcion, 
        a.destacado, 
        a.activo, 
        a.vistas, 
        a.categoria AS idCategoria, 
        a.subcategoria AS idSubcategoria, 
        b.id AS idCategoriaTabla, 
        b.nombre_categoria AS categoria, 
        c.id AS idSubcategoriaTabla, 
        c.nombre_subcategoria AS subcategoria 
        FROM $tablaProductos AS a 
        INNER JOIN categorias AS b ON b.id = a.categoria 
        INNER JOIN subcategorias AS c ON c.id = a.subcategoria 
        WHERE activo = '1' AND titulo LIKE '%$busqueda%' 
        OR (nombre_categoria LIKE '%$busqueda%' AND activo = '1') 
        OR (palabras_clave LIKE '%$busqueda%' AND activo = '1')
        OR (palabras_clave_sub LIKE '%$busqueda%' AND activo = '1')
        OR (nombre_subcategoria LIKE '%$busqueda%' AND activo = '1') 
        OR (descripcion LIKE '%$busqueda%' AND activo = '1')";

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

    public function traerProductosDestacadosMdl($tablaProductos)
    {
        $sql = "SELECT 
        a.id, 
        a.titulo, 
        a.descripcion, 
        a.destacado, 
        a.activo, 
        a.vistas, 
        a.categoria AS idCategoria, 
        a.subcategoria AS idSubcategoria, 
        b.id AS idCategoriaTabla, 
        b.nombre_categoria AS categoria, 
        c.id AS idSubcategoriaTabla, 
        c.nombre_subcategoria AS subcategoria 
        FROM $tablaProductos AS a 
        INNER JOIN categorias AS b ON b.id = a.categoria 
        INNER JOIN subcategorias AS c ON c.id = a.subcategoria 
        WHERE activo = '1' AND destacado = '1'";

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

    public static function publicarProductoMdl($tabla, $activo, $id)
    {
        $sql = "UPDATE $tabla set activo = '$activo' WHERE id = '$id'";
        $verificacion = "SELECT activo FROM $tabla WHERE id = '$id'";

        //echo $sql."\n";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $verificacionQuery = conexion::conectar()->prepare($verificacion);

            if ($verificacionQuery->execute()) {

                $respuesta = $verificacionQuery->fetch(PDO::FETCH_ASSOC);
                //print_r($respuesta);
                return $respuesta['activo'];
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

    
    public static function editarProductoMdl($nombre, $descripcion, $categoria, $subcategoria, $id, $tablaProductos)
    {

        $sql = "UPDATE $tablaProductos 
                    SET titulo = '$nombre', 
                        descripcion = '$descripcion',
                        categoria = '$categoria',
                        subcategoria = '$subcategoria'
                    WHERE id = '$id'";

        //echo $sql;

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

    public static function recomendarProductoMdl($tabla, $activo, $id)
    {
        $sql = "UPDATE $tabla set destacado = '$activo' WHERE id = '$id'";
        $verificacion = "SELECT destacado FROM $tabla WHERE id = '$id'";

        //echo $sql."\n";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {

            $verificacionQuery = conexion::conectar()->prepare($verificacion);

            if ($verificacionQuery->execute()) {

                $respuesta = $verificacionQuery->fetch(PDO::FETCH_ASSOC);
                //($respuesta);
                return $respuesta['destacado'];
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
    
    public static function traerTamañoMdl($tabla, $condicion)
    {
        $sql = "SELECT a.id, a.tamaño, a.id_producto, a.cantidad, a.precio, a.descuento, 
                b.id AS idProducto, b.titulo, b.descripcion, b.destacado, b.categoria, b.subcategoria, b.activo, b.vistas 
                FROM $tabla AS a INNER JOIN productos AS b ON b.id = a.id_producto $condicion";

        //echo $sql."\n";

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

    public static function traerMdl($tabla, $condicion = '')
    {
        $sql = "SELECT * FROM $tabla $condicion";

        //echo $sql."\n";

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

    public static function nuevoTamañoMdl($tabla, $tamaño, $precio, $cantidad, $descuento, $producto)
    {
        $sql = "INSERT INTO $tabla (tamaño, precio, cantidad, descuento, id_producto) VALUES ('$tamaño', '$precio', '$cantidad', '$descuento', '$producto')";

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

    public static function eliminarMdl($tabla, $id)
    {
        $sql = "DELETE FROM $tabla WHERE id = '$id'";

        if($tabla == 'productos'){
            $dir = "Productos/$id";
            echo $dir;
            modelo_productos::eliminarCarpetaMdl($dir);
            $sql2 = "DELETE FROM tamaños WHERE id_producto = '$id'";
            $stmt2 = conexion::conectar()->query($sql2);
            $stmt2->closeCursor();
            $stmt2 = null;
        }

        //echo $sql . "\n";

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

    public static function eliminarCarpetaMdl($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
         foreach ($files as $file) {
           (is_dir("$dir/$file")) ? modelo_productos::eliminarCarpetaMdl("$dir/$file") : unlink("$dir/$file");
         }
         return rmdir($dir);
       } 

    public static function obtenerUltimoIdMdl($tabla)
    {

        $sql = "SELECT AUTO_INCREMENT AS id
        FROM information_schema.TABLES
        WHERE TABLE_SCHEMA = 'u370560786_sanvite'
        AND TABLE_NAME = '$tabla'";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return $respuesta;
        } else {
            return $stmt->errorInfo();
        }

        $stmt = null;
    }

    public static function subirImagenTablaMdl($id, $ruta_db, $descripcion, $tamaño_archivo, $tablaProductos)
    {
        $sql = "INSERT INTO $tablaProductos (
            producto_id,
            ruta,
            descripcion,
            tamaño
            ) VALUES (
                \"$id\", 
                \"$ruta_db\", 
                \"$descripcion\",
                \"$tamaño_archivo\"
            )";

        $stmt = conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return 'subidaDB';
        } else {
            return $stmt->errorInfo();
        }

        $stmt->closeCursor();
        $stmt = null;
    }
}
