<header id="header">
			<a href="<?php echo WEB_BASE;?>#" id="imglogo" title="Pagina de inicio de Contrato en Chile">
			
			</a>
			
			<div>
				<form id="frmBuscar"  method="get" action="http://www.google.com/search" >
					<input id="buscador" name="q" type="text" placeholder="Buscar servicio...">
					<input type="hidden" name="sitesearch" value="<?php echo WEB_BASE;?>">
					<input type="submit" value="Buscar">
				</form>
				<nav id="menuSuperior" class="">
					<ul id="menuComprimido">
						<li><a onclick="verMenu('menuDescomprimido')"><img src="<?php echo WEB_BASE;?>imagenes/UI/menu.png"><label>Menu</label></a></li>
					</ul>
					<ul id="menuDescomprimido">
						<li><a href="<?php echo WEB_BASE;?>"><img src="<?php echo WEB_BASE;?>imagenes/UI/home.png"><label>Inicio</label></a></li>
						<?php
							if(!isset($_SESSION)){
								session_start();
							}
							if(isset($_SESSION['rol']))
							{
								if($_SESSION['rol']==0)
								{
						?>
						<li><a href="<?php echo WEB_BASE;?>registrar"><img src="<?php echo WEB_BASE;?>imagenes/UI/join.png"><label>Unete a la comunidad</label></a></li>
						<li><a href="<?php echo WEB_BASE;?>identificarse"><img src="<?php echo WEB_BASE;?>imagenes/UI/login.png"><label>Identificate</label></a></li>
						<li class="celular"><a onclick="verMenu('frmBuscar')"><img src="<?php echo WEB_BASE;?>imagenes/UI/buscar.png"><label>Buscar Servicios</label></a></li>
						<li class="celular"><a onclick="verMenu('categorias')"><img src="<?php echo WEB_BASE;?>imagenes/UI/navegar.png"><label>Navegar por las categorias</label></a></li>
						<li class="celular"><a onclick="verMenu('divTwitter')"><img src="<?php echo WEB_BASE;?>imagenes/UI/face.png"><label>Revisar nuestro facebook</label></a></li>
						<li class="celular"><a onclick="verMenu('divFacebook')"><img src="<?php echo WEB_BASE;?>imagenes/UI/twitter.png"><label>Leer nuestros twitts</label></a></li>
						<?php
								}
								else
								{
						?>
						<li class="celular"><a onclick="verMenu('frmBuscar')"><img src="<?php echo WEB_BASE;?>imagenes/UI/buscar.png"><label>Buscar Servicios</label></a></li>
						<li class="celular"><a onclick="verMenu('categorias')"><img src="<?php echo WEB_BASE;?>imagenes/UI/navegar.png"><label>Navegar por las categorias</label></a></li>
						<li><a href="<?php echo WEB_BASE;?>canasta"><img src="<?php echo WEB_BASE;?>imagenes/UI/canasta.png"><label>Canasta de servicios</label></a></li>
						<li><a href="<?php echo WEB_BASE;?>comparacion"><img src="<?php echo WEB_BASE;?>imagenes/UI/comparacion.png"><label>Comparacion de servicios</label></a></li>
						<li><a onclick='desplegarContratos()'><img src="<?php echo WEB_BASE;?>imagenes/UI/mensaje.png"><label>Ver mensajes</label></a></li>
						<li><a href="<?php echo WEB_BASE;?>administracion"><img src="<?php echo WEB_BASE;?>imagenes/UI/panel.png"><label>Panel de control</label></a></li>
						<li class="celular"><a onclick="verMenu('divTwitter')"><img src="<?php echo WEB_BASE;?>imagenes/UI/face.png"><label>Revisar nuestro facebook</label></a></li>
						<li class="celular"><a onclick="verMenu('divFacebook')"><img src="<?php echo WEB_BASE;?>imagenes/UI/twitter.png"><label>Leer nuestros twitts</label></a></li>
						<li><a onclick='desconectarse()'><img src="<?php echo WEB_BASE;?>imagenes/UI/salir.png"><label>Desconectarse</label></a></li>
						<?php
								}
							}
						?>
						<li class="celular"><a onclick="verMenu('')">Volver</a></li>
					</ul>
				</nav>
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
					
				
				<div id="divChat" class="min">
					
				</div>
				<?php
				}
			}
		?>