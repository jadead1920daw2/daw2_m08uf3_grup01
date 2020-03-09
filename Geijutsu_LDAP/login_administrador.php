<!-- Formulari d'inici per accedir com a administrador -->

<?php
	echo "<a href='index.html'><button class='btn btn-warning'> Inici </button></a>";
?>

<?php
session_start(); // Inicem sessió
if (isset($_POST['password'])) {
    
    $ldap_localhost  = "ldap://localhost";
    $ldap_contrasenya  = trim($_POST['password']); // Elimina espais en blanc de l'inici i el final de la cadena
    $ldap_administrador = "cn=admin,dc=fjeclot,dc=net";
    
    $ldap_connexio = ldap_connect($ldap_localhost) or die(header('Location: login_administrador_error.php')); // Obre una connexió amb el servidor LDAP
    
    ldap_set_option($ldap_connexio, LDAP_OPT_PROTOCOL_VERSION, 3);
    
    if ($ldap_connexio) {
        
        $ldapbind = ldap_bind($ldap_connexio, $ldap_administrador, $ldap_contrasenya); // Autenticació amb el servidor LDAP
        
        // Verificació de l'enllaç
        if ($ldapbind) {
            echo header('Location: control_admin.php');
        } else {
            header('Location: login_administrador_error.php');
        }
    }
}
?>

<html lang="ca">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <!-- Estil del lloc web utilitzant Bootstrap -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <title>Pàgina d'indentificació de l'usuari del qual es volen mostrar dades</title>
   </head>
   <body class="p-3 mb-2 bg-dark text-white">
      <div class="container" style="text-align:center;margin-top:150px;">
         <form action=login_administrador.php method=post>
            <h1 style="text-align:center">USUARI PER MOSTRAR LES SEVES DADES</h1>
            <br>	
            <div class="table" cellspacing=3 cellpadding=3 align="center">
               <p colspan=2 align="center"> Contrasenya de l'administrador:</p>
               <input class="form-control" type=password name=password>
               <p colspan=2 align="center"><input class="btn btn-warning mt-3" type=submit value="Accedir"></p>
            </div>
         </form>
      </div>
   </body>
</html>

