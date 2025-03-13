function registrarProducto() {

    var id = $('#idProducto').val();
    var nombre = $('#nombre_producto').val();
    var descripcion = $('#descripcion_producto').val()
    var categoria = $('#categoria_producto').val();
    var subcategoria = $('#subcategoria_producto').val();
    var tamaños = $('#json_productos').val();

    var formData = new FormData();

    var contador = $('.contenedor_carga_producto').length;

    formData.append('nombre', nombre);
    formData.append('descripcion', descripcion);
    formData.append('tamaños', tamaños);
    formData.append('categoria', categoria);
    formData.append('subcategoria', subcategoria);
    formData.append('nuevoProducto', '1');
    formData.append('contador', contador);

    for (var i = 0; i < contador; i++) {
        console.log(i, contador);
        e = i + 1;
        console.log("Hola: " + e)
        formData.append('archivo' + i, $('#modalProducto .custom-file-input')[i].files[0]);
        formData.append('descripcion' + e, $('#descripcion-img-producto' + e).val());
    }

    if (nombre == '' && descripcion == '' || tamaños == '' || categoria == '' || subcategoria == '') {
        Swal.fire('Error', 'No puedes dejar campos vacios', 'error');
        console.log(nombre, descripcion, tamaños, categoria, subcategoria);
        return;
    }

    $.ajax({
        type: 'post',
        url: 'ajax/productos.ajax.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta.indexOf('success') > -1) {
                Swal.fire('Correcto', 'Tu producto fue enviado para su revisón antes de ser publicado', 'success').then(function () {
                    window.location.reload();
                })
            } else {
                Swal.fire('Error', respuesta, 'error');
            }
            console.log(respuesta);
            console.log(nombre, descripcion, tamaños, precio, categoria, subcategoria);

        },
        error: function (e, j, h) {
            console.log(e, j, h)
        },
        beforeSend: function () {
            swal({
                imageUrl: "imagenes/Iconos/loading.gif",
                imageWidth: 100,
                imageHeight: 100,
                imageAlt: 'GIF',
                title: "Cargando...",
                text: "Por favor espera",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            $('.swal2-content').css('margin-bottom', '3rem')
        },
        complete: function () {
            swal.close()
            $('.swal2-content').css('margin-bottom', '0')
        }
    });
}

function subirImagenProducto() {

    var id = $('#idProducto').val();

    var descripcion = $('#descripcion-img-producto1').val();

    var formData = new FormData();

    formData.append('descripcionProducto', descripcion);
    formData.append('subirIMG', 1);
    formData.append('idProducto', id);
    formData.append('imagen_subir', $('#modalProducto .custom-file-input')[0].files[0]);


    if (descripcion == '') {
        Swal.fire('Error', 'No puedes dejar campos vacios', 'error');
        return;
    }

    $.ajax({
        type: 'post',
        url: 'ajax/productos.ajax.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta.indexOf('insertó') > -1) {
                Swal.fire('Correcto', 'Tu imagen fue agregada al producto', 'success').then(function () {
                    traerImagenesProductos(id);
                    $('#previewProducto1').empty();
                    $('#descripcion-img-producto1').val('');
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
        beforeSend: function () {
            swal({
                imageUrl: "imagenes/Iconos/loading.gif",
                imageWidth: 100,
                imageHeight: 100,
                imageAlt: 'GIF',
                title: "Cargando...",
                text: "Por favor espera",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            $('.swal2-content').css('margin-bottom', '3rem')
        },
        complete: function () {
            swal.close()
            $('.swal2-content').css('margin-bottom', '0')
        }
    });
}

function actualizarProducto() {

    var id = $('#idProducto').val();
    var nombre = $('#nombre_producto').val();
    var descripcion = $('#descripcion_producto').val()
    var precio = $('#precio_producto').val();
    var categoria = $('#categoria_producto').val();
    var subcategoria = $('#subcategoria_producto').val();

    var formData = new FormData();

    formData.append('nombre', nombre);
    formData.append('descripcion', descripcion);
    formData.append('precio', precio);
    formData.append('categoria', categoria);
    formData.append('subcategoria', subcategoria);
    formData.append('editarProducto', id);

    console.log(id)

    if (nombre == '' && descripcion == '' || precio == '' || categoria == '' || subcategoria == '') {
        Swal.fire('Error', 'No puedes dejar campos vacios', 'error');
        console.log(nombre, descripcion, stock, precio, categoria, subcategoria);
        return;
    }

    $.ajax({
        type: 'post',
        url: 'ajax/productos.ajax.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta.indexOf('success') > -1) {
                Swal.fire('Correcto', 'Tu producto fue actualizado', 'success').then(function () {
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
        beforeSend: function () {

        },
        complete: function () {

        }
    });
}

function eliminarProducto(id) {
    $.ajax({
        type: 'post',
        url: 'ajax/productos.ajax.php',
        data: {
            eliminarProducto: id
        },
        success: function (respuesta) {
            console.log()
            if (respuesta.indexOf('error') == -1) {
                Swal.fire('Correcto', 'Tu producto se eliminó', 'success').then(function () {
                    window.location.reload();
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


function registrarTamaño() {

    var tamaño = $('#tamañoRegistro').val();
    var precio = $('#precio_producto').val();
    var cantidad = $('#cantidad_producto').val();
    var descuento = $('#descuento_producto').val();
    var producto = $('#productos_select_tamaños').val();
    var formData = new FormData();

    formData.append('tamaño', tamaño);
    formData.append('precio', precio);
    formData.append('cantidad', cantidad);
    formData.append('descuento', descuento);
    formData.append('producto', producto);
    formData.append('nuevoTamaño', 1);

    if (tamaño == '') {
        Swal.fire('Error', 'No puedes dejar campos vacios', 'error');
        return;
    }

    $.ajax({
        type: 'post',
        url: 'ajax/productos.ajax.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta.indexOf('success') > -1) {
                $('#tamañoRegistro, #precio_producto, #cantidad_producto, #descuento_producto, #productos_select_tamaños').val('');
                Swal.fire('Correcto', 'Tu tamaño fue registrado', 'success').then(function () {
                    traerTamañosTabla($('#idProducto').val());
                });
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


function agregarTamaño() {

    var tamaño = $('#tamaño_producto').val();
    tamañoSinEspacios = tamaño.trim()

    var cantidad = $('#stock_producto').val();

    var precio = $('#precio_producto_agregar_tamaño').val();
    var descuento = $('#descuento_producto_agregar_tamaño').val();

    var contador = 0;

    contador = $('#body_tabla_tamaños').children('tr').length;

    contador = Number(contador) + Number(1);

    if (tamaño == '') {
        Swal.fire('Error', 'No puedes dejar campos vacios', 'error');
        return;
    }

    console.log(tamaño, cantidad);
    //Debug

    var json = $('#json_productos').val();

    if (json == '') {
        json = [];
    } else {
        json = JSON.parse(json);
    }

    json.push({
        'tamaño': tamaño,
        'cantidad': cantidad,
        'precio': precio,
        'descuento': descuento
    });

    json = JSON.stringify(json);

    $('#json_productos').val(json);

    console.log(json);
    //debug JSON para el back

    $('#body_tabla_tamaños').append('' +
        '<tr id="tamaño' + tamañoSinEspacios + '">' +
            '<th scope="row">' +
                contador +
            '</th>' +
            '<td>' +
                tamaño +
            '</td>' +
            '<td>' +
                cantidad +
            '</td>' +
            '<td>' +
                precio +
            '</td>' +
            '<td>' +
                descuento +
            '</td>' +
            '<td>' +
                '<div onclick="eliminarTamañoJSON(' + "'" + tamaño + "'" + ')" class="btn btn-danger">' +
                    '<i class="fa fa-trash" aria-hidden="true"></i>' +
                '</div>' +
            '</td>' +
        '</tr>' +
        '')


}

function getIndexOfK(arr, k) {
    for (var i = 0; i < arr.length; i++) {
        arr[i] = Object.values(arr[i]);
        var index = arr[i].indexOf(k);
        if (index > -1) {
            return [i, index];
        }
    }
}

function eliminarTamañoJSON(tamaño) {
    var json = $('#json_productos').val();
    json = JSON.parse(json)
    tamañoSinEspacios = tamaño.trim()
    jsonArray = Object.values(json);
    //Sacar todo lo necesario

    var pos = getIndexOfK(jsonArray, tamaño)
    //Recorrer el JSON multidimensional y sacar la posicion

    var elementoEliminado = json.splice(pos[0], 1)
    //Eliminar

    json = JSON.stringify(json);
    $('#json_productos').val(json);
    //Guarar el nuevo JSON

    $('#tamaño' + tamañoSinEspacios).hide(300).remove()
    //Remover de la vista

}

function eliminarTamaño(id) {

    var formData = new FormData();

    formData.append('eliminarTamaño', id);

    $.ajax({
        type: 'post',
        url: 'ajax/productos.ajax.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta.indexOf('success') > -1) {
                Swal.fire('Correcto', 'Tu tamaño fue eliminado', 'success').then(function () {
                    traerTamañosTabla();
                });

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

function editarProducto(idProducto) {

    $.post("ajax/productos.ajax.php", {
        traerProductoEditar: idProducto
    }, function (respuesta) {
        var json = JSON.parse(respuesta);
        console.log(json)
        var id = json[0].id
        var nombre = json[0].titulo
        var descripcion = json[0].descripcion
        //var jsonTamaños = json[0].json_tamaños
        var categoria = json[0].idCategoria
        var subcategoria = json[0].idSubcategoria

        console.log(id)

        $('#idProducto').val(id);
        $('#nombre_producto').val(nombre);
        $('#descripcion_producto').val(descripcion)
        $('#categoria_producto').val(categoria).trigger('change');
        setTimeout(() => {
            $('#subcategoria_producto').val(subcategoria);
        }, 1000);

        $('#modalProducto h3').html('Editar Producto');
        $('#tamaño_producto, #tabla_tamaños, #boton_tamaño_nuevo').parent().parent().attr('style', 'display:none !important');
        $('.botonesActualizar').show();
        $('.botonesActualizar').css('display', 'flex');
        $('#botonesRegistro').hide();

        primerPasoEditarProducto()

        $('#modalProducto').modal('show');

    })
}

function publicarProducto(estatus, id, event) {

    event.preventDefault();

    console.log(estatus)
    console.log(id)

    $.ajax({
        type: 'post',
        url: 'ajax/productos.ajax.php',
        data: {
            publicarProducto: estatus,
            id: id
        },
        success: function (respuesta) {
            if (respuesta == '1') {
                $('#botonPublicar' + id).hide(200);
                $('#botonPublicar' + id).removeClass("btn-danger");
                $('#botonPublicar' + id).addClass("btn-success");
                $('#botonPublicar' + id).html("Publicado");
                $('#botonPublicar' + id).attr("onclick", 'publicarProducto(1, ' + id + ', event)');
                $('#botonPublicar' + id).show(200);
            } else {
                $('#botonPublicar' + id).hide(200);
                $('#botonPublicar' + id).removeClass("btn-success");
                $('#botonPublicar' + id).addClass("btn-danger");
                $('#botonPublicar' + id).html("No publicado");
                $('#botonPublicar' + id).attr("onclick", 'publicarProducto(0, ' + id + ', event)');
                $('#botonPublicar' + id).show(200);

            }
            console.log(respuesta)
            return;
        },
        error: function (data, error, xd) {
            console.log(data, error, xd)
        }
    })
}

function recomendarProducto(estatus, id, event) {

    event.preventDefault();

    console.log(estatus)
    console.log(id)

    $.ajax({
        type: 'post',
        url: 'ajax/productos.ajax.php',
        data: {
            recomendarProducto: estatus,
            id: id
        },
        success: function (respuesta) {
            if (respuesta == '1') {
                $('#botonRecomendado' + id).hide(200);
                $('#botonRecomendado' + id).removeClass("btn-danger");
                $('#botonRecomendado' + id).addClass("btn-success");
                $('#botonRecomendado' + id).html("<i class=\"fa fa-star\" aria-hidden=\"true\"></i>");
                $('#botonRecomendado' + id).attr("onclick", 'recomendarProducto(1, ' + id + ')');
                $('#botonRecomendado' + id).show(200);
            } else {
                $('#botonRecomendado' + id).hide(200);
                $('#botonRecomendado' + id).removeClass("btn-success");
                $('#botonRecomendado' + id).addClass("btn-danger");
                $('#botonRecomendado' + id).html("<i class=\"fa fa-times\" aria-hidden=\"true\"></i>");
                $('#botonRecomendado' + id).attr("onclick", 'recomendarProducto(0, ' + id + ')');
                $('#botonRecomendado' + id).show(200);

            }
            console.log(respuesta)
            return;

        },
        error: function (data, error, error2) {
            console.log(data, error, error2)
        }
    })
}

function controladorCantidad(elemento) {
    console.log(elemento);
    var maximo = $(elemento).children('option:selected').attr('cantidad');
    var id = $(elemento).children('option:selected').attr('identificador');
    var precio = $(elemento).children('option:selected').attr('precio');
    var newVal = $('#cantidad').val()

    $('#cantidad').val(1);
    $('#tamaño_id_articulo').val(id);
    $('#cantidad').attr('max', maximo);
    $('#precio_articulo').text(Number(newVal) * Number(precio))
    $('#precio_producto_carrito').val(Number(precio))

    if (maximo == '0') {
        $('.bootnagregarcarrito.degradadomanetener').prop('disabled', true);
    } else {
        $('.bootnagregarcarrito.degradadomanetener').prop('disabled', false);
    }
}

function añadirAlCarrito() {

    if ($('#SesionIniciada').val() == 0) {
        $('#modalLogin').modal('show');
        return;
    }

    var id = $('#id_producto_carrito').val();
    var nombre = $('#nombre_producto_carrito').val();
    var precio = $('#precio_producto_carrito').val();
    var tamaño = $('#talla').val()
    var id_tamaño = $('#tamaño_id_articulo').val()
    var cantidad = $('#cantidad').val();

    console.log(id, nombre, precio, tamaño, cantidad)

    if (id == '' || nombre == '' || precio == '' || cantidad == '' || id_tamaño == '') {
        Swal.fire('Error', 'Debes seleccionar un tamaño', 'error');
    }

    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            id,
            nombre,
            cantidad,
            tamaño,
            precio,
            id_tamaño,
            añadirCarrito: 1
        },
        success: function (respuesta) {
            console.log(respuesta)

            if (respuesta == 'guardado') {
                Swal.fire({
                    title: '<strong>Nuevos productos añadidos a tu carrito</strong>',
                    icon: 'info',
                    html: 'Puedes ver tu carrito o seguir navegando en los productos',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: '<i class="fa fa-shopping-cart" aria-hidden="true"></i> Ver carrito!',
                    cancelButtonText: '<i class="fa fa-archive"></i> Seguir navegando',
                }).then(function (isConfirm) {
                    console.log(isConfirm)
                    if (isConfirm.value == true) {
                        window.location.search = "?ruta=Carrito";
                    } else {
                        //Cancelo
                    }
                })
            } else {
                Swal.fire('Error', 'No se pudo guardar tu carrito ' + respuesta, 'error')
            }

            $('.swal2-icon.swal2-info').css('display', 'flex')

        },
        error: function (data, error, error2) {
            console.log(data, error, error2)
        }
    })
}

function marcarComoDireccionPrincipal(id){
    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            id,
            marcarComoDireccionPrincipal: 1
        },
        success: function (respuesta) {
            console.log(respuesta)
            if (respuesta == 'success') {
                Swal.fire('Direccion actualizada!', 'Su dirrecion principal ha cambiado', 'success').then(function () {
                    window.location.reload();
                })
            } else {
                Swal.fire('Error', 'No se pudo completar tu operacion' + respuesta, 'error')
            }
        },
        error: function (data, error, error2) {
            console.log(data, error, error2)
        }
    })
}

function añadirAlCarritoCurso() {

    if ($('#SesionIniciada').val() == 0) {
        $('#modalLogin').modal('show');
        return;
    }

    var id = $('#id_producto_carrito').val();
    var nombre = $('#nombre_producto_carrito').val();
    var tamaño = $('#talla').val()
    var precio = $('#precio_' + tamaño + '_carrito').val();
    var cantidad = $('#cantidad').val();

    console.log(id, nombre, precio, tamaño, cantidad)

    if (id == '' || nombre == '' || precio == '' || cantidad == '') {
        Swal.fire('Error', 'Debes seleccionar un tamaño', 'error');
    }

    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            id,
            nombre,
            cantidad,
            tamaño,
            precio,
            añadirCarrito: 1
        },
        success: function (respuesta) {
            console.log(respuesta)

            if (respuesta == 'guardado') {
                Swal.fire({
                    title: '<strong>Nuevos productos añadidos a tu carrito</strong>',
                    icon: 'info',
                    html: 'Puedes ver tu carrito o seguir navegando en los productos',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: '<i class="fa fa-shopping-cart" aria-hidden="true"></i> Ver carrito!',
                    cancelButtonText: '<i class="fa fa-archive"></i> Seguir navegando',
                }).then(function (isConfirm) {
                    console.log(isConfirm)
                    if (isConfirm.value == true) {
                        window.location.search = "?ruta=Carrito";
                    } else {
                        //Cancelo
                    }
                })
            } else {
                Swal.fire('Error', 'No se pudo guardar tu carrito ' + respuesta, 'error')
            }

            $('.swal2-icon.swal2-info').css('display', 'flex')

        },
        error: function (data, error, error2) {
            console.log(data, error, error2)
        }
    })
}

function eliminarDelCarrito(id) {
    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            eliminarDelCarrito: id
        },
        success: function (respuesta) {
            console.log(respuesta)

            if (respuesta == 'eliminado') {
                Swal.fire('Eliminado', 'Se eliminó del carrito', 'success').then(function () {
                    window.location.reload();
                })
            } else {
                Swal.fire('Error', 'No se pudo modificar tu carrito ' + respuesta, 'error')
            }
        },
        error: function (data, error, error2) {
            console.log(data, error, error2)
        }
    })
}

function controladorPago() {
    if ($('#direccion_envio').val() == 'sn') {
        $('#modal-envio').modal('show');
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Seleccione o agregue una ubicacion primero',
            showConfirmButton: false,
            timer: 2000
        })

    } else {
        $('#modal-tarjeta').modal('show');
    }
}

function nuevaDireccion() {
    $('#modal-envio').modal('show');
}

function seleccionarDireccion(direccion) {
    console.log(direccion);
    for (let i = 1; i <= $('.plan-selection').length; i++) {
        $('#direccion' + i).prop("checked", false);
    }
    $(direccion).siblings('input').prop("checked", true);
    direccion = direccion.text();
    direccion = direccion.trim();
    $('#direccion_envio').val(direccion);
}

function pagarPedido() {
    var direccion = $('#direccion_envio').val();

    Swal.fire('Pago deshabilitado', 'No se activaron pagos con fines de prueba', 'info').then(function () {
        $.ajax({
            type: 'post',
            url: 'ajax/usuario.ajax.php',
            data: {
                direccion,
                nuevoPedido: 1
            },
            success: function (respuesta) {
                console.log(respuesta)
                if (respuesta == 'success') {
                    Swal.fire('Compra realizada!', 'Su compra se realizó exitosamente, en unos momentos será redirigido a su pedido', 'success').then(function () {
                        window.location.search = '?ruta=MisPedidos';
                    })
                } else {
                    Swal.fire('Error', 'No se pudo completar tu compra' + respuesta, 'error')
                }
            },
            error: function (data, error, error2) {
                console.log(data, error, error2)
            }
        })
    });
}

function verCompra(id) {
    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            id_pedido: id,
            traerPedidos: 1
        },
        success: function (respuesta) {
            $('#contenedor_compra').empty()
            $('#contenedor_compra').append(respuesta)
            if (!$('#modalCompra').is(':visible')) {
                $('#modalCompra').modal('show');
            }
        },
        error: function (data, error, error2) {
            console.log(data, error, error2)
        },
        beforeSend: function () {
            swal({
                imageUrl: "imagenes/Iconos/loading.gif",
                imageWidth: 100,
                imageHeight: 100,
                imageAlt: 'GIF',
                title: "Cargando...",
                text: "Por favor espera",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            $('.swal2-content').css('margin-bottom', '3rem')
        },
        complete: function () {
            swal.close()
            $('.swal2-content').css('margin-bottom', '0')
        }
    })
}

function marcarComo(id, estatus, elemento) {
    if ($(elemento).hasClass("active")) {
        bool = 0;
    } else {
        bool = 1;
    }
    console.log(estatus)

    if (estatus == 'enviado' && bool == 1) {

        Swal.mixin({
            input: 'text',
            confirmButtonText: 'Siguiente &rarr;',
            showCancelButton: true,
            progressSteps: ['1', '2']
        }).queue([{
                title: 'Paqueteria de envio',
                text: 'Seleccione paqueteria',
                inputOptions: {
                    'FedEx': 'FedEx',
                    'UPS': 'UPS',
                    'DHL': 'DHL'
                  },
                input: 'select'
            },{
                title: 'Ingresa id de rastreo',
                inputPlaceholder: "Ejemplo: #242432",

            }
        ]).then((result) => {
            if (result.value) {
                console.log(result.value);
                const answers = JSON.stringify(result.value)
                var paqueteria = result.value[0];
                var id_rastreo = result.value[1];
                Swal.fire({
                    title: 'Correcto!',
                    html: 'Enviado por: ' + paqueteria + '<br>' + 'ID de Rastreo: ' + id_rastreo,
                    confirmButtonText: 'Aceptar'
                }).then(function(){
                    enviarAjaxCambioEstatus(id, estatus, bool, paqueteria, id_rastreo);
                })
            }

        })
        $('#modalCompra').modal('hide');

    } else {
        enviarAjaxCambioEstatus(id, estatus, bool);
    }
}

function enviarAjaxCambioEstatus(id, estatus, bool, paqueteria = 0, id_rastreo = 0){
    
    $.ajax({
        type: 'post',
        url: 'ajax/usuario.ajax.php',
        data: {
            id_pedido: id,
            estatus,
            bool,
            paqueteria,
            id_rastreo,
            actualizarEstatus: 1
        },
        success: function (respuesta) {
            console.log(respuesta)
            console.log("Bool: " + bool);

            verCompra(id)
            setTimeout(() => {
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'El estatus ha sido actualizado',
                    showConfirmButton: false,
                    timer: 1500
                })

            }, 200);
        },
        error: function (data, error, error2) {
            console.log(data, error, error2)
        },
        beforeSend: function () {
            swal({
                imageUrl: "imagenes/Iconos/loading.gif",
                imageWidth: 100,
                imageHeight: 100,
                imageAlt: 'GIF',
                title: "Cargando...",
                text: "Por favor espera",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            $('.swal2-content').css('margin-bottom', '3rem')
        },
        complete: function () {
            swal.close()
            $('.swal2-content').css('margin-bottom', '0')
        }
    })
}


function traerImagenesProductos(id) {
    $.ajax({
        type: 'post',
        url: 'ajax/productos.ajax.php',
        data: {
            traerImagenes: id
        },
        success: function (respuesta) {
            $('#contenedor_imagenes_editar').empty()
            respuesta = JSON.parse(respuesta);
            respuesta.forEach(element => {

                console.log(element)
                $('#contenedor_imagenes_editar').append('' +
                    '<div id="imagenEditar' + element.id + '" class="img-item-editar">' +
                    '<button onclick="eliminarImagen(' + element.id + ')"><i class="fa fa-times" aria-hidden="true"></i></button>' +
                    '<img src=".' + element.ruta + '" alt="imagen">' +
                    '</div>' +
                    '')
            });
        },
        error: function (data, error) {
            enviarError(data + error)
        },
        beforeSend: function () {
            swal({
                imageUrl: "imagenes/Iconos/loading.gif",
                imageWidth: 100,
                imageHeight: 100,
                imageAlt: 'GIF',
                title: "Cargando...",
                text: "Por favor espera",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            $('.swal2-content').css('margin-bottom', '3rem')
        },
        complete: function () {
            swal.close()
            $('.swal2-content').css('margin-bottom', '0')
        }
    })
}

function segundoPasoRegistroProducto() {
    $('#contenedorCargaProducto').show();
    $('#contenedor_imagenes_editar').empty();
    $('.paso1Producto').hide();
    $('.paso2Producto').show(300);
    $('#btnp1').show()
    miniaturaProducto()
}

function segundoPasoEditarProducto() {
    $('.paso1Producto').hide();
    $('#btnp1').hide();
    $('.paso2Producto').show(300);
    miniaturaProducto()
    traerImagenesProductos($('#idProducto').val());
    $('#insertarImagen').show();
    $('#regresarEditar').parent().show()
    $('#ProductoEditarImg').parent().hide();
}

function primerPasoEditarProducto() {
    $('.paso1Producto').show();
    $('.paso2Producto').hide(300);
    $('#btnp1').show();
    $('#insertarImagen').hide();
    $('#regresarEditar').parent().hide();
    $('#ProductoEditarImg').parent().show();

}

function primerPasoRegistroProducto() {
    $('.paso2Producto').hide();
    $('.paso1Producto').show(300);
}


function modalRegistroProducto() {
    primerPasoRegistroProducto();
    $('#idProducto').val('');
    $('#nombre_producto').val('');
    $('#descripcion_producto').val('')
    $('#stock_producto').val('1');
    $('#precio_producto').val('0');
    $('#categoria_producto').val('');
    $('#subcategoria_producto').val('');

    $('#modalProducto h3').html('Nuevo Producto');
    $('#tamaño_producto, #tabla_tamaños, #boton_tamaño_nuevo').parent().parent().attr('style', 'display:flex !important');

    $('.botonesActualizar').hide();
    $('.botonesRegistro').show();
    $('.botonesRegistro').css('display', 'flex');
    $('#modalProducto').modal('show');
}