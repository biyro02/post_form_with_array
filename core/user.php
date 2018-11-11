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
        if($key=="user_name"){
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

function register($data = [], $db){
    $users = $db->prepare("
        INSERT INTO users(user_name, password) values(
             ?,?
        )
    ");
    if(!$users){
        return "Veritabanı bağlantısı kurulamadı";
    }
    $usersInsert = $users->execute([$data['user_name'],$data['password']]);
    if($usersInsert){
        $id = $usersInsert->lastInsertId();
        $pers_inf = $db->prepare("
            INSERT INTO personal_information(user_id, name, surname, birth_date, sex, tel) 
            values (?, ?, ?, ?, ?, ?)            
        ");
        $pers_inf_insert = $pers_inf->execute([$id,$data['name'],$data['surname'],$data['birth_date'],$data['sex'],$data['tel']]);
        if($pers_inf_insert){
            return "Tüm kişisel bilgiler başarıyla kaydedildi";
        } else {
            return "personal_information tablosu insert edilemedi.";
        }
    } else {
        return "users tablosuna insert edilemedi.";
    }
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    if(env=='local'){
        $ip = '127.0.0.1';
    }
    return $ip;
}