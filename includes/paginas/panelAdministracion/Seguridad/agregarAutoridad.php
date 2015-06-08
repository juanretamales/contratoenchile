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
	<form class="formulario"  onsubmit="return agregarAutoridad()" method="post">		<div id="error"></div>
				<h1 class="titulo2">Añadir nueva Autoridad</h1>
				<div>
					<label>Seleccione un usuario</label>
					<select required x-moz-errormessage="Debe seleccionar un tipo de usuario" name="txtPersona" id="txtPersona" required>
					<option value="" disabled selected></option>
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
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$tu=listarPersona($arg);
							for($i=0;$i<count($tu);$i++)
							{
								?>
					<option value="<?php echo $tu [$i] ['rut']; ?>"><?php echo $tu [$i] ['nombre']." ".$tu [$i] ['apellido']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPersona">
				</div>
				<div>
					<label>Seleccione una empresa</label>
					<select required x-moz-errormessage="Debe seleccionar una pagina" id="txtEmpresa" name="txtEmpresa" required>
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$pag=listarEntidad($arg);
							for($i=0;$i<count($pag);$i++)
							{
								?>
					<option value="<?php echo $pag [$i] ['id_ent']; ?>"><?php echo $pag [$i] ['nom_ent']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEmpresa">
				</div>
				<div>
					<input type="submit" value="Añadir">
				</div>
				<a href="<?php 
					echo WEB_BASE.$back;
				?>">Cancelar</a>
	</form>
</section>

	<?php cc_footer(); ?>
</body>
</html>