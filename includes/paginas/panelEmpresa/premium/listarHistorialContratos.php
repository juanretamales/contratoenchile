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
	<?php
		require_once('script/function.php');
		$arg=array ('id_ent'=>$_SESSION['empresa']);
		$empresa=listarEntidad($arg);
		$datetime1 = new DateTime("now");
		$datetime2 = new DateTime($empresa [0] ['subscripcion']);
		if($datetime1<=$datetime2)
		{			require_once('script/function.php');			$arg=array ('id_ent'=>$_SESSION['empresa']);			$contratos=listarContactosSinDetalle($arg);			$estado=listarEstado($arg);			$anos="";			for($i=0;$i<count($contratos);$i++)			{				$ano=substr($contratos [$i] ['fecha_con'], 0, 3);				$mes=substr($contratos [$i] ['fecha_con'], 5, 6);				$anos [$ano] [$mes]=$anos [$ano] [$mes]+1;			}
		?>
	<section id="contenido">	<!--<section>		<h1 class="titulo">Resumen Historial de contratos</h1>		<div>				<canvas id="canvas" height="200" width="600"></canvas>			</div>			<p>Esta tabla resume tus contratos de los 10 ultimos años<p>		<script>		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};		var lineChartData = {			labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],			datasets : [				{					label: "My First dataset",					fillColor : "rgba(220,220,220,0.2)",					strokeColor : "rgba(220,220,220,1)",					pointColor : "rgba(220,220,220,1)",					pointStrokeColor : "#fff",					pointHighlightFill : "#fff",					pointHighlightStroke : "rgba(220,220,220,1)",					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]				},				{					label: "My Second dataset",					fillColor : "rgba(151,187,205,0.2)",					strokeColor : "rgba(151,187,205,1)",					pointColor : "rgba(151,187,205,1)",					pointStrokeColor : "#fff",					pointHighlightFill : "#fff",					pointHighlightStroke : "rgba(151,187,205,1)",					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]				}			]		}	window.onload = function(){		var ctx = document.getElementById("canvas").getContext("2d");		window.myLine = new Chart(ctx).Line(lineChartData, {			responsive: true		});	}	</script>	</section>-->

			<h1 class="titulo">Detalle del Historial de contratos</h1>
			
			<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
				<thead>
					<tr>
						<th><h3>Fecha</h3></th>
						<th><h3>Empresa</h3></th>
						<th><h3>Persona</h3></th>
						<th><h3>Estado</h3></th>
					</tr>
				</thead>
				<tbody>
			<?php
							
							for($i=0;$i<count($contratos);$i++)
							{
								?>
				<tr>
					<td><?php echo $contratos [$i] ['fecha_con']; ?></td>
					<td><?php echo $contratos [$i] ['nom_ent']; ?></td>
					<td><?php echo $contratos [$i] ['nombre']." ".$contratos [$i] ['apellido']; ?></td>
					<td><?php
						for($j=0;$j<count($estado);$j++)
						{
							if($contratos [$i] ['id_est']==$estado [$j] ['id_est'])
							{
								echo $estado [$j] ['nom_est'];
							}
						}
						?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
			</table>
			<div id="controls">
		<div id="perpage">
			<select onchange="sorter.size(this.value)">
			<option value="5">5</option>
				<option value="10" selected="selected">10</option>
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
			<span>Entradas por pagina</span>
		</div>
		<div id="navigation">
			<img src="<?php echo WEB_BASE;?>imagenes/tabla/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
			<img src="<?php echo WEB_BASE;?>imagenes/tabla/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
			<img src="<?php echo WEB_BASE;?>imagenes/tabla/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
			<img src="<?php echo WEB_BASE;?>imagenes/tabla/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
		</div>
		<div id="text">Desplegando pagina <span id="currentpage"></span> de <span id="pagelimit"></span></div>
		<script type="text/javascript" src="<?php echo WEB_BASE;?>script/tablas.js"></script>
	<script type="text/javascript">
  var sorter = new TINY.table.sorter("sorter");
	sorter.head = "head";
	sorter.asc = "asc";
	sorter.desc = "desc";
	sorter.even = "evenrow";
	sorter.odd = "oddrow";
	sorter.evensel = "evenselected";
	sorter.oddsel = "oddselected";
	sorter.paginate = true;
	sorter.currentid = "currentpage";
	sorter.limitid = "pagelimit";
	sorter.init("table",1);
	sorter.size(10);
  </script>
	</div>
</section>
<?php
			}
			else
			{
		?>
		<section id="contenido">
		No te quedan dias de subscripcion, para ver el historial <a href="<?php echo WEB_BASE;?>administracion/subscriptores/comprar" >Compra mas dias</a>.
	</section>

	<?php } cc_footer(); ?>
</body>
</html>
