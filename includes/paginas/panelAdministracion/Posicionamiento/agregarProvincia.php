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
	<form class="formulario" onsubmit="return agregarProvincia()"   method="post">
		<div id="error"></div>
				<h1 class="titulo2">Añadir nueva provincia</h1>
				<?php
						require_once "script/webConfig.php";
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
					<label>Nombre de la provincia</label>
					<input required x-moz-errormessage="Debe ingresar el nombre de la region" type="text" id="txtNombre" name="txtNombre" maxlength="255" >
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Seleccione un pais</label>
					<select required x-moz-errormessage="Debe seleccionar un pais" id="txtPais" name="txtPais" onchange="listarRegiones()">
					<option value="0" disabled selected></option>
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
					<label>Seleccione una region</label>
					<select required x-moz-errormessage="Debe seleccionar una region" id="txtRegion" name="txtRegion">
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgRegion">
				</div>
				<div>
					<input type="submit" name="btnRegistrarRegion" value="Añadir Provincia">
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
