

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
    
        <!-- faire un post -->
        <h1> TO DO </h1>   
    </div>

    <h2> ajouter un cours </h2>
        <form action="c_enseignant.php" method="post">
            <p>nom<input type="text" name="name" /></p>
            <p>descriptif<input type="text" name="descri" /></p>
            <input type="submit" value="envoyer">
            <input type="hidden" name="cours" value='1' >
          </form>
    <h2> modifier un cours </h2>
    <form action="../view/page_modifier.php" method="post">
    <?php
        
        echo "<table>";
        echo "<tr><th> nom </th>   <th> desription </th><th> action   </th></tr>";
        foreach ($cours  as $post) 
         { 
         echo '<tr><th> '.$post['nom']."</th>";
         echo '<th> '.$post['descriptive']."</th>";
         echo "<th><input type='radio' name='id_cours' value='".$post['id_cours']."'>";
         
          echo '</th></tr>';
        }
        echo "</table>";
        echo '<th> <input type="submit" value="modifer"> </th></tr>';

        ?>
        </form>
    <h2> supprimer un cours </h2>
    <form action="c_enseignant.php" method="post">
        <?php
            
            
            echo "<table>";
            echo "<tr><th> nom </th>   <th> desription </th><th> créateur</th><th> action   </th></tr>";
            foreach ($cours  as $post) 
            { 
            echo '<tr><th> '.$post['nom']."</th>";
            echo '<th> '.$post['descriptive']."</th>    ";
            echo '<th> '.$post['createur']."</th>    ";
            echo "<th><input type='radio' name='supr' value='".$post['id_cours']."'>";

            echo '</th></tr>';
            }
            echo "</table>";
            echo '<th> <input type="submit" value="suprimer"> </th></tr>';

            ?>
        
           
    </form>
    <h2> voir/ajouter  les notes  </h2>
    <form action="../model/m_note_cours.php" method="post">
    <input type="submit" value="aller ">
    </form>
    <form action="c_completer_compte.php" method="post">
        <input type="submit" value="modifier mes info ">
    </form> 
 </body>
</html>