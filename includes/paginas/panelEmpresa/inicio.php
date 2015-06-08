<html lang="es" dir="LTR" >
<head>
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Contrato en Chile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Contrato en Chile">
        <meta name="keywords" content="Contrato en Chile">
        <meta name="author" content="Juan Retamales">
        <link rel="shortcut icon" href="./imagenes/icon/256.png">
	
	<LINK href="../../estilos/banner.css" rel="stylesheet" type="text/css">
	
	<LINK href="../../estilos/formulario.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/menu.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/menu-admin.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/normal.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/radiobutton.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/servicios.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/footer.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/tablas.css" rel="stylesheet" type="text/css">
	
	<script src="./script/jquery-1.11.0.min.js"></script>
	<script src="./script/holder.js"></script>
	<script src="./script/sortable.js"></script>
	<script src="./script/Chart.min.js"></script>
</head>
<body>
<?php cc_header(); ?>
		<section>
			<?php cc_menu($pagina); ?>
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

</section>
		<?php cc_footer(); ?>
</body>
</html>

	