<html>
<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
?>  

<head>
  <title>connexion</title>
  <link rel="stylesheet" href="index.css">
 </head>
 <body>
   <h1> mes notes </h1>
<?php   
    $db = new SQLite3('tp1.db') ;
     
  $result = $db->query('SELECT * FROM cours_profil
  inner join cours on cours.id_cours=cours_profil.id_cours
  where id_login='.$_SESSION["id_login"]);
  echo "<table>";
  while ($row1=$result->fetchArray(SQLITE3_ASSOC ))
  { $moyenne=0;
    $n_note=0;
    echo "<tr>";
      echo'<td>'.$row1['nom'].'</td>' ;

    $result_note = $db->query('SELECT * FROM note where id_login='.$_SESSION["id_login"]. ' and id_cours='. $row1['id_cours']);
    while ($row=$result_note->fetchArray(SQLITE3_ASSOC ))
    { 
      echo '<td>'.$row['n_note'].'</td>';
      $moyenne=$moyenne+intval($row['n_note']);
      $n_note=$n_note+1;
    }
    if ($n_note!=0)
    {$moyenne=$moyenne/$n_note;}
    
    echo " <td>moyenne".$moyenne;
    echo '</td>';
    echo "</tr>";
  }
  echo "</table>";
?>
 </body>
</html>