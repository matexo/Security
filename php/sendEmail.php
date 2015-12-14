<?php
include_once 'database.php';
session_start();
$email = mysqli_real_escape_string($connection , $_POST['email']);

$connection = @new mysqli( $host , $db_user , $db_password , $db_name );

if($connection->connect_errno!=0)
{
    $_SESSION['userAdderMessage'] = "Error". $connection->connect_errno . $connection->connect_error; # nie wiem czy tego nie wywalic
}
else
{
    $email = htmlentities($_POST['email'], ENT_QUOTES , "UTF-8");
    if( $result = @$connection->query(
        sprintf("SELECT * FROM users WHERE email='$email'" ,
                mysqli_real_escape_string($connection , $email) )))
        {
        if($result->num_rows > 0 )
            {
                $token = md5(uniqid(mt_rand(), true));
                $token_time = time();
                $result = @$connection->query(sprintf("UPDATE users SET token='%s' , tokentime ='%d' WHERE email='%s'" , $token , $token_time , $email));
                $to = $email;
                $subject = "Reset hasła";
                $body = "Witaj,\n Oto twój link do generacji nowego hasła: \n https:/localhost/Login/restarter.php?token=$token \n";
                $headers = "From: labochronadanych@gmail.com" . "\r\n";
                mail($to, $subject, $body, $headers);
                $_SESSION['emailError'] = "Email został wysłany na podany adres";
            }
        }
    $connection->close();
    }
header('Location: ../passwordReset.php');
?>