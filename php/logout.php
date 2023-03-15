<?php
    require_once "session.php";
    session_destroy();
    unset($_SESSION['connect']);
    unset($_SESSION['utente']);
    header('location:../html/index.html');
?>