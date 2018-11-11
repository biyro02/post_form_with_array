<?php
/**
 * Created by PhpStorm.
 * User: vektorel
 * Date: 14.10.2018
 * Time: 16:31
 */

if(isset($_SESSION['login_id'])){
    $sql = 'UPDATE login SET logout_at = NOW() WHERE id = ? ';
    $stmt = $db->prepare($sql);
    $updated = $stmt->execute([$_SESSION['login_id']]);
    if(!$updated){
        echo "logout işlemini yapamadık";die;
    }
}
if(isset($_SESSION))
    session_destroy();
if(isset($_COOKIE))
    unset($_COOKIE);
ob_end_flush();
header('Location: ../index.php');