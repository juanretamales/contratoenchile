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
	<div class="titulo">Añadir nueva Pagina</div>
	<form class="formulario" onsubmit="return agregarPagina()" method="post">
	<div id="error"></div>
				
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
					<label>Nombre de la Pagina</label>
					<input required x-moz-errormessage="Debe ingresar el nombre de la Pagina" type="text" id="txtNombre" name="txtNombre" required maxlength="255">
				</div>
				<div>
					<label>Tipo de la pagina</label>
					<select required x-moz-errormessage="Debe seleccionar un Tipo" id="txtTp" name="txtTp" required>
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$tipo=listarTipopagina($arg);
							for($i=0;$i<count($tipo);$i++)
							{
								?>
					<option value="<?php echo $tipo [$i] ['id_tp']; ?>"><?php echo $tipo [$i] ['nom_tp']; ?></option>
				<?php } ?>
					</select>
				</div>
				<div>
					<label>Url de la Pagina</label>
					<input required x-moz-errormessage="Debe ingresar el Url de la Pagina" type="text" id="txtUrlFicticio" name="txtUrlFicticio" maxlength="255">
				</div>
				<div>
					<label>Direccion del archivo</label>
					<input required x-moz-errormessage="Debe ingresar la direccion del archivo a cargar" type="text" id="txtUrlReal" name="txtUrlReal" maxlength="255">
				</div>
				<div>
					<label>Descripcion de la pagina</label>
					<input required x-moz-errormessage="Debe ingresar la direccion del archivo a cargar" type="text" id="txtDescripcion" name="txtDescripcion" maxlength="255">
			</div>
			<div>
				<input class="boton submit" type="submit" value="Añadir">
				<a class="boton cancel" href="<?php echo WEB_BASE.$back;?>">Cancelar</a>
			</div>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>