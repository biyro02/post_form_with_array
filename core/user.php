<?php
/**
 * Created by PhpStorm.
 * User: vektorel
 * Date: 13.10.2018
 * Time: 16:59
 */

$user = [
    [
        "adsoyad"=>"ahmet soyad",
        "username" => "ahmet_3",
        "password" => "123456abc"
    ]
];

function login($username='', $password='', $user=[])
{
    $login = 0;
    foreach ($user as $key=>$value){
        if($key=="username"){
            if($value==$username){
                $login = 1;
            }
            else
                $login = 0;
        } elseif ($key=="password"){
            if($value==$password){
                $login = 1;
            }
            else
                $login = 0;
        }
    }
    if($login){
        if(!isset($_SESSION['login'])){
            session_start();
            $_SESSION['login'] = $login;
            $_SESSION['username'] = $username;
            setcookie('username', $username, time()+60*60*24);
            $_COOKIE['username'] = $username;
        }
    }

    return $login;
}