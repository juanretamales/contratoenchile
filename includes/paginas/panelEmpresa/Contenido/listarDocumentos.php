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
<script>
function eliminar(id, nombre)
{
	if(confirm('Desea eliminar el documento '+nombre+'?'))
	{
		$.ajax({
                data:  {"btnEliminarDocumento" : id},
                url:   '../../script/transicion.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alert(response);
					}
                }
        });
	}
}
</script>
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

			<h1 class="titulo">Documentos</h1>
			<a class="myButton" style="width: 50px;" href="http://www.contratoenchile.cl/administracion/contenido/documento/agregar">Agregar</a>
			<table class="sortable" id="anyid" cellpadding="0" cellspacing="0">
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Tipo doc</th>
					<th>Empresa</th>
					<th>URL</th>
					<th colspan="2" class="unsortable">Accion</th>
				</tr>
			<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$doc=listarDocumento($arg);
							for($i=0;$i<count($doc);$i++)
							{
								?>
				<tr>
					<td><?php echo $doc [$i] ['id_doc']; ?></td>
					<td><?php echo $doc [$i] ['nom_doc']; ?></td>
					<td><?php
						$arg=array ('id_td'=>$doc [$i] ['id_td']);
						$td=listarTipodocumento($arg);
						echo $td [0] ['nom_td'];
					?></td>
					<td><?php echo $doc [$i] ['id_ent']; ?></td>
					<td><?php echo $doc [$i] ['url_doc']; ?></td>
					<td><a href="http://www.contratoenchile.cl/<?php echo $doc [$i] ['id_doc']; ?>">Modificar</a></td>
					<td><a onclick="eliminar(<?php echo $doc [$i] ['id_doc']; ?>, '<?php echo $doc [$i] ['nom_doc']; ?>')">Eliminar</a></td>
				</tr>
				<?php } ?>
			</table>
</section>


	<?php cc_footer(); ?>
</body>
</html>