<?php 
require_once '../Config/path.php';

session_start();

// if (!isset($_SESSION['logged'])) {
//     header("Location: $index");
//     exit;
// }
unset($_SESSION['logged']);

session_destroy();
    
header("Location: $index");
exit;
	
