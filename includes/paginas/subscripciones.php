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
		<section id="contenido" >			<h1 class="titulo">Subscripciones</h1>
			<article class="servicios">				<img  style="background: url('http://127.0.0.1/imagenes/600.png'); background-size: 100% auto; background-repeat: no-repeat;" src="<?php echo WEB_BASE; ?>imagenes/1x1.png">				<label class="titulo">Contrato en Chile</label>				<p class="descripcion">Las cuentas gratuitas cuentan con muchas restricciones ya que estan pensados en usuarios que realizan pocos servicios o estan probando la plataforma, contamos con un sistema de subscripcion				 el cual cuenta con un panel avanzado en el cual podras observar en tiempo real la cantidad de visitas a tus servicios, ademas de un conteo del mes actual de tus servicios finalizados o en espera de ser completados.</br>				 Ademas podras ver todo el historial de tus servicios prestados que esten registrados en la pagina.</br>				 Contrato en Chile se considera una comunidad, por ello, como prestador de servicios, ofrece sus servicios de subscripcion mensuales, el cual podria pagar las veces que desee utilizarlos</br>				 				 *nota: para mas informacion identificarse, una vez creada la empresa podras acceder al boton subscripcion				</p>						</article></a>
		</section>
		<?php cc_footer(); ?>
	</body>
</html>