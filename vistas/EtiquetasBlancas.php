<div class="contenedor_principal_header">
    <!-- 
        <img src="imagenes/Sliders/9.png" alt="">
    -->
    <video preload="none" playsinline muted loop autoplay src="imagenes/videos/oz4.mp4"></video>
    <div class="fondo_negro"></div>
    <div class="subcontenedor">
        <div class="izquierda">
            <img src="imagenes/General/cuadrada/inicio.png" alt="">
        </div>
        <div class="derecha">
            <h4 class="titulo">Contamos</h4>
            <p>
                Con una amplia gama de etiquetas blancas listas para impresión
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
                En oz etiquetas contamos con una amplia gama de Etiquetas Blancas y Ribbones listas delete general. 
            </p>
<br><br>
            <div class="boton rojo">
                Más información
            </div>
        </div>

        <div class="derecha">
            <img src="imagenes/General/cuadrada/5.png" alt="">
        </div>
    </div>

</div>

<div class="contenedor-regular">
	
	<h2 class="subtitulodefontex">
        Papeles
    </h2>
    <div class="subcontenedor">

        <div id="owl-visita3" class="owl-carousel owl-theme">
			
			<div class="item" onClick="deplegarquienvisita3(1)">
                    <img src="./imagenes/General/agronomiasec.png">
                    <p class="pdeseccioncarrusel" style="text-align: center;">COUCHE SATIN</p>
                    <div class="boton rojo " style="width: 100%;">Más información</div>
                </div>
			<div class="item" onClick="deplegarquienvisita3(2)">
                    <img src="./imagenes/General/termica.jpg">
                    <p class="pdeseccioncarrusel" style="text-align: center;">TRANSFERENCIA TERMICA</p>
                    <div class="boton rojo " style="width: 100%;">Más información</div>
                </div>
			<div class="item" onClick="deplegarquienvisita3(3)">
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
		
		function verformulario3(){
			$('#desplegarquienvisita3').fadeOut();
			hacerscroll('#footer');
		}
		
		function deplegarquienvisita3(id){
			var titulo;
			var descripcion;
			var imagen;
			if(id==1){
				titulo = "COUCHE SATIN";
				descripcion = "Es un papel que ofrece una blancura excepcional, su doble recubrimiento superficial le brinda su apariencia y acabado. Diseñado para ofrecer propiedades de impresión de alta calidad y definición que resaltan las imágenes de los gráficos impresos.";
				imagen = "./imagenes/General/agronomiasec.png";
			}
			if(id==2){
				titulo = "TRANSFERENCIA TERMICA";
				descripcion = "Es un tipo de papel utlizado para la alta calidad de impresión a travez de un ribbon, para un mejor control e identificacion de tus productos. Adecuadas para etiquetado de larga duracion. ";
				imagen = "./imagenes/General/termica.jpg";
			}
			if(id==3){
				titulo = "TERMICO DIRECTO";
				descripcion = "Tipo de material diseñado para la impresión termica directa que se realiza cuando el cabezal de la impresora entra en contacto directo con la etiqueta, ya que el propio material esta tratatado para producir la impresión al aplicarsele calor. Diseñado para aplicaciones de trazabilidad de empaques mediante codigos de barra.";
				imagen = "./imagenes/General/termicodirecto.jpg";
			}
			
			document.getElementById("titulosquienvista3").innerHTML = titulo;
			document.getElementById("textosdecripcion3").innerHTML = descripcion;
			document.getElementById("imagendefondovisita3").src = imagen;
			$('#desplegarquienvisita3').fadeIn();
			
		}
		function cerrarsecciondepaleles(){
			$('#desplegarquienvisita3').fadeOut();
		}
		
		
		$(document).ready(function() {
			$('#owl-visita3').owlCarousel({
				loop: true,
				margin: 80,
				dotsEach:true,
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
			
			<div class="item" onClick="deplegarquienvisita4(1)">
                    <img src="./imagenes/General/BOPP.jpg">
                    <p class="pdeseccioncarrusel" style="text-align: center;">BOPP(polipropileno)</p>
                    <div class="boton rojo " style="width: 100%;">Más información</div>
                </div>
			<div class="item" onClick="deplegarquienvisita4(2)">
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
		
		function verformulario4(){
			$('#desplegarquienvisita4').fadeOut();
			hacerscroll('#footer');
		}
		
		function deplegarquienvisita4(id){
			var titulo;
			var descripcion;
			var imagen;
			if(id==1){
				titulo = "BOPP(polipropileno)";
				descripcion = "Materiales diseñados especiales para utlizar en etiquetas de imagen para producto o trazabilidad con diferentes condiciones de uso. Se caracteriza principalmete por la rigidez, alta resistencia a la traccion, excelente optica y excelentes propiedades de barrera de agua.";
				imagen = "./imagenes/General/BOPP.jpg";
			}
			if(id==2){
				titulo = "POLIETILENO";
				descripcion = "Especialidad de material desarrollada en conjunto con nuestros colaboradores de materia prima, el cual tiene un gran crecimiento de consumo en el sector agricola, sobre todo en los empaques de aguacate debido su gran adherencia y resistencia en el fruto y su gran facilidad de manejo en etiquetadores automáticos.";
				imagen = "./imagenes/General/Polietileno.jpg";
			}
			
			document.getElementById("titulosquienvista4").innerHTML = titulo;
			document.getElementById("textosdecripcion4").innerHTML = descripcion;
			document.getElementById("imagendefondovisita4").src = imagen;
			$('#desplegarquienvisita4').fadeIn();
			
		}
		function cerrarseccionPelículas(){
			$('#desplegarquienvisita4').fadeOut();
		}
		
		
		$(document).ready(function() {
			$('#owl-visita4').owlCarousel({
				loop: true,
				margin: 80,
				dotsEach:true,
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
			
			<div class="item" onClick="deplegarquienvisita5(1)">
                    <img src="./imagenes/General/RIBBON.jpg">
                    <p class="pdeseccioncarrusel" style="text-align: center;">RIBBON CERA</p>
                    <div class="boton rojo " style="width: 100%;">Más información</div>
                </div>
			<div class="item" onClick="deplegarquienvisita5(2)">
                    <img src="./imagenes/General/RIBBON2.jpg">
                    <p class="pdeseccioncarrusel" style="text-align: center;">RIBBON RESINA</p>
                    <div class="boton rojo " style="width: 100%;">Más información</div>
                </div>
			<div class="item" onClick="deplegarquienvisita5(3)">
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
		
		function verformulario5(){
			$('#desplegarquienvisita5').fadeOut();
			hacerscroll('#footer');
		}
		
		function deplegarquienvisita5(id){
			var titulo;
			var descripcion;
			var imagen;
			if(id==1){
				titulo = "RIBBON CERA";
				descripcion = "El ribbon de cera está elaborado por un compuesto de ceras y una base de poliéster, y es perfecto para la impresión de etiquetas comunes.<br>La impresión presenta menor duración y resistencia que otros tipos, y es adecuado para imprimir material de papel couché o mate, o para aquellas etiquetas que no vayan a sufrir roces o inclemencias ambientales.<br>Por otro lado, necesita menos temperatura que otros tipos de ribbon para adherirse a la etiqueta.";
				imagen = "./imagenes/General/RIBBON.jpg";
			}
			if(id==2){
				titulo = "RIBBON RESINA";
				descripcion = "Está elaborado a partir de dos o más capas de un compuesto con un alto porcentaje de resinas, y una base de poliéster.<br>Y se suele utilizar para aplicaciones especiales, en etiquetas que vayan a estar muy expuestas, en entornos muy agresivos y que, por tanto, necesiten aguante ante las inclemencias climáticas, fricciones, así como productos químicos o alcoholes.<br>Además, aporta una gran calidad de impresión, y es ideal para superficies plásticas o sintéticas, y de alto brillo. ";
				imagen = "./imagenes/General/RIBBON2.jpg";
			}
			if(id==3){
				titulo = "RIBBON MIXTO (CERA-RESINA)";
				descripcion = "se combina una proporción de ceras y resinas. Ofrecen una durabilidad mayor que los ribbons de cera, y mayor resistencia, pero sin llegar a la calidad del ribbon de resina.";
				imagen = "./imagenes/General/RIBBON.jpg";
			}
			
			document.getElementById("titulosquienvista5").innerHTML = titulo;
			document.getElementById("textosdecripcion5").innerHTML = descripcion;
			document.getElementById("imagendefondovisita5").src = imagen;
			$('#desplegarquienvisita5').fadeIn();
			
		}
		function cerrarseccionderibon(){
			$('#desplegarquienvisita5').fadeOut();
		}
		
		
		$(document).ready(function() {
			$('#owlderibbon').owlCarousel({
				loop: true,
				margin: 80,
				dotsEach:true,
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
				dotsEach:true,
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