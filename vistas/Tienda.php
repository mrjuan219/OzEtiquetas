<div class="contenedor_principal_header">
    <img src="imagenes/Sliders/13.png" alt="">
    <div class="subcontenedor">
        <div class="izquierda">
            <img src="imagenes/General/cuadrada/9.png" alt="">
        </div>
        <div class="derecha">
            <h4 class="titulo">Contamos</h4>
            <p>
                Con una amplia gama de etiquetas blancas listas para impresión.
            </p>
            <div class="boton rojo" onclick="hacerscroll('#footer')">
                Contáctanos
            </div>
        </div>
    </div>
</div>

<div class="contenedor-regular">

    <div class="vector_superior_derecha"></div>

    <h2 class="titulo">
        Etiquetas Blancas y Ribbones
    </h2>

    <div class="subcontenedor">
        <div class="izquierda">
            <p>
                En oz etiquetas contamos con una amplia gama de etiquetas blancas listas para impresión.
            </p>

            <div class="boton rojo">
                Cotizar
            </div>
        </div>

        <div class="derecha">
            <img src="imagenes/General/cuadrada/11.png" alt="">
        </div>
    </div>

</div>


<div class="contenedor-regular" style="margin: 150px 0; background-color: #257fc2;">
    <img class="fondo_vector_superior" src="imagenes/General/Fondo-cmyk.png" alt="">
    <img class="fondo_vector_azul_inferior" src="imagenes/General/azul.png" alt="">

    <div class="subcontenedor">

        <div class="contenedor_productos">

            <?php
            $productos = ControladorProductos::traerProductosCtr();
            $productos[] = array();
            foreach ($productos as $producto) {

                //$id = $producto['curso_id'];
                $id = '1';
                //$nombre = $producto['curso_nombre'];
                $nombre = 'Etiqueta 8cm x 8cm';
                //$img = $producto['curso_Imagenmain'];
                $img = 'imagenes/General/cuadrada/2.png';

                echo '
                <div class="item" onclick="window.location.search=' . "'?Articulo&id=$id'" . '">
                    <img src="' . $img . '">
                    <p>' . $nombre . '</p>
                    <div class="boton rojo">Más información</div>
                </div>
                ';

                echo '
                <div class="item" onclick="window.location.search=' . "'?Articulo&id=$id'" . '">
                    <img src="' . $img . '">
                    <p>' . $nombre . '</p>
                    <div class="boton rojo">Más información</div>
                </div>
                ';

                echo '
                <div class="item" onclick="window.location.search=' . "'?Articulo&id=$id'" . '">
                    <img src="' . $img . '">
                    <p>' . $nombre . '</p>
                    <div class="boton rojo">Más información</div>
                </div>
                ';

                echo '
                <div class="item" onclick="window.location.search=' . "'?Articulo&id=$id'" . '">
                    <img src="' . $img . '">
                    <p>' . $nombre . '</p>
                    <div class="boton rojo">Más información</div>
                </div>
                ';
            }
            ?>


        </div>
    </div>
</div>

<div class="contenedor-regular" style="margin: 250px 0;">
    <img style="z-index: 0;" class="fondo_vector_azul" src="imagenes/Vectores/3.png" alt="">

    <h2 style="z-index: 9;" class="titulo">
        Algunos de nuestros clientes
    </h2>
    <div class="subcontenedor" style="margin-top: 5rem; z-index: 9;">

        <div id="carrousel_clientes" class="owl-carousel owl-theme">

            <?php
            $productos = ControladorProductos::traerProductosCtr();
            $productos[] = array();
            foreach ($productos as $producto) {

                //$id = $producto['curso_id'];
                $id = '1';
                //$nombre = $producto['curso_nombre'];
                $nombre = 'Etiqueta 8cm x 8cm';
                //$img = $producto['curso_Imagenmain'];
                $img = 'imagenes/General/catsup-del-monte.png';

                echo '
                <div class="item" onclick="window.location.search=' . "'?Articulo&id=$id'" . '">
                    <img class="no-hover" src="' . $img . '">
                </div>
                ';

                echo '
                <div class="item" onclick="window.location.search=' . "'?Articulo&id=$id'" . '">
                    <img class="no-hover" src="' . $img . '">
                </div>
                ';

                echo '
                <div class="item" onclick="window.location.search=' . "'?Articulo&id=$id'" . '">
                    <img class="no-hover" src="' . $img . '">
                </div>
                ';

                echo '
                <div class="item" onclick="window.location.search=' . "'?Articulo&id=$id'" . '">
                    <img class="no-hover" src="' . $img . '">
                </div>
                ';
            }
            ?>


        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#carrousel_clientes').owlCarousel({
            loop: true,
            margin: 80,
            nav: true,
            navText: ["", ""],
            center: true,
            responsive: {
                0: {
                    nav: false,
                    items: 1
                },
                600: {
                    nav: false,
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    });
</script>