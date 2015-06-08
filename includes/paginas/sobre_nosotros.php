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
			Contrato en chile es una empresa que pretende ayudar a pequeñas y medianas empresas dandoles soluciones y facilidades en sus labores de servicios
			y tambien ayudar a las personas a contratar un servicio entregandole informacion para que tengan mayor claridad del servicio a contratar.
		</section>
		<?php cc_footer(); ?>
	</body>
</html>