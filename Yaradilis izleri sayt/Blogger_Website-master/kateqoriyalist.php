<?php include 'notlink.php'; 

try {
	$slkat = "SELECT * FROM kateqoriyalar";
	$query = $conn->query($slkat, PDO::FETCH_ASSOC);
} catch (Exception $e) {
	echo '<div class=" mx-5 alert alert-warning">Kateqoriyalar yüklənə bilmədi</div>'; exit();
}
?>

<main class="">
	<section class="d-md-inline-flex justify-content-between m-4">
		
		<aside class="mb-4 col-auto"> <!-- col-lg-2-->
			
			<div class="category-list-header p-3 d-flex justify-content-between text-white rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#kateqori"  ><strong>Kateqoriyalar&nbsp </strong>
				<i class="fa fa-bars d-md-none" style="font-size:24px"></i>
			</div>
			<div class="collapse show" id="kateqori">
				<ul class="list-group">

					<?php
					
					if ( $query->rowCount() ){
						foreach( $query as $row ){

							$kat_id = $row['kat_id'];
							$katcontent = "SELECT * FROM movzular WHERE movzu_veziyyet=1 and kat_id=?";
							$querykatcont = $conn->prepare($katcontent);
							$querykatcont->execute([$kat_id]);
							$count = $querykatcont->rowCount();
							?>
							<a class="list-group-item d-flex justify-content-between align-items-center list-group-item-action"
							href="?sehife=kateqoriya&id=<?php echo $kat_id;?>">
							<?php echo $row["kat_ad"];?>
							<span class="badge bg-primary rounded-pill mx-1" ><?php echo $count; ?></span>
						</a>
						<?php
					}
				}
				?>
			</ul>
		</div>
	</aside>