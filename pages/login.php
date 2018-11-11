<?php
/**
 * Created by PhpStorm.
 * User: vektorel
 * Date: 13.10.2018
 * Time: 15:47
 */

$login = 0;
$message = "Hoşgeldiniz, lütfen oturum açma bilgilerinizi giriniz.";
$log[0] = getRealIpAddr();
$log[1] = 24;
$log[3] = date('Y-m-d H:i:s');
if(isset($_POST["submit"])){
    if(isset($_POST['username']) && isset($_POST['password'])){
        if(!empty($_POST['username'])&&!empty($_POST['password']) && strlen($_POST['password'])>5){
            $stmt = $db->prepare("SELECT * FROM users WHERE user_name= ?");
            $stmt->execute([$_POST['username']]);
            $users = $stmt->fetchAll();
            $log[1] = $users[0]['id'];
            if(login($_POST['username'], md5($_POST['password']), $users[0])){
                $login = 1;
                $log[3]=null;
                $message = "Hoşgeldiniz sayın ".$user[0]['username'];
            } else{
                $login = 2;
                $message = "Böyle bir kullanıcı adı ya da şifre bulunamadı!";
            }
        } else {
            $login = 3;
            $message = "Kullanıcı adı veya şifre boş bırakılamaz";
        }
    } else{
        $login = 4;
        $message = "Beklenmedik hata oluştu.";
        $alert = 1;
    }
    $log[2]=$login;
    var_dump($log);
    $sql= " INSERT INTO login(ip, user_id, try_id, logout_at)
            VALUES( ?, ?, ?, ?)";
    $logged = $db->prepare($sql);
    $result = $logged->execute($log);
    if($login){
        $sql = "SELECT id FROM login WHERE user_id= ? ORDER BY id DESC LIMIT 1";
        $logggg = $db->prepare($sql);
        $logggg->execute([$log[1]]);
        $log_id = $logggg->fetchAll();
        $_SESSION['login_id'] = $log_id[0]['id'];
    }
    var_dump($result);
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

