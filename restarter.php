<?php
session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <script type="text/javascript" src="js/formValid.js"></script>
    <title>Programowanie internetowe</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <META HTTP-EQUIV="Content-Language" CONTENT="pl">
    <META HTTP-EQUIV="Reply-to" CONTENT="oskom@ee.pw.edu.pl">
    <link rel="stylesheet" href="styles/form.css" type="text/css" >
    <script type="text/javascript" src="js/passPower.js"></script>

</head>

<body>
<div class="container">
    <form method="post" action="php/reset.php" onsubmit="return validateNewPass(this);">
        <table>
            <tr>
                <td>Nowe hasło:</td>
                <td><input class="input" type="password" name="password" onkeyup="passPower(this.value)"/></td>
                <td><input class="input" type="hidden" name="token" value="<?php echo $_GET['token'] ?>"/></td>
            </tr>
            <tr>
                <td>Powtórz nowe hasło:</td>
                <td><input class="input" type="password" name="password"/></td>
            </tr>
            <tr>
                <td><p id="power"></p></td>
                <td>
                    <div id="passwordStrength" class="strength0"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2"> <?php if(isset($_SESSION['reset'])) {echo $_SESSION['reset']; unset($_SESSION['reset']);}?></td>
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