<!-- Ends the user's session and redirects them to menu page -->
<?php
session_start();
session_destroy();
header("Location: ../html/menu-page.php");
exit();
?>
