<?php 
include('notlink.php');

include("kateqoriyalist.php");

$sehife = @$_GET["sehife"];
$sehifeLink = "";

$Sayfa = @ceil($_GET['sehifeno']);
if ($Sayfa < 1) { $Sayfa = 1;}

$sql = "SELECT * FROM movzular WHERE movzu_veziyyet=1";
$Say  = $conn->query($sql);
$ToplamVeri = $Say->rowCount(); 

$Limit	= 4;											// Bir səhifədə olacaq xəbər sayı
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit);

if($Sayfa > $Sayfa_Sayisi){$Sayfa = $Sayfa_Sayisi;}		// Əgər yazilan rəqəm boyükdürsə son səhifəyə get

$Goster   = $Sayfa * $Limit - $Limit;

$GorunenSayfa   = 5;									// altda gorunecek pagination

try {
	$slcontent = "SELECT * FROM movzular WHERE movzu_veziyyet=1 order by movzu_id DESC limit $Goster,$Limit";
$query = $conn->query($slcontent, PDO::FETCH_ASSOC);
} catch (Exception $e) {
	echo '<div class="col-12 mx-5 alert alert-warning">Kontent tapılmadı.</div>'; exit();
}


include 'contents.php';
?>