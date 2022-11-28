<?php
session_start();

$dt = new \DateTime();
$db = new SQLite3('../tp1.db') ;
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
        else
        {   ?>     <form action="c_etape1.php" method="post">
        <input  type="hidden"  name="id_modif" value="<?php echo $_POST['id_modif']?>" />
        <input type="text" name="text_modif_mess" />
         <input type="submit" value="validé la modification ">
  
        </form>
        <?php 
        }
    }

