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
		require_once('script/function.php');
		//$arg=array ('sitio'=>str_replace('in/','',$_SESSION['empresa']));
		$arg=array ('id_ent'=>$_SESSION['empresa']);
		$empresa=listarEntidad($arg);
		$datetime1 = new DateTime("now");
		$datetime2 = new DateTime($empresa [0] ['subscripcion']);
		if($datetime1<=$datetime2)
		{
		?>
			<h1 class="titulo2">Analisis de los servicios</h1>
			<p>Los servicios son analisados por el sistema y corresponde a un resumen de las calificaciones de los contratos en los cuales se vio involucrado.</p>
			<?php
				
				$servicios=listarServiciosSinDetalle($arg);
				for($j=0;$j<count($servicios);$j++)
				{
			?>
					<h1 class="titulo2"><?php echo $servicios [$j] ['nom_serv']; ?></h1>
					<ul>
					<?php
						$arg=array ('id_serv'=>$servicios [$j] ['id_serv']);
						$promedio=listarPromedioCalificacionserv($arg);
						if(count($promedio)>0)
						{
							for($i=0;$i<count($promedio);$i++)
							{
								echo "<li>".$promedio [$i] ['desc_tc'].'=><label title="Valor: '.$promedio [$i] ['valor'].'">'.$promedio [$i] ['nom_ec']."</label></li>";
							}
						}
						else
						{
							echo "<li>Aun no a sido calificado este servicio.</li>";
						}
					?></ul>
			<?php
				}
		}
		else
		{
			?>
			No te quedan dias de subscripcion, para ver el analisis <a href="<?php echo WEB_BASE;?>administracion/subscriptores/comprar" >Compra mas dias</a>.
		<?php
			}
		?>
</section>

	<?php cc_footer(); ?>
</body>
</html>