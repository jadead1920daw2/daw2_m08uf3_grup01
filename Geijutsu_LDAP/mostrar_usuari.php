 <!-- Formulari per mostrar usuaris-->

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
            
            $usuari = trim($_POST['cn']);
            $r    = ldap_search($ldap_connexio, "dc=fjeclot, dc=net", "cn=" . $usuari);
            
            if ($r) {
                $info = ldap_get_entries($ldap_connexio, $r);
                
                if ($info['count'] == 0) {
                    
                    header('Location: mostrar_usuari_error.php');
                } else {
                    for ($i = 0; $i < $info["count"]; $i++) {
                        echo "<br /><br />";
                        echo "uid: " . $info[$i]["uid"][0] . "<br />";
                        echo "cn: " . $info[$i]["cn"][0] . "<br />";
                        echo "sn: " . $info[$i]["sn"][0] . "<br />";
                        echo "given name: " . $info[$i]["givenname"][0] . "<br />";
                        echo "title: " . $info[$i]["title"][0] . "<br />";
                        echo "telephoneNumber: " . $info[$i]["telephonenumber"][0] . "<br />";
                        echo "mobile: " . $info[$i]["mobile"][0] . "<br />";
                        echo "postaladdress: " . $info[$i]["postaladdress"][0] . "<br />";
                        echo "gidnumber: " . $info[$i]["gidnumber"][0] . "<br />";
                        echo "uidnumber: " . $info[$i]["uidnumber"][0] . "<br />";
                        echo "homedirectory: " . $info[$i]["homedirectory"][0] . "<br />";
                        echo "description: " . $info[$i]["description"][0] . "<br />";
                        echo "<br />";
                        echo "<a href='mostrar_usuari.php'><button class='btn btn-warning'> Neteja dades </button></a>";
                    }
                } 
			}
			   
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
      <title>Mostrar usuari</title>
   </head>
   <body class="p-3 mb-2 bg-dark text-white">
      <div class="container" style="text-align:center;margin-top:50px;">
         <form action="" method=post>
            <p>Nom i cognom: </p>
            <input class="form-control" type=text name=cn>
            <br/>
            <input class="btn btn-warning" type=submit value="Mostrar">
         </form>
      </div>
   </body>
</html>