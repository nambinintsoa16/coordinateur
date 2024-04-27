<div class="container-md">
	<div class="row">
		<div class="col-6">
			<ul class="list-group list-group-flush">
			  <li class="list-group-item">Nom : <a href="<?= $lien?>" target="_blank"> <b> <?= $clients?></b></a>
 			</li>
			  <li class="list-group-item">Numéro : <?= $contact?></li>
			  <li class="list-group-item">Date du dernier Contact : <?= $dernier->heure?></li>
			  <li class="list-group-item">CA : <?= number_format($totalCA, 0, '.', ',')?> Ar</li>
			</ul>
		</div>
		<div class="col-6">
			<ul class="list-group list-group-flush">
			  <li class="list-group-item">Status : <span style="background:#fff;border-radius:3px; padding:3px 5px"> <?= $trimstatus?>   | <?= $annuelstatus?> </span></li>
			  <li class="list-group-item">Total Koty : <?= $KotyT ?> </li>
			  <li class="list-group-item">Total Smiles : <?= $SmilesT ?></li>			 
			</ul>
		</div>
	</div>
	<hr>
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered nowrap">
				<thead class="bg-info text-center">
					<tr>
						<th scope="col">Date</th>
						<th scope="col">Page</th>
						<th scope="col">Vendeur <br>pricipal</th>
						<th scope="col">Vendeur <br>secondaire</th>
						<th scope="col">Code produit</th>
						<th scope="col">Produit</th>
						<th scope="col">Nbr de produits</th>
						<th scope="col">Montant</th>
						<th scope="col">Gain Koty</th>
						<th scope="col">Gain Smiles</th>
					</tr>
				</thead>
				<tbody>
					<?= $data?>
				</tbody>
			</table>
		</div>
		
</div>
