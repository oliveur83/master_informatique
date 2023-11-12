<?php
require_once('controleur/c_home.php');
require_once('controleur/c_form.php');
if (isset($_POST['page'])){
    if ($_POST['page']=='form')
    {
        form();
    }
}
home();