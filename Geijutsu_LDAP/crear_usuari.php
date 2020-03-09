<!-- Formulari de creació d'un nou usuari -->

<?php
	echo "<a href='control_admin.php'><button class='btn btn-warning'> Tornar enrere </button></a>";
?>

<?php

if (isset($_POST['uid']) && ($_POST['nom']) && ($_POST['cognom']) && ($_POST['givenName']) && ($_POST['title']) && ($_POST['telephoneNumber']) && ($_POST['mobile']) && ($_POST['postalAddress']) && ($_POST['gidNumber']) && ($_POST['uidNumber']) && ($_POST['description'])) {
    $ldap_localhost  = "ldap://localhost";
    $ldap_contrasenya  = "fjeclot";
    $ldap_administrador = "cn=admin,dc=fjeclot,dc=net";
    
    $ldap_connexio = ldap_connect($ldap_localhost) or die(header('Location: login_administrador_error.php'));
    
    ldap_set_option($ldap_connexio, LDAP_OPT_PROTOCOL_VERSION, 3);
    
    if ($ldap_connexio) {
        
        $ldapbind = ldap_bind($ldap_connexio, $ldap_administrador, $ldap_contrasenya);
        
        if ($ldapbind) {
            
            $info["objectclass"][0] = 'top';
            $info["objectclass"][1] = 'person';
            $info["objectclass"][2] = 'organizationalPerson';
            $info["objectclass"][3] = 'inetOrgPerson';
            $info["objectclass"][4] = 'posixAccount';
            $info["objectclass"][5] = 'shadowAccount';
            $info["uid"]            = trim($_POST['uid']);
            $info["cn"]             = $_POST['nom'] . " " . $_POST['cognom'];
            $info["sn"]             = trim($_POST['cognom']);
            $info["givenName"]       = trim($_POST['givenName']);
            $info["title"]           = trim($_POST['title']);
            $info["telephoneNumber"] = trim($_POST['telephoneNumber']);
            $info["mobile"]          = trim($_POST['mobile']);
            $info["postalAddress"]   = trim($_POST['postalAddress']);
            $info["loginshell"]      = '/bin/bash';
            $info["gidnumber"]       = trim($_POST['gidNumber']);
            $info["uidnumber"]       = trim($_POST['uidNumber']);
            $info["homedirectory"]   = "/home/" . trim($_POST['uid']) . "/";
            $info["description"]     = trim($_POST['description']);
            
            $dn = "cn=" . trim($_POST['nom']) . " " . trim($_POST['cognom']) . ",dc=fjeclot,dc=net";
            
            // Afegir dades al directori
            $r  = ldap_add($ldap_connexio, "$dn", $info);
            
            if ($r) {
                header('Location: crear_usuari_correcte.php');
                
            }
            
            else {
                header('Location: crear_usuari_error.php');
            }

            // Tanquem connexió amb LDAP
            ldap_close($ldap_connexio);
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
      
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" type="text/css" href="crear_usuari.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <title>Creació usuari</title>
   </head>
   <body class="p-3 mb-2 bg-dark text-white">
      <div class="centrar">
         <form action='' method=post>
            <div class="form-group row">
               <div class="col-xs-6">
                  <label for="uid">UID</label>
                  <input class="form-control" type=text name=uid id=uid>
               </div>
               <div class="col-xs-6">
                  <label for="nom">NOM</label>
                  <input class="form-control" type=text name=nom id=nom>
               </div>
               <div class="col-xs-6">
                  <label for="cognom">COGNOM</label>
                  <input class="form-control" type=text name=cognom id=cognom>
               </div>
               <div class="col-xs-6">
                  <label for="givenName">NOM COMPLET</label>
                  <input class="form-control" type=text name=givenName id=givenName>
               </div>
               <div class="col-xs-6">
                  <label for="title">TÍTOL</label>
                  <input class="form-control" type=text name=title id=title>
               </div>
               <div class="col-xs-6">
                  <label for="telephoneNumber">TELÈFON</label>
                  <input class="form-control" type=text name=telephoneNumber id=telephoneNumber>
               </div>
               <div class="col-xs-6">
                  <label for="mobile">MÒBIL</label>
                  <input class="form-control" type=text name=mobile id=mobile>
               </div>
               <div class="col-xs-6">
                  <label for="postalAddress">ADREÇA</label>
                  <input class="form-control" type=text name=postalAddress id=postalAddress>
               </div>
               <div class="col-xs-6">
                  <label for="gidNumber">NUMERO GID</label>
                  <input class="form-control" type=text name=gidNumber id=gidNumber>
               </div>
               <div class="col-xs-6">
                  <label for="uidNumber">NUMERO UID</label>
                  <input class="form-control" type=text name=uidNumber id=uidNumber>
               </div>
               <div class="col-xs-6">
                  <label for="description">DESCRIPCIÓ</label>
                  <input class="form-control" type=text name=description id=description>
               </div>
            </div>
            <input class="btn btn-warning" type=submit value="Crear">
         </form>
         <br>
      </div>
   </body>
</html>