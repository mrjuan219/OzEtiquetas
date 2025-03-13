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
                        Sucursales
                    </h2>
                    <form class="form-horizontal">
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Otras opciones</h3>
                            <div class="form-group">
                                <div class="col-md-12 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0 text-center columna_centrada">
                                    <input onclick="modalRegistroSucursal()" class="btn btn-primary degradadomanetener" type="button" value="Crear nueva sucursal" style="padding: 5px 25px">

                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <br>
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Sucursales</h3>

                            <div class="limiter contenedor_tabla" id="tablaGestion">
                                <div class="container-table100">
                                    <div class="wrap-table100">
                                        <div class="table">
                                            <div class="row header degradadomanetener">
                                                <div class="cell">
                                                    Nombre sucursal
                                                </div>
                                                <div class="cell">
                                                    Dirección
                                                </div>
                                                <div class="cell">
                                                    Horario
                                                </div>
                                                <div class="cell">
                                                    Opciones
                                                </div>
                                            </div>

                                            <?php
                                            $sucursales = modelo_productos::traerMdl('sucursales');
                                            //print('<pre>'.print_r($sucursales, true).'</pre>');

                                            foreach ($sucursales as $sucursal) {

                                                $hora_apertura = strftime("%l:%M %p", strtotime($sucursal['horario_inicio']));
                                                $hora_cierre = strftime("%l:%M %p", strtotime($sucursal['horario_fin']));

                                                echo '
                                                <div class="row">

                                                    <div class="cell texto-ellipsis" data-title="Nombre sucursal">
                                                    ' . $sucursal['nombre_sucursal'] . '
                                                    </div>
                                                    <div class="cell" data-title="Dirección">
                                                        ' . $sucursal['direccion'] . '
                                                    </div>
                                                    <div class="cell" data-title="Correo" style="width: max-content;display: flex;">
                                                        ' . $hora_apertura . " - " . $hora_cierre . '
                                                    </div>
                                                             
                                                    <div class="cell">
                                                        <div onclick="eliminarSucursal(' . "'" . $sucursal['id'] . "'" . ')" class="btn btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </div>
                                                        <div onclick="editarSucursal(' . "'" . $sucursal['id'] . "'" . ')" class="btn btn-primary">
                                                            <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                ';
                                            }
                                            ?>

                                        </div>
                                        <?php
                                        if (empty($sucursales)) {
                                            echo '
                                            <div class="alert alert-info text-center">
                                                No hay sucursales registradas aún
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