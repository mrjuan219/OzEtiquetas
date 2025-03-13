<div class="contenedor_principal_header">
	<!-- 
        <img src="imagenes/Sliders/9.png" alt="">
    -->
	<video preload="none" playsinline muted loop autoplay src="imagenes/videos/oz3.mp4"></video>
	<div class="fondo_negro"></div>
	<div class="subcontenedor">
		<div class="izquierda" data-aos="fade-right" data-aos-delay="300">
			<img src="imagenes/General/cuadrada/etiqueta.png" alt="">
		</div>
		<div class="derecha" data-aos="fade-left" data-aos-delay="300">
			<h4 class="titulo" data-aos="fade-up" data-aos-delay="300">Personalizamos</h4>
			<p>
				Personalizamos, diseñamos , producimos y entregamos tus etiquetas listas para el etiquetado de tu producto.
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
		Etiquetas personalizadas
	</h2>

	<div class="subcontenedor">
		<div class="izquierda" data-aos="fade-left" data-aos-delay="100">
			<p style="line-height: 1.5rem;">
				Trabajamos para personalizar tu etiqueta de principio a fin para poder brindarte los mejores estándares de calidad para tus productos, ya sea del rubro alimenticio o industrial , personalizamos y desarrollamos tu etiqueta a la medida.
			</p>
			<br><br>
			<div class="boton rojo" data-aos="fade-up" data-aos-delay="100">
				Contáctanos
			</div>
		</div>

		<div class="derecha" data-aos="fade-right" data-aos-delay="100">
			<img src="imagenes/General/cuadrada/nostros.png" alt="">
		</div>
	</div>

</div>


<div class="contenedor-regular imgsecazulfondo">
	<img class="fondo_vector_azul vectorazulseccionforma" src="imagenes/Vectores/2.png" alt="">

	<h2 class="titulo" style="color: white;" data-aos="fade-up" data-aos-delay="100">
		NUESTROS MERCADOS
	</h2>
	<div class="subcontenedor">

		<div id="owl-visita" class="owl-carousel owl-theme">

			<div class="item" onClick="deplegarquienvisita(1)" data-aos="fade-up" data-aos-delay="100">
				<img src="./imagenes/General/agronomiasec.png">
				<p class="pdeseccioncarrusel" style="text-align: center;">Agroindustria</p>
				<div class="boton rojo " style="width: 100%;">Más información</div>
			</div>
			<div class="item" onClick="deplegarquienvisita(2)" data-aos="fade-up" data-aos-delay="400">
				<img src="./imagenes/General/bebidas.png">
				<p class="pdeseccioncarrusel" style="text-align: center;">Alimentos y bebidas</p>
				<div class="boton rojo " style="width: 100%;">Más información</div>
			</div>
			<div class="item" onClick="deplegarquienvisita(3)" data-aos="fade-up" data-aos-delay="700">
				<img src="./imagenes/General/industrial.png">
				<p class="pdeseccioncarrusel" style="text-align: center;">Industrial</p>
				<div class="boton rojo " style="width: 100%;">Más información</div>
			</div>
			<div class="item" onClick="deplegarquienvisita(4)" data-aos="fade-up" data-aos-delay="1000">
				<img src="./imagenes/General/salud.png">
				<p class="pdeseccioncarrusel" style="text-align: center;">Salud y belleza</p>
				<div class="boton rojo " style="width: 100%;">Más información</div>
			</div>


			<?php
			//            $productos = ControladorProductos::traerProductosCtr();
			//            $productos[] = array();
			//            foreach ($productos as $producto) {
			//
			//                //$id = $producto['curso_id'];
			//                $id = '1';
			//                //$nombre = $producto['curso_nombre'];
			//                $nombre = 'Etiqueta 8cm x 8cm';
			//                //$img = $producto['curso_Imagenmain'];
			//                $img = 'imagenes/General/cuadrada/11.png';
			//
			//                echo '
			//                <div class="item" onclick="window.location.search=' . "'?Articulo&id=$id'" . '">
			//                    <img src="' . $img . '">
			//                    <p>' . $nombre . '</p>
			//                    <div class="boton rojo">Más información</div>
			//                </div>
			//                ';
			//
			//                echo '
			//                <div class="item" onclick="window.location.search=' . "'?Articulo&id=$id'" . '">
			//                    <img src="' . $img . '">
			//                    <p>' . $nombre . '</p>
			//                    <div class="boton rojo">Más información</div>
			//                </div>
			//                ';
			//
			//                echo '
			//                <div class="item" onclick="window.location.search=' . "'?Articulo&id=$id'" . '">
			//                    <img src="' . $img . '">
			//                    <p>' . $nombre . '</p>
			//                    <div class="boton rojo">Más información</div>
			//                </div>
			//                ';
			//
			//                echo '
			//                <div class="item" onclick="window.location.search=' . "'?Articulo&id=$id'" . '">
			//                    <img src="' . $img . '">
			//                    <p>' . $nombre . '</p>
			//                    <div class="boton rojo">Más información</div>
			//                </div>
			//                ';
			//            }
			//            
			?>


		</div>
	</div>
</div>
<div class="paradesplegarse" id="desplegarquienvisita" style="display: none;">
	<div class="formulariopopselectrec">
		<img src="./imagenes/cerrarventana.png" onClick="cervisita()" class="cerrarformulario">
		<div class="contenedor-img">
			<img src="img/cliente/10.jpg" id="imagendefondovisita" alt="">
		</div>
		<br><br>
		<p class="titulosmainpatrocinio" id="titulosquienvista" style="text-align: center;"></p>
		<div class="espaciodedescargar" id="textosdecripcion">
		</div>
		<div class="masinfoquienexpone" onClick="verformulario2()">Más Información</div>
	</div>
</div>

<script>
	function verformulario2() {
		$('#desplegarquienvisita').fadeOut();
		hacerscroll('#footer');
	}

	function capitalizeFirstLetter(string) {
		return string.charAt(0).toUpperCase() + string.slice(1);
	}


	function deplegarquienvisita(id) {
		var titulo;
		var descripcion;
		var imagen;
		if (id == 1) {
			titulo = "Agroindustria";
			descripcion = "Con Un Mayor Porcentaje De Nuestra Experiencia Concentrada En Este Ramo, Fabricamos Etiquetas De Alta Calidad Con Materiales Especializados Y Certificados Para Contacto Directo E Indirecto Certificados Por Fda.";
			imagen = "./imagenes/General/agronomiasec.png";
		}
		if (id == 2) {
			titulo = "Alimentos y Bebidas";
			descripcion = "Desarrollamos La  Imagen De Tu Producto Con La Mejor Calida De Impresión Y Los Mejores Materiales Acordes A La Superficie De Tu Empaque.";
			imagen = "./imagenes/General/bebidas.png";
		}
		if (id == 3) {
			titulo = "Industrial";
			descripcion = "Amplia Gama De Materiales Para Identificación Y Control De Productos A Través De Impresiones De Información.";
			imagen = "./imagenes/General/industrial.png";
		}
		if (id == 4) {
			titulo = "Salud y Belleza";
			descripcion = "";
			imagen = "./imagenes/General/salud.png";
		}

		descripcion = descripcion.toLowerCase();

		descripcion = capitalizeFirstLetter(descripcion);

		document.getElementById("titulosquienvista").innerHTML = titulo;
		document.getElementById("textosdecripcion").innerHTML = descripcion;
		document.getElementById("imagendefondovisita").src = imagen;
		$('#desplegarquienvisita').fadeIn();

	}

	function cervisita() {
		$('#desplegarquienvisita').fadeOut();
	}


	$(document).ready(function() {
		$('#owl-visita').owlCarousel({
			loop: true,
			margin: 80,
			nav: true,
			dotsEach: true,
			navText: ["<img src='imagenes/flechas/atrasblanc.png'>", "<img src='imagenes/flechas/sigblanc.png'>"],
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







<div class="contenedor-regular">

	<h2 class="titulo" data-aos="fade-up" data-aos-delay="100" data-aos="fade-up" data-aos-delay="100">
		FABRICACIÓN DE ETIQUETA CON DIFERENTES MATERIALES
	</h2>

	<h2 class="subtitulodefontex" data-aos="fade-up" data-aos-delay="100">
		Papeles
	</h2>
	<div class="subcontenedor">

		<div id="owl-visita3" class="owl-carousel owl-theme">

			<div class="item" onClick="deplegarquienvisita3(1)" data-aos="fade-up" data-aos-delay="100">
				<img src="./imagenes/General/agronomiasec.png">
				<p class="pdeseccioncarrusel" style="text-align: center;">COUCHE SATIN</p>
				<div class="boton rojo " style="width: 100%;">Más información</div>
			</div>
			<div class="item" onClick="deplegarquienvisita3(2)" data-aos="fade-up" data-aos-delay="400">
				<img src="./imagenes/General/termica.jpg">
				<p class="pdeseccioncarrusel" style="text-align: center;">TRANSFERENCIA TERMICA</p>
				<div class="boton rojo " style="width: 100%;">Más información</div>
			</div>
			<div class="item" onClick="deplegarquienvisita3(3)" data-aos="fade-up" data-aos-delay="700">
				<img src="./imagenes/General/termicodirecto.jpg">
				<p class="pdeseccioncarrusel" style="text-align: center;">TERMICO DIRECTO</p>
				<div class="boton rojo " style="width: 100%;">Más información</div>
			</div>
		</div>
	</div>
	<div class="paradesplegarse" id="desplegarquienvisita3" style="display: none;">
		<div class="formulariopopselectrec">
			<img src="./imagenes/cerrarventana.png" onClick="cerrarsecciondepaleles()" class="cerrarformulario">
			<div class="contenedor-img">
				<img src="img/cliente/10.jpg" id="imagendefondovisita3" alt="">
			</div>
			<br><br>
			<p class="titulosmainpatrocinio" id="titulosquienvista3" style="text-align: center;"></p>
			<div class="espaciodedescargar" id="textosdecripcion3">

			</div>
			<div class="masinfoquienexpone" onClick="verformulario3()">Más Información</div>
		</div>
	</div>
	<script>
		function verformulario3() {
			$('#desplegarquienvisita3').fadeOut();
			hacerscroll('#footer');
		}

		function deplegarquienvisita3(id) {
			var titulo;
			var descripcion;
			var imagen;
			if (id == 1) {
				titulo = "COUCHE SATIN";
				descripcion = "Es un papel que ofrece una blancura excepcional, su doble recubrimiento superficial le brinda su apariencia y acabado. Diseñado para ofrecer propiedades de impresión de alta calidad y definición que resaltan las imágenes de los gráficos impresos.";
				imagen = "./imagenes/General/agronomiasec.png";
			}
			if (id == 2) {
				titulo = "TRANSFERENCIA TERMICA";
				descripcion = "Es un tipo de papel utlizado para la alta calidad de impresión a travez de un ribbon, para un mejor control e identificacion de tus productos. Adecuadas para etiquetado de larga duracion. ";
				imagen = "./imagenes/General/termica.jpg";
			}
			if (id == 3) {
				titulo = "TERMICO DIRECTO";
				descripcion = "Tipo de material diseñado para la impresión termica directa que se realiza cuando el cabezal de la impresora entra en contacto directo con la etiqueta, ya que el propio material esta tratatado para producir la impresión al aplicarsele calor. Diseñado para aplicaciones de trazabilidad de empaques mediante codigos de barra.";
				imagen = "./imagenes/General/termicodirecto.jpg";
			}

			document.getElementById("titulosquienvista3").innerHTML = titulo;
			document.getElementById("textosdecripcion3").innerHTML = descripcion;
			document.getElementById("imagendefondovisita3").src = imagen;
			$('#desplegarquienvisita3').fadeIn();

		}

		function cerrarsecciondepaleles() {
			$('#desplegarquienvisita3').fadeOut();
		}


		$(document).ready(function() {
			$('#owl-visita3').owlCarousel({
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




	<h2 class="subtitulodefontex">
		Películas
	</h2>
	<div class="subcontenedor polimeros">

		<div id="owl-visita4" class="owl-carousel owl-theme">

			<div class="item" onClick="deplegarquienvisita4(1)" data-aos="fade-up" data-aos-delay="100">
				<img src="./imagenes/General/BOPP.jpg">
				<p class="pdeseccioncarrusel" style="text-align: center;">BOPP(polipropileno)</p>
				<div class="boton rojo " style="width: 100%;">Más información</div>
			</div>
			<div class="item" onClick="deplegarquienvisita4(2)" data-aos="fade-up" data-aos-delay="4 data-aos=" fade-up" data-aos-delay="100" 00">
				<img src="./imagenes/General/Polietileno.jpg">
				<p class="pdeseccioncarrusel" style="text-align: center;">POLIETILENO</p>
				<div class="boton rojo " style="width: 100%;">Más información</div>
			</div>
		</div>
	</div>
	<div class="paradesplegarse" id="desplegarquienvisita4" style="display: none;">
		<div class="formulariopopselectrec">
			<img src="./imagenes/cerrarventana.png" onClick="cerrarseccionPelículas()" class="cerrarformulario">
			<div class="contenedor-img">
				<img src="img/cliente/10.jpg" id="imagendefondovisita4" alt="">
			</div>
			<br><br>
			<p class="titulosmainpatrocinio" id="titulosquienvista4" style="text-align: center;"></p>
			<div class="espaciodedescargar" id="textosdecripcion4">

			</div>
			<div class="masinfoquienexpone" onClick="verformulario4()">Más Información</div>
		</div>
	</div>
	<script>
		function verformulario4() {
			$('#desplegarquienvisita4').fadeOut();
			hacerscroll('#footer');
		}

		function deplegarquienvisita4(id) {
			var titulo;
			var descripcion;
			var imagen;
			if (id == 1) {
				titulo = "BOPP(polipropileno)";
				descripcion = "Materiales diseñados especiales para utlizar en etiquetas de imagen para producto o trazabilidad con diferentes condiciones de uso. Se caracteriza principalmete por la rigidez, alta resistencia a la traccion, excelente optica y excelentes propiedades de barrera de agua.";
				imagen = "./imagenes/General/BOPP.jpg";
			}
			if (id == 2) {
				titulo = "POLIETILENO";
				descripcion = "Especialidad de material desarrollada en conjunto con nuestros colaboradores de materia prima, el cual tiene un gran crecimiento de consumo en el sector agricola, sobre todo en los empaques de aguacate debido su gran adherencia y resistencia en el fruto y su gran facilidad de manejo en etiquetadores automáticos.";
				imagen = "./imagenes/General/Polietileno.jpg";
			}

			document.getElementById("titulosquienvista4").innerHTML = titulo;
			document.getElementById("textosdecripcion4").innerHTML = descripcion;
			document.getElementById("imagendefondovisita4").src = imagen;
			$('#desplegarquienvisita4').fadeIn();

		}

		function cerrarseccionPelículas() {
			$('#desplegarquienvisita4').fadeOut();
		}


		$(document).ready(function() {
			$('#owl-visita4').owlCarousel({
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
						items: 2
					}
				}
			})
		});
	</script>


	<h2 class="subtitulodefontex">
		RIBBON
	</h2>
	<div class="subcontenedor">

		<div id="owlderibbon" class="owl-carousel owl-theme">

			<div class="item" onClick="deplegarquienvisita5(1)" data-aos="fade-up" data-aos-delay="100">
				<img src="./imagenes/General/RIBBON.jpg">
				<p class="pdeseccioncarrusel" style="text-align: center;">RIBBON CERA</p>
				<div class="boton rojo " style="width: 100%;">Más información</div>
			</div>
			<div class="item" onClick="deplegarquienvisita5(2)" data-aos="fade-up" data-aos-delay="400">
				<img src="./imagenes/General/RIBBON2.jpg">
				<p class="pdeseccioncarrusel" style="text-align: center;">RIBBON RESINA</p>
				<div class="boton rojo " style="width: 100%;">Más información</div>
			</div>
			<div class="item" onClick="deplegarquienvisita5(3)" data-aos="fade-up" data-aos-delay="7 data-aos=" fade-up" data-aos-delay="100" 00">
				<img src="./imagenes/General/RIBBON.jpg">
				<p class="pdeseccioncarrusel" style="text-align: center;">RIBBON MIXTO (CERA-RESINA)</p>
				<div class="boton rojo " style="width: 100%;">Más información</div>
			</div>
		</div>
	</div>
	<div class="paradesplegarse" id="desplegarquienvisita5" style="display: none;">
		<div class="formulariopopselectrec">
			<img src="./imagenes/cerrarventana.png" onClick="cerrarseccionderibon()" class="cerrarformulario">
			<div class="contenedor-img">
				<img src="img/cliente/10.jpg" id="imagendefondovisita5" alt="">
			</div>
			<br><br>
			<p class="titulosmainpatrocinio" id="titulosquienvista5" style="text-align: center;"></p>
			<div class="espaciodedescargar" id="textosdecripcion5">

			</div>
			<div class="masinfoquienexpone" onClick="verformulario5()">Más Información</div>
		</div>
	</div>
	<script>
		function verformulario5() {
			$('#desplegarquienvisita5').fadeOut();
			hacerscroll('#footer');
		}

		function deplegarquienvisita5(id) {
			var titulo;
			var descripcion;
			var imagen;
			if (id == 1) {
				titulo = "RIBBON CERA";
				descripcion = "El ribbon de cera está elaborado por un compuesto de ceras y una base de poliéster, y es perfecto para la impresión de etiquetas comunes.<br>La impresión presenta menor duración y resistencia que otros tipos, y es adecuado para imprimir material de papel couché o mate, o para aquellas etiquetas que no vayan a sufrir roces o inclemencias ambientales.<br>Por otro lado, necesita menos temperatura que otros tipos de ribbon para adherirse a la etiqueta.";
				imagen = "./imagenes/General/RIBBON.jpg";
			}
			if (id == 2) {
				titulo = "RIBBON RESINA";
				descripcion = "Está elaborado a partir de dos o más capas de un compuesto con un alto porcentaje de resinas, y una base de poliéster.<br>Y se suele utilizar para aplicaciones especiales, en etiquetas que vayan a estar muy expuestas, en entornos muy agresivos y que, por tanto, necesiten aguante ante las inclemencias climáticas, fricciones, así como productos químicos o alcoholes.<br>Además, aporta una gran calidad de impresión, y es ideal para superficies plásticas o sintéticas, y de alto brillo. ";
				imagen = "./imagenes/General/RIBBON2.jpg";
			}
			if (id == 3) {
				titulo = "RIBBON MIXTO (CERA-RESINA)";
				descripcion = "se combina una proporción de ceras y resinas. Ofrecen una durabilidad mayor que los ribbons de cera, y mayor resistencia, pero sin llegar a la calidad del ribbon de resina.";
				imagen = "./imagenes/General/RIBBON.jpg";
			}

			document.getElementById("titulosquienvista5").innerHTML = titulo;
			document.getElementById("textosdecripcion5").innerHTML = descripcion;
			document.getElementById("imagendefondovisita5").src = imagen;
			$('#desplegarquienvisita5').fadeIn();

		}

		function cerrarseccionderibon() {
			$('#desplegarquienvisita5').fadeOut();
		}


		$(document).ready(function() {
			$('#owlderibbon').owlCarousel({
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