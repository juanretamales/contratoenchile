<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
</head>
<body>
<?php cc_header(); ?>
		<section>
			<?php cc_menu($pagina); ?>
<?php
$pagina="";
if(isset($_REQUEST['pagina']))
{
	$pagina=$_REQUEST['pagina'];
}
?>
	<section id="contenido">
	<form class="formulario" onsubmit="return agregarUsuario()" method="post">
		<div id="error"></div>
				<h1 class="titulo2">Añadir nuevo usuario</h1>
					<?php
						require_once "script/webConfig.php";
						$page=explode("/",$pagina);
						if(isset($_POST['txtCode']))
						{
							echo '<input id="txtCode" name="txtCode" type="hidden" required value="'.$_POST['txtCode'].'">';
						}
						else
						{
							echo '<script language="javascript">window.location="'.WEB_BASE.'"</script>';
						}
					?>
				<div>
					<label>Rut:</label>
					<input required x-moz-errormessage="Debe ingresar el rut"  maxlength="255" id="txtRut" name="txtRut"  type="text">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgRut">
				</div>
				<div>
					<label>Nombre:</label>
					<input required x-moz-errormessage="Debe ingresar el/los nombres" id="txtNombre" name="txtNombre"  maxlength="255"  type="text">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Apellido:</label>
					<input required x-moz-errormessage="Debe ingresar el/los apellidos" id="txtApellido"  maxlength="255" name="txtApellido" type="text"><br>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgApellido">
				</div>
				<div>
					<label>fecha de nacimiento:</label>
					<input placeholder="dd/mm/aaaa" required x-moz-errormessage="Debe ingresar el/los nombres" id="txtFecha" name="txtFecha"  maxlength="10"  type="text">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgFecha">
					<br>
				</div>
				<div>
					<label>Telefono:</label>
					<input required x-moz-errormessage="Debe ingresar un telefono de contacto" maxlength="255" id="txtTelefono" name="txtTelefono" type="phone">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTelefono">
				</div>
				<div>
					<label>Seleccione el pais</label>
					<select required onchange="listarRegiones()" x-moz-errormessage="Debe seleccionar un pais" maxlength="255"  id="txtPais" name="txtPais">
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$paises=listarPais($arg);
							for($i=0;$i<count($paises);$i++)
							{
								?>
					<option value="<?php echo $paises [$i] ['id_pais']; ?>"><?php echo $paises [$i] ['nom_pais']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPais">
				</div>
				<div>
					<label>Seleccione la region</label>
					<select required onchange="listarProvincias()"  maxlength="255"  x-moz-errormessage="Debe seleccionar una region" id="txtRegion" name="txtRegion">
						<option value="" disabled selected></option>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgRegion">
				</div>
				<div>
					<label>Seleccione la provincia</label>
					<select required onchange="listarComunas()"  maxlength="255"  x-moz-errormessage="Debe seleccionar un pais" id="txtProvincia" name="txtProvincia">
						<option value=""  selected></option>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgProvincia">
				</div>
				<div>
					<label>Seleccione la comuna</label>
					<select required x-moz-errormessage="Debe seleccionar maxlength="255"  un pais" id="txtComuna" name="txtComuna">
						<option value="" disabled selected></option>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgComuna">
				</div>
				<div>
					<label>Direccion</label>
					<input required x-moz-errormessage="Debe ingresar su direccion"  maxlength="255" id="txtDireccion" name="txtDireccion" type="text">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgDireccion">
				</div>
				<div>
					<label>Contraseña:</label>
					<input required x-moz-errormessage="Ingrese una contraseña" type="password" maxlength="255"  id="txtPassword" name="txtPassword">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPassword">
				</div>
				<div>
					<label>RE-Contraseña:</label>
					<input required x-moz-errormessage="Ingrese nuevamente la contraseña" type="password" maxlength="255"  id="txtRepassword" name="txtRepassword">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgRepassword">
				</div>
				<div>
					<img id="Captcha" title="Captcha" src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" />
					<input required x-moz-errormessage="Ingrese el texto de la imagen." type="text" size="16" maxlength="255"  id="txtCaptcha" name="txtCaptcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." />
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgCaptcha">
				</div>
				<div>
					<label style="width: 400px;" for="txtCondicion">Estoy de acuerdo con los <a  href="<?php echo WEB_BASE;?>terminos">Términos y Condiciones</a></label>
					</br><input id="txtCondicion" type="checkbox" required x-moz-errormessage="Debe aceptar los terminos y condiciones" />
				</div>
				<div>
					<input type="submit" value="Registrar">
				</div>
				<a href="
				<?php 
					echo WEB_BASE;
				?>
				">Cancelar</a>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>