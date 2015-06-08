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
		<form class="formulario" onsubmit="return agregarComuna()"   method="post">
		<div id="error"></div>
			<h1 class="titulo2">A�adir nueva Comuna</h1>
			<div>
				<label>Nombre</label>
				<input required x-moz-errormessage="Debe ingresar el nombre de la comuna" type="text" id="txtNombre" name="txtNombre" maxlength="255" >
				<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
			</div>
			<div>
				<label>Seleccione el pais</label>
				<select required onchange="listarRegiones()" x-moz-errormessage="Debe seleccionar un pais" id="txtPais" name="txtPais">
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
				<select required onchange="listarProvincias()"  x-moz-errormessage="Debe seleccionar una region" id="txtRegion" name="txtRegion">
					<option value="" disabled selected></option>
				</select>
				<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPais">
			</div>
			<div>
				<label>Seleccione la provincia</label>
				<select required onchange="listarComunas()"  x-moz-errormessage="Debe seleccionar un pais" id="txtProvincia" name="txtProvincia">
					<option value=""  selected></option>
				</select>
				<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgProvincia">
			</div>
			<div>
				<input type="submit" name="btnRegistrarRegion" value="A�adir">
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
