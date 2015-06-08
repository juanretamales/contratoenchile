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

			
	<form method="post" class="formulario" id="empresa" onsubmit="return modificarPerfil()">
		<div id="error"></div>
	<h1 class="titulo2">Modificar Perfil</h1>
		<?php
			require_once "script/webConfig.php";
						require_once('script/function.php');
					
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
						$persona=listarPersona($arg);
						$arg=array ('nada'=>0);
						$arg=array ('rut'=>$_SESSION['rut']);
						$personas=listarPersona($arg);
						$arg=array ('id_com'=>$personas [0] ['id_com']);
						$comuna=listarComuna($arg);
						$arg=array ('id_prov'=>$comuna [0] ['id_prov']);
						$provincia=listarProvincia($arg);
						$arg=array ('id_reg'=>$provincia [0] ['id_reg']);
						$region=listarRegion($arg);
					?>
				<div>
					<label>Rut: </label>
					<input required value="<?php echo $personas [0] ['rut']; ?>" x-moz-errormessage="Debe ingresar el rut" readonly maxlength="255" id="txtRut" name="txtRut"  type="text">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgRut">
				</div>
				<div>
					<label>Nombre:</label>
					<input value="<?php echo $personas [0] ['nombre']; ?>" required x-moz-errormessage="Debe ingresar el/los nombres" id="txtNombre" name="txtNombre"  maxlength="255"  type="text">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Apellido:</label>
					<input value="<?php echo $personas [0] ['apellido']; ?>" required x-moz-errormessage="Debe ingresar el/los apellidos" id="txtApellido"  maxlength="255" name="txtApellido" type="text"><br>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgApellido">
				</div>
				<div>
					<label>Email:</label>
					<input value="<?php echo $personas [0] ['email_per']; ?>" required x-moz-errormessage="Debe ingresar el email" id="txtEmail"  maxlength="255" name="txtEmail" type="mail"><br>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgApellido">
				</div>
				<div>
					<label>fecha de nacimiento:</label>
					<input value="<?php echo dateDecode($personas [0] ['fecha_nac']); ?>" placeholder="dd/mm/aaaa" required x-moz-errormessage="Debe ingresar el/los nombres" id="txtFecha" name="txtFecha"  maxlength="10"  type="text">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgFecha">
					<br>
				</div>
				<div>
					<label>Telefono:</label>
					<input value="<?php echo $personas [0] ['tel_per']; ?>" required x-moz-errormessage="Debe ingresar un telefono de contacto" maxlength="255" id="txtTelefono" name="txtTelefono" type="phone">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTelefono">
				</div>
				<div>
					<label>Seleccione el pais</label>
					<select required onchange="listarRegiones()" x-moz-errormessage="Debe seleccionar un pais" maxlength="255"  id="txtPais" name="txtPais">
					<?php
							
							$arg=array ('nada'=>0);
							$paises=listarPais($arg);
							for($i=0;$i<count($paises);$i++)
							{
								?>
					<option <?php if($region [0] ['id_pais']==$paises [$i] ['id_pais']){ echo "selected"; } ?> value="<?php echo $paises [$i] ['id_pais']; ?>"><?php echo $paises [$i] ['nom_pais']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPais">
				</div>
				<div>
					<label>Seleccione la region</label>
					<select required onchange="listarProvincias()"  maxlength="255"  x-moz-errormessage="Debe seleccionar una region" id="txtRegion" name="txtRegion">
						<?php
							$arg=array ('id_pais'=>$region [0] ['id_pais']);
							$regiones=listarRegion($arg);
							for($i=0;$i<count($regiones);$i++)
							{
								?>
							<option <?php if($region [0] ['id_reg']==$regiones [$i] ['id_reg']){ echo "selected"; } ?> value="<?php echo $regiones [$i] ['id_reg']; ?>"><?php echo $regiones [$i] ['nom_reg']; ?></option>
						<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgRegion">
				</div>
				<div>
					<label>Seleccione la provincia</label>
					<select required onchange="listarComunas()"  maxlength="255"  x-moz-errormessage="Debe seleccionar un pais" id="txtProvincia" name="txtProvincia">
						<?php
							$arg=array ('id_reg'=>$provincia [0] ['id_reg']);
							$provincias=listarProvincia($arg);
							for($i=0;$i<count($provincias);$i++)
							{
								?>
							<option <?php if($provincia [0] ['id_prov']==$provincias [$i] ['id_prov']){ echo "selected"; } ?> value="<?php echo $provincias [$i] ['id_prov']; ?>"><?php echo $provincias [$i] ['nom_prov']; ?></option>
						<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgProvincia">
				</div>
				<div>
					<label>Seleccione la comuna</label>
					<select required x-moz-errormessage="Debe seleccionar una comuna" maxlength="255" id="txtComuna" name="txtComuna">
						<?php
							$arg=array ('id_prov'=>$provincia [0] ['id_prov']);
							$comunas=listarComuna($arg);
							for($i=0;$i<count($comunas);$i++)
							{
								?>
							<option <?php if($personas [0] ['id_com']==$comunas [$i] ['id_com']){ echo " selected "; } ?> value="<?php echo $comunas [$i] ['id_com']; ?>"><?php echo $comunas [$i] ['nom_com']; ?></option>
						<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgComuna">
				</div>
				<div>
					<label>Direccion</label>
					<input value="<?php echo $personas [0] ['direccion']; ?>" required x-moz-errormessage="Debe ingresar su direccion"  maxlength="255" id="txtDireccion" name="txtDireccion" type="text">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgDireccion">
				</div>
				<div>
					<img title="Captcha" id="Captcha" src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" />
				</div>
				<div>
					<label>Captcha:</label>
					<input required x-moz-errormessage="Ingrese el texto de la imagen." type="text" maxlength="255"  size="16" id="txtCaptcha"  name="txtCaptcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." />
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
