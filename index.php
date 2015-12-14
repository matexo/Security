<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <title>Programowanie internetowe</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <META HTTP-EQUIV="Content-Language" CONTENT="pl">
    <META HTTP-EQUIV="Reply-to" CONTENT="oskom@ee.pw.edu.pl">
    <link rel="stylesheet" href="styles/style.css" type="text/css" >
</head>

<body>
<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    echo "Witaj ";
    echo $_SESSION['user'];
    echo '</br>';
    echo "Aktualna data logowania: ";
    echo $_SESSION['time'];
    echo '</br>';
    echo $_SESSION['browser'];
    echo '</br>';
    echo "Ostatnia data logowania: ";
    echo $_SESSION['lasttime'];
    echo '</br>';
    echo $_SESSION['lastbrowser'];
    echo '</br>';
    if(strcmp($_SESSION['browser'] , $_SESSION['lastbrowser']) != 0) echo "<p style='color: #ff0000'>Twoje ostatnie logowanie było z innej przeglądarki</p>";


}
?>
<div class="container">
    <div class="menuContainer">
        <?php
        if(isset($_SESSION['logged']) && $_SESSION['logged'] == true)
            {
                echo    '<div class="button">';
                echo    '<a href="addNote.php">Dodaj wiadomość</a>';
                echo    '</div>';
                echo    '<div class="button">';
                echo    '<a href="changePass.php">Zmień hasło</a>';
                echo    '</div>';
                echo    '<div class="button">';
                echo    '<a href="php/logout.php">Wyloguj</a>';
                echo    '</div>';
            }
        else {
                echo '<div class="button">';
                echo '<a href="signin.php">Logowanie</a>';
                echo '</div>';
                echo '<div class="button">';
                echo '<a href="signup.php">Zarejestruj</a>';
                echo '</div>';
        }
        ?>
    </div>
    <div class="clear"></div>
    <div class="text">

        <?php
        $notes=simplexml_load_file("notes/note.xml");
        foreach($notes->children() as $note)
            {
            echo '<div class="textBox">';
            echo  $note->message;
            echo  '<div class="textAuthor" >';
            echo $note->author;
            echo '</div > </div >';
            }
        ?>
    </div>
</div>

</body>
</html>