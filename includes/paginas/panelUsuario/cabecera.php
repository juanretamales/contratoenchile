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
			<h1 class="titulo">Servicios</h1>
			<a class="boton" style="width: 50px;" href="<?php
				echo WEB_BASE;
				$pagina="";
				if(isset($_REQUEST['pagina']))
				{
					$pagina=$_REQUEST['pagina'];
				}
				echo $pagina;
			?>/agregar">Agregar</a>
			<form id="frmModificar" method="post" name="frmModificar" action="<?php echo WEB_BASE; ?><?php echo $pagina; ?>/modificar">
				<input type="hidden" id="txtCode" name="txtCode">
			</form>
			<section id="descripcion">
				En la cabecera se configura generalmente un logo con el nombre.
			</section>
			<div id="error"></div>
				<?php
					require_once('script/function.php');
					$arg=array ('id_ent'=>$_SESSION['empresa'], 'id_est'=>5);
					$servicios=listarServiciosSinDetalle($arg);
						?>
				
				<?php  ?>
		</section>

	<?php  cc_footer(); ?>
</body>
</html>