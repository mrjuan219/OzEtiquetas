<div class="divdemainpruincipal" style="background-image: url('imagenes/Sliders/carrito.jpg'); height: 400px; background-position: center 35%;">

    <div class="recuadrodevideovista" style=" height: 400px;"></div>
    <div class="contenedor-carousel">
        <h1 class="titulo-slider bold">
            Mis pedidos
        </h1>
    </div>

</div>

<?php
    $pedidos = ControladorUsuario::traerPedidosCtr($_SESSION['usuario']);


    echo '
<div class="contenedor_principal_mispedidos">
    <div class="sub_contenedor_mispedidos">
        <h3>
            Mis pedidos
        </h3>
    </div>
    <div class="contenedor_tabla">
        <table class="table">
            <thead>
                <tr class="bg-azul">
                    <th scope="col">Fecha de compra</th>
                    <th scope="col">Pedido</th>
                    <th scope="col" style="width: 35%;">Estado</th>
                    <th scope="col" style="width: 25%;">Detalle</th>
                </tr>
            </thead>
            <tbody>';

            foreach($pedidos as $pedido){
                echo '
                <tr>
                    <th scope="row" style="text-transform: capitalize">'. strftime("%A %d/%m/%Y",strtotime($pedido['fecha_pedido'])).'</th>
                    <td>#'.$pedido['folio_pedido'].'</td>
                    <td>'.$pedido['estado'].'</td>
                    <td>
                        <div onclick="verCompra('."'".$pedido['id']."'".')" class="btn btn-detalles-compra">Detalles de compra</div>
                    </td>
                </tr>
                ';
            }
                
                echo '
            </tbody>
        </table>
    </div>
    <hr>
    <br><br>
    <div class="contenedor_direcciones">

    ';

        $direcciones = ControladorUsuario::traerDireccionesCtr($_SESSION['usuario']);
        $datos = ControladorUsuario::traerDatosUsuarioCtr($_SESSION['usuario']);
        foreach($direcciones as $direccion){
            if($direccion['principal'] == 1){
                $principal = 'seleccionado';
                $icono = '<i class="fa fa-check"></i>';
                $titulo = 'Dirección principal';

            }else{
                $principal = '';
                $icono = '';
                $titulo = $direccion['nombre_ubicacion'];
                $titulo = 'Dirección secundaria';
            }
            echo '
            <div class="contenedor_direccion">
                <div style="cursor: pointer" class="contenedor_titulo '.$principal.'" onclick="marcarComoDireccionPrincipal('."'".$direccion['id']."'".')">
                    <h4>'.$titulo.'</h4>
                    <div class="icono">
                        '.$icono.'
                    </div>
                </div>

                <div class="subcontenedor_direccion">
                    <h4>
                        '.$datos['nombre'].'
                    </h4>
                    <p>
                        Nombre de la dirección: '.$direccion['nombre_ubicacion'].'
                    </p>
                    <p>
                        Direccion: '.$direccion['calle'].' #'.$direccion['numero'].'
                    </p>
                    <p>
                        Colonia: '.$direccion['colonia'].'
                    </p>
                    <p>
                        CP: '.$direccion['codigo_postal'].'
                    </p>
                    <p>
                    '.$direccion['municipio'].', '.$direccion['estado'].', '.$direccion['pais'].'
                    </p>
                    <p>
                        Descripcion: '.$direccion['comentario'].'
                    </p>
                    <p>
                        Telefono: '.$datos['telefono'].'
                    </p>
                    <p>
                        Correo: '.$datos['correo'].'
                    </p>
                </div>
            </div>
            ';
        }
        echo '
    </div>
</div>    
    ';
?>

