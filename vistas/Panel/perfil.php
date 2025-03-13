
<?php
//print_r($_SESSION);
?>
<br><br>

<div id="contenedor_perfil_panel" class="container" style="font-size: 1.6rem;">
    <div class="view-account">
        <section class="module p-5">
            <div class="module-inner">

                <?php
                include "barra-lateral.php";
                ?>

                <div class="content-panel">
                    <h2 class="title">
                        Perfil
                        <?php
                            echo '
                                <span class="pro-label label label-warning">'.strtoupper($datos['perfil']).'</span>
                            ';
                        ?>
                    </h2>
                    <form class="form-horizontal">
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Foto de perfil</h3>
                            <div class="form-group avatar">
                                <figure id="miniatura_foto_perfil" class="figure col-md-2 col-sm-3 col-xs-12">
                                    <img class="img-rounded img-responsive" src=".<?php echo $datos['foto_perfil']; ?>" alt="Foto de perfil">
                                </figure>
                                <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                    <input id="foto_perfil_input" type="file" class="file-uploader pull-left">
                                    <div onclick="cambiarFotoPerfil()" class="btn btn-sm btn-secondary degradadomanetener" style="border-radius: 15px; margin-left: auto; padding: 5px 25px">Cambiar imagen</div>
                                </div>
                                <br><br>
                            </div>
                        </fieldset>

                        <fieldset class="fieldset fieldset_infopersonal">
                            <h3 class="fieldset-title">Información personal</h3>
                            
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Usuario</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input disabled id="usuario_infopersonal" type="text" class="form-control" value="<?php echo $datos['usuario']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 col-sm-6 col-xs-12 control-label">Nombre completo</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input disabled id="nombre_infopersonal" type="text" class="form-control" placeholder="Ingresa tu nombre completo" value="<?php echo $datos['nombre']?>">
                                </div>
                            </div>

                        </fieldset>
                        <br>
                        <br>
                        <fieldset class="fieldset fieldset_infopersonal">
                            <h3 class="fieldset-title">Informacion de contacto</h3>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Correo</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input id="correo_infopersonal" disabled type="email" class="form-control" placeholder="Ingresa tu correo" value="<?php echo $datos['correo']?>">
                                    <p class="help-block text-muted">Correo personal</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Telefono</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input id="telefono_infopersonal" disabled type="tel" class="form-control" placeholder="Ingresa tu telefono" value="<?php echo $datos['telefono']?>">
                                    <p class="help-block text-muted">Telefono personal</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Facebook</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input id="twitter_infopersonal" disabled type="text" class="form-control" placeholder="Ingresa tu usuario" value="<?php echo $datos['facebook']?>">
                                    <p class="help-block text-muted">Usuario de facebook</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Linkedin</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input id="linkedin_infopersonal" disabled type="url" class="form-control" placeholder="Ingresa tu enlace" value="<?php echo $datos['linkedin']?>">
                                    <p class="help-block text-muted">eg. https://www.linkedin.com/in/usuario</p>
                                </div>
                            </div>
                        </fieldset>
                        <hr>
                        <div class="form-group">
                            <div style="display: none;" class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                <input onclick="editarInformacionPerfil()" id="btn_guardar_perfil" class="btn btn-primary" type="button" value="Actualizar Perfil">
                            </div>
                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                <input onclick="editarInformacionPerfil()" id="btn_editar_perfil" class="btn btn-info" type="button" value="Editar información">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>