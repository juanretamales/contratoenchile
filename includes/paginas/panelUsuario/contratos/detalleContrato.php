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
					$servcon=listarServcon($arg);
					$contratos=listarContactosSinDetalle($arg);
					
				?>
			<h1 class="titulo">Detalles: Contrato con <?php echo $contratos [0] ['nom_ent']; ?></h1>
			<form id="frmModificar" method="post" name="frmModificar" action="<?php echo WEB_BASE.$back; ?>/modificar">
				<input type="hidden" id="txtCode" name="txtCode" value="<?php echo $_POST['txtCode']; ?>">
			</form>		<div id="error"></div>
			<a onclick="verMensajes('<?php echo $_POST['txtCode']; ?>')" class="boton">
				<img title="ver" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/mensajes.png">Mensajes
			</a>
			<?php
				if($contratos [0] ['id_est']==9 && $contratos [0] ['rut']==$_SESSION['rut'])
				{
			?>
			<a  onclick="calificarContacto('<?php echo $contratos [0] ['id_con']; ?>')" class="boton">
				<img title="Calificar" width="20px" src="<?php echo WEB_BASE;?>imagenes/UI/modificar.png">Calificar
			</a>
			<?php
				}
			?>
			<?php
				if($contratos [0] ['id_ent']==$_SESSION['empresa'] && $contratos [0] ['id_est']==7)
				{
			?>
			<a  onclick="finalizarContacto(<?php echo $contratos [0] ['id_con']; ?>, '<?php echo $contratos [0] ['nom_ent'].' con '.$contratos [0] ['nombre']." ".$contratos [0] ['apellido']; ?>')" class="boton">
				<img title="Calificar" width="20px" src="<?php echo WEB_BASE;?>imagenes/UI/flecha.png">Finalizar
			</a>
			<?php
				}
			?>
			
			<table class="sortable" id="anyid" cellpadding="0" cellspacing="0">
				<tr>
					<th>Nombre del servicio</th>
				</tr>
				<?php
					for($i=0;$i<count($servcon);$i++)
					{
						$arg=array ('id_sev'=>$servcon [$i] ['id_serv']);
						$servicio=listarServicio($arg);
				?>
				<tr>
					<td><?php echo $servicio [0] ['nom_serv']; ?></td>
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

	<?php cc_footer(); ?>
</body>
</html>