<?php
if(isset($_POST['file']))
{
    echo $_POST['file'];
}
 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form method="post" action="index.php">

        <div>
          <label for="file">Sélectionner le fichier à envoyer</label>
          <input type="file" id="file" name="file" multiple>
        </div>
        <div>
          <button>Envoyer</button>
        </div>
       </form>
       
</html>