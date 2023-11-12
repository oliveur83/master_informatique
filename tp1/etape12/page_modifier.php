<html>
 <head>
  <title>connexion</title>
  <link rel="stylesheet" href="index.css">
 </head>
 <body>
   <h1> modification du cours </h1>

    <form action="enseignant.php" method="post">
    <p>nom<input type="text" name="nom" /></p>
    <p>decription <input type="text" name="descri" /></p>
    <?php
    echo "<input type='hidden' name='id' value='".$_POST['id_cours']."' >";
    ?>
    <input type="submit" value="Valider">
    </form>
 </body>
</html>