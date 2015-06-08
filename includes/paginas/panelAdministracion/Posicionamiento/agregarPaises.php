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
<section id="contenido" style="margin: 10px 0px 0px 10px;">
	<form class="formulario" onsubmit="return agregarPais()" method="post">
		<div id="error"></div>
				<h1 class="titulo2">Añadir nuevo pais</h1>
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
					<label>Nombre del Pais</label>
					<input required x-moz-errormessage="Debe ingresar el nombre del pais" type="text" required maxlength="255" id="txtNombre" name="txtNombre">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<input type="submit" name="btnRegistrarPais" value="Añadir">
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