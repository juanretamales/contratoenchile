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
			<section id="contenido">
			
	<form onsubmit="return agregarTipousuario()" method="post" class="formulario">
	<div id="error">
	</div>
		<h1 class="titulo2">Registro de Tipo Usuario</h1>
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
			<label>Nombre:</label>
			<input required x-moz-errormessage="Debe ingresar el nombre" id="txtNombre" name="txtNombre" type="text" required maxlength="255">
			<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
		</div>
		<div>

			<label>Seleccione un Tipo de usuario si desea copiar permisos</label>

					<select maxlength="255"  id="txtPermisos" name="txtPermisos">

					<option value="" selected></option>

					<?php

							require_once('script/function.php');

							$arg=array ('nada'=>0);

							$tu=listarTipousuario($arg);

							for($i=0;$i<count($tu);$i++)

							{

								?>

					<option value="<?php echo $tu [$i] ['id_tu']; ?>"><?php echo $tu [$i] ['nom_tu']; ?></option>

				<?php } ?>

					</select>

			<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPermisos">

		</div>
		<div>
			<input type="submit" value="Registrar">
		</div>
		<a href="<?php 
					echo WEB_BASE.$back;
				?>">Cancelar</a>
	</form>
</section>
		</section>
		<?php cc_footer(); ?>
</body>
</html>