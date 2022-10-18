
<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
?>

<html>
 <head>
  <title>connexion</title>
  <link rel="stylesheet" href="index.css">
 </head>
 <body><h1> recapitulatif </h1>
    <?php 
    $db = new SQLite3('tp1.db') ;
    if(isset($_POST['modif']))
    {
        $sql = "UPDATE login SET name = '".$_POST['nom']."'
        ,prenom = '".$_POST['prenom']."'
        ,adresse = '".$_POST['adress']."'
        ,mail = '".$_POST['mail']."'
        ,tel = '".$_POST['tel']."'
         WHERE (id_log=".$_SESSION["id_login"].")";
        $results = $db->exec($sql);
    }


    $result = $db->query('SELECT * FROM login where id_log='.$_SESSION["id_login"]);
    while ($row=$result->fetchArray(SQLITE3_ASSOC ))
    {
        echo"name ". $row['name'].'<br>';
        echo "role ".$row['role'].'<br>';
        echo"mot de passe ". $row['mdp'].'<br>';
        echo"mail ". $row['mail'].'<br>';
        echo"tel ". $row['tel'].'<br>';
        echo"adresse". $row['adresse'].'<br>';
        echo"nom  ". $row['nom'].'<br>';
        echo "prenom".$row['prenom'].'<br>';

    }
    

    
    ?>

   <h1>  modification </h1>
    <?php #todo afficher mes elemetn ?>
    <form action="completer_compte.php" method="post">
    <p>nom<input type="text" name="nom" /></p>
    <p>prenom<input type="text" name="prenom" /></p>
    <p>tel<input type="text" name="tel" /></p>
    <p>adresse<input type="text" name="adress" /></p>
    <p>mail<input type="text" name="mail" /></p>
    <input type='hidden' name='modif' value='1' >   
    <input type="submit" value="Valider modifer">
    </form>
 </body>
</html>