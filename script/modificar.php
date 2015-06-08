<?php
error_reporting(E_ERROR);//solo mostrara errores fatales
if(!isset($_SESSION)){
	session_start();
}
switch($_SESSION['rol'])
{
	case 0:
		if(isset($_POST['modificarContrasena']))
		{
			$variables=serializeToArray($_POST['modificarContrasena']);
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
								echo "Error con la contraseña antigua";
								break;
							case -1:
								echo "Ocurrio un error, recargue la pagina e intente nuevamente";
								break;
							default:
								echo "Exito";
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
			break;
		}
		echo "No se encontro el metodo solicitado, recargue la pagina e intenste nuevamente";
		break;
		
	case 1:
		
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
								echo "Error con la contraseña antigua";
								break;
							case -1:
								echo "Ocurrio un error, recargue la pagina e intente nuevamente";
								break;
							default:
								echo "Exito";
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
			break;
		}
		
		if(isset($_POST['modificarMultimedia']))
		{
			$variables=serializeToArray($_POST['modificarMultimedia']);
			if(
				isset($variables ['txtCode']) && 
				isset($variables ['txtNombre']) && 
				isset($variables ['txtServicio']) && 
				isset($variables ['txtTipoMultimedia']) && 
				isset($variables ['txtUrl'])
			) 
			{
				$arg= array ("id_serv"=>$variables ['txtServicio'], "id_ent"=>$_SESSION['empresa']);
				include_once('./transaccion.php');
				$transaccion=new transaccion;
				$resultado=$transaccion->listarServicio($arg);
				if(count($resultado)>0)
				{
					$arg = array (
						"nom_med" => $variables ['txtNombre'],
						"id_serv" => $variables ['txtServicio'],
						"id_tm" => $variables ['txtTipoMultimedia'],
						"url_med" => $variables ['txtUrl'],
						"condition" => "id_med",
						"data" => $variables ['txtCode'],
						"affected" => md5('nada')
					);
					
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
					echo "No tiene permisos sobre el servicio";
				}
			}	
			else
			{
				echo "Error al recibir los datos";
			}
			break;
		}
		if(isset($_POST['modificarDocumento']))
		{
			$variables=serializeToArray($_POST['modificarDocumento']);
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
			break;
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
								echo "No ocurrio ningun cambio.";
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
			break;
		}
		if(isset($_POST['finalizarContacto']))
		{
			include_once('./transaccion.php');
			include_once('./function.php');
			$arg = array (
					"id_ent" => $_SESSION['empresa'],
					"id_con" => $_POST['finalizarContacto']
			);
			$contacto=listarContactosSinDetalle($arg);
			if(count($contacto)>0)
			{
				$transaccion=new transaccion;
				$arg = array (
					"id_est" => 9,
					"clause" => "id_con='".$_POST['finalizarContacto']."' and id_est='7'",
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
			else
			{
				echo "No se encontro el contrato asociado a esta empresa";
			}
			break;
		}
		
	default:
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
			break;
		}
		if(isset($_POST['finalizarContacto']))
		{
			$variables=$_POST['finalizarContacto'];
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
			break;
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
								echo "No ocurrio ningun cambio.";
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
			break;
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
					"url_doc" => $variables ['txtEmpresa'],
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
				echo "Error al recibir los datos";
			}
			break;
		}
		if(isset($_POST['modificarMultimedia']))
		{
			$variables=serializeToArray($_POST['modificarMultimedia']);
			if(
				isset($variables ['txtCode']) && 
				isset($variables ['txtNombre']) && 
				isset($variables ['txtServicio']) && 
				isset($variables ['txtTipoMultimedia']) && 
				isset($variables ['txtUrl'])
			) 
			{
				$arg = array (
					"nom_med" => $variables ['txtNombre'],
					"id_serv" => $variables ['txtServicio'],
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
				echo "Error al recibir los datos";
			}
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
							echo "No ocurrio ningun cambio.";
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
					break;
				}
			}	
			else
			{
				echo "Error al recibir los datos";
			}
			break;
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
			break;
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
				echo "Error al recibir los datos";
			}
			break;
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
			break;
		}
		//falta terminar
		if(isset($_POST['modificarContrasena2']))
		{
			$variables=serializeToArray($_POST['modificarUsuario']);
			if(
				isset($variables ['txtCode']) && 
				isset($variables ['txtPassword']) && 
				isset($variables ['txtRePassword']) && 
				isset($variables ['txtCaptcha'])
			)
			{
				$arg=array('rut'=>$variables ['txtCode']);
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
							echo "No ocurrio ningun cambio.";
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
			break;
		}
		echo "el metodo no existe";
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
//<script language="javascript">window.location="http://www.contratoenchile.cl"</script>
?>