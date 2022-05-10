	<?php include 'notlink.php'; ?>
	

	<nav class="container-fluid">
		<ul class="pagination justify-content-center">
			<?php if($Sayfa > 1){?>
				<li class="page-item">
					<a class="page-link" href="?<?=$sehifeLink?>sehifeno=1" aria-label="Previous">
						<i class="fa fa-angle-double-left" aria-hidden="true"></i>
					</a>
				</li>
				<li class="page-item">
					<a class="page-link" href="?<?=$sehifeLink?>sehifeno=<?=$Sayfa - 1?>" aria-label="Previous">
						<i class="fa fa-angle-left" aria-hidden="true"></i>
					</a>
				</li>
			<?php } ?>

			<?php 
    for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ // i necedirse o reqemden  başlar 1-2-3-4-5 yazmaga. məs: səhifə 7dəyik 7 - 5 = 2'dir 2-ci səhifədən sonra səhifələməyə başlar yəni 2-3-4-5-6-7

    if($i > 0 and $i <= $Sayfa_Sayisi){

    	if($i == $Sayfa){

			//əgər i ilə səhifə dəyərləri eynidirsə aktiv et
    		echo '<li class="page-item active"><a class="page-link" href="?'.$sehifeLink.'sehifeno='.$i.'">'.$i.'</a></li>';

    	}else{echo '<li class="page-item"><a class="page-link" href="?'.$sehifeLink.'sehifeno='.$i.'">'.$i.'</a></li>';}
    }
}
?>
<?php if($Sayfa != $Sayfa_Sayisi){?>
	<li class="page-item">
		<a class="page-link" href="?<?=$sehifeLink?>sehifeno=<?=$Sayfa + 1?>" aria-label="Next">
			<i class="fa fa-angle-right" aria-hidden="true"></i>
		</a>
	</li>
	<li class="page-item">

		<a class="page-link" href="?<?=$sehifeLink?>sehifeno=<?=$Sayfa_Sayisi?>" aria-label="Next">
			<i class="fa fa-angle-double-right" aria-hidden="true"></i>
		</a>
	</li>
<?php } ?>
</ul>
</nav>