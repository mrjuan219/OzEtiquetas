<?php
if (!isset($_SESSION['login'])) {
    echo '
    <div class="container" style="padding-top: 3rem;">
        <div class="row" style="display: flex;height: 60vh;align-items: center;">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        No puedes acceder a esta pagina</h2>
                    <div class="error-details">
                        Lo sentimos, para acceder a esta pagina primero tienes que iniciar sesión!
                    </div>
                    <div class="error-actions">
                        <a onclick="modalLogin()" class="btn btn-primary btn-lg degradadomanetener">
                            <span class="glyphicon glyphicon-home"></span>
                            Iniciar Sesión
                        </a>
                        <a onclick="modalRegistro()" style="border-radius: 30px !important;" class="btn btn-secondary btn-lg">
                            <span class="glyphicon glyphicon-envelope">
                        </span> Registrarte </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>

    <style>
        #contenedor_perfil_panel{
            display: none;
        }
    </style>
    ';
}else{
    echo '
    <div class="container" style="padding-top: 3rem;">
        <div class="row" style="display: flex;height: 60vh;align-items: center;">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        No puedes acceder a esta pagina</h2>
                    <div class="error-details">
                        Lo sentimos, para acceder a esta pagina necesitas tener permiso!
                    </div>
                    <div class="error-actions">
                        <a onclick="cerrarSesion()" class="btn btn-primary btn-lg degradadomanetener">
                            <span class="glyphicon glyphicon-home"></span>
                            Salir e iniciar sesión con una cuenta difierente
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>

    <style>
        #contenedor_perfil_panel{
            display: none;
        }
    </style>
    ';
}