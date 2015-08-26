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
		<section id="contenido" >			<h1 class="titulo">Relaciones con los usuarios</h1>
			<a>			<article class="servicios">				<img  style="background: url('http://127.0.0.1/imagenes/600.png'); background-size: 100% auto; background-repeat: no-repeat;" src="<?php echo WEB_BASE; ?>imagenes/1x1.png">				<label class="titulo">Contrato en Chile</label>				<p class="descripcion">Contrato en chile considera a los usuarios como una comunidad, los cuales respetando la calificacion que cada uno de por los servicios prestados a la empresa, pueda compartir sus experiencias ya sean positivas o negativas para				que otro miembro pueda ayudarlo como una referencia a la hora de contratar dicho servicio.</p>						</article></a>
		</section>
		<?php cc_footer(); ?>
	</body>
</html>