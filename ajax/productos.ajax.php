<?php
require_once('../controlador/sessionControlador.php');
require_once('../controlador/usuarioControlador.php');
require_once('../controlador/productosControlador.php');
require_once('../modelos/productos.php');
require_once('../modelos/usuario.php');
require_once('../modelos/conexion.php');

class ProductosAjax
{
    public function nuevoProductoAjax()
    {
        print_r($_POST);
        print_r($_FILES);
        echo "\n";
        echo "\n";
        $contador = $_POST['contador'];
        $incrementable = 1;
        $validar = 0;

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $stock = json_decode($_POST['tamaños'], true);
        $categoria = $_POST['categoria'];
        $subcategoria = $_POST['subcategoria'];
        
        echo "<br>";
        echo "<br>";
        print_r($stock);
        echo "<br>";
        echo "<br>";

        $sesion = new Sesiones();
        $nombreUsuario = $sesion->getSesion('usuario');

        $ultimoId = ControladorProductos::UltimoIdCtr();
        $id = intval($ultimoId['id']);

        echo $id;

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
            $carpeta = "Productos" ;
            $ruta_interna = "/" . $carpeta. "/" . $id . "/" . $nombre . "/";
            $ruta = $raiz . $ruta_interna;
            //
            $tipoArch = explode('/', $tipo_archivo);
            $tipoArchivo = $tipoArch[1];
            $nombreArchivo = $incrementable . '.';
            //
            $ruta_final = $ruta . $nombreArchivo . $tipoArchivo;
            $ruta_db = $ruta_interna . $nombreArchivo . $tipoArchivo;
            echo $ruta_final . " | \n";

            if (!file_exists($ruta)) {
                mkdir($ruta, 0777, true);
            }

            if ($cargarImagen == 'true') {

                if (move_uploaded_file($archivo['tmp_name'], "$ruta_final")) {
                    echo 'Se insertó: ' . $incrementable . " | ";
                    $validar++;

                    $descripImg = $_POST['descripcion'.$incrementable];

                    echo $descripImg;

                    $respuestaImagen = ControladorProductos::subirImagenTablaCtr($id, $ruta_db, $descripImg, $tamaño_archivo);                    

                } else {
                    echo "No se subió: " . $incrementable;
                }
            } else {
                echo $msg;
            }

            $incrementable++;
        }

        if ($validar == $contador) {

            $respuesta = ControladorProductos::ctrNuevoProducto($nombre, $descripcion, $categoria, $subcategoria, $stock);

            print_r($respuesta);
        }
    }
    public function subirImagenAjax()
    {
        print_r($_POST);
        print_r($_FILES);
        echo "\n";
        echo "\n";
        $validar = 0;

        $descripImg = $_POST['descripcionProducto'];

        $id = $_POST['idProducto'];

        $producto = ControladorProductos::traerProductosCtr(0, 1000, $id);
        $producto = $producto[0];

        echo '<br>|<br>';
        print_r($producto);
        echo '<br>|<br>';

        $nombreUsuario = $producto['usuario'];
        $nombreProducto = $producto['titulo'];
        
        $incrementable = 'subida'.rand(0, 200);

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
            $carpeta = "/" . "Subidas" . "/";
            $ruta_interna = $carpeta . $nombreUsuario . "/" . $nombreProducto . "/";
            $ruta = $raiz . $ruta_interna;
            $tipoArch = explode('/', $tipo_archivo);
            $tipoArchivo = $tipoArch[1];
            $nombreArchivo = $incrementable . '.';
            $ruta_final = $ruta . $nombreArchivo . $tipoArchivo;
            $ruta_db = $ruta_interna . $nombreArchivo . $tipoArchivo;
            echo $ruta_final . " | \n";

            if (!file_exists($ruta)) {
                mkdir($ruta, 0777, true);
            }

            if ($cargarImagen == 'true') {

                if (move_uploaded_file($archivo['tmp_name'], "$ruta_final")) {
                    echo 'Se insertó: ' . $incrementable . " | ";
                    $validar++;

                    $respuestaImagen = ControladorProductos::subirImagenTablaCtr($id, $ruta_db, $descripImg, $tamaño_archivo);

                    if($respuestaImagen == 'subidaDB'){
                        return 'success';
                    }

                } else {
                    echo "No se subió: " . $incrementable;
                }
            } else {
                echo $msg;
            }
        }

    }

    public function traerProductoEditarAjax(){
        $id = $_POST['traerProductoEditar'];

        $respuesta = ControladorProductos::traerProductosCtr(0 , 2, $id);

        echo json_encode($respuesta);
    }

    
    public function traerImagenesAjax()
    {
        $id = $_POST['traerImagenes'];

        $respuesta = ControladorProductos::traerImagenesCtr($id);

        $respuesta = json_encode($respuesta);

        print_r($respuesta);
    }

    public function editarProductoAjax()
    {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
        $subcategoria = $_POST['subcategoria'];
        $id = $_POST['editarProducto'];

        $respuesta = ControladorProductos::editarProductoCtr($nombre, $descripcion, $categoria, $subcategoria, $id);

        print_r($respuesta);
    }

    public function publicarProductoAjax()
    {
        $estatus = $_POST['publicarProducto'];
        $id = $_POST['id'];

        if ($estatus == '1') {
            $publicar = 0;
        } else if ($estatus == '0') {
            $publicar = 1;
        } else {
            echo 'error';
        }

        $respuesta = ControladorProductos::publicarProductoCtr($publicar, $id);

        print_r($respuesta);
    }

    public function recomendarProductoAjax()
    {
        $estatus = $_POST['recomendarProducto'];
        $id = $_POST['id'];

        if ($estatus == '1') {
            $publicar = 0;
        } else if ($estatus == '0') {
            $publicar = 1;
        } else {
            echo 'error';
        }

        $respuesta = ControladorProductos::recomendarProductoCtr($publicar, $id);

        print_r($respuesta);
    }

    public function nuevoTamañoAjax()
    {
        $tamaño = $_POST['tamaño'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $descuento = $_POST['descuento'];
        $producto = $_POST['producto'];

        $respuesta = ControladorProductos::nuevoTamañoCtr($tamaño, $precio, $cantidad, $descuento, $producto);

        print_r($respuesta);
    }

    public function eliminarTamañoAjax()
    {
        $tamaño_id = $_POST['eliminarTamaño'];

        $respuesta = ControladorProductos::eliminarTamañoCtr($tamaño_id);

        print_r($respuesta);
    }

    public function eliminarProductoAjax()
    {
        $id = $_POST['eliminarProducto'];

        $respuesta = ControladorProductos::eliminarProductoCtr($id);

        print_r($respuesta);
    }

    public function traerTamañosAjax()
    {
        $id = $_POST['traerTamañosTabla'];
        $respuesta = ControladorProductos::traerTamañosCtr($id);


        echo '
        <div class="row header degradadomanetener">
            <div class="cell">
                Tamaño
            </div>
            <div class="cell">
                Producto
            </div>
            <div class="cell">
                Precio
            </div>
            <div class="cell">
                Descuento
            </div>
            <div class="cell">
                Opciones
            </div>
        </div>
        ';

        foreach ($respuesta as $tamaño) {

            if($tamaño['descuento'] == ''){
                $tamaño['descuento'] = 0;
            }

            echo '
            <div class="row">
                <div class="cell texto-ellipsis nombre" data-title="Nombre tamaño">
                    ' . $tamaño['tamaño'] . '
                </div>

                <div class="cell texto-ellipsis nombre" data-title="Nombre producto">
                    ' . $tamaño['titulo'] . '
                </div>

                <div class="cell texto-ellipsis nombre" data-title="Precio producto">
                    ' . $tamaño['precio'] . '
                </div>

                <div class="cell texto-ellipsis nombre" data-title="Descuento">
                    ' . $tamaño['descuento'] . '
                </div>

                <div class="cell">
                    
                    <button onclick="eliminarTamaño(' . "'" . $tamaño['id'] . "'" . ')" class="btn btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                   
                </div>
            </div>
            ';
        }
    }

    public function traerTamañosJSONAjax($id){

        $respuesta = ControladorProductos::traerTamañosCtr($id);

        echo json_encode($respuesta);
        return json_encode($respuesta);
    }
    


}

if (isset($_POST['nuevoProducto']) && $_POST["nuevoProducto"] != '') {
    $ajax = new ProductosAjax();
    $ajax->nuevoProductoAjax();
}

if (isset($_POST['eliminarProducto'])) {
    $ajax = new ProductosAjax();
    $ajax->eliminarProductoAjax();
}

if (isset($_POST['traerProductoEditar'])) {
    $ajax = new ProductosAjax();
    $ajax->traerProductoEditarAjax();
}

if (isset($_POST['traerTamañosJSON'])) {
    $ajax = new ProductosAjax();
    $id = $_POST['traerTamañosJSON'];
    $ajax->traerTamañosJSONAjax($id);
}

if (isset($_POST['traerTamañosTabla'])) {
    $ajax = new ProductosAjax();
    $ajax->traerTamañosAjax();
}

if (isset($_POST['traerImagenes'])) {
    $ajax = new ProductosAjax();
    $ajax->traerImagenesAjax();
}

if (isset($_POST['subirIMG'])) {
    $ajax = new ProductosAjax();
    $ajax->subirImagenAjax();
}

if (isset($_POST['eliminarTamaño'])) {
    $ajax = new ProductosAjax();
    $ajax->eliminarTamañoAjax();
}

if (isset($_POST['nuevoTamaño'])) {
    $ajax = new ProductosAjax();
    $ajax->nuevoTamañoAjax();
}

if (isset($_POST['publicarProducto'])) {
    $ajax = new ProductosAjax();
    $ajax->publicarProductoAjax();
}

if (isset($_POST['recomendarProducto'])) {
    $ajax = new ProductosAjax();
    $ajax->recomendarProductoAjax();
}

if (isset($_POST['editarProducto'])) {
    $ajax = new ProductosAjax();
    $ajax->editarProductoAjax();
}
