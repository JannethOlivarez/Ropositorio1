<?php
session_start();
    function logged_in()
    {
        return isset($_SESSION['codigo']);
    }
    function confirmar_logged_in()
    {
        if (!logged_in())
        {
            Redireccionar("LOGIN.php");
        }        
    }

?>