<html lang="es" dir="LTR" >
<head>
	<?php cc_head();
		require_once "script/webConfig.php";
		$arg=array ('rut'=>$_SESSION['rut']);
		$empresas=listarEntidadPorPersona($arg);
		if(count($empesas)>=MAX_EMPRESAS)
		{
			echo '<script language="javascript">window.location="'.WEB_BASE.'"</script>';
		}
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

			
	<form onsubmit="return agregarEmpresa()" class="formulario">		<div id="error"></div>
		<h1 class="titulo2">Registro de Empresas</h1>
		<div>
			<label>Rut:</label>
			<input required x-moz-errormessage="Debe ingresar el rut sin puntos ni digito verificador"  maxlength="255" id="txtRut" name="txtRut" type="text" size="15">
			<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgRut">
		</div>
		<div>
			<label>Nombre:</label>
			<input required x-moz-errormessage="Debe ingresar el/los nombres" id="txtNombre" maxlength="255"  name="txtNombre" type="text">
			<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
		</div>
		<div>
			<label>Descripcion:</label>
			<input required x-moz-errormessage="Debe ingresar una descripcion de la empresa"  maxlength="255" id="txtDescripcion" name="txtDescripcion" type="text"><br>
			<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgDescripcion">
		</div>
		<div>
			<label>Telefono:</label>
			<input required x-moz-errormessage="Debe ingresar un telefono de contacto"  maxlength="255" id="txtTelefono" name="txtTelefono" type="phone">
			<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTelefono">
		</div>
		<div>
			<label>Email:</label>
			<input required x-moz-errormessage="Debe ingresar un telefono de contacto"  maxlength="255" id="txtEmail" name="txtEmail" type="email">
			<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEmail">
		</div>
		<div>
			<label>Subscripcion hasta:</label>
			<input placeholder="dd/mm/aaaa" value="<?php echo dateDecode(date( "Y-m-j" , time())); ?>" required x-moz-errormessage="Debe ingresar el/los nombres" id="txtFecha" name="txtFecha"  maxlength="10"  type="text">
			<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgFecha">
			<br>
		</div>
		<div>
			<label>Estado</label>
			<select required x-moz-errormessage="Debe seleccionar una empresa" id="txtEstado" name="txtEstado">
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
			<input type="submit" value="Registrar">
		</div>
	</form>
</section>

	<?php cc_footer(); ?>
</body>
</html>
