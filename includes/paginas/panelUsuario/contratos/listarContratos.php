<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>	<style>		.sortable tr td:nth-of-type(1):before { content: "Fecha: "; }		.sortable tr td:nth-of-type(2):before { content: "Empresa: "; }		.sortable tr td:nth-of-type(3):before { content: "Acciones: "; }		@media (min-width: 1200px)		{			.sortable tr td:nth-of-type(n):before { content: ""; }		}	</style>
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

			<h1 class="titulo">Contratos Vigentes</h1>
			<form id="frmModificar" method="post" name="frmModificar" action="<?php echo WEB_BASE.$back; ?>/modificar">
				<input type="hidden" id="txtCode" name="txtCode">
			</form>		<div id="error"></div>
			<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
				<thead>
					<tr>
						<th><h3>Fecha</h3></th>
						<th><h3>Usuario</h3></th>
						<th colspan="2" class="nosort"><h3>Accion</h3></th>
					</tr>
				</thead>
				<tbody>
			<?php
							require_once('script/function.php');
							$arg=array ('id_est'=>7,'id_ent'=>$_SESSION['empresa']);
							$contratos=listarContactosSinDetalle($arg);
							for($i=0;$i<count($contratos);$i++)
							{
								?>
				<tr>
					<td><?php echo $contratos [$i] ['fecha_con']; ?></td>
					<td><?php echo $contratos [$i] ['nom_ent']; ?></td>
					<td><a onclick="verContacto(<?php echo $contratos [$i] ['id_con']; ?>)">
					<img title="ver" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/ver.png">
					</a></td>
					<td><a onclick="verMensajes('<?php echo $contratos [$i] ['id_con']; ?>')">
					<img title="ver" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/mensajes.png">
					</a></td>
				</tr>
				<?php } ?>
			</tbody>
			</table><?php table_footer()	?>
</section>

	<?php cc_footer(); ?>
</body>
</html>