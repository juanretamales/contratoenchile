<html lang="es" dir="LTR" >	<head>		<?php cc_head(); ?>	</head>	<body>		<?php cc_header(); ?>		<section>			<?php 				$pagina="";				if(isset($_REQUEST['pagina']))				{					$pagina=$_REQUEST['pagina'];				}				cc_menu($pagina); ?>		</section>		<section id="contenido" >			<a>			<article class="servicios">				<img  style="background: url('http://127.0.0.1/imagenes/600.png'); background-size: 100% auto; background-repeat: no-repeat;" src="<?php echo WEB_BASE; ?>imagenes/1x1.png">				<label class="titulo">Contrato en Chile</label>				<p class="descripcion">Contrato en chile es una empresa que pretende ayudar a pequeñas y medianas empresas dandoles soluciones y facilidades en sus labores de servicios			y tambien ayudar a las personas a contratar un servicio entregandole informacion para que tengan mayor claridad del servicio a contratar.</p>						</article></a>		</section>		<?php cc_footer(); ?>	</body></html>