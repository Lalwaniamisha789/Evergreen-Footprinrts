<?php
session_start();
session_destroy();
header("Location: /evergreenfootprints/welcome.php");
exit;
?>
