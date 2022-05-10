<?php 
include("notlink.php");


$id = intval(@$_GET[id]);
if (!$id) { $id="1";}

$kontent = "SELECT * FROM movzular WHERE movzu_id=$id";
$querycont = $conn->prepare($kontent);
$querycont->execute();
$query = $querycont->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="row justify-content-center p-3 text-white">
    <?php
    if ( $query ){
        foreach( $query as $row ){ 

            setcookie($id,"1", time()+2000);

            if(!isset($_COOKIE[$id])){
                $sql = "UPDATE `movzular` SET `movzu_gorulme_sayi` = ? WHERE `movzular`.`movzu_id` = ?";
                $massiv=[
                    ++$row["movzu_gorulme_sayi"],
                    $id
                ];
                $sorgu = $conn->prepare($sql);
                $sorgu->execute($massiv);
            }
            ?>
            <div class="col-md-8">
                <img class="col-12 mb-3" src="<?= $row['movzu_sekil'] !=null ? $row['movzu_sekil'] : null;?>">
                <div class="d-flex justify-content-between p-2">
                    <span class="bg-faded"><?php echo $row["movzu_tarix"];?></span>
                    <i class="fa fa-eye"> <?php echo $row["movzu_gorulme_sayi"];?></i>
                </div>
                    <h2 class="text-center mt-3"><?php echo $row['movzu_basliq'];?></h2>
                    <p><?php echo $row['movzu_mezmun'];?></p>
                </div>
                <?php
        }
    }else{echo '<div class="container-fluid alert alert-warning m-3">Kontent tapılmadı.</div>';}
    ?>
</main>