<?php include 'notlink.php';?>

<div class="col-md-3 my-5  m-md-0">
	<div class="hit-header text-center text-white py-3 rounded-top"><strong>Ən çox izlənənlər</strong> </div>
	<?php
	
	$hit = "SELECT * FROM movzular WHERE movzu_veziyyet=1 order by movzu_gorulme_sayi DESC limit 3";
	$query = $conn->query($hit, PDO::FETCH_ASSOC);
	if ( $query ){
		foreach( $query as $row ){
			?>
			<div class="card mb-1 bg-white d-inline-block" >
				<a href="?sehife=kontent&id=<?php echo $row["movzu_id"];?>" class="btn btn-primary bg-white text-dark">
					<?php if($row['movzu_sekil'] !=null){ ?>
					<img class="card-img-top" src="<?php echo $row['movzu_sekil'];?>" alt="Card image" style="width:100%">
					<?php } ?>
					<div class="card-body">
						<h4 class="card-title"><?php echo $row["movzu_basliq"];?></h4>
						<p class="card-text"><?php echo substr($row["movzu_mezmun"],0,111);?>...</p>
						<div class=" text-center text-primary">
							<span class="bg-faded"><?php echo substr($row["movzu_tarix"],0,10);?></span>
						</div>
					</div>
				</a>
			</div>
			
				<?php
		}
	}else{echo '<div class="container-fluid alert alert-warning">Kontent tapılmadı.</div>';}
		?>
	</div>
</section>
</main>

<!---------------x------------- Main Site Section ---------------x-------------->