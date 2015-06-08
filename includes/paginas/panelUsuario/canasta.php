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
					Carrito de servicios
				</h1>
				<a class="myButton" style="width: 50px;" onclick="contratar()" >Contratar</a>
				<a class="myButton" style="width: 50px;" onclick="actualizarCanasta('seccion')" >Actualizar</a>
				<a class="myButton" style="width: 50px;" onclick="vaciarCarro()" >Vaciar</a>
				<div id="seccion" ></div>
		</section>
		<?php cc_footer(); ?>
		<script>
			window.onload = actualizarCanasta('seccion');
		</script>
	</body>
</html>