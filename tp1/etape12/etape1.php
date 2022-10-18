<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

?> 

<html>
<link rel="stylesheet" href="index.css">
</html>
<?php

$dt = new \DateTime();
$db = new SQLite3('tp1.db') ;
      if (isset($_POST['mess']) && $_POST['mess']='1')
    {
       
        $_POST['mess']=0;
         
        $sql = "INSERT INTO"." message"."(user_mess, text_mess,data_mess) ".
        "VALUES ('".$_POST['login']."','".$_POST['texte_mess']."',' ".$dt->format('d/m/Y H:i:s')."')";
        $results = $db->exec($sql);

    }
    
    if (isset($_POST['id']) && $_POST['id']>=0)
    {
        
        $sql = "DELETE FROM ". "message"." WHERE id_mess =".$_POST['id'];
        $results = $db->exec($sql);

    }
    if (isset($_POST['id_modif']) && $_POST['id_modif']>=0)
    { 
        if (isset($_POST['text_modif_mess']))
        {       
            $sql = "UPDATE ". "message "."SET text_mess = '".$_POST['text_modif_mess']."' where id_mess=".$_POST['id_modif'] ."";
            $results = $db->exec($sql);
            
        }
        elseif
        {   ?>     <form action="etape1.php" method="post">
        <input  type="hidden"  name="id_modif" value="<?php echo $_POST['id_modif']?>" />
        <input type="text" name="text_modif_mess" />
         <input type="submit" value="validé la modification ">
  
 </form>
<?php }
    }
    ?>
    
    <div class="deux">
        <h1>POST<h1>
            new message
            <form action="etape1.php" method="post">
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
                <form action="etape1.php" method="post">
                    <input  type="hidden"  name="id_modif" value="<?php echo $row['id_mess']?>" >
                    <input type="submit" value="mdofier">
                </form>
                <form action="etape1.php" method="post">
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
 
