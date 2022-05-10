<?php
session_start(); ob_start();

if (isset($_SESSION['user'])) {

  define('security', true);

  include '../databaglanti.php';

  include 'sidebar_head.php';

  $sehife = @$_GET["sehife"];

  switch($sehife){

    case "kateqoriyalar":
    include("kateqoriyalar.php");
    break;

    case "movzular":
    include("table.content.php");
    break;

    case "hesabım":
    include("hesabım.php");
    break;

    case "yenile":
    include("change.content.php");
    break;

    case "yeni_kontent":
    include("insert.content.php");
    break;

    default:
    include ("table.content.php");
    break;
  }

  include 'sidebar_foot.php';

}else{
  header('Location: login.php');
}
?>