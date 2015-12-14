<?php
session_start();
if(!isset($_SESSION['logged']) && $_SESSION['logged'] == true)
{
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <title>Programowanie internetowe</title>
    <script type="text/javascript" src="js/formValid.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <META HTTP-EQUIV="Content-Language" CONTENT="pl">
    <META HTTP-EQUIV="Reply-to" CONTENT="oskom@ee.pw.edu.pl">
    <link rel="stylesheet" href="styles/form.css" type="text/css" >
    <script type="text/javascript" src="js/passPower.js"></script>
</head>

<body>
<div class="container">
    <form method="post" action="php/changePassword.php" onsubmit="return validateNewPasswd(this);">
        <table>
            <tr>
                <td>Stare hasło:</td>
                <td><input class="input" type="password" name="old_pass"/></td>
            </tr>
            <tr>
                <td>Nowe hasło:</td>
                <td>
                    <input class="input" type="password" name="new_pass" onkeyup="passPower(this.value)"/></br>
                </td>
            </tr>
            <tr>
                <td>Powtórz nowe hasło:</td>
                <td>
                    <input class="input" type="password" name="new_pass_re"/></br>
                </td>
            </tr>

            <tr>
                <td><p id="power"></p></td>
                <td>
                    <div id="passwordStrength" class="strength0"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2"> <?php if(isset($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);}?></td>
            </tr>
            <tr>
                <td colspan="2"><input class="submit" type="submit" value="Zmień hasło:"/></td>
            </tr>
            <tr><td colspan="2"><a href="index.php">Powrót do strony głownej</a></td></tr>
        </table>
    </form>
</div>

</body>
</html>