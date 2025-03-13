<div class="contenedor_principal_header">
    <!-- 
        <img src="imagenes/Sliders/9.png" alt="">
    -->
    <video preload="none" playsinline muted loop autoplay src="imagenes/videos/frutas.mp4"></video>
    <div class="fondo_negro"></div>
    <div class="subcontenedor">
        <div class="izquierda">
            <!--<img src="imagenes/General/cuadrada/inicioo.png" alt="">-->
        </div>
        <div class="derecha">
            <h4 class="titulo">Automático</h4>
            <p>
                Sistema de etiquetado automático especializado para el rubro del aguacate
            </p>
            <div class="boton rojo" onclick="hacerscroll('#footer')">
                Contáctanos
            </div>
        </div>
    </div>
</div>



<div class="contenedor-regular" style="margin-bottom: 25rem;">

    <div class="vector_superior_derecha"></div>

    <h2 class="titulo">
        Etiquetadora automatica de frutos
    </h2>

    <div class="subcontenedor">
        <div class="izquierda">
            <p>
                Oz etiquetas pone a tu disposición un sistema integral y fácil de instalar en tu línea de producción para el etiquetado automático en el rubro del aguacate. Este sistema se instala y se prueba directamente a tu linea de producción, así como se brinda la capacitación integral. Únicos en México. Con soporte en rápido en toda la republica mexicana.
                <br>
                <br>
                Caracteristicas:
                <br>
                -Multi línea (1 a 20)
                <br>
                -Interfase con selecionadora
                <br>
                -Barra de confirmación de producto
                <br>
                -150 a 750 frutas por minuto
                <br>
                -Altura ajustable
                <br>
                -Etiqueta 17*24mm, 18*15mm, 24*30mm. Ect
                <br>
                -Casett intercambiables fácilmente
                <br>
                -Servicio postventa full
            </p>

            <div class="boton rojo">
                Más información
            </div>
        </div>

        <div class="derecha">
            <video preload="none" playsinline="" muted="" loop="" autoplay="" src="imagenes/videos/frutas.mp4"></video>
        </div>
    </div>

</div>


<div class="contenedor-regular" style="margin: 150px 0;">
    <img class="fondo_vector_azul" src="imagenes/Vectores/3.png" alt="">
    <video height="500" controls>
        <source src="./imagenes/videos/etiqueta.mp4" type="video/mp4">
    </video>
</div>

<div class="contenedor-regular">

    <h2 class="titulo" data-aos="fade-up" data-aos-delay="100">
        RESPALDO TECNOLÓGICO
    </h2>
    <div class="subcontenedor">

        <div id="owlclientes" class="owl-carousel owl-theme">

            <div class="item" onClick="deplegarquienvisita3(1)" data-aos="fade-up" data-aos-delay="100">
                <img src="./imagenes/clientes/1.png">
            </div>
            <div class="item" onClick="deplegarquienvisita3(1)" data-aos="fade-up" data-aos-delay="300">
                <img src="./imagenes/clientes/2.png">
            </div>
            <div class="item" onClick="deplegarquienvisita3(1)" data-aos="fade-up" data-aos-delay="500">
                <img src="./imagenes/clientes/3.png">
            </div>
            <div class="item" onClick="deplegarquienvisita3(1)" data-aos="fade-up" data-aos-delay="300">
                <img src="./imagenes/clientes/4.png">
            </div>
            <div class="item" onClick="deplegarquienvisita3(1)" data-aos="fade-up" data-aos-delay="300">
                <img src="./imagenes/clientes/5.png">
            </div>
            <div class="item" onClick="deplegarquienvisita3(1)" data-aos="fade-up" data-aos-delay="300">
                <img src="./imagenes/clientes/6.png">
            </div>
            <div class="item" onClick="deplegarquienvisita3(1)" data-aos="fade-up" data-aos-delay="300">
                <img src="./imagenes/clientes/7.png">
            </div>
            <div class="item" onClick="deplegarquienvisita3(1)" data-aos="fade-up" data-aos-delay="300">
                <img src="./imagenes/clientes/8.png">
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#owlclientes').owlCarousel({
                loop: true,
                margin: 80,
                dotsEach: true,
                nav: true,
                navText: ["<img src='imagenes/flechas/atras2.png'>", "<img src='imagenes/flechas/siguiente2.png'>"],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            })
        });
    </script>


</div>