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
		<section id="contenido" >
			<h1 class="titulo2">General</h1>
			<ul>
				<li><a href="#1">¿Es realmente gratis publicar en contratoenchile.cl?</a></li>
				<li><a href="#2">¿Cómo se crea una cuenta?</a></li>
				<li><a href="#3">¿Cómo puedo modificar los datos de mi cuenta?</a></li>
			</ul>
			<h1 class="titulo2">Empresas</h1>
			<ul>
				<li><a href="#5">¿Cuánto se demora mi aviso en ser publicado?</a></li>
				<li><a href="#6">¿Cómo respondo a un contacto?</a></li>
				<li><a href="#7">¿Qué es una Tienda y cuanto cuesta?</a></li>
			</ul>
			<h1 class="titulo2">Contratistas</h1>
			<ul>
				<li><a href="#8">¿Cómo puedo contactar a una empresa?</a></li>
				<li><a href="#9">¿Debo pagar antes de recibir el producto?</a></li>
			</ul>
			<article id="1" class="servicios">
				¿Es realmente gratis publicar en contratoenchile.cl? Insertar un servicio en contratoenchile.cl es gratis y no se cobra ningún tipo de comisión. Si aún tienes dudas sobre este tema, puedes comunicarte con nosotros 
			</article>
			<article id="2" class="servicios">
				¿Cómo se crea una cuenta? En el menu superior esta el enlace para crear tu cuenta, consta de tres pasos, inscribir tu correo, verificarlo, y inscribir el resto de tus datos
			</article>
			<article id="3" class="servicios">
				¿Cómo puedo modificar los datos de mi cuenta? una vez identificado, debes ingresar a Panel y alli ir a mi perfil
			</article>
			<article id="5" class="servicios">
				¿Cuánto se demora mi aviso en ser publicado? Por ahora el sistema esta en modo automatico, es decir, se publica enseguida, pero podria ser cambiado.
			</article>
			<article id="6" class="servicios">
				¿Cómo respondo a un contacto? En tus contratos, debes ir a mensajes, alli estaras en una conversacion con la empresa.
			</article>
			<article id="7" class="servicios">
				¿Qué es una Tienda y cuanto cuesta? Una tienda dentro de Contrato en Chile es la pagina personal de la empresa registrada, esta la opcion basica que es gratuita, y la opcion completa que es por subscripcion
			</article>
			<article id="8" class="servicios">
				¿Cómo puedo contactar a una empresa? Una vez identificado, accede a panel, y en la parte inferior del menu saldra el enlace para tus contratos.
			</article>
			<article id="9" class="servicios">
				¿Debo pagar antes de recibir recibir el servicio? Es deber de cada empresa y contratista establecer las facilidades de pago, eso incluye el momento, Contrato en Chile da libertad a estos para hacerlo como estimen convenientes, aun que se recomienda que se pague al final de los servicios.
			</article>
		</section>
		<?php cc_footer(); ?>
	</body>
</html>