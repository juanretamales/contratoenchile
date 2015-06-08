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
<section id="contenido">
	<form class="formulario" onsubmit="return agregarUsuario()" method="post"><div id="error"></div>
				<h1 class="titulo2">Añadir nuevo usuario</h1>
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
					<label>Rut:</label>
					<input required  x-moz-errormessage="Debe ingresar el rut"  maxlength="255" id="txtRut" name="txtRut"  type="text">
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
					<label>Email:</label>
					<input required x-moz-errormessage="Debe ingresar el email" id="txtEmail"  maxlength="255" name="txtEmail" type="mail"><br>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEmail">
				</div>
				<div>
					<label>fecha de nacimiento:</label>
					<input required placeholder="dd/mm/aaaa"  x-moz-errormessage="Debe ingresar el/los nombres" id="txtFecha" name="txtFecha"  maxlength="10"  type="text">
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
					<select  onchange="listarRegiones()" x-moz-errormessage="Debe seleccionar un pais" maxlength="255"  id="txtPais" name="txtPais">
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
					<select  onchange="listarProvincias()"  maxlength="255"  x-moz-errormessage="Debe seleccionar una region" id="txtRegion" name="txtRegion">
						<option value="" disabled selected></option>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgRegion">
				</div>
				<div>
					<label>Seleccione la provincia</label>
					<select  onchange="listarComunas()"  maxlength="255"  x-moz-errormessage="Debe seleccionar un pais" id="txtProvincia" name="txtProvincia">
						<option value=""  selected></option>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgProvincia">
				</div>
				<div>
					<label>Seleccione la comuna</label>
					<select required x-moz-errormessage="Debe seleccionar una comuna" maxlength="255" id="txtComuna" name="txtComuna">
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
					<label>Tipo de usuario</label>
							<select required x-moz-errormessage="Debe seleccionar un tipo" maxlength="255"  id="txtTipo" name="txtTipo">
							<option value="" disabled selected></option>
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
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTipo">
				</div>
				<div>
					<label>Estado del usuario</label>
							<select required x-moz-errormessage="Debe seleccionar un estado" maxlength="255"  id="txtEstado" name="txtEstado">
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
				<!--<div>
					<label style="width: 400px;" for="txtCondicion">Estoy de acuerdo con los <a>Términos y Condiciones</a></label>
					</br><input id="txtCondicion" type="checkbox"  x-moz-errormessage="Debe aceptar los terminos y condiciones" />
				</div>-->
				<div>
					<input type="submit" value="Registrar">
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