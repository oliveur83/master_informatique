<?php
if(isset($_POST['file']))
{
    echo $_POST['file'];
}
 
?>
<html>
 <head>
  <title>connexion</title>
  <link rel="stylesheet" href="index.css">
 </head>
 <body>
   <h1> connexion</h1>

    <form action="form.php" method="post">
    <p>login<input type="text" name="login" /></p>
    <p>mot de passe<input type="text" name="mdp" /></p>
    <input type="hidden" name="page" value='form' >
    <input type="submit" value="Valider">
    </form>
 </body>
</html>
</html>