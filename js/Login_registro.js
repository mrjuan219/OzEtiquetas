function iniciarSesion() {
    var usuario = $('#usuario').val();
    var contraseña = $('#contraseña').val();

    console.log(usuario, contraseña);

    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            usuario: usuario,
            contraseña: contraseña,
            login: 1
        },
        success: function (respuesta) {
            if (respuesta.indexOf('error') == -1) {
                Swal.fire('Bienvenido', 'Iniciaste sesion como ' + respuesta, 'success').then(function () {
                    window.location.reload()
                });
            } else if (respuesta.indexOf('No se puede establecer una conexión ya que el equipo de destino denegó expresamente dicha conexión.') > 1) {
                Swal.fire('Error', 'Error al conectar con la base de datos', 'error');

            } else {
                Swal.fire('Error', 'Usuario o contraseña incorrecto', 'error');
            }
            console.log(respuesta)

        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }
    });
}

function registrarse() {
    var usuario = $('#usuarioRegistro').val();
    var nombre = $('#nombreRegistro').val();
    var contraseña = $('#contraseñaRegistro').val();
    var correo = $('#correoRegistro').val();
    var telefono = $('#telefonoRegistro').val();

    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            usuario: usuario,
            nombre: nombre,
            contraseña: contraseña,
            correo: correo,
            telefono: telefono,
            registro: 1
        },
        success: function (respuesta) {
            if (respuesta.indexOf('error') == -1 && respuesta != '') {
                Swal.fire('Bienvenido', 'Tu registro fue exitoso ' + respuesta, 'success').then(function () {
                    window.location.reload()
                });
            } else {
                Swal.fire('Error', 'Usuario o contraseña incorrecto', 'error');
            }
            console.log(respuesta);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }
    });
}

function registrar_usuario_admin() {
    var usuario = $('#usuario_registro_admin').val();
    var correo = $('#correo_registro_admin').val();
    var nombre = $('#nombre_registro_admin').val();
    var telefono = $('#telefono_registro_admin').val();
    var contraseña = $('#contraseña_registro_admin').val();
    var tipo = $('#tipo_registro_admin').val();
    var sucursal = $('#sucursal_registro_admin').val();

    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            usuario: usuario,
            nombre: nombre,
            contraseña: contraseña,
            correo: correo,
            telefono: telefono,
            sucursal,
            tipo,
            registro_admin: 1
        },
        success: function (respuesta) {
            if (respuesta.indexOf('error') == -1 && respuesta.indexOf('Success') > -1 && respuesta != '' && respuesta != 'Ocupado') {
                Swal.fire('Bienvenido', 'Usuario registrado exitosamente', 'success').then(function () {
                    window.location.reload()
                });
            } else if (respuesta.indexOf('Ocupado') > -1) {
                Swal.fire('Error', 'El usuario o correo ya están en uso', 'error').then(function () {});
            } else {
                Swal.fire('Error', 'Verifica los datos', 'error');
            }
            console.log(respuesta);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }
    });
}

function registrarDireccion() {
    var nombre_ubicacion = $('#nombre_ubicacion').val();
    var calle = $('#calleUbicacion').val();
    var numero = $('#numeroUbicacion').val();
    var colonia = $('#coloniaUbicacion').val();
    var codigopostal = $('#cpUbicacion').val();
    var pais = $('#paisUbicacion').val();
    var estado = $('#estadoUbicacion').val();
    var municipio = $('#municipio_ubicacion').val();
    var principal = $('#principalUbicacion').is(':checked');
    var comentarios = $('#comentarios_ubicacion').val();

    if (nombre_ubicacion == '' || calle == '' || numero == '' || colonia == '' || codigopostal == '' || municipio == '' || estado == '' || pais == '') {
        Swal.fire('Error...', 'Debes llenar todos los campos', 'error');
        return;
    }

    if (nombre_ubicacion == null || calle == null || numero == null || colonia == null || codigopostal == null || municipio == null || estado == null || pais == null) {
        Swal.fire('Error...', 'Debes llenar todos los campos', 'error');
        return;
    }

    console.log(nombre_ubicacion, calle, numero, colonia, codigopostal, pais, estado, municipio, principal, comentarios)

    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            calle,
            nombre_ubicacion,
            numero,
            colonia,
            codigo_postal: codigopostal,
            municipio,
            estado,
            pais,
            principal,
            comentarios,
            registroUbicacion: 1
        },
        success: function (respuesta) {
            if (respuesta.indexOf('success') > -1) {
                Swal.fire('Correcto', 'Tu registro de nueva ubicacion fue exitoso ', 'success').then(function () {
                    window.location.reload()
                });
            } else {
                Swal.fire('Error', 'Revisa los datos proporcionados', 'error');
            }
            console.log(respuesta);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }
    });
}

function eliminarUsuario(id) {
    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            id,
            eliminar_id: 1
        },
        success: function (respuesta) {
            if (respuesta.indexOf('success') > -1) {
                Swal.fire('Eliminado', '', 'success').then(function () {
                    window.location.reload()
                });
            } else {
                Swal.fire('Error', 'No se pudo eliminar', 'error');
            }
            console.log(respuesta);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }
    });
}

function verificarDisponibilidad() {
    var usuario = $('#usuarioRegistro').val();
    var correo = $('#correoRegistro').val();

    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            usuario: usuario,
            correo: correo,
            verificarD: 1
        },
        success: function (respuesta) {
            if (respuesta.indexOf('Disponible') !== -1) {
                $('.parte1').hide()
                $('.parte2').show(300);
            } else {
                Swal.fire('Error', 'El usuario o correo ya estan registrados', 'error');
            }
            console.log(respuesta);
            console.log(usuario, correo);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }
    });
}

function registrar_sucursal() {
    var nombre = $('#nombre_registro_sucursal').val();
    var direccion = $('#direccion_registro_sucursal').val();
    var apertura = $('#apertura_registro_sucursal').val();
    var cierre = $('#cierre_registro_sucursal').val();
    var latitud = $('#latitud_registro_sucursal').val();
    var longitud = $('#longitud_registro_sucursal').val();

    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            nombre,
            direccion,
            apertura,
            cierre,
            latitud,
            longitud,
            registrar_sucursal: 1
        },
        success: function (respuesta) {
            if (respuesta.indexOf('success') > -1) {
                Swal.fire('Correcto!', 'Tu sucursal se registró correctamente', 'success');
            } else {
                Swal.fire('Error', 'No se pudo registrar la sucursal', 'error');
            }
            //console.log(respuesta);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }
    });
}

function editarSucursal(id) {

    $.post("ajax/usuario.ajax.php", {
        traerSucursal: id
    }, function (respuesta) {
        var json = JSON.parse(respuesta);

        var id = json[0].id
        var nombre = json[0].nombre_sucursal
        var direccion = json[0].direccion
        var hora_inicio = json[0].horario_inicio
        var hora_fin = json[0].horario_fin
        var latitud = json[0].latitud
        var longitud = json[0].longitud

        $('#idSucursal').val(id);
        $('#nombre_registro_sucursal').val(nombre)
        $('#direccion_registro_sucursal').val(direccion)
        $('#apertura_registro_sucursal').val(hora_inicio)
        $('#cierre_registro_sucursal').val(hora_fin)
        $('#latitud_registro_sucursal').val(latitud)
        $('#longitud_registro_sucursal').val(longitud)

        $('#contenedor_botones_actualizar_sucursal').show()
        $('#contenedor_botones_registrar_sucursal').hide()
        $('#modalRegistroSucursal').modal('show');

    })
}

function editarUsuarioPanel(id) {

    $.post("ajax/usuario.ajax.php", {
        traerUsuarioJson: id
    }, function (respuesta) {
        console.log(respuesta);
        var json = JSON.parse(respuesta);
        var id = json[0].id
        var usuario = json[0].usuario
        var correo = json[0].correo
        var nombre = json[0].nombre
        var telefono = json[0].telefono
        var contraseña = json[0].contraseña
        var tipo = json[0].perfil
        var sucursal = json[0].id_sucursal

        $('#usuario_registro_admin').val(usuario);
        $('#usuario_registro_admin').prop('disabled', true);
        $('#correo_registro_admin').val(correo);
        $('#nombre_registro_admin').val(nombre);
        $('#telefono_registro_admin').val(telefono);
        $('#contraseña_registro_admin').val(contraseña);
        $('#tipo_registro_admin').val(tipo);
        $('#sucursal_registro_admin').val(sucursal);

        $('#idUsuario').val(id);

        $('#contenedor_botones_actualizar_usuario').show()
        $('#contenedor_botones_registrar_usuario').hide()

        $('#modalRegistroAdmin .modal-title.w-100.letra_azul.titulo_modal').text('Actualizar usuario');
        $('#modalRegistroAdmin').modal('show');

    })
}

function actualizar_usuario_admin() {
    var usuario = $('#usuario_registro_admin').val();
    var correo = $('#correo_registro_admin').val();
    var nombre = $('#nombre_registro_admin').val();
    var telefono = $('#telefono_registro_admin').val();
    var contraseña = $('#contraseña_registro_admin').val();
    var tipo = $('#tipo_registro_admin').val();
    var sucursal = $('#sucursal_registro_admin').val();

    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            usuario,
            nombre: nombre,
            contraseña: contraseña,
            correo: correo,
            telefono: telefono,
            sucursal,
            tipo,
            actualizar_admin: 1
        },
        success: function (respuesta) {
            if (respuesta.indexOf('error') == -1 && respuesta.indexOf('actualizado') > -1 && respuesta != '' && respuesta != 'Ocupado') {
                Swal.fire('Correcto', 'Usuario actualizado exitosamente', 'success').then(function () {
                    window.location.reload()
                });
            } else {
                Swal.fire('Error', 'Verifica los datos', 'error');
            }
            console.log(respuesta);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }
    });
}

function actualizar_sucursal(id) {
    var nombre = $('#nombre_registro_sucursal').val();
    var direccion = $('#direccion_registro_sucursal').val();
    var apertura = $('#apertura_registro_sucursal').val();
    var cierre = $('#cierre_registro_sucursal').val();
    var latitud = $('#latitud_registro_sucursal').val();
    var longitud = $('#longitud_registro_sucursal').val();

    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            nombre,
            direccion,
            apertura,
            cierre,
            latitud,
            longitud,
            id_sucursal: id,
            actualizar_sucursal: 1
        },
        success: function (respuesta) {
            if (respuesta.indexOf('success') > -1) {
                Swal.fire('Correcto!', 'Tu sucursal se actualizó correctamente', 'success').then(function () {
                    window.location.reload();
                });
            } else {
                Swal.fire('Error', 'No se pudo actualizar la sucursal', 'error');
            }
            //console.log(respuesta);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }
    });
}

function cerrarSesion() {
    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            cerrarSesion: 1
        },
        success: function (respuesta) {
            window.location.search = "?ruta=Inicio";
        }
    })
}

function modalRegistro() {
    $('#modalLogin').modal('hide');
    $('#modalRegistro').modal('show');
}

function modalRegistroAdmin() {
    $('#modalLogin').modal('hide');
    $('#modalRegistro').modal('hide');
    $('#modalRegistroAdmin .modal-title.w-100.letra_azul.titulo_modal').text('Nuevo usuario');
    $('#usuario_registro_admin').prop('disabled', false);

    $('#contenedor_botones_actualizar_usuario').hide();
    $('#contenedor_botones_registrar_usuario').show();

    $('#usuario_registro_admin').val('');
    $('#correo_registro_admin').val('');
    $('#nombre_registro_admin').val('');
    $('#telefono_registro_admin').val('');
    $('#contraseña_registro_admin').val('');
    $('#tipo_registro_admin').val('');
    $('#sucursal_registro_admin').val('');

    $('#modalRegistroAdmin').modal('show');
}

function modalRegistroSucursal() {
    $('#idSucursal').val('');
    $('#nombre_registro_sucursal').val('')
    $('#direccion_registro_sucursal').val('')
    $('#apertura_registro_sucursal').val('')
    $('#cierre_registro_sucursal').val('')
    $('#latitud_registro_sucursal').val('')
    $('#longitud_registro_sucursal').val('')

    $('#contenedor_botones_actualizar_sucursal').hide()
    $('#contenedor_botones_registrar_sucursal').show()
    $('#modalRegistroSucursal').modal('show');
}

function modalLogin() {
    $('#modalRegistro').modal('hide');
    $('#modalLogin').modal('show');
}

function menu() {
    var menu = $('.contenedor-barra');
    var logo = $('.contenedor-logo');
    var cerrar = $('#cerrar')
    if (menu.is(':visible')) {
        menu.slideUp(300);
        cerrar.hide(200);
        logo.show(200);
        return;
    } else {
        menu.slideDown(300);
        menu.css('display', 'flex')
        cerrar.show(200);
        logo.hide(200);
        return;
    }
}

function editarInformacionPerfil() {
    if ($('#btn_guardar_perfil').is(':visible')) {
        $('#btn_editar_perfil').parent().show(300)
        $('#btn_guardar_perfil').parent().hide(300)
        $('.fieldset_infopersonal input').prop("disabled", true);


        var nombre = $('#nombre_infopersonal').val();
        var correo = $('#correo_infopersonal').val();
        var telefono = $('#telefono_infopersonal').val();
        var facebook = $('#twitter_infopersonal').val();
        var linkedin = $('#linkedin_infopersonal').val();

        $.ajax({
            type: 'post',
            url: 'ajax/usuario.ajax.php',
            data: {
                actualizarInfoPersonal: 1,
                nombre,
                correo,
                telefono,
                facebook,
                linkedin
            },
            success: function (respuesta) {
                if (respuesta == 'actualizado') {
                    Swal.fire('Realizado', 'Su informacion personal fue actualizada', 'success')
                } else {
                    Swal.fire('Error', 'Su informacion personal no pudo ser actualizada', 'error')
                }
            }
        })

    } else {
        $('#btn_editar_perfil').parent().hide(300)
        $('#btn_guardar_perfil').parent().show(300)

        $('.fieldset_infopersonal input').prop("disabled", false);
        $('#usuario_infopersonal').prop("disabled", true);
    }
}

function cambiarFotoPerfil() {

    var formData = new FormData();

    formData.append('subirFotoPerfil', 1);
    formData.append('imagen_perfil', $('#foto_perfil_input')[0].files[0]);

    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            console.log(respuesta);

            if (respuesta.indexOf('insertó') > -1) {
                Swal.fire('Correcto', 'Tu imagen fue actualizada', 'success').then(function () {
                    window.location.reload();
                })
            } else {
                Swal.fire('Error', respuesta, 'error');
            }
            console.log(respuesta);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        },
        beforeSend: function () {

        },
        complete: function () {

        }
    });
}

function habilitarSucursal(valor) {
    if (valor == 'Sucursal') {
        $('#sucursal_registro_admin').show(200);
        $('#label_sucursal_registro_admin').show(200);
    } else {
        $('#sucursal_registro_admin').hide(200);
        $('#label_sucursal_registro_admin').hide(200);
    }
}

function enviarCitaSede() {
    var nombre = $('#nombre_cita_sucursal').val()
    var correo = $('#correo_cita_sucursal').val()
    var telefono = $('#telefono_cita_sucursal').val()
    var sede = $('#sede_cita_sucursal').val()
    var motivo = $('#motivo_cita_sucursal').val()
    var horario = $('#horario_cita_sucursal').val()
    var fecha = $('#fecha_cita_sucursal').val()

    if (nombre == '' || nombre == null || typeof nombre == 'undefined') {
        Swal.fire('Error', 'El campo nombre no puede estar vacio', 'error');
    }
    if (correo == '' || correo == null || typeof correo == 'undefined') {
        Swal.fire('Error', 'El campo correo no puede estar vacio', 'error');
    }
    if (telefono == '' || telefono == null || typeof telefono == 'undefined') {
        Swal.fire('Error', 'El campo telefono no puede estar vacio', 'error');
    }
    if (sede == '' || sede == null || typeof sede == 'undefined') {
        Swal.fire('Error', 'El campo sede no puede estar vacio', 'error');
    }
    if (motivo == '' || motivo == null || typeof motivo == 'undefined') {
        Swal.fire('Error', 'El campo motivo no puede estar vacio', 'error');
    }
    if (horario == '' || horario == null || typeof horario == 'undefined') {
        Swal.fire('Error', 'El campo horario no puede estar vacio', 'error');
    }
    if (fecha == '' || fecha == null || typeof fecha == 'undefined') {
        Swal.fire('Error', 'El campo fecha no puede estar vacio', 'error');
    }

    var formData = new FormData();

    formData.append('nombre', nombre);
    formData.append('correo', correo);
    formData.append('telefono', telefono);
    formData.append('motivo', motivo);
    formData.append('sede', sede);
    formData.append('horario', horario);
    formData.append('fecha', fecha);
    formData.append('enviarCita', 1);

    console.log(formData);

    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            generarToken: 1,
            fecha,
            correo
        },
        success: function (respuesta) {
            var arreglo = JSON.parse(respuesta);
            var token = arreglo['token'];
            var fecha = arreglo['fecha']

            Swal.mixin({
                input: 'text',
                confirmButtonText: 'Siguiente &rarr;',
                showCancelButton: true,
                progressSteps: ['1']
            }).queue([{
                title: 'Verificación',
                text: 'Ingresa el codigo de 6 digitos enviado a tu correo'
            }]).then((result) => {
                if (typeof result.value == 'undefined') {
                    var texto_error = 'El dato ingresado';
                } else {
                    var texto_error = result.value;
                }
                if (result.value == token) {
                    $.ajax({
                        type: 'post',
                        url: 'ajax/usuario.ajax.php',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (respuesta) {
                            console.log(respuesta);

                            if (respuesta.indexOf('insertó') > -1) {
                                Swal.fire({
                                    title: 'Completado',
                                    html: 'La verificacion fue exitosa y quedará agendada para el dia ' + fecha + " a las " + horario,
                                    confirmButtonText: 'De acuerdo!'
                                }).then(function () {
                                    window.location.reload();
                                })
                            } else {
                                Swal.fire('Error', respuesta, 'error');
                            }
                        },
                        error: function (e, j, h) {
                            console.log(e, j, h)
                        },
                        beforeSend: function () {

                        },
                        complete: function () {

                        }
                    });
                } else {
                    Swal.fire('Error', texto_error + " no coincide con el codigo", 'error');
                }
            })
        }
    })
}

function agendarCitaModal(id) {
    $('#modalRegistroCita').modal('show');
    $('#sede_cita_sucursal').val(id);
    console.log('cambiado: ' + id)
}

function marcarComoAtendida_cita(id) {
    Swal.mixin({
        input: 'text',
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        progressSteps: ['1'],
        autoCapitalize: 'on'
    }).queue([{
        title: '¿Por quien fue atendida?',
        text: 'Ingresa el de la persona que atendió la cita',
        inputPlaceholder: 'Ejemplo: Luis Sanchez'
    }]).then((result) => {
        var nombre = result.value[0];

        if (nombre.length > 3) {
            $.ajax({
                type: 'post',
                url: 'ajax/usuario.ajax.php',
                data: {
                    nombre,
                    id_cita: id,
                    guardarCitaCompletada: 1
                },
                success: function (respuesta) {
                    console.log(respuesta);

                    if (respuesta == '') {
                        respuesta = 'Sin respuesta del servidor';
                    }

                    if (respuesta.indexOf('insertó') > -1) {
                        Swal.fire({
                            title: 'Completado',
                            html: 'Se registró que la cita fue atendida por ' + nombre,
                            confirmButtonText: 'De acuerdo!'
                        }).then(function () {
                            window.location.reload();
                        })
                    } else {
                        Swal.fire('Error', respuesta, 'error');
                    }
                },
                error: function (e, j, h) {
                    console.log(e, j, h)
                },
                beforeSend: function () {

                },
                complete: function () {

                }
            });
        } else {
            Swal.fire('Error', "No fue posible registrar la cita intentalo de nuevo", 'error');
        }
    })
}

function editarUsuario() {
    enDesarrollo();
}

function enDesarrollo() {
    Swal.fire('Error', "Funcion en proceso de desarrollo, gracias por la espera", 'error')
}

$(document).ready(function () {

    if (window.location.search == "?ruta=Perfil") {

        document.getElementById("foto_perfil_input").onchange = function (e) {

            var fileName = $(this).val().split("\\").pop();
            // Creamos el objeto de la clase FileReader
            let reader = new FileReader();

            // Leemos el archivo subido y se lo pasamos a nuestro fileReader
            reader.readAsDataURL(e.target.files[0]);

            // Le decimos que cuando este listo cree la imagen
            reader.onload = function () {
                let preview = document.getElementById('miniatura_foto_perfil'),
                    image = document.createElement('img');

                image.src = reader.result;

                preview.innerHTML = '';
                preview.append(image);
            };
        }
    }


    window.onscroll = function () {
        stickyNav()
    };

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function stickyNav() {
        //console.log(window.pageYOffset, sticky);
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }

        if (window.pageYOffset <= 10) {
            navbar.classList.remove("sticky");
        }

    }
})