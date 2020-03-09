<!-- Formulari per modificar usuaris -->

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
            $gid  = trim($_POST['gidNumber']);
            $uid  = trim($_POST['uidNumber']);
            
            if ($uid != NULL && $gid != NULL) {
                $info["gidnumber"] = $gid;
                $info["uidnumber"] = $uid;
                
                $dn = "cn=" . $usuari . ",dc=fjeclot,dc=net";
                
                $r = ldap_modify($ldap_connexio, "$dn", $info);
            }
            
            if ($uid == NULL && $gid != NULL) {
                $info["gidnumber"] = $gid;
                
                
                $dn = "cn=" . $usuari . ",dc=fjeclot,dc=net";
                
                $r = ldap_modify($ldap_connexio, "$dn", $info);
            }
            
            if ($gid == NULL && $uid != NULL) {
                $info["uidnumber"] = $uid;
                
                
                $dn = "cn=" . $usuari . ",dc=fjeclot,dc=net";
                
                $r = ldap_modify($ldap_connexio, "$dn", $info);
            }
            if ($r) {
                echo "usuari modificat";
            }
            
            else {
                echo "usuari no modificat";
            }
            ldap_close($ldap_connexio);
        } else {
            header('Location: login_administrador_error.php');
        }
        
    }
    
}
?>

<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <!-- Estil del lloc web utilitzant Bootstrap -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <title>Modificar usuari</title>
   </head>
   <body class="p-3 mb-2 bg-dark text-white">
      <div class="container" style="text-align:center;margin-top:50px;">
         <form action="" method=post>
            <p>Nom i cognom: </p>
            <input class="form-control" type=text name=cn>
            <br>
            <p>uidnumber: </p>
            <input class="form-control" type=text name=uidNumber>
            <br>
            <p>gidnumber: </p>
            <input class="form-control" type=text name=gidNumber>
            <br>
            <input class="btn btn-warning"  type=submit value="Modificar">
         </form>
      </div>
   </body>
</html>