<?php
/**
 * Created by PhpStorm.
 * User: vektorel
 * Date: 13.10.2018
 * Time: 13:50
 */

$page = $pages[0];

if(isset($_GET["page"]))
{
    if(in_array($_GET["page"],$pages))
        $page = $_GET["page"];
    else
        $page = "error";
}

include __DIR__."/../pages/$page.php";
