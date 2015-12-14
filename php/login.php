<?php
require_once "database.php";
require_once "hash.php";
require_once "x.php";

session_start();
sleep(2);
$connection = @new mysqli( $host , $db_user , $db_password , $db_name );

if($connection->connect_errno!=0)
{
    $_SESSION['loginMessage'] = "Error". $connection->connect_errno . $connection->connect_error;
}
else
{
    $login = htmlentities($_POST['login'] , ENT_QUOTES , "UTF-8");
    $password = htmlentities($_POST['password'] , ENT_QUOTES , "UTF-8");

    if( $result = @$connection->query( sprintf(" SELECT * FROM users WHERE login='%s' " ,
                                        mysqli_real_escape_string($connection , $login) ) ))
    {
        if($result->num_rows > 0 )
        {
            $row = $result->fetch_assoc();
            $login = $row['login'];
            $db_password = $row['password'];
            $counter = $row['counter'];
            $timer = $row['timer'];
            $lasttime = $row['time'];
            $time = date(DATE_RFC822);
            $lastbrowser = $row['browser'];
            $browser = getBrowserFingerprint();
            $result->free_result();
            if(time() - $timer >= 30)
                $counter = 0;
            if($counter >= 3)
            {
                $_SESSION['loginMessage'] = "Blokada logowania poczekaj chwilę";
                header('Location: ../signin.php');
                exit;
            }
            if (testPassword($password, $db_password) == true)
            {
                $result = @$connection->query(sprintf("UPDATE users SET counter='%d' , timer='%s'  , time='%s'  ,  lasttime='%s'  , browser='%s' , lbrowser='%s' WHERE login='%s'"
                                                                                , 0  ,     time()  ,    $time  ,     $lasttime , $browser , $lastbrowser ,  $row['login']  ));
                $_SESSION['lasttime'] = $lasttime;
                $_SESSION['lastbrowser'] = $lastbrowser;
                $_SESSION['time'] = $time;
                $_SESSION['browser'] = $browser;
                $_SESSION['logged'] = true;
                $_SESSION['user'] = $login;
                header('Location: ../index.php');
                exit;
            }
            else {
                $counter++;
                $result = @$connection->query(sprintf("UPDATE users SET counter='%d' , timer='%s' WHERE login='%s'" , $counter , time() ,  $row['login']));
            }
        }
        else $_SESSION['loginMessage'] = "Login lub hasło nieprawidłowe";
    }
    $connection->close();
}
header('Location: ../signin.php');
?>