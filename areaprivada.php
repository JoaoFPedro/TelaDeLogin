<?php
//Inicio da seassao privara - verificando credencias
    session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("location: index.php");
        exit;
    }

?>
<a href="sair.php"> SAIR </a>


YOU HAVE THE KEY, CONGRATZZ!!

