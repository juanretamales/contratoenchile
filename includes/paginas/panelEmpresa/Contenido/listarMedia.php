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

			<h1 class="titulo">Multimedia</h1>
			<a class="myButton" style="width: 50px;" href="http://www.contratoenchile.cl/<?php
				$pagina="";
				if(isset($_REQUEST['pagina']))
				{
					$pagina=$_REQUEST['pagina'];
				}
				echo $pagina;
			?>/agregar">Agregar</a>
			<form id="frmModificar" method="post" name="frmModificar" action="http://www.contratoenchile.cl/<?php echo $pagina; ?>/modificar">
				<input type="hidden" id="txtCode" name="txtCode">
			</form>
			<table class="sortable" id="anyid" cellpadding="0" cellspacing="0">
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Tipo Multimedia</th>
					<th>URL</th>
					<th colspan="2" class="unsortable">Accion</th>
				</tr>
				<?php
					require_once('script/function.php');
					$arg=array ('nada'=>0);
					$media=listarMedia($arg);
					$tp=listarTipomedia($arg);
					for($i=0;$i<count($media);$i++)
					{
						?>
				<tr>
					<td><?php echo $media [$i] ['id_med']; ?></td>
					<td><?php echo $media [$i] ['nom_med']; ?></td>
					<td><?php
					$nombre="";
					for($j=0;$j<count($media);$j++)
						{
							if($media [$j] ['id_tm']==$tp [$i] ['id_tm'])
							{
								$nombre=$tp [$j] ['nom_tm'];
								echo $nombre;
								break;
							}
						}
					?></td>
					<td><?php echo $paginas [$i] ['url_med']; ?></td>
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