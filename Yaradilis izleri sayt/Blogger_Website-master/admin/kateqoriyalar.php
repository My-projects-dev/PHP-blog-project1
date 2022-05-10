<?php include '../notlink.php'; 

if(isset($_GET['sil'])){
	$sqlsil="DELETE FROM `kateqoriyalar` WHERE `kateqoriyalar`.`kat_id` = ?";
	$sorgusil=$conn->prepare($sqlsil);
	$sorgusil->execute([ $_GET['sil'] ]);
}

if (isset($_POST["kat_insert"])){

	$kat_ad = $_POST['katAd'];

	$kat_ad_query = "SELECT kat_ad FROM kateqoriyalar WHERE kat_ad = :ad";
	$querykat = $conn->prepare($kat_ad_query);
	$querykat->bindValue(':ad', $kat_ad, PDO::PARAM_STR);
	$querykat->execute();
	$query = $querykat->fetch(PDO::FETCH_ASSOC);

	if ($query) {
		echo  '
		<div class="container">
		<div class="alert alert-danger alert-dismissible fade show">
		<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
		<strong> Bu adda kateqoriya var. Yükləmə tamamlanmadı.</strong> 
		</div>
		</div>';
	}else{
		$sql = "INSERT INTO `kateqoriyalar` (`kat_ad`) VALUES (?)";
		$sorgu = $conn->prepare($sql);
		$sorgu->execute([$kat_ad]);

		//header("refresh");
		header('Location: ?sehife=kateqoriyalar');
	}
}

if (isset($_POST["kat_update"])){
	
	$kat_ad = $_POST['katAd'];
	$Id = $_POST['katId'];

	$kat_ad_query = "SELECT kat_ad FROM kateqoriyalar WHERE kat_ad = :ad";
	$querykat = $conn->prepare($kat_ad_query);
	$querykat->bindValue(':ad', $kat_ad, PDO::PARAM_STR);
	$querykat->execute();
	$query = $querykat->fetch(PDO::FETCH_ASSOC);

	if ($query) {
		echo  '
		<div class="container">
		<div class="alert alert-danger alert-dismissible fade show">
		<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
		<strong> Bu adda kateqoriya var.</strong> 
		</div>
		</div>';
	}else{
		$sql = "UPDATE `kateqoriyalar` SET `kat_ad` = ? WHERE `kateqoriyalar`.`kat_id` = ?";
		$massiv=[
			$kat_ad,
			$Id
		];
		$sorgu = $conn->prepare($sql);
		$sorgu->execute($massiv);

		header("refresh");
	}	
}
?>

<div class="container mt-3">
	<h2 class="mb-3">Kateqoriyalar</h2>

	<button type="button" class="btn btn-primary my-2 " data-bs-toggle="modal" data-bs-target="#InsertModal"><i class="fa fa-plus" aria-hidden="true"> Kateqoriya əlavə et</i></button>

	<div class="table-responsive">
		<table class="table table-dark table-striped table-hover ">
			<thead>
				<tr>
					<th>#</th>
					<th class="">Kategoriya adı</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$all_kat = "SELECT * FROM kateqoriyalar";
				$query = $conn->query($all_kat, PDO::FETCH_ASSOC);
				$i=0;
				if ( $query ){
					foreach( $query as $row ){
						$i++;
						?>
						<tr>
							<td><?=$i?></td>
							<td class="w-75"><?=$row["kat_ad"]?></td>

							<td>
								<div class="d-flex justify-content-end">
									<button type="button" class="btn btn-warning mx-1 text-white flex-nowrap" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="<?=$row["kat_id"]?>" data-bs-ad="<?=$row["kat_ad"]?>"><i class="fa fa-pencil-square-o mx-1" aria-hidden="true"> Dəyişdir</i></button>

									<a href="?sehife=kateqoriyalar&sil=<?=$row["kat_id"];?>" onclick="return confirm('Silmək istədiyinizə əminsiniz?')" class="btn bg-danger mx-1 text-light">
										<i class="fa fa-trash-o" aria-hidden="true"> Sil</i>
									</a>
								</div>
							</td>
						</tr>
						<?php  
					}
				}?>
			</tbody>
		</table>
	</div>
</div>

<!-- Insert Modal -->
<div class="modal fade" id="InsertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Yani kateqoriya əlavə et</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="" method="post">
				<div class="modal-body">   
					<div class="mb-3">
						<label for="recipient-name" class="col-form-label">Kateqoriya adı:</label>
						<input type="text" class="form-control" id="recipient-name" name="katAd">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
					<button type="submit" class="btn btn-primary" name="kat_insert">Əlavə et</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /#Insert Modal -->

<!-- Update Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New message</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="" method="post">
				<div class="modal-body">					
					<div class="mb-3">
						<label for="recipient-name" class="col-form-label">Kateqoriya adı:</label>
						<input type="hidden" class="form-control" name="katId">
						<input type="text" class="form-control" id="recipient-name" name="katAd">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
					<button type="submit" class="btn btn-primary" name="kat_update">Yenilə</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /#Update Modal -->

<!-- Update Modal Script-->
<script>
	var exampleModal = document.getElementById('exampleModal')
	exampleModal.addEventListener('show.bs.modal', function (event) {
  // Modalı işə salan düymə
  var button = event.relatedTarget
  // Data-bs-* atributlarından məlumat çıxarın
  var recipientId = button.getAttribute('data-bs-id')
  var recipientName = button.getAttribute('data-bs-ad')
  // Lazım gələrsə, burada bir AJAX sorğusu başlata bilərsiniz
  // və sonra geri çağırışda yeniləməni edin.
  //
  // Modalın məzmununu yeniləyin.
  var modalTitle = exampleModal.querySelector('.modal-title')
  var modalBodyInput = exampleModal.querySelector('.modal-body input')
  var modalBodyInputName = exampleModal.querySelector('.modal-body #recipient-name')


  modalTitle.textContent = 'Yenidən adlandır '
  modalBodyInput.value = recipientId
  modalBodyInputName.value = recipientName
})
</script>
<!-- /#Update Modal Script-->