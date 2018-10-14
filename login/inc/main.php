<?php
/**
 * Created by PhpStorm.
 * User: vektorel
 * Date: 14.10.2018
 * Time: 16:26
 */

$page = $logpage[0];

if(isset($_GET["logpage"]))
{
    if(in_array($_GET["logpage"],$logpage))
        $page = $_GET["logpage"];
    else
        $page = "error";
}

include __DIR__."/../logpages/$page.php";