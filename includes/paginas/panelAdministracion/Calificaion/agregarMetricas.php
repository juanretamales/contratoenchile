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
<section id="contenido">
	<form class="formulario" onsubmit="return agregarMetrica()" method="post">
	<div id="error"></div>
				<h1 class="titulo2">Añadir nueva Metrica</h1>
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
					<label>Nombre</label>
					<input required x-moz-errormessage="Debe ingresar el nombre" type="text" required maxlength="255" id="txtNombre" name="txtNombre">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Valor</label>
					<!--<input required x-moz-errormessage="Debe ingresar el valor" type="text" required maxlength="255">-->
					<input type="number" min="-50" max="50" step="1" value="0"  id="txtValor" name="txtValor" required>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgValor">
				</div>
				<div>
					<input type="submit" value="Añadir">
				</div>
				<a href="<?php echo WEB_BASE.$back;?>">Cancelar</a>
	</form>
</section>
	<?php cc_footer(); ?>
</body>
</html>