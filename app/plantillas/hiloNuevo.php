<?php ob_start(); ?>


<form action="" method="post" >
	<div class="textoHTML">Titulo del hilo</div>
		<input class="campo"type="text" name="titulo">
	<div class="textoHTML">mensaje</div>
		<textarea class="campoTArea" name="mensaje" placeholder="mensaje aqui"></textarea>
		<input class="boton" type="submit" name="send" value="crear">
</form>



<?php $buffer=ob_get_clean(); include"head.php";?>