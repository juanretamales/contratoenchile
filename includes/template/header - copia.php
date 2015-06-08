<header id="header">
			<a href="<?php echo WEB_BASE;?>" id="imglogo" title="Pagina de inicio de Contrato en Chile">
			
			</a>
			<form id="frmBuscar"  method="get" action="http://www.google.com/search" >
				<input id="buscador" name="q" type="text" placeholder="Buscar servicio...">
				<input type="hidden" name="sitesearch" value="<?php echo WEB_BASE;?>">
				<input type="submit" value="Buscar">
				<?php
					if(!isset($_SESSION)){
						session_start();
					}
					if(isset($_SESSION['rol']))
					{
						if($_SESSION['rol']==0)
						{
							echo "<a href='".WEB_BASE."identificarse'>Identificarse</a>";
							echo "<a href='".WEB_BASE."registrar'>Registrarse</a>";
						}
						else
						{
							echo "Bienvenid@ ".$_SESSION['nombre'];
							echo "<a class='hdalerta' href='".WEB_BASE."administracion'>alertas</a>";
							echo "<a class='hdcanasta' href='".WEB_BASE."canasta'><img src='".WEB_BASE."imagenes/UI/canasta.png' width='20px'  title='Canasta'></a>";
							echo "<a class='hdcomparar' href='".WEB_BASE."comparacion'>Comparar</a>";
							echo "<a class='hdmensajes' href='".WEB_BASE."administracion'>Mensajes</a>";
							echo "<a class='hdpanel' href='".WEB_BASE."administracion'>Panel</a>";
							echo '<a class="hdsalir"  href='.WEB_BASE.' onclick="desconectarse()">Salir</a>';
						}
					}
					else
					{
						echo "<a href='".WEB_BASE."identificarse'>Identificarse</a>";
						echo "<a href='".WEB_BASE."registrar'>Registrarse</a>";
								
					}
				?>
			</form>
		</header>