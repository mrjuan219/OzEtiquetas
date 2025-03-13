<div class="container" style="font-size: 1.6rem;">
    <div class="view-account">
        <section class="module p-5">
            <div class="module-inner">

                <?php
                include "barra-lateral.php";
                ?>

                <div class="content-panel">
                    <h2 class="title">
                        Ubicaciones
                    </h2>
                    <hr>
                    <br>
                    <?php
                    $ubicaciones = ControladorUsuario::traerDireccionesCtr($_SESSION['usuario']);

                    foreach ($ubicaciones as $ubicacion) {
                        if ($ubicacion['principal'] == 1) {
                            $checked = 'checked';
                        } else {
                            $checked = '';
                        }

                        echo '
                            <form class="form-horizontal">
                            <fieldset class="fieldset">
                                <h3 class="fieldset-title" style="margin-bottom: 15px">' . $ubicacion['nombre_ubicacion'] . '</h3>
    
                                <div class="row">
    
                                    <div class="form-group col-md-8 col-xs-12">
                                        <label class="control-label">Calle</label>
                                        <div class="">
                                            <input id="correo_infopersonal" disabled type="email" class="form-control" placeholder="Ingresa tu calle" value="' . $ubicacion['calle'] . '">
                                        </div>
                                    </div>
    
                                    <div class="form-group col-md-4  col-xs-12 ">
                                        <label class="control-label">Numero exterior</label>
                                        <div class="">
                                            <input type="number" id="telefono_infopersonal" disabled type="tel" class="form-control" placeholder="#" value="' . $ubicacion['numero'] . '">
                                        </div>
                                    </div>
    
                                </div>
    
                                <div class="row">
    
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label class="control-label">Colonia</label>
                                        <div class="">
                                            <input id="twitter_infopersonal" disabled type="text" class="form-control" placeholder="Ingresa tu colonia" value="' . $ubicacion['colonia'] . '">
                                        </div>
                                    </div>
    
                                    <div class="form-group col-md-6  col-xs-12 ">
                                        <label class="control-label">C.P.</label>
                                        <div class="">
                                            <input id="twitter_infopersonal" disabled type="text" class="form-control" placeholder="Ingresa tu codigo postal" value="' . $ubicacion['codigo_postal'] . '">
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
    
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label class="control-label">Municipio</label>
                                        <div class="">
                                            <input id="linkedin_infopersonal" disabled type="url" class="form-control" placeholder="Ingresa tu enlace" value="' . $ubicacion['municipio'] . '">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6  col-xs-12 ">
                                        <label class=" control-label">Estado</label>
                                        <div class="">
                                            <input id="linkedin_infopersonal" disabled type="url" class="form-control" placeholder="Ingresa tu enlace" value="' . $ubicacion['estado'] . '">
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label class="control-label">Pais</label>
                                        <div class="">
                                            <input id="linkedin_infopersonal" disabled type="url" class="form-control" placeholder="Ingresa tu enlace" value="' . $ubicacion['pais'] . '">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12  col-xs-12 ">
                                    <div class="form-check form-group" style="margin-top: 1rem;">
                                        <input ' . $checked . ' disabled class="form-check-input" type="checkbox" value="" id="principalUbicacion" />
                                        <label style="margin-left: 1.1rem;" class="form-check-label" for="principalUbicacion">
                                            Establecer como ubicación por defecto
                                        </label>
                                    </div>
                                </div>
    
                                <hr>
                                <div class="form-group">
                                    <div style="display: none;" class=" col-md-push-2 col-sm-push-3 col-xs-push-0">
                                        <input onclick="editarInformacionPerfil()" id="btn_guardar_perfil" class="btn btn-primary" type="button" value="Actualizar Perfil">
                                    </div>
                                    <div class=" col-md-push-2 col-sm-push-3 col-xs-push-0">
                                        <input onclick="" id="btn_editar_perfil" class="btn btn-danger" type="button" value="Eliminar direccion">
                                    </div>
                                </div>
    
    
                            </fieldset>
                            <br><br>
                            </form>
                            ';
                    }
                    ?>

                    <div class="form-group">
                        <div class="col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                            <div class="btn btn-info pointer" onclick="nuevaDireccion()" >Agregar nueva direccion</div>
                        </div>

                    </div>
                </div>
        </section>
    </div>
</div>