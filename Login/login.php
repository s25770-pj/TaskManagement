<?php
session_start();

if (isset($_SESSION['logged'])){
    header("Location: ../index.php");
    exit;
}

require_once '../Config/config.php';
require_once '../Repository/loginRepository.php';

$db = new Database('localhost', 'root', '', 'taskmanagement');
$LoginRepository = new LoginRepository($db);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($LoginRepository->login($username, $password)) {
        header("Location: $index");
        exit;
    } else {
        $error = "Nieprawidłowy login lub hasło";
    }
}
require_once $loginView;
?>
