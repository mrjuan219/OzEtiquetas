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
                        Usuarios
                    </h2>
                    <form class="form-horizontal">
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Otras opciones</h3>
                            <div class="form-group">
                                <div class="col-md-12 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0 text-center columna_centrada">
                                    <input onclick="modalRegistroAdmin()" class="btn btn-primary degradadomanetener" type="button" value="Crear nuevo usuario" style="padding: 5px 25px">

                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <br>
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Usuarios</h3>

                            <div class="limiter contenedor_tabla" id="tablaGestion">
                                <div class="container-table100">
                                    <div class="wrap-table100">
                                        <div class="table">
                                            <div class="row header degradadomanetener">
                                                <div class="cell">
                                                    ID Usuario
                                                </div>
                                                <div class="cell">
                                                    Nombre
                                                </div>
                                                <div class="cell">
                                                    Correo
                                                </div>
                                                <div class="cell">
                                                    Ultima vez
                                                </div>
                                                <div class="cell">
                                                    Opciones
                                                </div>
                                            </div>

                                            <?php
                                            $usuarios = ControladorUsuario::traerUsuariosCtr();
                                            //print('<pre>'.print_r($usuarios, true).'</pre>');

                                            foreach ($usuarios as $usuario) {

                                                if (strftime("%Y", strtotime($usuario['ultimo_login'])) == date('Y')) {
                                                    $ult_vez = ucfirst(strftime("%d de %B a las %l:%M %p", strtotime($usuario['ultimo_login'])));
                                                } else {
                                                    $ult_vez = ucfirst(strftime("%d de %B del %Y a las %l:%M %p", strtotime($usuario['ultimo_login'])));
                                                }

                                                if ($usuario['ultimo_login'] == null) {
                                                    $ult_vez = 'Nunca';
                                                }

                                                echo '
                                                <div class="row">

                                                    <div class="cell texto-ellipsis" data-title="ID Usuario">
                                                    ' . $usuario['usuario'] . '
                                                    </div>
                                                    <div class="cell" data-title="Nombre">
                                                        ' . $usuario['nombre'] . '
                                                    </div>
                                                    <div class="cell" data-title="Correo" style="width: max-content;display: flex;">
                                                        ' . $usuario['correo'] . '
                                                    </div>
                                                    <div class="cell" data-title="Ultima vez">
                                                        ' . $ult_vez . '
                                                    </div>
                                                             
                                                    <div class="cell">
                                                        <div onclick="eliminarUsuario(' . "'" . $usuario['id'] . "'" . ')" class="btn btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </div>
                                                        <div onclick="editarUsuarioPanel(' . "'" . $usuario['id'] . "'" . ')" class="btn btn-primary">
                                                            <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                ';
                                            }
                                            ?>

                                        </div>
                                        <?php
                                        if (empty($usuarios)) {
                                            echo '
                                            <div class="alert alert-info text-center">
                                                No hay usuarios registrados aún
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