<?php
session_start();


try { // On essaie de faire des choses
 
    if (isset($_SESSION['pseudo']) && isset($_SESSION['id']) && !isset($_POST['chpseudo'])) {
    
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    $errorMessage = $e->getMessage();
    echo $errorMessage;
}
