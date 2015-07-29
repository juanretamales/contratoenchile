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
<div class="mensaje informativo">
<em></em>
<p>Bienvenido <?php echo $_SESSION['nombre'];?>, este es el panel de administracion. El personal de Contrato en Chile desea que tu estancia en el sitio sea lo mas agradable posible.</p>
<a onclick="this.parentNode.remove()">X</a>
</div>
<?php
if(isset($_SESSION['empresa']))
{
	$arg=array('id_ent'=>$_SESSION['empresa']);
	$empresa=listarEntidad($arg);
	/*
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
*/
}
$arg=array('id_ent'=>$_SESSION['empresa'], 'fecha'=>4);
$contratos=listarResumenContacto($arg);
$fecha = date("m");

$numcontratos=[];

$vigente=0;
$cancelado=0;
$terminado=0;

for($i=0;$i<count($contratos);$i++)
{
	if($contratos[$i]['mes']==$fecha)
	{
		if($contratos[$i]['estado']==7)
		{
			$vigente=$vigente+$contratos[$i]['cantidad'];
		}
		if($contratos[$i]['estado']==8)
		{
			$cancelado=$cancelado+$contratos[$i]['cantidad'];
		}
		if($contratos[$i]['estado']==9)
		{
			$terminado=$terminado+$contratos[$i]['cantidad'];
		}
	}
}

for($i=0;$i<count($contratos);$i++)
{
	if(isset($numcontratos[$contratos[$i]['mes']]))
	{
		$numcontratos[$contratos[$i]['mes']]+=$contratos[$i]['cantidad'];
	}
	else
	{
		$numcontratos[$contratos[$i]['mes']]=$contratos[$i]['cantidad'];
	}
}
?>
<div class="divActividades">
	<div class="actHead">
		<div>Resumenes de actividades de este mes</div>
	</div>
	<div id="widgets">
		<div>
			<div>
				<div>
					<div>
						<em></em>
					</div>
					<div>
						<div><?php
						$entidad=listarEntidad(['id_ent'=>$_SESSION['empresa']]);
						echo contadorVisitas(['nom_ent'=>$entidad[0]['nom_ent']]);
						?></div>
						<div>Visitantes</div>
					</div>
				</div>
			</div>
		</div>
		<div>
			<div>
				<div>
					<div>
						<em></em>
					</div>
					<div>
						<div><?php echo $vigente; ?></div>
						<div>Vigentes</div>
					</div>
				</div>
			</div>
		</div>
		<div>
			<div>
				<div>
					<div>
						<em></em>
					</div>
					<div>
						<div><?php echo $terminado; ?></div>
						<div>Finalizados</div>
					</div>
				</div>
			</div>
		</div>
		<div>
			<div>
				<div>
					<div>
						<em></em>
					</div>
					<div>
						<div><?php echo $cancelado; ?></div>
						<div>Cancelados</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="divPrincipal">
	<div class="actHead">
		<div>Ultimos Contratos mensuales</div>
	</div>
	<div class="actBody">
		<div class="grafico" style="width: 90%; height: 200px;">
				<canvas id="canvas" ></canvas>
		</div>
	<script>
		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var mes = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
		var lineChartData = {
			labels : [
			<?php
				
				echo "mes[".($fecha-4)."],";
				echo "mes[".($fecha-3)."],";
				echo "mes[".($fecha-2)."],";
				echo "mes[".($fecha-1)."],";
				echo "mes[".($fecha)."]";
			?>],
			datasets : [
				{
					label: "N° de Contratos",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [
					<?php
						for($i=($fecha-4);$i<=$fecha;$i++)
						{
							if(isset($numcontratos[$i]))
							{
								echo $numcontratos[$i];
							}
							else
							{
								echo 0;
							}
							if($i!=count($numcontratos))
							{
								echo ', ';
							}
						}
					?>
					]
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

	