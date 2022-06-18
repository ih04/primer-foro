<?php ob_start(); ?>

<h3>Successfull!....</h3>
<?php  if(isset($_REQUEST['ex']))echo "<h3>".$_REQUEST['ex']."</h3>"; ?>

<?php $buffer=ob_get_clean(); include "head.php"; ?>
