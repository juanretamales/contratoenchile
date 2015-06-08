<html lang="es" dir="LTR" >
<head>
	<?php 
		cc_head();
	?>
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
<section id="contenido">
	<form class="formulario" onsubmit="return modificarConfiguracion()" method="post">		<div id="error"></div>
				<h1 class="titulo2">Configuracion de la web</h1>
				<?php
					require_once "script/webConfig.php";
					require_once('script/function.php');
							$arg=array ('nada'=>0);
							$est=listarEstado($arg);
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
					<label>Estado de la pagina</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" id="txtPagina" name="txtPagina">
						<option <?php if(MANTENIMIENTO=='false') { echo "selected"; } ?> value="false"  selected>Disponible</option>
						<option <?php if(MANTENIMIENTO=='true') { echo "selected"; } ?> value="true"  >En mantenimiento</option>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPagina">
				</div>
				<div>
					<label>Url base:</label>
					<input value="<?php echo WEB_BASE; ?>" required x-moz-errormessage="Debe ingresar el nombre " type="text" required maxlength="255" id="txtUrl" name="txtUrl">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgUrl">
				</div>
				<div>
					<label>Estado para login</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" id="txtLogin" name="txtLogin">
					<?php
							for($i=0;$i<count($est);$i++)
							{
								?>
						<option <?php if(LOGIN_DEFECTO==$estados [$i] ['id_est']) { echo "selected"; } ?> value="<?php echo $est [$i] ['id_est']; ?>"><?php echo $est [$i] ['nom_est']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgLogin">
				</div>
				<div>
					<label>Estado servicio por defecto</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" id="txtServicio" name="txtServicio">
					<?php
							for($i=0;$i<count($est);$i++)
							{
								?>
						<option <?php if(SERVICIO_DEFECTO==$estados [$i] ['id_est']) { echo "selected"; } ?> value="<?php echo $est [$i] ['id_est']; ?>"><?php echo $est [$i] ['nom_est']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgServicio">
				</div>
				<div>
					<label>Estado del usuario por defecto</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" id="txtUsuario" name="txtUsuario">
					<?php
							for($i=0;$i<count($est);$i++)
							{
								?>
						<option <?php if(USUARIO_DEFECTO==$estados [$i] ['id_est']) { echo "selected"; } ?> value="<?php echo $est [$i] ['id_est']; ?>"><?php echo $est [$i] ['nom_est']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgUsuario">
				</div>
				<div>
					<label>Estado de la empresa</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" id="txtEmpresa" name="txtEmpresa">
					<?php
							for($i=0;$i<count($est);$i++)
							{
								?>
						<option <?php if(EMPRESA_DEFECTO==$estados [$i] ['id_est']) { echo "selected"; } ?> value="<?php echo $est [$i] ['id_est']; ?>"><?php echo $est [$i] ['nom_est']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEmpresa">
				</div>
				<div>
					<label>Max de empresa por usuario</label>
					<input type="number" min="0" max="100" step="1" value="<?php echo MAX_EMPRESAS; ?>"  id="txtMax" name="txtMax" required>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgMax">
				</div>
				<div>
					<label>Cant. Max de servicios</label>
					<input type="number" min="0" max="100" step="1" value="<?php echo MAX_SERVICIOS; ?>"  id="txtMin" name="txtMin" required>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgMin">
				</div>
				<div>
					<img title="Captcha" id="Captcha" src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" />
				</div>
				<div>
					<label>Ingrese el texto de la imagen:</label>
					<input required x-moz-errormessage="Debe ingresar el texto de la imagen" type="text" size="16" id="txtCaptcha" name="txtCaptcha"  maxlength="255" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." /><br>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgCaptcha">
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