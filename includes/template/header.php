<header id="header">
			<a href="<?php echo WEB_BASE;?>#" id="imglogo" title="Pagina de inicio de Contrato en Chile">
			
			</a>
			<nav id="menuCelular" class="">
				<ul><li tabindex="1"><a onclick="verMenu">Menu</a></li></ul>
			</nav>
			<div>
				<form id="frmBuscar"  method="get" action="http://www.google.com/search" >
					<input id="buscador" name="q" type="text" placeholder="Buscar servicio...">
					<input type="hidden" name="sitesearch" value="<?php echo WEB_BASE;?>">
					<input type="submit" value="Buscar">
				</form>
				<div id="menuSuperior">
				<?php
					if(!isset($_SESSION)){
						session_start();
					}
					if(isset($_SESSION['rol']))
					{
						if($_SESSION['rol']==0)
						{
							echo "<a href='".WEB_BASE."'><img src='".WEB_BASE."imagenes/UI/home.png' title='panel'><label>Inicio</label></a>";
							echo "<a title='Registrate' href='".WEB_BASE."registrar'> <img src='".WEB_BASE."imagenes/UI/join.png' title='panel'><label>Unete a la comunidad</label></a>";
							echo "<a title='Identificate' href='".WEB_BASE."identificarse'><img src='".WEB_BASE."imagenes/UI/login.png' title='panel'><label>Identificate</label></a>";	
						}
						else
						{
							echo "Contrato en Chile te saluda cordialmente, ".$_SESSION['nombre'];
							
							echo "<a class='hdsalir'  onclick='desconectarse()'><img src='".WEB_BASE."imagenes/UI/salir.png' width='20px'  title='salir'></a>";
							echo "<a class='hdcanasta' href='".WEB_BASE."administracion'><img src='".WEB_BASE."imagenes/UI/panel.png' width='20px'  title='panel'></a>";
							echo "<a class='hdcanasta' onclick='desplegarContratos()'><img src='".WEB_BASE."imagenes/UI/mensaje.png' width='20px'  title='mensajes'></a>";
							echo "<a class='hdcanasta' href='".WEB_BASE."comparacion'><img src='".WEB_BASE."imagenes/UI/comparacion.png' width='20px'  title='comparacion'></a>";
							echo "<a class='hdcanasta' href='".WEB_BASE."canasta'><img src='".WEB_BASE."imagenes/UI/canasta.png' width='20px'  title='Canasta'></a>";
							echo "<a class='hdcanasta' href='".WEB_BASE."canasta'><img src='".WEB_BASE."imagenes/UI/alerta.png' width='20px'  title='Alerta'></a>";
							echo "<a class='hdcanasta' href='".WEB_BASE."'>Inicio</a>";
	
						}
					}
					else
					{
						echo "<a href='".WEB_BASE."identificarse'>Identificarse</a>";
						echo "<a href='".WEB_BASE."registrar'>Registrarse</a>";
						echo "<a class='hdcanasta' href='".WEB_BASE."'>Inicio</a>";
							
					}
				?>
				</div>
			</div>
		</header>
		<?php
			if(isset($_SESSION['rol']))
			{
				if($_SESSION['rol']!=0)
				{
				require_once "script/webConfig.php";
				require_once('script/function.php');
				$arg=array ('rut'=>$_SESSION['rut'], 'id_est'=>7);
				$contratos=listarContactosSinDetalle($arg);
				echo '<div id="divContratos" class="activo" >
					<div>Comunicate con empresas</div>';
				if(count($contratos)==0)
				{
					echo "<div>No tienes contratos activos en este momento.</div>";
				}
				else
				{
					for($i=0;$i<count($contratos);$i++)
					{
						$nombre=$contratos[$i]['nom_ent'];
						//echo '<div onclick="abrirChat('.$contratos[$i]['id_con'].','.$contratos[$i]['nom_ent'].')">'.$contratos[$i]['nom_ent'].'</div>';
						echo "<div onclick='abrirChat(".$contratos[$i]['id_con'].", \" $nombre \")'>".$contratos[$i]['nom_ent'].'</div>';
					}
				}
				echo '</div>'
				?>
					
				
				<div id="divChat" class="min" style="">
					
				</div>
				<?php
				}
			}
		?>