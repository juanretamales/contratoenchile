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
		<section id="contenido">

				<h1 class="titulo">
					Comparacion de servicios
				</h1>
				<a class="boton"  onclick="actualizarComparacion('seccion')" >Actualizar</a>
				<a class="boton"  onclick="vaciarComparacion()" >Vaciar</a><div id="seccion" ></div>
				<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">				<thead>					<tr>						<th  class="nosort"><h3>Servicio</h3></th>					<?php							require_once('script/function.php');							$arg=array ('nada'=>0);							$tipocal=listarTipocal($arg);							for($i=0;$i<count($tipocal);$i++)							{								echo "<th  class='nosort'><h3>".$tipocal [$i] ['nom_tc']."</h3></th>";							}						?>					</tr>				</thead>				<tbody id="tablacomparacion">				</tbody>			</table>						<div id="controls">		<div id="perpage">			<select onchange="sorter.size(this.value)">			<option value="5">5</option>				<option value="10" selected="selected">10</option>				<option value="20">20</option>				<option value="50">50</option>				<option value="100">100</option>			</select>			<span>Entradas por pagina</span>		</div>		<div id="navigation">			<img src="<?php echo WEB_BASE;?>imagenes/tabla/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />			<img src="<?php echo WEB_BASE;?>imagenes/tabla/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />			<img src="<?php echo WEB_BASE;?>imagenes/tabla/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />			<img src="<?php echo WEB_BASE;?>imagenes/tabla/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />		</div>		<div id="text">Desplegando pagina <span id="currentpage"></span> de <span id="pagelimit"></span></div>		<script type="text/javascript" src="<?php echo WEB_BASE;?>script/tablas.js"></script>	<script type="text/javascript">  var sorter = new TINY.table.sorter("sorter");	sorter.head = "head";	sorter.asc = "asc";	sorter.desc = "desc";	sorter.even = "evenrow";	sorter.odd = "oddrow";	sorter.evensel = "evenselected";	sorter.oddsel = "oddselected";	sorter.paginate = true;	sorter.currentid = "currentpage";	sorter.limitid = "pagelimit";	sorter.init("table",1);	sorter.size(10);  </script>	</div>
		</section>
		<?php cc_footer(); ?>
		<script>
			window.onload = actualizarComparacion('seccion');
		</script>
	</body>
</html>