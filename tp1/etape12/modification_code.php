<?php
session_start();
$dt = new \DateTime();
$db = new SQLite3('tp1.db') ;
if (isset($_POST['data']))
{
    $sql = "UPDATE login SET mdp = '".$_POST['mdp']."',nbr_login=1 WHERE name='".$_SESSION["login"]."'";
    $results = $db->exec($sql);
    header('Location: http://localhost/tp1/index.html');
    
}?> 

<form action="modification_code.php" method="post">
<p> nouveau mot de passe<input type="text" name="mdp" />
</p>
<input type="hidden" name="data" value='1' >
<input type="submit" value="Valider">
</form>

