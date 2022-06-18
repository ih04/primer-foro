<?php 
	require "../app/libs/bGeneral.php";
	require "../app/libs/utils.php";
	require "../app/Config.php";
	require "../app/Conexion.php";


	class Controlador{
		
		var $errores=[];
		 
		public function inicio(){
			include "plantillas/inicio.php";
		}

		//típico successful
		public function exito(){
			include "plantillas/exito.php";
		}

		//función para invocar la plantilla donde se nos expondrán los hilos disponibles en el foro

		public function foro(){
			if(isset($_REQUEST['hiloNuevo'])){
				header("location:index.php?dir=hiloNuevo");

			}


			include "plantillas/foro.php";
		}


		//esto es una versión de foro, pero de manera que solo saldrán los hilos que hemos subido nosotros "el usuario logueado en ese momento!"
		public function misHilos(){
			if(isset($_REQUEST['hiloNuevo'])){
				header("location:index.php?dir=hiloNuevo");

			}


			include "plantillas/misHilos.php";
		}

		//opción de borrar tu cuenta de la base de datos si estás en ella
		public function borrarCuenta(){
			ob_start();
			if(isset($_REQUEST['send'])){
				if(isset($_REQUEST['check'])){
					$db=Conectate::GetInstance();
					if(isset($_SESSION['idUsr'])){
						$idUsr=$_SESSION['idUsr'];
						if(count($db->insert("update usuario set contrasena='@@@@@@@@@@@234234____',usuario='borrado' where id=$idUsr;")>0)){
							

							header("location:index.php?dir=logoff");


						}else{
							header("location:index.php?dir=error&err=Nan usuario");
						} 
						
					}
					




				}else{
					header("location:index.php?dir=error&err=algo salió mal");
			

			
		}}include("plantillas/borrarCuenta.php");}

		//desde aquí accederemos a los mensajes contenidos en cada hilo
		public function hilo(){
			//en este caso el obstart empieza desde aquí para que los mensajes queden donde nos interesa

			
			if(isset($_REQUEST['idHilo']) && $_REQUEST['idHilo']!=""){
				ob_start();
				$hora=date("H:i:s");
				$fecha=date("Y-m-d");
				$idHilo=$_REQUEST['idHilo']; 

				$db=Conectate::GetInstance();
				$msjs=$db->select("select * from mensaje where id_hilo=$idHilo");
				//print_r($msjs);
				if(count($msjs)>0){
					echo "<h1 class=\"centrar\">".$db->select("select titulo from hilo where id=$idHilo")[0]['titulo']."</h1>";
					foreach($msjs as $m){

					$fotoP=$db->select("select fotoP from usuario where id=".$m['id_user'])[0]['fotoP'];
					$usuario=$db->select("select usuario from usuario where id=".$m['id_user'])[0]['usuario'];
					$fecha=explode("-",$m["fechaPublicacion"]);
					$fecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];
					echo "escrito ".$fecha." a las ".$m['horaPublicacion'];
					echo "<table class=\"mensaje\">"."<tr>"."<td class=\"msjProf\">"."<img src=$fotoP>".$usuario."</td>"."<td class=\"msj\">".$m['mensaje']."</td>"."</tr>"."</table>";
					}
				}else{
					echo "No hay mensajes todavía!";
				}
				

				$mensaje=recoge('mensaje');
				cTextarea($mensaje,'mensaje',$this->errores,500,10);

				if(!isset($_SESSION['idUsr'])){$this->errores['username']="No has iniciado sesión";}else{$idUsr=$_SESSION['idUsr']; }

				include("plantillas/hilo.php");
				if(isset($_REQUEST['send'])){
						if(count($this->errores)>0){
					//echo "errores en bucle if";
					foreach($this->errores as $e){
						echo "<p class='errores'>".$e."</p>";
					}		
					}else{
					if($db->insert("insert into mensaje (`id_user`,`id_hilo`,`mensaje`,`fechaPublicacion`,`horaPublicacion`) values ($idUsr,$idHilo,'$mensaje','$fecha','$hora')")){
						header("location:index.php?dir=hilo&idHilo=$idHilo");
					}else{echo "error";}
					}

				}
				
				

			}else{ob_start();
				echo "algo salió mal!";$buffer=ob_get_clean(); 


				include("plantillas/head.php");
			}
			
			
			
			

		}

		//esto nos llevará a la plantilla para iniciar un hilo, al pinchar en el boton de hilo nuevo del foro, aquí se obliga a poner un mensaje y título para el hilo

		public function hiloNuevo(){
			if(isset($_REQUEST['send'])){
				$mensaje=recoge('mensaje');
				$titulo=recoge('titulo');

				cTextarea($mensaje,'mensaje',$this->errores,500,10);
				cTextarea($titulo,'titulo',$this->errores,50,10);

				if(count($this->errores)>0){
					foreach($this->errores as $e);
					echo "<p class='errores'>".$e."</p>";
				}else{
					$db=Conectate::GetInstance();
					$idusr=$db->select("select id from usuario where usuario='".$_SESSION['username']."'")[0]['id'];

		 
					$hora=date("H:i:s");
					$fecha=date("Y-m-d");



					
					if($db->insert("insert into hilo (`id_user`,`titulo`,`fechaCreacion`,`horaCreacion`) values ('$idusr','$titulo','$fecha','$hora')")>0){

						$idhilo=$db->select("select MAX(`id`) from hilo")[0]["MAX(`id`)"];
						
						if($db->insert("insert into mensaje (`id_user`,`id_hilo`,`mensaje`,`fechaPublicacion`,`horaPublicacion`) values ('$idusr','$idhilo','$mensaje','$fecha','$hora')")>0){
							
							header("location:index.php?dir=hilo&idHilo=$idhilo");

							
						}else{

							header("location:index.php?dir=error&err=algo pasó con el mensaje");
						}

						
					} else{
						header("location:index.php?dir=error&err=algo pasó con el hilo");
					}



				}
			}
			include "plantillas/hiloNuevo.php";
		}

		public function error(){
			include "plantillas/error.php";
		}

		public function logoff(){
			session_destroy();
			header("location:index.php?dir=exito&ex=lamentamos que te bayas");
		}

		public function login(){
			if(isset($_REQUEST['send'])){
				//user y contraseña del formulario
				$username=recoge('username');
				$contrasena=recoge('contrasena');
				$userId;
				//comprobamos si existen en la base de datos
				$db=Conectate::getInstance();
				$instancias=$db->select("Select * from usuario where usuario='$username' AND contrasena='$contrasena'");
				if(count($instancias)>0){
					print_r($instancias);
					echo "procesando... ";
					echo $instancias[0]['usuario'];
					$userId=$instancias[0]["id"];
				}else{
					$this->errores[]="usuario o contraseña incorrectos";
				}

				if(count($this->errores)>0){
					foreach($this->errores as $e){
						echo '<p class="errores">'.$e."</p>";
					}
				}else{
					session_start();
					$_SESSION['username']=$username;
					$_SESSION['contrasena']=$contrasena;

					if(isset($userId))$_SESSION['idUsr']=$userId;
					$_SESSION['fotoP']=$db->select("select fotoP from usuario where id='$userId'")[0]['fotoP'];
					
					$_SESSION['lvl']=1;
					header("location:index.php?dir=exito&ex=welcome again");
				}

			}
			include "plantillas/login.php";
		}

		public function alta(){
			
			if(isset($_REQUEST['send'])){
				
				$db=Conectate::getInstance();
				$username=recoge('username');
				$contrasena=recoge('contrasena');
				$mail=recoge('mail');
				$fotoP="imagenes/fotosP/default.jpg";
				
				
			    if(!(cGeneral($username,'username',$this->errores,"/^([a-z]|[A-Z]|[_]){1}([a-z]|[A-Z]|[_]|[0-9]|[$]|[&]){0,12}$/"))){if(!isset($username)||$username="")$this->errores['username']="el campo usuario es obligatorio";}else
			    
			    	if(count($db->select("select usuario from usuario where usuario='$username'"))>0){$this->errores['usrDup']="este usuario actualmente ya existe en el sistema!";}else{


			    if(!(cGeneral($contrasena,"contrasena",$this->errores,"/^([a-z]|[A-Z]|_|\*|\+|-|\\|\/|[0-9]|\$|&){1,15}$/"))) if(!isset($contrasena) || $contrasena=="")$this->errores['contrasena'].=" el Campo contraseña es obligatorio";

			    if(!cMail($mail,'mail',$this->errores))$this->errores['mail']='El email no ha salido en el formato correcto';



				 
				 if(is_uploaded_file($_FILES['fotoP']['tmp_name'])){
				 	echo $_FILES['fotoP']['tmp_name'];
				 	if(cFot($_FILES['fotoP']['name'],$this->errores)){
				 		$rutafot='imagenes/fotosP/'.$username.".".explode(".",$fotoP=$_FILES['fotoP']['name'])[1];
				 		if(moverFoto('fotoP',$rutafot,$this->errores)){$fotoP=$rutafot;}
				 	}
				 }

				}
				if(count($this->errores)>0){
					foreach($this->errores as $e){
						echo "<p class=\"errores\">"."$e"."</p>";
					}
					
				}else{
					
					
					$hora=date("H:i:s");
					$fecha=date("Y-m-d");
					
					if($db->insert("insert into usuario (`usuario`,`contrasena`,`mail`,`fotoP`,`fechaAlta`) values ('$username','$contrasena','$mail','$fotoP','$fecha')")>0)
					{

						header("location:index.php?dir=exito&ex=bienvenido al foro&loc=inicio");


					}else{header("location:index.php?dir=error"); }
					
				}
				
			}
			
			include "plantillas/alta.php";	
		}

	}

 ?>