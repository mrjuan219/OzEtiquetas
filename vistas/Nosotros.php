<div class="contenedor_principal_header">
    <!-- 
        <img src="imagenes/Sliders/12.png" alt="">
    -->
    <video preload="none" playsinline muted loop autoplay src="imagenes/videos/oz2.mp4"></video>
    <div class="fondo_negro"></div>

    <div class="subcontenedor">
        <div class="izquierda" data-aos="fade-right" data-aos-delay="300">
            <img hidden src="imagenes/General/cuadrada/nosotros.png" alt="">
        </div>
        <div class="derecha" data-aos="fade-left" data-aos-delay="300">
            <h4 class="titulo" data-aos="fade-up" data-aos-delay="300">Expertos</h4>
            <p>
                En todo tipo de impresión de etiquetas con más de 15 años de Experiencia
            </p>
            <div class="boton rojo" onclick="hacerscroll('#footer')">
                Contáctanos
            </div>
        </div>
    </div>
</div>

<div class="contenedor-regular">

    <div class="vector_superior_derecha"></div>

    <h2 class="titulo" data-aos="fade-up" data-aos-delay="100">
        ¿QUÍENES SOMOS?
    </h2>

    <div class="subcontenedor">
        <div class="izquierda" data-aos="fade-right" data-aos-delay="100">
            <p>
                En OZ ETIQUETAS SA de CV somos una empresa de origen familiar con mas de 15 años de experiencia en el mercado, especializados y dedicados a la FABRICACIÓN e impresion de etiqueta autoadherible con la mejor calidad y servicio.
            </p>

            <div class="boton rojo" data-aos="fade-up" data-aos-delay="400">
                Más información
            </div>
        </div>

        <div class="derecha" data-aos="fade-left" data-aos-delay="100">
            <img src="imagenes/General/cuadrada/nostros.png" alt="">
        </div>
    </div>

</div>


<div class="contenedor-regular" style="margin: 150px 0;">
    <?php
    $tipo = ControladorUsuario::detectarTipoDispositivo();
    if ($tipo == 'movil') {
        echo '
        <img style="height: 240%; top: 50%;" class="fondo_vector_azul" src="imagenes/Vectores/2.png" alt="">
        ';
    } else {
        echo '
        <img class="fondo_vector_azul" src="imagenes/Vectores/4.png" alt="">
        ';
    }
    ?>

    <div class="subcontenedor" style="width: 100%;">
        <div class="izquierda">
            <img class="icono" src="imagenes/Iconos/Iconos_Mision.png" alt="" data-aos="fade-up" data-aos-delay="100">
            <h3 class="titulo text-center" data-aos="fade-up" data-aos-delay="300">Misión</h3>
            <p class="texto-blanco" data-aos="fade-up" data-aos-delay="500">Somos una compañía que ofrece soluciones flexográficas de calidad para la imagen de tu producto.</p>
        </div>

        <div class="derecha">
            <img class="icono" src="imagenes/Iconos/Iconos_Vision.png" alt="" data-aos="fade-up" data-aos-delay="100">
            <h3 class="titulo text-center" data-aos="fade-up" data-aos-delay="300">Visión</h3>
            <p class="texto-blanco" data-aos="fade-up" data-aos-delay="500">Posicionar a nivel nacional nuestros servicios de impresión y fortalecer nuestra relación de negocios con nuestros actuales y futuros socios comerciales.</p>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#carrousel_etiquetas, #carrousel_equipos').owlCarousel({
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

<div class="contenedor-regular">

    <div class="vector_superior_derecha"></div>

    <h2 class="titulo" data-aos="fade-up" data-aos-delay="100">
        POLITICA DE CALIDAD 
    </h2>

    <div class="subcontenedor">
        <div class="izquierda" data-aos="fade-right" data-aos-delay="100">
            <p>
            Nos comprometemos a ofrecer soluciones flexográficas de calidad para la imagen de tu producto mejorando continuamente nuestros procesos para lograr la satisfacción y fidelización de nuestros clientes. 
            </p>

            <div class="boton rojo" data-aos="fade-up" data-aos-delay="400">
                Más información
            </div>
        </div>

        <div class="derecha" data-aos="fade-left" data-aos-delay="100">
            <img src="imagenes/General/cuadrada/6.png" alt="">
        </div>
    </div>

</div>