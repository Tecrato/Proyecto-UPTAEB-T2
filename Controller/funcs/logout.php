<?php
    // Con este codigo de destruye la session
    // No quedara nada
    session_start();
    session_destroy();
    header("Location:login"); // Y pal login
?>