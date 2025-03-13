<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.1/css/lightbox.min.css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<?php

$producto = ControladorProductos::traerProductosCtr(0, 1, $_GET['id']);
$producto = $producto[0];


$id  = $producto['id'];
$nombre  = $producto['titulo'];
$precio  = $producto['precio'];
$descripcion  = $producto['descripcion'];

$imagenes = ControladorProductos::traerImagenesCtr($producto['id']);
$img = $imagenes[0]['ruta'];

$tamaños = ControladorProductos::traerTamañosCtr($producto['id']);

$vistas = ControladorProductos::guardarVisualizacionCtr($_GET['id']);

//print("<pre>".print_r($tamaños)."</pre>");
//print("<pre>".print_r($producto)."</pre>");
//print("<pre>".print_r($imagenes)."</pre>");

echo "
<input type=\"hidden\" id=\"id_producto_carrito\" value=\"$id\">
<input type=\"hidden\" id=\"nombre_producto_carrito\" value=\"$nombre\">
<input type=\"hidden\" id=\"precio_producto_carrito\" value=\"$precio\">
<input type=\"hidden\" id=\"descripcion_producto_carrito\" value=\"$descripcion\">
<input type=\"hidden\" id=\"tamaño_id_articulo\">
";


?>
<div class="principaldivtablearriba">
    <div class="classtable">
        <div class="principaldivtableabajo">
            <div class="classtable">
                <div class="productosleft">


                    <section class="articulo-section">
                        <div class="row">
                            <div class="galeria-empresa">

                                <?php

                                echo '
                                    <a class="galeria-item galeria-item-feature" href=".' . $img . '" data-lightbox="galeria-empresas">
                                        <img class="galeria-item-image" src=".' . $img . '" alt="" />
                                    </a>'
                                ?>

                                <div class="contenedor_lateral_empresa">
                                    <?php
                                    foreach ($imagenes as $imagen) {
                                        $imagen = $imagen['ruta'];

                                        echo "
                                            <a class=\"galeria-item\" href=\".$imagen\" data-lightbox=\"galeria-empresas\">
                                                <img class=\"galeria-item-image\" src=\".$imagen\"/>
                                            </a>
                                            ";
                                    }
                                    ?>

                                </div>

                            </div>
                        </div>
                    </section>


                </div>
            
                <div class="productosright">
                    <p class="titulosformatitulosdes" id="nombredeloproductomayan"><?php echo $nombre; ?></p>

                    <div class="productoparadescipcion" id="secdes" data-before="+" onClick="verdescripcion()">
                        Descripción
                        <div class="seccionmamenos"></div>
                    </div>
                    <div class="espaciodescripcionproductos" id="descricpion" style="display: none;">
                        <p class="textdescrpcionproductonew"><?php echo $descripcion; ?></p>
                    </div>
                    <div class="secciondetanycolo">

                        <p class="colordeformacion">Tamaños disponibles</p>

                        <?php

                        if (empty($tamaños)) {
                            echo "
                                    <div class=\"alert alert-info text-center\">
                                        No hay tamaños disponibles
                                    </div>
                                ";
                        } else {
                            //print_r($tamaños);

                            echo '
                                <select onchange="controladorCantidad(this)" class="secciondiv" id="talla">
                                    <option cantidad="1" value="" selected>Selecciona un tamaño</option>
                                ';

                            foreach ($tamaños as $tamaño) {
                                $valor = $tamaño['tamaño'];
                                $cantidad = $tamaño['cantidad'];
                                if($cantidad == 0){
                                    $disabled = 'disabled';
                                }else{
                                    $disabled = '';
                                }

                                if($tamaño['id_producto'] != $_GET['id']){
                                    continue;
                                }

                                $precio = $tamaño['precio'];
                                $id = $tamaño['id'];

                                echo "
                                <option $disabled identificador=\"$id\" precio=\"$precio\" cantidad=\"$cantidad\" value=\"$valor\">$valor - $$precio</option>
                                ";
                            }

                            echo '
                                </select>
                                ';
                        }
                        ?>

                        <br>

                        <div hidden class="secciondecolores">
                            <p class="colordeformacion">Colores disponibles</p>
                            <?php

                            $colores = array();

                            if (empty($colores)) {
                                echo "
                                    <div class=\"alert alert-info text-center\">
                                        No hay colores disponibles
                                    </div>
                                ";
                            } else {

                                foreach ($colores as $color) {
                                    $nombre_color = $color['nombre_color'];
                                    $tono = $color['color'];
                                    echo "
                                    <div class=\"seccincadacolor\">
                                        <div class=\"color\" style=\"background-image: url('imagenes/Sliders/2.jpg');\">
                                            <input type=\"radio\" name=\"color\" value=\"Azul\">
                                            <i class=\"checkbox-icon\"></i>
                                        </div>
                                        <p class=\"nobredelcolor\">$nombre_color</p>
                                    </div>
                                    ";
                                }
                            }
                            ?>


                        </div>

                        <div class="contenedor_precio_articulo">
                            <p class="colordeformacion" style="margin: 0; padding: 0;">Precio: </p>
                            <p class="textousprecio" style="margin: 0; padding: 0; margin-left: 1rem"> <b>$</b> <b id="precio_articulo">0</b> </p>

                        </div>

                        <script>
                            if ($("#medidass").length) {
                                $('.nohay').hide();
                            }
                        </script>

                        <div style="clear:both; height: 0px;"><br></div>
                    </div>

                    <div  style="margin: 20px auto;" class="espacioseccionnumeric">
                        <div class="espacinumeric">
                            <div class="number-spinner">
                                <span class="ns-btn">
                                    <a data-dir="dwn"><span class="icon-minus"></span></a>
                                </span>
                                <input id="cantidad" name="cantidad" type="text" class="pl-ns-value" value="1" maxlength=2>
                                <span class="ns-btn">
                                    <a data-dir="up"><span class="icon-plus"></span></a>
                                </span>
                            </div>
                        </div>
                        <div class="anadircarrito">
                            <div class="bootnagregarcarrito degradadomanetener" style="margin-left: 20px;" onClick="añadirAlCarrito()">Añadir al carrito</div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
</div>


<style>
    .owl-nav2 {
        width: 80% !important;
    }

    .owl-prev2 {
        color: #cc0099 !important;
    }

    .owl-next2 {
        color: #cc0099 !important;
    }

    .owl-prev2:hover {
        color: rgba(172, 0, 176, 1.00) !important;
    }

    .owl-next2:hover {
        color: rgba(172, 0, 176, 1.00) !important;
    }

    .owl-theme .owl-dots2 .owl-dot span {
        background: #cc0099;
    }

    .owl-theme .owl-dots2 .owl-dot.active span,
    .owl-theme .owl-dots2 .owl-dot:hover span {

        background: rgba(172, 0, 176, 1.00);

    }
</style>

<script>
    var numberSpinner = (function() {
        $('.number-spinner>.ns-btn>a').click(function() {
            var btn = $(this),
                oldValue = btn.closest('.number-spinner').find('input').val().trim(),
                newVal = 0;

            if (btn.attr('data-dir') === 'up') {
                newVal = parseInt(oldValue) + 1;
            } else {
                if (oldValue > 1) {
                    newVal = parseInt(oldValue) - 1;
                } else {
                    newVal = 1;
                }
            }
            if(newVal > $('#cantidad').attr('max')){
                return;
            }

            var precio = $('#talla option:selected').attr('precio');
            $('#precio_articulo').text(Number(newVal) * Number(precio))
            $('#precio_producto_carrito').val(Number(precio))

            btn.closest('.number-spinner').find('input').val(newVal);
        });
        $('.number-spinner>input').keypress(function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        });
    })();

    function verdescripcion() {
        if (document.getElementById("descricpion").style.display == "none") {
            $("#descricpion").fadeIn();
            $('#secdes').attr('data-before', '-');
        } else {
            $("#descricpion").fadeOut();
            $('#secdes').attr('data-before', '+');
        }
    }
</script>
<script src='js/lightbox.js'></script>