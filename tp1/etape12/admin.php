<html>
 <head>
  <title>connexion</title>
  <link rel="stylesheet" href="compte.css">
 </head>
 <body>

<?php 
$dt = new \DateTime();
$db = new SQLite3('tp1.db') ;

if (empty($_POST['data'])==False)
{
  $sql = "INSERT INTO"." login"."(date,name,role,mdp,nbr_login) ".
  "VALUES ('".$dt->format('d/m/Y H:i:s')."','".$_POST['login_i']."','" .$_POST['metier']."','".$_POST['mdp_i']."',0)";
  $results = $db->exec($sql);
}
if (empty($_POST['supr'])==False)
{
  
  $sql = "DELETE FROM `login` WHERE `id_log` = ". $_POST['supr']." ";
  $results = $db->exec($sql);
}
?>
  <div class="cadre_rouge">
    <div class="lien">
     <a href="index.html">hello admin:deconnexion<a>
  </div>
     <div class="un">
      <input class ="btn" type="submit" value="Admin">
      <input class ="btn" type="submit" value="Enseignant">
      <input class ="btn" type="submit" value="Eleve">
    </div>

    <h1> TO DO </h1>  
  </div>
  <form action="admin.php" method="post">
    <table>
      <tr>
        <th>
          login
        </th>
        <th>
          mot de passe 
        </th>
        <th>
          role
        </th>
      </tr>
      <tr>
        <th>
        <input type="text" name="login_i" /></p>
        </th>
        <th>
        <input type="text" name="mdp_i" /></p>
        </th>
        <th>
        <select name="metier">
          <option valeur="eleve">eleve</option>
          <option valeur="eleve">enseignant</option>
        </select>
        </th>
      </tr>
      <tr>
       <!-- faire le bouton correctement --> 
      <th>
      <input type="submit" value="envoyer">
      <input type="hidden" name="data" value='1' >
      </th>
      </tr>
    </table>
  </form>
  <!-- affichage --> 
  <form action="admin.php" method="post">
  <div class="deux">
        <h1>READ<h1>
        <?php
        
        $result = $db->query('SELECT * FROM login');
        echo "<table>";
        echo "<tr><th>date de connexion   </th>   <th> login     </th><th>role     </th> <th>action      </th></tr>";
        while ($row=$result->fetchArray(SQLITE3_ASSOC ))
         { 
         echo '<tr><th> '.$row['date']."</th>";
         echo '<th> '.$row['name']."</th>";
         echo '<th> '.$row['role']."</th>";
        
         echo '<th> <input type="submit" value="supprimer"> </th></tr>';
         echo '<th> <input type="hidden" name="supr" value="'.$row['id_log'].'"> </th></tr>';
        }
        echo "</table>";
        ?>
    </div>
    </form>
 </body>
</html>