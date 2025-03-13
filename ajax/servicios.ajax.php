<?php
//session_start();

require_once('../controlador/sessionControlador.php');
require_once('../controlador/usuarioControlador.php');
require_once('../controlador/serviciosControlador.php');
require_once('../modelos/servicios.php');
require_once('../modelos/usuario.php');
require_once('../modelos/conexion.php');

class UsuarioAjax
{
    public function registroServicioAjax()
    {
        print_r($_POST);
        print_r($_FILES);
        echo "\n";
        echo "\n";
        $contador = $_POST['contador'];
        $incrementable = 1;
        $validar = 0;
        $nombreServicio = $_POST['nombre'];
        $pais = $_POST['pais'];
        $estado = $_POST['estado'];
        $municipio = $_POST['municipio'];
        $direccion = $_POST['direccion'];
        $latitud = $_POST['latitud'];
        $longitud = $_POST['longitud'];
        $descripcion = $_POST['descripcionServicio'];
        $categoria = $_POST['categoria'];
        $subcategoria = $_POST['subcategoria'];
        $facebook = $_POST['facebook'];
        $whatsapp = $_POST['whatsapp'];

        $sesion = new Sesiones();
        $nombreUsuario = $sesion->getSesion('usuario');

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
            $ruta_interna = $carpeta . $nombreUsuario . "/" . $nombreServicio . "/";
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

                    if ($archivo === reset($_FILES)) {
                        $primerIMG = $ruta_db;
                    }

                    $ultimoId = ControladorServicios::ultimoIdCtr();
                    $id = intval($ultimoId['id']) + 1;

                    echo $id;

                    $descripImg = $_POST['descripcion'.$incrementable];

                    echo $descripImg;

                    $respuestaImagen = ControladorServicios::subirImagenTablaCtr($id, $ruta_db, $descripImg, $tamaño_archivo);

                    echo $respuestaImagen."\n\n";

                } else {
                    echo "No se subió: " . $incrementable;
                }
            } else {
                echo $msg;
            }

            $incrementable++;
        }

        if ($validar == $contador) {

            echo $descripcion."\n";

            $respuesta = ControladorServicios::insertarServicioCtr($nombreServicio, $pais, $estado, $municipio, $direccion, $latitud, $longitud, $descripcion, $nombreUsuario, $primerIMG, $categoria, $subcategoria, $facebook, $whatsapp);

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

        $descripImg = $_POST['descripcionServicio'];

        $id = $_POST['idServicio'];

        $servicio = ControladorServicios::traerServiciosCtr(0, 1000, $id);
        $servicio = $servicio[0];

        echo '<br>|<br>';
        print_r($servicio);
        echo '<br>|<br>';

        $nombreUsuario = $servicio['usuario'];
        $nombreServicio = $servicio['titulo'];
        
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
            $ruta_interna = $carpeta . $nombreUsuario . "/" . $nombreServicio . "/";
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

                    $respuestaImagen = ControladorServicios::subirImagenTablaCtr($id, $ruta_db, $descripImg, $tamaño_archivo);

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

    public function editarServicioAjax()
    {
        $id = $_POST['editarServicio'];
        $nombreServicio = $_POST['nombre'];
        $pais = $_POST['pais'];
        $estado = $_POST['estado'];
        $municipio = $_POST['municipio'];
        $direccion = $_POST['direccion'];
        $latitud = $_POST['latitud'];
        $longitud = $_POST['longitud'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
        $subcategoria = $_POST['subcategoria'];
        $facebook = $_POST['facebook'];
        $whatsapp = $_POST['whatsapp'];

        $respuesta = ControladorServicios::editarServicioCtr($id, $nombreServicio, $pais, $estado, $municipio, $direccion, $descripcion, $categoria, $subcategoria, $facebook, $whatsapp, $latitud, $longitud);

        print_r($respuesta);
    }

    public function traerPaisesAjax()
    {
        $respuesta = ControladorServicios::traerPaisesCtr();

        print_r($respuesta);
    }

    public function traerEstadosAjax()
    {
        $pais = $_POST['PaisEstados'];

        $respuesta = ControladorServicios::traerEstadosCtr($pais);

        echo $respuesta;
    }

    public function traerMunicipiosAjax()
    {
        $estado = $_POST['traerMunicipios'];

        $respuesta = ControladorServicios::traerMunicipiosCtr($estado);

        echo "
                <option selected disabled value=''>Selecciona un municipio</option>
                <option value=''>Todos los municipios</option>
            ";

        foreach ($respuesta as $municipio) {
            //print_r($municipio);
            $municipioID = $municipio['municipios_id'];
            $nombre = $municipio['municipio'];

            echo "
                <option nombre='.$nombre.' value='$municipioID'>$nombre</option>
            ";
        }
    }

    public function traerServicioAjax()
    {
        $respuesta = ControladorServicios::traerServiciosCtr(0, 1000, $_POST['traerServicio']);
        echo json_encode($respuesta, JSON_UNESCAPED_SLASHES);
    }

    public function traerServicioFiltroAjax()
    {
        $respuesta = ControladorServicios::traerServiciosFiltroCtr($_POST['pais'], $_POST['estado'], $_POST['s']);
        echo json_encode($respuesta, JSON_UNESCAPED_SLASHES);
    }

    public function publicarServicioAjax()
    {
        $estatus = $_POST['publicarServicio'];
        $id = $_POST['id'];

        if ($estatus == '1') {
            $publicar = 0;
        } else if ($estatus == '0') {
            $publicar = 1;
        } else {
            echo 'error';
        }

        $respuesta = ControladorServicios::publicarServicioCtr($publicar, $id);

        echo $respuesta;
    }

    public function recomendarServicioAjax()
    {
        $estatus = $_POST['recomendarServicio'];
        $id = $_POST['id'];

        if ($estatus == '1') {
            $publicar = 0;
        } else if ($estatus == '0') {
            $publicar = 1;
        } else {
            echo 'error';
        }

        $respuesta = ControladorServicios::recomendarServicioCtr($publicar, $id);

        echo $respuesta;
    }

    public function traerImagenesAjax()
    {
        $id = $_POST['traerImagenes'];

        $respuesta = ControladorServicios::traerImagenesCtr($id);

        $respuesta = json_encode($respuesta);

        print_r($respuesta);
    }

    public function eliminarImagenAjax()
    {
        $id = $_POST['eliminarImagen'];

        $respuesta = ControladorServicios::eliminarImagenCtr($id);

        print_r($respuesta);
    }

    public function traerCategoriasTablaAjax()
    {
        $categorias = ControladorServicios::traerCategoriasCtr();
        //print('<pre>'.print_r($servicios, true).'</pre>');

        echo '
        <div class="row header degradadomanetener">
            <div class="cell">
                Nombre
            </div>
            <div class="cell">
                Opciones
            </div>
        </div>
        ';

        foreach ($categorias as $categoria) {


            echo '
            <div class="row">
                <div class="cell texto-ellipsis nombre" data-title="Nombre Completo">
                    ' . $categoria['nombre_categoria'] . '
                    </div>

                <div class="cell">
                    
                    <button onclick="eliminarCategoria(' . "'" . $categoria['id'] . "'" . ')" class="btn btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                    <button onclick="window.location.search=' . "'" . "?ruta=Servicios&idCategoria=" . $categoria['id'] . "'" . '" class="btn btn-info">
                        <i class="fa fa-eye" aria-hidden="true"></i>  
                    </button>
                </div>
            </div>
            ';
        }
    }

    public function traerSubCategoriasAjax()
    {
        $id = $_POST['traerSubCategorias'];
        $subcategorias = ControladorServicios::traerSubCategoriasCtr($id);
        echo '
        <option selected disabled value="">Selecciona una opcion</option>
        ';
        foreach ($subcategorias as $subcategoria){
            echo '
            <option value="'.$subcategoria['id'].'">'.$subcategoria['nombre_subcategoria'].'</option>
            ';
        }
    }

    public function traerSubCategoriasTablaAjax()
    {
        $subcategorias = ControladorServicios::traerSubCategoriasCtr();
        //print('<pre>'.print_r($servicios, true).'</pre>');

        echo '
        <div class="row header degradadomanetener">
            <div class="cell">
                Nombre
            </div>
            <div class="cell">
                Opciones
            </div>
        </div>
        ';

        foreach ($subcategorias as $subcategoria) {
            echo '
        <div class="row">
            <div class="cell texto-ellipsis nombre" data-title="Nombre Completo">
                ' . $subcategoria['nombre_subcategoria'] . '
                </div>

            <div class="cell">
                
                <button onclick="eliminarSubCategoria(' . "'" . $subcategoria['id'] . "'" . ')" class="btn btn-danger">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
                <button onclick="window.location.search=' . "'" . "?ruta=Servicios&idSubCategoria=" . $subcategoria['id'] . "'" . '" class="btn btn-info">
                    <i class="fa fa-eye" aria-hidden="true"></i>  
                </button>
            </div>
        </div>
        ';
        }
    }

    public function contactarCorreo(){
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];

        $respuesta = ControladorServicios::enviarContactoCtr($nombre, $telefono, $correo);

        print_r($respuesta);
    }

    public function nuevaCategoriaAjax()
    {
        $nombreCategoria = $_POST['nombre'];
        $textos = $_POST['textos'];
        //Carga de imagenes
        $cargarImagen = 'true';
        $archivo = $_FILES['img_categoria'];
        $tamaño_archivo = $archivo['size'];
        $tipo_archivo = $archivo['type'];
        $validar = 0;

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
        $ruta_interna = $carpeta . 'Categorias' . "/" . $nombreCategoria . "/";
        $ruta = $raiz . $ruta_interna;
        $tipoArch = explode('/', $tipo_archivo);
        $tipoArchivo = $tipoArch[1];
        $nombreArchivo = $nombreCategoria . '.';
        $ruta_final = $ruta . $nombreArchivo . $tipoArchivo;
        $ruta_db = $ruta_interna . $nombreArchivo . $tipoArchivo;
        echo $ruta_final . " | \n";

        if (!file_exists($ruta)) {
            mkdir($ruta, 0777, true);
        }

        if ($cargarImagen == 'true') {

            if (move_uploaded_file($archivo['tmp_name'], "$ruta_final")) {
                echo 'Se insertó: ' . $nombreCategoria . " | ";
                $validar++;
            } else {
                echo "No se subió: " . $nombreCategoria;
            }
        } else {
            echo $msg;
        }


        if ($validar == 1) {
        }

        $respuesta = ControladorServicios::nuevaCategoriaCtr($nombreCategoria, $ruta_db, $textos);

        print_r($respuesta);
    }

    public function nuevaSubcategoriaAjax()
    {
        $nombre = $_POST['nombre'];
        $textos = $_POST['textos'];
        $id = $_POST['idCategoria'];

        $respuesta = ControladorServicios::nuevaSubCategoriaCtr($nombre, $id, $textos);

        print_r($respuesta);
    }

    public function enviarTestimonioAjax(){
        $estrellas = $_POST['estrellas'];
        $comentario = $_POST['comentario'];
        $idServicio = $_POST['idServicio'];
        $usuario = $_SESSION['usuario'];
        $fecha = date('Y-m-d H:i:s');

        $respuesta = ControladorServicios::enviarTestimonioCtr($estrellas, $comentario, $idServicio, $usuario, $fecha);

        print_r($respuesta);
    }

    public function eliminarCategoriaAjax()
    {
        $id = $_POST['eliminarCategoria'];

        $respuesta = ControladorServicios::eliminarCategoriaCtr($id);

        print_r($respuesta);
    }

    public function eliminarSubCategoriaAjax()
    {
        $id = $_POST['eliminarSubCategoria'];

        $respuesta = ControladorServicios::eliminarSubCategoriaCtr($id);

        echo $respuesta;
    }

    public function eliminarServicioAjax()
    {
        $id = $_POST['eliminarServicio'];

        $respuesta = ControladorServicios::eliminarServicioCtr($id);

        echo $respuesta;
    }

    public function enviarContraseñaCorreoAjax()
    {
        $correo = $_POST['correoRestablecer'];

        $respuesta = ControladorServicios::enviarContraseñaCorreoCtr($correo);

        echo $respuesta;
    }
}


if (isset($_POST['subirIMG'])) {
    $ajax = new UsuarioAjax();
    $ajax->subirImagenAjax();
}

if (isset($_POST['eliminarImagen'])) {
    $ajax = new UsuarioAjax();
    $ajax->eliminarImagenAjax();
}

if (isset($_POST['contactarForm'])) {
    $ajax = new UsuarioAjax();
    $ajax->contactarCorreo();
}

if (isset($_POST['traerImagenes'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerImagenesAjax();
}

if (isset($_POST['enviarTestimonio'])) {
    $ajax = new UsuarioAjax();
    $ajax->enviarTestimonioAjax();
}

if (isset($_POST['editarServicio'])) {
    $ajax = new UsuarioAjax();
    $ajax->editarServicioAjax();
}

if (isset($_POST['eliminarServicio'])) {
    $ajax = new UsuarioAjax();
    $ajax->eliminarServicioAjax();
}

if (isset($_POST['eliminarCategoria'])) {
    $ajax = new UsuarioAjax();
    $ajax->eliminarCategoriaAjax();
}

if (isset($_POST['eliminarSubCategoria'])) {
    $ajax = new UsuarioAjax();
    $ajax->eliminarSubCategoriaAjax();
}

if (isset($_POST['nuevaSubcategoria'])) {
    $ajax = new UsuarioAjax();
    $ajax->nuevaSubcategoriaAjax();
}

if (isset($_POST['nuevaCategoria'])) {
    $ajax = new UsuarioAjax();
    $ajax->nuevaCategoriaAjax();
}

if (isset($_POST['traerCategoriasTabla'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerCategoriasTablaAjax();
}

if (isset($_POST['traerSubCategoriasTabla'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerSubCategoriasTablaAjax();
}

if (isset($_POST['traerSubCategorias'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerSubCategoriasAjax();
}

if (isset($_POST['traerMunicipios'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerMunicipiosAjax();
}

if (isset($_POST['paisEstados'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerEstadosAjax();
}

if (isset($_POST['traerPaises'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerPaisesAjax();
}

if (isset($_POST['traerServicio'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerServicioAjax();
}

if (isset($_POST['traerServicioFiltro'])) {
    $ajax = new UsuarioAjax();
    $ajax->traerServicioFiltroAjax();
}

if (isset($_POST['publicarServicio'])) {
    $ajax = new UsuarioAjax();
    $ajax->publicarServicioAjax();
}

if (isset($_POST['recomendarServicio'])) {
    $ajax = new UsuarioAjax();
    $ajax->recomendarServicioAjax();
}

if (isset($_POST['correoRestablecer'])) {
    $ajax = new UsuarioAjax();
    $ajax->enviarContraseñaCorreoAjax();
}

if (isset($_POST['nuevoServicio'])) {
    $ajax = new UsuarioAjax();
    $ajax->registroServicioAjax();
}
