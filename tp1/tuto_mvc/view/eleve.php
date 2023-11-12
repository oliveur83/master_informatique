

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
    
        <h1> <?php echo $_SESSION["login"];?></h1>   
    </div>

    <h2> Tes cours </h2>  
    <?php

        $nbr_cours_inscri=0;  
        echo "<table>";
        echo "<tr><th> nom </th>   <th> desription </th><th> action   </th></tr>";
        foreach ($tescours as $post)
         { $nbr_cours_inscri=$nbr_cours_inscri+1;
         echo '<tr><th> '.$post['nom']."</th>";
         echo '<th> '.$post['descriptive']."</th>";
         echo "<th><input type='radio' name='id_cours' value='".$post['id_cours']."'>";
          echo '</th></tr>';
        }
        echo "</table>";
       echo"<input type='hidden' name='id_login' value='1' >";
        ?>
    <h2> S'inscrire</h2> 
     
    <form action="c_eleve.php" method="post">
    <?php
       
        
        echo "<table>";
        echo "<tr><th> nom </th>   <th> desription </th><th> action   </th></tr>";
        foreach ($inscri as $post)
         { 
         echo '<tr><th> '.$post['nom']."</th>";
         echo '<th> '.$post['descriptive']."</th>";
         echo "<th><input type='radio' name='id_cours' value='".$post['id_cours']."'>";
          echo '</th></tr>';
        }
        echo "</table>";
        echo '<th> <input type="submit" value="inscription"> </th></tr>';
        if ($nbr_cours_inscri<3)
        {
            echo "<br> il faut que tu t'inscrive a encore ".(3-$nbr_cours_inscri);
        }
        ?>
        </form>
        <form action="../controleur/c_etape1.php" method="post">
        <input type="submit" value="chat box ">
        </form>   
        <form action="c_note_eleve.php" method="post">
        <input type="submit" value="voir mes notes ">
        </form> 
        <form action="c_completer_compte.php" method="post">
        <input type="submit" value="modifier mes info ">
        </form> 
 </body>
</html>