<?php
    session_start();
    session_destroy(); //apaga todas as posições criadas na variável acesso
    header("Location: login.php");
?>