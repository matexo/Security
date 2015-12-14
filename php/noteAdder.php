<?php
session_start();
if(!isset($_SESSION['logged']) && $_SESSION['logged'] == true)
{
    header('Location: index.php');
    exit();
}
if( $_POST['token_csrf'] == $_SESSION['token_csrf'])
    {
        $token_time = time() - $_SESSION['token_time'];
        if( $token_time <= 180 )
            {
                #$note = htmlentities($_POST['note'] , ENT_QUOTES , "UTF-8");
                $note = filter_var($_POST['note'], FILTER_SANITIZE_STRING);
                $author = $_SESSION['user'];
                $notes = simplexml_load_file("../notes/note.xml");
                $newNote = $notes->addChild('note');
                $newNote->addChild('message', $note);
                $newNote->addChild('author', $author);
                $notes->asXML("../notes/note.xml");

            }
    }
unset($_SESSION['token_csrf']);
header('Location: ../index.php');
?>
