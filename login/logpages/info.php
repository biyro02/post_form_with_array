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
try{
    $tel = doMaskForTelephonNumbers($user_information[0]['tel']);
} catch (Exception $e){
    echo $e->getMessage();
}

if(isset($_POST['submit'])){
    $isAble = true;
} else {
    $isAble = false;
}
function ability($isAble){
    if(!$isAble){
        return "disabled";
    }
}

if(isset($_POST['submit2'])){
    $sqlAdd[0] = " updated = NOW() ";
    $dataBind = [];
    $sqlAddCount = 0;
    if($_POST['name'] != $user_information[0]['name']){
        $sqlAdd[$sqlAddCount] = " name = ? ";
        $dataBind[$sqlAddCount] = $_POST['name'];
        $sqlAddCount++;
    }
    if($_POST['surname'] != $user_information[0]['surname']){
        $sqlAdd[$sqlAddCount] = " surname = ? ";
        $dataBind[$sqlAddCount] = $_POST['surname'];
        $sqlAddCount++;
    }
    if($_POST['birth_date'] != $user_information[0]['birth_date']){
        $sqlAdd[$sqlAddCount] = " birth_date = ? ";
        $dataBind[$sqlAddCount] = $_POST['birth_date'];
        $sqlAddCount++;
    }
    if($_POST['sex'] != $user_information[0]['sex']){
        $sqlAdd[$sqlAddCount] = " sex = ? ";
        $dataBind[$sqlAddCount] = $_POST['sex'];
        $sqlAddCount++;
    }
    if($_POST['tel'] != $user_information[0]['tel']){
        $sqlAdd[$sqlAddCount] = " tel = ? ";
        $dataBind[$sqlAddCount] = $_POST['tel'];
        $sqlAddCount++;
    }
    if($_POST['school'] != $user_information[0]['school']){
        $sqlAdd[$sqlAddCount] = " school = ? ";
        $dataBind[$sqlAddCount] = $_POST['school'];
        $sqlAddCount++;
    }
    $sql = "UPDATE personal_information SET ";
    for($i=0;$i<$sqlAddCount;$i++){
        $sql .= $sqlAdd[$i];
        if($i+1!=$sqlAddCount){
            $sql .= ", ";
        }
    }
    array_push($dataBind, $user_information[0]['user_id']);
    $sql .= "
        WHERE user_id = ? ";
    echo "$sql";var_dump($dataBind);
    $stmt = $db->prepare($sql);
    $update = $stmt->execute($dataBind);

    if($update){
        echo "Kullanıcı bilgileriniz başarıyla kaydedilmiştir.";
        $stmt = $db->prepare("SELECT * FROM users a, personal_information b WHERE a.id=b.user_id AND a.user_name = ?");
        $stmt->execute([$_SESSION['username']]);
        $user_information = $stmt->fetchAll();
        unset($_POST['submit2']);
        try{
            $tel = doMaskForTelephonNumbers($user_information[0]['tel']);
        } catch (Exception $e){
            echo $e->getMessage();
        }
    } else{
        echo "persnal_information tablosuna veri eklemede bir sorun oluştu.";
    }
}
?>
<form action="index.php?logpage=info" name="user_edit" method="post">
    <table>
        <tr>
            <td>Ad</td>
            <td>:</td>
            <td><input type="text" <?=ability($isAble)?> value="<?=$user_information[0]['name']?>" name="name"></td>
        </tr>
        <tr>
            <td>Soyad</td>
            <td>:</td>
            <td><input type="text" <?=ability($isAble)?> value="<?=$user_information[0]['surname']?>" name="surname"></td>
        </tr>
        <tr>
            <td>Kullanıcı adı</td>
            <td>:</td>
            <td><input type="text" <?=ability(false)?> value="<?=$user_information[0]['user_name']?>" name="user_name"></td>
        </tr>
        <tr>
            <td>Yaş</td>
            <td>:</td>
            <td><input <?php echo ability($isAble); if(!$isAble){ echo  ' type="text" ';} else {echo ' type="date"';} ?> value="<?= (!$isAble) ? date('Y-m-d')-$user_information[0]['birth_date'] : $user_information[0]['birth_date'] ?>" name="birth_date"></td>
        </tr>
        <tr>
            <td>Cinsiyet</td>
            <td>:</td>
            <td><input type="text" <?=ability($isAble)?> value="<?=$user_information[0]['sex']?>" name="sex"></td>
        </tr>
        <tr>
            <td>Telefon</td>
            <td>:</td>
            <td><input type="text" <?=ability($isAble)?> value="<?=($isAble)?$user_information[0]['tel'] : $tel?>" name="tel"></td>
        </tr>
        <tr>
            <td>Okul</td>
            <td>:</td>
            <td><input type="text" <?=ability($isAble)?> value="<?=$user_information[0]['school']?>" name="school"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <?php if(!isset($_POST['submit'])) { ?>
                    <input type="submit" value="Düzenle"name="submit">
                <?php } elseif(isset($_POST['submit']) && !isset($_POST["submit2"])) {?>
                    <input type="submit" value="Kaydet" name="submit2">
                <?php }?>
            </td>
        </tr>
    </table>
</form>