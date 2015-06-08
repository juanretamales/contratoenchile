<?php
//aca se guardan las validaciones
//error_reporting(E_ERROR);//solo mostrara errores fatales
require_once("./webConfig.php");
if(!isset($_SESSION)){
	session_start();
}
//Usuarios
switch($_SESSION['rol'])
{
	case 0:
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
			break;
		}
		echo "No se encontro el metodo solicitado, recargue la pagina e intente nuevamente";
		break;
		
	case 1:
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
			break;
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
								break;
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
								break;
							default:
								echo "Exito";
								break;
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
			break;
		}
		if(isset($_POST['agregarEmpresa']))
		{
			$variables=serializeToArray($_POST['agregarEmpresa']);
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
			break;
		}
		
		if(isset($_POST['agregarServicio']))
		{
			$variables=serializeToArray($_POST['agregarServicio']);
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
			break;
		}
		if(isset($_POST['agregarMultimedia']))
		{
			$variables=serializeToArray($_POST['agregarMultimedia']);
			if(
				isset($variables ['txtServicio']) &&
				isset($variables ['txtNombre']) &&
				isset($variables ['txtTipoMultimedia']) &&
				isset($variables ['txtUrl'])
			)
			{
				include_once('./transaccion.php');
				$transaccion=new transaccion();
				$arg=array(
					'id_serv'=>$variables ['txtServicio'], 
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
			break;
		}
		
		if(isset($_POST['agregarDocumento']))
		{
			//echo "agregar doc<br>";
			$variables=serializeToArray($_POST['agregarDocumento']);
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
				break;
			}
			
		}
		if(isset($_POST['contratar']))
		{
			include_once('./transaccion.php');
			$transaccion=new transaccion();
			//print_r($_POST['contratar']);
			//$servcon=array();
			//me envia un arreglo del 0 al N con las id de los servicios
			$arreglo=$_POST['contratar'];
			//listo las variables necesarias
			$empresas=array();
			$servicios=array();
			$contratos=array();
			//ahora recupero los servicios
			for($i=0;$i<count($arreglo);$i++)
			{
				$arg=array ('id_serv'=>$arreglo[$i]);
				$serv=$transaccion->listarServicio($arg);
				$servicios[count($servicios)]=$serv [0];
				//array_push($servicios, $serv);
				//guardo las diferentes empresas que estan siendo usadas
				if(!in_array($serv [0] ['id_ent'],$empresas))
				{
					//array_push($serv [0] ['id_ent'], $empresas);
					$empresas[count($empresas)]=$serv [0] ['id_ent'];
				}
			}
			//ahora creo un contrato por cada empresa
			for($i=0;$i<count($empresas);$i++)
			{
				$arg=array ('rut'=>$_SESSION['rut'], 'id_est'=>7);
				$contratos[$i]=$transaccion->insertarContacto($arg);
				//$contratos[$i]=$i;
			}
			//ahora agrego el servicio al contrato
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
				//$servcon[count($servcon)]=$arg;
			}
			//print_r($servcon);
			echo 'Exito';
			break;
		}
		if(isset($_POST['contratar2asd']))
		{
			$arreglo=$_POST['contratar'];
			$arg=array ('rut'=>$_SESSION['rut'], 'id_est'=>7);
			include_once('./transaccion.php');
			$transaccion=new transaccion();
			$id_con=$transaccion->insertarContacto($arg);
			for($i=0;$i<count($arreglo);$i++)
			{
				$arg=array ('id_serv'=>$arreglo[$i], 'id_con'=>$id_con);
				
				$servicio=$transaccion->insertarServcon($arg);
				if($servicio==false)
				{
					$arg=array ('id_con'=>$id_con);
					$transaccion->eliminarServcon($arg);
					$transaccion->eliminarContacto($arg);
					echo "Error al crear contrato, desaciendo cambios...";
					break;
				}
			}
			echo 'Exito';
			break;
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
			break;
		}
		echo "No se encontro el metodo solicitado, recargue la pagina e intente nuevamente";
		break;
		
	default:
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
			break;
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
			break;
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
				include_once('./function.php');
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
			break;
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
			break;
		}
		if(isset($_POST['agregarMultimedia']))
		{
			$variables=serializeToArray($_POST['agregarMultimedia']);
			if(
				isset($variables ['txtNombre']) &&
				isset($variables ['txtTipoMultimedia']) &&
				isset($variables ['txtEmpresa']) &&
				isset($variables ['txtServicio']) &&
				isset($variables ['txtUrl'])
			)
			{
				include_once('./transaccion.php');
				$transaccion=new transaccion();
				$arg=array(
					'id_serv'=>$variables ['txtServicio'], 
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
				break;
			}
			echo "No se encontro el metodo solicitado, recargue la pagina e intente nuevamente";
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
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
			break;
		}
		//agregar usuario
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
				echo "Error al recibir los parametros";
			}
			break;
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
			break;
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
			break;
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
			break;
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
			break;
		}
		echo "No se encontro el metodo solicitado, recargue la pagina e intente nuevamente";
		break;
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