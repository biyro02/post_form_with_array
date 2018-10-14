<?php
/**
 * Created by PhpStorm.
 * User: vektorel
 * Date: 13.10.2018
 * Time: 15:46
 */
$register = 0;
if(isset($_POST['submit']))
{
    if(isset($_POST['adsoyad']) && isset($_POST['username']) && isset($_POST['password']))
        if(!empty($_POST['adsoyad']) && !empty($_POST['username']) && !empty($_POST['password'])){
            $user[0]["adsoyad"] = $_POST["adsoyad"];
            $user[0]["username"] = $_POST["username"];
            $user[0]["password"] = $_POST["password"];

            $register = 1;
        }
}
?>
<div class="py-3"><br><br><br><br>
    <?php
    if($register)
        echo "Sayın ".$user[0]["adsoyad"]."Kaydınız başarıyla tamamlanmıştır.";
    else
    {
        ?>
        <form action="" method="post">
            <label>Lütfen Zorunlu alanları doldurunuz!</label><br>
            <input type="text" name="adsoyad" placeholder="* Adınız Soyadınız"><br>
            <input type="text" name="username" placeholder="* Kullanıcı Adınız"><br>
            <input type="password" name="password" placeholder="********"><br>
            <input type="number" name="yas" placeholder="18"><br>
            <input type="tel" name="tel" placeholder="Lütfen başında 0 olmadan yazınız"><br>
            <input type="text" name="okul" placeholder="Lütfen Üniversite Seçiniz"><br>
            <input type="submit" name="submit" value="Kayıt Ol">
        </form>
        <?php
    }
    ?>
</div>
