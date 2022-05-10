<?php include 'notlink.php'; ?>

<div class=" col-md-6 mx-md-2">
	<?php
	if ( $query ){
		foreach( $query as $row ){
			?>
			<div class="card mb-5">
				<?php if($row['movzu_sekil'] !=null){ ?>
				<img class="card-img-top" src="<?php echo $row['movzu_sekil'];?>" alt="Card image" style="width:100%">
				<?php } ?>
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<span class="bg-faded"><?php echo $row["movzu_tarix"];?></span>
						<i class="fa fa-eye"> <?php echo $row["movzu_gorulme_sayi"];?></i>
					</div>

					<h4 class="card-title"><?php echo $row["movzu_basliq"];?></h4>
					<p class="card-text"><?php echo substr($row["movzu_mezmun"],0,200);?>...</p>
					<a href="?sehife=kontent&id=<?php echo $row["movzu_id"];?>" class="btn btn-primary">Davamı <i class="fas fa-arrow-right"></i></a>
				</div>
			</div>
			<?php
		}
	}else{echo '<div class="container-fluid alert alert-warning">Kontent tapılmadı.</div>';}
	?>

	<!-- -----------x---------- Site Content -------------x------------>

<!-------------------- Pagination --------------->
<?php include 'pagination.php'; ?>
<!---------x---------- Pagination --------x------>
</div>
<?php include 'hit.php';?>

