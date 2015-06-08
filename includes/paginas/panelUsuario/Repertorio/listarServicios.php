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
				Los servicios son todas las actividades de un individuo o una empresa realizan para recibir un bien a cambio.
			</section>
			<div id="error"></div>
			<table class="sortable" id="anyid" cellpadding="0" cellspacing="0">
				<tr>
					<th>Nombre</th>
					<!--<th>Contratos</th>-->
					<th colspan="3" class="unsortable">Accion</th>
				</tr>
				<?php
					require_once('script/function.php');
					$arg=array ('id_ent'=>$_SESSION['empresa'], 'id_est'=>5);
					$servicios=listarServiciosSinDetalle($arg);
					for($i=0;$i<count($servicios);$i++)
					{
					$url_gen=WEB_BASE."detalle/".$servicios [$i] ['nom_ent']."/".$servicios [$i] ['nom_serv'];
						?>
				<tr>
					<td><?php echo $servicios [$i] ['nom_serv']; ?></td>
					<!--<td><a onclick="contratos(<?php echo $servicios [$i] ['id_serv']; ?>)">
						<img title="contratos" width="40px" src="<?php echo WEB_BASE; ?>imagenes/UI/contrato.png">
					</a></td>-->
					<td><a href="<?php echo $url_gen; ?>">
						<img title="ver" width="40px" src="<?php echo WEB_BASE; ?>imagenes/UI/ver.png">
					</a></td>
					<!--<td><a href="<?php echo $url_gen."/multimedia"; ?>">
						<img title="Multimedia" width="40px" src="<?php echo WEB_BASE; ?>imagenes/UI/multimedia.png">
					</a></td>-->
					<td><a onclick="modificar('<?php echo $servicios [$i] ['id_serv']; ?>')">
						<img title="Modificar" width="40px" src="<?php echo WEB_BASE; ?>imagenes/UI/modificar.png">
					</a></td>
					<td><a onclick="borrarServicio(<?php echo $servicios [$i] ['id_serv']; ?>, '<?php echo $servicios [$i] ['nom_serv']; ?>')">
						<img title="Eliminar" width="40px" src="<?php echo WEB_BASE; ?>imagenes/UI/borrar.png">
					</a></td>
				</tr>
				<?php } ?>
			</table>
		</section>

	<?php  cc_footer(); ?>
</body>
</html>