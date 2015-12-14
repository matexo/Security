<?php
    session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <title>Programowanie internetowe</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <META HTTP-EQUIV="Content-Language" CONTENT="pl">
    <META HTTP-EQUIV="Reply-to" CONTENT="oskom@ee.pw.edu.pl">
    <link rel="stylesheet" href="styles/form.css" type="text/css" >
</head>

<body>


<div class="container">
    <form method="post" action="php/login.php">
    <table>
        <tr>
            <td>Login:</td>
            <td><input class="input" type="text" name="login"/></td>
        </tr>
        <tr>
            <td>Hasło:</td>
            <td>
                <input class="input" type="password" name="password"/></br>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <a href="passwordReset.php">Zapomniałeś hasła?</a>
            </td>
        </tr>
        <tr>
            <td colspan="2"> <?php if(isset($_SESSION['loginMessage'])) {echo $_SESSION['loginMessage']; unset($_SESSION['loginMessage']);}?></td>
        </tr>
        <tr>
            <td colspan="2"><input class="submit" type="submit" value="Zaloguj"/></td>
        </tr>
        <tr><td colspan="2"><a href="index.php">Powrót do strony głownej</a></td></tr>
    </table>
    </form>
</div>

</body>
</html>