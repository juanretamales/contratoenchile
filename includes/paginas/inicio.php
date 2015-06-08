<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
</head>
<body>
		<?php cc_header(); ?>
		<section>
			<?php 
			if(isset($_REQUEST['pagina']))
			{
				cc_menu($_REQUEST['pagina']); 
			}
			else
			{
				cc_menu(""); 
			}
			
			?> 
			<section id="contenido">
				<article id="artComentarios">
					<div>
						<label>Contrata sin moverte</label>
						<a id="imgContrata"></a>
						<p>Encuentra lo que necesitas, y coordina el pago y la entrega con el vendedor. Es fácil y rápido. ¡Todos podemos hacerlo! </p>
					</div>
					<div>
						<label>Protege tu inversion</label>
						<a id="imgProteccion"></a>
						<p>Antes de realizar el contrato puedes ver las estadisticas del servicio por usuarios reales de la comunidad que lo hayan contratado antes.¡Nuestro sistema de calificaciones no son solo estrellas, revisalo!</p>
					</div>
					<div>
						<label>Publica gratis</label>
						<a id="imgPublica"></a>
						<p>Publicar es completamente gratis. Contrato en chile genera ingresos con elementos opcionales, por lo que puedes vender sin problemas ¡Animate!</p>
					</div>
				</article>
				<article id="artCelular">
					<label>¡Compra y vende desde tu celular!</label>
					<p>Sin Necesidad de descargar ninguna aplicacion para iOS y Android</p>
					<p>Solo necesitas conexion a internet</p>
					<a id="imgCelular"></a>
				</article>
				<article id="artRedes">
					<div id="divTwitter">
						<label>Ultimos Twits con nuestro pajaro</label>
						<div></div>
					</div>
					<div id="divFacebook">
						<label>Ultimos Mensajes de Facebook</label>
						<div></div>
					</div>
				</article>
			</section>
		</section>
		<?php cc_footer(); ?>
</body>
</html>