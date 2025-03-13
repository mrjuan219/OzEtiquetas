<?php 
    class Paginas {

        public static function mdlEnlacesModulos($enlace){

            /*=============================================================
            CARPETA PARA LOS ARCHIVOS DE VISTAS
            ==============================================================*/
            $carpeta = 'vistas/';

            /*=============================================================
            ENLACE PARA NOSOTROS
            ==============================================================*/

            if($enlace == "Nosotros"){
                $inclusion = 'Nosotros.php';
            }

            /*=============================================================
            ENLACE PARA SERVICIOS
            ==============================================================*/

            else if($enlace == "Servicios"){
                $inclusion = 'Servicios.php';
            }

            /*=============================================================
            ENLACE PARA SERVICIO EN ESPECIFICO
            ==============================================================*/

            else if($enlace == "Servicio"){
                $inclusion = 'Servicio.php';
            }
            
            /*=============================================================
            ENLACE PARA PRODUCTOS
            ==============================================================*/

            else if($enlace == "Productos"){
                $inclusion = 'Productos.php';
            }
            
            /*=============================================================
            ENLACE PARA ARTICULOS
            ==============================================================*/

            else if($enlace == "Articulo"){
                $inclusion = 'Articulo.php';
            }
            
            /*=============================================================
            ENLACE PARA CONTACTO
            ==============================================================*/

            else if($enlace == "Contacto"){
                $inclusion = 'Contacto.php';
            }
     
            /*=============================================================
            ENLACE PARA CARRITO
            ==============================================================*/

            else if($enlace == "Carrito"){
                $inclusion = 'Carrito.php';
            }
            
            
            /*=============================================================
            ENLACE PARA PANEL
            ==============================================================*/

            else if($enlace == "Panel"){
                $inclusion = 'Panel/Admin.php';
            }

                                
            /*=============================================================
            ENLACE PARA PERFIL
            ==============================================================*/

            else if($enlace == "Perfil"){
                $inclusion = 'Panel/perfil.php';
            }
               
             
            
            /*=============================================================
            ENLACE PARA Direciones
            ==============================================================*/

            else if($enlace == "Direcciones"){
                $inclusion = 'Panel/direcciones.php';
            }
            
            
            /*=============================================================
            ENLACE PARA PANEL
            ==============================================================*/

            else if($enlace == "Tienda"){
                $inclusion = 'Tienda.php';
            }
           
            else if($enlace == "Tienda_panel"){
                $inclusion = 'Panel/TiendaEnLinea.php';
            }
           
            else if($enlace == "Pedidos_panel"){
                $inclusion = 'Panel/PedidosPanel.php';
            }

            else if($enlace == "Sucursales_panel"){
                $inclusion = 'Panel/SucursalesPanel.php';
            }
                       
            else if($enlace == "Usuarios_panel"){
                $inclusion = 'Panel/UsuariosPanel.php';
            }    

            else if($enlace == "Citas_panel"){
                $inclusion = 'Panel/CitasPanel.php';
            }
            
            /*=============================================================
            ENLACE PARA PANEL
            ==============================================================*/

            else if($enlace == "MisAnuncios"){
                $inclusion = 'MisAnuncios.php';
            }
            

            else if($enlace == "MisPedidos"){
                $inclusion = 'MisPedidos.php';
            }
            
            /*=============================================================
            ENLACE PARA PANEL
            ==============================================================*/

            else if($enlace == "Educacion"){
                $inclusion = 'Educacion.php';
            }
			
			else if($enlace == "MiEducacion"){
                $inclusion = 'MiEducacion.php';
            }
			
			else if($enlace == "MiCurso"){
                $inclusion = 'MiCurso.php';
            }
			else if($enlace == "EducacionContinua"){
                $inclusion = 'articulo-educacion.php';
            }
			else if($enlace == "PanelEducacion"){
                $inclusion = 'PanelEducacion.php';
            }
			else if($enlace == "AdministraCurso"){
                $inclusion = 'AdministraCurso.php';
            }

            else if($enlace == "MiEducacionProfesor"){
                $inclusion = 'MiEducacionProfesor.php';
            }
			else if($enlace == "AdministraCursoProfesor"){
                $inclusion = 'AdministraCursoProfesor.php';
            }
			
			else if($enlace == "EtiquetasPersonalizadas"){
                $inclusion = 'EtiquetasPersonalizadas.php';
            }
			
			else if($enlace == "EtiquetasBlancas"){
                $inclusion = 'EtiquetasBlancas.php';
            }
			
			else if($enlace == "EtiquetadoraAutomatica"){
                $inclusion = 'EtiquetadoraAutomatica.php';
            }
			
			else if($enlace == "EquiposdeImpresión"){
                $inclusion = 'EquiposdeImpresión.php';
            }
			
			
			
            
            /*=============================================================
            ENLACE PREDETERMINADO
            ==============================================================*/
            else{
                $inclusion = 'Inicio.php';
            }

            return $carpeta.$inclusion;
        }
    }


?> 