<?php
/**
 * Created by PhpStorm.
 * User: vektorel
 * Date: 13.10.2018
 * Time: 15:47
 */

$login = 0;
$message = "Hoşgeldiniz, lütfen oturum açma bilgilerinizi giriniz.";
if(isset($_POST["submit"])){
    if(isset($_POST['username']) && isset($_POST['password'])){
        if(!empty($_POST['username'])&&!empty($_POST['password']) && strlen($_POST['password'])>7){
            if(login($_POST['username'], $_POST['password'], $user[0])){
                $login = 1;
                $message = "Hoşgeldiniz sayın ".$user[0]['username'];
            } else{
                $login = 2;
                $message = "Böyle bir kullanıcı adı ya da şifre bulunamadı!";
            }
        } else {
            $login = 3;
            $message = "Kullanıcı adı ve ya şifre boş bırakılamaz";
        }
    } else{
        $login = 4;
        $message = "Beklenmedik hata oluştu.";
        $alert = 1;
    }
} else{
    $login = 0;
}

?>

<div class="py-3"><br><br><br><br>
    <?php if($login==0 || $login==2 || $login==3){
        echo $message;?>
        <form action="" name="login" method="post">
            <input type="text" name="username" placeholder="Kullanıcı Adınız">
            <input type="password" name="password" placeholder="*******">
            <input type="submit" name="submit" value="Giriş Yap">
        </form>
    <?php } elseif($login==1) {
        header('Location: login/index.php');
    } elseif ($login==4){
        echo $message;
    }?>
</div>

