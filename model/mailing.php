<?php
namespace Model;
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
 define('IN_PHP', true);

require_once('class.phpmailer.php');

 class mailing{

    public $smtp_host = 'c1980577.ferozo.com';
    public $smtp_email = 'info@intervenciones-comex.com'; //se usa para enviarselo al admin en el caso que sea necesario
    public $smtp_password = 'Liberte2015';
    public $smtp_alias = 'info@intervenciones-comex.com';
    public $smtp_name = "Intervenciones-Comex";
    public $smtp_port = 465;

    public $mail_admin="Marianacarenas@gmail.com";

function ReemplazarCaracter($palabra)
{
    $nueva_palabra=str_replace('á', '&aacute;', $palabra);
    $nueva_palabra=str_replace('é', '&eacute;', $nueva_palabra);
    $nueva_palabra=str_replace('í', '&iacute;', $nueva_palabra);
    $nueva_palabra=str_replace('ó', '&oacute;', $nueva_palabra);
    $nueva_palabra=str_replace('ú', '&uacute;', $nueva_palabra);
    $nueva_palabra=str_replace('á', '&ntilde;', $nueva_palabra);
    return $nueva_palabra;
}


function EnviarMailNuevoUsuario($nombre,$apellido,$email,$password)
{
    $template = file_get_contents("../../Template_Mail/nuevousuario.php");
 


  $template= str_replace('{{nombre}}', $this->ReemplazarCaracter($nombre), $template);
  $template= str_replace('{{apellido}}', $this->ReemplazarCaracter($apellido), $template);
  $template= str_replace('{{email}}', $this->ReemplazarCaracter($email), $template);
  $template= str_replace('{{password}}', $this->ReemplazarCaracter($password), $template);

    
    try {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        //$mail->SMTPDebug = 0;
        
        $mail->Host = $this->smtp_host;
        $mail->From = $this->smtp_alias;
        $mail->FromName = $this->smtp_name;
        $mail->Subject = 'Datos para acceder al sistema';

        $mail->SMTPAuth = true;
        $mail->Username = $this->smtp_email;
        $mail->Password = $this->smtp_password;

        $mail->Port = $this->smtp_port;
       // $mail->SMTPSecure = "ssl";
        $mail->IsHTML(True);
        $mail->MsgHTML($template);

        $fromEmail=$email;
        $fromName=$nombre." ".$apellido;
            $mail->AddAddress($fromEmail, $fromName);
        //echo print_r($mail);

            if(!$mail->Send()) {
               
               //echo 'El mensaje no se pudo enviar.';
                 echo 'Mailer Error: ' . $mail->ErrorInfo;
                 //die();
                 return false;
            }
        } catch (phpmailerException $e) {
            return false;
           // echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            return false;
       // echo $e->getMessage(); //Boring error messages from anything else!
        }

   
    return true;
}

function EnviarMailRecuperoClave($email,$tokentemporal)
{
    
    $template = file_get_contents("../../Template_Mail/recuperar_mail.php");
   
   
    $template= str_replace('{{password}}',$tokentemporal , $template);
  
    
    try {
    
        $mail = new PHPMailer();
        $mail->IsSMTP();
        //$mail->SMTPDebug = 0;
        $mail->Host = $this->smtp_host;
        $mail->From = $this->smtp_alias;
        $mail->FromName = $this->smtp_name;
        $mail->Subject = 'Recupero de Clave de acceso al sistema ';

        $mail->SMTPAuth = true;
        $mail->Username = $this->smtp_email;
        $mail->Password = $this->smtp_password;

        $mail->Port = $this->smtp_port;
        $mail->SMTPSecure = "ssl";
        $mail->IsHTML(True);
        $mail->CharSet = "utf-8";
        $mail->MsgHTML($template);

        $fromEmail=$email;
        $fromName=$email;
        $mail->AddAddress($fromEmail, $fromName);
        //echo print_r($mail);
        
            if(!$mail->Send()) {
                //return false;
               //echo 'El mensaje no se pudo enviar.';
                 echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (phpmailerException $e) {
            //return false;
           echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            //return false;
            echo $e->getMessage(); //Boring error messages from anything else!
        }

     
    return true;
}

function EnviarMailArchivoProcesado($nombre,$apellido,$email,$archivo,$errores)
{

    $template = file_get_contents("../../Template_Mail/archivo_procesado.php");
 


  $template= str_replace('{{nombre}}', $this->ReemplazarCaracter($nombre), $template);
  $template= str_replace('{{apellido}}', $this->ReemplazarCaracter($apellido), $template);
  $template= str_replace('{{archivo}}', $this->ReemplazarCaracter($archivo), $template);

  if ($errores==0)
  {
    $mensaje='Para descargarlo, deberá acceder al panel de control.';
  }else{
    $mensaje='Se han encontrado errores , para visualizarlos, debera acceder al panel de control';
  }

  $template= str_replace('{{mensaje}}',$mensaje , $template);
  

    
    try {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        //$mail->SMTPDebug = 0;
        
        $mail->Host = $this->smtp_host;
        $mail->From = $this->smtp_alias;
        $mail->FromName = $this->smtp_name;
        $mail->Subject = 'Tenes nuevas Notificaciones';

        $mail->SMTPAuth = true;
        $mail->Username = $this->smtp_email;
        $mail->Password = $this->smtp_password;

        $mail->Port = $this->smtp_port;
       // $mail->SMTPSecure = "ssl";
        $mail->IsHTML(True);
        $mail->MsgHTML($template);

        $fromEmail=$email;
        $fromName=$nombre." ".$apellido;
            $mail->AddAddress($fromEmail, $fromName);
        //echo print_r($mail);

            if(!$mail->Send()) {
               
               //echo 'El mensaje no se pudo enviar.';
                 echo 'Mailer Error: ' . $mail->ErrorInfo;
                // die();
                 return false;
            }
        } catch (phpmailerException $e) {
            return false;
           // echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            return false;
       // echo $e->getMessage(); //Boring error messages from anything else!
        }

   
    return true;
}

function EnviarMailArchivoAdminFaltantes()
{

    $template = file_get_contents("../../Template_Mail/ncm_faltantes_avisar_admin.php");
 
    
    try {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        //$mail->SMTPDebug = 0;
        
        $mail->Host = $this->smtp_host;
        $mail->From = $this->smtp_alias;
        $mail->FromName = $this->smtp_name;
        $mail->Subject = 'Ncm-Origen Faltantes';

        $mail->SMTPAuth = true;
        $mail->Username = $this->smtp_email;
        $mail->Password = $this->smtp_password;

        $mail->Port = $this->smtp_port;
       // $mail->SMTPSecure = "ssl";
        $mail->IsHTML(True);
        $mail->MsgHTML($template);

        $fromEmail=$this->mail_admin;
        $fromName='Mail Automatico';
            $mail->AddAddress($fromEmail, $fromName);
        //echo print_r($mail);

            if(!$mail->Send()) {
               
               //echo 'El mensaje no se pudo enviar.';
                 echo 'Mailer Error: ' . $mail->ErrorInfo;
                 //die();
                 return false;
            }
        } catch (phpmailerException $e) {
            return false;
           // echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            return false;
       // echo $e->getMessage(); //Boring error messages from anything else!
        }

   
    return true;
}

function EnviarMailNuevoUsuarioAvisoAdmin($email,$nombre,$apellido,$razon_social)
{

    $template = file_get_contents("../../Template_Mail/nuevousuario_aviso_admin.php");

    $template= str_replace('{{email}}', $this->ReemplazarCaracter($email), $template);
    $template= str_replace('{{nombre}}', $this->ReemplazarCaracter($nombre), $template);
    $template= str_replace('{{apellido}}', $this->ReemplazarCaracter($apellido), $template);
    $template= str_replace('{{razon_social}}', $this->ReemplazarCaracter($razon_social), $template);
  
    if ($errores==0)
    
    try {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        //$mail->SMTPDebug = 0;
        
        $mail->Host = $this->smtp_host;
        $mail->From = $this->smtp_alias;
        $mail->FromName = $this->smtp_name;
        $mail->Subject = 'Nuevo usuario Para evaluar';

        $mail->SMTPAuth = true;
        $mail->Username = $this->smtp_email;
        $mail->Password = $this->smtp_password;

        $mail->Port = $this->smtp_port;
       // $mail->SMTPSecure = "ssl";
        $mail->IsHTML(True);
        $mail->MsgHTML($template);

        $fromEmail=$this->mail_admin;
        $fromName='Mail Automatico';
            $mail->AddAddress($fromEmail, $fromName);
        //echo print_r($mail);

            if(!$mail->Send()) {
               
               //echo 'El mensaje no se pudo enviar.';
                 echo 'Mailer Error: ' . $mail->ErrorInfo;
                 die();
                 return false;
            }
        } catch (phpmailerException $e) {
            return false;
           // echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            return false;
       // echo $e->getMessage(); //Boring error messages from anything else!
        }

   
    return true;
}


}
?>