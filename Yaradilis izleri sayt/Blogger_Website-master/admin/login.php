<?php 
session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
include '../databaglanti.php';

$stmt = $conn->query("SELECT * FROM admin_giris");
$user = $stmt->fetch();
if (!$user) {
    header('Location: register.php');
    exit();
}

$mesaj = "";

if (isset($_POST['giris'])) {
    $user = $_POST['user'];
    $password = sha1(hash('sha512', $_POST['password']));

    if (!empty($user) and !empty($password)) {
        $queryadmin = "SELECT * FROM admin_giris WHERE user=? and password=? ";
        $queryprepare = $conn->prepare($queryadmin);
        $queryprepare->execute([$user, $password]);
        $queryCount = $queryprepare->rowCount();

        if ($queryCount > 0) {
            $_SESSION['user'] = $user;

            header('Location: index.php');
            die();
        }else{
            $mesaj = "İstifadəçi tapılmadı";
        }
    }else{
        $mesaj = "Boş dəyər girilə bilməz";
    }
}
?>

<!DOCTYPE html>
<html lang="az">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>

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
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    ADMİN PANEL
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form method="post">
                            <div class="form-group">
                                <label class="form-control-label">İstifadəçi adı</label>
                                <input type="text" class="form-control" name="user">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Şifrə</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text text-danger">

                                    <?php echo $mesaj; ?>

                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary" name="giris">Giriş</button>
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
