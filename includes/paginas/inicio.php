<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
</head>
<body>
		<?php cc_header(); ?>
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
						<label>Ultimos mensajes de Twitter</label>
						<div>
							           <a class="twitter-timeline"  href="https://twitter.com/Mineclack" data-widget-id="633709186161987585" 
  height="300"   data-chrome="transparent noborders" data-tweet-limit="3">Tweets por el @Mineclack.</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							
						</div>
					</div>
					<div id="divFacebook">
						<label>Ultimos Mensajes de Facebook</label>
						<div>
							<div class="fb-comments" data-href="https://www.facebook.com/AnimeGateMerchading/posts/1204733162901536" data-width="512" data-numposts="5"></div>
							<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.4&appId=259290437609367";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
						</div>
					</div>
				</article>
			</section>
		<?php cc_footer(); ?>
</body>
</html>