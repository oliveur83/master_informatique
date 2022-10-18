

<html>
<link rel="stylesheet" href="../css/index.css">
</html>

    <div class="deux">
        <h1>POST<h1>
            new message
            <form action="c_etape1.php" method="post">
                <input type="text" name="texte_mess" />
                <input type="submit" value="Poster">
                <input  type="hidden"  name="login" value="<?php echo $_SESSION["login"]?>" >
                <input type="hidden" name="mess" value='1' >
            </form>
    </div>
    
    <div class="deux">
        <h1>READ<h1>
        <?php
        $result = $db->query('SELECT * FROM message');
        echo "<table>";
        while ($row=$result->fetchArray(SQLITE3_ASSOC ))
         { 
            
            if ($_SESSION["login"]==$row['user_mess'])
            {   
                echo '<tr><td> '.$row['user_mess'] . ' a ecrit' . $row['text_mess'] . ' ';
                ?>
                <form action="c_etape1.php" method="post">
                    <input  type="hidden"  name="id_modif" value="<?php echo $row['id_mess']?>" >
                    <input type="submit" value="mdofier">
                </form>
                <form action="c_etape1.php" method="post">
                    <input  type="hidden"  name="id" value="<?php echo $row['id_mess']?>" >
                    <input type="submit" value="suprimer">

                </form><?php
               
                echo '</td> </tr> ';
                echo ' <tr><td>'.$row['data_mess'].'</td></tr> ' ;
            }
            else{

           
            echo '<tr><td> '.$row['user_mess'] . ' a ecrit' . $row['text_mess'] . '</td> </tr> ';
            echo ' <tr><td>'.$row['data_mess'].'</td></tr> ' ;
        }
        }
        echo "</table>";
        ?>

    </div>
 
