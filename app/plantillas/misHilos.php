<?php ob_start(); ?>

<
<div class="foro" name="divHilos"></form>
	<?php 
		$db=Conectate::GetInstance();
		$instancias=$db->select("select * from hilo where id_user=$_SESSION[idUsr]");
		 
		
		if(count($instancias)>0){
			
			echo "<table>";
				echo "<tr>";
					echo "<th>";
						echo "<i>"."titulo"."</i>";
					echo "</th>";
					echo "<th>";
						echo "<i>"."fecha"."</i>";
					echo "</th>";
					echo "<th>";
						echo "<i>"."hora"."</i>";
					echo "</th>";
					echo "<th>";
						echo "<i>"."autor"."</i>";
					echo "</th>";
					echo "<th>";
						echo "<i>"."descripción"."</i>";
					echo "</th>";
				echo "</tr>";

				 foreach($instancias as $i){ 
				 	 $idHilo=$i["id"];
					if(count($db->select("select mensaje from mensaje where id_hilo='$idHilo'"))>0){$descripcion=$db->select("select mensaje from mensaje where id_hilo='$idHilo'")[0]['mensaje'];}else{$descripcion="sin mensajes";}
				echo "<tr>";
					
					echo "<td>";
						 echo "<a class='titulo' href='index.php?dir=hilo&idHilo=".$i['id']."'>".$i['titulo']." "."</a>"; 
					echo "</td>";
					echo "<td>";
						 echo "<div class='titulo' >".$i['fechaCreacion']." "."</div>"; 
					echo "</td>";
					echo "<td>";
						 echo "<div class='titulo' >".$i['horaCreacion']." "."</div>"; 
					echo "</td>";
					echo "<td>";
						 echo "<div class='titulo'>".$db->select("select usuario from usuario where id=$i[id_user]")[0]['usuario']." "."</div>"; 
					echo "</td>";
					echo "<td>";
						 echo "<b class='titulo'> $descripcion </b>"; 
					echo "</td>";
						
				echo "</tr>";
				 } 


			echo "</table>";
					
		}else{
			echo "<p class='parrafo'>Todavía no has publicado ningún hilo</p>";
		}

	 ?>
	
</div>

<?php $buffer=ob_get_clean(); include("head.php"); ?>