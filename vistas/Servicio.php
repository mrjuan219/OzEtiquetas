<?php
    if($_GET['idCategoria'] == '35'){
        $titulo_slider = 'Personalizamos';
        $descripcion_slider = 'Personalizamos, diseñamos , producimos y entregamos tus etiquetas listas para instalación.';
        $imagen_slider = 'imagenes/General/cuadrada/etiqueta.png';
        //
        $titulo_producto = 'Etiquetas personalizadas';
        $descripcion_producto = 'Trabajamos para personalizar tu etiqueta de principio a sin para poder brindarte los mejores estándares de calidad para tus productos, ya sea del rubro alimenticio o industrial , personalizamos y desarrollamos tu etiqueta a la medida.';
        $imagen_producto = 'imagenes/General/cuadrada/etiqueta.png';
        //
    }else if($_GET['idCategoria'] == '36'){
        $titulo_slider = 'Contamos';
        $descripcion_slider = 'Con una amplia gama de etiquetas blancas listas para impresión.';
        $imagen_slider = 'imagenes/General/cuadrada/inicio.png';
        //
        $titulo_producto = 'Etiquetas Blancas y Ribbones';
        $descripcion_producto = 'En oz etiquetas contamos con una amplia gama de Etiquetas Blancas y Ribbones listas delete general.';
        $imagen_producto = 'imagenes/General/cuadrada/5.png';
        //
    }else if($_GET['idCategoria'] == '37'){
        $titulo_slider = 'Automático';
        $descripcion_slider = 'Sistema de etiquetado automático especializado para el rubro del aguacate';
        $imagen_slider = 'imagenes/General/cuadrada/1.png';
        //
        $titulo_producto = 'Etiquetadora automatica de frutos';
        $descripcion_producto = 'Oz etiqueta pone a tu disposición un sistema integral y fácil de instalar en tu línea de producción para el etiquetado automático en el rubro del aguacate. Este sistema se instala y se prueba directamente a tu linea de producción, así como se brinda la capacitación integral. Únicos en México. Con soporte en rápido en toda la republica mexicana.';
        $imagen_producto = 'imagenes/General/cuadrada/1.png';
        //
    }else if($_GET['idCategoria'] == '38'){
        $titulo_slider = 'Equipos';
        $descripcion_slider = 'Equipos de impresión de etiquetas especializados para lo que buscas. Te asesoramos.';
        $imagen_slider = 'imagenes/General/cuadrada/2.png';
        //
        $titulo_producto = 'Equipos de impresión';
        $descripcion_producto = 'Son ideales para ambientes donde se requiere la automatización de procesos tales como control de empresas, tiendas departamentales, trazabilidad, almacenes, fábricas, centros de distribución y puntos de venta.
        <br>
        <br>
        Una impresora de código de barras es un dispositivo que utiliza tecnología de transferencia térmica o térmica directa para imprimir información en etiquetas, con propósitos de identificación de productos. Estas Impresoras cubren distintas necesidades de acuerdo al propósito de uso que se requiera; pueden ser, de escritorio, portátiles, semi industriales, industriales o de uso rudo.';
        $imagen_producto = 'imagenes/General/cuadrada/2.png';
        //
    }
?>
<div class="contenedor_principal_header">
    <!-- 
        <img src="imagenes/Sliders/11.png" alt="">
     -->
     <video preload="none" playsinline muted loop autoplay src="imagenes/videos/oz3.mp4"></video>
     <div class="fondo_negro"></div>

    <div class="subcontenedor">
        <div class="izquierda">
            <img src="<?php echo $imagen_slider?>" alt="">
        </div>
        <div class="derecha">
            <h4 class="titulo"><?php echo $titulo_slider?></h4>
            <p>
                <?php echo $descripcion_slider?>
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
        <?php echo $titulo_producto?>
    </h2>

    <div class="subcontenedor">
        <div class="izquierda">
            <p>
                <?php echo $descripcion_producto?>
            </p>

            <div class="boton rojo">
                Cotizar
            </div>
        </div>

        <div class="derecha">
            <img src="<?php echo $imagen_producto?>" alt="">
        </div>
    </div>

</div>

<div <?php if($_GET['idCategoria'] == '37'){ echo 'hidden';}?> class="contenedor-regular" style="margin: 150px 0; background-color: #257fc2;">
    

<?php 
    $subcategorias = ControladorServicios::traerSubCategoriasCtr($_GET['idCategoria']);
    if(count($subcategorias) == 1){
        $top = '48%';
    }else if(count($subcategorias) == 2){
        $top = '37%';
    }else if(count($subcategorias) >= 3){
        $top = '25%';
    }else{
        $top = '18%';
    }

    echo count($subcategorias);

    echo '
    <img class="fondo_vector_superior" style="top: -'.$top.';" src="imagenes/General/Fondo-cmyk.png" alt="">
    <img class="fondo_vector_azul_inferior" src="imagenes/General/azul.png" alt="">

    <div class="subcontenedor" style="overflow: hidden;flex-flow: column;justify-content: center;align-items: center;">
    ';

    foreach($subcategorias as $subcategoria){
        echo '
        <div class="contenedor_productos" style="width: 100%;">

            <h2 class="titulo" style="color: white; margin-bottom: 5rem;">
                '.$subcategoria['nombre_subcategoria'].'
            </h2>

            <div id="carrousel_productos" class="owl-carousel owl-theme">
        ';

        $productos = ControladorProductos::traerProductosCtr();
        $productos[] = array();
        foreach ($productos as $producto) {

            //$id = $producto['curso_id'];
            $id = '1';
            //$nombre = $producto['curso_nombre'];
            $nombre = 'Etiqueta 8cm x 8cm';
            //$img = $producto['curso_Imagenmain'];
            $img = 'imagenes/General/cuadrada/2.png';

            $nombre = $titulo_producto;
            $img = $imagen_producto;

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

        echo '
        </div>
    </div>
    ';
}

echo '
</div>
';
?>

        
</div>


<div class="contenedor-regular" style="margin: 150px 0;">
    <img class="fondo_vector_azul" src="imagenes/Vectores/3.png" alt="">

    <h2 class="titulo">
        Algunos de nuestros clientes
    </h2>
    <div class="subcontenedor" style="margin-top: 5rem;">

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
        $('#carrousel_clientes, #carrousel_productos').owlCarousel({
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