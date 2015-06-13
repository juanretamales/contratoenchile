<?php
//print_r($pag);
		//include('includes/template/menu.php');
		$pag="";
		if(isset($_REQUEST['pagina']))
		{
			$pag=$_REQUEST['pagina']; 
		}
		$page=explode("/",$pag);
		//print_r($page);
		if($page[0]=="administracion")
		{
			echo '<nav id="menu1" class="menu-panel celular">';
			echo '<ul><li tabindex="1"><span><a href="#" onclick="verMenu()">Ver menu</a></span></li></ul>';
			echo '</nav>';
			echo '<nav id="menu2" class="menu-panel escritorio">';
			echo '<ul class="item"><li tabindex="1"><span><a href="#" onclick="verMenu()">Volver</a></span></li></ul>';
			$i=2;
			
			echo '<ul>';
			//aqui iva el crear empresa
				if(!isset($_SESSION)){
					session_start();
				}
				
				//*****************Vamos a listar las empresas del usuario**************//
				$arg=array ('rut'=>$_SESSION['rut'], 'id_est'=>5);
				require_once "transaccion.php";
				require_once "webConfig.php";
				$transaccion=new transaccion($arg);
				$entidad=$transaccion->listarEntidadPorPersona($arg);
				//print_r($entidad);
				$nom_ent="";
				//print_r($entidad);
				if(count($entidad)!=0)
				{
					if(count($entidad)<MAX_EMPRESAS)
					{
						echo '<li tabindex="'.$i.'"><span><a href="'.WEB_BASE.'administracion/registrar/empresa">Crear Empresa</a></span></li>';
						$i++;
					}
					$empresax='<li>Empresa <select id="ddlEmpresa" onchange="seleccionarEmpresa()">';
					
					if(!isset($_SESSION['empresa']))
					{
						$_SESSION['empresa']=$entidad[0] ['id_ent'];
					}
					$nom_ent=$entidad[0] ['nom_ent'];
					if(count($entidad)==1)
					{
						$empresax = $empresax.'<option value="'.$entidad[0] ['id_ent'].'">'.$entidad[0] ['nom_ent'].'</option>';
					}
					else
					{
						for($j=0;$j<count($entidad);$j++)
						{
							$empresax = $empresax.'<option ';
							if($_SESSION['empresa']==$entidad[$j] ['id_ent'])
							{
								$empresax = $empresax.' selected ';
							}
							$empresax = $empresax.' value="'.$entidad[$j] ['id_ent'].'">'.$entidad[$j] ['nom_ent'].'</option>';
						}
					}
					$empresax = $empresax."</select></li>";
					echo $empresax;
					//echo $_SESSION['empresa'];
				}
				else
				{
					echo '<li tabindex="'.$i.'"><span><a href="'.WEB_BASE.'administracion/registrar/empresa">Crear Empresa</a></span></li>';
					$i++;
				}
				//*****************Fin de listar las empresas del usuario**************//
				
			//aqui termina el crear empresa
			
				$arg=array ('id_tu'=>$_SESSION['rol'], 'nom_menu'=>'Administracion');
				require_once "transaccion.php";
				$transaccion=new transaccion($arg);
				$contenido=$transaccion->listarMenuContenido($arg);
				//*******
				$menu="";
				//print_r($contenido);
				//echo '<p>'.$contenido.'</p>';
				//mostrar la pagina de la empresa
				if($_SESSION['rol']==1)
				{
					echo '<li tabindex="'.$i.'"><span><a href="'.WEB_BASE.'in/'.$nom_ent.'">Pagina de la empresa</a></span>';
					$i++;
				}
				//termino mostrar pagina de la empresa
				
				//recorre el los contenido listarMenuContenido
				for($j=0;$j<count($contenido);$j++)
				{
					
					if($menu!=$contenido [$j] ['nom_tp'])
					{
						$menu=$contenido [$j] ['nom_tp'];
						if($j!=0)
						{
							echo '</ul>';
						}
						echo '<li tabindex="'.$i.'"><span>'.$menu.'</span>';
						echo '<ul>';
						$i++;
					}
					echo '<li><a href="'.WEB_BASE.''.$contenido [$j] ['url_pag'].'">'.$contenido [$j] ['nom_pag'].'</a></li>';
				}
				//cierra la lista 1
				echo '</ul>';
			//$arg=array ('id_tu'=>$_SESSION['rol'], 'nom_menu'=>'Perfil');
			$arg=array ( 'nom_menu'=>'Perfil', 'id_tu'=>$_SESSION['rol']);
			require_once "transaccion.php";
			$transaccion=new transaccion($arg);
			$contenido=$transaccion->listarMenuContenido($arg);
			/*echo "contenido=";
			print_r($contenido);*/
			$menu="";
			for($j=0;$j<count($contenido);$j++)
			{
				
				if($menu!=$contenido [$j] ['nom_tp'])
				{
					$menu=$contenido [$j] ['nom_tp'];
					if($j!=0)
					{
						echo '</ul>';
					}
					echo '<li tabindex="'.$i.'"><span>'.$menu.'</span>';
					echo '<ul>';
					$i++;
				}
				echo '<li><a href="'.WEB_BASE.''.$contenido [$j] ['url_pag'].'">'.$contenido [$j] ['nom_pag'].'</a></li>';
			}
			echo "</ul></nav>";
		}
		else
		{
			require_once "transaccion.php";
			$transaccion=new transaccion($arg);
			$arg=array ();
			echo '<nav id="menuprincipal"><ul>';
			if(isset($page[0])==true && isset($page[1])==false)
			{
				if($page[0]!="servicios")
				{
					$arg=array();
					$categorias=$transaccion->listarCategorias($arg);
					for($i=0;$i<count($categorias);$i++)
					{
						echo '<li><a class="menu" href="'.WEB_BASE.'servicios/'.$categorias [$i] ['nom_cat'].'/Todos">'.$categorias [$i] ['nom_cat'].'</a></li>';
					}
				}
				else
				{
					$arg['nom_cat']=$page[1];
					$categorias=$transaccion->listarCategorias($arg);
					for($i=0;$i<count($categorias);$i++)
					{
						//echo '<li><a style="background: green;" class="myButton" href="'.WEB_BASE.$categorias [$i] ['nom_cat'].'/'.$page[2].'/'.$page[3].'">'.$tp [$i] ['subcategorias'].'</a></li>';
						echo '<li><a class="menu seleccionado" href="'.WEB_BASE.'">'.$categorias [$i] ['nom_cat'].'</a></li>';
					}
					//echo '<li><a style="background: green;" class="myButton" href="http://www.contratoenchile.cl/servicios/'.$page[1].'/'.$page[2].'/">Volver</a></li>';
				}
			}
			else
			{
				$arg['nom_cat']=$page[1];
				$categorias=$transaccion->listarCategorias($arg);
				for($i=0;$i<count($categorias);$i++)
				{
					//echo '<li><a style="background: green;" class="myButton" href="'.WEB_BASE.$categorias [$i] ['nom_cat'].'/'.$page[2].'/'.$page[3].'">'.$tp [$i] ['subcategorias'].'</a></li>';
					echo '<li><a class="menu seleccionado" href="'.WEB_BASE.'">'.$categorias [$i] ['nom_cat'].'</a></li>';
				}
				//echo '<li><a style="background: green;" class="myButton" href="http://www.contratoenchile.cl/servicios/'.$page[1].'/'.$page[2].'/">Volver</a></li>';
			}
			if(isset($page[0])==true && isset($page[1])==true)
			{
				if($page[1]!="" && $page[0]=="servicios")
				{
					
					$arg['nom_cat']=$page[1];
					$categorias=$transaccion->listarCategorias($arg);
					$arg=array('id_cat'=>$categorias[0]['id_cat']);
					//print_r($arg);
					$subcategorias=$transaccion->listarSubcategorias($arg);
					//print_r($subcategorias);
					for($i=0;$i<count($subcategorias);$i++)
					{
						if(isset($page[2]))
						{
							if($page[2]==$subcategorias [$i] ['nom_scat'])
							{
								if(isset($page[3]))
								{
									echo '<li><a class="menu subcat seleccionado" href="'.WEB_BASE.'servicios/'.$page[1].'/'.$subcategorias[$i]['nom_scat'].'/'.$page[3].'">'.$subcategorias [$i] ['nom_scat'].'</a></li>';
								}
								else
								{
									echo '<li><a class="menu subcat seleccionado" href="'.WEB_BASE.'servicios/'.$page[1].'/'.$subcategorias[$i]['nom_scat'].'/">'.$subcategorias [$i] ['nom_scat'].'</a></li>';
								}							
								continue;
							}
						}
						echo '<li><a class="menu subcat" href="'.WEB_BASE.'servicios/'.$page[1].'/'.$subcategorias[$i]['nom_scat'].'/">'.$subcategorias [$i] ['nom_scat'].'</a></li>';
						
					}
					$tp=$transaccion->listarTiposervicio($arg);
					for($i=0;$i<count($tp);$i++)
					{
						if(isset($page[3]))
						{
							if($page[3]==$tp [$i] ['nom_ts'])
							{
								echo '<li><a class="menu subcat seleccionado" href="'.WEB_BASE.'servicios/'.$page[1].'/'.$page[2].'/'.$tp [$i] ['nom_ts'].'">'.$tp [$i] ['nom_ts'].'</a></li>';
								continue;
							}
						}
						echo '<li><a class="menu tipo" href="'.WEB_BASE.'servicios/'.$page[1].'/'.$page[2].'/'.$tp [$i] ['nom_ts'].'">'.$tp [$i] ['nom_ts'].'</a></li>';
					}
				}
			}
			//print_r($categorias);
			
			echo '</ul></nav>';
		}
?>