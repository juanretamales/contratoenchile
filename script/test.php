<?php
if(isset($_POST['calificarContrato']))
		{
			$variables=serializeToArray($_POST['calificarContrato']);
			echo "<br><br>varible=";
			print_r($variables);
			
			if(
				isset($variables ['txtCode'])
			)
			{
				include_once('./transaccion.php');
				$transaccion=new transaccion();
				$preguntasForm=array_keys($variables);
				echo "<br><br>preguntasForm=";
				print_r($preguntasForm);
				$arg=array(
					'id_con'=>$variables ['txtCode'],
					'rut'=>$_SESSION['rut']
				);
				echo "<br><br>arg="; 
				print_r($arg);
				$servcon=$transaccion->listarServcon($arg);
				echo "<br><br>servcon=";
				print_r($servcon);
				$calificacion=array();
				if(count($servcon)>0)
				{
					
					/*for($j=0;count($preguntasForm)>0;$j++)
					{
						for($i=0;$i<count($servcon);$i++)
						{
							$calificacion=array(
								'id_con'=>$variables ['txtCode'],
								'id_serv'=>$servcon [$i] ['id_serv'],
								'id_tc'=>$servcon [$i] [str_replace('txtPregunta','',$preguntasForm [$j])],
								'id_ec'=>$servcon [$i] [$variables [$preguntasForm [$j]]]
							);
							//array_push($calificacion, $arg);
							print_r($arg);
							echo "</br>";
							//$resultado=$transaccion->insertarCalificacionserv($arg);
						}
					}
					//$resultado=$transaccion->insertarCalificacionservMultiple($calificacion);
					/*if($resultado==true)
					{
						$arg = array (
							"id_est" => 9,
							"clause" => "id_con='".$variables ['txtCode']."' and id_est='7' and rut='".$_SESSION['rut']."'",
							"affected" => md5('nada')
						);
						$resultado=$transaccion->modificarContacto($arg);
						switch($resultado)
						{
							case 0:
								echo "Error al modificar contrato";
								break;
							case 1:
								echo "Exito";
								break;
							default:
								echo "Ocurrio un error al modificar contrato";
								break;
						}
						break;
					}
					else
					{
						echo "Ocurrio un error, recargue la pagina e intente nuevamente";
					}*/
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
			//break;
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
?>