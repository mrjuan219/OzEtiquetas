<link rel="stylesheet" href="css/tabla.panel.css">

<br><br>
<div id="contenedor_perfil_panel" class="container" style="font-size: 1.6rem; max-width: 1200px; ">
    <div class="view-account">
        <section class="module p-5">
            <div class="module-inner">

                <?php
                include "barra-lateral.php";
                ?>

                <div class="content-panel">
                    <h2 class="title">
                        Citas
                    </h2>
                    <form class="form-horizontal">
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Otras opciones</h3>
                            <div class="form-group">
                                <div class="col-md-12 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0 text-center columna_centrada">
                                    <?php
                                    if (isset($_GET['atendidas'])) {
                                        echo '
                                    <input onclick="window.location.search=' . "'" . "?ruta=Citas_panel" . "'" . '" class="btn btn-primary degradadomanetener" type="button" value="Citas pendientes" style="padding: 5px 25px">
                                    ';
                                    } else {
                                        echo '
                                    <input onclick="window.location.search=' . "'" . "?ruta=Citas_panel&atendidas=1" . "'" . '" class="btn btn-primary degradadomanetener" type="button" value="Citas atendidas" style="padding: 5px 25px">
                                    ';
                                    }
                                    ?>
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <br>
                        <fieldset class="fieldset">
                            <?php
                            if (isset($_GET['atendidas'])) {
                                echo '
                                    <h3 class="fieldset-title">Citas atendidas</h3>
                                    ';
                            } else {
                                echo '
                                    <h3 class="fieldset-title">Citas pendientes</h3>
                                    ';
                            }
                            ?>

                            <div class="limiter contenedor_tabla" id="tablaGestion">
                                <div class="container-table100">
                                    <div class="wrap-table100">
                                        <div class="table">
                                            <div class="row header degradadomanetener">
                                                <div class="cell">
                                                    Nombre
                                                </div>
                                                <div class="cell">
                                                    Telefono
                                                </div>
                                                <div class="cell">
                                                    Correo
                                                </div>
                                                <div class="cell">
                                                    Fecha
                                                </div>
                                                <div class="cell">
                                                    Hora
                                                </div>
                                                <?php
                                                if (isset($_GET['atendidas'])) {
                                                    
                                                } else {
                                                    echo '
                                                    <div class="cell">
                                                        Opciones
                                                    </div>
                                                    ';
                                                }
                                                ?>
                                                
                                            </div>

                                            <?php
                                            if (isset($_GET['atendidas'])) {
                                                $citas = modelo_productos::traerMdl('citas', 'WHERE estatus_cita = 1 ORDER BY fecha DESC');
                                            } else {
                                                $citas = modelo_productos::traerMdl('citas', 'WHERE estatus_cita = 0 ORDER BY fecha DESC');
                                            }
                                            //print('<pre>'.print_r($citas, true).'</pre>');

                                            foreach ($citas as $cita) {

                                                if($datos['id_sucursal'] > 0){
                                                    if($cita['sede'] != $datos['id_sucursal']){
                                                        continue;
                                                    }
                                                    if($datos['perfil'] != 'Admin' && $datos['perfil'] != 'Sucursal'){
                                                        continue;
                                                    }
                                                }

                                                $fecha = ucfirst(strftime("%d de %B del %Y", strtotime($cita['fecha'])));
                                                $hora = strftime("%l:%M %p", strtotime($cita['horario']));

                                                echo '
                                                <div class="row">

                                                    <div class="cell texto-ellipsis" data-title="ID cita">
                                                    ' . $cita['nombre'] . '
                                                    </div>
                                                    <div class="cell" data-title="Nombre">
                                                        ' . $cita['telefono'] . '
                                                    </div>
                                                    <div class="cell" data-title="Nombre">
                                                        ' . $cita['correo'] . '
                                                    </div>
                                                    <div class="cell" data-title="Correo" style="width: max-content;display: flex;">
                                                        ' . $fecha . '
                                                    </div>
                                                    <div class="cell" data-title="Cantidad almacen">
                                                        ' . $hora . '
                                                    </div>';
                                                
                                                    if (isset($_GET['atendidas'])) {
                                                        
                                                    } else {
                                                        echo ' 
                                                        <div class="cell">
                                                            <div onclick="marcarComoAtendida_cita(' . "'" . $cita['id'] . "'" . ')" class="btn btn-success">
                                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                            </div>
                                                            <div hidden onclick="editarcita(' . "'" . $cita['id'] . "'" . ')" class="btn btn-primary">
                                                                <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        ';
                                                    }
                                                
                                                    echo '
                                                </div>
                                                ';
                                            }
                                            ?>

                                        </div>
                                        <?php
                                        if (empty($citas)) {
                                            echo '
                                            <div class="alert alert-info text-center">
                                                No hay citas registradas aún
                                            </div>
                                            ';
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>

                            <script>
                                (function($) {
                                    "use strict";
                                })(jQuery);
                            </script>
                        </fieldset>
                        <hr>
                        <div class="form-group">
                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                <input class="btn btn-primary" type="button" value="Regresar al inicio">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>