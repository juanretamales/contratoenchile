  <?php
class pagomaster()
{
	define('merchantAccount', 'jua.retamales@hotmail.cl');
	define('currency', 'CLP');
	define('returnUrl', 5);
	define('cancelUrl', 5);
	define('merchantLogo', 5);
	define('callbackUrl', 5);
	define('addresscheckoutstep', 0);
	
	public function ipn($arg)
	{
		$hostname=gethostbyaddr($_SERVER['REMOTE_ADDR']);
		if($hostname == 'server1.pagomaster.net')
		{
			if($_POST['merchant_email']==merchantAccount)
			{
				//primero buscamos en la base de datos
				$arg=array (
					$id_bol=$_POST['merchant_transaction_id'],//id_bol
					$id_est=7,//vigente
					$monto=$_POST['amount']//monto
				);
				require_once('./transaccion.php');
				$transaccion=new transaccion();
				$boletas=$transaccion->listarBoleta($arg);
				$status=0;
				if($_POST['status']==1)
				{
					$status=12;//pagado
				}
				else
				{
					$status=8;//8
				}
				if(count($boletas)==1)
				{
					$arg=array (
						$id_est=>verificar($status),
						"condition" => "id_bol",
						"data" => $_POST['merchant_transaction_id'],
						"affected" => md5('nada')
					);
					
					/*$arg=array ( 
						$merchant_transaction_id=$_POST['merchant_transaction_id'],
						$merchant_email=$_POST['merchant_email'],
						$transaction_id=$_POST['transaction_id'],
						$merchant_id=$_POST['merchant_id'],
						$status=$_POST['status'],
						$amount=$_POST['amount'],
						$payment_type=$_POST['payment_type'],
						$pdate=$_POST['pdate'], 
						$fee=$_POST['fee']
					);*/
				}
				else
				{
					echo "No se a encontrado la boleta correspondiente, verifique los datos";
				}				
			}
		}
		else
		{
			exit();
		}
	}
	function verificar($status)
	{
		if($status==1)
		{
			return 12;//pagado
		}
		else
		{
			return 8;//8
		}
	}
	function comprar()
	{
		
	}
	function recibir()
	{
	
	}
}
?>