<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

?> 

<html>
 <head>
  <title>connexion</title>
  <link rel="stylesheet" href="compte.css">
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
    
        <h1> <?php echo $_SESSION["login"];?></h1>   
    </div>
    <?php 
    
    $db = new SQLite3('tp1.db') ;
    
    if (empty($_POST['id_cours'])==False)
    {
        $sql = "INSERT INTO"." cours_profil"."(id_cours, id_login) ".
        "VALUES ('".$_POST['id_cours']."','".$_SESSION["id_login"]."')";
        $results = $db->exec($sql);
    }
    
    
    ?>

    <h2> Tes cours </h2>  
    <?php
        $result2 = $db->query("SELECT *
        FROM cours
        LEFT JOIN cours_profil ON cours.id_cours = cours_profil.id_cours
        where id_login='".$_SESSION["id_login"]."'");
        echo "<table>";
        echo "<tr><th> nom </th>   <th> desription </th><th> action   </th></tr>";
        while ($row=$result2->fetchArray(SQLITE3_ASSOC ))
         { 
         echo '<tr><th> '.$row['nom']."</th>";
         echo '<th> '.$row['descriptive']."</th>";
         echo "<th><input type='radio' name='id_cours' value='".$row['id_cours']."'>";

         echo $row['id_cours'];
          echo '</th></tr>';
        }
        echo "</table>";
        echo '<th> <input type="submit" value="inscription"> </th></tr>';
        echo"<input type='hidden' name='id_login' value='1' >";
        ?>
    <h2> S'inscrire</h2>  
    <form action="eleve.php" method="post">
    <?php
        $result = $db->query('SELECT * FROM cours');
        
        echo "<table>";
        echo "<tr><th> nom </th>   <th> desription </th><th> action   </th></tr>";
        while ($row=$result->fetchArray(SQLITE3_ASSOC ))
         { 
         echo '<tr><th> '.$row['nom']."</th>";
         echo '<th> '.$row['descriptive']."</th>";
         echo "<th><input type='radio' name='id_cours' value='".$row['id_cours']."'>";

         echo $row['id_cours'];
          echo '</th></tr>';
        }
        echo "</table>";
        echo '<th> <input type="submit" value="inscription"> </th></tr>';

        ?>
        </form>
 </body>
</html>