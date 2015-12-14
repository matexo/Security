<?php session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <title>Programowanie internetowe</title>
    <script type="text/javascript" src="js/formValid.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <META HTTP-EQUIV="Content-Language" CONTENT="pl">
    <META NAME="Description" CONTENT="Projekty">
    <META NAME="Keywords" CONTENT="PI , programowanie , internetowe">
    <META NAME="Author" CONTENT="Ośko Mateusz">
    <META HTTP-EQUIV="Reply-to" CONTENT="oskom@ee.pw.edu.pl">
    <link rel="stylesheet" href="styles/form.css" type="text/css" >
</head>

<body>

<div class="container">
    <form method="post" action="php/userAdder.php" onsubmit="return validate(this);">
        <table>
            <tr>
                <td>Login</td>
                <td><input class="input" type="text" name="login" onkeypress="return noNumbers(event);" /></td>
            </tr>
            <tr>
                <td>Hasło:</td>
                <td>
                    <input class="input" type="password" onkeyup="passPower(this.value)"  name="password"/>
                </td>
            </tr>

            <tr>
                <td><p id="power"></p></td>
                <td>
                    <div id="passwordStrength" class="strength0"></div>
                </td>
            </tr>


            <tr>
                <td>Powtórz hasło:</td>
                <td><input class="input" type="password" name="reppassword" onkeyup="return samePasswd(this.value)"/></td>
            </tr>
            <tr>
                <td></td>
                <td><p id="errorPasswd"></p></td>
            </tr>
            <tr>
                <td>E-mail:</td>
                <td><input class="input" type="text" name="email" /></td>
            </tr>
            <tr>
                <td colspan="2"> <?php if(isset($_SESSION['userAdderMessage'])) {echo $_SESSION['userAdderMessage']; unset($_SESSION['userAdderMessage']);}?></td>
            </tr>

            <tr>
                <td colspan="2"><input class="submit" type="submit" value="Zarejestruj"/></td>
            </tr>
            <tr><td colspan="2"><a href="index.php">Powrót do strony głownej</a></td></tr>
        </table>
    </form>
</div>

</body>
</html>
