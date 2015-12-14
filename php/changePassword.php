<?php
require_once "database.php";
require_once "hash.php";
session_start();

if(!isset($_SESSION['logged']))
    {
        header('Location: ../index.php');
        exit;
    }

$connection = @new mysqli( $host , $db_user , $db_password , $db_name );

if($connection->connect_errno!=0)
{
    $_SESSION['message'] = "Error". $connection->connect_errno . $connection->connect_error;
}
else
{
    $old_pass = htmlentities($_POST['old_pass'] , ENT_QUOTES , "UTF-8");
    $new_pass = htmlentities($_POST['new_pass'] , ENT_QUOTES , "UTF-8");
    $login = $_SESSION['user'];

    if( $result = @$connection->query(
        sprintf(" SELECT * FROM users WHERE login='%s' " ,
        mysqli_real_escape_string($connection , $login) ) ))
    {
        if($result->num_rows > 0 )
        {
            $row = $result->fetch_assoc();
            $db_old_pass = $row['password'];
            $result->free_result();
            if (testPassword($old_pass, $db_old_pass) == true)
            {
                $new_pass = hashPassword($new_pass);

                if( $result = @$connection->query( sprintf( "UPDATE users SET password = '%s' WHERE login='%s' " ,
                              $new_pass , mysqli_real_escape_string($connection , $login))))
                    $_SESSION['message'] = "Hasło zostało pomyślnie zmienione";
            } else
                $_SESSION['message'] = "Stare hasło jest nieprawidłowe";
        }
    }
    $connection->close();
}
header('Location: ../changePass.php');
?>