<?php
session_start();
$dt = new \DateTime();
$db = new SQLite3('../tp1.db') ;
if (isset($_POST['data']))
{
    $sql = "UPDATE login SET mdp = '".$_POST['mdp']."',nbr_login=1 WHERE name='".$_SESSION["login"]."'";
    $results = $db->exec($sql);
    header('Location: http://localhost/tp1/tuto_mvc/index.php');
    
}