<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
</head>
<body>
<?php cc_header(); ?>

<?php 
	$pagina="";
	if(isset($_REQUEST['pagina']))
	{
		$pagina=$_REQUEST['pagina'];
	}
	cc_menu($pagina); 
?>
<section id="contenido" >
Bienvenido operador, este es el panel de administracion.
<?php
if(isset($_SESSION['empresa']))
{
	$arg=array('id_ent'=>$_SESSION['empresa']);
	$empresa=listarEntidad($arg);
?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=259290437609367&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<a class="boton" href="<?php echo WEB_BASE.'in/'.$empresa [0] ['nom_ent'] ?>">Ir a la pagina de la empresa <?php echo $empresa [0] ['nom_ent'] ?></a><br>
	<div class="fb-like" data-href="<?php echo WEB_BASE.'in/'.$empresa [0] ['nom_ent'] ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
<?php
}
?>
<div class="divActividades">
	<div class="actHead">
		<div>Resumenes de actividades</div>
	</div>
	<div class="actBody">
		<div>
			<a>visitantes online</a>
			<span>48</span>
			<p>En las ultimos 24 horas</p>
		</div>
		<div>
			<a>Contratos activos</a>
			<span>5</span>
			<p>Por finalizar</p>
		</div>
		<div>
			<a>Contratos Completados</a>
			<span>5</span>
			<p>Completados satisfactoriamente</p>
		</div>
		<div>
			<a>Contratos Cancelados</a>
			<span>5</span>
			<p>Analizalos para mejorar negocio</p>
		</div>
	</div>
</div>
<div class="divPrincipal">
	<div class="actHead">
		<div>Contratos mensuales</div>
	</div>
	<div class="actBody">
		<div class="grafico">
				<canvas id="canvas"></canvas>
		</div>


	<script>
		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				},
				{
					label: "My Second dataset",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				}
			]

		}

	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	}


	</script>
	</div>
</div>
</section>
		<?php cc_footer(); ?>
</body>
</html>

	