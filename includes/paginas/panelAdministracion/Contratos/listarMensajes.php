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
			<?php 
				require_once "script/webConfig.php";
				require_once('script/function.php');
				$page=explode("/",$pagina);
				$back="";
				for($i=0;$i<(count($page)-1);$i++)
				{
					if($i!=0)
					{
						$back=$back."/".$page[$i];
					}
					else
					{
						$back=$back.$page[$i];
					}
				}
				if(isset($_POST['txtCode']))
				{
					echo '<input id="txtCode" name="txtCode" type="hidden" required value="'.$_POST['txtCode'].'">';
				}
				else
				{
					echo '<script language="javascript">window.location="'.WEB_BASE.$back.'"</script>';
				}
				$arg=array ('id_con'=>$_POST['txtCode']);
				$contrato=listarContactosSinDetalle($arg);
				?>
			<h1 class="titulo">Mensajes del contrato #<?php echo $_POST['txtCode']; ?></h1>
			<form id="frmModificar" method="post" name="frmModificar" action="<?php echo WEB_BASE.$back; ?>/modificar">
				<input type="hidden" id="txtCode" name="txtCode">
			</form>	<div id="error"></div>
			
			<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
				<thead>
					<tr>
						<th><h3>Fecha</h3></th>
						<th><h3>Emisor</h3></th>
						<th><h3>Mensaje</h3></th>
						<th colspan="1" class="nosort"><h3>Accion</h3></th>
					</tr>
				</thead>
				<tbody>
			<?php
							require_once('script/function.php');
							$arg=array ('id_con'=>$contrato [0] ['id_con']);
							$mensajes=listarMensajes($arg);
							for($i=0;$i<count($mensajes);$i++)
							{
								?>
				<tr>
					<td><?php echo $mensajes [$i] ['fecha_men']; ?></td>
					<td>
					<?php
						$arg=array ('rut'=>$mensajes [$i] ['emisor']);
						$persona=listarPersona($arg);
						echo $persona [0] ['nombre']." ".$persona [0] ['apellido']; ?>
					</td>
					<td><?php echo $mensajes [$i] ['mensaje']; ?></td>
					<!--<td><a onclick="modificar(<?php echo $contratos [$i] ['id_con']; ?>)">
					<img title="modificar" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/modificar.png">
					</a></td>-->
					<td><a onclick="eliminarMensajes('<?php echo $mensajes [$i] ['id_men']; ?>','')">
						<img title="Eliminar" width="20px" src="<?php echo WEB_BASE;?>imagenes/UI/borrar.png">
					</a></td>
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
	</div><a href="<?php echo WEB_BASE; ?>administracion/contratos" class="myButton" style="width: 100px;">			Volver			</a>
			<form class="formulario" onsubmit="return agregarMensaje()" method="post">
				<h1 class="titulo2">Enviar Mensaje</h1>
				<?php
					if(isset($_POST['txtCode']))
				{
					echo '<input id="txtCode" name="txtCode" type="hidden" required value="'.$_POST['txtCode'].'">';
				}
				else
				{
					echo '<script language="javascript">window.location="'.WEB_BASE.$back.'"</script>';
				}
				?>
				<div>
					<textarea autofocus rows="5" cols="50" required maxlength="255" id="txtMensaje" name="txtMensaje"></textarea> 
				</div>
				<div>
					<input type="submit" value="Enviar">
				</div>
			</form>
</section>

	<?php cc_footer(); ?>
</body>
</html>
