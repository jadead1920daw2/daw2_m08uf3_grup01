 <!-- HTML que mostra les diferents accions que podem dur a terme com a administradors -->

<?php
   echo "<a href='login_administrador.php'><button class='btn btn-warning'> Login </button></a>";
?>

<html lang="ca">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <!-- Estil del lloc web utilitzant Bootstrap -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
              integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <title>Prova d'accés al servei de directori LDAP amb PHP</title>
   </head>
   <body class="p-3 mb-2 bg-dark text-white">
      <div class="container" style="text-align:center;margin-top:150px;">
         <h1>Control de les dades de l'usuari</h1>
         <br />
         <a href='crear_usuari.php'> <button style="margin-bottom:20px;" class="btn btn-warning"> Crear Usuari </button></a><br/>
         <a href='borrar_usuari.php'> <button style="margin-bottom:20px;" class="btn btn-warning"> Esborrar Usuari </button></a><br/>
         <a href='mostrar_usuari.php'> <button style="margin-bottom:20px;" class="btn btn-warning"> Mostrar Dades Usuari </button></a><br/>
         <a href='modificar_usuari.php'> <button style="margin-bottom:20px;" class="btn btn-warning">  Modificar Dades Usuari </button></a>
      </div>
   </body>
</html>
