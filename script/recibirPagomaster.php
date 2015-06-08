<?php
	$hostname=gethostbyaddr($_SERVER['REMOTE_ADDR']);
	if($hostname == 'server1.pagomaster.net')
	{
		if(
			isset($_POST['merchant_email']) && 
			isset($_POST['merchant_transaction_id']) && 
			isset($_POST['amount']) && 
			isset($_POST['status'])
		)
		{
			if(
				$_POST['merchant_email']=='jua.retamales@hotmail.cl' &&
				$_POST['merchant_transaction_id']!="" &&
				$_POST['amount']!="" &&
				$_POST['status']!=""
			)
			{
				//primero buscamos en la base de datos
				$arg=array (
					'id_bol'=>$_POST['merchant_transaction_id'],//id_bol
					'id_est'=>7,//vigente
					'monto'=>$_POST['amount']//monto
				);
				//print_r($arg);
				//echo "<br>";
				require_once('./transaccion.php');
				$transaccion=new transaccion();
				$boletas=$transaccion->listarBoleta($arg);
				if(count($boletas)==1)
				{
					$status=0;
					if($_POST['status']==1)
					{
						$status=12;//pagado
					}
					else
					{
						$status=8;//8
					}
					$arg=array (
						'id_est'=>$status,
						"condition" => "id_bol",
						"data" => $_POST['merchant_transaction_id'],
						"affected" => md5('nada')
					);
					//print_r($arg);
					//echo "<br>";
					$resultado=$transaccion->modificarBoleta($arg);
					switch($resultado)
					{
						case 0:
							echo "No ocurrio ningun cambio.";
							break;
						case 1:
							$arg=array (
								'id_ent'=>$boletas [0] ['id_ent']
							);
							$empresa=$transaccion->listarEntidad($arg);
							$datetime1 = new DateTime("now");
							$datetime2 = new DateTime($empresa [0] ['subscripcion']);
							$arg=array (
								'id_plan'=>$boletas [0] ['id_plan']
							);
							$plan=$transaccion->listarPlan($arg);
							$nuevafecha="";
							//sumar dias del contrato partiendo de la fecha actual si no le quedan dias
							if($datetime1<=$datetime2)
							{
								$fecha = date('Y-m-j');
								$nuevafecha = strtotime ( '+'.$plan [0]['dias'].'day' , strtotime ( $fecha ) ) ;
								$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
							}
							else
							{
							//sumar a los dias que tienen si le queda subscripcion
								$fecha = date('Y-m-j');
								$nuevafecha = strtotime ( '+'.$plan [0]['dias'].'day' , strtotime ( $empresa [0] ['subscripcion'] ) ) ;
								$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
							}
							$arg=array (
								'subscripcion'=>$nuevafecha,
								"condition" => "id_ent",
								"data" => $empresa [0] ['id_ent'],
								"affected" => md5('nada')
							);
							echo "Nueva Fecha:".$nuevafecha;
							//realizar el cambio a subscripcion de la tabla entidad
							$resultado=$transaccion->modificarEntidad($arg);
							switch($resultado)
							{
								case 0:
									echo "No ocurrio ningun cambio.";
									break;
								case 1:
									echo "Exito";
									break;
								default:
									echo "Ocurrio un error al añadir los dias, recargue la pagina e intente nuevamente";
									break;
							}
							break;
						default:
							echo "Ocurrio un error al modificar boleta, recargue la pagina e intente nuevamente";
							break;
					}
				}
				else
				{
					echo "No se a encontrado la boleta correspondiente, verifique los datos";
				}				
			}
			else
			{
				echo "Los datos no son correctos";
			}
		}
		else
		{
			echo "No se recibieron todos los parametros esperados";
		}
	}
	else
	{
		if(
			isset($_POST['merchant_email']) && 
			isset($_POST['merchant_transaction_id']) && 
			isset($_POST['amount']) && 
			isset($_POST['status'])
		)
		{
			if(
				$_POST['merchant_email']=='jua.retamales@hotmail.cl' &&
				$_POST['merchant_transaction_id']!="" &&
				$_POST['amount']!="" &&
				$_POST['status']!=""
			)
			{
				//primero buscamos en la base de datos
				$arg=array (
					'id_bol'=>$_POST['merchant_transaction_id'],//id_bol
					'id_est'=>7,//vigente
					'monto'=>$_POST['amount']//monto
				);
				//print_r($arg);
				//echo "<br>";
				require_once('./transaccion.php');
				$transaccion=new transaccion();
				$boletas=$transaccion->listarBoleta($arg);
				if(count($boletas)==1)
				{
					$status=0;
					if($_POST['status']==1)
					{
						$status=12;//pagado
					}
					else
					{
						$status=8;//8
					}
					$arg=array (
						'id_est'=>$status,
						"condition" => "id_bol",
						"data" => $_POST['merchant_transaction_id'],
						"affected" => md5('nada')
					);
					//print_r($arg);
					//echo "<br>";
					$resultado=$transaccion->modificarBoleta($arg);
					switch($resultado)
					{
						case 0:
							echo "No ocurrio ningun cambio.";
							break;
						case 1:
							$arg=array (
								'id_ent'=>$boletas [0] ['id_ent']
							);
							$empresa=$transaccion->listarEntidad($arg);
							$datetime1 = new DateTime("now");
							$datetime2 = new DateTime($empresa [0] ['subscripcion']);
							$arg=array (
								'id_plan'=>$boletas [0] ['id_plan']
							);
							$plan=$transaccion->listarPlan($arg);
							$nuevafecha="";
							//sumar dias del contrato partiendo de la fecha actual si no le quedan dias
							if($datetime1<=$datetime2)
							{
								$fecha = date('Y-m-j');
								$nuevafecha = strtotime ( '+'.$plan [0]['dias'].'day' , strtotime ( $fecha ) ) ;
								$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
							}
							else
							{
							//sumar a los dias que tienen si le queda subscripcion
								$fecha = date('Y-m-j');
								$nuevafecha = strtotime ( '+'.$plan [0]['dias'].'day' , strtotime ( $empresa [0] ['subscripcion'] ) ) ;
								$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
							}
							$arg=array (
								'subscripcion'=>$nuevafecha,
								"condition" => "id_ent",
								"data" => $empresa [0] ['id_ent'],
								"affected" => md5('nada')
							);
							echo "Nueva Fecha:".$nuevafecha;
							//realizar el cambio a subscripcion de la tabla entidad
							$resultado=$transaccion->modificarEntidad($arg);
							switch($resultado)
							{
								case 0:
									echo "No ocurrio ningun cambio.";
									break;
								case 1:
									echo "Exito";
									break;
								default:
									echo "Ocurrio un error al añadir los dias, recargue la pagina e intente nuevamente";
									break;
							}
							break;
						default:
							echo "Ocurrio un error al modificar boleta, recargue la pagina e intente nuevamente";
							break;
					}
				}
				else
				{
					echo "No se a encontrado la boleta correspondiente, verifique los datos";
				}				
			}
			else
			{
				echo "Los datos no son correctos";
			}
		}
		else
		{
			echo "No se recibieron todos los parametros esperados";
		}
		echo "Tu direccion es invalida";
	}

?>