
<?php
// Iniciar procesamiento de formulario
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <script scr="js/jquery.js"></script>
        <script scr="js/jquery.1.11.2.min.js"></script>
        <script scr="../includes/diseno/js/jquery.1.11.2.min.js"></script>
        <script scr="../includes/diseno/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="../includes/diseno/css/bootstrap.min.css">
        <link rel="stylesheet" href="../includes/diseno/css/estilos.css">
        <link rel="stylesheet" href="../includes/diseno/css/login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>﻿
    </head>
    <body>

        <!--        <div  class="container">
                    <img class="img-responsive logo" alt="Imagen responsive" src="../imagenes/imagen1.png"/>
                  
                    <div class="modal-dialog">
                        <div class="loginmodal-container">
                             <h1>Identifíquese!!</h1><br>
                            <form  action="../includes/logear.php" method="post" >
                                <input type="text" name="usuario" maxlength="30" value="" required="true" placeholder="Usuario" autocomplete="off" />
        
                                <input type="password" name="contrasena" placeholder="Password" maxlength="30" value="" required="true" />
        
                                <input class="login loginmodal-submit" type="submit" name="submit" value="Acceder" />
                            </form>
        
                            <div class="login-help">
                                <a href="#">Register</a> - <a href="#">Forgot Password</a>
                            </div>
                        </div>
                    </div>
        
                </div>-->
        <div class="container">
            <section class="login-form">
                <form action="../includes/logear.php" method="post" role="login">
                    <img class="img-responsive logo" alt="Imagen responsive" src="../imagenes/imagen1.png"/>
                    <input type="text" name="usuario" placeholder="Usuario" required class="form-control input-lg"  />

                    <input type="password" class="form-control input-lg" name="contrasena" id="password" placeholder="Contraseña" required />


                    <div class="pwstrength_viewport_progress"></div>


                    <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Ingresar</button>


                </form>

                <div class="form-links">
                    <a href="#">www.website.com</a>
                </div>
            </section> 
        </div>

    </body>
</html>

