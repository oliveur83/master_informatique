<?php 

function getPosts(){
      $dt = new \DateTime();
      $db = new SQLite3('../tp1.db') ;

      if (empty($_POST['data'])==False)
      {
        $sql = "INSERT INTO"." login"."(date,name,role,mdp,nbr_login) ".
        "VALUES ('".$dt->format('d/m/Y H:i:s')."','".$_POST['login_i']."','" .$_POST['metier']."','".$_POST['mdp_i']."',0)";
        $results = $db->exec($sql);
      }
      
      if (isset($_POST['supr']))
      {
        
        $sql = "DELETE FROM `login` WHERE `id_log` = ". $_POST['supr']." ";
        $results = $db->exec($sql);
      }
      #requete SQL
      $result = $db->query('SELECT * FROM login');
      $login = [];
      while (($row = $result->fetchArray())) {
        $post = [
          'date' => $row['date'],
          'name' => $row['name'],
          'role' => $row['role'],
          'id_log' => $row['id_log'],
      ];

      $login[] = $post;
      }
      return $login;


}
