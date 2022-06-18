<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<h1>EL foro</h1>
	<div class="perfilHeader">

	<?php  if(isset($_SESSION['fotoP']))echo "<img src=".$_SESSION['fotoP'].">"."<br>";if(isset($_SESSION['username']))echo $_SESSION['username']; echo "<br>nivel: "; if($_SESSION['lvl']==0){echo "Invitado";}else{if($_SESSION['lvl']==1){echo "Usuario ";}} ?></div>
	<header class="header">
		<div class="celdas"><a href="index.php?dir=inicio">Inicio</a></div>
		<?php if($_SESSION['lvl']==0): ?><div class="celdas"><a href="index.php?dir=alta">regístrate</a></div><?php endif; ?>
		<?php if($_SESSION['lvl']==0): ?><div class="celdas"><a href="index.php?dir=login">login</a></div><?php endif; ?>
		<?php if($_SESSION['lvl']>0): ?><div class="celdas"><a href="index.php?dir=foro">foro</a></div><?php endif; ?>
		<?php if($_SESSION['lvl']>0): ?><div class="celdas"><a href="index.php?dir=misHilos">mis hilos</a></div><?php endif; ?>
		<?php if($_SESSION['lvl']>0): ?><div class="celdas"><a href="index.php?dir=borrarCuenta">borrarCuenta</a></div><?php endif; ?>
		<?php if($_SESSION['lvl']>0): ?><div class="celdas"><a href="index.php?dir=logoff">finalizar sesion</a></div><?php endif; ?>

		
		
	</header>
	
	<br>
	<br>
	<br>

	
	<?php echo $buffer; ?>



</body>
</html>