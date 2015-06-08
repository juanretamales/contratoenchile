<?php
error_reporting(E_ERROR);//solo mostrara errores fatales
if(!isset($_SESSION)){
	session_start();
}
switch($_SESSION['rol'])
{
	case 0:
		echo "No se encontro el metodo solicitado, recargue la pagina e intenste nuevamente";
		break;
		
	case 1:
		if(isset($_POST['eliminarDocumento']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_doc" => $_POST["eliminarDocumento"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarDocumento($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
			break;
		}
		
		if(isset($_POST['eliminarMultimedia']))
		{
			$arg = array (
				"id_med" => $_POST["eliminarMultimedia"],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarMedia($arg);
			switch($resultado)
			{
				case 0:
					echo "Error al recibir los datos";
					break;
				case 1:
					echo "Exito";
					break;
				default:
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					break;
			}
			break;
		}
		echo "No se encontro el metodo solicitado, recargue la pagina e intenste nuevamente";
		break;
		
	default:
		if(isset($_POST['eliminarPlan']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_plan" => $_POST["eliminarPlan"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarPlan($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarBoleta']))
		{
			$arg = array (
				"id_bol" => $_POST["eliminarBoleta"],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarBoleta($arg);
			switch($resultado)
			{
				case 0:
					echo "Error al recibir los datos";
					break;
				case 1:
					echo "Exito";
					break;
				default:
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					break;
			}
			break;
		}
		if(isset($_POST['eliminarRegion']))
		{
			$arg = array (
				"id_reg" => $_POST["eliminarRegion"],
				"affected" => 'nada'
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarRegion($arg);
			switch($resultado)
			{
				case 0:
					echo "Error al recibir los datos";
					break;
				case 1:
					echo "Exito";
					break;
				default:
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					break;
			}
			break;
		}
		if(isset($_POST['eliminarProvincia']))
		{
			$arg = array (
				"id_prov" => $_POST["eliminarProvincia"],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarProvincia($arg);
			switch($resultado)
			{
				case 0:
					echo "Error al recibir los datos";
					break;
				case 1:
					echo "Exito";
					break;
				default:
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					break;
			}
			break;
		}
		/*if(isset($_POST['eliminarMultimedia']))
		{
			$arg = array (
				"id_med" => $_POST["eliminarMultimedia"],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarMedia($arg);
			switch($resultado)
			{
				case 0:
					echo "Error al recibir los datos";
					break;
				case 1:
					echo "Exito";
					break;
				default:
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					break;
			}
			break;
		}*/
		if(isset($_POST['eliminarContacto']))
		{
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$arg=array ('id_con'=> $_POST["eliminarContacto"]);
			$transaccion->eliminarServcon($arg);
			$transaccion->eliminarContacto($arg);
			echo "Exito";
			break;
		}
		if(isset($_POST['eliminarComuna']))
		{
			$arg = array (
				"id_com" => $_POST["eliminarComuna"],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarComuna($arg);
			switch($resultado)
			{
				case 0:
					echo "Error al recibir los datos";
					break;
				case 1:
					echo "Exito";
					break;
				default:
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					break;
			}
			break;
		}
		if(isset($_POST['eliminarTipousuario']))
		{
			$arg = array (
				"id_tu" => $_POST["eliminarTipousuario"],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarTipousuario($arg);
			switch($resultado)
			{
				case 0:
					echo "Error al recibir los datos";
					break;
				case 1:
					echo "Exito";
					break;
				default:
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					break;
			}
			break;
		}
		if(isset($_POST['eliminarPermisos']))
		{
			$code=explode("-", $_POST['eliminarPermisos']);
			$arg = array (
				"id_tu" => $code[0],
				"id_pag" => $code[1],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarPermisos($arg);
			switch($resultado)
			{
				case 0:
					echo "Error al recibir los datos";
					break;
				case 1:
					echo "Exito";
					break;
				default:
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					break;
			}
			break;
		}
		if(isset($_POST['eliminarItem']))
		{
			$code=explode("-", $_POST['eliminarItem']);
			$arg = array (
				"id_menu" => $code[0],
				"id_pag" => $code[1],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarItem($arg);
			switch($resultado)
			{
				case 0:
					echo "Error al recibir los datos";
					break;
				case 1:
					echo "Exito";
					break;
				default:
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					break;
			}
			break;
		}
		if(isset($_POST['eliminarTipodocumento']))
		{
			$arg = array (
				"id_td" => $_POST['eliminarTipodocumento'],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarTipodoc($arg);
			switch($resultado)
			{
				case 0:
					echo "Error al recibir los datos";
					break;
				case 1:
					echo "Exito";
					break;
				default:
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					break;
			}
			break;
		}
		if(isset($_POST['eliminarTipomultimedia']))
		{
			$arg = array (
				"id_tm" => $_POST['eliminarTipomultimedia'],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarTipomedia($arg);
			switch($resultado)
			{
				case 0:
					echo "Error al recibir los datos";
					break;
				case 1:
					echo "Exito";
					break;
				default:
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					break;
			}
			break;
		}
		if(isset($_POST['eliminarTipopagina']))
		{
			$arg = array (
				"id_tp" => $_POST['eliminarTipopagina'],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarTipopagina($arg);
			switch($resultado)
			{
				case 0:
					echo "Error al recibir los datos";
					break;
				case 1:
					echo "Exito";
					break;
				default:
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					break;
			}
			break;
		}
		if(isset($_POST['eliminarPagina']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_pag" => $_POST["eliminarPagina"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarPagina($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarPersona']))
		{
			$mensaje="eliminar";
				$arg = array (
					"rut" => $_POST["eliminarPersona"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarPersona($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarMensajes']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_men" => $_POST["eliminarMensajes"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarMensajes($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarPregunta']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_tc" => $_POST["eliminarPregunta"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarTipocal($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarMultimedia']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_med" => $_POST["eliminarMultimedia"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarMedia($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarMetrica']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_ec" => $_POST["eliminarMetrica"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarEscalacal($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarDocumento']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_doc" => $_POST["eliminarDocumento"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarDocumento($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarCategoria']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_cat" => $_POST["eliminarCategoria"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarCategoria($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarSubcategoria']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_scat" => $_POST["eliminarSubcategoria"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarSubcategoria($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarServicio']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_serv" => $_POST["eliminarServicio"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarServicio($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarTiposervicio']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_ts" => $_POST["eliminarTiposervicio"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarTiposervicio($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarEntidad']))
		{
			$mensaje="eliminar";
				$arg = array (
					"id_ent" => $_POST["eliminarEntidad"]
				);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarEntidad($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarAutoridad']))
		{
			$code=explode("+", $_POST['eliminarAutoridad']);
			$arg = array (
				"rut" => $code[0],
				"id_ent" => $code[1],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarAutoridad($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarMenu']))
		{
			$arg = array (
				"id_menu" => $_POST['eliminarMenu'],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->eliminarMenu($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
			}
		}
		if(isset($_POST['eliminarPais']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_pais" => $_POST["eliminarPais"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarPais($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
}
function serializeToArray($arreglo)
{
	$code=explode("&", $arreglo);
	$variables=array();
	for($i=0;$i<count($code);$i++)
	{
		if(strpos($code[$i],"=")>0)
		{
			$code2=explode("=", $code[$i]);
			if(strlen($code2[1])>0 && strlen($code2[1])<255)
			{
				$variables[$code2[0]]= str_replace("'",'%22', urldecode($code2[1]));
			}
		}
	}
	return $variables;
}
//Administradores aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa

if($_SESSION['rol']>299)//todo lo que solo los moderadores puedan hacer que este aqui
{
	
	/////////////////////////////////
	/* Modificar                   */
	/////////////////////////////////

	if(isset($_POST['btnModificarTipousuario']))
	{
		$mensaje="eliminar";
		if(isset($_POST['txtCode']) && isset($_POST['txtNombre']))
		{
			$arg = array (
				"nom_tu" => $_POST["txtNombre"],
				"condition" => "id_tu",
				"data" => $_POST["txtCode"]
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->modificarTipousuario($arg);
			if($resultado==true)
			{
				echo '<script language="javascript">window.location="'.WEB_BASE.'administracion/seguridad/tipousuario"</script>';
			}
			else
			{
				echo '<script language="javascript">window.location="'.WEB_BASE.'administracion/seguridad/tipousuario"</script>';
			}
		}
	}

	/////////////////////////////////
	/* Eliminar                    */
	/////////////////////////////////
	if(isset($_POST['eliminarCategoria']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_cat" => $_POST["eliminarCategoria"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarCategoria($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	//falta
	if(isset($_POST['eliminarCobertura']) && isset($_POST['id_com']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_serv" => $_POST["eliminarCobertura"],
				"id_com" => $_POST["id_com"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarCobertura($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarComuna']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_com" => $_POST["eliminarComuna"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarComuna($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarDocumento']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_doc" => $_POST["eliminarDocumento"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarDocumento($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarPregunta']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_tc" => $_POST["eliminarPregunta"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarTipocal($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarEstado']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_est" => $_POST["eliminarEstado"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarEstado($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarItem']) && isset($_POST['id_menu']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_pag" => $_POST["eliminarItem"],
				"id_menu" => $_POST["id_menu"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarCategoria($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarMultimedia']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_med" => $_POST["eliminarMultimedia"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarMedia($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarMensajes']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_men" => $_POST["eliminarMensajes"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarMensajes($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarMenu']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_menu" => $_POST["eliminarMenu"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarCategoria($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarPagina']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_pag" => $_POST["eliminarPagina"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarPagina($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarPais']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_pais" => $_POST["eliminarPais"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarPais($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarPermisos']) && isset($_POST['id_pag']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_tu" => $_POST["eliminarPermisos"],
				"id_pag" => $_POST["id_pag"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarPermisos($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarPersonaEntidad']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_cat" => $_POST["eliminarPersonaEntidad"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarPersonaEntidad($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarProvincia']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_prov" => $_POST["eliminarProvincia"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarProvincia($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarRegion']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_reg" => $_POST["eliminarRegion"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarRegion($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarServcon']))//falta
	{
		$mensaje="eliminar";
			$arg = array (
				"id_cat" => $_POST["eliminarServcon"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarCategoria($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarServicio']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_serv" => $_POST["eliminarServicio"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarServicio($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarSubcategoria']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_scat" => $_POST["eliminarSubcategoria"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarSubcategoria($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	
	if(isset($_POST['eliminarTipodocumento']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_td" => $_POST["eliminarTipodocumento"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarTipodoc($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarTipomultimedia']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_tm" => $_POST["eliminarTipomultimedia"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarTipomedia($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarTipopagina']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_tp" => $_POST["eliminarTipopagina"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarTipopagina($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarTiposervicio']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_ts" => $_POST["eliminarTiposervicio"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarTiposervicio($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['eliminarTipousuario']))
	{
		$mensaje="eliminar";
			$arg = array (
				"id_tu" => $_POST["eliminarTipousuario"]
			);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarTipousuario($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	/*******Antiguos ********************************/
	if(isset($_POST['btnEliminarPagina']))
	{
		$mensaje="eliminar";
		$arg = array (
			"id_pag" => $_POST["btnEliminarPagina"]
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarPagina($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, cargue nuevamente la pagina e intente nuevamente.";
		}
	}
	if(isset($_POST['btnEliminarTipopagina']))
	{
		$mensaje="eliminar";
		$arg = array (
			"id_tp" => $_POST["btnEliminarTipopagina"]
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarTipopagina($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, comprueba si existe alguna pagina del tipo que se pretende eliminar";
		}
	}
	if(isset($_POST['btnEliminarTipodoc']))
	{
		$mensaje="eliminar";
		$arg = array (
			"id_td" => $_POST["btnEliminarTipopagina"]
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarTipodoc($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, comprueba si existe algun documento del tipo que se pretende eliminar";
		}
	}
	if(isset($_POST['btnEliminarDocumento']))
	{
		$mensaje="eliminar";
		$arg = array (
			"id_doc" => $_POST["btnEliminarDocumento"]
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarDocumento($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error";
		}
	}
	if(isset($_POST['btnEliminarTipomedia']))
	{
		$mensaje="eliminar";
		$arg = array (
			"id_tm" => $_POST["btnEliminarTipomedia"]
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarTipomedia($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, comprueba si existe algun multimedia del tipo que se pretende eliminar";
		}
	}
	if(isset($_POST['btnEliminarPermiso']))
	{
		$mensaje="eliminar";
		$arg = array (
			"id_pag" => $_POST["btnEliminarPermiso"],
			"id_tu" => $_POST["Tipousuario"]
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->eliminarPermisos($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error";
		}
	}
}

//<script language="javascript">window.location="http://www.contratoenchile.cl"</script>
?>