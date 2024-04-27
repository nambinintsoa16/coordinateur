<div class="container">
	<div class="row">
		<form method="POST" action="<?= base_url("Developpeur/assiduite/presence") ?>" class="col-md-12">
			<fieldset class="border p-1">
				<legend class="w-auto"><b class="text-sm">Assiduité journalière</b></legend>
				<div class="form-group col-md-12">
					<div class="input-group">

						<input type="date" class="form-control" value="<?php echo $date ?>" name="date">
						<div class="input-group-prepend">
							<button type="submit" class="btn btn-success but btn-success-sm p-1"> valider</button>
						</div>
					</div>
				</div>
			</fieldset>
		</form>
		<hr />
		<div class="form-group col-md-12">
		<span class="date_collapse collapse"> <?php if ($date == "") {
														$date = date('Y-m-d');
													}
													echo $date; ?></span>
			<div class="table-responsive">
				<table class="table table-hover table-bordered table-responsive-lg DataTables">
					<thead>
						<tr class="bg-secondary text-white">
							<th class="collapse"></th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>1ère session</th>
							<th scope="col" style="font-size:12px" class="text-center">Matricule</th>
							<th scope="col" style="font-size:12px" class="text-center">Nom</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>1ère discu</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>Fin discu</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>1ère tâche</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>Fin tâche</th>
							<th scope="col" style="font-size:12px" class="text-center">Intervalle<br>d'heure</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?=$data?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>