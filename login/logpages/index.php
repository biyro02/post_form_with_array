<?php
/**
 * Created by PhpStorm.
 * User: vektorel
 * Date: 14.10.2018
 * Time: 16:31
 */
$stmt = $db->prepare("SELECT * FROM users a, personal_information b WHERE a.id=b.user_id AND a.user_name = ?");
$stmt->execute([$_SESSION['username']]);
$user_information = $stmt->fetchAll();
echo "Hoşgeldiniz sayın ".$user_information[0]["name"]." ".$user_information[0]["surname"];