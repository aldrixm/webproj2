<?php
session_start();

$_SESSION['id'] = $id;





header("Location: dashb.php");
exit();
?>