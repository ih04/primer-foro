
<?php ob_start(); ?>
<form class="formulario" action="" method="post" >
	<div class="textoHTML">usuario:</div>
	<input class="campo" type="text" name="username">
	<div class="textoHTML">contraseña:</div>
	<input class="campo" type="text" name="contrasena"><br>
	<input class="boton" type="submit" name="send">
</form>
<?php $buffer=ob_get_clean(); include("head.php");?>