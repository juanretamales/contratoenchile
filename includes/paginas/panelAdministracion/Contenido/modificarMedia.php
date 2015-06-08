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
	<form class="formulario" onsubmit="return modificarMultimedia()" method="post">	<div id="error"></div>
				<h1 class="titulo2">Modificar Multimedia</h1>
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
						$arg=array ('id_med'=>$_POST["txtCode"]);
						$med=listarMedia($arg);
					?>
				<div>
					<label>Nombre </label>
					<input value="<?php echo $med[0]['nom_med']; ?>"  required x-moz-errormessage="Debe ingresar el nombre del Documento" type="text" id="txtNombre" name="txtNombre" maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Tipo multimedia</label>
					<select onchange="cambiarMedia()" required x-moz-errormessage="Debe seleccionar un Tipo" id="txtTipoMultimedia" name="txtTipoMultimedia">
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
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTipodoc">
				</div>
				<div>
					<label>Empresa</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" onchange="listarServicios()" id="txtEmpresa" name="txtEmpresa">
					<?php
							require_once('script/function.php');
							$arg=array ('id_serv'=>$med[0]['id_serv']);
							$servicio=listarServicio($arg);
							
							$arg=array ('nada'=>0);
							$ent=listarEntidad($arg);
							for($i=0;$i<count($ent);$i++)
							{
								?>
						<option <?php if($servicio[0]['id_ent']==$ent [$i] ['id_ent']) { echo " selected "; } ?>  value="<?php echo $ent [$i] ['id_ent']; ?>"><?php echo $ent [$i] ['nom_ent']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEmpresa">
				</div>
				<div>
					<label>Servicio</label>
					<select required x-moz-errormessage="Debe seleccionar un servicio" id="txtServicio" name="txtServicio">
						<?php
							require_once('script/function.php');
							$arg=array ('id_ent'=>$servicio[0]['id_ent']);
							$servicios=listarServicio($arg);
							for($i=0;$i<count($servicios);$i++)
							{
								?>
						<option  <?php if($med[0]['id_serv']==$servicios [$i] ['id_serv']) { echo " selected "; } ?> value="<?php echo $servicios [$i] ['id_serv']; ?>"><?php echo $servicios [$i] ['nom_serv']; ?></option>
					<?php } ?>
					</select>
					<img  src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgServicio">
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
				<a href="<?php echo WEB_BASE.$back;?>">Cancelar</a>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>