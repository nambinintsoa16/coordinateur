<style>
.alert{
	width:100%;
}

</style>
<div class="container">
	<div class="row">
		<form method="POST" action="<?= base_url("Developpeur/assiduite/presence") ?>" class="col-md-12">
			<fieldset class="border p-1">
				<legend class="w-auto"><b class="text-sm">ASSIDUITE MENSUELLE</b></legend>
                <select class="form-control dateRecapS" style="width:100%">
                    <?php
                    $data = $mois;
                    foreach ($mois as $key => $mois) :
                        if ($key == date("m")) :
                    ?>
                            <option selected><?= $mois ?></option>
                        <?php else : ?>
                            <option><?= $mois ?></option>
                    <?php endif;
                    endforeach; ?>

                </select>
			</fieldset>
		</form>
		<hr />
		<div class="form-group col-md-12">
		<span class="date_collapse collapse"> <?php if ($date == "") {
														$date = date('Y-m-d');
													}
													echo $date; ?></span>
			<div class="table-responsive">
				<table class="table table-hover table-bordered table-responsive-lg tablepresence">
					<thead>
						<tr class="bg-secondary text-white">
							<th scope="col" style="font-size:12px" class="text-center">MATRICULE</th>
							<th scope="col" style="font-size:12px" class="text-center">NOM</th>
							<th scope="col" style="font-size:12px" class="text-center">SITUATION</th>
							<th scope="col" style="font-size:12px" class="text-center">RETARD</th>
							<th scope="col" style="font-size:12px" class="text-center">ABSENCE</th>
							<th scope="col" style="font-size:12px" class="text-center">PRESENCE</th>
							
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>