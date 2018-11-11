<?php
/**
 * Created by PhpStorm.
 * User: vektorel
 * Date: 13.10.2018
 * Time: 15:46
*/

$data = [
    'name'=>null,
    'surname'=>null,
    'user_name'=>null,
    'birth_date'=>null,
    'sex'=>null,
    'tel'=>null,
    'password'=>null,
    'school'=>null,
];
$register = 0;
$msg = "";
if(isset($_POST['submit']))
{
    if(isset($_POST['ad']) && isset($_POST['soyad']) && isset($_POST['username']) && isset($_POST['password']))
        if(!empty($_POST['ad']) && !empty($_POST['soyad']) && !empty($_POST['username']) && !empty($_POST['password'])){
            $data["name"] = $_POST["ad"];
            $data["surname"] = $_POST["soyad"];
            $data["user_name"] = $_POST["username"];
            $data["password"] = md5($_POST["password"]);
            $register = 1;

            if(isset($_POST["dt"]) && !empty($_POST["dt"])){
                $data["birth_date"] = $_POST["dt"];
            }
            if(isset($_POST["sex"]) && !empty($_POST["sex"])){
                $data["sex"] = $_POST["sex"];
            }
            if(isset($_POST["tel"]) && !empty($_POST["tel"]) && is_int($_POST["tel"]) && strlen($_POST["tel"])==10){
                $data["tel"] = $_POST["tel"];
            } else {
                $msg = "Lütfn telefon numaranızı düzgün giriniz, alırız ayağımızın falan.";
            }
            if(isset($_POST['okul']) && !empty($_POST['okul'])){
                $data['school'] = $_POST['okul'];
            }
            if($register){
                $users = $db->prepare("INSERT INTO users(user_name, password) values(?,?)");
                $usersInsert = $users->execute([$data['user_name'],$data['password']]);
                if($usersInsert){
                    $stmt = $db->prepare("SELECT id FROM users  WHERE user_name = ?");
                    $stmt->execute([$data['user_name']]);
                    $id = $stmt->fetch();
                    $pers_inf = $db->prepare("
            INSERT INTO personal_information(user_id, name, surname, birth_date, sex, tel, school) 
            values (?, ?, ?, ?, ?, ?, ?)            
        ");
                    $pers_inf_insert = $pers_inf->execute([$id['id'],$data['name'],$data['surname'],$data['birth_date'],$data['sex'],$data['tel'], $data['school']]);
                    if($pers_inf_insert){
                        $mesaj = "Tüm kişisel bilgiler başarıyla kaydedildi";
                        echo $mesaj;
                    } else {
                        $mesaj = "personal_information tablosu insert edilemedi.";
                        echo $mesaj;
                    }
                } else {
                    $mesaj = "users tablosuna insert edilemedi.";
                    echo $mesaj;
                }


            }
        }
}
?>
<div class="py-3"><br><br><br><br>
    <?php
    if($register)
        echo $mesaj;
    else
    {
        ?>
        <form action="" method="post">
            <label>Lütfen Zorunlu alanları doldurunuz!</label><br>
            <input type="text" name="ad" placeholder="* Adınız"><br>
            <input type="text" name="soyad" placeholder="* Soyadınız"><br>
            <input type="text" name="username" placeholder="* Kullanıcı Adınız"><br>
            <input type="password" name="password" placeholder="********"><br>
            <input type="date" name="dt" placeholder="YYYY-mm-dd"><br>
            <input type="number" name="tel" placeholder="Lütfen başında 0 olmadan yazınız"><br>
            <input type="text" name="okul" placeholder="Lütfen Üniversite Seçiniz"><br>
            <select name="sex">
                <option value="">Seçiniz</option>
                <option value="erkek">Erkek</option>
                <option value="kadin">Kadın</option>
                <option value="QUEER">Sana ne</option>
            </select><br>
            <input type="submit" name="submit" value="Kayıt Ol">
        </form>
        <?php
    }
    ?>
</div>