<?php 
require_once('config.php');
require_once('model/usuario.php');
$usuarios = new Model\usuario;

if (isset($_SESSION['comex']['usuario']['ID'])) {
	
	$ipconexion=session_id();
	//echo $ipconexion;
	$usuario = $usuarios->getbyID($_SESSION['comex']['usuario']['ID']);
	//echo "base de datdos".$usuario['ipconexion'];
	
		if ($usuario['ipconexion']!=$ipconexion)
		{
			$_SESSION['comex']['usuario']['multipleconexion']='Se ha encontrado una sesion activa en otro dispositivo..<br> <a href="#" onclick="CerrarSesion();">Cerrar</a>';
			$nav['page'] = 'ingresar';
			require_once('controller/ingresar.php');

			die();
		}

}

if (!isset($_GET['path'])) {
	$_GET['path'] = "main";
}

$path = explode('/', $_GET['path']);

// if (isset($_SESSION['fichanet']['usuario']['ID']) && $_SESSION['fichanet']['usuario']['estadoID'] == 3 && !in_array($path[0], array('cambiar-contraseña','salir'))) {
// 	header('Location: '.SITEROOT.'cambiar-contraseña');
// }
if (isset($path[1]) && !is_numeric($path[1])) {
	if ($path[1]!="ADD")
	{
		$path[0]=$path[1];
		header('Location: '.SITEROOT.$path[0]);
		return;
	}
}
	if (isset($path[2]) && ($path[2]!='nuevo'&& $path[2]!='modificar' && $path[2]!='observar'))
	{
	
		$path[0]=$path[2];
		header('Location: '.SITEROOT.$path[0]);
		return;
	}


switch ($path[0]) {
	case 'registrarse':	
		$nav['page'] = 'registrarse';
		require_once('controller/registrarse.php');	
		break;
	
	case 'salir':
		$usuario_response = $usuarios->actualizaripconexion($_SESSION['comex']['usuario']['ID'],null);
		session_destroy();
		$nav['page'] = 'ingresar';
		require_once('controller/ingresar.php');
		break;
	
	case 'ingresar':
		if (isset($_SESSION['comex']['usuario']['ID'])) header('Location: '.SITEROOT.'dashboard');
		$nav['page'] = 'ingresar';
		require_once('controller/ingresar.php');
		break;
	case 'main':
		$nav['page'] = 'main';
		require_once('controller/main.php');
		break;
	
	case 'dashboard':
		//echo "entro";
		if (!isset($_SESSION['comex']['usuario']['ID'])) header('Location: '.SITEROOT.'ingresar');
		$nav['page'] = 'dashboard';
		require_once('controller/dashboard.php');
		break;	

	case 'maestro':
		if (!isset($_SESSION['comex']['usuario']['ID'])) header('Location: '.SITEROOT.'ingresar');
		
		$nav['page'] = 'agregar_archivo_maestro';
		require_once('controller/agregar_archivo_maestro.php');	
			
		break;
	case 'archivo':
		if (!isset($_SESSION['comex']['usuario']['ID'])) header('Location: '.SITEROOT.'ingresar');
		if (isset($path[1]) && is_numeric($path[1])) {
			$ID = $path[1];		
				$nav['page'] = 'ver_archivo';
				require_once('controller/ver_archivo.php');	
		}else{
			if (isset($path[1]))
			{
				$nav['page'] = 'agregar_archivo';
				require_once('controller/agregar_archivo.php');	
			}else{
				$nav['page'] = 'archivo';
				require_once('controller/archivo.php');
			}
		}break;
	case 'archivo_detalle':
		if (!isset($_SESSION['comex']['usuario']['ID'])) header('Location: '.SITEROOT.'ingresar');
		if (isset($path[1]) && is_numeric($path[1])) {
			$ID = $path[1];		
			$nav['page'] = 'ver_archivo_detalle';
			require_once('controller/ver_archivo_detalle.php');	
		}else{
			if (isset($path[1]))
			{
				// $nav['page'] = 'agregar_archivo';
				// require_once('controller/agregar_archivo.php');	
			}else{
				$nav['page'] = 'archivo_detalle';
				require_once('controller/archivo_detalle.php');
				
			}
		}break;
	case 'ncm':
		if (!isset($_SESSION['comex']['usuario']['ID'])) header('Location: '.SITEROOT.'ingresar');
		if (isset($path[1]) && is_numeric($path[1])) {
			$ID = $path[1];		
				$nav['page'] = 'ver_ncm';
				require_once('controller/ver_ncm.php');	
		}else{
			if (isset($path[1]))
			{
				$nav['page'] = 'agregar_ncm';
				require_once('controller/agregar_ncm.php');	
			}else{
				$nav['page'] = 'ncm';
				require_once('controller/ncm.php');
			}
		}break;
		case 'ncm_faltantes':
			if (!isset($_SESSION['comex']['usuario']['ID'])) header('Location: '.SITEROOT.'ingresar');
			if (isset($path[1])) {
				
				$ID = $path[1];		
					$nav['page'] = 'ver_ncm_faltantes';
					require_once('controller/ver_ncm_faltantes.php');	
			}else{
				
					$nav['page'] = 'ncm_faltantes';
					require_once('controller/ncm_faltantes.php');
				
			}break;
	case 'usuario':
		if (!isset($_SESSION['comex']['usuario']['ID'])) header('Location: '.SITEROOT.'ingresar');
		if (isset($path[1]) && is_numeric($path[1])) {
			$ID = $path[1];		
				$nav['page'] = 'ver_usuario';
				require_once('controller/ver_usuario.php');	
		}else{
			if (isset($path[1]))
			{
				$nav['page'] = 'agregar_usuario';
				require_once('controller/agregar_usuario.php');	
			}else{
				$nav['page'] = 'usuario';
				require_once('controller/usuario.php');
			}
		}break;
	case 'cotizacion':
		if (!isset($_SESSION['comex']['usuario']['ID'])) header('Location: '.SITEROOT.'ingresar');
		if (isset($path[1]) && is_numeric($path[1])) {
			$ID = $path[1];		
				$nav['page'] = 'ver_cotizacion';
				require_once('controller/ver_cotizacion.php');	
		}else{
			if (isset($path[1]))
			{
				$nav['page'] = 'agregar_cotizacion';
				require_once('controller/agregar_cotizacion.php');	
			}else{
				$nav['page'] = 'cotizacion';
				require_once('controller/cotizacion.php');
			}
		}break;
	default:
		require_once('errors/404.php');
		break;
}


?>