


<html>
 <head>
  <title>connexion</title>
  <link rel="stylesheet" href="../css/compte.css">
 </head>
 <body>

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
  <form action="c_admin.php" method="post">
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
  
  <div class="deux">
        <h2>READ<h2>
        <?php
        echo "<table>";
        echo "<tr><th>date de connexion   </th>   <th> login     </th><th>role     </th> <th>action      </th></tr>";

        foreach ($login as $post) {
          ?><form action="c_admin.php" method="post"><?php
         echo '<tr><th> '.$post['date']."</th>";
         echo '<th> '.$post['name']."</th>";
         echo '<th> '.$post['role']."</th>";
         
         echo '<th> <input type="submit" value="supprimer"> </th></tr>';
         echo '<th> <input type="hidden" name="supr" value="'.$post['id_log'].'"> </th></tr>';
         ?></form><?php
        }
        echo "</table>";
        ?>
    </div>
    
 </body>
</html>