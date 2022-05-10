<?php
include '../notlink.php';

if(isset($_POST['yenile'])){

    if($_POST['mezmun'] !=null && $_POST['basliq'] !=null && $_POST['kat_ad'] ){
        

        $sekilYol = null;

        function updatecont(){
            global $conn;
            global $sekilYol;

            if ($_POST['optradio'] == 1) {
                $status = 1;
            }else{
                $status = 0;
            }


            $kat_ad = $_POST['kat_ad'];
            $katsqlid ="SELECT `kat_id` FROM `kateqoriyalar` WHERE `kateqoriyalar`.`kat_ad` = ?";
            $sorgu = $conn->prepare($katsqlid);
            $sorgu->execute([$kat_ad]);
            $katid = $sorgu->fetch(PDO::FETCH_ASSOC);
            if ($katid !=null) {
                try {
                    
                    $sql = "INSERT INTO `movzular` (`movzu_basliq`, `movzu_yazar`, `movzu_mezmun`, `movzu_sekil`, `movzu_veziyyet`, `kat_id`) VALUES (?, ?, ?, ?, ?, ?)";
                    $massiv=[
                        $_POST['basliq'],
                        $_POST['yazar'],
                        $_POST['mezmun'],
                        $sekilYol,
                        $status,
                        $katid['kat_id']
                    ];
                    $sorgu = $conn->prepare($sql);
                    $sorgu->execute($massiv);
                    if ($sorgu) {
                        echo  '
                    <div class="container">
                    <div class="alert alert-success alert-dismissible fade show">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Uğurlu şəkildə yükləndi.</strong> 
                    </div>
                    </div>';
                    }
                    

                } catch (Exception $e) {?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Xəta!</strong> <?php echo $e->getMessage(); ?>
                    </div>
                    <?php
                }
            }
        }


        if ($_FILES["sekil"]["name"]) {

            if(!file_exists("../assets")){ mkdir("../assets");}
            if(!file_exists("../assets/Blog-post")){ mkdir("../assets/Blog-post");}

            $randd = rand(10000,99999);
            $qovluq = "assets/Blog-post/";
            $sekilYol = $qovluq.$randd.$_FILES["sekil"]["name"];
            $yuklenecekSekil = "../".$sekilYol;

            $sekilFormat = array("image/jpeg", "image/gif", "image/png");
            if(in_array($_FILES["sekil"]["type"], $sekilFormat)){
                if(move_uploaded_file($_FILES["sekil"]["tmp_name"], $yuklenecekSekil)){
                    updatecont();
                }else{
                    ?>
                    <div class="container">
                        <div class="alert alert-warning alert-dismissible fade show">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <strong><?php echo "Şəkil yükləmə zamanı xəta baş verdi yenidən cəhd edin"; ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    <?php
                }
            }else{
                ?>
                <div class="container">
                    <div class="alert alert-warning alert-dismissible fade show">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <strong><?php echo "Sadəcə şəkil yükləyə bilərsiniz"; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <?php
            }
        }
        elseif ($_POST['sekilurl']!=null or $_POST['sekilurl']!="") {
            $sekilYol = $_POST['sekilurl'];
            updatecont();
        }
        else{updatecont();}

    }else{ ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><?php echo "Zəhmət olmasa ulduzlu sahələri doldurun." ?></strong>
        </div>
        <?php
    }
}

?>


<main>
    <div class="container">
        <div class="row">
            <div class="col mb-4">
                <div class="btn-group">
                    <a href="?sehife=movzular" class="btn btn-outline-primary">Bütün mövzular</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data" class="row mt-4 g-3 was-validated">

            <div class="d-flex">
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio1" name="optradio" value="1" checked >
                    <label class="form-check-label" for="radio1">Yayınla:</label>
                </div>
                <div class="form-check mx-5">
                        <input type="radio" class="form-check-input" id="radio2" name="optradio" value="0">
                        <label class="form-check-label" for="radio2">Gözlət:</label>
                </div>
            </div>

            <div class=" col-lg-6">
                <label for="formFile" class="form-label">Şəkil:</label>
                <input class="form-control" type="file" id="formFile" name="sekil" >
            </div>

            <div class=" col-lg-6">
                <label for="sekilurl" class="form-label">Şəkil url:</label>
                <input type="url" class="form-control" name="sekilurl" >
            </div>

            <div class="col-lg-6">
                <label for="sel" class="form-label">Kateqoriya*:</label>
                <select class="form-select form-control" aria-describedby="validationServer04Feedback" id="sel" name="kat_ad" required>
                    <option selected disabled value="">Kateqoriyalardan seçim edin</option>
                        <?php 
                        $katsql = "SELECT * FROM kateqoriyalar";
                        $katquery = $conn->query($katsql, PDO::FETCH_ASSOC);
                        if ( $katquery ){
                            foreach( $katquery as $katrow ){ ?>
                                <option><?=$katrow["kat_ad"];?></option>
                                <?php 
                            }
                        } 
                        ?>
                </select>
                <div class="invalid-feedback">Seçim etməmisiniz.</div>
            </div>

            <div class=" col-lg-6">
                <label for="basliq" class="form-label">Başlıq*:</label>
                <input type="text" class="form-control" name="basliq" required >
                <div class="invalid-feedback">Zəhmət olmasa bu sahəni doldurun.</div>
            </div>

            <div class=" col-lg-6">
                <label for="yazar" class="form-label">Yazar:</label>
                <input type="text" class="form-control" name="yazar">
            </div>

            <div class="col-12">
                <label for="mezmun" class="form-label">Məzmun*:</label>
                <textarea class="form-control" name="mezmun" required></textarea>
                <script>
                    CKEDITOR.replace( 'mezmun' );
                </script>
            </div>

            <button type="submit" name="yenile" class="btn btn-primary btn-lg mb-5">Daxil edin</button>
        </form>
    </div>
</main>