<?php
namespace Model;
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
define('IN_PHP', true);

require_once('database.php');

 
class usuario{

    function getbyID($ID){
        $db = database::getInstance();
        $SQL = "SELECT * FROM  vw_usuarios
        where  usuarioID='$ID'";
        $db->query($SQL);
        return $db->fetch();
        }
        
        function getUsuarioByEmail($email){
            $db = database::getInstance();
            $SQL = "SELECT * FROM  vw_usuarios
            where  email='$email'";
            $db->query($SQL);
            return $db->fetch();
        }
    function getbynombre($NOMBRE){
        $db = database::getInstance();
        $SQL = "SELECT u.* FROM vw_usuarios u  
        where  nombre like '%$NOMBRE%' or apellido like '%$NOMBRE%' or email like '%$NOMBRE%' or nombre_rol like '%$NOMBRE%' or estado like '%$NOMBRE%'  ORDER BY email asc";
        $db->query($SQL);
        return $db->fetchAll();
        }

        function login($email,$password){
        $db = database::getInstance();
        $SQL = "SELECT u.* FROM vw_usuarios u WHERE email = '$email' AND password = '$password' ";
        //echo $SQL;
        $db->query($SQL);
        return $db->fetch();
    }

    function agregar($nombre,$apellido,$email,$celular,$cuit,$cargo,$razon_social,$token)
    {
        $db = database::getInstance();
        $passtemporal=md5($email);
        $SQL = "insert into  usuarios (nombre,apellido,email,celular,cuit,cargo,razon_social,password,idroles,temporal,idestado) 
            values ('$nombre','$apellido','$email','$celular','$cuit','$cargo','$razon_social','$token',2,1,1)";
       
        $resultado= $db->query($SQL);
        
        return $resultado;
    }
    function cambiarclaveTemporalRecupero ($email,$tokenaccesotemporal){
        $db = database::getInstance();
       
        $SQL = "update  usuarios  set password='$tokenaccesotemporal',temporal=1 where email='$email'";
       
        $resultado= $db->query($SQL);
        
        return $resultado;
    }
    
    function cambiarclaveAdmin ($id,$tokenaccesotemporal){
        $db = database::getInstance();
       
        $SQL = "update  usuarios  set password='$tokenaccesotemporal' where usuarioId='$id'";
       
        $resultado= $db->query($SQL);
        
        return $resultado;
    }
    function cambiarclave ($clave){
        $db = database::getInstance();
        $id=$_SESSION['comex']['usuario']['ID'];
        $SQL = "update  usuarios  set password='$clave' where usuarioID=$id";
       
        $resultado= $db->query($SQL);
       
        return $resultado;
    }
    function cambiarestado ($id,$estado){
        $db = database::getInstance();
     
        $SQL = "update  usuarios  set idestado=$estado where usuarioID=$id";
       
        $resultado= $db->query($SQL);
       
        return $resultado;
    }

    function pasarpermanente ($id,$password,$ipconexion){
        $db = database::getInstance();
     
        $SQL = "update  usuarios  set temporal=0,password='$password',ipconexion='$ipconexion' where usuarioID=$id";
       
        // echo $SQL;
        // die();
        return $db->query($SQL);

    }

    function actualizaripconexion ($id,$ipconexion){
        $db = database::getInstance();
     
        $SQL = "update  usuarios  set ipconexion='$ipconexion' where usuarioID=$id";
       
        // echo $SQL;
        // die();
        return $db->query($SQL);

    }
    function editar ($id,$nombre,$apellido,$email,$celular,$cuit,$cargo,$razon_social){
        $db = database::getInstance();
        $passtemporal=md5($email);
        $SQL = "update usuarios set nombre='$nombre',apellido='$apellido',email='$email',celular='$celular',cuit='$cuit',cargo='$cargo',razon_social='$razon_social' where usuarioID='$id'";
       
        $resultado= $db->query($SQL);
        
        return $resultado;
    }

    function registrar($nombre,$apellido,$email,$celular,$cuit,$cargo,$razon_social,$token)
    {
        $db = database::getInstance();
        $passtemporal=md5($email);
        $SQL = "insert into  usuarios (nombre,apellido,email,celular,cuit,cargo,razon_social,password,idroles,temporal,idestado) 
            values ('$nombre','$apellido','$email','$celular','$cuit','$cargo','$razon_social','$token',2,1,2)";
       
        $resultado= $db->query($SQL);
        
        return $resultado;
    }

}
?>
