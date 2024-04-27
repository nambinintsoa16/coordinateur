<div class="container col-md-12">
	<div class="row">
		<form method="POST" action="<?= base_url("Developpeur") ?>" class="col-md-12">
			<fieldset class="border p-1">
				<legend class="w-auto"><b class="text-sm">Rapport de relance</b></legend>
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
				<table class="table table-striped  table-hover table-bordered DataTable ">
					<thead>
						<tr class="bg-secondary text-white">
							<th class="collapse"></th>
							<th scope="col" class="col_1">Matricule</th>
							<th scope="col" class="text-center">Nom</th>
						    <th scope="col" class="text-center">Page</th>
							<th scope="col" class="text-center">Previsionnel<br>du Jour</th>
							<th scope="col" class="text-center">Réaliser<br>du Jour</th>
							<th scope="col" class="text-center">Reste Réaliser<br> du_jour</th>
							<th scope="col" class="text-center">Global</th>
							<th scope="col" class="text-center">Réaliser</th>
							<th scope="col" class="text-center">Reste à Réaliser</th>
							<th scope="col" class="text-center">Taux(%)</th>
						</tr>
					</thead>
					<tbody>
						<?= $data ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center text-white bg-primary col-md-12" id="exampleModalLongTitle">PERFORMANCE COMMERCIALE<?php echo $this->input->get('matricule')?>
				</h5>	
				
			</div>
			
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover table-striped table-condensed table-bordered table-responsive-lg tableperformance ">
						<thead>
							<tr class="bg-secondary text-white">										
								<th class="text-center">Page/compte</th>
								<th class="text-center">Total</th>
								<th class="text-center">Nouveaux clients</th>
								<th class="text-center">Clients existants</th>	
								<th class="text-center">Clients curieux</th>				
							</tr>
						</thead>
						<tbody>
																	
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>

