<?php
    require_once "database.php";
    require_once "hash.php";
    session_start();

    $connection = @new mysqli( $host , $db_user , $db_password , $db_name );

    if($connection->connect_errno!=0)
    {
        $_SESSION['userAdderMessage'] = "Error". $connection->connect_errno . $connection->connect_error; # nie wiem czy tego nie wywalic
    }
    else
    {
        $login = htmlentities($_POST['login'], ENT_QUOTES , "UTF-8");
        $password = htmlentities($_POST['password'], ENT_QUOTES , "UTF-8");
        $email = htmlentities($_POST['email'], ENT_QUOTES , "UTF-8");

        if( $result = @$connection->query(
            sprintf("SELECT * FROM users WHERE login='$login' OR email='$email' " ,
            mysqli_real_escape_string($connection , $login) , mysqli_real_escape_string($connection , $email))))
            {
                if($result->num_rows > 0 )
                {
                    $_SESSION['userAdderMessage'] = "Login lub email jest już zajęty";
                    $result->free_result();
                }
            else
                {
                    $password = hashPassword( $password);
                    $time = time();
                    $token = md5(uniqid(mt_rand(), true));
                    if($connection->query(
                            sprintf("INSERT INTO users(login , password , email , counter , timer , token) VALUES( '%s' , '%s' , '%s' , '%d', '%s' , '%s')" ,
                                mysqli_real_escape_string($connection,$login) , $password , mysqli_real_escape_string($connection,$email) , 0 , $time , $token)
                        ) === TRUE )
                        $_SESSION['userAdderMessage'] = "Konto zostało utworzone pomyślnie.";
                    else
                        $_SESSION['userAdderMessage'] = "Error: " . $sql_adding_query . "<br>" . $connection->error;
                }
            }
        $connection->close();
    }
    header('Location: ../signup.php');
?>