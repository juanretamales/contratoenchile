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
	<form class="formulario" onsubmit="return modificarMultimedia()" method="post">		<div id="error"></div>
				<h1 class="titulo2">Modificar Multimedia</h1>
				<?php
					require_once "script/webConfig.php";
					$back="administracion/multimedia";
					if(isset($_POST['txtCode']))
					{
						echo '<input id="txtCode" name="txtCode" type="hidden" required value="'.$_POST['txtCode'].'">';
					}
					else
					{
						echo '<script language="javascript">window.location="'.WEB_BASE.$back.'"</script>';
					}
					require_once('script/function.php');
					$arg=array ('id_med'=>$_POST['txtCode']);
					$media=listarMedia($arg);
				?>
				<div>
					<label>Nombre</label>
					<input value="<?php echo $media[0]['nom_med']; ?>" required x-moz-errormessage="Debe ingresar el nombre" type="text" id="txtNombre" name="txtNombre" required maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Servicio</label>
					<select required x-moz-errormessage="Debe seleccionar un servicio" id="txtServicio" name="txtServicio" required>
						<?php
								require_once('script/function.php');
								$arg=array ('id_ent'=>$_SESSION['empresa']);
								$servicios=listarServiciosSinDetalle($arg);
								for($i=0;$i<count($servicios);$i++)
								{
									?>
						<option <?php if($media[0]['id_serv']==$servicios [$i] ['id_serv']) { echo "selected"; } ?> value="<?php echo $servicios [$i] ['id_serv']; ?>"><?php echo $servicios [$i] ['nom_serv']; ?></option>
						<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgServicio">
				</div>
				<div>
					<label>Tipo</label>
					<select onchange="cambiarMedia()" required x-moz-errormessage="Debe seleccionar un Tipo" id="txtTipoMultimedia" name="txtTipoMultimedia" required>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$tm=listarTipomedia($arg);
							for($i=0;$i<count($tm);$i++)
							{
								?>
					<option <?php if($media[0]['id_tm']==$tm [$i] ['id_tm']) { echo "selected"; } ?> value="<?php echo $tm [$i] ['id_tm']; ?>"><?php echo $tm [$i] ['nom_tm']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTipoMultimedia">
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
				<input value="<?php echo $med[0]['url_med']; ?>" required type="hidden" id="txtUrl" name="txtUrl" maxlength="255">
				<script>
				cambiarMedia();
				<?php
					$url=explode(";", $med[0]['url_med']);
				?>
				$('#txtUrl').val('<?php echo $med[0]['url_med']; ?>');
				$('#txtUrl1').val('<?php echo $url [0]; ?>');
				$('#txtUrl2').val('<?php echo $url [1]; ?>');
				$('#txtUrl3').val('<?php echo $url [2]; ?>');
				</script>
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