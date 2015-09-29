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
			<div id="filtro" class="">
				<em></em>
				<p>Filtro por cobertura</p>
				<form class="filtro" onsubmit="return actualizarCobertura()">
					<div>
						<label>Pais</label>
						<select required onchange='listarRegiones("<option value=\"0\"  selected>Omitir</option>")' x-moz-errormessage="Debe seleccionar un pais" maxlength="255"  id="txtPais" name="txtPais">
							<option value="0" <?php if(!isset($_SESSION['cobPais'])) {  echo ' selected '; }  ?> >Omitir</option>
							<?php
									require_once('script/function.php');
									$arg=array ('nada'=>0);
									$paises=listarPais($arg);
									for($i=0;$i<count($paises);$i++)
									{
										?>
							<option value="<?php echo $paises [$i] ['id_pais']; ?>"
							<?php
								if(isset($_SESSION['cobPais']))
								{
									if($_SESSION['cobPais']==$paises [$i] ['id_pais'])
									{
										echo " selected ";
									}
								}
							?>
							><?php echo $paises [$i] ['nom_pais']; ?></option>
						<?php } ?>
						</select>
					</div>

					<div>
						<label>Region</label>

						<select required  onchange='listarProvincias("<option value=\"0\"  selected>Omitir</option>")' maxlength="255"  x-moz-errormessage="Debe seleccionar una region" id="txtRegion" name="txtRegion">

							<option value="0" <?php if(!isset($_SESSION['cobReg'])) { echo 'selected'; } ?> >Omitir</option>
							<?php
								if(isset($_SESSION['cobPais']))
								{
									$arg=array ('id_pais'=>$_SESSION['cobPais']);

									$regiones=listarRegion($arg);

									for($i=0;$i<count($regiones);$i++)

									{

										?>

									<option <?php if($_SESSION['cobReg']==$regiones [$i] ['id_reg']){ echo "selected"; } ?> value="<?php echo $regiones [$i] ['id_reg']; ?>"><?php echo $regiones [$i] ['nom_reg']; ?></option>

										<?php } } ?>
						</select>
					</div>
					<div>
						<label>Provincia</label>
						<select required  onchange='listarComunas("<option value=\"0\"  selected>Omitir</option>")'  maxlength="255"  x-moz-errormessage="Debe seleccionar un pais" id="txtProvincia" name="txtProvincia">
							<option value="0" <?php if(!isset($_SESSION['cobProv'])) { echo 'selected'; } ?> >Omitir</option>
							<?php
								if(isset($_SESSION['cobReg']))
								{
									$arg=array ('id_reg'=>$_SESSION['cobReg']);

							$provincias=listarProvincia($arg);

							for($i=0;$i<count($provincias);$i++)

							{

								?>

							<option <?php if($_SESSION['cobProv']==$provincias [$i] ['id_prov']){ echo "selected"; } ?> value="<?php echo $provincias [$i] ['id_prov']; ?>"><?php echo $provincias [$i] ['nom_prov']; ?></option>
							<?php }
								}
							?>
						
						</select>
					</div>
					<div>
						<label>Comuna</label>
						<select required x-moz-errormessage="Debe seleccionar maxlength="255"  un pais" id="txtComuna" name="txtComuna">
							<option value="0" <?php if(!isset($_SESSION['cobCom'])) { echo 'selected'; } ?> >Omitir</option>
							<?php
							if(isset($_SESSION['cobProv'])) {
							$arg=array ('id_prov'=>$_SESSION['cobProv']);

							$comunas=listarComuna($arg);

							for($i=0;$i<count($comunas);$i++)

							{

								?>

							<option <?php if($_SESSION['cobCom']==$comunas [$i] ['id_com']){ echo " selected "; } ?> value="<?php echo $comunas [$i] ['id_com']; ?>"><?php echo $comunas [$i] ['nom_com']; ?></option>

						<?php }  } ?>
						</select>
					</div>
					<div>
						<input class="boton submit" type="submit" value="Aplicar Filtro">
						<a class="boton cancel" onclick="limpiarCobertura()">Quitar Filtro</a>
					</div>
				</form>
			</div>
			<?php
				require_once('script/function.php');
				$page=explode("/",$pagina);
				$arg=array ('id_est'=>5);
				//filtro por cobertura
				if(isset($_SESSION['cobPais']))
				{
					if($_SESSION['cobPais']!=0)
					{
						$arg['cobertura']=" p.id_pais='".$_SESSION['cobPais']."'";
					}
				}
				if(isset($_SESSION['cobReg']))
				{
					if($_SESSION['cobReg']!=0)
					{
						$arg['cobertura']=" r.id_reg='".$_SESSION['cobReg']."'";
					}
				}
				if(isset($_SESSION['cobProv']))
				{
					if($_SESSION['cobProv']!=0)
					{
						$arg['cobertura']=" pr.id_prov='".$_SESSION['cobProv']."'";
					}
				}
				if(isset($_SESSION['cobCom']))
				{
					if($_SESSION['cobCom']!=0)
					{
						$arg['cobertura']=" c.id_com='".$_SESSION['cobCom']."'";
					}
				}
				//print_r($page);
				if($page[1]!="nada" || $page[1]!="")
				{
					$arg['nom_cat']=$page[1];
				}				if(isset($page[2]))				{
					if($page[2]!="Todos")
					{
						$arg['nom_scat']=$page[2];
					}				}				if(isset($page[3]))
				{
					if($page[3]!="Todos")
					{
						$arg['nom_ts']=$page[3];
					}
				}
				if(isset($page[4]))
				{	
					if($page[4]>1)
					{
						$arg['limit']= 1+($page[4]*10) . "," . ($page[4]+1)*10;
					}
					else
					{
						$arg['limit']= "0, 10";
					}
				}
				else
				{
					$arg['limit']= "0, 10";
				}
				//$servicios=listarServiciosSinDetalle($arg);
				$servicios=listarServiciosSinDetalleFiltroCobertura($arg);
				if(count($servicios)==0)
				{
					?>
					<div class="mensaje informativo">
					<em></em>
					<p>No se encontraros servicios con estas caracteristicas, ¿Deseas ser el primero en ofrecer servicios?</p>
					<a onclick="this.parentNode.remove()">X</a>
					</div>
				<?php
				}
				for($i=0;$i<count($servicios);$i++)
				{
			?>
					<a href="<?php echo WEB_BASE.'detalle/'.$servicios [0] ['nom_ent'].'/'.$servicios [$i] ['nom_serv']; ?>">					<article class="servicios">										<?php						if($servicios [$i] ['desc_img']=="")						{					?>							<img  style="background: url(<?php echo WEB_BASE; ?>script/holder.js/120x95);" src="<?php echo WEB_BASE; ?>imagenes/1x1.png">					<?php						}						else						{					?>	
						<img  style="background: url(<?php echo str_replace(';',"",$servicios[$i]['desc_img']); ?>); background-size: 100% 100%;" src="<?php echo WEB_BASE; ?>imagenes/1x1.png">					<?php						}					?>						<label class="titulo"><?php echo $servicios [$i] ['nom_serv'] . ' de ' . $servicios [$i] ['nom_ent']; ?></label>						<p class="descripcion"><?php echo substr(strip_tags(urldecode($servicios [$i] ['desc_serv'])), 0, 250); ?></p>						<p class="tipo">							<a><?php echo $servicios [$i] ['nom_scat']; ?></a>							<a><?php echo $servicios [$i] ['nom_ts']; ?></a>						<?php							if(isset($_SESSION['rol']))							{								if($_SESSION['rol']>0)								{						?>							<a onclick="agregarAlCarro(<?php echo $servicios [$i] ['id_serv']; ?>)" class="canasta">Agregar a Canasta</a>							<a onclick="agregarAComparacion(<?php echo $servicios [$i] ['id_serv']; ?>)" class="comparar">Agregar a comparacion</a>						<?php								} 							}						?>					</article>				</a>
			<?php } 
			
				$arg=array ('id_est'=>5);
				if($page[1]!="nada" || $page[1]!="")
				{
					$arg['nom_cat']=$page[1];
				}
				if(isset($page[2]))
				{
					if($page[2]!="Todos")
					{
						$arg['nom_scat']=$page[2];
					}
				}
				if(isset($page[3]))
				{
					if($page[3]!="Todos")
					{
						$arg['nom_ts']=$page[3];
					}
				}
				//print_r($arg);
				$paginas = round((listarCantidadServicio($arg)/10+1), 0, PHP_ROUND_HALF_UP);
			?>				<ul class="navegacion">
				<?php 
					for($i=1;$i<$paginas;$i++)
					{
						echo '<li><a ';
						if(isset($page[4]))
						{
							if($page[4]==$i)
							{
								echo ' class="seleccionado" ';
							}
						}
						echo ' href="'.WEB_BASE.'/';
						if(isset($page[2]))
						{
							echo '/'.$page[2];
						}
						else
						{
							echo '/'."Todos";
						}
						if(isset($page[3]))
						{
							echo '/'.$page[3];
						}
						else
						{
							echo '/'."Todos";
						}
						echo '/'.$i.'">'.$i.'</a></li>';
					}
					
				?>
					
				</ul>
			</section>
		<?php cc_footer(); ?>
	</body>
</html>