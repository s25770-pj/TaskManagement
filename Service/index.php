<?php
session_start();

require_once '../Config/config.php';

$db = new Database('localhost', 'root', '', 'blog');
if(isset($_SESSION['logged'])) {
?>
<a href = "<?php echo $logout?>">logout</a>
<?php } ?>
<a href = "<?php echo $login?>">Login</a>
<a href = "<?php echo $register?>">Register</a>
<a href = "<?php echo $myPropositions?>">myPropositions</a>
<a href = "<?php echo $myOwnList?>">myOwnList</a>
<?php
require_once $indexView;
?>