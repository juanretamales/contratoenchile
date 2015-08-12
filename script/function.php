<?php
	function cc_contenido($pag)
	{
		require_once "script/transaccion.php";
		$transaccion=new transaccion();
		$page=explode("/",$pag);
		switch($page[0])
		{
			case "servicios":
				$url_pag=$page[0];//es decir quedara como servicio
				break;
			case "in":
				$url_pag=$page[0];//es decir quedara como servicio
				break;
			case "detalle":
				$url_pag=$page[0];//es decir quedara como servicio
				if(!isset($page[2]) && isset($page[1]))
				{	
					$url_pag=$url_pag."/entidad";
				}
				break;
				
			case "administracion":
				$url_pag=$page[0];
				if(isset($page[1]))
				{	
					$url_pag=$url_pag."/".$page[1];
				}
				if(isset($page[2]))
				{
					/*if($page[1]=="servicios")
					{
						$url_pag=$url_pag."/listarServicio";
					}
					else
					{
						$url_pag=$url_pag."/".$page[2];
					}*/
					$url_pag=$url_pag."/".$page[2];
				}
				//http://www.contratoenchile.cl/administracion/seguridad/usuario/modificar
				if(isset($page[3]))
				{
					$url_pag=$url_pag."/".$page[3];
				}
				if(isset($page[4]))
				{
					$url_pag=$url_pag."/".$page[4];
				}
				if(isset($page[5]))
				{
					$url_pag=$url_pag."/".$page[5];
				}
				break;
				
			case "registrarse-paso2":
				$url_pag=$page[0];
				break;
				
			case "recuperar-contrasena":
				$url_pag=$page[0];
				break;
				
			default:
				if(isset($page[0]))
				{
					if($page[0]=="registrar")
					{
						$url_pag=$page[0];
						$page=array ();
					}
					else
					{
						$url_pag=$pag;
					}
				}
				else
				{
					$url_pag=$pag;
				}
				break;
		}
		//echo $url_pag;
		$arg=array ('url_pag'=>$url_pag, 'id_tu'=>$_SESSION['rol']);
		$paginas=$transaccion->listarPagina($arg);
		//print_r($paginas);
		//includes/paginas/panelAdministracion/Comunidad/modificarUsuario.php
		//includes/paginas/panelAdministracion/Comunidad/modificarUsuarios.php
		if(count($paginas)>0)
		{
			if(file_exists($paginas [0] ['url_real']))
			{
				
				include($paginas[0]['url_real']);
				escribirLog($paginas[0]['id_pag'], $pag);
			}
			else
			{
				//echo $paginas [0] ['url_real'];
				//header("Location: http://www.contratoenchile.cl/error-404");
				echo '<script language="javascript">window.location="'.WEB_BASE.'error-404"</script>';
			}
		}
		else
		{	?>
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
						<section id="contenido">
							<div class="mensaje alerta">
							<em></em>
							<p>No se encuentra la pagina. La pagina solicitada no pudo ser encontrada o no cumple los requerimientos para acceder a ella.</p>
							<a onclick="this.parentNode.remove()">X</a>
							</div>
						</section>
					</section>
					<?php cc_footer(); ?>
			</body>
			</html>
		<?php
		}
	}
	
	function cc_head()
	{
		require_once('includes/template/head.php');
	}
	function cc_header()
	{
		require_once('includes/template/header.php');
	}
	function cc_footer()
	{
		require_once('includes/template/footer.php');
	}
	function table_footer()
	{
		echo '<div id="controls">
		<div id="perpage">
			<select onchange="sorter.size(this.value)">
				<option value="1">1</option>
				<option value="5">5</option>
				<option value="10" selected="selected">10</option>
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
			<span>Entradas por pagina</span>
		</div>
		<div id="navigation">
			<img src="'.WEB_BASE.'imagenes/tabla/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
			<img src="'.WEB_BASE.'imagenes/tabla/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
			<img src="'.WEB_BASE.'imagenes/tabla/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
			<img src="'.WEB_BASE.'imagenes/tabla/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
		</div>
		<div id="text">Desplegando pagina <span id="currentpage"></span> de <span id="pagelimit"></span></div>
		<script type="text/javascript" src="'.WEB_BASE.'script/tablas.js"></script>
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
	</div>';
	}
	function cc_menu($pag)
	{
		//print_r($pag);
		//include('includes/template/menu.php');
		$page=explode("/",$pag);
		//print_r($page);
		/*echo '<nav id="menu1" class="menu-panel celular">';
		echo '<ul><li tabindex="1"><span><a href="#" onclick="verMenu()">Ver menu</a></span></li></ul>';
		echo '</nav>';*/
		if($page[0]=="administracion")
		{
			echo '<nav id="menuVertical" class="menu-panel escritorio">';
			//echo '<ul class="item"><li tabindex="1"><span><a href="#" onclick="verMenu()">Volver</a></span></li></ul>';
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
						echo '<li tabindex="'.$i.'" class="crearEmpresa" ><span><a href="'.WEB_BASE.'administracion/registrar/empresa">Crear Empresa</a></span></li>';
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
					echo '<li tabindex="'.$i.'" class="crearEmpresa"><span><a href="'.WEB_BASE.'administracion/registrar/empresa">Crear Empresa</a></span></li>';
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
			echo '<nav id="menuVertical" class="menuprincipal escritorio">';
			echo "<ul>";
			if(isset($page[0])==true && isset($page[1])==false)
			{
				if($page[0]!="servicios")
				{
					$arg=array();
					$categorias=$transaccion->listarCategorias($arg);
					for($i=0;$i<count($categorias);$i++)
					{
						echo '<li><a href="'.WEB_BASE.'servicios/'.$categorias [$i] ['nom_cat'].'/Todos">'.$categorias [$i] ['nom_cat'].'</a></li>';
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
					if(!isset($page[2]))
					{
						$page[2]="Todos";
					}
					if(!isset($page[3]))
					{
						$page[3]="Todos";
					}
					//print_r($subcategorias);
					for($i=0;$i<count($subcategorias);$i++)
					{
						if(isset($page[2]))
						{
							if($page[2]==$subcategorias [$i] ['nom_scat'])
							{
								if(isset($page[3]))
								{
									//echo '<li><a class="menu subcat seleccionado" href="'.WEB_BASE.'servicios/'.$page[1].'/'.$subcategorias[$i]['nom_scat'].'/'.$page[3].'">'.$subcategorias [$i] ['nom_scat'].'</a></li>';
									echo '<li><a class="menu subcat seleccionado" href="'.WEB_BASE.'servicios/'.$page[1].'/Todos/'.$page[3].'">'.$subcategorias [$i] ['nom_scat'].'</a></li>';
								}
								else
								{
									//echo '<li><a class="menu subcat seleccionado" href="'.WEB_BASE.'servicios/'.$page[1].'/'.$subcategorias[$i]['nom_scat'].'/">'.$subcategorias [$i] ['nom_scat'].'</a></li>';
									echo '<li><a class="menu subcat seleccionado" href="'.WEB_BASE.'servicios/'.$page[1].'/Todos/Todos">'.$subcategorias [$i] ['nom_scat'].'</a></li>';
								}							
								continue;
							}
						}
						//echo '<li><a class="menu subcat" href="'.WEB_BASE.'servicios/'.$page[1].'/'.$subcategorias[$i]['nom_scat'].'/">'.$subcategorias [$i] ['nom_scat'].'</a></li>';
						echo '<li><a class="menu subcat" href="'.WEB_BASE.'servicios/'.$page[1].'/'.$subcategorias[$i]['nom_scat'].'/Todos">'.$subcategorias [$i] ['nom_scat'].'</a></li>';
						
					}
					$tp=$transaccion->listarTiposervicio($arg);
					for($i=0;$i<count($tp);$i++)
					{
						if(isset($page[3]))
						{
							if($page[3]==$tp [$i] ['nom_ts'])
							{
								echo '<li><a class="menu subcat seleccionado" href="'.WEB_BASE.'servicios/'.$page[1].'/'.$page[2].'/Todos">'.$tp [$i] ['nom_ts'].'</a></li>';
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
	}
	function cacheServicios($id_serv)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion();
		$habilitado = 'Habilitado';
		$arg['id_serv']=$id_Serv;
		$servicios=listarServiciosSinDetalle($arg);
		$pagna="detalle/".$servicios[0]['nom_ent']."/".$servicios[0]['nom_serv'];
		$archivo="./in/".urlencode($pagna).".php";
		$registro+="<?php ";
		if($servicios[0]['nom_est']==$habilitado)
		{
			/*codigo para guardar cache de servicio*/
			$registro+="$servicios [0] = Array 
			( 
				'id_serv' => 1,
				'nom_serv' => 'hola servicio ',
				'nom_ent' => 'hola empresa ',
				'nom_ts' => 'Solo Presencial ',
				'nom_cat' => 'Belleza ',
				'nom_scat' => 'Cosmetología ',
				'nom_est' => 'Habilitado ',
				'desc_serv' => 'probando metodo',
				'desc_img' => 'http://www.baka-tsuki.org/project/images/2/23/Mushoku3_01.jpg'
			); ";
			$promedio=listarPromedioCalificacionserv($arg);
			$registro+=" $promedio  = Array (";
			for($i=0;$i<count($promedio);$i++)
			{
				$registro+=" Array (
				'id_serv'=>".$promedio [$i] ['id_serv'].",
				'nom_ec'=>".$promedio [$i] ['nom_ec'].",
				'desc_tc'=>".$promedio [$i] ['desc_tc'].",
				'valor'=>".$promedio [$i] ['valor'].")";
				if($i!=count($promedio))
				{
					$registro+=",";
				}
			}
			$registro+="); ";
			$registro+=" ?>";
			$file = fopen($archivo,"w");
			fwrite($file,$registro);
			fclose($file);
		}
		else
		{
			if(file_exists($archivo))
			{
				unlink($archivo);
			}
		}
	}
	function escribirLog($id_pag, $pag)
	{
		/*
		offline
		$registro="";
		$time=time();
		$fecha=date( "Y-m-d H:i:s" , $time);
		$proxy=$_SERVER['REMOTE_ADDR'];
		//$real=$_SERVER['HTTP_X_FORWARDED_FOR'];
		$page=WEB_BASE.$pagina;
		$rol="Visitante";
		$rut="Anonimo";
		if(isset($_SESSION['rol']))
		{
			$rol=$_SESSION['rol'];
		}
		if(isset($_SESSION['rut']))
		{
			$rut=$_SESSION['rut'];
		}
		$archivo= "./log/log_".date( "Y-m-d" , $time).".txt";
		//$registro=$fecha."|".$proxy."|".$real."|".$page."|".$rol."|".$rut."\n";
		$registro="\r\n".$fecha."|".$proxy."|".$page."|".$rol."|".$rut;
		$file = fopen($archivo,"a");
		fwrite($file,$registro);
		fclose($file);
		*/
		require_once "transaccion.php";
		$transaccion=new transaccion();
		$rol="Visitante";
		$rut="Anonimo";
		if(isset($_SESSION['rol']))
		{
			$rol=$_SESSION['rol'];
		}
		if(isset($_SESSION['rut']))
		{
			$rut=$_SESSION['rut'];
		}
		$arg=['ip'=>$_SERVER['REMOTE_ADDR'],'id_pag'=>$id_pag, 'url'=>$pag, 'id_tu'=>$rol, 'usuario'=>$rut];
		$insertar=$transaccion->insertarLog($arg);
	}
	function reemplazarWeb($fecha)
	{
		/*
		[banner]
		[menu]
		*/
	}
	function dateEncode($fecha)
	{
		$date=explode("/",$fecha);
		if(count($date)==3)
		{
			return $date[0].'-'.$date[1].'-'.$date[2];
		}
		return false;
	}
	
	function dateDecode($fecha)
	{
		$date=explode("-",$fecha);
		if(count($date)==3)
		{
			$hora=explode(" ",$date[2]);
			if(count($date)==1)
			{
				return $date[2].'/'.$date[1].'/'.$date[0];
			}
			else
			{
				return $hora[0].'/'.$date[1].'/'.$date[0].' '.$hora[1];
			}
		}
		return false;
	}
	
	function listarCantidadServicio($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarCantidadServicio($arg);
	}
	function listarEntidadPorPersona($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarEntidadPorPersona($arg);
	}
	function contadorVisitas($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->contadorVisitas($arg);
	}
	function listarServiciosSinDetalle($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarServiciosSinDetalle($arg);
	}
	function listarContactosSinDetalle($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarContactosSinDetalle($arg);
	}
	function listarContactosPorAno($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarContactosPorAno($arg);
	}
	function listarContactosPorEstado($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarContactosPorEstado($arg);
	}
	function listarPromedioCalificacionserv($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarPromedioCalificacionserv($arg);
	}
	function listarPaginaEmpresa($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarPaginaEmpresa($arg);
	}
	/*******************************
	* Los listar de transaccion    *
	*******************************/
	
	/**
	* Lista las Calificaciones de Cliente
	*
	* @param array $arg
	* @return array
	*/
	function listarBoleta($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarBoleta($arg);
	}
	function listarAutoridad($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarAutoridad($arg);
	}
	function listarAutoridadDetalle($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarAutoridadDetalle($arg);
	}
	function listarCalificacionclie($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarCalificacionclie($arg);
	}
	/**
	* Lista las Calificaciones de servicios
	*
	* @param array $arg
	* @return array
	*/
	function listarCalificacionserv($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarCalificacionserv($arg);
	}
	/**
	* Lista las Categorias
	*
	* @param array $arg
	* @return array
	*/
	function listarCategorias($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarCategorias($arg);
	}
	/**
	* Lista los Clientes
	*
	* @param array $arg
	* @return array
	*/
	function listarCliente($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarCliente($arg);
	}
	/**
	* Lista las Coberturas
	*
	* @param array $arg
	* @return array
	*/
	function listarCobertura($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarCobertura($arg);
	}
	/**
	* Lista las Comunas
	*
	* @param array $arg
	* @return array
	*/
	function listarComuna($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarComuna($arg);
	}
	/**
	* Lista los Contactos o Contratos
	*
	* @param array $arg
	* @return array
	*/
	function listarContacto($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarContacto($arg);
	}
	/**
	* Lista los Contactos o Contratos
	*
	* @param array $arg
	* @return array
	*/
	function listarResumenContacto($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarResumenContacto($arg);
	}
	/**
	* Lista los Documentos
	*
	* @param array $arg
	* @return array
	*/
	function listarDocumento($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarDocumento($arg);
	}
	/**
	* Lista las Entidades o Empresas
	*
	* @param array $arg
	* @return array
	*/
	function listarEntidad($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarEntidad($arg);
	}
	/**
	* Lista las Escalas de calificacion
	*
	* @param array $arg
	* @return array
	*/
	function listarEscalacal($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarEscalacal($arg);
	}
	/**
	* Lista los estados
	*
	* @param array $arg
	* @return array
	*/
	function listarEstado($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarEstado($arg);
	}
	/**
	* Lista los identificadores
	*
	* @param array $arg
	* @return array
	*/
	function listarItem($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarItem($arg);
	}
	/**
	* Lista los Archivos multimedia registrados
	*
	* @param array $arg
	* @return array
	*/
	function listarMedia($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarMedia($arg);
	}
	/**
	* Lista los mensajes registrados
	*
	* @param array $arg
	* @return array
	*/
	function listarMensajes($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarMensajes($arg);
	}
	
	function listarMenu($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarMenu($arg);
	}
	/**
	* Lista los moderadores
	*
	* @param array $arg
	* @return array
	*/
	function listarModerador($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarModerador($arg);
	}
	/**
	* Lista las paginas
	*
	* @param array $arg
	* @return array
	*/
	function listarPagina($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarPagina($arg);
	}
	/**
	* Lista los paises
	*
	* @param array $arg
	* @return array
	*/
	function listarPais($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarPais($arg);
	}
	/**
	* Lista los permisos
	*
	* @param array $arg
	* @return array
	*/
	function listarPermisos($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarPermisos($arg);
	}
	/**
	* Lista los Persona
	*
	* @param array $arg
	* @return array
	*/
	function listarPersona($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarPersona($arg);
	}
	function listarPlan($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarPlan($arg);
	}
	/**
	* Lista las provincias o ciudades
	*
	* @param array $arg
	* @return array
	*/
	function listarProvincia($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarProvincia($arg);
	}
	/**
	* Lista las regiones
	*
	* @param array $arg
	* @return array
	*/
	function listarRegion($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarRegion($arg);
	}
	/**
	* Lista los servicios asociados a los contratos
	*
	* @param array $arg
	* @return array
	*/
	function listarServcon($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarServcon($arg);
	}
	/**
	* Lista los servicios
	*
	* @param array $arg
	* @return array
	*/
	function listarServicio($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarServicio($arg);
	}
	/**
	* Lista las subcategorias
	*
	* @param array $arg
	* @return array
	*/
	function listarSubcategorias($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarSubcategorias($arg);
	}
	/**
	* Lista los tipo de calificacion
	*
	* @param array $arg
	* @return array
	*/
	function listarTipocal($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarTipocal($arg);
	}
	
	function listarTipocss($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarTipoCss($arg);
	}
	/**
	* Lista los tipo de documentos
	*
	* @param array $arg
	* @return array
	*/
	function listarTipodoc($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarTipodoc($arg);
	}
	/**
	* Lista los tipo de archivos multimedia
	*
	* @param array $arg
	* @return array
	*/
	function listarTipomedia($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarTipomedia($arg);
	}
	/**
	* Lista los tipo de paginas
	*
	* @param array $arg
	* @return array
	*/
	function listarTipopagina($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarTipopagina($arg);
	}
	/**
	* Lista los tipo de servicios
	*
	* @param array $arg
	* @return array
	*/
	function listarTiposervicio($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarTiposervicio($arg);
	}
	/**
	* Lista los tipo de usuarios
	*
	* @param array $arg
	* @return array
	*/
	function listarTipousuario($arg)
	{
		require_once "transaccion.php";
		$transaccion=new transaccion($arg);
		return $transaccion->listarTipousuario($arg);
	}
?>