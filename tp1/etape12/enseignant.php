
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
    
        <!-- faire un post -->
        <h1> TO DO </h1>   
    </div>
    <?php
    $db = new SQLite3('tp1.db') ;
   
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

    ?>
    <h2> ajouter un cours </h2>
        <form action="enseignant.php" method="post">
            <p>nom<input type="text" name="name" /></p>
            <p>descriptif<input type="text" name="descri" /></p>
            <input type="submit" value="envoyer">
            <input type="hidden" name="cours" value='1' >
          </form>
    <h2> modifier un cours </h2>
    <form action="page_modifier.php" method="post">
    <?php
        $result = $db->query('SELECT * FROM cours');
        
        echo "<table>";
        echo "<tr><th> nom </th>   <th> desription </th><th> action   </th></tr>";
        while ($row=$result->fetchArray(SQLITE3_ASSOC ))
         { 
         echo '<tr><th> '.$row['nom']."</th>";
         echo '<th> '.$row['descriptive']."</th>";
         echo "<th><input type='radio' name='id_cours' value='".$row['id_cours']."'>";
         echo " <input type='hidden' name='cours' value='".$row['id_cours']."' >";
          echo '</th></tr>';
        }
        echo "</table>";
        echo '<th> <input type="submit" value="modifer"> </th></tr>';

        ?>
        </form>
    <h2> supprimer un cours </h2>
    <form action="enseignant.php" method="post">
        <?php
            $result = $db->query('SELECT * FROM cours');
            
            echo "<table>";
            echo "<tr><th> nom </th>   <th> desription </th><th> créateur</th><th> action   </th></tr>";
            while ($row=$result->fetchArray(SQLITE3_ASSOC ))
            { 
            echo '<tr><th> '.$row['nom']."</th>";
            echo '<th> '.$row['descriptive']."</th>    ";
            echo '<th> '.$row['createur']."</th>    ";
            echo "<th><input type='radio' name='supr' value='".$row['id_cours']."'>";

            echo '</th></tr>';
            }
            echo "</table>";
            echo '<th> <input type="submit" value="suprimer"> </th></tr>';

            ?>
        
           
    </form>
    <h2> voir/ajouter  les notes  </h2>
    <form action="note_cours.php" method="post">
    <input type="submit" value="aller ">
    </form>
    <form action="completer_compte.php" method="post">
        <input type="submit" value="modifier mes info ">
    </form> 
 </body>
</html>