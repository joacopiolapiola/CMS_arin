<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
 <head>
   <title>Ingreso usuario - E.S.E.T N°4 de Berazategui - Plataforma 4.0 </title>
   <meta charset="utf-8">
   <link href="style.css" rel="stylesheet">
 </head>
 <body>
 <div class="container">
 <h2>Ingreso de Usuario</h2>
        
        <form method="get" action="">
        <table>
                <div class="form-group">
                        <tr>     
                        <div class="form-group">
                                <td>e-mail:</td> 
                                <td><input type="text" name="login_username" id="login_username" /></td>
                        </div>        
                        </tr>       
                        <tr>         
                                <td>Contraseña:</td>
                                <td><input type="password" name="login_userpass" id="login_userpass" /></td>
                        </tr>    
                        <tr>
                        
                                <td> <button id="login_userbttn">Ingresar</button></td>
                        </tr>      
                </div> 
        </table> 
        </form>
 </div>
 </body>  
 </html>