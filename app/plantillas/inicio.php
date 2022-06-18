<?php ob_start(); ?>
<h1>Bienvenido a EL foro</h1>
<br>
<h2>reglas del foro</h2>
<ol>
	<li>1</li>
	<li>2</li>
	<li>3...</li>
</ol>


<?php $buffer = ob_get_clean();  include "head.php";?>
