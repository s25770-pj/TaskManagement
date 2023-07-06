<?php
session_start();
require_once '../Config/config.php';

if (isset($_SESSION['logged'])){
    header("Location: ../blog.php");
    exit;

    require_once $myOwnListView;

}