<html lang="es" dir="LTR" >
<head>
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Contrato en Chile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Contrato en Chile">
        <meta name="keywords" content="Contrato en Chile">
        <meta name="author" content="Juan Retamales">
        <link rel="shortcut icon" href="./imagenes/icon/256.png">
	
	<LINK href="../../estilos/banner.css" rel="stylesheet" type="text/css">
	
	<LINK href="../../estilos/formulario.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/menu.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/menu-admin.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/normal.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/radiobutton.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/servicios.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/footer.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/tablas.css" rel="stylesheet" type="text/css">
	
	<script src="../../script/jquery-1.11.0.min.js"></script>
	<script src="../../script/holder.js"></script>
	<script src="../../script/sortable.js"></script>
	<script src="../../script/Chart.min.js"></script>
	<script src="../../script/formulario.js"></script>
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

			<h1 class="titulo">Contratos Finalizados</h1>
			<table class="sortable" id="anyid" cellpadding="0" cellspacing="0">
				<tr>
					<th>Fecha</th>
					<th>Empresa</th>
					<th>Persona</th>
					<th colspan="2" class="unsortable">Accion</th>
				</tr>
			<?php
							require_once('script/function.php');
							$arg=array ('id_est'=>8, 'rut'=>$_SESSION['empresa']);
							$contratos=listarContactosSinDetalle($arg);
							for($i=0;$i<count($contratos);$i++)
							{
								?>
				<tr>
					<td><?php echo $contratos [$i] ['fecha_con']; ?></td>
					<td><?php echo $contratos [$i] ['nom_ent']; ?></td>
					<td><?php echo $contratos [$i] ['nombre']." ".$contratos [$i] ['apellido']; ?></td>
					<td><a onclick="ver(<?php echo $contratos [$i] ['id_con']; ?>)">
					<img title="ver" width="20px" src="http://www.contratoenchile.cl/imagenes/UI/ver.png">
					</a></td>
					<td><a onclick="modificar(<?php echo $contratos [$i] ['id_con']; ?>)">
					<img title="modificar" width="20px" src="http://www.contratoenchile.cl/imagenes/UI/modificar.png">
					</a></td>
				</tr>
				<?php } ?>
			</table>
</section>

	<?php cc_footer(); ?>
</body>
</html>
