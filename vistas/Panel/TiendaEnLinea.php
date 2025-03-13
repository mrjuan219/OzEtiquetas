<link rel="stylesheet" href="css/tabla.panel.css">

<div id="contenedor_perfil_panel" class="container" style="font-size: 1.6rem; max-width: 1200px; ">
    <div class="view-account">
        <section class="module p-5">
            <div class="module-inner">

                <?php
                include "barra-lateral.php";
                ?>

                <div class="content-panel">
                    <h2 class="title">
                        Productos
                    </h2>
                    <form class="form-horizontal">
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Agregar nuevo producto o administrar categorias / subcategorias</h3>
                            <div class="form-group">
                                <div class="col-md-12 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0 text-center columna_centrada">
                                    <input onclick="modalRegistroProducto()" class="btn btn-primary degradadomanetener" type="button" value="Nuevo Producto" style="padding: 5px 25px">
                                    
                                    <input onclick="modalCategorias()" class="btn btn-primary degradadomanetener" type="button" value="Administrar Categorias" style="padding: 5px 25px">
                                  
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <br>
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Productos existentes</h3>

                            <div class="limiter contenedor_tabla" id="tablaGestion">
                                <div class="container-table100">
                                    <div class="wrap-table100">
                                        <div class="table">
                                            <div class="row header degradadomanetener">
                                                <div class="cell">
                                                    Nombre
                                                </div>
                                                <div class="cell">
                                                    Vistas
                                                </div>
                                                <div class="cell">
                                                    Precio
                                                </div>
                                                <div class="cell">
                                                    Cantidad
                                                </div>
                                                <div class="cell">
                                                    Estatus
                                                </div>
                                                <div class="cell">
                                                    Opciones
                                                </div>
                                            </div>

                                            <?php
                                            $productos = ControladorProductos::traerProductosCtr();
                                            //print('<pre>'.print_r($productos, true).'</pre>');
                                            
                                            foreach ($productos as $producto) {

                                                if ($producto['vistas'] == '') {
                                                    $producto['vistas'] = 0;
                                                }
                                                if ($producto['activo'] == '0') {
                                                    $estatusTexto = 'No publicado';
                                                    $color = 'danger';
                                                } else {
                                                    $estatusTexto = 'Publicado';
                                                    $color = 'success';
                                                }
                                                if ($producto['destacado'] == '0') {
                                                    $destacadoTexto = '<i class="fa fa-times" aria-hidden="true"></i>';
                                                    $destacadoColor = 'danger';
                                                } else {
                                                    $destacadoTexto = '<i class="fa fa-star" aria-hidden="true"></i>';
                                                    $destacadoColor = 'success';
                                                }

                                                $tamaños = ControladorProductos::traerTamañosCtr($producto['id']);

                                                $cantidad = 0;
                                                foreach($tamaños as $tamaño){
                                                    $cantidad = $tamaño['cantidad'] + $cantidad;
                                                }

                                                $primer_tamaño = reset($tamaños);
                                                $ultimo_tamaño = end($tamaños);

                                                if($primer_tamaño['precio'] === $ultimo_tamaño['precio']){
                                                    $precio = "$".$primer_tamaño['precio'];
                                                }else{
                                                    $precio = "$".$primer_tamaño['precio'] . " - $" . $ultimo_tamaño['precio'];
                                                }

                                                echo '
                        <div class="row">

                        <div class="cell texto-ellipsis" data-title="Titulo del producto">
                        ' . $producto['titulo'] . '
                        </div>
                        <div class="cell" data-title="Vistas">
                            ' . $producto['vistas'] . '
                        </div>
                        <div class="cell" data-title="Precio">
                            ' . $precio . '
                        </div>
                        <div class="cell" data-title="Cantidad almacen">
                            ' . $cantidad . '
                        </div>
                            
                            <div class="cell">
                                <button id="botonPublicar' . $producto['id'] . '" onclick="publicarProducto(' . $producto['activo'] . ', ' . $producto['id'] . ', event)" class="btn btn-' . $color . '">
                                    ' . $estatusTexto . '
                                </button>
                                <button id="botonRecomendado' . $producto['id'] . '" onclick="recomendarProducto(' . $producto['destacado'] . ', ' . $producto['id'] . ', event)" class="btn btn-' . $destacadoColor . '">
                                    ' . $destacadoTexto . '
                                </button>
                            </div>
                            <div class="cell">
                                <div onclick="editarProducto(' . "'" . $producto['id'] . "'" . ')" class="btn btn-primary">
                                    <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                                </div>
                                <div onclick="eliminarProducto(' . "'" . $producto['id'] . "'" . ')" class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </div>
                                <div onclick="window.location.search=' . "'" . "?ruta=Articulo&id=" . $producto['id'] . "'" . '" class="btn btn-info">
                                    <i class="fa fa-eye" aria-hidden="true"></i>  
                                </div>
                            </div>
                        </div>
                        ';
                                            }
                                            ?>

                                        </div>
                                        <?php
                                        if(empty($productos)){
                                            echo '
                                            <div class="alert alert-info text-center">
                                                No hay productos registrados aún
                                            </div>
                                            ';
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>

                            <script>
                                (function($) {
                                    "use strict";
                                })(jQuery);
                            </script>
                        </fieldset>
                        <hr>
                        <div class="form-group">
                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                <input class="btn btn-primary" type="button" value="Regresar al inicio">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>