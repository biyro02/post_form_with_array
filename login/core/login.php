<?php
/**
 * Created by PhpStorm.
 * User: vektorel
 * Date: 20.10.2018
 * Time: 14:19
 */

session_start();
$start = 0;
if(isset($_SESSION['login']) && $_SESSION['login']=='1')
{
    if(isset($_SESSION['username']))
    {
        if(isset($_COOKIE['username']))
        {
            if($_SESSION['username']==$_COOKIE['username'])
            {
                ob_start();
                $start = 1;
            }
        }
    }
}

if(!$start){
    header('Location: ../index.php');
}
echo "oturum açıldı";
