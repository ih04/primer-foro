<?php ob_start(); ?>
<form class="form" action="index.php?dir=alta" method="POST" enctype="multipart/form-data">
	<div class="textoHTML">*Nombre usuario:</div>
	 <input class="campo" type="text" name="username"><br>
	<div class="textoHTML">*Contraseña:</div> 
	<input class="campo" type="text" name="contrasena"><br>
	<div class="textoHTML">*Email:</div> 
	<input class="campo" type="text" name="mail"><br>
	<div class="textoHTML">foto de perfil:</div> 
	<input type="file" name="fotoP"><br>
		<input class="boton" type="submit" value="send" name="send">
</form>
	los campos marcados con <b class="asterisco errores">*</b> son obligatorios!<br>
	
<?php $buffer= ob_get_clean();
	include "head.php";
 ?>