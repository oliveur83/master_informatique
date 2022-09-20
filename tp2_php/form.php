<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
$_SESSION["login"]=$_POST['login'];

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
elseif($var=True)
{   //savoir id du login 
    
    if ($role=="eleve"){
        header('Location: http://localhost/tp1/eleve.php');
    }
   else{
    header('Location: http://localhost/tp1/enseignant.php');
   }
    exit();
}
else
{   $dt = new \DateTime();
  
   
    if (isset($_POST['mess']) && $_POST['mess']='1')
    {
        
        $_POST['mess']=0;
         
        $sql = "INSERT INTO"." message"."(user_mess, text_mess,data_mess) ".
        "VALUES ('".$_POST['login']."','".$_POST['texte_mess']."',' ".$dt->format('d/m/Y H:i:s')."')";
        $results = $db->exec($sql);

    }
     echo 'hello '.$_POST['login']." d".empty($_POST['mdp'])."toto";
    $re=3
    

    ?>
    <div class="deux">
        <h1>POST<h1>
            new message
            <form action="form.php" method="post">
                <input type="text" name="texte_mess" />
                <input type="submit" value="Poster">
                <input  type="hidden"  name="login" value="<?php echo $_POST['login']?>" >
                <input type="hidden" name="modif" value='1' >
            </form>
    </div>
    
    <div class="deux">
        <h1>READ<h1>
        <?php
        $result = $db->query('SELECT * FROM message');
        echo "<table>";
        while ($row=$result->fetchArray(SQLITE3_ASSOC ))
         { 
         echo '<tr><td> '.$row['user_mess'] . ' a ecrit' . $row['text_mess'] . '</td></tr> ';
         echo ' <tr><td>'.$row['data_mess'].'</td></tr> ' ;

        }
        echo "</table>";
        ?>
    </div>
<?php
}
?>