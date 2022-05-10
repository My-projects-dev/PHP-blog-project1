<?php include '../notlink.php';

function password($data) {
  $data = trim($data);
  $data = sha1(hash('sha512', $data));
  return $data;
}

$sifre_uzunlug = 5;
if(isset($_POST['account'])){

    if ( !is_null($_POST["login"]) && !is_null($_POST["login"]) && !is_null($_POST["sifre1"]) && !is_null($_POST["sifre2"])) {

        $mail = trim($_POST["mail"]);
        $user = trim($_POST["login"]);
        $sifre1 = password($_POST["sifre1"]);
        $sifre2 = password($_POST["sifre2"]);

        
        if ($sifre1!=$sifre2) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Girilən şifrələr eyni deyil</strong>
            </div>
            <?php

        }elseif (strlen($sifre1) < $sifre_uzunlug) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Şifrə ən az <?= $sifre_uzunlug ?> simvoldan ibarət olmalıdır</strong>
            </div>
            <?php
        }else {
            $sql = "UPDATE `admin_giris` SET `user` = ?, `mail` = ?, `password` = ?";
            $massiv=[
                $user,
                $mail,
                $sifre1
            ];
            $sorgu = $conn->prepare($sql);
            $sorgu->execute($massiv);

            ?>
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Uğurlu şəkildə yeniləndi.</strong> 
                </div>
            </div>
            <?php
        }

    }else{
        ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Boş keçilə bilməz</strong>
        </div>
        <?php
    }
}

$stmt = $conn->query("SELECT * FROM admin_giris");
$user = $stmt->fetch();
?>
<form action="" method="post" enctype="multipart/form-data" class="row mt-4 g-3 was-validated">

    <div class=" col-lg-6">
        <label for="email" class="form-label">E-Poçt:*</label>
        <input type="email" class="form-control" name="mail" required  value="<?=$user['mail']?>">
        <div class="invalid-feedback">Boş keçilə bilməz.</div>
    </div>

    <div class=" col-lg-6">
        <label for="login" class="form-label">İstifadəçi adı:*</label>
        <input type="text" class="form-control" name="login"  required value="<?=$user['user']?>">
        <div class="invalid-feedback">Boş keçilə bilməz.</div>
    </div>

    <div class=" col-lg-6">
        <label for="sifre1" class="form-label">Şifrə:*</label>
        <input type="text" class="form-control" name="sifre1"  minlength="<?= $sifre_uzunlug ?>"  required >
        <div class="invalid-feedback">Boş keçilə bilməz.</div>
    </div>

    <div class=" col-lg-6">
        <label for="sifre2" class="form-label">Təkrar şifrə:*</label>
        <input type="text" class="form-control" name="sifre2"  minlength="<?= $sifre_uzunlug ?>"  required >
        <div class="invalid-feedback">Boş keçilə bilməz.</div>
    </div>

    <button type="submit" name="account" class="btn btn-dark btn-lg mb-5">Yenilə</button>
</form>