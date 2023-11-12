<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

$db = new SQLite3('../tp1.db') ;

if (empty($_POST['cours'])==False)
    {
        if ($_POST['cours']==1)
        {
            $sql = "INSERT INTO"." cours"."(nom, descriptive,createur) ".
            "VALUES ('".$_POST['name']."','".$_POST['descri']."',' ". $_SESSION["login"]."')";
            $results = $db->exec($sql);
    
            $_POST['cours']=$_POST['cours']+1 ;
        }
       
    }
elseif(empty($_POST['supr'])==False)
{       
        $sql = 'DELETE FROM cours WHERE id_cours ='.$_POST['supr'];
        $results = $db->exec($sql);

}
elseif(empty($_POST['id'])==False)
{
    echo "update";
        $sql = "UPDATE cours SET nom = '".$_POST['nom']."',descriptive = '".$_POST['descri']."' WHERE (id_cours=".$_POST['id'].")";
        $results = $db->exec($sql);

}

function affiche_cours()
{$db = new SQLite3('../tp1.db') ;
    $result = $db->query('SELECT * FROM cours');
    $tescours = [];
    while (($row = $result->fetchArray())) {
        $post = [
          'nom' => $row['nom'],
          'descriptive' => $row['descriptive'],
          'id_cours' => $row['id_cours'],
          'createur' => $row['createur'],
        ];

        $tescours[] = $post;
        }
    return $tescours;
}