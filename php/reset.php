<?php
include_once 'database.php';
include_once 'hash.php';
session_start();
$connection = @new mysqli( $host , $db_user , $db_password , $db_name );

if($connection->connect_errno!=0)
{
    $_SESSION['userAdderMessage'] = "Error". $connection->connect_errno . $connection->connect_error;
}
else
{
    $token = htmlentities($_POST['token'], ENT_QUOTES , "UTF-8");
    $password = htmlentities($_POST['password'] , ENT_QUOTES , "UTF-8");
    if( $result = @$connection->query( sprintf("SELECT * FROM users WHERE token='$token'" ,
                                        mysqli_real_escape_string($connection , $token) )))
    {
        if($result->num_rows > 0 )
        {
            $row = $result->fetch_assoc();
            $token_time = $row['tokentime'];
            $old_token = $row['token'];
            $result->free_result();
            if( time() - $token_time <= 100 )
                {
                    $token = md5(uniqid(mt_rand(), true));
                    $hashedPassword = hashPassword(mysqli_real_escape_string($connection , $password));
                    $result = @$connection->query(sprintf("UPDATE users SET password = '%s' , token='%s' WHERE token='%s' " , $hashedPassword , $token , $old_token ));
                    $_SESSION['reset'] = "Hasło zostało zrestartowane";
                }
            else $_SESSION['reset'] = "Link wygasł wygeneruj ponownie";
        }
    }
    $connection->close();
}
header('Location: ../restarter.php');
?>