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

				<h1 class="titulo2">
					Comparacion de servicios
				</h1>
				<a class="myButton" style="width: 50px;" onclick="actualizarComparacion('seccion')" >Actualizar</a>
				<a class="myButton" style="width: 50px;" onclick="vaciarComparacion()" >Vaciar</a>
				<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
		</section>
		<?php cc_footer(); ?>
		<script>
			window.onload = actualizarComparacion('seccion');
		</script>
	</body>
</html>