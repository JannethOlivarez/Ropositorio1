<?php

session_start();

function logged_in() {

    return isset($_SESSION['codigo']);
}

function confirmar_logged_in() {
    if (!logged_in()) {
        Redireccionar("/Ecuaforestar/usuarios/login.php");
    }
}
//if (ini_get("session.use_cookies")) 
//{
//  $params = session_get_cookie_params();
//  setcookie(session_name(), '', time() - 42000,
//      $params["path"], $params["domain"],
//      $params["secure"], $params["httponly"]);
//}
?>