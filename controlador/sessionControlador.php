<?php
    //Constructor de la sesión
    class Sesiones {
        function __construct() {
            // 36,000 segundos son 10 horas

           /* session_set_cookie_params(36000); 
            ini_set('session.gc_maxlifetime', 36000);*/
            
            if(session_id()==""){
                session_start(); 
            }
        }
    
        //Le da los valores a la sesión
        public function setSesion($nombre, $valor) {            
            $_SESSION [$nombre] = $valor;
        }
            
        //Obtiene los valores de la sesión
        public function getSesion($nombre) {
            if (isset ( $_SESSION [$nombre])) {
                return $_SESSION[$nombre];
            }else{
                return false;
            }
        }
            
        //Elimina los datos de sesión
        public function destroy_Session($nombre) {
            unset ( $_SESSION [$nombre] );
        }
            
        //Cerramos la sesión
        public function termina_Sesion() {
            $_SESSION = array();
            session_unset();
            session_destroy ();
        }
    }
?>