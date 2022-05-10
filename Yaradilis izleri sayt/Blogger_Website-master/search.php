<?php 
include('notlink.php');

include("kateqoriyalist.php");

$sehife = @$_GET["sehife"];
$sehifeLink = 'sehife='.$sehife.'&';

$search = @$_POST['search'];

$Sayfa = @ceil($_GET['sehifeno']);
if ($Sayfa < 1) { $Sayfa = 1;}

$sql = "SELECT * FROM movzular WHERE movzu_veziyyet=1 and movzu_basliq LIKE :search order by movzu_id desc ";
$Say  = $conn->prepare($sql);
$Say->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
$Say->execute();
$ToplamVeri = $Say->rowCount(); 

$Limit	= 2;											// Bir səhifədə olacaq xəbər sayı
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit);

if($Sayfa > $Sayfa_Sayisi){$Sayfa = $Sayfa_Sayisi;}		// Əgər yazilan rəqəm boyükdürsə son səhifəyə get

$Goster   = $Sayfa * $Limit - $Limit;

$GorunenSayfa   = 5;									// altda gorunecek pagination

if ($ToplamVeri!=0) {
	$slcontent = "SELECT * FROM movzular WHERE movzu_veziyyet=1 and movzu_basliq LIKE :search  order by movzu_id desc limit :off,:lim";
	$querycontent = $conn->prepare($slcontent);
	$querycontent->bindValue(':off', $Goster, PDO::PARAM_INT);
	$querycontent->bindValue(':lim', $Limit, PDO::PARAM_INT);
	$querycontent->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
	$querycontent->execute();
	$query = $querycontent->fetchAll(PDO::FETCH_ASSOC);
}
else{ $query = null; }

include 'contents.php';
?>
