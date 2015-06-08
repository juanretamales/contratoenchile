<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
</head>
<body onload="ocultarMedia()">
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
	<form class="formulario" onsubmit="return agregarMultimedia()" method="post">	<div id="error"></div>
				<h1 class="titulo2">Añadir nuevo Multimedia</h1>
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
					<label>Nombre </label>
					<input required x-moz-errormessage="Debe ingresar el nombre del Documento" type="text" id="txtNombre" name="txtNombre" maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Tipo multimedia</label> 
					<select required x-moz-errormessage="Debe seleccionar un Tipo" onchange="cambiarMedia()" id="txtTipoMultimedia" name="txtTipoMultimedia">
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$tm=listarTipomedia($arg);
							for($i=0;$i<count($tm);$i++)
							{
								?>
					<option value="<?php echo $tm [$i] ['id_tm']; ?>"><?php echo $tm [$i] ['nom_tm']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTipodoc">
				</div>
				<div>
					<label>Empresa</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" onchange="listarServicios()" id="txtEmpresa" name="txtEmpresa">
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
					<label>Servicio</label>
					<select required x-moz-errormessage="Debe seleccionar un servicio" id="txtServicio" name="txtServicio">
						<option value="" disabled selected></option>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgServicio">
				</div>
				<div id="url1">
					<label id="lblUrl1"></label>
					<input onchange="actualizarMedia()"  type="text" id="txtUrl1" name="txtUrl1" maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png">
				</div>
				<div id="url2">
					<label id="lblUrl2"></label>
					<input onchange="actualizarMedia()"  type="text" id="txtUrl2" name="txtUrl2" maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png">
				</div>
				<div id="url3">
					<label id="lblUrl3"></label>
					<input onchange="actualizarMedia()"  type="text" id="txtUrl3" name="txtUrl3" maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png">
				</div>
				<input required type="hidden" id="txtUrl" name="txtUrl" maxlength="255">
				<script>
				ocultarMedia();
				</script>	
				<div>
					<input type="submit" value="Añadir">
				</div>
				<a href="<?php echo WEB_BASE.$back;?>">Cancelar</a> 
			
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>