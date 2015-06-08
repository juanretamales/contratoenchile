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
<section id="contenido" >Bienvenido operador, este es el panel de administracion.
<br><br>
<table class="">
	<tr>
		<td align="center">Monitor de Memoria</td>
	</tr>
	<tr>
		<td><canvas id="chart-area2" width="200" height="200"/></td>
	</tr>
</table>
<script>
<?php $ram=round(memory_get_usage()/1048576,2); ?>
		var doughnutData2 = [
				{
					value: <?php echo $ram; ?>,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Mb Usados"
				},
				{
					value: <?php echo (512-$ram); ?>,
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "Mb Disponibles"
				}

			];

			window.onload = function(){
				var ctx = document.getElementById("chart-area2").getContext("2d");
				window.myDoughnut = new Chart(ctx).Doughnut(doughnutData2, {
				responsive : true,
				legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
				});
			};



	</script>
</section>
</section>
		<?php cc_footer(); ?>
</body>
</html>

	