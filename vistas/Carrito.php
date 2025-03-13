<?php
$paypal = "luissanchezb35@gmail.com";
$concept = "Producto Sanvite";
$datos = ControladorUsuario::traerDatosUsuarioCtr($_SESSION['usuario']);
echo '<br>';
echo '<br>';
//print_r($_SESSION['carrito']);
//print_r($_SESSION);
?>
<!--Main layout-->
<main style="font-size: 1.6rem;">
    <div class="container">
        <style>
            .overlay .mask {
                opacity: 0;
                -webkit-transition: all .4s ease-in-out;
                transition: all .4s ease-in-out;
            }

            .view .mask {
                position: absolute;
                top: 0;
                right: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            .side-nav .sidenav-bg,
            .view .mask {
                background-attachment: fixed;
                bottom: 0;
            }

            .waves-effect {
                position: relative;
                overflow: hidden;
                cursor: pointer;
                user-select: none;
            }

            .pswp__container,
            .pswp__img,
            .waves-effect {
                -webkit-tap-highlight-color: transparent;
                -ms-user-select: none;
                -webkit-user-select: none;
                -moz-user-select: none;
            }

            .zoom img,
            .zoom video {
                -webkit-transition: all .2s linear;
                transition: all .2s linear;
            }

            .view img,
            .view video {
                position: relative;
                display: block;
            }

            .img-fluid,
            .modal-dialog.cascading-modal.modal-avatar .modal-header,
            .video-fluid {
                max-width: 100%;
                height: auto;
            }

            .overlay .mask {
                opacity: 0;
                -webkit-transition: all .4s ease-in-out;
                transition: all .4s ease-in-out;
            }

            .view .mask {
                position: absolute;
                top: 0;
                right: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            .side-nav .sidenav-bg,
            .view .mask {
                background-attachment: fixed;
                bottom: 0;
            }

            .waves-effect {
                position: relative;
                overflow: hidden;
                cursor: pointer;
                user-select: none;
            }

            .rgba-black-slight,
            .rgba-black-slight::after {
                background-color: rgba(0, 0, 0, .1);
            }

            .pswp__container,
            .pswp__img,
            .waves-effect {
                -webkit-tap-highlight-color: transparent;
                -ms-user-select: none;
                -webkit-user-select: none;
                -moz-user-select: none;
            }

            .zoom img,
            .zoom video {
                -webkit-transition: all .2s linear;
                transition: all .2s linear;
            }

            .view img,
            .view video {
                position: relative;
                display: block;
            }

            .view {
                position: relative;
                overflow: hidden;
                cursor: default;
            }

            .chip:active,
            .z-depth-1 {
                -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;
                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;
            }

            .zoom:hover img,
            .zoom:hover video {
                -webkit-transform: scale(1.1);
                transform: scale(1.1);
            }

            .overlay .mask:hover {
                opacity: 1;
            }

            .zoom {
                width: auto;
                height: auto;
                background: #fff;
                border-radius: 50%;
                position: absolute;
                pointer-events: all;
                transition: none;
                opacity: 1;
                transform: none;
                transform-origin: none;
                overflow: hidden;
            }
        </style>
        <!--Section: Block Content-->
        <section class="mt-5 mb-4">

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-lg-8">

                    <!-- Card -->
                    <div class="card wish-list mb-4">
                        <div class="card-body">

                            <h3 class="mb-4">Carrito (<span><?php echo count($_SESSION['carrito']) ?></span> articulos)</h3>
                            <hr class="mb-4">

                            <?php
                            foreach ($_SESSION['carrito'] as $key => $articulo) {
                                $id_articulo = $articulo['id'];

                                if ($articulo['tamaño'] == 'presencial' || $articulo['tamaño'] == 'online') {
                                    $producto = ControladorProductos::traerCursoCtr($id_articulo);
                                    $producto = $producto[0];
                                    $nombre  = $producto['curso_nombre'];
                                    //print("<pre>".print_r($producto, true)."</pre>");

                                    if ($articulo['tamaño'] == 'presencial') {
                                        $precio  = $producto['costo_presencial'];
                                    } else if ($articulo['tamaño'] == 'online') {
                                        $precio  = $producto['costo_online'];
                                    }
                                    $descripcion  = $producto['curso_objetivo'];
                                    $descuento  = $producto['cursos_promocionporcentaje'];
                                    $categoria  = 'Curso';
                                    $subcategoria  = 'Sanvite';
                                    $img = $producto['curso_Imagenmain'];
                                    $tipo_tamaño = 'Modalidad: ';
                                } else {
                                    $producto = ControladorProductos::traerProductosCtr(0, 2, $id_articulo);
                                    $producto = $producto[0];
                                    $nombre  = $producto['titulo'];
                                    $descripcion  = $producto['descripcion'];
                                    $categoria  = $producto['categoria'];
                                    $subcategoria  = $producto['subcategoria'];
                                    $imagenes = ControladorProductos::traerImagenesCtr($producto['id']);
                                    $img = $imagenes[0]['ruta'];
                                    $tipo_tamaño = 'Tamaño: ';

                                    $tamaños = ControladorProductos::traerTamañosCtr('', $articulo['id_tamaño']);

                                    $precio = $tamaños[0]['precio'];
                                    $descuento = $tamaños[0]['descuento'];
                                    $stock = $tamaños[0]['cantidad'];
                                }

                                //print_r($producto);
                                //print_r($tamaños);

                                $id  = $producto['id'];
                                $tamaño  = $articulo['tamaño'];

                                $precioTotal = $precio * $articulo['cantidad'];

                                $precio_sin_descuento = $precioTotal;


                                if ($descuento == null || $descuento == '' || $descuento == 0) {
                                    $descuento = 0;
                                    $texto_descuento = '';
                                } else {
                                    $descuento = $descuento / 100;
                                    $texto_descuento = '<del class="text-muted">$'.number_format($precio_sin_descuento, 2, '.', ' ').'</del> - ';
                                }

                                //echo $descuento . " - " . $precioTotal;

                                $precioTotal = $precioTotal - $precioTotal * $descuento;

                                echo '
                            <div class="row mb-4">
                                <div class="col-md-5 col-lg-3 col-xl-3">
                                    <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0" style="height: 100%;">
                                        <img class="img-fluid w-100" src=".' . $img . '" alt="Sample">
                                        <a href="#!">
                                            <div class="mask waves-effect waves-light">
                                                <img class="img-fluid w-100" src=".' . $img . '">
                                                <div class="mask rgba-black-slight waves-effect waves-light"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7 col-lg-9 col-xl-9">
                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h3>' . $nombre . '</h3>
                                                <p class="mb-3 text-muted text-uppercase small">' . $categoria . ' - ' . $subcategoria . '</p>
                                                <p class="mb-3 text-muted text-uppercase small">' . $tipo_tamaño . '' . $tamaño . '</p>
                                                <p class="mb-3 text-muted text-uppercase small">Precio unitario: $' . $precio . '</p>
                                                ';
                                if ($descuento > 0) {
                                    echo '
                                                        <p class="mb-2 text-muted text-uppercase small">Descuento: ' . $descuento * 100 . '%</p>
                                                    ';
                                }

                                echo '
                                            </div>
                                            <div>
                                                <div class="def-number-input number-input safari_only mb-0 w-100">
                                                    <button style="opacity: 0; display: none;" onclick="this.parentNode.querySelector(' . "'" . 'input[type=number]' . "'" . ').stepDown()" class="minus"></button>
                                                    <input style="padding-left: 1rem; font-size: 1.6rem; height: 3rem;" class="form-control quantity" min="1" max="' . $stock . '" name="quantity" value="' . $articulo['cantidad'] . '" type="number">
                                                    <button style="opacity: 0; display: none;" onclick="this.parentNode.querySelector(' . "'" . 'input[type=number]' . "'" . ').stepUp()" class="plus"></button>
                                                </div>';

                                //Si hay pocas piezas en stock
                                if ($stock <= 3) {
                                    if ($stock == 1) {
                                        $texto = 'pieza';
                                    } else {
                                        $texto = 'piezas';
                                    }

                                    echo '
                                    <small id="passwordHelpBlock" class="form-text text-muted text-center">
                                    (Nota, ' . $stock . ' ' . $texto . ' restante en almacen)
                                    </small>';
                                }

                                echo '
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <a onclick="eliminarDelCarrito(' . $key . ')" type="button" class="card-link-secondary small text-uppercase mr-3">
                                                    <i class="fas fa-trash-alt mr-1"></i> Remover del carrito
                                                </a>
                                                <!-- 
                                                    <a href="#!" type="button" class="card-link-secondary small text-uppercase">
                                                        <i class="fas fa-heart mr-1"></i> Move to wish list
                                                    </a>
                                                -->
                                            </div>
                                            <p class="mb-0"><span>'.$texto_descuento.'<strong>$' . number_format($precioTotal, 2, '.', ' ') . '   </strong></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            ';
                            }

                            $sub_total = 0;
                            $sub_total = $precioTotal + $sub_total;
                            ?>

                            <p class="text-primary mb-0">
                                <i class="fas fa-info-circle mr-1"></i>
                                No demore su compra, agregar artículos a su carrito no significa reservarlos...
                            </p>

                        </div>
                    </div>
                    <!-- Card -->

                    <!-- Card -->
                    <div hidden class="card mb-4">
                        <div class="card-body">

                            <h3 class="mb-4">Tiempo estimado de llegada</h3>

                            <p class="mb-0"> Jue., 13.12. - Lunes., 16.12.</p>
                        </div>
                    </div>
                    <!-- Card -->

                    <!-- Card -->
                    <div class="card mb-4">
                        <style>
                            input[type=radio].with-font,
                            input[type=checkbox].with-font {
                                border: 0;
                                clip: rect(0 0 0 0);
                                height: 1px;
                                margin: -1px;
                                overflow: hidden;
                                padding: 0;
                                position: absolute;
                                width: 1px;
                            }

                            input[type=radio].with-font~label:before,
                            input[type=checkbox].with-font~label:before {
                                font-family: FontAwesome;
                                display: inline-block;
                                content: "\f1db";
                                letter-spacing: 10px;
                                font-size: 1.2em;
                                color: #dfe2e7;
                                width: 1.4em;
                            }

                            input[type=radio].with-font:checked~label:before,
                            input[type=checkbox].with-font:checked~label:before {
                                content: "\f00c";
                                font-size: 1.2em;
                                color: #0943c6;
                                letter-spacing: 5px;
                            }

                            input[type=checkbox].with-font~label:before {
                                content: "\f096";
                            }

                            input[type=checkbox].with-font:checked~label:before {
                                content: "\f046";
                                color: #0943c6;
                            }

                            input[type=radio].with-font:focus~label:before,
                            input[type=checkbox].with-font:focus~label:before,
                            input[type=radio].with-font:focus~label,
                            input[type=checkbox].with-font:focus~label {}

                            .box {
                                background-color: #fff;
                                border-radius: 8px;
                                border: 2px solid #e9ebef;
                                padding: 15px;
                                margin-bottom: 40px;
                            }

                            .plan-selection {
                                border-bottom: 2px solid #e9ebef;
                                padding-bottom: 25px;
                                margin-bottom: 35px;
                            }

                            .plan-selection:last-child {
                                border-bottom: 0px;
                                margin-bottom: 0px;
                                padding-bottom: 0px;
                            }

                            .plan-data {
                                position: relative;
                            }

                            .plan-data label {
                                font-size: 16px;
                                margin-bottom: 10px;
                                font-weight: 400;
                            }

                            .plan-text {
                                padding-left: 35px;
                            }

                            .plan-price {
                                position: absolute;
                                right: 0px;
                                color: #094bde;
                                font-size: 16px;
                                font-weight: 700;
                                letter-spacing: -1px;
                                line-height: 1.5;
                                bottom: 43px;
                            }
                        </style>
                        <div class="card-body">

                            <h3 class="mb-4">Direccion de envio</h3>

                            <div class="box">
                                <?php
                                $direcciones = ControladorUsuario::traerDireccionesCtr($_SESSION['usuario']);

                                if (empty($direcciones)) {
                                    echo '
                                        <button onclick="nuevaDireccion()" type="button" class="btn btn-primary btn-block waves-effect waves-light" style="font-size: 1.7rem;">
                                            Agregar nueva direccion
                                        </button>
                                        ';
                                } else {
                                    $contador = 0;
                                    foreach ($direcciones as $direccion) {
                                        $calle = $direccion['calle'];
                                        $numero = $direccion['numero'];
                                        $colonia = $direccion['colonia'];
                                        $municipio = $direccion['municipio'];
                                        $estado = $direccion['estado'];
                                        $pais = $direccion['pais'];
                                        $principal = $direccion['principal'];
                                        $codigo_postal = $direccion['codigo_postal'];
                                        $contador++;

                                        echo '
                                        <div class="plan-selection">
                                            <div class="plan-data">
                                                <input id="direccion' . $contador . '" onclick="seleccionarDireccion($(this).siblings(' . "'" . 'p' . "'" . '))" type="radio" class="with-font" value="' . "'" . json_encode($direccion, JSON_UNESCAPED_UNICODE) . "'" . '" />
                                                <label for="direccion' . $contador . '">' . $direccion['nombre_ubicacion'] . '</label>
                                                <p class="plan-text">';
                                        echo "
                                                $calle $numero, Col. $colonia, CP. $codigo_postal, $municipio, $estado, $pais
                                                ";
                                        echo '
                                                </p>';

                                        if ($principal == 1) {
                                            echo '
                                                    <span class="plan-price">Principal</span>
                                                    ';
                                        }
                                        echo '
                                            </div>
                                        </div>
                                        ';
                                    }

                                    echo '
                                        <button onclick="nuevaDireccion()" type="button" class="btn btn-primary btn-block waves-effect waves-light" style="font-size: 1.7rem;">
                                            Agregar nueva direccion
                                        </button>
                                        ';
                                }

                                ?>


                                <input type="hidden" id="direccion_envio" value="sn">

                            </div>
                        </div>
                    </div>

                    <!-- Card -->


                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4">

                    <!-- Card -->
                    <div class="card mb-4">
                        <div class="card-body">

                            <h3 class="mb-3">Cantidad total del pedido</h3>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Subtotal:
                                    <span>$
                                        <?php
                                        echo $sub_total;
                                        ?>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Costo de envio:
                                    <span><?php
                                            $envio = 1;

                                            if ($envio == 0) {
                                                $envio_txt = 'Gratis';
                                                echo $envio_txt;
                                            } else {
                                                $envio_txt = $envio * 0.16;
                                                $envio_txt += $envio;
                                                echo "$" . number_format($envio_txt, 2, '.', ' ');
                                            }
                                            ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Cantidad total</strong>
                                        <strong>
                                            <p class="mb-0">(incluyendo IVA)</p>
                                        </strong>
                                    </div>
                                    <span><strong>$
                                            <?php
                                            if ($envio > 0) {
                                                $total_pagar = $sub_total + $envio_txt;
                                            } else {
                                                $total_pagar = $sub_total + $envio;
                                            }

                                            echo number_format($total_pagar, 2, '.', ' ');
                                            $_SESSION['total_pagar'] = $total_pagar;
                                            ?>
                                        </strong></span>
                                </li>
                            </ul>

                            <button onclick="controladorPago()" type="button" class="btn btn-primary btn-block waves-effect waves-light" style="font-size: 1.7rem;">
                                Ir a pagar
                            </button>

                        </div>
                    </div>
                    <!-- Card -->

                    <!-- Card -->
                    <div class="card mb-4">
                        <div class="card-body">

                            <a class="dark-grey-text d-flex justify-content-between" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Añadir codigo de promocion (opcional)
                                <span><i class="fas fa-chevron-down pt-1"></i></span>
                            </a>

                            <div class="collapse" id="collapseExample">
                                <div class="mt-3">
                                    <div class="md-form md-outline mb-0">
                                        <input style="font-size: 1.6rem" type="text" id="discount-code" class="form-control font-weight-light" placeholder="Ingresa codigo de descuento">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->

                    <!-- Card -->
                    <div class="card mb-4">
                        <div class="card-body">

                            <h3 class="mb-4">Aceptamos las siguientes formas de pago</h3>

                            <img class="mr-2" width="45px" src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg" alt="Visa">
                            <img class="mr-2" width="45px" src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg" alt="American Express">
                            <img class="mr-2" width="45px" src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg" alt="Mastercard">
                            <img class="mr-2" width="45px" src="https://z9t4u9f6.stackpathcdn.com/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png" alt="PayPal">
                        </div>
                    </div>
                    <!-- Card -->

                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

        </section>
        <!--Section: Block Content-->

    </div>
</main>

<div style="font-size: 16px" class="modal fade" id="modal-tarjeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulario de pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row">

                        <aside class="col-sm-12">

                            <article class="card">
                                <div class="card-body p-3">

                                    <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
                                                <i class="fa fa-credit-card"></i> Tarjeta de credito
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
                                                <i class="fab fa-paypal"></i> Paypal
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">

                                        <div class="tab-pane fade active show" id="nav-tab-card">

                                            <form role="form">
                                                <br>
                                                <div class="form-group">
                                                    <label for="username">Nombre del titular</label>
                                                    <input type="text" class="form-control" name="username" placeholder="" required="">
                                                </div> <!-- form-group.// -->

                                                <div class="form-group" style="margin-bottom: 0.2rem;">
                                                    <label for="cardNumber">Tarjeta</label>
                                                    <div class="input-group">
                                                        <input id="tarjeta" type="number" class="form-control" name="cardNumber" placeholder="" onkeyup='validate()' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text text-muted">
                                                                <i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>  
                                                                <i class="fab fa-cc-mastercard"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div id='result'></div>
                                                </div> <!-- form-group.// -->

                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <label><span class="hidden-xs">Fecha de expiración</span> </label>
                                                            <div class="input-group">
                                                                <input step="01" id="mes" type="number" class="form-control" placeholder="MM" name="" maxlength="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                                                <input step="01" id="año" type="number" class="form-control" placeholder="AA" name="" maxlength="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label data-toggle="tooltip" title="" data-original-title="Codigo de 3 digitos al reverso de la tarjeta">CVV <i class="fa fa-question-circle"></i></label>
                                                            <input step="01" id="ccv" type="number" class="form-control" required="" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                                        </div> <!-- form-group.// -->
                                                    </div>
                                                </div> <!-- row.// -->
                                                <br>
                                                <button class="subscribe btn btn-primary btn-block" type="button" onclick="pagarPedido()"> Confirmar </button>
                                            </form>
                                        </div> <!-- tab-pane.// -->
                                        <div class="tab-pane fade" id="nav-tab-paypal">
                                            <p>Paypal es una manera facil de pagar en linea</p>
                                            <br>
                                            <p>
                                                <button type="button" class="btn btn-primary" onclick="enviarpago()"> <i class="fab fa-paypal"></i>&nbsp;Ir a Paypal</button>
                                            </p>
                                            <!-- 
                                                                <p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                                tempor incididunt ut labore et dolore magna aliqua. </p>
                                                            -->
                                        </div>

                                    </div> <!-- tab-content .// -->

                                </div> <!-- card-body.// -->
                            </article> <!-- card.// -->


                        </aside> <!-- col.// -->
                    </div> <!-- row.// -->

                </div>
                <!--container end.//-->


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-toggle="pill" href="#nav-tab-card">Pagar con tarjeta</button>
                <button type="button" class="btn btn-primary" data-toggle="pill" href="#nav-tab-paypal">Pagar con paypal</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="classtable" style="position: relative; display: none;" id="pediddobaseforma3">

    <form id="pago" action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1"><input type="hidden" name="currency_code" value="MXN" />
        <input type="hidden" name="business" value="<?php echo $paypal; ?>">
        <input name="return" type="hidden" value="https://www.cemarketing.mx/Sanvite/ruta=?MisPedidos" />
        <input name="notify_url" type="hidden" value="https://www.cemarketing.mx/Sanvite/ipn.php" />

        <input name="rm" type="hidden" value="2" />
        <input name="item_number_1" type="hidden" value="<?php echo 'Productos Sanvite'; ?>" />
        <input name="item_name_1" type="hidden" value="<?php echo $concept; ?>" />
        <input id="totalPaypal" name="amount_1" type="hidden" value="<?php echo $_SESSION['total_pagar']; ?>" />
        <input name="quantity_1" type="hidden" value="1" />
    </form>

    <script>
        $(document).ready(function() {

        })

        function enviarpago() {
            $('#pago').submit();
        }
    </script>

    <script>
        function enviarpagotarjeta() {
            $('#modal-tarjeta').modal("show");
        }
    </script>

    <script>
        function numToList(num) {
            return (num + '').split("").map(Number)
        }

        function oddEven(lon) {
            var even = [],
                odd = [];
            for (var i = 0; i < lon.length; i++) {
                if ((i + 2) % 2 == 0) {
                    odd.push(lon[i]);
                } else {
                    even.push(lon[i]);
                }
            }
            return [even, odd];
        }

        function sum(lon) {
            return lon.reduce(function(pv, cv) {
                return pv + cv;
            }, 0);
        }

        function luhnValidate(number) {
            var digits = numToList(number)
            lists = oddEven(digits)
            even = lists[0]
            odd = lists[1]
            checksum = sum(odd);

            for (i = 0; i < even.length; i++)
                checksum += sum(numToList(even[i] * 2))

            return (checksum % 10) == 0
        }

        function validate() {
            var x = document.getElementById("tarjeta").value;
            if (x != '' && luhnValidate(x)) {
                document.getElementById("result").innerHTML = 'Tarjeta valida';
                $("#result").removeClass("danger")
                $("#result").addClass("success")
                $("#tarjeta").addClass("successT")
                $("#tarjeta").removeClass("dangerT")
                //$(".subscribe").prop('disabled', false);

            } else {
                document.getElementById("result").innerHTML = 'Numero de tarjeta invalido';
                //$(".subscribe").prop('disabled', true);
                $("#result").addClass("danger")
                $("#result").removeClass("success")
                $("#tarjeta").removeClass("successT")
                $("#tarjeta").addClass("dangerT")
            }
        }
    </script>

    <div class="divfacerpedido">
        <button class="enviarpedidobuttonformaleft" onClick="makeorfaerregreso()">
            Regresar
        </button>
        <button class="enviarpedidobuttonforma" onClick="enviarpago()">
            Finalizar Pedido
        </button>
    </div>

</div>

</div>
</div>
</div>
<div id="textodegraciasfinal" class="recuadrodegraciasmain" style="display: none;">
    <div class="recuadrodegracias">
        Gracias por tu compra
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.1/dist/sweetalert2.all.min.js"></script>

<script>
    function eliminarError() {
        $('#estatus-modal').delay(10000)
        $('#estatus-modal').remove()
    }

    function makeorfaer() {
        $('#pediddobaseforma').fadeOut('slow');
        $('#pediddobaseforma2').fadeIn('slow');
    }

    function makeorfaerregreso() {
        $('#pediddobaseforma2').fadeOut('slow');
        $('#pediddobaseforma').fadeIn('slow');
    }

    function pagarr() {
        $('#pediddobaseforma2').fadeOut('slow');
        $('#pediddobaseforma3').fadeIn('slow');
    }

    function guardarencookies() {
        var nombre = document.getElementById("name").value;
        document.cookie = "nombre=" + nombre;

        var email = document.getElementById("email").value;
        document.cookie = "email=" + email;

        var tel = document.getElementById("tel").value;
        document.cookie = "tel=" + tel;

        var contry = document.getElementById("contry").value;
        document.cookie = "contry=" + contry;

        var state = document.getElementById("state").value;
        document.cookie = "state=" + state;

        var city = document.getElementById("city").value;
        document.cookie = "city=" + city;

        var zipcode = document.getElementById("zipcode").value;
        document.cookie = "zipcode=" + zipcode;

        var addressline = document.getElementById("addressline").value;
        document.cookie = "addressline=" + addressline;

        var numeroExterior = document.getElementById("numeroExterior").value;
        document.cookie = "numeroExterior=" + numeroExterior;

        var numeroInterior = document.getElementById("numeroInterior").value;
        document.cookie = "numeroInterior=" + numeroInterior;

    }

    function finalizaryenviarpedido() {

        guardarencookies()

        var nombre = $.cookie('nombre');
        var email = $.cookie('email');
        var tel = $.cookie('tel');
        var contry = $.cookie('contry');
        var state = $.cookie('state');
        var city = $.cookie('city');
        var zipcode = $.cookie('zipcode');
        var addressline = $.cookie('addressline');
        var numeroExterior = $.cookie('numeroExterior');
        var numeroInterior = $.cookie('numeroInterior');
        var tarjeta = $('#tarjeta').val();
        var mes = $('#mes').val();
        var año = $('#año').val();
        var fecha = mes + "/" + año;
        var precio = total;
        var ccv = $('#ccv').val();

        console.log('enviando');

        if (nombre == '' || nombre == null || typeof nombre == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar un nombre',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (email == '' || email == null || typeof email == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar un correo electronico',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (tel == '' || tel == null || typeof tel == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar un telefono',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (contry == '' || contry == null || typeof contry == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar un país',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (state == '' || state == null || typeof state == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar un Estado/Provincia',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (city == '' || city == null || typeof city == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar una Ciudad o Pueblo',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (zipcode == '' || zipcode == null || typeof zipcode == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar un Codigo Postal',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (addressline == '' || addressline == null || typeof addressline == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar una Dirección',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (numeroExterior == '' || numeroExterior == null || typeof numeroExterior == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar un Numero Exterior',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (tarjeta == '' || tarjeta == null || typeof tarjeta == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar una Tarjeta',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (mes == '' || mes == null || typeof mes == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar un Mes de vencimiento para la tarjeta de credito',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (año == '' || año == null || typeof año == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar un Año de vencimiento para la tarjeta de credito',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (ccv == '' || ccv == null || typeof ccv == 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar un CCV para la tarjeta de credito',
                footer: 'Por favor revisa el apartado del formulario'
            })
        } else if (precio == '' || precio == null || typeof precio == 'undefined' || precio != <?php echo $precioTotal; ?>) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ha ocurrido un problema con el precio del pedido',
                footer: 'Por favor recarga la pagina o comunicate con nosotros <br> <a href="/Contacto">Contactar</a>'
            })
        } else {

            if (nombre != "" && email != "" && tel != "" && contry != "" && state != "" && city != "" && zipcode != "" && addressline != "" && tarjeta != "") {

                $.ajax({
                    url: "beluga.ajax.php",
                    type: "POST",
                    data: {
                        nombre: nombre,
                        email: email,
                        tel: tel,
                        contry: contry,
                        state: state,
                        city: city,
                        zipcode: zipcode,
                        addressline: addressline,
                        numeroExterior: numeroExterior,
                        numeroInterior: numeroInterior,
                        tarjeta: tarjeta,
                        fecha: fecha,
                        ccv: ccv,
                        precio: precio
                    },
                    success: function(response) {
                        console.log(response)
                        $('#nav-tab-card').append(response);
                        $('#estatus-modal').delay(10000)
                        $('#estatus-modal').remove()
                        if (response.indexOf("Aprobada") !== -1) {
                            setTimeout(function() {
                                window.location = "/CartSuccess"
                            }, 5000);
                        }
                    },
                    beforeSend: function(data) {
                        $('#boton-enviar-pago').html('Procesando ...');
                    },
                    complete: function(data) {
                        $('#boton-enviar-pago').html('Pagar')
                    }
                });


            } else {

                $('#porfavortexto').fadeIn('slow');
                $('#porfavortexto').delay(3000);
                $('#porfavortexto').fadeOut('slow');

            }
        }

    }

    function goBack() {
        window.history.back();
    }

    function eliminarproductoid(id) {

        obj = JSON.parse(cadenajson);

        for (var i = 0; i < obj.pedido.length; i++) {
            if (obj.pedido[i].iddejson == id) {
                obj.pedido.splice(i, 1);
                break;
            }
        }

        cadenajson = JSON.stringify(obj);

        $.ajax({
            url: "include/eliminarproductocarrito.php",
            type: "POST",
            data: {
                idcontadordeproductos: idcontadordeproductos,
                cadenajson: cadenajson
            },
            success: function(response) {
                window.location.reload();
            }
        });

    }

    function realizarpedido() {

        $('#pediddobaseforma').fadeIn('slow');
        $('#pediddobaseforma').delay(3000);
        $('#pediddobaseforma').fadeOut('slow');

        $('#pediddobaseforma2').fadeIn('slow');
        $('#pediddobaseforma2').delay(3000);
        $('#pediddobaseforma2').fadeOut('slow');

    }
</script>