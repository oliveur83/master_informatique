<html>
 
<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
$db = new SQLite3('tp1.db') ;
$db1 = new SQLite3('tp1.db') ;

?> 

<head>
  <title>connexion</title>
  <link rel="stylesheet" href="index.css">
 </head>
 <body>
   <h1> tes cours </h1>
   <form action="note_cours.php" method="post">
   <select name="cours" id="cours_select">
   <option value="">--Please choose an option--</option>
    <?php 
    $result = $db->query('SELECT * FROM cours');
    while ($row=$result->fetchArray(SQLITE3_ASSOC ))
    { 
    echo '<option value="'.$row['id_cours'].'"> '.$row['nom']."</option>";
    }
    ?>
  </select>
  <input type="submit" value="Valider">
  </form>
 
<?php  
if (isset($_POST['cours']))
{
 
 
  $result = $db->query('SELECT * FROM cours_profil
  inner join login ON  cours_profil.id_login = login.id_log
  where id_cours='.$_POST['cours'].'');
   echo "<table>";
  while ($row1=$result->fetchArray(SQLITE3_ASSOC ))
  { ?> <form action="note_cours.php" method="post"><?php
  echo "<tr>";
  echo '<td>'.$row1['name'].'</td>';
  echo '<input  type="hidden"  name="id_ajout" value='.$row1['id_cours'].' />';
  echo '<input  type="hidden"  name="cours" value="'.$_POST['cours'].'" />';
  echo '<input  type="hidden"  name="id_login" value="'.$row1['id_login'].'" />';     

  $result_note = $db1->query('SELECT * FROM note where id_cours='.$_POST['cours'].' and id_login='.$row1['id_login']);
    while ($row=$result_note->fetchArray(SQLITE3_ASSOC ))
    { 
      
      echo '<td>'.$row['n_note'].'</td>';
    
    }
    
    echo '<td><input type="submit" value="Valider"></td>';
    
    echo "</tr>";?></form>

<?php 
  }
  echo "</table>";
}
?>

<?php 
if (isset($_POST['id_ajout']) && $_POST['id_ajout']>=0)
    { 
        if (isset($_POST['text_modif_mess']))
        {       
          $sql = "INSERT INTO"." note"."(id_login,n_note,id_cours) ".
          "VALUES ('".$_POST['id_login']."','".$_POST['text_modif_mess']."',' ".$_POST['id_ajout']."')";
          $results = $db->exec($sql);
  
            
        }
        else
        {   ?>     <form action="note_cours.php" method="post">
        <input  type="hidden"  name="id_ajout" value="<?php echo $_POST['id_ajout']?>" />
        <input  type="hidden"  name="id_login" value="<?php echo $_POST['id_login']?>" />     
        <input  type="hidden"  name="cours" value="'<?php echo $_POST['cours']?>'" />
        
          
        <input type="text" name="text_modif_mess" />
         <input type="submit" value="validé mon ajout  ">
  
 </form>
<?php }
    } ?>
 </body>
</html>