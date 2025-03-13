
$(document).ready(function () {

    $('#anonimo').change(function () {
        var tipoDenuncia = $('#anonimo').val();

        if (tipoDenuncia == "anonimo") {
            ocultarCampos();
        } else {
            mostrarCampos();
        }
    })

    $('#tipo').change(function () {
        var tipo = $('#tipo').val();

        if (tipo == "queja") {
            ocultarTipoDenuncia();
            mostrarCampos();
            mostrarPruebas();
        }

        if (tipo == "denuncia") {
            mostrarTipoDenuncia();
            ocultarCampos();
            mostrarPruebas();
        }

        if (tipo == "felicitación") {
            ocultarTipoDenuncia();
            mostrarCampos();
            ocultarPruebas();
        }

        if (tipo == "sugerencia") {
            ocultarTipoDenuncia();
            mostrarCampos();
            ocultarPruebas();
        }

        console.log(tipo)

    })



    $("prueba").click(function () {
        if ($("#prueba").is(':checked')) {
            $("#prueba").attr('checked', false);
        } else {
            $("#prueba").attr('checked', true);
        }
    });

    $("#prueba").change(function () {
        if ($("#prueba").is(':checked')) {
            mostrarCarga();
        } else {
            ocultarCarga();
        }
    });

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    function input1() {
        document.getElementById("formArchivo").onchange = function (e) {
            // Creamos el objeto de la clase FileReader
            let reader = new FileReader();

            // Leemos el archivo subido y se lo pasamos a nuestro fileReader
            reader.readAsDataURL(e.target.files[0]);

            // Le decimos que cuando este listo ejecute el código interno
            reader.onload = function () {
                let preview = document.getElementById('preview'),
                    image = document.createElement('img');

                image.src = reader.result;

                preview.innerHTML = '';
                preview.append(image);
            };
        }
    }

    function input2() {
        document.getElementById("formArchivo2").onchange = function (e) {
            // Creamos el objeto de la clase FileReader
            let reader = new FileReader();

            // Leemos el archivo subido y se lo pasamos a nuestro fileReader
            reader.readAsDataURL(e.target.files[0]);

            // Le decimos que cuando este listo ejecute el código interno
            reader.onload = function () {
                let preview = document.getElementById('preview2'),
                    image = document.createElement('img');

                image.src = reader.result;

                preview.innerHTML = '';
                preview.append(image);
            };
        }
    }

    function input3() {
        document.getElementById("formArchivo3").onchange = function (e) {
            // Creamos el objeto de la clase FileReader
            let reader = new FileReader();

            // Leemos el archivo subido y se lo pasamos a nuestro fileReader
            reader.readAsDataURL(e.target.files[0]);

            // Le decimos que cuando este listo ejecute el código interno
            reader.onload = function () {
                let preview = document.getElementById('preview3'),
                    image = document.createElement('img');

                image.src = reader.result;

                preview.innerHTML = '';
                preview.append(image);
            };
        }
    }

    function input4() {
        document.getElementById("formArchivo4").onchange = function (e) {
            let reader = new FileReader();

            reader.readAsDataURL(e.target.files[0]);

            reader.onload = function () {
                let preview = document.getElementById('preview4'),
                    image = document.createElement('img');

                image.src = reader.result;

                preview.innerHTML = '';
                preview.append(image);
            };
        }
    }

    $('#btn1').on('click', function () {
        $('#btn1').slideUp(200);
        $('<div id="contenedorCarga" class="form-group">' +
            '<input type="hidden" name="MAX_FILE_SIZE" value="8000000" />' +
            '<label for="formArchivo2">Por favor seleccione el archivo para subirlo</label>' +
            '<input type="file" name="uploadedfile2" class="form-control-file" id="formArchivo2">' +
            '<div id="preview2"></div>' +
            '<button id="btn2" type="button" class="btn btn-info mt-3">Agregar más imagenes</button>' +
            '</div>'
        ).insertBefore('#contenedorSubmit')

        input2();

        $('#btn2').on('click', function () {
            $('#btn2').slideUp(200);
            $('<div id="contenedorCarga" class="form-group">' +
                '<input type="hidden" name="MAX_FILE_SIZE" value="8000000" />' +
                '<label for="formArchivo3">Por favor seleccione el archivo para subirlo</label>' +
                '<input type="file" name="uploadedfile3" class="form-control-file" id="formArchivo3">' +
                '<div id="preview3"></div>' +
                '<button id="btn3" type="button" class="btn btn-info mt-3">Agregar más imagenes</button>' +
                '</div>'
            ).insertBefore('#contenedorSubmit')

            input3();

            $('#btn3').on('click', function () {
                $('#btn3').slideUp(200);
                $('<div id="contenedorCarga" class="form-group">' +
                    '<input type="hidden" name="MAX_FILE_SIZE" value="8000000" />' +
                    '<label for="formArchivo4">Por favor seleccione el archivo para subirlo</label>' +
                    '<input type="file" name="uploadedfile4" class="form-control-file" id="formArchivo4">' +
                    '</div>' +
                    '<div id="preview4"></div>'
                ).insertBefore('#contenedorSubmit')

                input4();
            })
        })

    })

    //input1();

})