<html lang="es" dir="LTR" >
	<head>
		<?php cc_head(); ?>
		
	</head>
	<body>
	<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=259290437609367&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
		<?php
			require_once('script/function.php');
			$page=explode("/",$pagina);
			if(count($page)>1)
			{
				$arg=array ();
				if($page[1]!="nada" || $page[1]!="")
				{
					$arg['nom_ent']=$page[1];
				}
				$entidad=listarEntidad($arg);
				if(count($entidad)==0)
				{
					echo '<h1 class="titulo2">No se encontraros Empresas con estas caracteristicas, �Deseas intentar crearlo tu?</h1>';
				}
				else
				{
			?>
						<div class="fb-comments" data-href="<?php echo WEB_BASE.$_REQUEST['pagina']; ?>" data-numposts="5" data-colorscheme="light"></div>
					}
			}
			?>
			</section>
		<?php cc_footer(); ?>
		<style>
			.fbConnectWidgetFooter { display: none }
		</style>
	</body>
</html>