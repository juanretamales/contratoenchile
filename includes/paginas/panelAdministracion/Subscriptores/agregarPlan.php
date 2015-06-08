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
	<form class="formulario" onsubmit="return agregarPlan()" method="post">		<div id="error"></div>
				<h1 class="titulo2">Añadir Plan</h1>
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
					<label>Nombre</label>
					<input required x-moz-errormessage="Debe ingresar el nombre del servicio" type="text" id="txtNombre" name="txtNombre" required maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Valor</label>
					<input required x-moz-errormessage="Debe ingresar el valor en CLP" type="number" id="txtValor" name="txtValor" required maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgValor">
				</div>
				<div>
					<label>Dias</label>
					<input required x-moz-errormessage="Debe ingresar el nombre del servicio" type="number" id="txtDias" name="txtDias" required maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgDias">
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
					<input type="submit" value="Añadir">
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