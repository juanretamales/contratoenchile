<nav id="menuprincipal">
					<ul>
						<li class="oculto" ><a href="./index.html">Inicio</a></li>
						<li>--Categorias--</li>
						<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$categorias=listarCategorias($arg);
							for($i=0;$i<count($categorias);$i++)
							{
								?>
						<li>
							<a class="myButton" href="./categorias.php?id_cat=<?php echo $categorias [$i] ['id_cat']; ?>">
								<?php echo $categorias [$i] ['nom_cat']; ?>
							</a>
						</li>
						<?php
						}
						?>
					</ul>
				</nav>