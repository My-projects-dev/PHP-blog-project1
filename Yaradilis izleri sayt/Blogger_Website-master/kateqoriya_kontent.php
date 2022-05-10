<?php 
include("notlink.php");

include("kateqoriyalist.php");


$id = intval(@$_GET[id]);
if (!$id) {	$id="1";}

$sehife = @$_GET["sehife"];
$sehifeLink = 'sehife='.$sehife.'&id='.$id.'&';


$Sayfa = @ceil($_GET['sehifeno']);
if ($Sayfa < 1) { $Sayfa = 1;}

$sql = "SELECT * FROM movzular WHERE movzu_veziyyet=1 and kat_id=?";
$Say  = $conn->prepare($sql);
$Say->execute([$id]);
$ToplamVeri = $Say->rowCount(); 

$Limit	= 4;											// Bir səhifədə olacaq xəbər sayı
$Sayfa_Sayisi = ceil($ToplamVeri/$Limit);

if($Sayfa > $Sayfa_Sayisi){$Sayfa = $Sayfa_Sayisi;}		// Əgər yazilan rəqəm boyükdürsə son səhifəyə get

$Goster   = $Sayfa * $Limit - $Limit;

$GorunenSayfa   = 5;									// altda gorunecek pagination

if ($ToplamVeri!=0) {
	$katcontent = "SELECT * FROM movzular WHERE movzu_veziyyet=1 and kat_id=:id order by movzu_id desc limit :off,:lim";
	$querykatcont = $conn->prepare($katcontent);
	$querykatcont->bindValue(':off', $Goster, PDO::PARAM_INT);
	$querykatcont->bindValue(':lim', $Limit, PDO::PARAM_INT);
	$querykatcont->bindValue(':id', $id, PDO::PARAM_INT);
	$querykatcont->execute();
	$query = $querykatcont->fetchAll(PDO::FETCH_ASSOC);
}
else{ $query = null; }

include('contents.php');
?>