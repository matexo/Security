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
    <form method="post" action="php/sendEmail.php">
        <table>
            <tr>
                <td>E-mail:</td>
                <td><input class="input" type="text" name="email"/></td>
            </tr>
            <tr>
                <td colspan="2"> <?php if(isset($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);}?></td>
            </tr>
            <tr>
                <td colspan="2"><input class="submit" type="submit" value="Zresetuj hasło:"/></td>
            </tr>
            <tr><td colspan="2"><a href="index.php">Powrót do strony głownej</a></td></tr>
        </table>
    </form>
</div>

</body>
</html>