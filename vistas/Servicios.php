<div class="divdemainpruincipal" style="background-image: url('imagenes/Sliders/dok-1.jpg')">

    <div class="recuadrodevideovista"></div>
    <div class="contenedor-carousel">
        <h1 class="titulo-slider bold">
            Comprometidos <br>
            con tu salud

        </h1><br>
        <div class="contenedor-botones-slider">
            Agenda tu cita

        </div>

    </div>

</div>

<!--<div class="promocionesmaindiv">
    <div class="seccionformarec" style="background: var(--verde);"></div>
    <div class="secciondescrolpromo">
        <div class="titulodeseccion">Nuestras Promociones</div>
        <div class="secciiondescroll">
            <div id="carruselpromociones" class="owl-carousel owl-theme">
                <div class="item" onClick="irpromocion()">
                    <div class="secciondeformacionpromm">
                        <div class="divimagenmain">
                            <img src="imagenes/Sliders/inicio.jpg" class="imagencubir">
                            <div class="recuadrodepromociones">50% dcto</div>
                        </div>
                        <p class="titulodepromsec">
                            Servicio: Nutrición Clínica
                        </p>
                        <div class="botondemasinformacion btnverde">Conoce más</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#carruselpromociones').owlCarousel({
                loop: true,
                margin: 80,
                nav: true,
                navText: ["<img class='flechaleft' src='imagenes/flechas/atrasblanc.png'>", "<img class='flecharight' src='imagenes/flechas/sigblanc.png'>"],
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
            })
        });
    </script>
</div>-->

<div class="contenedor-general-img-productos-servicios">
    <div class="contenedor-linea-1-productos">
        <?php
        $servicios = ControladorServicios::traerServiciosSanviteCtr();

        foreach ($servicios as $servicio) {
            echo '

				
					<div class="paracursosyser" onclick="window.location.search=' . "'" . '?ruta=Servicio&id=' . $servicio['id'] . '' . "'" . '">
						<div class="divimagenmain">
							<img src="' . $servicio['imagen_principal'] . '" class="imagencubir">
						</div>
						<p class="titulodepromsec fuentazulforzada" >
							' . $servicio['titulo'] . '
						</p>
						<div class="botondemasinformacion btnazul">Conoce más</div>
	</div>
				
				
				
                ';
        }

        ?>

    </div>
</div>

<div hidden class="contenedor_sucursales">
    <div id="agendarcita" class="ancla"></div>
    <div class="contenedor_slider_sucursales">
        <div id="owl_sucursales" class="owl-carousel owl-theme">
            <?php
            $sedes = modelo_productos::traerMdl('sucursales', 'INNER JOIN usuarios WHERE usuarios.id_sucursal = sucursales.id');

            foreach ($sedes as $sede) {
                echo '
                    <div class="item">
                        <img src="' . $sede['foto_perfil'] . '" alt="Sede Guadalajara">
                        <h3>' . $sede['nombre_sucursal'] . '</h3>
                        <p>' . $sede['direccion'] . '</p>
                    </div>
                    ';
            }
            ?>
        </div>
    </div>

    <div class="contenedor_formulario_sucursal">
        <h3>
            Agenda tu cita en una de nuestras sucursales
        </h3>


        <div class="btn" onclick="enviarCitaSede()">Confirmar</div>
    </div>

    <script>
        function resaltarCampo(elemento) {
            var valor = $(elemento).val().length;
            console.log(valor);

            if (valor > 0) {
                $(elemento).css('background-color', 'white');
            } else {
                $(elemento).css('background-color', 'rgba(255, 255, 255, 0.8');
            }
        }

        $(document).ready(function() {
            $('#owl_sucursales').owlCarousel({
                loop: true,
                margin: 80,
                nav: true,
                dotsEach: true,
                navText: ["<img class='flechaleft' src='imagenes/Iconos/flechaizg.png'>", "<img class='flecharight' src='imagenes/Iconos/flechader.png'>"],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })
        });
    </script>
</div>