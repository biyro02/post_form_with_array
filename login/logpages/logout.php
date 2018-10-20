<?php
/**
 * Created by PhpStorm.
 * User: vektorel
 * Date: 14.10.2018
 * Time: 16:31
 */

if(isset($_SESSION))
    session_destroy();
if(isset($_COOKIE))
    unset($_COOKIE);
ob_end_flush();
header('Location: ../index.php');