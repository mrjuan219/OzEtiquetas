<footer id="footer">
    <div class="contenedor_formulario_contacto" id="contenedorContacto" data-aos="fade-right" data-aos-delay="0">
        <h3 class="titulo" data-aos="fade-up" data-aos-delay="100">
            Contáctanos
        </h3>

        <div class="contenedor_formulario registro"  data-aos="fade-left" data-aos-delay="200">

            <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
            <script>
                hbspt.forms.create({
                    portalId: "9263024",
                    formId: "1f0d1b3e-6300-4f92-8772-fa4496446255"
                });
            </script>

        </div>


    </div>

    <div class="contenedor_mapa" data-aos="fade-up" data-aos-delay="100">
        <div class="mapa">
            <div id="map"></div>
        </div>

        <div class="contenedor_datos_contacto">
            <div class="fila" data-aos="fade-up" data-aos-delay="100">
                <i class="fa fa-phone"></i>
                &nbsp;
                &nbsp;
                <p class="pointer" onclick="window.location.href='tel:3336758864'">33 3675 8864</p>
            </div>
            <div class="fila" data-aos="fade-up" data-aos-delay="400">
                <i class="fa fa-envelope"></i>
                &nbsp;
                &nbsp;
                <p class="pointer" onclick="window.location.href='mailto: informes@ozetiquetas.com'">informes@ozetiquetas.com</p>
            </div>
        </div>
    </div>

</footer>
<div class="banner">
    <p  data-aos="fade" data-aos-offset="-70">
        <?php echo $_SESSION['nombreEmpresa'] ?> 2020 &copy; | Aviso de privacidad <b href="assets/pdf/Aviso de Privacidad Química Boss.pdf" download="Aviso de Privacidad Química Boss.pdf"> | Políticas de Calidad</b>
    </p>
</div>

<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/9263024.js"></script>
<!-- End of HubSpot Embed Code -->

<script>
    $(document).ready(function() {
        setTimeout(() => {
            $('#hs-form-iframe-0').contents().find('.hubspot-link__container.sproket').empty();
            $('#hs-form-iframe-0').contents().find('.hubspot-link__container.sproket').remove();
            var iframe = $('#hubspot-messages-iframe-container iframe')[0]
            $(iframe).attr('id', 'iframe_chatbot')

            $('#iframe_chatbot').contents().find('.m-bottom-2.align-center.justify-center').remove();
            console.log($('#iframe_chatbot'))
        }, 2000);

        $('.divespacioparamenublanco').css('height', $('#navbar').outerHeight());
        $('.ancla').css('margin-top', $('#navbar').outerHeight() / -1);

        initMap();
    });

    var map;

    var centrodelmapa;
    var zoom;
    var w = window.innerWidth;
    if (w < 940) {
        zoom = 10;
        centrodelmapa = {
            lat: 20.601319300000032,
            lng: -103.3536597066361
        };
    } else {
        zoom = 10;
        centrodelmapa = {
            lat: 20.601319300000032,
            lng: -103.3536597066361
        };
    }

    var iconBase = 'imagenes/Iconos/';


    function initMap() {

        // Create a new StyledMapType object, passing it an array of styles,
        // and the name to be displayed on the map type control.

        <?php include 'estilos_mapa.php'; ?>

        map = new google.maps.Map(document.getElementById('map'), {
            center: centrodelmapa,
            zoom: zoom,
            streetViewControl: false,
            mapTypeControl: false,
        });

        <?php
        $sucursales = modelo_productos::traerMdl('sucursales', 'INNER JOIN usuarios WHERE usuarios.id_sucursal = sucursales.id');
        $contador = 0;
        foreach ($sucursales as $sucursal) {
            //print_r($sucursal);
            $id = $sucursal['id_sucursal'];
            $nombre = $sucursal['nombre_sucursal'];
            $direccion = $sucursal['direccion'];
            $latitud = $sucursal['latitud'];
            $longitud = $sucursal['longitud'];
            $telefono = $sucursal['telefono'];
            $contador++;

            echo "
                var direccion$contador = {
                    lat: $latitud,
                    lng: $longitud
                };
        
                var Ventanadir$contador = '<div id=\"content\"><div id=\"siteNotice\"></div>'+
                '<div id=\"bodyContent\" style=\"text-align: center;\">'+
                    '<center>'+
                        '<b>$nombre</b>'+
                    '</center>'+
                    '<br>'+
                    '$direccion '+
                    '<center>'+
                        '<a href=\"https://www.google.com/maps/place/$latitud,$longitud\">Ver en Google Maps</a>'+
                        '<br><br> Tel: $telefono<br> <a href=\"tel:$telefono\">Llamar a la sucursal</a>'+
                    '</center>'+
                '</div></div>';
        
                var ventadeinfo$contador = new google.maps.InfoWindow({
                    content: Ventanadir$contador,
                    maxWidth: 300
                });
        
        
                var marker$contador = new google.maps.Marker({
                    position: direccion$contador,
                    map: map,
                    icon: iconBase + 'Iconos_mapa.png'
                });
        
                marker$contador.addListener('click', function() {
                    ventadeinfo$contador.open(map, marker$contador);
                });
        
                ";
        }
        ?>

        //Associate the styled map with the MapTypeId and set it to display.
        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');

    }
</script>


<!-- Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <div class="modal-body mx-14">

                <button class="cerrar_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>

                <h3 class="modal-title w-100 letra_azul titulo_modal">
                    Iniciar sesión
                </h3>

                <div class="contenedor_formulario login">
                    <label for="usuario">
                        Usuario
                    </label>
                    <input type="text" placeholder="Introduce tu usuario" id="usuario">
                    <label for="contraseña">
                        Contraseña
                    </label>
                    <input type="password" placeholder="*******" id="contraseña">
                </div>


                <div class="text-center mb-3">
                    <button onclick="iniciarSesion()" id="login" type="button" class="boton rojo">Iniciar Sesión</button>
                </div>

                <div class="opciones-login">
                    <p onclick="contraseñaOlvidada()">¿Usuario o contraseña olvidada?</p><b>|</b>
                    <p onclick="modalReigstro()">Crear cuenta</p>
                </div>

            </div>

        </div>
        <!--/.Content-->
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <div class="modal-body mx-14">

                <button class="cerrar_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>

                <h3 class="modal-title w-100 letra_azul titulo_modal">
                    Registrarse
                </h3>

                <div class="contenedor_formulario registro parte1">

                    <label for="usuarioRegistro">
                        Usuario
                    </label>
                    <input type="text" placeholder="Introduce tu nombre de usuario" id="usuarioRegistro">

                    <label for="correoRegistro">
                        Correo
                    </label>
                    <input type="mail" placeholder="Introduce tu correo" id="correoRegistro">

                </div>

                <div style="display: none;" class="contenedor_formulario registro parte2">

                    <label for="apodoRegistro">
                        Apodo
                    </label>
                    <input type="text" placeholder="Introduce tu apodo" id="apodoRegistro">

                    <label for="nombreRegistro">
                        Nombre Completo
                    </label>
                    <input type="tel" min="0" placeholder="Introduce tu nombre" id="nombreRegistro">

                    <label for="telefonoRegistro">
                        Telefono
                    </label>
                    <input type="tel" min="0" placeholder="Introduce tu telefono" id="telefonoRegistro">

                    <label for="contraseña">
                        Contraseña
                    </label>
                    <input type="password" placeholder="*******" id="contraseñaRegistro">

                </div>


                <div onclick="verificarDisponibilidad()" class="text-center mb-3 parte1">
                    <button id="verificarDisponibilidad" type="button" class="boton rojo">Verificar</button>
                </div>

                <div onclick="registrarse()" style="display: none;" class="text-center mb-3 parte2">
                    <button id="registro" type="button" class="boton rojo">Registrarse</button>
                </div>

                <div class="opciones-login" onclick="modalLogin()">
                    <p>Iniciar sesion</p>
                </div>

            </div>

        </div>
        <!--/.Content-->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <div class="modal-body mx-14">

                <button class="cerrar_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>

                <h3 class="modal-title w-100 letra_azul titulo_modal principal">
                    Nueva categoría
                </h3>

                <div class="contenedor_formulario registro">

                    <label for="categoriaRegistro">
                        Nombre
                    </label>
                    <input type="text" placeholder="Introduce el nombre de la categoria" id="categoriaRegistro">

                    <label for="categoriaRegistro">
                        Palabras clave
                    </label>
                    <textarea id="textosRegistro"></textarea>

                    <div id="contenedorCargaCategoria" class="form-group contenedor_carga_categoria">
                        <input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
                        <label for="img_categoria_input">Seleccione una imagen para representar su categoria</label>
                        <div class="custom-file">
                            <input name="img_categoria" type="file" class="custom-file-input" class="form-control-file" id="img_categoria_input">
                            <label class="custom-file-label" for="customFile">Elegir archivo</label>
                        </div>
                        <div class="prev" id="preview_categoria"></div>
                    </div>

                    <select id="categoriaRegistrosub" class="form-control" style="display: none;">
                        <option selected disabled value="">Selecciona una opcion</option>
                        <?php
                        $respuesta = ControladorServicios::traerCategoriasCtr();
                        print_r($respuesta);
                        foreach ($respuesta as $categoria) {
                            $id = $categoria['id'];
                            $nombre = $categoria['nombre_categoria'];
                            echo "
                                        <option value='$id'>$nombre</option>
                                    ";
                        }
                        ?>
                    </select>

                </div>

                <div class="d-flex" style="justify-content: space-around;">
                    <div onclick="switchCategoriasModal()" class="text-center mb-3">
                        <button id="switchCategoriasBoton" type="button" class="boton rojo">Gestionar Subcategorias</button>
                    </div>

                    <div onclick="registrarCategoria()" class="text-center mb-3">
                        <button id="registrarCategorias" type="button" class="boton rojo">Registrar categoria</button>
                    </div>

                    <div onclick="registrarSubCategoria()" class="text-center mb-3" style="display: none;">
                        <button id="registrarSubcategorias" type="button" class="boton rojo">Registrar Subcategoria</button>
                    </div>
                </div>
                <div class="limiter contenedor_tabla" id="contenedor_tabla_categorias">
                    <div class="container-table100">
                        <div class="wrap-table100">
                            <h3 class="titulo_modal">Gestión de Categorias</h3>
                            <div class="table" id="categoriasTabla">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="limiter contenedor_tabla" id="contenedor_tabla_subcategorias" style="display: none;">
                    <div class="container-table100">
                        <div class="wrap-table100">
                            <h3 class="titulo_modal">Gestión de Subcategorias</h3>
                            <div class="table" id="subcategoriasTabla">
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    (function($) {
                        "use strict";
                    })(jQuery);
                </script>


            </div>

        </div>
        <!--/.Content-->
    </div>
</div>

<div id="modalEspera" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal_espera_contenedor">
        <div class="modal-content" style="width: auto; border: none;">
            <span class="fa fa-spinner fa-spin fa-8x"></span>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalServicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <div class="modal-body mx-14">

                <button class="cerrar_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>

                <h3 class="modal-title w-100 letra_azul titulo_modal">
                    Nuevo Servicio
                </h3>

                <div class="contenedor_formulario servicio registro paso1Servicio">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <label for="nombreServicio">
                                Nombre del servicio
                            </label>
                            <input type="text" placeholder="Introduce el nombre de tu servico" id="nombreServicio">
                        </div>
                    </div>

                    <div class="d-flex col-lg-12">
                        <div class="col-lg-6">
                            <label for="paisServicio">
                                País
                            </label>
                            <select name="paises" id="paisServicio" class="form-control" onchange="traerEstados(this.value)">
                                <option selected value="MX">México</option>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label for="estadoServicio">
                                Estado
                            </label>
                            <select name="estadoServicio" id="estadoServicio" class="form-control" onchange="traerMunicipios(this.value)">
                                <option disabled selected value="">Selecciona un estado</option>
                                <?php
                                $respuesta = ControladorServicios::traerEstadosCtr('MX');
                                foreach ($respuesta as $estado) {
                                    $id = $estado['id'];
                                    $nombre = $estado['estado'];
                                    echo "
                                <option value='$id'>$nombre</option>
                                ";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <label for="municipioRegistro">
                                Municipio
                            </label>
                            <select name="municipioRegistro" id="municipioRegistro" class="form-control">
                                <option disabled selected value="">Selecciona un municipio</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12" id="direcionContenedorRegistro">
                        <div class="col-lg-12">
                            <label for="direccionServicio">
                                Dirección
                            </label>
                            <input placeholder="Dirección donde se ofrece el servicio" id="direccionServicio" onkeyup="actualizarValueAddress(this.value)">

                        </div>

                        <div class="col-lg-12">
                            <div id="floating-panel">
                                <input id="address" type="textbox" value="" />
                                <input class="boton rojo" id="submit" type="button" value="Buscar Direccion" />
                            </div>
                            <div id="map"></div>
                        </div>

                        <div style="display: flex; flex-wrap: wrap" class="col-lg-12">
                            <div class="col-lg-12">
                                <label for="direccionCompletaRegistro">
                                    Dirección
                                </label>
                                <input placeholder="Busca la direccion primero" disabled type="text" id="direccionCompletaRegistro">
                            </div>
                            <div class="col-lg-6">
                                <label for="latitudRegistro">
                                    Latitud
                                </label>
                                <input placeholder="Latitud no disponible" disabled type="text" id="latitudRegistro">
                            </div>
                            <div class="col-lg-6">
                                <label for="longitudRegistro">
                                    Longitud
                                </label>
                                <input placeholder="Latitud no disponible" disabled type="text" id="longitudRegistro">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <label for="facebookServicio">
                                Facebook
                            </label>
                            <input placeholder="Introduce tu link de facebook" type="text" id="facebookServicio">
                        </div>

                        <div class="col-lg-12">
                            <label for="whatsappServicio">
                                Whatsapp
                            </label>
                            <input placeholder="Introduce tu numero de whatsapp" type="text" id="whatsappServicio">
                        </div>

                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <label for="descripcionServicio">
                                Descripcion
                            </label>
                            <input placeholder="Introduce tu descripcion" id="descripcionServicio">
                        </div>
                    </div>

                    <div class="d-flex col-lg-12">
                        <div class="col-lg-6">
                            <label for="categoriaServicio">
                                Categoria
                            </label>
                            <select name="categoria" id="categoriaServicio" class="form-control" onchange="traerSubCategorias(this.value)">
                                <option selected disabled value="">Selecciona una opcion</option>
                                <?php
                                $respuesta = ControladorServicios::traerCategoriasCtr();
                                print_r($respuesta);
                                foreach ($respuesta as $categoria) {
                                    $id = $categoria['id'];
                                    $nombre = $categoria['nombre_categoria'];
                                    echo "
                                        <option value='$id'>$nombre</option>
                                    ";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label for="subcategoriaServicio">
                                Sub-categoria
                            </label>
                            <select name="subcategoriaServicio" id="subcategoriaServicio" class="form-control">
                                <option selected disabled value="">Selecciona una opcion</option>

                            </select>
                        </div>
                    </div>

                </div>

                <div class="contenedor_formulario servicio registro paso2Servicio" style="display: none;">
                    <div id="contenedorCarga" class="form-group contenedor_carga">
                        <input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
                        <label for="formArchivo">Seleccione la imagen principal para representar su servicio</label>
                        <div class="custom-file">
                            <input name="uploadedfile[1]" type="file" class="custom-file-input" class="form-control-file" id="formArchivo1">
                            <label class="custom-file-label" for="customFile">Elegir archivo</label>
                            <input class="form-control" name="descripcion-img1" id="descripcion-img1" placeholder="Introduce una descripción para tu imagen">
                        </div>
                        <div class="prev" id="preview1"></div>

                        <button onclick="agregarInput()" id="btn1" type="button" class="boton rojo mt-3">Agregar más imagenes</button>
                        <button style="display: none;" onclick="subirImagen()" id="insertarImagen" type="button" class="boton rojo mt-3">Agregar imagen</button>
                    </div>

                    <div id="contenedor_imagenes_editar">

                    </div>



                </div>

                <div class="contenedor-botones" id="botonesRegistro" style="display: none;">

                    <div onclick="segundoPasoRegistroServicio()" class="text-center mb-3 paso1Servicio">
                        <button type="button" class="boton rojo">Siguiente</button>
                    </div>

                    <div onclick="primerPasoRegistroServicio()" class="text-center mb-3 paso2Servicio" style="display: none;">
                        <button type="button" class="boton rojo">Regresar</button>
                    </div>

                    <div onclick="registrarServicio()" class="text-center mb-3 paso2Servicio" style="display: none;">
                        <button id="registrarServicio" type="button" class="boton rojo">Crear servicio</button>
                    </div>

                </div>

                <div class="contenedor-botones" id="botonesActualizar" style="display: none;">

                    <input type="text" hidden id="idServicio">

                    <div onclick="actualizarServicio()" class="text-center mb-3">
                        <button id="servicioEditar" type="button" class="boton rojo">Actualizar servicio</button>
                    </div>

                    <div onclick="segundoPasoEditarServicio()" class="text-center mb-3">
                        <button id="servicioEditarImg" type="button" class="boton rojo">Editar imagenes</button>
                    </div>

                    <div style="display: none;" onclick="primerPasoEditarServicio()" class="text-center mb-3">
                        <button id="regresarEditar" type="button" class="boton rojo">Regresar</button>
                    </div>

                </div>

            </div>

        </div>
        <!--/.Content-->
    </div>
</div>