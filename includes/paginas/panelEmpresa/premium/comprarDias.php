<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
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
	<section id="contenido">
		<?php
			require_once('script/function.php');
			$arg=array ('id_ent'=>$_SESSION['empresa']);
			$empresa=listarEntidad($arg);
			$datetime1 = strtotime("now");
			$datetime2 = $promedio [0] ['subscripcion'];
			if($datetime1<=$datetime2)
			{
		?>
			<h1 class="titulo">Subscripcion</h1>
			<p>Te quedan:
			<?php
				//echo date_diff($datetime1, $datetime2);
				echo abs(floor(($datetime2-$datetime1) / (60 * 60 * 24)));
			?> dias.</p>
		<?php
			}
			$arg=array ('rut'=>$_SESSION['rut']);
			$persona=listarPersona($arg);
		?>
		<form class="formulario" action="https://www.pagomaster.com/cl/cuenta/?cmd=checkout2" onsubmit="return agregarBoletas()" method="post"> 
			<input type=hidden name="merchantAccount" value="jua.retamales@hotmail.cl">
			<input type="hidden" name="amount" id="amount"  value="10000">
			<input type="hidden" name="currency" value="CLP">
			<input type="hidden" name="item_id" id="item_id" value="Comprar 30 dias de subscripcion">
			<input type="hidden" name="setupFee" id="setupFee" value="">
			<input type="hidden" name="return_url" value="http://www.contratoenchile.cl/">
			<input type="hidden" name="cancel_url" value="http://www.contratoenchile.cl/administracion/subscriptores/comprar">
			<input type="hidden" name="stopNumber" value="">
			<input type="hidden" name="callback_url" value="<?php echo WEB_BASE;?>script/recibirPagomaster.php">
			<input type="hidden" name="stopRecurring" value="">
			<input type="hidden" name="merchant_transaction_id" id="merchant_transaction_id" value="">
			<input type="hidden" name="durationType" value="">
			<input type="hidden" name="duration" value="">
			<input type=hidden name="merchant_logo" value="http://www.contratoenchile.cl/imagenes/minilogo.png">
			<input type="hidden" name="addresscheckoutstep" value="1">
			
			<input type="hidden" name="namesbuyer" value="<?php echo $persona [0] ['nombre'];?>">
			<input type="hidden" name="lastnamesbuyer" value="<?php echo $persona [0] ['apellido'];?>">
			<input type="hidden" name="emailbuyer" value="<?php echo $persona [0] ['email_per'];?>">
			
			<input type="hidden" name="reselleraccount" value="">
			<input type="hidden" name="ccSubscription" value="">
			<input type=hidden name="pst" value="1">
			<input type=hidden name="ipk" value="1">
			Planes </br>
			<?php
				$arg=array ('id_est'=>7);
				$plan=listarPlan($arg);
				for($i=0;$i<count($plan);$i++)
				{
			?>
					<input type="radio" required name="txtPlan" 
					value="<?php echo $plan [$i] ['id_plan']; ?>" id="val<?php echo $i; ?>" 
					onchange="cambiarPlan('<?php echo $plan [$i] ['valor_plan']; ?>','<?php echo $plan [$i] ['nom_plan']; ?>')">
					<label for="val<?php echo $i; ?>"><?php echo $plan [$i] ['nom_plan']; ?></label>
			<?php	
				}
			?>
			
			<input type=image name="cartImage" src="https://www.pagomaster.com/cl/cuenta/buttons/singleitems/boton_1_comprar.png">
		</form>
	</section>

	<?php cc_footer(); ?>
</body>
</html>