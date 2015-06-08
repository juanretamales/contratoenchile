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
<section id="contenido">
	<form class="formulario" onsubmit="return modificarContacto()" method="post">	<div id="error"></div>
				<h1 class="titulo2">Modificar Contrato</h1>
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
					if(isset($_POST['txtCode']))
					{
						echo '<input id="txtCode" name="txtCode" type="hidden" required value="'.$_POST['txtCode'].'">';
					}
					else
					{
						echo '<script language="javascript">window.location="'.WEB_BASE.$back.'"</script>';
					}
					require_once('script/function.php');
					$arg=array ('id_con'=>$_POST['txtCode']);
					$contrato=listarContactosSinDetalle($arg);
				?>
				<div>
					<label>Seleccione un usuario:</label>
					<select required x-moz-errormessage="Debe seleccionar un usuario" id="txtUsuario" name="txtUsuario">
					<?php
							$persona=listarPersona($arg);
							asort($persona);
							for($i=0;$i<count($persona);$i++)
							{
								?>
					<option <?php if($contrato[0]['rut']==$persona [$i] ['rut']) { echo "selected"; } ?> value="<?php echo $persona [$i] ['rut']; ?>"><?php echo $persona [$i] ['nombre']." ".$persona [$i] ['apellido']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgUsuario">
				</div>
				<div>
					<label>Seleccione una empresa:</label>
					<select required x-moz-errormessage="Debe seleccionar un usuario" id="txtEmpresa" name="txtEmpresa">
					<?php
							$entidad=listarEntidad($arg);
							asort($entidad);
							for($i=0;$i<count($entidad);$i++)
							{
								?>
					<option <?php if($contrato[0]['id_ent']==$entidad [$i] ['id_ent']) { echo "selected"; } ?> value="<?php echo $entidad [$i] ['id_ent']; ?>"><?php echo $entidad [$i] ['nom_ent']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEmpresa">
				</div>
				<div>
					<label>Fecha:</label>
					<input value="<?php echo $contrato[0]['fecha_con']; ?>" required x-moz-errormessage="Debe ingresar el nombre del pais" type="text" required maxlength="255" id="txtFecha" name="txtFecha">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgFecha">
				</div>
				<div>
					<label>Seleccione un estado:</label>
					<select required x-moz-errormessage="Debe seleccionar un usuario" id="txtEstado" name="txtEstado">
					<?php
							$estado=listarEstado($arg);
							for($i=0;$i<count($estado);$i++)
							{
								?>
					<option <?php if($contrato[0]['id_est']==$estado [$i] ['id_est']) { echo "selected"; } ?> value="<?php echo $estado [$i] ['id_est']; ?>"><?php echo $estado [$i] ['nom_est']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEstado">
				</div>
				<?php //aqui se supone que listare los servicios de ese contrato ?>
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