<?php	$pagina="";	if(isset($_REQUEST['pagina']))	{		$pagina=$_REQUEST['pagina'];	}?><html lang="es" dir="LTR" >
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
	<section id="contenido">	<h1 class="titulo">Registro paso 3</h1>
	<form class="formulario" onsubmit="return agregarUsuario()" method="post">
				
					<?php
						require_once "script/webConfig.php";
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
				</div>
				<div>
					<label>Nombre:</label>
					<input required x-moz-errormessage="Debe ingresar el/los nombres" id="txtNombre" name="txtNombre"  maxlength="255"  type="text">
				</div>
				<div>
					<label>Apellido:</label>
					<input required x-moz-errormessage="Debe ingresar el/los apellidos" id="txtApellido"  maxlength="255" name="txtApellido" type="text"><br>
				</div>
				<div>
					<label>fecha de nacimiento:</label>
					<input placeholder="dd/mm/aaaa" required x-moz-errormessage="Debe ingresar el/los nombres" id="txtFecha" name="txtFecha"  maxlength="10"  type="text">
				</div>
				<div>
					<label>Telefono:</label>
					<input required x-moz-errormessage="Debe ingresar un telefono de contacto" maxlength="255" id="txtTelefono" name="txtTelefono" type="phone">
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
				</div>
				<div>
					<label>Seleccione la region</label>
					<select required onchange="listarProvincias()"  maxlength="255"  x-moz-errormessage="Debe seleccionar una region" id="txtRegion" name="txtRegion">
						<option value="" disabled selected></option>
					</select>
				</div>
				<div>
					<label>Seleccione la provincia</label>
					<select required onchange="listarComunas()"  maxlength="255"  x-moz-errormessage="Debe seleccionar un pais" id="txtProvincia" name="txtProvincia">
						<option value=""  selected></option>
					</select>
				</div>
				<div>
					<label>Seleccione la comuna</label>
					<select required x-moz-errormessage="Debe seleccionar maxlength="255"  un pais" id="txtComuna" name="txtComuna">
						<option value="" disabled selected></option>
					</select>
				</div>
				<div>
					<label>Direccion</label>
					<input required x-moz-errormessage="Debe ingresar su direccion"  maxlength="255" id="txtDireccion" name="txtDireccion" type="text">
				</div>
				<div>
					<label>Contraseña:</label>
					<input required x-moz-errormessage="Ingrese una contraseña" type="password" maxlength="255"  id="txtPassword" name="txtPassword">
				</div>
				<div>
					<label>RE-Contraseña:</label>
					<input required x-moz-errormessage="Ingrese nuevamente la contraseña" type="password" maxlength="255"  id="txtRepassword" name="txtRepassword">
				</div>
				<div>					<img title="Captcha" onclick="actualizarCaptcha()" id="Captcha" src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" />				</div>				<div>					<label title="Copie el texto de la imagen">Captcha:</label>					<input required x-moz-errormessage="Por favor ingrese el texto de la imagen." maxlength="255"  type="text" size="16" id="txtCaptcha" name="txtCaptcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." /><br>				</div>
				<div>
					<label style="width: 400px;" for="txtCondicion">Estoy de acuerdo con los <a  href="<?php echo WEB_BASE;?>terminos_y_condicionesterminos_y_condiciones">Terminos y Condiciones</a></label>
					<input id="txtCondicion" type="checkbox" required x-moz-errormessage="Debe aceptar los terminos y condiciones" />
				</div>
				<div>					<input class="boton submit" type="submit" value="Registrar">					<a class="boton cancel" href="<?php echo WEB_BASE;?>">Cancelar</a>				</div>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>