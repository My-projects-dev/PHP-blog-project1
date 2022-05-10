<?php include '../notlink.php';

if(isset($_GET['sil'])){
  $sqlsil="DELETE FROM `movzular` WHERE `movzular`.`movzu_id` = ?";
  $sorgusil=$conn->prepare($sqlsil);
  $sorgusil->execute([
    $_GET['sil']
  ]);

  
}
//--------------------------------------------
if(isset($_POST['yayinda'])){
  $sql="UPDATE `movzular` SET `movzu_veziyyet` = ? WHERE `movzular`.`movzu_id` = ?";
  
  $massiv=[
    0,
    $_POST['movzu_id']
  ];

  $sorgu = $conn->prepare($sql);
  $sorgu->execute($massiv);
}

if(isset($_POST['gozleyir'])){
  $sql="UPDATE `movzular` SET `movzu_veziyyet` = ? WHERE `movzular`.`movzu_id` = ?";
  
  $massiv=[
    1,
    $_POST['movzu_id']
  ];

  $sorgu = $conn->prepare($sql);
  $sorgu->execute($massiv);
}

//-----------------------------------------------------------------------------------
$sehife = @$_GET["sehife"];
$sehifeLink = "";

$Sayfa = @ceil($_GET['sehifeno']);
if ($Sayfa < 1) { $Sayfa = 1;}

$sql = "SELECT * FROM movzular";
$Say  = $conn->query($sql);
$ToplamVeri = $Say->rowCount(); 

 $Limit  = 20;                      // Bir səhifədə olacaq xəbər sayı
 $Sayfa_Sayisi = ceil($ToplamVeri/$Limit);

 if($Sayfa > $Sayfa_Sayisi){$Sayfa = $Sayfa_Sayisi;}   // Əgər yazilan rəqəm boyükdürsə son səhifəyə get

 $Goster   = $Sayfa * $Limit - $Limit;

 $GorunenSayfa   = 5;                  // reqem sayı

 try {
   $slcontent = "SELECT * FROM movzular order by movzu_id DESC limit $Goster,$Limit";
 $query = $conn->query($slcontent, PDO::FETCH_ASSOC);
 } catch (Exception $e) {
   $query = null;
 }
 
 ?>

 <div class="container mt-3">
  <h2>Mövzular</h2>
  <a href="?sehife=yeni_kontent" class="btn btn-primary my-2"><i class="fa fa-plus" aria-hidden="true"> Mövzu əlavə et</i></a>
  <div class="table-responsive bg-dark">
    <table class="table table-bordered  table-dark table-striped table-hover ">
      <thead>
        <tr>
          <th>#</th>
          <th>Yazar</th>
          <th>Başlıq</th>
          <th>Məzmun</th>
          <th>Şəkil</th>
          <th>Tarix</th>
          <th>Görülmə sayı</th>
          <th>Kateqoriya</th>
          <th>Status</th>
          <th>Əməliyyatlar</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $i=0;
        if ( $query ){
          foreach( $query as $row ){
            $i++;
            ?>
            <tr>
              <td><?=$i?></td>
              <td><?=$row["movzu_yazar"]?></td>
              <td><?=$row["movzu_basliq"]?></td>
              <td><?=substr($row["movzu_mezmun"],0,100);?>...</td>

              <td><img src="<?php if($row['movzu_sekil'].to !=null){
                $sekil = $row['movzu_sekil'];
                if (! filter_var($sekil, FILTER_VALIDATE_URL) === false) {
                  echo $sekil;
                }
                else {
                  echo '../'.$sekil;
                }  
              }?>"
              style="width:80px"></td>

              <td><?=$row["movzu_tarix"]?></td>
              <td><?=$row["movzu_gorulme_sayi"]?></td>
              <td> <?php  
              $katsql ="SELECT * FROM kateqoriyalar WHERE kat_id = ?";
              $katsorgu = $conn->prepare($katsql);
              $katsorgu->execute([$row["kat_id"]]);
              $query = $katsorgu->fetchAll(PDO::FETCH_ASSOC);
              if ( $query ){
                foreach( $query as $katrow ){

                  echo $katrow["kat_ad"];
                }
              } ?>
            </td>

            <td>
              <?php if ($row["movzu_veziyyet"] == 1) { ?>
                <form action="" method="post">
                  <input type="hidden" name="movzu_id" value="<?=$row["movzu_id"]?>">
                  <button type="submit" class="btn btn-success w-100" name="yayinda">Yayında</button>
                </form>
              <?php }else{ ?>
                <form action="" method="post">
                  <input type="hidden" name="movzu_id" value="<?=$row["movzu_id"]?>">
                  <button type="submit" class="btn btn-warning w-100" name="gozleyir">Gözləyir</button>
                </form>
              <?php  } ?>
            </td>

            <td>
              <div class="d-flex">
                <a href="../?sehife=kontent&id=<?=$row["movzu_id"]?>" class="btn bg-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tam görünüm">
                  <i class="fa fa-info mx-1" aria-hidden="true"></i>
                </a>

                <a href="?sehife=yenile&id=<?=$row["movzu_id"];?>" class="btn bg-warning d-online-flex mx-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dəyişdir">
                 <i class="fa fa-pencil" aria-hidden="true"></i>
               </a>
               <a href="?sehife=movzular&sil=<?=$row["movzu_id"];?>" onclick="return confirm('Silmək istədiyinizə əminsiniz?')" class="btn bg-danger"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sil">
                 <i class="fa fa-times" aria-hidden="true"></i>
               </a>
             </div>
           </td>
         </tr>
         <?php  
          }
        }
        ?>
   </tbody>
 </table>
 <!-------------------- Pagination --------------->
 <?php include '../pagination.php'; ?>
 <!---------x---------- Pagination --------x------>

</div>
</div>
