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
		<section id="contenido" >			<h1 class="titulo">publicacion</h1>			<a>			<article class="servicios">				<img  style="background: url('http://127.0.0.1/imagenes/600.png'); background-size: 100% auto; background-repeat: no-repeat;" src="<?php echo WEB_BASE; ?>imagenes/1x1.png">				<label class="titulo">Contrato en Chile</label>				<p class="descripcion">Contrato en chile establece que cualquier servicios que respete las politicas de privacidad, los terminos y conticiones de uso y las leyes vigentes en Chile puede ser publicado para su contratacion.</p>						</article></a>
		</section>
		<?php cc_footer(); ?>
	</body>
</html>