function registrarServicio() {

    var nombre = $('#nombreServicio').val();
    var pais = $('#paisServicio').val();
    var estado = $('#estadoServicio').val();
    var municipio = $('#municipioRegistro').val();
    var direccion = $('#direccionCompletaRegistro').val();
    var latitud = $('#latitudRegistro').val();
    var longitud = $('#longitudRegistro').val();
    var descripcion = $('#descripcionServicio').val();
    var categoria = $('#categoriaServicio').val();
    var subCategoria = $('#subcategoriaServicio').val();
    var facebook = $('#facebookServicio').val();
    var whatsapp = $('#whatsappServicio').val();
    var formData = new FormData();

    var contador = $('.contenedor_carga').length;

    formData.append('nombre', nombre);
    formData.append('pais', pais);
    formData.append('estado', estado);
    formData.append('municipio', municipio);
    formData.append('direccion', direccion);
    formData.append('latitud', latitud);
    formData.append('longitud', longitud);
    formData.append('descripcionServicio', descripcion);
    formData.append('categoria', categoria);
    formData.append('subcategoria', subCategoria);
    formData.append('facebook', facebook);
    formData.append('whatsapp', whatsapp);
    formData.append('nuevoServicio', '1');
    formData.append('contador', contador);

    for (var i = 0; i < contador; i++) {
        console.log(i, contador);
        e = i + 1;
        console.log("Hola: " + e)
        formData.append('archivo' + i, $('#modalServicio .custom-file-input')[i].files[0]);
        formData.append('descripcion' + e, $('#descripcion-img' + e).val());
    }

    if (nombre == '' && pais == '' || estado == '' || municipio == '' || direccion == '' || descripcion == '') {
        Swal.fire('Error', 'No puedes dejar campos vacios', 'error');
        console.log(nombre, pais, estado, municipio, direccion, descripcion);
        return;
    }

    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta.indexOf('success') > -1) {
                Swal.fire('Correcto', 'Tu servicio fue enviado para su revisón antes de ser publicado', 'success').then(function () {
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
        beforeSend : function(){ 
            
        }, 
        complete: function(){ 
            
        } 
    });
}

function subirImagen() {

    var id = $('#idServicio').val();

    var descripcion = $('#descripcion-img1').val();

    var formData = new FormData();

    formData.append('descripcionServicio', descripcion);
    formData.append('subirIMG', 1);
    formData.append('idServicio', id);
    formData.append('imagen_subir', $('#modalServicio .custom-file-input')[0].files[0]);
    

    if (descripcion == '') {
        Swal.fire('Error', 'No puedes dejar campos vacios', 'error');
        return;
    }

    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta.indexOf('insertó') > -1) {
                Swal.fire('Correcto', 'Tu imagen fue agregada al servicio', 'success').then(function () {
                    traerImagenes(id);
                    $('#preview1').empty();
                    $('#descripcion-img1').val('');
                    $(".custom-file-label").addClass("selected").html('Seleccionar imagen');

                })
            } else {
                Swal.fire('Error', respuesta, 'error');
            }
            console.log(respuesta);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }, 
        beforeSend : function(){ 
            
        }, 
        complete: function(){ 
            
        } 
    });
}

function actualizarServicio() {
    var idServicio = $('#idServicio').val();
    var nombre = $('#nombreServicio').val();
    var pais = $('#paisServicio').val();
    var estado = $('#estadoServicio').val();
    var municipio = $('#municipioRegistro').val();
    var direccion = $('#direccionCompletaRegistro').val();
    var latitud = $('#latitudRegistro').val();
    var longitud = $('#longitudRegistro').val();
    var descripcion = $('#descripcionServicio').val();
    var categoria = $('#categoriaServicio').val();
    var subCategoria = $('#subcategoriaServicio').val();
    var facebook = $('#facebookServicio').val();
    var whatsapp = $('#whatsappServicio').val();
    var formData = new FormData();

    formData.append('nombre', nombre);
    formData.append('pais', pais);
    formData.append('estado', estado);
    formData.append('municipio', municipio);
    formData.append('direccion', direccion);
    formData.append('latitud', latitud);
    formData.append('longitud', longitud);
    formData.append('descripcion', descripcion);
    formData.append('categoria', categoria);
    formData.append('subcategoria', subCategoria);
    formData.append('facebook', facebook);
    formData.append('whatsapp', whatsapp);
    formData.append('editarServicio', idServicio);

    console.log(idServicio)

    if (nombre == '' && pais == '' || estado == '' || municipio == '' || direccion == '' || descripcion == '' || idServicio == '' || latitud == '' || longitud == '' || municipio == null || estado == null || subCategoria == null || categoria == '' || categoria == null) {
        Swal.fire('Error', 'No puedes dejar campos vacios', 'error');
        console.log(nombre, pais, estado, municipio, direccion, descripcion);
        return;
    }

    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta.indexOf('success') > -1) {
                Swal.fire('Correcto', 'Tu servicio fue actualizado', 'success').then(function () {
                    window.location.reload()
                });
            } else {
                Swal.fire('Error', respuesta, 'error');
            }
            console.log(respuesta);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }, 
        beforeSend : function(){ 
            
        }, 
        complete: function(){ 
            
        } 
    });
}

function editarServicio(idServicio) {
    $.post("ajax/servicios.ajax.php", {
        traerServicio: idServicio
    }, function (respuesta) {
        var json = JSON.parse(respuesta);
        console.log(json)
        var id = json[0].id
        var nombre = json[0].titulo
        var pais = json[0].pais
        var estado = json[0].estadoID
        var municipio = json[0].municipioID
        var direccion = json[0].direccion
        var facebook = json[0].facebook
        var whatsapp = json[0].whatsapp
        var descripcion = json[0].descripcion
        var Categoria = json[0].idCategoria
        var Subcategoria = json[0].idSubcategoria

        console.log(id)

        $('#idServicio').val(id);
        $('#nombreServicio').val(nombre);
        $('#estadoServicio').val(estado)
        traerMunicipios(estado)
        setTimeout(function () {
            $('#municipioRegistro').val(municipio);
        }, 1000)
        $('#direccionServicio').val(direccion);
        $('#descripcionServicio').val(descripcion);
        $('#categoriaServicio').val(Categoria).trigger("change");
        setTimeout(function () {
            $('#subcategoriaServicio').val(Subcategoria);
        }, 1000)
        $('#facebookServicio').val(facebook);
        $('#whatsappServicio').val(whatsapp);

        $('#direccionCompletaRegistro, #latitudRegistro, #longitudRegistro').val('')

        $('#address').val(direccion);

        $('#submit').click();

        $('#modalServicio h3').html('Editar Servicio');
        $('#botonesActualizar').show();
        $('#botonesActualizar').css('display', 'flex');
        $('#botonesRegistro').hide();
        primerPasoEditarServicio()

        $('#modalServicio').modal('show');

    })
}

function modalRegistroServicio() {
    primerPasoRegistroServicio();
    $('#idServicio').val('');
    $('#nombreServicio').val('');
    $('#estadoServicio').val('')
    $('#municipioRegistro').val('');
    $('#direccionServicio').val('');
    $('#descripcionServicio').val('');
    $('#categoriaServicio').val('');
    $('#subcategoriaServicio').val('');
    $('#facebookServicio').val('');
    $('#whatsappServicio').val('');

    $('#modalServicio h3').html('Nuevo Servicio');
    $('#botonesActualizar').hide();
    $('#botonesRegistro').show();
    $('#botonesRegistro').css('display', 'flex');
    $('#modalServicio').modal('show');
}

function registrarCategoria() {
    var nombre = $('#categoriaRegistro').val();
    var textos = $('#textosRegistro').val();

    var formData = new FormData();

    formData.append('nombre', nombre);
    formData.append('textos', textos);
    formData.append('nuevaCategoria', '1');

    formData.append('img_categoria', $('#modalCategoria .custom-file-input')[0].files[0]);


    if (nombre == '') {
        Swal.fire('Error', 'No puedes dejar campos vacios', 'error');
        return;
    }

    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta.indexOf('success') > -1) {
                Swal.fire('Correcto', 'Tu categoria se agregó', 'success').then(function () {
                    traerCategoriasTabla()
                    $('#img_categoria_input').val('')
                    $('#preview_categoria img').remove()
                    $('#categoriaRegistro, #textosRegistro').val('')
                });
            } else {
                Swal.fire('Error', respuesta, 'error');
            }
            console.log(respuesta);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }
    });
}

function registrarSubCategoria() {
    var nombre = $('#categoriaRegistro').val();
    var textos = $('#textosRegistro').val();

    var id = $('#categoriaRegistrosub').val();

    var formData = new FormData();

    formData.append('nombre', nombre);
    formData.append('textos', textos);
    formData.append('idCategoria', id);
    formData.append('nuevaSubcategoria', '1');

    if (nombre == '' || id == '') {
        Swal.fire('Error', 'No puedes dejar campos vacios', 'error');
        return;
    }

    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta.indexOf('success') > -1) {
                Swal.fire('Correcto', 'Tu subcategoria se agregó', 'success').then(function () {
                    $.ajax({
                        type: 'post',
                        url: 'ajax/servicios.ajax.php',
                        data: {
                            traerSubCategoriasTabla: 1
                        },
                        success: function (respuesta) {
                            console.log()
                            $('#subcategoriasTabla').empty();
                            $('#subcategoriasTabla').append(respuesta);
                        },
                        error: function (data, error) {
                            console.log(data + error)
                        }
                    })
                });
            } else {
                Swal.fire('Error', respuesta, 'error');
            }
            console.log(respuesta);
        },
        error: function (e, j, h) {
            console.log(e, j, h)
        }
    });
}

function contraseñaOlvidada(){
    $('#modalLogin').modal('hide');
    Swal.fire({
        title: 'Recuperar contraseña',
        input: 'email',
        inputPlaceholder: 'correo@ejemplo.com',
        text: 'Si el correo coincide con alguna cuenta registrada recibiras en el correo tu contraseña para iniciar sesión',
        inputClass: 'custom-input-class',
      
        // validator is optional
        inputValidator: function(result) {
          if (!result) {
            return 'No puedes dejar el campo vacio!';
          }
        }
      }).then(function(result) {
        if (result.value) {
            enviarContraseña(result.value);
        }
      })
}

function enviarContraseña(correo){
    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: {
            correoRestablecer: correo
        },
        success: function (respuesta) {
            console.log(respuesta)
            if (respuesta.indexOf('enviado') > -1) {
                Swal.fire({
                    icon: 'success',
                    html: 'Tu contraseña será enviada al correo vinculado: ' + correo
                  });
                  $('#modalLogin').modal('show');

            } else {
                Swal.fire('Error', 'El correo que ingresaste no es valido para una cuenta registrada', 'error');
                $('#modalLogin').modal('show');

            }
        },
        error: function (data, error) {
            console.log(data + error)
        }
    })
}

function eliminarServicio(id) {
    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: {
            eliminarServicio: id
        },
        success: function (respuesta) {
            console.log()
            if (respuesta.indexOf('error') == -1) {
                Swal.fire('Correcto', 'Tu servicio se elimino', 'success').then(function () {
                    traerCategoriasTabla();
                    window.location.reload()
                });
            } else {
                Swal.fire('Error', respuesta, 'error');
            }
        },
        error: function (data, error) {
            console.log(data + error)
        }
    })
}

function eliminarCategoria(id) {
    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: {
            eliminarCategoria: id
        },
        success: function (respuesta) {
            console.log()
            if (respuesta.indexOf('error') == -1) {
                Swal.fire('Correcto', 'Tu categoria se elimino', 'success').then(function () {
                    traerCategoriasTabla();
                });
            } else {
                Swal.fire('Error', respuesta, 'error');
            }
        },
        error: function (data, error) {
            console.log(data + error)
        }
    })
}

function eliminarSubCategoria(id) {
    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: {
            eliminarSubCategoria: id
        },
        success: function (respuesta) {
            console.log()
            if (respuesta.indexOf('error') == -1) {
                Swal.fire('Correcto', 'Tu subcategoria se elimino', 'success').then(function () {
                    $.ajax({
                        type: 'post',
                        url: 'ajax/servicios.ajax.php',
                        data: {
                            traerSubCategoriasTabla: 1
                        },
                        success: function (respuesta) {
                            console.log()
                            $('#subcategoriasTabla').empty();
                            $('#subcategoriasTabla').append(respuesta);
                        },
                        error: function (data, error) {
                            console.log(data + error)
                        }
                    })
                });
            } else {
                Swal.fire('Error', respuesta, 'error');
            }
        },
        error: function (data, error) {
            console.log(data + error)
        }
    })
}

function traerMunicipios(estado) {
    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: {
            traerMunicipios: estado
        },
        success: function (respuesta) {
            $('#municipioRegistro').children().remove().end().append(respuesta);
            $('#municipio_ubicacion').children().remove().end().append(respuesta);
        },
        error: function (data, error) {
            enviarError(data + error)
        }
    })
}

function eliminarImagen(id) {
    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: {
            eliminarImagen: id
        },
        success: function (respuesta) {
            if(respuesta == 'eliminado'){
                Swal.fire('Eliminado', 'Su imagen se eliminó correctamente', 'success');
                $('#imagenEditar'+id).remove();
            }else{
                Swal.fire('Error', 'Su imagen no se pudo eliminar', 'error');
            }
        },
        error: function (data, error) {
            enviarError(data + error)
        }
    })
}

function traerImagenes(id) {
    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: {
            traerImagenes: id
        },
        success: function (respuesta) {
            $('#contenedor_imagenes_editar').empty()
            respuesta = JSON.parse(respuesta);
            respuesta.forEach(element => {

                console.log(element)
                $('#contenedor_imagenes_editar').append(''+
                '<div id="imagenEditar'+element.id+'" class="img-item-editar">'+
                '<button onclick="eliminarImagen('+element.id+')"><i class="fa fa-times" aria-hidden="true"></i></button>'+
                '<img src="'+element.ruta+'" alt="imagen">'+
                '</div>'+
                '')
            });
        },
        error: function (data, error) {
            enviarError(data + error)
        }
    })
}

function segundoPasoRegistroServicio() {
    $('#contenedorCarga').show();
    $('#contenedor_imagenes_editar').empty();
    $('.paso1Servicio').hide();
    $('.paso2Servicio').show(300);
    $('#btn1').show()
    miniatura()

}

function segundoPasoEditarServicio() {
    $('.paso1Servicio').hide();
    $('#btn1').hide();
    $('.paso2Servicio').show(300);
    miniatura()
    traerImagenes($('#idServicio').val());
    $('#insertarImagen').show();
    $('#regresarEditar').parent().show()
    $('#servicioEditarImg').parent().hide();

}

function primerPasoEditarServicio() {
    $('.paso1Servicio').show();
    $('.paso2Servicio').hide(300);
    $('#btn1').show();
    $('#insertarImagen').hide();
    $('#regresarEditar').parent().hide();
    $('#servicioEditarImg').parent().show();

}

function primerPasoRegistroServicio() {
    $('.paso2Servicio').hide();
    $('.paso1Servicio').show(300);
}

function traerEstados() {

}

function cambiarGET(param_name, new_value) {
    if (new_value == '') {
        return;
    }

    var url = window.location.search;

    var base = url.substr(0, url.indexOf('?'));

    var query = url.substr(url.indexOf('?') + 1, url.length);

    var a_query = query.split('&');

    for (var i = 0; i < a_query.length; i++) {

        var name = a_query[i].split('=')[0];

        var value = a_query[i].split('=')[1];

        if (name == param_name) a_query[i] = param_name + '=' + new_value;

    }

    window.location.search = base + '?' + a_query.join('&');

}

function miniatura() {

    var contador = $('.contenedor_carga').length

    document.getElementById("formArchivo" + contador).onchange = function (e) {

        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        console.log(contador)
        // Creamos el objeto de la clase FileReader
        let reader = new FileReader();

        // Leemos el archivo subido y se lo pasamos a nuestro fileReader
        reader.readAsDataURL(e.target.files[0]);

        // Le decimos que cuando este listo ejecute el código interno
        reader.onload = function () {
            let preview = document.getElementById('preview' + contador),
                image = document.createElement('img');

            image.src = reader.result;

            preview.innerHTML = '';
            preview.append(image);
        };
    }
}

function miniaturaProducto() {

    var contador = $('.contenedor_carga_producto').length

    document.getElementById("formArchivoProducto" + contador).onchange = function (e) {

        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        console.log(contador)
        // Creamos el objeto de la clase FileReader
        let reader = new FileReader();

        // Leemos el archivo subido y se lo pasamos a nuestro fileReader
        reader.readAsDataURL(e.target.files[0]);

        // Le decimos que cuando este listo ejecute el código interno
        reader.onload = function () {
            let preview = document.getElementById('previewProducto' + contador),
                image = document.createElement('img');

            image.src = reader.result;

            preview.innerHTML = '';
            preview.append(image);
        };
    }
}

function agregarInput() {
    var contador = $('.contenedor_carga').length
    $('#btn' + contador).hide(200);
    contador = Number(contador) + 1;

    $('.contenedor_formulario.servicio.registro.paso2Servicio').append('' +
        '<div id="contenedorCarga' + contador + '" class="form-group contenedor_carga">' +
        '<label for="formArchivo">Por favor seleccione un nuevo archivo para subirlo</label>' +
        '<div class="custom-file">' +
        '<input  name="uploadedfile[' + contador + ']" type="file" class="custom-file-input"  class="form-control-file" id="formArchivo' + contador + '">' +
        '<label class="custom-file-label" for="customFile">Elegir archivo</label>' +
        '<input class="form-control" name="descripcion-img' + contador + '" id="descripcion-img' + contador + '" placeholder="Introduce una descripción para tu imagen">' +
        '</div>' +
        '<div class="prev" id="preview' + contador + '"></div>' +

        '<button onclick="agregarInput()" id="btn' + contador + '" type="button" class="boton naranja mt-3">Agregar más imagenes</button>' +
        '</div>' +
        '')

    miniatura();
}

function agregarInputProducto() {
    var contador = $('.contenedor_carga_producto').length
    $('#btnp' + contador).hide(200);
    contador = Number(contador) + 1;

    $('.contenedor_formulario.servicio.registro.paso2Producto').append('' +
        '<div id="contenedorCargaProducto' + contador + '" class="form-group contenedor_carga_producto">' +
        '<label for="formArchivo">Por favor seleccione un nuevo archivo para subirlo</label>' +
        '<div class="custom-file">' +
        '<input  name="uploadedfileProducto[' + contador + ']" type="file" class="custom-file-input"  class="form-control-file" id="formArchivoProducto' + contador + '">' +
        '<label class="custom-file-label" for="customFile">Elegir archivo</label>' +
        '<input class="form-control" name="descripcion-img' + contador + '" id="descripcion-img-producto' + contador + '" placeholder="Introduce una descripción para tu imagen">' +
        '</div>' +
        '<div class="prev" id="previewProducto' + contador + '"></div>' +

        '<button onclick="agregarInputProducto()" id="btnp' + contador + '" type="button" class="boton naranja mt-3 degradadomanetener">Agregar más imagenes</button>' +
        '</div>' +
        '')

    miniaturaProducto();
}


function modalCategorias() {
    $('.letra_azul.titulo_modal').html('Nueva Categoria')
    traerCategoriasTabla()
    $('#modalCategoria').modal('show');
    document.getElementById("img_categoria_input").onchange = function (e) {

        var fileName = $(this).val().split("\\").pop();
        console.log(fileName)
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        reader.onload = function () {
            let preview = document.getElementById('preview_categoria'),
                image = document.createElement('img');

            image.src = reader.result;

            preview.innerHTML = '';
            preview.append(image);
        };
    }
}

function modalTamaños() {
    traerTamañosTabla($('#idProducto').val());
    $('#productos_select_tamaños').val($('#idProducto').val());
    $('#modalProducto').modal('hide');
    $('#modalTamaños').modal('show');
}

function traerCategoriasTabla() {

    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: {
            traerCategoriasTabla: 1
        },
        success: function (respuesta) {
            $('#categoriasTabla').empty();
            $('#categoriasTabla').append(respuesta);
            console.log()
        },
        error: function (data, error) {
            console.log(data + error)
        }
    })
}

function traerTamañosTabla(id) {

    $.ajax({
        type: 'post',
        url: 'ajax/productos.ajax.php',
        data: {
            traerTamañosTabla: id
        },
        success: function (respuesta) {
            $('#tamañosTabla').empty();
            $('#tamañosTabla').append(respuesta);
            if(respuesta == ''){
                $('#tamañosTabla').append('<div class="alert alert-info">No hay tamaños registrados</div>')
            }
            console.log(respuesta)
        },
        error: function (data, error) {
            console.log(data + error)
        }
    })
}

function traerSubCategorias(id) {

    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: {
            traerSubCategorias: id
        },
        success: function (respuesta) {
            $('#subcategoriaServicio').empty();
            $('#subcategoria_producto').empty();
            $('#subcategoriaServicio').append(respuesta);
            $('#subcategoria_producto').append(respuesta);
            console.log()
        },
        error: function (data, error) {
            console.log(data + error)
        }
    })
}

function agregarTestimonio(id) {
    $('#modalTestimonio').modal('show');
    $('#idTestimonio').val(id);
}

function enviarTestimonio() {
    var estrellas = $('.calificacionEstrellas').starRating('getRating');
    var comentario = $('#calificacionDescripcion').val();
    var idServicio = $('#idTestimonio').val();

    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: {
            estrellas: estrellas,
            comentario: comentario,
            idServicio: idServicio,
            enviarTestimonio: 1
        },
        success: function (respuesta) {
            if (respuesta == 'guardado') {
                Swal.fire('Enviado',
                    'Su testimonio ha sido enviado',
                    'success').then(function () {
                    window.location.reload();
                });
            } else {
                Swal.fire('error', respuesta, 'error');
            }
            console.log(respuesta);
        },
        error: function (data, error) {
            console.log(data + error)
        }
    })
}


function switchCategoriasModal() {
    if ($('#contenedorCargaCategoria').is(':visible')) {
        $('#contenedorCargaCategoria').hide(200);
        $('#registrarCategorias').parent().hide(200);
        $('#registrarSubcategorias').parent().show(200);
        $('#contenedor_tabla_categorias').hide(200);
        $('#contenedor_tabla_subcategorias').show(200);
        $('#categoriaRegistrosub').show(200);
        $('#modalCategoria .titulo_modal.principal').html('Nueva Subcategoria');
        $('#categoriaRegistro').prop('placeholder', 'Introduce el nombre de la subcategoria');
        $('#switchCategoriasBoton').html('Gestionar Categorias');

        $.ajax({
            type: 'post',
            url: 'ajax/servicios.ajax.php',
            data: {
                traerSubCategoriasTabla: 1
            },
            success: function (respuesta) {
                console.log()
                $('#subcategoriasTabla').empty();
                $('#subcategoriasTabla').append(respuesta);
            },
            error: function (data, error) {
                console.log(data + error)
            }
        })

    } else {
        $('#modalCategoria .titulo_modal.principal').html('Nueva Categoria');
        $('#categoriaRegistro').prop('placeholder', 'Introduce el nombre de la categoria');
        $('#contenedorCargaCategoria').show(200);
        $('#registrarCategorias').parent().show(200);
        $('#registrarSubcategorias').parent().hide(200);
        $('#contenedor_tabla_categorias').show(200);
        $('#contenedor_tabla_subcategorias').hide(200);
        $('#categoriaRegistrosub').hide(200);

        traerCategoriasTabla();
    }
}

function verServicio(idServicio) {
    window.location.search('?ruta=Articulo&idServicio=' + idServicio)
}

function publicar(estatus, id) {

    console.log(estatus)
    console.log(id)

    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: {
            publicarServicio: estatus,
            id: id
        },
        success: function (respuesta) {
            if (respuesta == '1') {
                $('#botonPublicar' + id).hide(200);
                $('#botonPublicar' + id).removeClass("btn-danger");
                $('#botonPublicar' + id).addClass("btn-success");
                $('#botonPublicar' + id).html("Publicado");
                $('#botonPublicar' + id).attr("onclick", 'publicar(1, ' + id + ')');
                $('#botonPublicar' + id).show(200);
            } else {
                $('#botonPublicar' + id).hide(200);
                $('#botonPublicar' + id).removeClass("btn-success");
                $('#botonPublicar' + id).addClass("btn-danger");
                $('#botonPublicar' + id).html("No publicado");
                $('#botonPublicar' + id).attr("onclick", 'publicar(0, ' + id + ')');
                $('#botonPublicar' + id).show(200);

            }
            console.log(respuesta)
        },
        error: function (data, error) {
            enviarError(data + error)
        }
    })
}

function recomendar(estatus, id) {

    console.log(estatus)
    console.log(id)

    $.ajax({
        type: 'post',
        url: 'ajax/servicios.ajax.php',
        data: {
            recomendarServicio: estatus,
            id: id
        },
        success: function (respuesta) {
            if (respuesta == '1') {
                $('#botonRecomendado' + id).hide(200);
                $('#botonRecomendado' + id).removeClass("btn-danger");
                $('#botonRecomendado' + id).addClass("btn-success");
                $('#botonRecomendado' + id).html("<i class=\"fa fa-star\" aria-hidden=\"true\"></i>");
                $('#botonRecomendado' + id).attr("onclick", 'recomendar(1, ' + id + ')');
                $('#botonRecomendado' + id).show(200);
            } else {
                $('#botonRecomendado' + id).hide(200);
                $('#botonRecomendado' + id).removeClass("btn-success");
                $('#botonRecomendado' + id).addClass("btn-danger");
                $('#botonRecomendado' + id).html("<i class=\"fa fa-times\" aria-hidden=\"true\"></i>");
                $('#botonRecomendado' + id).attr("onclick", 'recomendar(0, ' + id + ')');
                $('#botonRecomendado' + id).show(200);

            }
            console.log(respuesta)
        },
        error: function (data, error) {
            enviarError(data + error)
        }
    })
}

function busquedaFiltro() {
    var busqueda = $('#table_filter').val();
    var estado = $('#estadoSelect').children('option:selected', this).attr('nombre')
    var municipio = $('#municipioRegistro').children('option:selected', this).attr('nombre')

    if (typeof municipio != 'undefined') {
        municipio.replace(/[\. ,:-]+/g, "");
    }

    if (typeof municipio == 'undefined') {
        municipio = '';
    }

    if (typeof estado == 'undefined') {
        estado = '';
    }

    console.log(estado, municipio, busqueda);

    if (municipio != '' && estado != '' && busqueda != '') {
        window.location.search = '?ruta=Servicios&s=' + busqueda + '&estado=' + estado + '&municipio=' + municipio + '';

    } else if (municipio != '' && municipio != null && estado == '') {
        window.location.search = '?ruta=Servicios&s=' + busqueda + '&municipio=' + municipio + '';

    } else if (municipio == '' && estado != '' && busqueda != '') {
        window.location.search = '?ruta=Servicios&s=' + busqueda + '&estado=' + estado + '';

    } else if (municipio == '' && estado == '' && busqueda != '') {
        window.location.search = '?ruta=Servicios&s=' + busqueda;

    } else if (busqueda == '' && estado != '' && municipio != '') {
        window.location.search = '?ruta=Servicios&estado=' + estado + '&municipio=' + municipio + '';

    } else if (busqueda == '' && estado != '') {
        window.location.search = '?ruta=Servicios&estado=' + estado;

    } else if (busqueda != '' && estado != '') {
        window.location.search = '?ruta=Servicios&estado=' + estado + '&s=' + busqueda;

    } else if (busqueda != '' && municipio != '') {
        window.location.search = '?ruta=Servicios&municipio=' + busqueda + '&s=' + busqueda;

    } else {
        Swal.fire('Error', 'Ingresa al menos un parametro de busqueda', 'error');
        return
    }

}

function enviarContactoForm() {
    var nombre = $('#nombreContacto').val();
    var correo = $('#correoContacto').val();
    var telefono = $('#telefonoContacto').val();

    if (nombre == '' || correo == '' || telefono == '') {
        Swal.fire('Error', 'No puedes dejar campos vacios', 'error');
    } else {
        $.ajax({
            type: 'post',
            url: 'ajax/servicios.ajax.php',
            data: {
                contactarForm: 1,
                nombre,
                correo,
                telefono

            },
            success: function (respuesta) {
                Swal.fire({
                    icon: 'success',
                    title: 'Enviado',
                    text: 'Tu informacion fue enviada, nos pondremos en contacto contigo lo más pronto posible',
                    footer: '<a onclick="modalRegistro()">Registrarse</a>'
                })
                console.log(respuesta)
            },
            error: function (data, error) {
                enviarError(data + error)
            }
        })
    }
}

function actualizarValueAddress(valor) {

    $('#address').val(valor + ', ' + $('#municipioRegistro option:selected').text())
}

$(document).ready(function () {

    $('#busquedaNav, #busquedaFiltros').on('keypress', function (e) {
        if (e.which === 13) {

            //Disable textbox to prevent multiple submit
            $(this).attr("disabled", "disabled");

            //Do Stuff, submit, etc..
            var info = $(this).val();
            console.log(info);
            window.location.search = '?ruta=Tienda&pagina=1&Busqueda=' + info


            //Enable the textbox again if needed.
            $(this).removeAttr("disabled");
        }
    });
})