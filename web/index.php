<?php 
	require_once "../app/Controlador.php";
	
	//utilizaré el enrutamiento para que me cague todas las páginas desde index!

	$fin=array('clase'=>'Controlador','menu'=>'error');
	session_start();
	if(!isset($_SESSION['lvl'])){$_SESSION['lvl']=0;}

	//el parseo de rutas tiene muchas opciónes, la mayoría de ellas tienen plantilla propia pero no todas, algunas sirven para realizar determinadas funciones, lo que si tienen todas es méto2 en el controlador, donde se explicará para que sirve cada uno de ellos!
	$menus=array(
		"inicio"=>array("clase"=>"Controlador","menu"=>"inicio"),
		"alta"=>array("clase"=>"Controlador","menu"=>"alta"),
		"exito"=>array("clase"=>"Controlador","menu"=>"exito"),
		"foro"=>array("clase"=>"Controlador","menu"=>"foro"),
		"misHilos"=>array("clase"=>"Controlador","menu"=>"misHilos"),
		"error"=>array("clase"=>"Controlador","menu"=>"error"),
		"login"=>array("clase"=>"Controlador","menu"=>"login"),
		"hilo"=>array("clase"=>"Controlador","menu"=>"hilo"),
		"hiloNuevo"=>array("clase"=>"Controlador","menu"=>"hiloNuevo"),
		"logoff"=>array("clase"=>"Controlador","menu"=>"logoff"),
		"borrarCuenta"=>array("clase"=>"Controlador","menu"=>"borrarCuenta")
		
		
	);

	if(isset($_GET['dir'])){
		if(isset($menus[$_GET['dir']])){
			$fin=$menus[$_GET['dir']];
		}
	}else{
		$fin=array('clase'=>'Controlador','menu'=>'error');
	}

	//si exíste método parseado llamamos a método parseado, sino....
	if(method_exists($fin['clase'],$fin['menu'])){
		call_user_func(array(new $fin['clase'],$fin['menu']));
	}
		


 ?>	
