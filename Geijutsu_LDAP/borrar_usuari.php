 <!-- Formulari per esborrar usuaris -->

<?php
	echo "<a href='control_admin.php'><button class='btn btn-warning'> Tornar enrere </button></a>";
?>

<?php

if (isset($_POST['cn'])) {
    $ldap_localhost  = "ldap://localhost";
    $ldap_contrasenya  = "fjeclot";
    $ldap_administrador = "cn=admin,dc=fjeclot,dc=net";
    
    
    $ldap_connexio = ldap_connect($ldap_localhost) or die(header('Location: login_administrador_error.php'));
    
    ldap_set_option($ldap_connexio, LDAP_OPT_PROTOCOL_VERSION, 3);
    
    if ($ldap_connexio) {
        
        $ldapbind = ldap_bind($ldap_connexio, $ldap_administrador, $ldap_contrasenya);
        
        if ($ldapbind) {
            
            $r = ldap_delete($ldap_connexio, "cn=" . trim($_POST['cn']) . ", dc=fjeclot, dc=net");
            
            if ($r) {
                header('Location: borrar_usuari_correcte.php');
            }
            
            else {
                header('Location: borrar_usuari_error.php');
            }
            ldap_close($ldap_connexio); // Tanquem connexió
        } else {
            header('Location: login_administrador_error.php');
        }
        
    }
    
}
?>

<html lang="ca">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" type="text/css" href="crear_usuari.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <title>Borrar usuari</title>
   </head>
   <body class="p-3 mb-2 bg-dark text-white">
      <div class="centrar">
         <form action=borrar_usuari.php method=post>
            <div class="form-group row">
               <div class="col-xs-6">
                  <label for="cn">Nom i cognom:</label>
                  <input class="form-control" type=text name=cn id=cn>
               </div>
               <br>
            </div>
            <input class="btn btn-warning" type=submit value="Esborrar">
         </form>
         <br>
      </div>
   </body>
</html>