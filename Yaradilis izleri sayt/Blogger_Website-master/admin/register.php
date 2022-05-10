<?php  //include '../notlink.php';
include '../databaglanti.php';

$stmt = $conn->query("SELECT * FROM admin_giris");
$user = $stmt->fetch();
if ($user) {
    header('Location: login.php');
    exit();
}

function password($data) {
  $data = trim($data);
  $data = sha1(hash('sha512', $data));
  return $data;
}

$sifre_uzunlug = 5;
$mesaj = "";
if(isset($_POST['register'])){
    if ( !is_null($_POST["login"]) && !is_null($_POST["login"]) && !is_null($_POST["sifre1"]) && !is_null($_POST["sifre2"])) {

        $mail = trim($_POST["mail"]);
        $user = trim($_POST["login"]);
        $sifre1 = password($_POST["sifre1"]);
        $sifre2 = password($_POST["sifre2"]);

        if (strlen($sifre1) < $sifre_uzunlug || strlen($sifre2) < $sifre_uzunlug) {
            $mesaj = 'Şifrə ən az '. $sifre_uzunlug .' simvoldan ibarət olmalıdır';      
        }elseif ($sifre1 != $sifre2) {
            $mesaj = "Girilən şifrələr eyni deyil";
        }else {
            try {
                $sql = "INSERT INTO `admin_giris` (`user`, `mail`, `password`) VALUES (?, ?, ?)";
                $massiv=[
                    $user,
                    $mail,
                    $sifre1
                ];
                $sorgu = $conn->prepare($sql);
                $sorgu->execute($massiv);

                header('Location: login.php');
            } catch (Exception $e) {
                $mesaj = $e;
            }    
        }
    }else{
        $mesaj = "Boş keçilə bilməz";
    }
}
?>

<!DOCTYPE html>
<html lang="az">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>

  <!------------------------------ Bootstrap5 ------------------------------------------------->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <!------------------------------ Fontawesome ------------------------------------------------->
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!------------------------------ Custom Style Css ------------------------------------------------->
  <link type="text/css" rel="stylesheet" href="css/login_style.css" />

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key m-">
                    <i class="fa fa-registered" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    ADMİN QEYDİYYAT
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form method="post">
                         <div class="form-group">
                            <label class="form-control-label">E-Poçt</label>
                            <input type="text" class="form-control" name="mail" required>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">İstifadəçi adı</label>
                            <input type="text" class="form-control" name="login" required>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Şifrə</label>
                            <input type="text" class="form-control" name="sifre1" minlength="<?= $sifre_uzunlug ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Təkrar şifrə</label>
                            <input type="text" class="form-control" name="sifre2" minlength="<?= $sifre_uzunlug ?>" required>
                        </div>

                        <div class="col-lg-12 loginbttm">
                            <div class="col-lg-6 login-btm login-text text-danger">
                                <?php echo $mesaj; ?>
                            </div>
                            <div class="col-lg-6 login-btm login-button">
                                <button type="submit" class="btn btn-outline-primary" name="register">Qeyd ol</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>
</div>  
</body>
