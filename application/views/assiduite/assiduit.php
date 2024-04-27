<div class="container">
	<div class="row">
		<form method="POST" action="<?= base_url("Developpeur/assiduite/assiduit") ?>" class="col-md-12">
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
							<th scope="col" style="font-size:12px" class="text-center">Matricule</th>
							<th scope="col" style="font-size:12px" class="text-center">Nom</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>1ère session</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>1ère discu</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>Fin discu</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>1ère tâche</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>Fin tâche</th>
							<!--<th scope="col" style="font-size:12px" class="text-center">Intervalle<br>d'heure</th>
							<th></th>-->
						</tr>
					</thead>
					<tbody>
						<?php foreach ($oplg as $key => $value): ?>
						<tr>
							<td class="collapse"><?=$value->operatrice?></td>
							<td><a href="#" class="matricule" ><?=substr($value->operatrice,0, 7)?></a></td>
							<!--<td><a href="#" class="matriculessss" data-toggle="modal" data-target="#exampleModalCenter"><?=substr($value->operatrice,0, 7)?>--></a></td>
							<td><a href="#" class="prenom"><?=$value->Prenom?></a></td>							
							<td><?php if($pres= $this->accueil_model->heure($value->operatrice,$date)){
                					echo ($pres->heure);
            						}else{
               						 $pres ="";
               						} ?></td>
							<td><?php if($premDiscu = $this->accueil_model->heure_premiere_discussion($value->operatrice,$date)){
									echo ($premDiscu->heure);
            						}else{
               						 $premDiscu ="";
               						} 
									?></td>
							<td><?php if($FinDiscu = $this->accueil_model->heure_derniere_discussion($value->operatrice,$date)){
									echo ($FinDiscu->heure);
            						}else{
               						 $FinDiscu ="";
               						} 
									?></td>
							<td><?php if($heureDtache=$this->accueil_model->debut_tache($value->operatrice,$date)){
									echo ($heureDtache->heure);
            						}else{
               						 $heureDtache ="";
               						} 
									?></td>
							<td><?php if($heureFtache=$this->accueil_model->fin_tache($value->operatrice,$date)){
									echo ($heureFtache->heure);
            						}else{
               						 $heureFtache ="";
               						} 
									?></td>
							<!--<td></td>
							<td></td>-->
						<?php endforeach ?>
						</tr>						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover table-bordered table-responsive-lg tabletime ">
						<thead>
							<tr class="bg-secondary text-white">				
								<th class="text-center">Heure</th>
								<th class="text-center">Tâche</th>
								<th class="text-center">Action</th>	
								<th class="text-center">Code client</th>
								<th class="text-center">Cannaux de <br> discussion</th>					
							</tr>
						</thead>
						<tbody>
																	
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>


