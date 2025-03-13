<link rel="stylesheet" href="css/tabla.panel.css">
<?php
//print_r($_SESSION);
?>
<br><br>
<div id="contenedor_perfil_panel" class="container" style="font-size: 1.6rem; max-width: 1200px; ">
    <div class="view-account">
        <section class="module p-5">
            <div class="module-inner">

                <?php
                include "barra-lateral.php";
                ?>

                <div class="content-panel">
                    <h2 class="title">
                        Pedidos
                    </h2>
                    <form class="form-horizontal">
                    <fieldset class="fieldset">
                            <h3 class="fieldset-title">Otras opciones</h3>
                            <div class="form-group">
                                <div class="col-md-12 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0 text-center columna_centrada">
                                    <input onclick="" class="btn btn-primary degradadomanetener" type="button" value="Ver pedidos completados" style="padding: 5px 25px">
                                                                        
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <br>
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Pedidos en curso</h3>

                            <div class="limiter contenedor_tabla" id="tablaGestion">
                                <div class="container-table100">
                                    <div class="wrap-table100">
                                        <div class="table">
                                            <div class="row header degradadomanetener">
                                                <div class="cell">
                                                    Usuario
                                                </div>
                                                <div class="cell">
                                                    Numero de pedido
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
                                            $pedidos = ControladorUsuario::traerPedidosCtr('todos');
                                            //print('<pre>'.print_r($pedidos, true).'</pre>');

                                            foreach ($pedidos as $pedido) {

                                                if ($pedido['entregado'] == '1') {
                                                    $estatusTexto = 'Entregado  <i class="fa fa-check" aria-hidden="true"></i>';
                                                    $color = 'success';
                                                    //
                                                } else if ($pedido['enviado'] == '1') {
                                                    $estatusTexto = 'Enviado  <i class="fa fa-truck" aria-hidden="true"></i>';
                                                    $color = 'success';
                                                    //
                                                } else if ($pedido['empacado'] == '1') {
                                                    $estatusTexto = 'Empacado  <i class="fa fa-archive" aria-hidden="true"></i>';
                                                    $color = 'success';
                                                    //
                                                } else if ($pedido['pagado'] == '1') {
                                                    $estatusTexto = 'Pagado  <i class="fa fa-money-bill" aria-hidden="true"></i>';
                                                    $color = 'success';
                                                    //
                                                }else if($pedido['pagado'] == '0' || $pedido['pagado'] == null){
                                                    $estatusTexto = 'Sin pagar  <i class="fa fa-times" aria-hidden="true"></i>';
                                                    $color = 'danger';
                                                }

                                                echo '
                                                <div class="row">

                                                    <div class="cell texto-ellipsis" data-title="Usuario">
                                                    ' . $pedido['usuario'] . '
                                                    </div>
                                                    <div class="cell" data-title="Vistas">
                                                        ' . $pedido['folio_pedido'] . '
                                                    </div>
                                                    <div class="cell" data-title="Precio" style="width: max-content;display: flex;">
                                                        $ ' . number_format($pedido['precio_total'], 2, '.', ' ') . '
                                                    </div>
                                                    <div class="cell" data-title="Cantidad almacen">
                                                        ' . $pedido['cantidad_articulos'] . '
                                                    </div>
                                                        
                                                    <div class="cell">
                                                        <div id="botonPublicar' . $pedido['id'] . '" class="btn btn-' . $color . '" style="width: 80%;">
                                                            ' . $estatusTexto . '
                                                        </div>
                                                    
                                                    </div>
                                                    
                                                    <div class="cell">
                                                        <div onclick="verCompra(' . "'" . $pedido['id'] . "'" . ')" class="btn btn-primary">
                                                            <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                ';
                                            }
                                            ?>

                                        </div>
                                        <?php
                                        if (empty($pedidos)) {
                                            echo '
                                            <div class="alert alert-info text-center">
                                                No hay pedidos registrados aún
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