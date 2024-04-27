<div class="container col-md-12">
	<div class="row">
		<form method="POST" action="<?= base_url("Developpeur") ?>" class="col-md-12">
			<fieldset class="border p-1">
				<legend class="w-auto"><b class="text-sm">ETAT JOURNALIER</b></legend>
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
						<tr class="bg-primary text-white">
							<td class="col_1">TOTAL</td>
							<td class="text-center"></td>
							<!--<td class="text-center"><a href="" class="totalps text-white" data-toggle="modal" data-target="#exampleModalCenter"><?= number_format($cajour, 0, ',', ' ') ?></a></td>-->
							<td class="text-center"><a href="" class="totalp text-white" ><?= number_format($cajour, 0, ',', ' ') ?></a></td>
							<td class="text-center"><a href="" class="totalpo  text-white"><?= number_format($totalcalivre, 0, ',', ' ') ?></a></td>
							<td class="text-center"><a href="" class="totalpro  text-white"><?= number_format($totalnonlivre, 0, ',', ' ') ?></a></td>
							<td class="text-center text-white"><a href="" class="totalcalivre  text-white"><?= number_format($sommes, 0, ',', ' ') ?></a></td>
							<td class="text-center text-white"><a href="" class="totalsomme  text-white"><?= number_format($totalsomme, 0, ',', ' ') ?></a></td>
							<td class="text-center"><a href="" class="totalconfirmer  text-white"><?= number_format($totalconfirmer, 0, ',', ' ') ?></a></td>
							<td class="text-center text-white"><?php
							$pourtange = 0;
							if($totalsomme != 0){
								$pourtange = ($totalcalivre*100)/$totalsomme;
							 }
							echo number_format($pourtange, 2, ',', ' '); ?></td>
						</tr>
						<tr class="bg-secondary text-white">
							<th class="collapse"></th>
							<th scope="col" class="col_1">Matricule</th>
							<th scope="col" class="text-center">Nom</th>
							<th scope="col" class="text-center">Previsionnel</th>
							<th scope="col" class="text-center">Livré/terrain</th>
							<th scope="col" class="text-center">Non_livré <br> du_jour</th>
							<th scope="col" class="text-center">Livraison<br> réelle du jour</th>
							<th scope="col" class="text-center">Livraison<br> prévi du jour</th>
							<th scope="col" class="text-center">Livraison <br> pour demain</th>
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

