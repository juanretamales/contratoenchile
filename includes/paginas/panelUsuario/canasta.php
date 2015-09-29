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

				<h1 class="titulo">
					Carrito de servicios
				</h1>
				<a class="boton" onclick="contratar()" >Contratar</a>
				<a class="boton" onclick="actualizarCanasta('seccion')" >Actualizar</a>
				<a class="boton alerta" onclick="vaciarCarro()" >Vaciar</a>
				<div id="seccion" ></div>
		</section>
		<?php cc_footer(); ?>
		<script>
			window.onload = actualizarCanasta('seccion');
		</script>
	</body>
</html>