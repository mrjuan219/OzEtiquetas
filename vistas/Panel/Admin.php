<?php
if($_SESSION['perfil'] == 'Comun'){
    echo '
    <script>
        window.location.search="?ruta=MisAnuncios";
    </script>
    ';
    exit();
}
    ?>

<script>

function geocodeAddress(geocoder, resultsMap) {
const address = document.getElementById("address").value;
geocoder.geocode({
    address: address
}, (results, status) => {
    
    var error;

    if (status === "OK") {
        resultsMap.setCenter(results[0].geometry.location);
        new google.maps.Marker({
            map: resultsMap,
            position: results[0].geometry.location,
        });
    } else {
        if(status == 'UNKNOWN_ERROR'){
            error = 'hubo un error desconocido'

        }else if(status == 'INVALID_REQUEST'){
            error = 'la petición es invalida'

        } else if(status == 'REQUEST_DENIED'){
            error = 'se denegó la peticion'

        }else if(status == 'OVER_DAILY_LIMIT'){
            error = 'Se ha excedido el limite diario de busquedas'

        }else if(status == 'ZERO_RESULTS'){
            error = 'no hay resultados disponibles'

        }else if(status == 'OVER_QUERY_LIMIT'){
            error = 'se excedieron la cantidad de peticiones permitidas'
        }

        Swal.fire('Error', "No se encontró la ubicación: "+ address + ' debido a que ' + error, 'error');

        //console.log(error)
        //console.log(status)
    }


    var direccion = results[0]['address_components'][1]['long_name'] + ' ' + results[0]['address_components'][0]['long_name'] + ', ' + results[0]['address_components'][2]['long_name'];

    var latitud = results[0]['geometry']['location']['lat'];
    var longitud = results[0]['geometry']['location']['lng'];

    $('#direccionCompletaRegistro').val(direccion);
    $('#latitudRegistro').val(latitud);
    $('#longitudRegistro').val(longitud);
});
}
</script>
  
<div class="contenedor_anuncio fondo_rayas">
    <div class="subcontenedor_anuncio">
        <h3>
            <b>
                Bienvenido al Panel
            </b>
            <br>
            <em>
                Administrativo
            </em>
        </h3>
        <div class="boton naranja scroll" onclick="hacerscroll('#tablaGestion')">
            Administrar Anuncios
        </div>
    </div>
    <img loading="lazy" src="imagenes/Sliders/5.png" alt="Imagen">
</div>

<div class="limiter contenedor_tabla" id="tablaGestion">
    <div class="container-table100 fondo_rayas">
        <div class="wrap-table100">
            <h3>Gestión de servicios</h3>
            <div class="table">

                <div class="row header">
                    <div class="cell">
                        Nombre
                    </div>
                    <div class="cell">
                        Vistas
                    </div>
                    <div class="cell">
                        Titulo Anuncio
                    </div>
                    <div class="cell">
                        Ubicación
                    </div>
                    <div class="cell">
                        Estatus
                    </div>

                    <div class="cell">
                        Opciones
                    </div>
                </div>

                <?php
                    $servicios = ControladorServicios::traerServiciosCtr();
                    //print('<pre>'.print_r($servicios, true).'</pre>');
                    foreach($servicios AS $servicio){
                        
                        if($servicio['vistas'] == ''){
                            $servicio['vistas'] = 0;
                        }                        
                        if($servicio['estatus'] == '0'){
                            $estatusTexto = 'No publicado';
                            $color = 'danger';
                        }else{
                            $estatusTexto = 'Publicado';
                            $color = 'success';
                        }
                        if($servicio['recomendado'] == '0'){
                            $recomendadoTexto = '<i class="fa fa-times" aria-hidden="true"></i>';
                            $recomendadoColor = 'danger';
                        }else{
                            $recomendadoTexto = '<i class="fa fa-star" aria-hidden="true"></i>';
                            $recomendadoColor = 'success';
                        }
                        
                        echo '
                        <div class="row">
                            <div class="cell texto-ellipsis nombre" data-title="Nombre Completo">
                                '.$servicio['nombre'].'
                            </div>
                            <div class="cell" data-title="Vistas">
                                '.$servicio['vistas'].'
                            </div>
                            <div class="cell texto-ellipsis" data-title="Titulo del servicio">
                                '.$servicio['titulo'].'
                            </div>
                            <div class="cell" data-title="Ubicacion">
                                '.$servicio['municipio'].", ".$servicio['estado'].", ".$servicio['pais'].'
                            </div>
                            <div class="cell">
                                <button id="botonPublicar'.$servicio['id'].'" onclick="publicar('.$servicio['estatus'].', '.$servicio['id'].')" class="btn btn-'.$color.'">
                                    '.$estatusTexto.'
                                </button>
                                <button id="botonRecomendado'.$servicio['id'].'" onclick="recomendar('.$servicio['recomendado'].', '.$servicio['id'].')" class="btn btn-'.$recomendadoColor.'">
                                    '.$recomendadoTexto.'
                                </button>
                            </div>
                            <div class="cell">
                                <button onclick="editarServicio('."'".$servicio['id']."'".')" class="btn btn-primary">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                                <button onclick="eliminarServicio('."'".$servicio['id']."'".')" class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                                <button onclick="window.location.search='."'"."?ruta=Articulo&id=".$servicio['id']."'".'" class="btn btn-info">
                                    <i class="fa fa-eye" aria-hidden="true"></i>  
                                </button>
                            </div>
                        </div>
                        ';
                    }
                ?>

            </div>
        </div>
    </div>
</div>

<script>
    (function($) {
        "use strict";
    })(jQuery);
</script>