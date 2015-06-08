<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
	<script>
		function simularPagomaster()
{
	var mensaje="";
	if(document.getElementById( 'merchant_transaction_id'))
	{
		if($('merchant_transaction_id').val().length>0 && $('merchant_transaction_id').val().length<255 && document.getElementById( 'merchant_transaction_id').value.indexOf("_-_")<0)
		{
			if ( document.getElementById( 'merchant_transaction_id'))
			{
				document.getElementById('imgmerchant_transaction_id').src = urlbase+"imagenes/UI/correcto.png";
			}
		}
		else
		{
			document.getElementById('imgmerchant_transaction_id').src = urlbase+"imagenes/UI/incorrecto.png";
			document.getElementById('merchant_transaction_id').focus();
			mensaje="codigo no valido";
		}
	}
	if(document.getElementById( 'amount'))
	{
		if($('amount').val().length>0 && $('amount').val().length<255 && document.getElementById( 'amount').value.indexOf("_-_")<0)
		{
			if ( document.getElementById( 'amount'))
			{
				document.getElementById('imgamount').src = urlbase+"imagenes/UI/correcto.png";
			}
		}
		else
		{
			document.getElementById('imgamount').src = urlbase+"imagenes/UI/incorrecto.png";
			document.getElementById('amount').focus();
			mensaje="codigo no valido";
		}
	}
	if(mensaje=="")
	{
		return true;
	}
	else
	{
		alert("Revise el formulario, "+mensaje);
	}
	return false;
}
	</script>
</head>
<body>
	<?php cc_header(); ?>
	
	<section>
		<?php 
			$pagina="";
if(isset($_REQUEST['pagina']))
{
	$pagina=$_REQUEST['pagina'];
}
			cc_menu($pagina); ?>
	</section>
	<section id="contenido" >
	<form class="formulario" action="<?php echo WEB_BASE; ?>/script/recibirPagomaster.php" onsubmit="return simularPagomaster()" method="post">		<div id="error"></div>
				<h1 class="titulo2">Simular Pago</h1>
				<?php
					require_once "script/webConfig.php";
					$page=explode("/",$pagina);
					$back="";
					for($i=0;$i<(count($page)-1);$i++)
					{
						if($i!=0)
						{
							$back=$back."/".$page[$i];
						}
						else
						{
							$back=$back.$page[$i];
						}
					}
				?>
				<div>
					<label>ingrese codigo</label>
					<input required x-moz-errormessage="Debe ingresar el nombre del servicio" type="text" id="merchant_transaction_id" name="merchant_transaction_id" required maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgmerchant_transaction_id">
				</div>
				<div>
					<label>Monto a pagar</label>
					<input required x-moz-errormessage="Debe ingresar el nombre del servicio" type="text" id="amount" name="amount" required maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgamount">
				</div>
				<input type="hidden" id="merchant_email" name="merchant_email" value="jua.retamales@hotmail.cl">
				<input type="hidden" id="status" name="status" value="1">
					
				<div>
					<input type="submit" value="Simular">
				</div>
				<a href="
				<?php 
					echo WEB_BASE.$back;
				?>
				">Cancelar</a>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>