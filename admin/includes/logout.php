<?php
    if(isset($_REQUEST['sair'])) {
        session_destroy();
        session_unset($_SESSION['usuarioblog']);
        session_unset($_SESSION['senhablog']);   
        header("Location: index.php");
    }
?>