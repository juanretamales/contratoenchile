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
	if(confirm('Desea eliminar la region '+nombre))
	{
		$.ajax({
                data:  {"txtReg" : id, "btnEliminarProvincia" : "Eliminar"},
                url:   'script/transicion.php',
                type:  'post',
                success:  function (response) {
                        location.reload();
                }
        });
	}
}
</script>
</head>
<body>
	<?php cc_header(); ?>
	<section>
		<?php cc_menu($pagina); ?>
	</section>
	<section id="contenido" style="margin: 20px 0px 0px 250px;">

		<h1 class="titulo">Servicios</h1>
		<a class="myButton" style="width: 50px;" href="http://www.contratoenchile.cl/administracion/comunidad/moderadores/agregar">Agregar</a>
		
		<table class="sortable" id="anyid" cellpadding="0" cellspacing="0">
			<tr>
				<th>Rut</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Estado</th>
				<th colspan="2" class="unsortable">Accion</th>
			</tr>
		<?php
						require_once('script/function.php');
						$arg=array ('nada'=>0);
						$mod=listarModerador($arg);
						for($i=0;$i<count($mod);$i++)
						{
							?>
			<tr>
				<td><?php echo $mod [$i] ['rut_mod']; ?></td>
				<td><?php echo $mod [$i] ['nom_mod']; ?></td>
				<td><?php echo $mod [$i] ['email_mod']; ?></td>
				<td><?php 
							$arg = array ('id_est'=>$mod [$i] ['id_est']);
							$region=listarEstado($arg);
							echo $region [0] ['nom_est'];
															?></td>
				<td><a href="index.php?pagina=panel&subpagina=modificarPaises&pais=<?php echo $mod [$i] ['id_mod']; ?>">Modificar</a></td>
				<td><a onclick="eliminar(<?php echo $mod [$i] ['id_mod']; ?>, '<?php echo $mod [$i] ['nom_mod']; ?>')">Eliminar</a></td>
			</tr>
			<?php } ?>
		</table>
	</section>
	<?php cc_footer(); ?>
</body>
</html>
