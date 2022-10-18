<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
$_SESSION["login"]=$_POST['login'];
$_SESSION["nbr"]=0;

?> 
<html>
<link rel="stylesheet" href="index.css">
</html>
<?php
// verifier le login et mdp
$db = new SQLite3('tp1.db') ;
$result = $db->query('SELECT * FROM login');
$var=False;
$role="toto";

while ($row=$result->fetchArray(SQLITE3_ASSOC ))
{ 
    if ($row['name']==$_POST['login'] && $row['mdp']==$_POST['mdp'])
        {
            $_SESSION["id_login"]=$row['id_log'];
            echo $row['mdp'];
            echo $row['role'];
            $var=TRUE;
            $_SESSION["nbr"]=$row['nbr_login'];
            $role=$row['role'];
        }
    
}

if (empty($_POST['login']))
{
    echo "ERREUR : le champ login est vide ";
}
// se connecter a admin 
elseif($_POST['login']=='admin' && $_POST['mdp']=='admin')
{
    
    header('Location: http://localhost/tp1/admin.php');
    exit();
}
elseif($var==True)
{   //savoir id du login 
    echo $_SESSION["nbr"];
    if ($_SESSION["nbr"]==0)
    {
        header('Location: http://localhost/tp1/modification_code.php');
   
    }
    elseif ($role=="eleve"){
        header('Location: http://localhost/tp1/eleve.php');
    }
   else{
    header('Location: http://localhost/tp1/enseignant.php');
   }
    exit();
}
