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
	<section id="contenido" >
	<form class="formulario" onsubmit="return agregarBoleta()" method="post">		<div id="error"></div>
				<h1 class="titulo2">Añadir Boleta</h1>
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
					<label>Fecha</label>
					<input required x-moz-errormessage="Debe ingresar el valor en CLP" type="date" id="txtFecha" name="txtFecha" required maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgFecha">
				</div>
				<div>
					<label>Empresa</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" id="txtEmpresa" name="txtEmpresa">
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$ent=listarEntidad($arg);
							for($i=0;$i<count($ent);$i++)
							{
								?>
						<option value="<?php echo $ent [$i] ['id_ent']; ?>"><?php echo $ent [$i] ['nom_ent']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEmpresa">
				</div>
				<div>
					<label>Estado</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" id="txtEstado" name="txtEstado">
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$est=listarEstado($arg);
							for($i=0;$i<count($est);$i++)
							{
								?>
						<option value="<?php echo $est [$i] ['id_est']; ?>"><?php echo $est [$i] ['nom_est']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEstado">
				</div>
				<div>
					<label>Monto</label>
					<input required x-moz-errormessage="Debe ingresar el valor en CLP" type="number" id="txtMonto" name="txtMonto" required maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgMonto">
				</div>
				<div>
					<label>Plan</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" id="txtPlan" name="txtPlan">
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$est=listarPlan($arg);
							for($i=0;$i<count($est);$i++)
							{
								?>
						<option value="<?php echo $est [$i] ['id_plan']; ?>"><?php echo $est [$i] ['nom_plan']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPlan">
				</div>
				<div>
					<input type="submit" value="Añadir">
				</div>
				<a href="
				<?php 
					echo WEB_BASE.$back;
				?>">Cancelar</a>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>