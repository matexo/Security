<?php
session_start();
if(!isset($_SESSION['logged']))
{
    header('Location: ../index.php');
    exit;
}
session_destroy();
header('Location: ../index.php');
?>