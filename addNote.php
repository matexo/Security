<?php
session_start();
if(!isset($_SESSION['logged']) && $_SESSION['logged'] == true)
{
    header('Location: index.php');
    exit();
}
if (!isset($_SESSION['token_csrf']))
    {
        $token = sha1(uniqid(rand() , true));
        $_SESSION['token_csrf'] = $token;
        $_SESSION['token_time'] = time();
    }
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
    <form method="post" action="php/noteAdder.php">
        <table>
            <tr>
                <td>
                Notatka:
                </td>
            </tr>
            <tr>
                <td>
                    <textarea class="message" placeholder="Treść notatki" name="note"></textarea>
                    <input type="hidden" name="token_csrf" value="<?php echo $token; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <input class="submit" type="submit">
                </td>
            </tr>
        </table>
    </form>

</div>

</body>
</html>