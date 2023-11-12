<?php
if(isset($_POST['file']))
{
    //echo $_POST['file'];
    //echo "<img src=".$_POST['file']."  />";

}
 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>coleo2022</title>
</head>
<body>

  <h1> coleo2022 </h1>
  <p> choisir une image pour l'analyser </p>
    <form method="post" action="index.php">
        <div>
            <input type="file" id="file" name="file" multiple>
        </div>
        <div>
            <button>analyser</button>
        </div>
    </form>
    
       
</html>