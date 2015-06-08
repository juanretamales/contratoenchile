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

			<h1 class="titulo">Paginas</h1>
			<a class="myButton" style="width: 50px;" href="http://www.contratoenchile.cl/administracion/contenido/pagina/agregar">Agregar</a>
			<form id="frmModificar" method="post" name="frmModificar" action="http://www.contratoenchile.cl/administracion/contenido/pagina/modificar">
				<input type="hidden" id="txtCode" name="txtCode">
			</form>
			<table class="sortable" id="anyid" cellpadding="0" cellspacing="0">
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Tipo pagina</th>
					<th>URL</th>
					<th colspan="2" class="unsortable">Accion</th>
				</tr>
			<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$paginas=listarPagina($arg);
							for($i=0;$i<count($paginas);$i++)
							{
								?>
				<tr>
					<td><?php echo $paginas [$i] ['id_pag']; ?></td>
					<td><?php echo $paginas [$i] ['nom_pag']; ?></td>
					<td><?php 
								$arg = array ('id_tp'=>$paginas [$i] ['id_tp']);
								$tipopag=listarTipopagina($arg);
								echo $tipopag [0] ['nom_tp'];
																?></td>
					<td><?php echo $paginas [$i] ['url_pag']; ?></td>
					<td><a onclick="modificar(<?php echo $paginas [$i] ['id_pag']; ?>)">
						<img title="Modificar" width="20px" src="http://www.contratoenchile.cl/imagenes/UI/modificar.png">
					</a></td>
					<td><a onclick="eliminarPagina(<?php echo $paginas [$i] ['id_pag']; ?>, '<?php echo $paginas [$i] ['nom_pag']; ?>')">
						<img title="Eliminar" width="20px" src="http://www.contratoenchile.cl/imagenes/UI/borrar.png">
					</a></td>
				</tr>
				<?php } ?>
			</table>
</section>


	<?php cc_footer(); ?>
</body>
</html>