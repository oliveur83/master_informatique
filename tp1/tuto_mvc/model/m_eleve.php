<?php
session_start();
  
$db = new SQLite3('../tp1.db') ;  
function tescours()
{   
    $db = new SQLite3('../tp1.db') ;   
    $result = $db->query("SELECT *
    FROM cours
    LEFT JOIN cours_profil ON cours.id_cours = cours_profil.id_cours
    where id_login='".$_SESSION["id_login"]."'");


    $tescours = [];
    while (($row = $result->fetchArray())) {
        $post = [
          'nom' => $row['nom'],
          'descriptive' => $row['descriptive'],
          'id_cours' => $row['id_cours'],
        ];

        $tescours[] = $post;
        }
    return $tescours;
} 
function inscription()
{   
    $db = new SQLite3('../tp1.db') ;  
    $result = $db->query('SELECT * FROM cours');
    $inscri = [];
    while (($row = $result->fetchArray())) {
        $post = [
          'nom' => $row['nom'],
          'descriptive' => $row['descriptive'],
          'id_cours' => $row['id_cours'],
        ];

        $inscri[] = $post;
        }

        return $inscri;
}

if (empty($_POST['id_cours'])==False)
{
    $sql = "INSERT INTO"." cours_profil"."(id_cours, id_login) ".
    "VALUES ('".$_POST['id_cours']."','".$_SESSION["id_login"]."')";
    $results = $db->exec($sql);
}


?>


