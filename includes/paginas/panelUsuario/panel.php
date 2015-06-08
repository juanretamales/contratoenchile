<section id="contenido" style="margin: 10px 0px 0px 250px;">Bienvenido operador, este es el panel de administracion.</section>
<br><br>
<table class="">
	<tr>
		<td align="center">Resumen Contratos 2014</td>
	</tr>
	<tr>
		<td><canvas id="chart-area" width="200" height="200"/></td>
	</tr>
</table>
<script>

		var doughnutData = [
				{
					value: 10,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Canceladas"
				},
				{
					value: 100,
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "Pendientes"
				},
				{
					value: 40,
					color: "#46BFBD",
					highlight: "#A8B3C5",
					label: "Finalizadas"
				}

			];

			window.onload = function(){
				var ctx = document.getElementById("chart-area").getContext("2d");
				window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {
				responsive : true,
				legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
				});
			};



	</script>