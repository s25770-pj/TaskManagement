<?php
session_start();

if (isset($_SESSION['logged'])){
    header("Location: ../blog.php");
    exit;
}

require_once '../Config/config.php';
require_once '../Repository/registerRepository.php';

$RegisterRepository = new RegisterRepository($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $second_password = $_POST['second_password'];
    $email = $_POST['email'];

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['second_password'] = $second_password;
    $_SESSION['email'] = $email;

    $validationErrors = [];

    if (empty($username) || empty($password) || empty($second_password) || empty($email)) {
        $validationErrors[] = "Wszystkie pola są wymagane";
    } else {
        if (ctype_alnum($username) === false) {
            $validationErrors[] = "Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
        }

        if (strlen($username) < 6 || strlen($username) > 30) {
            $validationErrors[] = "Login musi składać się z 6 do 30 znaków";
        }

        if ($RegisterRepository->checkIfUsernameExists($username)) {
            $validationErrors[] = "Użytkownik o podanej nazwie już istnieje";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validationErrors[] = "Podany email jest nieprawidłowy";
        }

        if ($RegisterRepository->checkIfEmailExists($email)) {
            $validationErrors[] = "Podany email jest już używany";
        }

        if (strlen($password) < 6 || strlen($password) > 30) {
            $validationErrors[] = "Hasło musi składać się z 6 do 30 znaków";
        }

        if ($password != $second_password) {
            $validationErrors[] = "Hasła nie są takie same";
        }
    }

    if (empty($validationErrors)) {
        if ($RegisterRepository->register($username, $hash_password, $email)) {
            session_destroy();
            header("Location: $index");
            exit;
        } else {
            $validationErrors['registration'] = "Wystąpił błąd podczas rejestracji. Spróbuj ponownie później.";
        }
    }

    $data = [
        'username' => $username,
        'email' => $email,
        'validationErrors' => $validationErrors,
    ];
}
require_once $registerView;
?>
