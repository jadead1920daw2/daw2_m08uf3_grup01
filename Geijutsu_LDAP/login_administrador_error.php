<!-- Error de connexió amb el servidor openLDAP -->

<html lang="ca">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <title>Error de login</title>
   </head>
   <body class="p-3 mb-2 bg-dark text-white">
      <div class="container" style="text-align:center;margin-top:50px;">
         <?php
            echo "No s'ha pogut establir una connexió amb el servidor openLDAP o ha fallat el LDAP bind";
            echo "<br><br>";
            echo "<a href='index.html'><button class='btn btn-warning'> Tornar enrere </button></a>";
         ?>
      </div>
   </body>
</html>
