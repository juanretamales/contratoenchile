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
	<form class="formulario" onsubmit="return modificarPagina()" method="post">
	<div id="error"></div>
				<p>Añadir nueva Pagina</p>
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
					if(isset($_POST["txtCode"]))
					{
					 echo '<input type="hidden" id="txtCode" name="txtCode" value="'.$_POST["txtCode"].'">';
					}
					else
					{
						echo '<script language="javascript">window.location="'.WEB_BASE.'"</script>';
					}
					require_once('script/function.php');
					$arg=array ('id_pag'=>$_POST["txtCode"]);
					$pag=listarPagina($arg);
				?>
				<div>
					<label>Nombre de la Pagina</label>
					<input value="<?php echo $pag [0] ['nom_pag']; ?>" required x-moz-errormessage="Debe ingresar el nombre de la Pagina" type="text" id="txtNombre" name="txtNombre" required maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
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
					<option <?php if($pag [0] ['id_tp']==$tipo [$i] ['id_tp'])
								{
									echo " selected ";
								}?> value="<?php echo $tipo [$i] ['id_tp']; ?>"><?php echo $tipo [$i] ['nom_tp']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTp">
				</div>
				<div>
					<label>Url de la Pagina</label>
					<input value="<?php echo $pag [0] ['url_pag']; ?>" required x-moz-errormessage="Debe ingresar el Url de la Pagina" type="text" id="txtUrlFicticio" name="txtUrlFicticio" maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgUrlFicticio">
				</div>
				<div>
					<label>Direccion del archivo</label>
					<input value="<?php echo $pag [0] ['url_real']; ?>" required x-moz-errormessage="Debe ingresar la direccion del archivo a cargar" type="text" id="txtUrlReal" name="txtUrlReal" maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgUrlReal">
				</div>
				<div>
					<label>Descripcion de la pagina</label>
					<input value="<?php echo $pag [0] ['desc_pag']; ?>" required x-moz-errormessage="Debe ingresar la direccion del archivo a cargar" type="text" id="txtDescripcion" name="txtDescripcion" maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgDescripcion">
				</div>
				<div>
					<input type="submit" value="Modificar">
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