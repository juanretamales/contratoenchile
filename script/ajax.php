<?php
//aca se guardan las validaciones
//error_reporting(E_ERROR);//solo mostrara errores fatales
require_once("./webConfig.php");
if(!isset($_SESSION)){
	session_start();
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
			if($code2[0]=="txtDescripcion")
			{
				if(strlen($code2[1])>0 && strlen($code2[1])<100000)
				{
					$variables[$code2[0]]= str_replace("'",'%22', $code2[1]);
				}
			}
			else
			{
				if(strlen($code2[1])>0 && strlen($code2[1])<255)
				{
					$variables[$code2[0]]= str_replace("'",'%22', urldecode($code2[1]));
				}
			}
		}
	}
	return $variables;
}
////////////////////////////////
//     Primero los agregar    //
////////////////////////////////
if(isset($_POST['actualizarPermisos']))
{
	include_once('./transaccion.php');
	$transaccion=new transaccion();
	$arg = array (
		"nada" => '0'
	);
	$nuevospermisos=$_POST['actualizarPermisos'];
	//print_r($nuevospermisos);
	$variable;
	$permisos=$transaccion->listarPermisos($arg);
	$permisosAgregar= array();
	$permisosEliminar= array();
	for($i=0;$i<count($nuevospermisos);$i++)
	{
		if($nuevospermisos[$i][2]=="false" || $nuevospermisos[$i][2]==false)
		{
			//echo "entro al primer if";
			if(in_array(array('id_pag'=>$nuevospermisos[$i][0], 'id_tu' => $nuevospermisos[$i][1]), $permisos))
			{
				//$permisosEliminar[count($permisosEliminar)]=array('id_pag'=>$nuevospermisos[$i][0], 'id_tu' => $nuevospermisos[$i][1]);
				$permisosEliminar=$transaccion->eliminarPermisos(array('id_pag'=>$nuevospermisos[$i][0], 'id_tu' => $nuevospermisos[$i][1]));
				$accion ="Error";
				if($permisosEliminar===true)
				{
					$accion="Exito";
				}
				else
				{
					$accion='Error en eliminar:';
					//print_r(array('id_pag'=>$nuevospermisos[$i][0], 'id_tu' => $nuevospermisos[$i][1]));
				}
				//echo "<br>permiso a eliminar N°".count($permisosEliminar).":";
				//print_r($permisosEliminar);
				echo $accion;
			}
			else
			{
				break;
			}
		}
		else
		{
			//echo "=no entro<br>";
			if(!in_array(array('id_pag'=>$nuevospermisos[$i][0], 'id_tu' => $nuevospermisos[$i][1]), $permisos))
			{
				//$permisosAgregar[count($permisosAgregar)]=array('id_pag'=>$nuevospermisos[$i][0], 'id_tu' => $nuevospermisos[$i][1]);
				$permisosAgregar=$transaccion->insertarPermisos(array('id_pag'=>$nuevospermisos[$i][0], 'id_tu' => $nuevospermisos[$i][1]));
				if($permisosAgregar===true)
				{
					echo "Exito";
				}
				else
				{
					echo 'Error en agregar:';
					print_r(array('id_pag'=>$nuevospermisos[$i][0], 'id_tu' => $nuevospermisos[$i][1]));
				}
				//echo "<br><br>";
				//print_r($permisosAgregar);
			}
			else
			{
				break;
			}
		}
	}
	/*echo "<br><br>Permisos a agregar=";
	print_r($permisosAgregar);
	echo "<br><br>Permisos a eliminar=";
	print_r($permisosEliminar);*/
}

if(isset($_POST['actualizarCarro']))
{
	$_SESSION["Carro"]=$_POST['actualizarCarro'];
}
if(isset($_POST['actualizarComp']))
{
	$_SESSION["Comparacion"]=$_POST['actualizarComp'];
}
if(isset($_POST['registrarse']))
{
	$variables=serializeToArray($_POST['registrarse']);
	if(
		isset($variables ['txtEmail']) && 
		isset($variables ['txtReEmail']) && 
		isset($variables ['txtCaptcha'])
	)
	{	
		if(strtoupper($variables ['txtCaptcha']) == $_SESSION["captcha"])
		{
			$_SESSION["captcha"]= md5(rand()*time());
			if($variables ['txtEmail']==$variables ['txtReEmail'])
			{
				if (filter_var($variables ['txtEmail'], FILTER_VALIDATE_EMAIL))
				{
					include_once('./transaccion.php');
					$transaccion=new transaccion();
					$arg = array (
							"email_per" => $variables ['txtEmail']
					);
					$persona=$transaccion->listarPersona($arg);
					if(count($persona)==0)
					{
						$emailcode=urlencode(base64_encode($variables ['txtEmail']));
						$url=WEB_BASE."registrar/".$emailcode;
						$titulo="Continuacion registro en Contrato en Chile";
						$mensaje='Para poder terminar el registro, llena el formulario del siguiente sitio '.$url.' 
						o ingrese el codigo en el fomulario de registro si no se llena automaticamente <p> '.$emailcode.' </p> , este correo fue generado automaticamente, por lo que no sera respondido
						por su preferencia, gracias.';
						$resultado=mail($variables ['txtEmail'], $titulo, $mensaje);
						if($resultado===true)
						{
							echo "Exito";
						}
						else
						{
							echo 'Error al enviar email, acceda al siguiente vinculo <a href="'.$url.'">Continuar registro</a>';
						}
					}
					else
					{
						echo "El email ya esta registrado, utilice otro";
					}
				}
				else
				{
					echo "El email no es valido";
				}
			}
			else
			{
				echo "Los emails no son iguales";
			}
		}
		else
		{
			echo "Captcha incorrecto";
		}
	}
	else
	{
		echo "error al enviar los datos";
	}
}
if(isset($_POST['agregarUsuario']))
{
	$variables=serializeToArray($_POST['agregarUsuario']);
	if(
		isset($variables ['txtRut']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtApellido']) && 
		isset($variables ['txtTelefono']) && 
		isset($variables ['txtPais']) && 
		isset($variables ['txtRegion']) && 
		isset($variables ['txtProvincia']) && 
		isset($variables ['txtComuna']) && 
		isset($variables ['txtDireccion']) && 
		isset($variables ['txtTipo']) && 
		isset($variables ['txtEstado']) && 
		isset($variables ['txtFecha']) && 
		isset($variables ['txtPassword']) && 
		isset($variables ['txtRepassword']) && 
		isset($variables ['txtCaptcha']) && 
		isset($variables ['txtEmail'])
	)
	{
		if(strtoupper($variables ['txtCaptcha']) == $_SESSION["captcha"])
		{
			$_SESSION["captcha"]= md5(rand()*time());
			include_once('./function.php');
			$arg=array('rut'=>$variables ['txtRut']);
			if(count(listarPersona($arg))==0)
			{
				$arg=array('email_per'=>$variables ['txtEmail']);
				if(count(listarPersona($arg))==0)
				{
					if($variables ['txtPassword']==$variables ['txtRepassword'])
					{
						include_once('./transaccion.php');
						$transaccion=new transaccion();
						$arg=array(
							'nombre'=>$variables ['txtNombre'],
							'apellido'=>$variables ['txtApellido'],
							'tel_per'=>$variables ['txtTelefono'],
							'id_com'=>$variables ['txtComuna'],
							'direccion'=>$variables ['txtDireccion'],
							'rut'=>$variables ['txtRut'],
							'fecha_nac'=>dateEncode($variables ['txtFecha']),
							'id_tu'=>$variables ['txtTipo'],
							'id_est'=>$variables ['txtEstado'],
							'contrasena'=>md5($variables ['txtPassword']),
							'email_per'=>$variables ['txtEmail']
						);
						$resultado=$transaccion->insertarPersona($arg);
						if($resultado==true)
						{
							echo "Exito";
						}
						else
						{
							echo "Ocurrio un error, recargue la pagina e intente nuevamente";
						}
					}
					else
					{
						echo "Las contraseñas no coinciden";
					}
				}
				else
				{
					echo "El correo ya se encuentra registrado";
				}
			}
			else
			{
				echo "El rut ya se encuentra registrado";
			}
		}
		else
		{
			echo "Error con el captcha";
		}
	}
	else
	{
		if(
			isset($variables ['txtRut']) && 
			isset($variables ['txtNombre']) && 
			isset($variables ['txtApellido']) && 
			isset($variables ['txtTelefono']) && 
			isset($variables ['txtPais']) && 
			isset($variables ['txtRegion']) && 
			isset($variables ['txtProvincia']) && 
			isset($variables ['txtComuna']) && 
			isset($variables ['txtDireccion']) && 
			isset($variables ['txtFecha']) && 
			isset($variables ['txtPassword']) && 
			isset($variables ['txtRepassword']) && 
			isset($variables ['txtCaptcha']) && 
			isset($variables ['txtCode'])
		)
		{
			if(strtoupper($variables ['txtCaptcha']) == $_SESSION["captcha"])
			{
				$_SESSION["captcha"]= md5(rand()*time());
				include_once('./function.php');
				$arg=array('rut'=>$variables ['txtRut']);
				if(count(listarPersona($arg))==0)
				{
					$arg=array('email_per'=>$variables ['txtEmail']);
					if(count(listarPersona($arg))==0)
					{
						if($variables ['txtPassword']==$variables ['txtRepassword'])
						{
							include_once('./transaccion.php');
							$transaccion=new transaccion();
							$arg=array(
								'nombre'=>$variables ['txtNombre'],
								'apellido'=>$variables ['txtApellido'],
								'tel_per'=>$variables ['txtTelefono'],
								'id_com'=>$variables ['txtComuna'],
								'direccion'=>$variables ['txtDireccion'],
								'rut'=>$variables ['txtRut'],
								'fecha_nac'=>dateEncode($variables ['txtFecha']),
								'id_tu'=>USUARIO_DEFECTO,
								'id_est'=>LOGIN_DEFECTO,
								'contrasena'=>md5($variables ['txtPassword']),
								'email_per'=>$variables ['txtEmail']
							);
							$resultado=$transaccion->insertarPersona($arg);
							if($resultado==true)
							{
								echo "Exito";
							}
							else
							{
								echo "Ocurrio un error, recargue la pagina e intente nuevamente";
							}
						}
						else
						{
							echo "Las contraseñas no coinciden";
						}
					}
					else
					{
						echo "El correo ya se encuentra registrado";
					}
				}
				else
				{
					echo "El rut ya se encuentra registrado";
				}
			}
			else
			{
				echo "Error con el captcha";
			}
		}
		else
		{
			echo "Error al recibir los parametros";
		}
	}
	
	
}
if(isset($_POST['agregarBoleta']))
{
	$variables=serializeToArray($_POST['agregarBoleta']);
	if(
		isset($variables ['txtPlan']) &&  
		isset($variables ['setupFee']) &&  
		isset($variables ['amount'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'id_ent'=>$_SESSION['empresa'], 
			'monto'=>$variables ['setupFee']+$variables ['amount'], 
			'id_plan'=>$variables ['txtPlan'], 
			'id_est'=>7,
			'insert_id'=>0
		);
		$resultado=$transaccion->insertarBoleta($arg);
		echo $resultado;
	}
}
if(isset($_POST['calificarContrato']))
{
	$variables=serializeToArray($_POST['calificarContrato']);
	if(
		isset($variables ['txtCode'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$preguntasForm=array_keys($variables);
		$calificar=true;
		if(count($preguntasForm)>0)
		{
			for($j=0;$j<count($preguntasForm);$j++)
			{
				if($preguntasForm [$j]!="txtCode")
				{
					$arg=array(
							'id_con'=>$variables ['txtCode'], 
							'rut'=>$_SESSION['rut'],
							'id_tc'=>str_replace('txtPregunta','',$preguntasForm [$j]),
							'id_ec'=>$variables [$preguntasForm [$j]]
						);
					$resultado=$transaccion->insertarCalificacionservMultiple($arg);
					if($resultado==false) 
					{
						$calificar=false; 
						
					}
				}
			}
			if($calificar==true)
			{
				$arg = array (
					"id_est" => 11,
					"clause" => "id_con='".$variables ['txtCode']."' and id_est='9' and rut='".$_SESSION['rut']."'",
					"affected" => md5('nada')
				);
				$resultado=$transaccion->modificarContacto($arg);
				switch($resultado)
				{
					case 0:
						echo "Error al modificar contrato";
						
					default:
						echo "Exito";
						
				}
			}
			else
			{
				echo "Ocurrio un error, no se modifico el contrato, recargue la pagina e intente nuevamente";
			}
		}
		else
		{
			echo "No se encontro el contrato";
		}
	}
	else
	{
		echo "No se recibieron los datos correctamente";
	}
	
}
if(isset($_POST['agregarEmpresa']))
{
	$variables=serializeToArray($_POST['agregarEmpresa']);
	if(
				isset($variables ['txtRut']) &&
				isset($variables ['txtNombre']) &&
				isset($variables ['txtDescripcion']) &&
				isset($variables ['txtTelefono']) &&
				isset($variables ['txtEmail']) &&
				isset($variables ['txtEstado']) &&
				isset($variables ['txtFecha'])
			)
	{
		include_once('./transaccion.php');
		//include_once('./function.php');
		$transaccion=new transaccion();
		$arg=array(
			'id_est'=>$variables ['txtEstado'], 
			'subscripcion'=>dateEncode($variables ['txtFecha']), 
			'rut_sii'=>$variables ['txtRut'], 
			'nom_ent'=>$variables ['txtNombre'], 
			'sitio'=>urlencode($variables ['txtNombre']), 
			'seo_ent'=>"", 
			'desc_ent'=>$variables ['txtDescripcion'], 
			'email_ent'=>$variables ['txtEmail'], 
			'tel_ent'=>$variables ['txtTelefono'], 
			'auth_key'=>md5($variables ['txtRut'].rand().$variables ['txtNombre']),
			'insert_id'=>'nada'
		);
		$resultado=$transaccion->insertarEntidad($arg);
		if($resultado!=false && is_numeric($resultado)==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	else
	{
		if(
			isset($variables ['txtRut']) &&
			isset($variables ['txtNombre']) &&
			isset($variables ['txtDescripcion']) &&
			isset($variables ['txtTelefono']) &&
			isset($variables ['txtEmail'])
		)
		{
			include_once('./transaccion.php');
			$transaccion=new transaccion();
			$arg=array('rut'=>$_SESSION['rut']);
			$permisos=count($transaccion->listarAutoridad($arg));
			if(MAX_EMPRESAS>$permisos)
			{
				$arg=array(
					'id_est'=>EMPRESA_DEFECTO, 
					'subscripcion'=>date( "Y-m-j" , time()), 
					'rut_sii'=>$variables ['txtRut'], 
					'nom_ent'=>$variables ['txtNombre'], 
					'sitio'=>urlencode($variables ['txtNombre']), 
					'seo_ent'=>"", 
					'desc_ent'=>$variables ['txtDescripcion'], 
					'email_ent'=>$variables ['txtEmail'], 
					'tel_ent'=>$variables ['txtTelefono'], 
					'auth_key'=>md5($variables ['txtRut'].rand().$variables ['txtNombre']),
					'insert_id'=>'nada'
				);
				$resultado=$transaccion->insertarEntidad($arg);
				if($resultado!=false && is_numeric($resultado)==true)
				{
					$arg=array('rut'=>$_SESSION['rut'], 'id_ent'=>$resultado);
					$resultado2=$transaccion->insertarAutoridad($arg);
					if($resultado==true)
					{
						echo "Exito";
					}
					else
					{
						$resultado2=$transaccion->eliminarEntidad($arg);
						echo "Error al asignar el permiso, por favor registre nuevamente la empresa";
					}
				}
				else
				{
					echo "Ocurrio un error, recargue la pagina e intente nuevamente";
				}
			}
			else
			{
				echo "Ya tiene el numero maximo de empresas";
			}
		}
		else
		{
			echo "Error al recibir los parametros";
		}
	}
}
if(isset($_POST['agregarCobertura']))
{
	$variables=serializeToArray($_POST['agregarCobertura']);
	if(
		isset($variables ['txtComuna']) &&
		isset($variables ['txtEntidad'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'is_com'=>$variables ['txtComuna'], 
			'id_ent'=>$variables ['txtEntidad']
		);
		$resultado=$transaccion->insertarCobertura($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	else
	{
		if(
			isset($variables ['txtComuna']) &&
			isset($_SESSION['empresa'])
		)
		{
			include_once('./transaccion.php');
			$transaccion=new transaccion();
			$arg=array(
				'id_com'=>$variables ['txtComuna'], 
				'id_ent'=>$_SESSION['empresa']
			);
			$resultado=$transaccion->insertarCobertura($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, recargue la pagina e intente nuevamente";
			}
		}
		else
		{
			//print_r($variables);
			echo "Error al recibir los parametros";
		}
	}
	
}
if(isset($_POST['agregarServicio']))
{
	$variables=serializeToArray($_POST['agregarServicio']);
	if(
		isset($variables ['txtNombre']) &&
		isset($variables ['txtCategoria']) &&
		isset($variables ['txtSubcategoria']) &&
		isset($variables ['txtTipoServicio']) &&
		isset($variables ['txtDescripcion']) &&
		isset($variables ['txtEmpresa']) &&
		isset($variables ['txtEstado'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'is_scat'=>$variables ['txtSubcategoria'], 
			'id_ent'=>$variables ['txtEmpresa'], 
			'id_est'=>$variables ['txtEstado'], 
			'nom_serv'=>$variables ['txtNombre'], 
			'desc_serv'=>$variables ['txtDescripcion'], 
			'seo_serv'=>"", 
			'id_ts'=>$variables ['txtTipoServicio'],
			'seo_serv'=>""
		);
		$resultado=$transaccion->insertarServicio($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	else
	{
		if(
			isset($variables ['txtNombre']) &&
			isset($variables ['txtCategoria']) &&
			isset($variables ['txtSubcategoria']) &&
			isset($variables ['txtTipoServicio']) &&
			isset($variables ['txtDescripcion'])
		)
		{
			include_once('./transaccion.php');
			$transaccion=new transaccion();
			$arg=array(
				'is_scat'=>$variables ['txtSubcategoria'], 
				'id_ent'=>$_SESSION['empresa'], 
				'id_est'=>SERVICIO_DEFECTO, 
				'nom_serv'=>$variables ['txtNombre'], 
				'desc_serv'=>$variables ['txtDescripcion'], 
				'seo_serv'=>"", 
				'id_ts'=>$variables ['txtTipoServicio'],
				'seo_serv'=>""
			);
			$resultado=$transaccion->insertarServicio($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, recargue la pagina e intente nuevamente";
			}
		}
		else
		{
			//print_r($variables);
			echo "Error al recibir los parametros";
		}
	}
	
}
if(isset($_POST['agregarMultimedia']))
{
	$variables=serializeToArray($_POST['agregarMultimedia']);
	if(
		isset($variables ['txtNombre']) &&
		isset($variables ['txtTipoMultimedia']) &&
		isset($variables ['txtUrl'])
	)
	{
		$ent=0;
		if(isset($variables ['txtEmpresa']))
		{
			$ent=$variables ['txtEmpresa'];
		}
		else
		{
			if(isset($_SESSION['empresa']))
			{
				$ent=$_SESSION['empresa'];
			}
		}
		if($ent!=0)
		{
			include_once('./transaccion.php');
			$transaccion=new transaccion();
			$arg=array(
				'id_ent'=>$ent, 
				'nom_med'=>$variables ['txtNombre'], 
				'id_tm'=>$variables ['txtTipoMultimedia'], 
				'url_med'=>$variables ['txtUrl'] 
			);
			$resultado=$transaccion->insertarMedia($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, recargue la pagina e intente nuevamente";
			}
		}
		else
		{
			echo "Seleccione la empresa a agregar el archivo multimedia";
		}
	}
	
}

if(isset($_POST['agregarDocumento']))
{
	$variables=serializeToArray($_POST['agregarDocumento']);
	if(
		isset($variables ['txtTipodoc']) &&
		isset($variables ['txtNombre']) &&
		isset($variables ['txtUrl']) &&
		isset($variables ['txtEmpresa'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'id_td'=>$variables ['txtTipodoc'], 
			'nom_doc'=>$variables ['txtNombre'], 
			'url_doc'=>$variables ['txtUrl'], 
			'id_ent'=>$variables ['txtEmpresa']
		);
		$resultado=$transaccion->insertarDocumento($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
		
	}
	else
	{
		if(
			isset($variables ['txtTipodoc']) &&
			isset($variables ['txtNombre']) &&
			isset($variables ['txtUrl'])
		)
		{
			include_once('./transaccion.php');
			$transaccion=new transaccion();
			$arg=array(
				'id_td'=>$variables ['txtTipodoc'], 
				'nom_doc'=>$variables ['txtNombre'], 
				'url_doc'=>$variables ['txtUrl'], 
				'id_ent'=>$_SESSION['empresa']
			);
			$resultado=$transaccion->insertarDocumento($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, recargue la pagina e intente nuevamente";
			}
		}
	}
}
if(isset($_POST['contratar']))
{
	include_once('./transaccion.php');
	$transaccion=new transaccion();
	$arreglo=$_POST['contratar'];
	$empresas=array();
	$servicios=array();
	$contratos=array();
	for($i=0;$i<count($arreglo);$i++)
	{
		$arg=array ('id_serv'=>$arreglo[$i]);
		$serv=$transaccion->listarServicio($arg);
		$servicios[count($servicios)]=$serv [0];
		if(!in_array($serv [0] ['id_ent'],$empresas))
		{
			$empresas[count($empresas)]=$serv [0] ['id_ent'];
		}
	}
	for($i=0;$i<count($empresas);$i++)
	{
		$arg=array ('rut'=>$_SESSION['rut'], 'id_est'=>7);
		$contratos[$i]=$transaccion->insertarContacto($arg);
	}
	for($i=0;$i<count($servicios);$i++)
	{
		$id_con=0;
		for($j=0;$j<count($empresas);$j++)
		{
			if($empresas [$j]==$servicios [$i] ['id_ent'])
			{
				$id_con=$contratos[$j];
			}
		}
		$arg=array ('id_serv'=>$servicios [$i] ['id_serv'], 'id_con'=>$id_con);
		$servicio=$transaccion->insertarServcon($arg);
	}
	echo 'Exito';
	
}
if(isset($_POST['agregarMensaje']))
{
	$variables=serializeToArray($_POST['agregarMensaje']);
	if(
		isset($variables ['txtMensaje']) && 
		isset($variables ['txtCode'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
			"id_con" => $variables ['txtCode'], 
			"emisor" => $_SESSION['rut'], 
			"mensaje" => $variables ['txtMensaje']
		);
		$resultado=$transaccion->insertarMensajes($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}
if(isset($_POST['agregarMenu']))
{
	$variables=serializeToArray($_POST['agregarMenu']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtDescripcion']) && 
		isset($variables ['txtTipo'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
				"nom_menu" => $variables ['txtNombre'], 
				"desc_menu" => $variables ['txtDescripcion'], 
				"id_tu" => $variables ['txtTipo']
			);
		$resultado=$transaccion->insertarMenu($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}
if(isset($_POST['agregarAutoridad']))
{
	$variables=serializeToArray($_POST['agregarAutoridad']);
	if(
		isset($variables ['txtEmpresa']) && 
		isset($variables ['txtPersona'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
				"rut" => $variables ['txtPersona'], 
				"id_ent" => $variables ['txtEmpresa']
			);
		$resultado=$transaccion->insertarAutoridad($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
}
if(isset($_POST['agregarPais']))
{
	$variables=serializeToArray($_POST['agregarPais']);
	//print_r($variables);
	if(
		isset($variables ['txtNombre'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_pais'=>$variables ['txtNombre']
		);
		$resultado=$transaccion->insertarPais($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
}

if(isset($_POST['agregarRegion']))
{
	$variables=serializeToArray($_POST['agregarRegion']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtPais'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_reg'=>$variables ['txtNombre'], 
			'id_pais'=>$variables ['txtPais']
		);
		$resultado=$transaccion->insertarRegion($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
}

if(isset($_POST['agregarPagina']))
{
	$variables=serializeToArray($_POST['agregarPagina']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtTp']) && 
		isset($variables ['txtUrlFicticio']) && 
		isset($variables ['txtUrlReal']) && 
		isset($variables ['txtDescripcion'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_pag'=>$variables ['txtNombre'], 
			'id_tp'=>$variables ['txtTp'], 
			'url_pag'=>$variables ['txtUrlFicticio'], 
			'url_real'=>$variables ['txtUrlReal'], 
			'desc_pag'=>$variables ['txtDescripcion']
		);
		$resultado=$transaccion->insertarPagina($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}

if(isset($_POST['agregarProvincia']))
{
	$variables=serializeToArray($_POST['agregarProvincia']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtRegion'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_prov'=>$variables ['txtNombre'], 
			'id_reg'=>$variables ['txtRegion']
		);
		$resultado=$transaccion->insertarProvincia($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}

if(isset($_POST['agregarComuna']))
{
	$variables=serializeToArray($_POST['agregarComuna']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtProvincia'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_com'=>$variables ['txtNombre'], 
			'id_prov'=>$variables ['txtProvincia']
		);
		$resultado=$transaccion->insertarComuna($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}

if(isset($_POST['agregarCategoria']))
{
	$variables=serializeToArray($_POST['agregarCategoria']);
	if(
		isset($variables ['txtNombre'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_cat'=>$variables ['txtNombre']
		);
		$resultado=$transaccion->insertarCategoria($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
}
if(isset($_POST['agregarEscalacal']))
{
	$variables=serializeToArray($_POST['agregarEscalacal']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtValor'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_ec'=>$variables ['txtNombre'], 
			'valor'=>$variables ['txtValor']
		);
		$resultado=$transaccion->insertarEscalacal($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}

if(isset($_POST['agregarEstado']))
{
	$variables=serializeToArray($_POST['agregarEstado']);
	if(
		isset($variables ['txtNombre']) 
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_est'=>$variables ['txtNombre']
		);
		$resultado=$transaccion->insertarEstado($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}

if(isset($_POST['agregarSubcategoria']))
{
	$variables=serializeToArray($_POST['agregarSubcategoria']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtCategoria'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_scat'=>$variables ['txtNombre'], 
			'id_cat'=>$variables ['txtCategoria']
		);
		$resultado=$transaccion->insertarSubcategoria($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}

if(isset($_POST['agregarTipocal']))
{
	$variables=serializeToArray($_POST['agregarTipocal']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtDescripcion'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_tc'=>$variables ['txtNombre'], 
			'desc_tc'=>$variables ['txtDescripcion']
		);
		$resultado=$transaccion->insertarTipocal($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}

if(isset($_POST['agregarTipodoc']))
{
	$variables=serializeToArray($_POST['agregarTipodoc']);
	if(
		isset($variables ['txtNombre'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_td'=>$variables ['txtNombre']
		);
		$resultado=$transaccion->insertarTipodoc($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}

if(isset($_POST['agregarTipomedia']))
{
	$variables=serializeToArray($_POST['agregarTipomedia']);
	if(
		isset($variables ['txtNombre'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_tm'=>$variables ['txtNombre']
		);
		$resultado=$transaccion->insertarTipomedia($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}

if(isset($_POST['agregarTipopag']))
{
	$variables=serializeToArray($_POST['agregarTipopag']);
	if(
		isset($variables ['txtNombre'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_tp'=>$variables ['txtNombre']
		);
		$resultado=$transaccion->insertarTipopagina($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}

if(isset($_POST['agregarTiposerv']))
{
	$variables=serializeToArray($_POST['agregarTiposerv']);
	if(
		isset($variables ['txtNombre'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_ts'=>$variables ['txtNombre']
		);
		$resultado=$transaccion->insertarTiposervicio($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}

if(isset($_POST['agregarTipousuario']))
{
	$variables=serializeToArray($_POST['agregarTipousuario']);
	if(
		isset($variables ['txtNombre'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_tu'=>$variables ['txtNombre']
		);
		if(
			isset($variables ['txtPermisos'])
		)
		{
			$arg=array(
				'nom_tu'=>$variables ['txtNombre'],
				'insert_id'=>'id'
			);
			$resultado=$transaccion->insertarTipousuario($arg);
			$arg=array(
				'id_tu1'=>$variables ['txtPermisos'],
				'id_tu2'=>$resultado
			);
			//print_r($arg);
			$resultado=$transaccion->insertarPermisosPorUsuario($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, recargue la pagina e intente nuevamente";
			}
		}
		else
		{
			$resultado=$transaccion->insertarTipousuario($arg);
			if($resultado==true)
			{
				echo "Exito";
			}
			else
			{
				echo "Ocurrio un error, recargue la pagina e intente nuevamente";
			}
		}
	}
	
}

if(isset($_POST['agregarPermiso']))
{
	$variables=serializeToArray($_POST['agregarPermiso']);
	if(
		isset($variables ['txtTipoUsuario']) && 
			isset($variables ['txtPagina'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
			"id_tu" => $variables ['txtTipoUsuario'], 
			"id_pag" => $variables ['txtPagina']
		);
		$resultado=$transaccion->insertarPermisos($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}
if(isset($_POST['agregarItem']))
{
	$variables=serializeToArray($_POST['agregarItem']);
	if(
		isset($variables ['txtMenu']) && 
			isset($variables ['txtPagina'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
			"id_menu" => $variables ['txtMenu'], 
			"id_pag" => $variables ['txtPagina']
		);
		$resultado=$transaccion->insertarItem($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
}
if(isset($_POST['agregarPregunta']))
{
	$variables=serializeToArray($_POST['agregarPregunta']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtDescripcion'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_tc'=>$variables ['txtNombre'], 
			'desc_tc'=>$variables ['txtDescripcion']
		);
		$resultado=$transaccion->insertarTipocal($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}
if(isset($_POST['agregarMetrica']))
{
	$variables=serializeToArray($_POST['agregarMetrica']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtValor'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_ec'=>$variables ['txtNombre'], 
			'valor'=>$variables ['txtValor']
		);
		$resultado=$transaccion->insertarEscalacal($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}
if(isset($_POST['agregarPlan']))
{
	$variables=serializeToArray($_POST['agregarPlan']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtValor']) && 
		isset($variables ['txtDias']) && 
		isset($variables ['txtEstado'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg=array(
			'nom_plan'=>$variables ['txtNombre'], 
			'valor_plan'=>$variables ['txtValor'], 
			'dias'=>$variables ['txtDias'], 
			'id_est'=>$variables ['txtEstado']
		);
		$resultado=$transaccion->insertarPlan($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}
if(isset($_POST['agregarBoleta']))
{
	$variables=serializeToArray($_POST['agregarBoleta']);
	if(
		isset($variables ['txtEmpresa']) && 
		isset($variables ['txtMonto']) && 
		isset($variables ['txtFecha']) && 
		isset($variables ['txtEstado']) && 
		isset($variables ['txtPlan'])
	)
	{
		include_once('./transaccion.php');
		include_once('./function.php');
		$date=explode("/",$variables ['txtFecha']);
		$transaccion=new transaccion();
		$arg=array(
			'id_ent'=>$variables ['txtEmpresa'], 
			'monto'=>$variables ['txtMonto'], 
			'id_plan'=>$variables ['txtPlan'], 
			'fecha_bol'=>$date[2].'-'.$date[1].'-'.$date[0], 
			'id_est'=>$variables ['txtEstado']
		);
		$resultado=$transaccion->insertarBoleta($arg);
		if($resultado==true)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}
////////////////////////////////
//   Segundo los modificar    //
////////////////////////////////
if(isset($_POST['borrarContacto']))
{
	$variables=$_POST['borrarContacto'];
	include_once('./transaccion.php');
	$transaccion=new transaccion;
	$arg = array (
		"id_est" => 10,
		"clause" => "id_con='".$_POST['borrarContacto']."' and id_est='7'",
		"affected" => md5('nada')
	);
	
	$resultado=$transaccion->modificarContacto($arg);
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
	
}
if(isset($_POST['finalizarContacto']))
{
	include_once('./transaccion.php');
	$transaccion=new transaccion;
	$arg = array (
		"id_est" => 9,
		"clause" => "id_con='".$_POST['finalizarContacto']."' and id_est='7' and id_ent='".$_SESSION['empresa']."'",
		"affected" => md5('nada')
	);
	
	$resultado=$transaccion->modificarContacto($arg);
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
	
}
if(isset($_POST['modificarPerfil']))
{
	$variables=serializeToArray($_POST['modificarPerfil']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtApellido']) && 
		isset($variables ['txtTelefono']) && 
		isset($variables ['txtPais']) && 
		isset($variables ['txtRegion']) && 
		isset($variables ['txtProvincia']) && 
		isset($variables ['txtComuna']) && 
		isset($variables ['txtDireccion']) && 
		isset($variables ['txtFecha']) && 
		isset($variables ['txtEmail']) && 
		isset($variables ['txtCaptcha'])
	)
	{
		if(strtoupper($variables ['txtCaptcha']) == $_SESSION["captcha"])
		{
			$_SESSION["captcha"]= md5(rand()*time());
			$arg=array('rut'=>$_SESSION['rut']);
			include_once('./function.php');
			$personas=listarPersona($arg);
			$arg=array('email_per'=>$variables ['txtEmail']);
			if(count(listarPersona($arg))==0 || $personas [0] ['email_per']==$variables ['txtEmail'])
			{
				include_once('./transaccion.php');
				include_once('./function.php');
				$transaccion=new transaccion();
				$arg=array(
					'nombre'=>$variables ['txtNombre'],
					'apellido'=>$variables ['txtApellido'],
					'tel_per'=>$variables ['txtTelefono'],
					'id_com'=>$variables ['txtComuna'],
					'direccion'=>$variables ['txtDireccion'],
					'fecha_nac'=>dateEncode($variables ['txtFecha']), 
					'email_per'=>$variables ['txtEmail'],
					"condition" => "rut",
					"data" => $_SESSION['rut'],
					"affected" => md5('nada')
					
				);
				$resultado=$transaccion->modificarPersona($arg);
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
			}
			else
			{
				echo "El correo ya se encuentra registrado";
			}
		}
		else
		{
			echo "El captcha no coincide";
		}
	}
	else
	{
		echo "Error al recibir los parametros";
	}
	
}
if(isset($_POST['modificarDocumento']))
{
	$variables=serializeToArray($_POST['modificarDocumento']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtTipodoc']) && 
		isset($variables ['txtUrl']) && 
		isset($variables ['txtEmpresa'])
	) 
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$arg = array (
			"nom_doc" => $variables ['txtNombre'],
			"id_td" => $variables ['txtTipodoc'],
			"url_doc" => $variables ['txtUrl'],
			"id_ent" => $variables ['txtEmpresa'],
			"condition" => "id_doc",
			"data" => $variables ['txtCode'],
			"affected" => md5('nada')
		);
		
		$resultado=$transaccion->modificarDocumento($arg);
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
	}	
	else
	{
		if(
			isset($variables ['txtCode']) && 
			isset($variables ['txtNombre']) && 
			isset($variables ['txtTipodoc']) && 
			isset($variables ['txtUrl'])
		) 
		{
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$arg = array (
				"nom_doc" => $variables ['txtNombre'],
				"id_td" => $variables ['txtTipodoc'],
				"url_doc" => $variables ['txtUrl'],
				"clause" => "id_doc='".$variables ['txtCode']."' and id_ent='".$_SESSION['empresa']."'",
				"affected" => md5('nada')
			);
			
			$resultado=$transaccion->modificarDocumento($arg);
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
		}
		else
		{
			echo "Error al recibir los datos";
		}
	}
}
if(isset($_POST['modificarMultimedia']))
{
	$variables=serializeToArray($_POST['modificarMultimedia']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtTipoMultimedia']) && 
		isset($variables ['txtUrl'])
	) 
	{
		$ent=0;
		if(isset($variables ['txtEmpresa']))
		{
			$ent=$variables ['txtEmpresa'];
		}
		else
		{
			if(isset($_SESSION['empresa']))
			{
				$ent=$_SESSION['empresa'];
			}
		}
		if($ent!=0)
		{
			$arg = array (
				"nom_med" => $variables ['txtNombre'],
				"id_ent" => $ent,
				"id_tm" => $variables ['txtTipoMultimedia'],
				"url_med" => $variables ['txtUrl'],
				"condition" => "id_med",
				"data" => $variables ['txtCode'],
				"affected" => md5('nada')
			);
			include_once('./transaccion.php');
			$transaccion=new transaccion;
			$resultado=$transaccion->modificarMedia($arg);
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
		}
		else
		{
			echo "Seleccione la empresa a editar el archivo multimedia";
		}
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}
if(isset($_POST['modificarPais']))
{
	$variables=serializeToArray($_POST['modificarPais']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre'])
	)
	{
		$arg = array (
			"nom_pais" => $variables ['txtNombre'],
			"condition" => "id_pais",
			"affected" => md5('nada'),
			"data" => $variables ['txtCode']
		);
		include_once('./transaccion.php');
		//print_r($arg);
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarPais($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}

if(isset($_POST['modificarRegion']))
{
	$variables=serializeToArray($_POST['modificarRegion']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtPais'])
	)
	{
		$arg = array (
			"nom_reg" => $variables ['txtNombre'],
			"id_pais" => $variables ['txtPais'],
			"condition" => "id_reg",
			"data" => $variables ['txtCode'],
			"affected" => md5('nada')
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarRegion($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}

if(isset($_POST['modificarProvincia']))
{
	$variables=serializeToArray($_POST['modificarProvincia']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtRegion'])
	)
	{
		$arg = array (
			"nom_prov" => $variables ['txtNombre'],
			"id_reg" => $variables ['txtRegion'],
			"condition" => "id_prov",
			"data" => $variables ['txtCode'],
			"affected" => md5('nada')
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarProvincia($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}

if(isset($_POST['modificarComuna']))
{
	$variables=serializeToArray($_POST['modificarComuna']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtProvincia'])
	)
	{
		$arg = array (
			"nom_com" => $variables ['txtNombre'],
			"id_prov" => $variables ['txtProvincia'],
			"condition" => "id_com",
			"data" => $variables ['txtCode'],
			"affected" => md5('nada')
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarComuna($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}

if(isset($_POST['modificarTipousuario']))
{
	$variables=serializeToArray($_POST['modificarTipousuario']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre'])
	)
	{
		$arg = array (
			"nom_tu" => $variables ['txtNombre'],
			"condition" => "id_tu",
			"data" => $variables ['txtCode'],
			"affected" => md5('nada')
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarTipousuario($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}

if(isset($_POST['modificarTipodoc']))
{
	$variables=serializeToArray($_POST['modificarTipodoc']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre'])
	)
	{
		$arg = array (
			"nom_td" => $variables ['txtNombre'],
			"condition" => "id_td",
			"data" => $variables ['txtCode'],
			"affected" => md5('nada')
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarTipodoc($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}

if(isset($_POST['modificarTipomedia']))
{
	$variables=serializeToArray($_POST['modificarTipomedia']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre'])
	)
	{
		$arg = array (
			"nom_tm" => $variables ['txtNombre'],
			"condition" => "id_tm",
			"data" => $variables ['txtCode'],
			"affected" => md5('nada')
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarTipomedia($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}

if(isset($_POST['modificarMenu']))
{
	$variables=serializeToArray($_POST['modificarMenu']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtDescripcion']) && 
		isset($variables ['txtTipo'])
	)
	{
		$arg = array (
			"nom_menu" => $variables ['txtNombre'],
			"desc_menu" => $variables ['txtDescripcion'],
			"id_tu" => $variables ['txtTipo'],
			"condition" => "id_menu",
			"data" => $variables ['txtCode'],
			"affected" => md5('nada')
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarMenu($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}

if(isset($_POST['modificarTipopag']))
{
	$variables=serializeToArray($_POST['modificarTipopag']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre'])
	)
	{
		$arg = array (
			"nom_tp" => $variables ['txtNombre'],
			"condition" => "id_tp",
			"data" => $variables ['txtCode'],
			"affected" => md5('nada')
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarTipopagina($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}
if(isset($_POST['modificarPagina']))
{
	$variables=serializeToArray($_POST['modificarPagina']);
	if(
		isset($variables ['txtNombre']) && 
		isset($variables ['txtTp']) && 
		isset($variables ['txtUrlFicticio']) && 
		isset($variables ['txtUrlReal']) && 
		isset($variables ['txtDescripcion']) && 
		isset($variables ['txtCode'])
	)
	{
		$arg = array (
			"nom_pag" => $variables ['txtNombre'],
			"id_tp" => $variables ['txtTp'],
			"url_pag" => $variables ['txtUrlFicticio'],
			"url_real" => $variables ['txtUrlReal'],
			"desc_pag" => $variables ['txtDescripcion'],
			"condition" => "id_pag",
			"data" => $variables ['txtCode'],
			"affected" => md5('nada')
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion; 
		$resultado=$transaccion->modificarPagina($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}
if(isset($_POST['modificarUsuario']))
{
	$variables=serializeToArray($_POST['modificarUsuario']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtApellido']) && 
		isset($variables ['txtTelefono']) && 
		isset($variables ['txtPais']) && 
		isset($variables ['txtRegion']) && 
		isset($variables ['txtProvincia']) && 
		isset($variables ['txtComuna']) && 
		isset($variables ['txtDireccion']) && 
		isset($variables ['txtTipo']) && 
		isset($variables ['txtEstado']) && 
		isset($variables ['txtFecha']) && 
		isset($variables ['txtEmail'])
	)
	{
		$arg=array('rut'=>$variables ['txtCode']);
		include_once('./function.php');
		$personas=listarPersona($arg);
		$arg=array('email_per'=>$variables ['txtEmail']);
		if(count(listarPersona($arg))==0 || $personas [0] ['email_per']==$variables ['txtEmail'])
		{
			include_once('./transaccion.php');
			$transaccion=new transaccion();
			$arg=array(
				'nombre'=>$variables ['txtNombre'],
				'apellido'=>$variables ['txtApellido'],
				'tel_per'=>$variables ['txtTelefono'],
				'id_com'=>$variables ['txtComuna'],
				'direccion'=>$variables ['txtDireccion'],
				'fecha_nac'=>dateEncode($variables ['txtFecha']),
				'id_tu'=>$variables ['txtTipo'],
				'id_est'=>$variables ['txtEstado'],
				'email_per'=>$variables ['txtEmail'],
				"condition" => "rut",
				"data" => $variables ['txtCode'],
				"affected" => md5('nada')
				
			);
			$resultado=$transaccion->modificarPersona($arg);
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
		}
		else
		{
			echo "El correo ya se encuentra registrado";
		}
	}
	else
	{
		echo "Error al recibir los parametros";
	}
	
}

if(isset($_POST['modificarEmpresa']))
{
	$variables=serializeToArray($_POST['modificarEmpresa']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtDescripcion']) && 
		isset($variables ['txtTelefono']) && 
		isset($variables ['txtEmail']) && 
		isset($variables ['txtEstado']) && 
		isset($variables ['txtSub']) && 
		isset($variables ['txtSeo']) &&
		isset($variables ['txtEstado'])
	)
	{
		if (filter_var($variables ['txtEmail'], FILTER_VALIDATE_EMAIL))
		{
			include_once('./transaccion.php');
			include_once('./function.php');
			$arg = array (
				"nom_ent" => $variables ['txtNombre'],
				"id_est" => $variables ['txtEstado'],
				"subscripcion" => dateEncode($variables ['txtSub']),
				"email_ent" => $variables ['txtEmail'],
				"tel_ent" => $variables ['txtTelefono'],
				"desc_ent" => $variables ['txtDescripcion'],
				"seo_ent" => $variables ['txtSeo'],
				"condition" => "id_ent",
				"data" => $variables ['txtCode'],
				"affected" => md5('nada')
			);
			$transaccion=new transaccion; 
			$resultado=$transaccion->modificarEntidad($arg);
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
		}
		else
		{
			echo "Correo no valido";
		}
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}
if(isset($_POST['modificarContacto']))
{
	$variables=serializeToArray($_POST['modificarContacto']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtUsuario']) && 
		isset($variables ['txtEmpresa']) && 
		isset($variables ['txtFecha']) && 
		isset($variables ['txtEstado'])
	)
	{
		$arg = array (
			"rut" => $variables ['txtUsuario'],
			"id_ent" => $variables ['txtEmpresa'],
			"fecha_con" => $variables ['txtFecha'],
			"id_est" => $variables ['txtEstado'],
			"condition" => "id_con",
			"data" => $variables ['txtCode'],
			"affected" => md5('nada')
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarContacto($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}
if(isset($_POST['modificarCategoria']))
{
	$variables=serializeToArray($_POST['modificarCategoria']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre'])
	)
	{
		$arg = array (
			"nom_cat" => $variables ['txtNombre'],
			"condition" => "id_cat",
			"affected" => md5('nada'),
			"data" => $variables ['txtCode']
		);
		include_once('./transaccion.php');
		//print_r($arg);
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarCategoria($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}
if(isset($_POST['modificarTiposerv']))
{
	$variables=serializeToArray($_POST['modificarTiposerv']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre'])
	)
	{
		$arg = array (
			"nom_ts" => $variables ['txtNombre'],
			"condition" => "id_ts",
			"affected" => md5('nada'),
			"data" => $variables ['txtCode']
		);
		include_once('./transaccion.php');
		//print_r($arg);
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarTiposervicio($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}
if(isset($_POST['modificarSubcategoria']))
{
	$variables=serializeToArray($_POST['modificarSubcategoria']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtCategoria'])
	)
	{
		$arg = array (
			"nom_scat" => $variables ['txtNombre'], 
			"id_cat" => $variables ['txtCategoria'], 
			"condition" => "id_scat", 
			"affected" => md5('nada'), 
			"data" => $variables ['txtCode'] 
		);
		include_once('./transaccion.php');
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarSubcategoria($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}
if(isset($_POST['modificarPregunta']))
{
	$variables=serializeToArray($_POST['modificarPregunta']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtDescripcion'])
	)
	{
		$arg = array (
			"nom_tc" => $variables ['txtNombre'],
			"desc_tc" => $variables ['txtDescripcion'],
			"condition" => "id_tc",
			"affected" => md5('nada'),
			"data" => $variables ['txtCode']
		);
		include_once('./transaccion.php');
		//print_r($arg);
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarTipocal($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}
if(isset($_POST['modificarConfiguracion']))
{
	$variables=serializeToArray($_POST['modificarConfiguracion']);
	if(
		isset($variables ['txtPagina']) && 
		isset($variables ['txtUrl']) && 
		isset($variables ['txtLogin']) && 
		isset($variables ['txtServicio']) && 
		isset($variables ['txtUsuario']) && 
		isset($variables ['txtEmpresa']) && 
		isset($variables ['txtMax']) && 
		isset($variables ['txtMin']) && 
		isset($variables ['txtCaptcha'])
	)
	{
		if(strtoupper($variables ['txtCaptcha']) == $_SESSION["captcha"])
		{
			$_SESSION["captcha"]= md5(rand()*time());
			$registro="";
			$archivo= "webConfig.php";
			$registro=$registro."<?php ";
			$registro=$registro." define('MANTENIMIENTO', '".$variables ['txtPagina']."');";
			$registro=$registro." define('WEB_BASE', '".$variables ['txtUrl']."');";
			$registro=$registro." define('LOGIN_DEFECTO', ".$variables ['txtLogin'].");";
			$registro=$registro." define('SERVICIO_DEFECTO', ".$variables ['txtServicio'].");";
			$registro=$registro." define('USUARIO_DEFECTO', ".$variables ['txtUsuario'].");";
			$registro=$registro." define('EMPRESA_DEFECTO', ".$variables ['txtEmpresa'].");";
			$registro=$registro." define('MAX_SERVICIOS', ".$variables ['txtMax'].");";
			$registro=$registro." define('MAX_EMPRESAS', ".$variables ['txtMin'].");";
			$registro=$registro." ?>";
			$file = fopen($archivo,"w");
			fwrite($file,$registro);
			fclose($file);
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error con el captcha";
			
		}
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}
if(isset($_POST['modificarMetrica']))
{
	$variables=serializeToArray($_POST['modificarMetrica']);
	if(
		isset($variables ['txtCode']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtValor'])
	)
	{
		$arg = array (
			"nom_ec" => $variables ['txtNombre'],
			"valor" => $variables ['txtValor'],
			"condition" => "id_ec",
			"affected" => md5('nada'),
			"data" => $variables ['txtCode']
		);
		include_once('./transaccion.php');
		//print_r($arg);
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarEscalacal($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}
if(isset($_POST['modificarServicio']))
{
	$variables=serializeToArray($_POST['modificarServicio']);
	if(
		isset($variables ['txtNombre']) &&
		isset($variables ['txtCategoria']) &&
		isset($variables ['txtSubcategoria']) &&
		isset($variables ['txtTipoServicio']) &&
		isset($variables ['txtDescripcion']) &&
		isset($variables ['txtEmpresa']) &&
		isset($variables ['txtEstado']) &&
		isset($variables ['txtCode'])
	)
	{
		$arg = array (
			"nom_serv" => $variables ['txtNombre'],
			"id_scat" => $variables ['txtSubcategoria'],
			"id_ts" => $variables ['txtTipoServicio'],
			"desc_serv" => $variables ['txtDescripcion'],
			"id_ent" => $variables ['txtEmpresa'],
			"id_est" => $variables ['txtEstado'],
			"condition" => "id_serv",
			"affected" => md5('nada'),
			"data" => $variables ['txtCode']
		);
		include_once('./transaccion.php');
		//print_r($arg);
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarServicio($arg);
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
	}	
	else
	{
		if(
			isset($variables ['txtNombre']) &&
			isset($variables ['txtCategoria']) &&
			isset($variables ['txtSubcategoria']) &&
			isset($variables ['txtTipoServicio']) &&
			isset($variables ['txtDescripcion']) &&
			isset($variables ['txtCode'])
		)
		{
			$arg = array (
				"nom_serv" => $variables ['txtNombre'],
				"id_scat" => $variables ['txtSubcategoria'],
				"id_ts" => $variables ['txtTipoServicio'],
				"desc_serv" => $variables ['txtDescripcion'],
				"condition" => "id_serv",
				"affected" => md5('nada'),
				"data" => $variables ['txtCode']
			);
			include_once('./transaccion.php');
			//print_r($arg);
			$transaccion=new transaccion;
			$resultado=$transaccion->modificarServicio($arg);
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
		}
		else
		{
			echo "Error al recibir los datos.";
		}
	}
	
}
if(isset($_POST['modificarPlan']))
{
	$variables=serializeToArray($_POST['modificarPlan']);
	if(
		isset($variables ['txtNombre']) &&
		isset($variables ['txtValor']) &&
		isset($variables ['txtDias']) &&
		isset($variables ['txtEstado']) &&
		isset($variables ['txtCode'])
	)
	{
		$arg = array (
			"nom_plan" => $variables ['txtNombre'],
			"valor_plan" => $variables ['txtValor'],
			"dias" => $variables ['txtDias'],
			"id_est" => $variables ['txtEstado'],
			"condition" => "id_plan",
			"affected" => md5('nada'),
			"data" => $variables ['txtCode']
		);
		include_once('./transaccion.php');
		//print_r($arg);
		$transaccion=new transaccion;
		$resultado=$transaccion->modificarPlan($arg);
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
	}	
	else
	{
		echo "Error al recibir los datos";
	}
	
}
if(isset($_POST['modificarContrasena']))
{
	$variables=serializeToArray($_POST['modificarContrasena']);
	if(
		isset($variables ['txtOldPassword']) && 
		isset($variables ['txtRePassword']) && 
		isset($variables ['txtNewRePassword']) && 
		isset($variables ['txtCaptcha'])
	)
	{
		if(strtoupper($variables ['txtCaptcha']) == $_SESSION["captcha"])
		{
			$_SESSION["captcha"]= md5(rand()*time());
			if($_POST["NewPassword"]==$_POST["NewRePassword"])
			{
				$arg = array (
					"nom_cat" => md5($variables ['NewPassword']),
					"affected" => "nada",
					"clause" => "rut='".$_SESSION['rut']."' and contrasena='".$variables ['txtOldPassword']."'"
				);
				include_once('./transaccion.php');
				$transaccion=new transaccion;
				$resultado=$transaccion->modificarPersona($arg);
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
			}
			else
			{
				echo "Las contraseñas no coinciden";
			}
		}
		else
		{
			echo "El captcha es invalido";
		}
	}
	else
	{
		if(
			isset($variables ['txtRePassword']) && 
			isset($variables ['txtNewRePassword']) && 
			isset($variables ['txtCaptcha']) && 
			isset($variables ['txtCode'])
		)
		{
			if(strtoupper($variables ['txtCaptcha']) == $_SESSION["captcha"])
			{
				$_SESSION["captcha"]= md5(rand()*time());
				if($_POST["NewPassword"]==$_POST["NewRePassword"])
				{
					$arg = array (
						"nom_cat" => md5($variables ['NewPassword']),
						"affected" => "nada",
						"clause" => "rut='".$_SESSION['rut']."' and contrasena='".urldecode(base64_decode($variables ['txtCode']))."'"
					);
					include_once('./transaccion.php');
					$transaccion=new transaccion;
					$resultado=$transaccion->modificarPersona($arg);
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
				}
				else
				{
					echo "Las contraseñas no coinciden";
				}
			}
			else
			{
				echo "El captcha es invalido";
			}
		}
	}
}
////////////////////////////////
//    Tercero los eliminar    //
////////////////////////////////
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
}
if(isset($_POST['eliminarContacto']))
{
	include_once('./transaccion.php');
	$transaccion=new transaccion;
	$arg=array ('id_con'=> $_POST["eliminarContacto"]);
	$transaccion->eliminarServcon($arg);
	$transaccion->eliminarContacto($arg);
	echo "Exito";
	
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
	
}
if(isset($_POST['eliminarCobertura']))
{
	$param=explode("-",$_POST["eliminarCobertura"]);
	if(isset($param[0]))
	{
		if($param[0]>0)
		{
			$arg = array();
			if(isset($param[1]) && $_SESSION['rol']>1)
			{
				$arg = array (
					"id_com" => $param[0],
					"id_ent" => $param[1],
					"affected" => md5('nada')
				);
			}
			else
			{
				if(isset($_SESSION['empresa']))
				{
					$arg = array (
						"id_com" => $param[0],
						"id_ent" => $_SESSION['empresa'],
						"affected" => md5('nada')
					);
				}
			}
			if($arg != array())
			{
				include_once('./transaccion.php');
				$transaccion=new transaccion;
				$resultado=$transaccion->eliminarCobertura($arg);
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
			}
			else
			{
				echo "Problema al obtener los datos";
			}
		}
		else
		{
			echo "La comuna no es valida";
		}
	}
	else
	{
		echo "Los parametros enviados no son validos";
	}
	
	 
	
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
	//echo "Resultado:".$resultado."<br>";
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
	
}
if(isset($_POST['eliminarPermisos']))
{
	//echo "eliminarPermisos";
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
	
}
if(isset($_POST['eliminarItem']))
{
	//echo "eliminarItem";
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
	
}
if(isset($_POST['eliminarTipodocumento']))
{
	//echo "eliminarTipodocumento";
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
	
}
if(isset($_POST['eliminarTipomultimedia']))
{
	//echo "eliminarTipomultimedia";
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
	
}
if(isset($_POST['eliminarTipopagina']))
{
	//echo "eliminarTipopagina";
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

if(isset($_POST['borrarServicio']))
{
	$arg = array (
		"id_est" => 10,
		"condition" => "id_serv",
		"affected" => md5('nada'),
		"data" => $_POST['borrarServicio']
	);
	include_once('./transaccion.php');
	//print_r($arg);
	$transaccion=new transaccion;
	$resultado=$transaccion->modificarServicio($arg);
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
////////////////////////////////
//      Cuarto los Ajax       //
////////////////////////////////
if(isset($_POST['identificarse']))
{
	$variables=serializeToArray($_POST['identificarse']);
	if(
		isset($variables ['txtRut']) &&
		isset($variables ['txtContrasena']) &&
		isset($variables ['txtCaptcha'])
	)
	{
		if(strtoupper($variables ['txtCaptcha']) == $_SESSION["captcha"])
		{
			$_SESSION["captcha"]= md5(rand()*time());
			include_once('./transaccion.php');
			$transaccion=new transaccion();
			$arg= array (
				'contrasena'=>md5($variables ['txtContrasena']),
				'rut'=>$variables ['txtRut'],
				'id_est'=>LOGIN_DEFECTO
			);
			$usuario=$transaccion->listarPersona($arg);
			if(count($usuario)>0)
			{
				$_SESSION['rut']=$usuario[0]['rut'];
				$_SESSION['nombre']=$usuario[0]['nombre'];
				$_SESSION['rol']=$usuario[0]['id_tu'];
				echo "Exito";
				//echo $_SESSION['rut'];
				//print_r($usuario);
			}
			else
			{
				echo "No se encuentraron coincidencias, revise la contraseña y el rut";
			}
			
		}
		else
		{
			echo "Ocurrio un error con el captcha";
			
		}
	}
	else
	{
		echo "error al enviar los datos";
		
	}
}
if(isset($_POST['verificarCodigo']))
{
	$variables=serializeToArray($_POST['verificarCodigo']);
	if(
		isset($variables ['txtCode'])
	)
	{	
		$correo = urldecode(base64_decode($variables ['txtCode']));
		if (filter_var($correo, FILTER_VALIDATE_EMAIL))
		{
			include_once('./transaccion.php');
			$transaccion=new transaccion();
			$arg = array (
					"email_per" => $correo
			);
			$persona=$transaccion->listarPersona($arg);
			if(count($persona)==0)
			{
				echo "Exito";
			}
			else
			{
				echo "El codigo ya fue utilizado";
			}
		}
		else
		{
			echo "El codigo es incorrecto o a expirado";
		}
	}
	else
	{
		echo "error al enviar los datos";
	}
}
if(isset($_POST['recuperarContrasena']))
{
	$variables=serializeToArray($_POST['recuperarContrasena']);
	if(
		isset($variables ['txtRut']) &&
		isset($variables ['txtEmail']) &&
		isset($variables ['txtCaptcha'])
	)
	{
		if(strtoupper($variables ['txtCaptcha']) == $_SESSION["captcha"])
		{
			$_SESSION["captcha"]= md5(rand()*time());
			if (filter_var($variables ['txtEmail'], FILTER_VALIDATE_EMAIL))
			{
				include_once('./transaccion.php');
				$transaccion=new transaccion();
				$arg = array (
					"email_per" => $variables ['txtEmail'],
					"rut" => $variables ['txtRut']
				);
				$persona=$transaccion->listarPersona($arg);
				if(count($persona)==1)
				{
					$emailcode=urlencode(base64_encode($persona ['contrasena']));
					$url=WEB_BASE.'recuperar-contrasena/'.$emailcode;
					$titulo="Cambiar contraseña de Contrato en Chile";
					$mensaje='Se a intentado recuperar la contraseña la direccion:'.$_SERVER['REMOTE_ADDR'].' /n Para poder cambiar la contraseña, llena el formulario del siguiente sitio '.$url.' 
					o ingrese el codigo en el fomulario de recuperacion de contraseña: '.$emailcode.' , este correo fue generado automaticamente, por lo que no sera respondido
					por su preferencia, gracias.';
					$resultado=mail($variables ['txtEmail'], $titulo, $mensaje);
					if($resultado==true)
					{
						echo "Exito";
					}
					else
					{
						echo "Error al enviar correo";
					}
				}
				else
				{
					echo "No se encontraron coincidencias";
				}
			}
			else
			{
				echo "El email no es valido";
			}
		}
		else
		{
			echo "Ocurrio un error con el captcha";
			
		}
	}
	else
	{
		echo "error al enviar los datos";
		
	}
}
if(isset($_POST['enviarCorreo']))
{
	$variables=serializeToArray($_POST['enviarCorreo']);
	if(
		isset($variables ['txtEmail']) && 
		isset($variables ['txtNombre']) && 
		isset($variables ['txtCaptcha']) && 
		isset($variables ['txtMensaje'])
	)
	{	
		if(strtoupper($variables ['txtCaptcha']) == $_SESSION["captcha"])
		{
			$_SESSION["captcha"]= md5(rand()*time());
			if (filter_var($variables ['txtEmail'], FILTER_VALIDATE_EMAIL))
			{
				$titulo="Mensaje para Contrato en Chile: de ".$variables ['Nombre'];
				$mensaje='Enviado por:'.$variables ['txtEmail'].' '.$variables ['Mensaje'];
				$resultado=mail("contacto@contratoenchile.cl", $titulo, $mensaje);
				echo "Exito";
			}
			else
			{
				echo "El email no es valido";
			}
		}
		else
		{
			echo "Captcha incorrecto";
		}
	}
	else
	{
		echo "error al enviar los datos";
	}
	
}
if(isset($_POST['listarRegiones']))
{
	$variables=serializeToArray($_POST['listarRegiones']);
	if(
		isset($variables ['txtPais'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
				"id_pais" => $variables ['txtPais']
		);
		$regiones=$transaccion->listarRegion($arg);
		$ddl="";
		for($i=0;$i<count($regiones);$i++)
		{
			$ddl=$ddl.'<option value="'.$regiones [$i] ['id_reg'].'">'.$regiones [$i] ['nom_reg'].'</option>';
		}
		echo $ddl;
		
	}
	else
	{
		echo "error al enviar los datos";
		
	}
}

if(isset($_POST['listarProvincias']))
{
	$variables=serializeToArray($_POST['listarProvincias']);
	if(
		isset($variables ['txtRegion'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
				"id_reg" => $variables ['txtRegion']
		);
		$provincia=$transaccion->listarProvincia($arg);
		$ddl="";
		for($i=0;$i<count($provincia);$i++)
		{
			$ddl=$ddl.'<option value="'.$provincia [$i] ['id_prov'].'">'.$provincia [$i] ['nom_prov'].'</option>';
		}
		echo $ddl;
		
	}
	else
	{
		echo "error al enviar los datos";
		
	}
}

if(isset($_POST['listarComunas']))
{
	$variables=serializeToArray($_POST['listarComunas']);
	if(
		isset($variables ['txtProvincia'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
				"id_prov" => $variables ['txtProvincia']
		);
		$comuna=$transaccion->listarComuna($arg);
		$ddl="";
		for($i=0;$i<count($comuna);$i++)
		{
			$ddl=$ddl.'<option value="'.$comuna [$i] ['id_com'].'">'.$comuna [$i] ['nom_com'].'</option>';
		}
		echo $ddl;
		
	}
	else
	{
		echo "error al enviar los datos";
		
	}
}

if(isset($_POST['listarSubcategoria']))
{
	$variables=serializeToArray($_POST['listarSubcategoria']);
	if(
		isset($variables ['txtCategoria'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
				"id_cat" => $variables ['txtCategoria']
		);
		$scat=$transaccion->listarSubcategorias($arg);
		$ddl="";
		//print_r();
		for($i=0;$i<count($scat);$i++)
		{
			$ddl=$ddl.'<option value="'.$scat [$i] ['id_scat'].'">'.$scat [$i] ['nom_scat'].'</option>';
		}
		echo $ddl;
		
	}
	else
	{
		echo "error al enviar los datos";
		
	}
}

if(isset($_POST['listarServicios']))
{
	$variables=serializeToArray($_POST['listarServicios']);
	if(
		isset($variables ['txtEmpresa'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
				"id_ent" => $variables ['txtEmpresa']
		);
		$servicios=$transaccion->listarServicio($arg);
		$ddl="";
		for($i=0;$i<count($servicios);$i++)
		{
			$ddl=$ddl.'<option value="'.$servicios [$i] ['id_serv'].'">'.$servicios [$i] ['nom_serv'].'</option>';
		}
		echo $ddl;
		
	}
	else
	{
		echo "error al enviar los datos";
		
	}
}

if(isset($_POST['validarPermisos']))
{
	$variables=serializeToArray($_POST['validarPermisos']);
	if(
		isset($variables ['txtTipoUsuario']) && 
		isset($variables ['txtPagina'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
			"id_tu" => $variables ['txtTipoUsuario'], 
			"id_pag" => $variables ['txtPagina']
		);
		$permiso=$transaccion->listarPermisos($arg);
		echo count($permiso);
		
	}
	else
	{
		echo "error al enviar los datos";
		
	}
}
if(isset($_POST['validarItem']))
{
	$variables=serializeToArray($_POST['validarItem']);
	if(
		isset($variables ['txtMenu']) && 
		isset($variables ['txtPagina'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
			"id_menu" => $variables ['txtMenu'], 
			"id_pag" => $variables ['txtPagina']
		);
		$permiso=$transaccion->listarItem($arg);
		echo count($permiso);
		
	}
	else
	{
		echo "error al enviar los datos";
		
	}
}
if(isset($_POST['validarAutoridad']))
{
	$variables=serializeToArray($_POST['validarAutoridad']);
	if(
		isset($variables ['txtEmpresa']) && 
		isset($variables ['txtPersona'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		$arg = array (
			"rut" => $variables ['txtPersona'], 
			"id_ent" => $variables ['txtEmpresa']
		);
		$permiso=$transaccion->listarAutoridadDetalle($arg);
		echo count($permiso);
		
	}
	else
	{
		echo "error al enviar los datos";
		
	}
}
if(isset($_POST['desconectarse']))
{
	if(!isset($_SESSION)){
		session_start();
	}
	$_SESSION['id']="";
	$_SESSION['nombre']="";
	$_SESSION['rol']="";
	$estadosession=session_destroy();
	echo "Exito";
}
if(isset($_POST['seleccionarEmpresa']))
{
	$variables=serializeToArray($_POST['seleccionarEmpresa']);
	if(
		isset($variables ['txtEmpresa'])
	)
	{
		include_once('./transaccion.php');
		$transaccion=new transaccion();
		if(!isset($_SESSION)){
			session_start();
		}
		$arg=array ('rut'=>$_SESSION['rut'], 'id_est'=>5, 'id_ent'=>$variables ['txtEmpresa']);
		$entidad=$transaccion->listarEntidadPorPersona($arg);
		if(count($entidad)>0)
		{
			echo "Exito";
		}
		else
		{
			echo "Ocurrio un error, recargue la pagina e intente nuevamente";
		}
	}
	
}

if(isset($_POST['actualizarCanasta']))
{
	$arreglo=$_POST['actualizarCanasta'];
	//print_r($_POST['actualizarCanasta']);
	include_once('./transaccion.php');
	$transaccion=new transaccion();
	$contenido='';
	for($i=0;$i<count($arreglo);$i++)
	{
		$arg=array ('id_serv'=>$arreglo[$i]);
		$servicio=$transaccion->listarServicio($arg);
		$contenido=$contenido.'<br>'.$servicio [0] ['nom_serv'];
	}
	echo $contenido;
	
}

if(isset($_POST['actualizarComparacion2']))
{
	$arreglo=$_POST['actualizarComparacion'];
	include_once('./transaccion.php');
	$transaccion=new transaccion();
	$contenido='';
	for($i=0;$i<count($arreglo);$i++)
	{
		$arg=array ('id_serv'=>$arreglo[$i]);
		$servicio=$transaccion->listarServicio($arg);
		$contenido=$contenido.'<br>'.$servicio [0] ['nom_serv'].'<a onclick="agregarAlCarro('. $servicio [0] ['id_serv'].')" class="canasta">Agregar a Canasta</a>';
	}
	echo $contenido;
}

if(isset($_POST['actualizarComparacion3']))
{
	$arreglo=$_POST['actualizarComparacion'];
	$arg=array ('nada'=>1);
	include_once('./transaccion.php');
	$transaccion=new transaccion();
	$calificaciones=$transaccion->listarTipocal($arg);
	$contenido='';
	for($i=0;$i<count($arreglo);$i++)
	{
		if($i!=0)
		{
			$contenido=$contenido.',';
		}
		$contenido=$contenido.'[';
		$arg=array ('id_serv'=>$arreglo[$i]);
		$servicio=$transaccion->listarPromedioCalificacionserv($arg);
		if($i!=0)
		{
			$contenido=$contenido.',';
		}
		//$contenido=$contenido.'[';
		for($j=0;$j<count($servicio);$j++)
		{
			if($j!=0)
			{
				$contenido=$contenido.',';
			}
			$contenido=$contenido.$servicio [$j]['valor'];
		}
		for($j=count($servicio);$j<count($calificaciones);$j++)
		{
			$contenido=$contenido.',0';
		}
		$contenido=$contenido.']';
	}
	echo $contenido;
}
if(isset($_POST['actualizarComparacion5']))
{
	/*{
		label: "My Second dataset",
		fillColor: "rgba(151,187,205,0.2)",
		strokeColor: "rgba(151,187,205,1)",
		pointColor: "rgba(151,187,205,1)",
		pointStrokeColor: "#fff",
		pointHighlightFill: "#fff",
		pointHighlightStroke: "rgba(151,187,205,1)",
		data: [28,48,40,19,96,27,100]
	}*/
	$arreglo=$_POST['actualizarComparacion'];
	$arg=array ('nada'=>1);
	include_once('./transaccion.php');
	$transaccion=new transaccion();
	$calificaciones=$transaccion->listarTipocal($arg);
	$contenido='';
	$colores="";
	$rgb=array (255,204,153);
	for($i=0;$i<count($rgb);$i++)
	{
		for($j=0;$j<count($rgb);$j++)
		{
			for($k=0;$k<count($rgb);$k++)
			{
				$colores[count($colores)]=$rgb[$i].','.$rgb[$j].','.$rgb[$k];
			}
		}
	}
	shuffle($colores);
	echo '{ "datasets": [';
	for($i=0;$i<count($arreglo);$i++)
	{
		if($i!=0)
		{
			echo ',';
		}
		$arg=array ('id_serv'=>$arreglo[$i]);
		$servicio=$transaccion->listarServiciosSinDetalle($arg);
		echo '{ label: "'.$servicio[0]['nom_serv'].'", ';
		echo 'fillColor: "rgba('.$colores[$i].',0.2)",';
		echo 'strokeColor: "rgba('.$colores[$i].',1)",';
		echo 'pointColor: "rgba('.$colores[$i].',1)",';
		echo 'pointStrokeColor: "#fff",';
		echo 'pointHighlightFill: "#fff",';
		echo 'pointHighlightStroke: "rgba('.$colores[$i].',1)",';
		echo 'data: [';
		$serviciopromedio=$transaccion->listarPromedioCalificacionserv($arg);
		//ahora empieza a cargar los promedios
		for($j=0;$j<count($serviciopromedio);$j++)
		{
			if($j!=0)
			{
				echo ',';
			}
			echo $serviciopromedio [$j]['valor'];
		}
		echo '] }';
	}
	echo '] }';
}
if(isset($_POST['actualizarComparacion8']))
{
	/*{"employees":
[' +
'{"firstName":"John","lastName":"Doe" },' +
'{"firstName":"Anna","lastName":"Smith" },' +
'{"firstName":"Peter","lastName":"Jones" }
]}*/
	$arreglo=$_POST['actualizarComparacion'];
	$arg=array ('nada'=>1);
	include_once('./transaccion.php');
	$transaccion=new transaccion();
	$calificaciones=$transaccion->listarTipocal($arg);
	$contenido='';
	$colores="";
	$rgb=array (255,204,153);
	for($i=0;$i<count($rgb);$i++)
	{
		for($j=0;$j<count($rgb);$j++)
		{
			for($k=0;$k<count($rgb);$k++)
			{
				$colores[count($colores)]=$rgb[$i].','.$rgb[$j].','.$rgb[$k];
			}
		}
	}
	shuffle($colores);
	echo '{ "servicios": [';
	for($i=0;$i<count($arreglo);$i++)
	{
		if($i!=0)
		{
			echo ',';
		}
		$arg=array ('id_serv'=>$arreglo[$i]);
		$servicio=$transaccion->listarServiciosSinDetalle($arg);
		echo '{ "codigo": '.$arreglo[$i].',';
		echo '"nombre": "'.$servicio[0]['nom_serv'].'", ';
		echo '"color": "'.$colores[$i].'",';
		echo '"data": [';
		$serviciopromedio=$transaccion->listarPromedioCalificacionserv($arg);
		//ahora empieza a cargar los promedios
		for($j=0;$j<count($serviciopromedio);$j++)
		{
			if($j!=0)
			{
				echo ',';
			}
			echo $serviciopromedio [$j]['valor'];
		}
		echo '] }';
	}
	echo '] }';
}
if(isset($_POST['actualizarComparacion']))
{
	$arreglo=$_POST['actualizarComparacion'];
	include_once('./transaccion.php');
	$transaccion=new transaccion();
	$arg=array ();
	$tipocal=$transaccion->listarTipocal($arg);
	/*$contenido='';
	for($i=0;$i<count($arreglo);$i++)
	{
		echo '<tr>';
		$arg=array ('id_serv'=>$arreglo[$i], 'ORDER_BY'=>'id_tc');
		$servicio=$transaccion->listarServicio($arg);
		echo '<td>'.$servicio[0]['nom_serv'].'</td>';
		$serviciopromedio=$transaccion->listarPromedioCalificacionserv($arg);
		//print_r($serviciopromedio);
		//ahora empieza a cargar los promedios
		for($j=0;$j<count($serviciopromedio);$j++)
		{
			echo '<td>'.$serviciopromedio [$j]['nom_ec'].'</td>';
		}
		$dif=count($tipocal)-count($serviciopromedio);
		//echo $dif;
		for($j=0;$j<count($dif);$j++)
		{
			echo '<td>Sin Calificar</td>';
		}
		echo '</tr>';
	}*/
	$contenido='';
	for($i=0;$i<count($arreglo);$i++)
	{
		
		$contenido = $contenido.'<tr>';
		$arg=array ('id_serv'=>$arreglo[$i]);
		$servicio=$transaccion->listarServicio($arg);
		$contenido = $contenido.'<td>'.$servicio[0]['nom_serv'].'</td>';
		$serviciopromedio=$transaccion->listarPromedioCalificacionserv($arg);
		for($k=0;$k<count($tipocal);$k++)
		{
			$calificacion='<td>Sin Calificar</td>';
			for($j=0;$j<count($serviciopromedio);$j++)
			{
				if($serviciopromedio [$j]['id_tc']==$tipocal[$k]['id_tc'])
				{
					$calificacion='<td>'.$serviciopromedio [$j]['nom_ec'].'</td>';
					break;
				}
			}
			$contenido = $contenido.$calificacion;
		}
		$contenido = $contenido.'</tr>';
	}
	echo $contenido;
}

if(isset($_POST['actualizarPaginaServicio']))
{
	include_once('./transaccion.php');
	$transaccion=new transaccion();
	$arg=array ('id_serv'=>$_POST['actualizarPaginaServicio']);
	$servicio=$transaccion->listarServiciosSinDetalle($arg);
	$promedio=listarPromedioCalificacionserv($arg);
	//empezamos construllendo el head para el sitio comun
	$head='<html lang="es" dir="LTR" ><head><?php $titulo="'.$servicio [0] ["nom_serv"] . ' de ' . $servicio [0] ["nom_ent"].'"; cc_head(); ?></head><body><?php cc_header(); ?><section><?php $pagina="";if(isset($_REQUEST["pagina"])){$pagina=$_REQUEST["pagina"];}cc_menu($pagina); ?></section><section id="contenido" >';
	//recopilamos el contenido y lo dejamos aparte para volverlo usar mas tarde 
	$contenido='<article class="servicios">
						<img width="120" height="95" src="'.$servicio [0] ["desc_img"] .'">
						<label class="titulo">'.$servicio [0] ["nom_serv"] . ' de ' . $servicio [0] ["nom_ent"].'</label>
						<p class="tipo"><a>'.$servicio [0] ["nom_scat"].'</a><a>'.$servicios [0] ["nom_ts"].'</a>
						<?php if(isset($_SESSION["rol"])){ if($_SESSION["rol"]>0) { ?>
							<a onclick="agregarAlCarro('.$servicio [0] ["id_serv"].')" class="canasta">Agregar a Canasta</a> 
							<a onclick="agregarAComparacion('.$servicio [0] ["id_serv"].')" class="comparar">Agregar a comparacion</a>
						<?php
								} 
							}
						?>
					</article><article class="servicios">'.$servicio [0] ["desc_serv"].'</article><article class="servicios"><h2>Reputacion: Aqui esta un resumen de las calificaciones hechos por otros usuarios.</h2><ul class="reputacion">';
	if(count($promedio)>0)
	{
		for($i=0;$i<count($promedio);$i++)
		{
			$contenido=$contenido.'<li class="cal'. str_replace(' ','_',$promedio [$i] ['nom_ec']).'">'.$promedio [$i] ['desc_tc'].'<label title="Valor: '.$promedio [$i] ['valor'].'">'.$promedio [$i] ['nom_ec']."</label></li>";
		}
	}
	else
	{
		$contenido=$contenido.'<li>Aun no a sido calificado este servicio, Puedes tu ser el primero!.</li>';
	}
	$contenido=$contenido.'</ul></article>';
	//empezamos construllendo el footer para el sitio comun
	$footer='</section><?php cc_footer(); ?></body></html>';
	//ahora definimos ruta y creamos o reemplazamos la pagina si existe
	$archivo='./detalle/'.$servicio [0] ["nom_ent"].'/'.$servicio [0] ["nom_serv"].'.php';
	$file = fopen($archivo,"w");
	fwrite($file,$head.$contenido.$footer);
	fclose($file);
	//empezamos a crear ahora la construccion de la pagina privada de la empresa
	//definimos su propio head
	$head='';
	//definimos su propio footer
	$footer='</section><?php cc_footer(); ?></body></html>';
	
	$archivo='./detalle/'.$servicio [0] ["nom_ent"].'/'.$servicio [0] ["nom_serv"].'.php';
	$file = fopen($archivo,"w");
	fwrite($file,$head.$contenido.$footer);
	fclose($file);
	
	
}
if(isset($_POST['abrirChat']))
{
	include_once('./transaccion.php');
	$transaccion=new transaccion();
	$arg=array('id_con'=>$_POST['abrirChat'], 'id_men'=>0);
	$mensajes=$transaccion->listarMensajesChat($arg);
	//print_r($mensajes);
	/*Array ( 
		[0] => Array ( 
					[id_men] => 2 
					[id_con] => 16 
					[fecha_men] => 2015-03-20 12:04:10 
					[emisor] => 18.293.138-1 
					[nombreEmisor] => juan pablo 
					[nom_ent] => Contrato en Chile2 
					[mensaje] => test desde db 
					) 
			)*/ 
	$contenido=array();
	for($i=0;$i<count($mensajes);$i++)
	{
		if(!isset($contenido[$mensajes[$i]['id_con']]))
		{
			$contenido[$mensajes[$i]['id_con']]='';
		}
		$contenido[$mensajes[$i]['id_con']] .= '<p id="msg'.$mensajes[$i]['id_men'].'" title="mensaje enviado a las '.$mensajes[$i]['fecha_men'].'" class="';
		if($mensajes[$i]['emisor'] != $_SESSION['rut'])
		{
			$contenido[$mensajes[$i]['id_con']] .= 'a';
		}
		else
		{
			$contenido[$mensajes[$i]['id_con']] .= 'b';
		}
		$contenido[$mensajes[$i]['id_con']] .= '">'.$mensajes[$i]['mensaje'].'</p>';
	}
	echo json_encode($contenido);
}
if(isset($_POST['actualizarChat']))
{
	$arreglo=$_POST['actualizarChat'];
	include_once('./transaccion.php');
	$transaccion=new transaccion();
	$arg=array ();
	$mensajes=$transaccion->listarMensajesChat($arg);
	$contenido='';
	for($i=0;$i<count($mensajes);$i++)
	{
		$contenido[$mensajes[$i]['id_con']] += '<p id="msg'.$mensajes[$i]['id_men'].'" title="mensaje enviado a las '.$mensajes[$i]['fecha_men'].'" class="';
		if($mensajes[$i]['emisor']!= $_SESSION['rut'])
		{
			$contenido[$mensajes[$i]['id_con']] += 'a';
		}
		else
		{
			$contenido[$mensajes[$i]['id_con']] += 'b';
		}
		$contenido[$mensajes[$i]['id_con']] += '">'.$mensajes[$i]['mensaje'].'</p>';
	}
}
if(isset($_POST['actualizarContratos']))
{
	if(isset($_SESSION['rol']))
	{
		if($_SESSION['rol']!=0)
		{
			$texto ="";
			require_once "./webConfig.php";
			require_once('./function.php');
			$arg=array (array('id_con'=>16, 'id_men'=>0));
			$contratos=listarContactosSinDetalle($arg);
			$texto += '<div>Comunicate con empresas</div>';
			if(count($contratos)==0)
			{
				$texto += "<div>No tienes contratos activos en este momento.</div>";
			}
			else
			{
				for($i=0;$i<count($contratos);$i++)
				{
					$nombre=$contratos[$i]['nom_ent'];
					$texto += "<div id='listChat".$contratos[$i]['id_con']."' onclick='abrirChat(".$contratos[$i]['id_con'].", \" $nombre \")'>".$contratos[$i]['nom_ent'].'</div>';
				}
			}
			$texto +='<a  class="celular" onclick="verMenu()">Volver</a></div>';
			if($_POST['actualizarContratos'] != $texto)
			{
				echo $texto;
			}
		}
	}
}
if(isset($_POST['actualizarMensajes']))
{
	if(isset($_SESSION['rol']))
	{
		if($_SESSION['rol']!=0)
		{
			//print_r($_POST['actualizarMensajes']);
			include_once('./transaccion.php');
			$transaccion=new transaccion();
			//falta leer las [idchat][idultimomensaje] para devolver los que faltan
			$msg = $_POST['actualizarMensajes'];
			$devolver = array();
			for($a=0;$a<sizeof($msg);$a++)
			{
				$arg=array('id_con'=>$msg[$a][0], 'id_men'=>$msg[$a][1]);
				$mensajes=$transaccion->listarMensajesChat($arg);
				if(count($mensajes)>0)
				{
					$contenido=array();
					for($i=0;$i<count($mensajes);$i++)
					{
						
						if(!isset($contenido[$mensajes[$i]['id_con']]))
						{
							$contenido[$mensajes[$i]['id_con']]='';
						}
						$contenido[$mensajes[$i]['id_con']] .= '<p id="msg'.$mensajes[$i]['id_men'].'" title="mensaje enviado a las '.$mensajes[$i]['fecha_men'].'" class="';
						if($mensajes[$i]['emisor'] != $_SESSION['rut'])
						{
							$contenido[$mensajes[$i]['id_con']] .= 'a';
						}
						else
						{
							$contenido[$mensajes[$i]['id_con']] .= 'b';
						}
						$contenido[$mensajes[$i]['id_con']] .= '">'.$mensajes[$i]['mensaje'].'</p>';
					}
					//print_r($contenido);
					$devolver[sizeof($devolver)]=[$msg[$a][0],$contenido[$msg[$a][0]]];
				}
			}
			echo json_encode($devolver);
		}
	}
}
