<div class="container">
  <div class="profile-card">
  	<fieldset>
	  	<div class="row col-md-12 ">
		    <div class="col-md-4">
		      <img alt="<?= $infoclient->Code_client ?>" src="<?=code_client_img_link($infoclient->Code_client)?>"  class="img-thumbnail avatar mt-3" style="height:100%; width: 200px;">
		    </div>
		    <div class="col-md-8  mt-4">
		    	<div class="">	    		
			    	<li>Nom: <a href ="<?= $infoclient->lien_facebook?>" target="_blank"><?= $infoclient->Nom ?></a></li>
			    	<li>Tél: <?php if($profil){echo $profil->contacts;}else{ echo "Null";}  ?></li>
			    	<li>Achats: <?= number_format($ca, 0, ',', ' ')?> Ar</li>		    	
			    </div>		    
		    </div>
	    </div>
    </fieldset>
    <hr>
    <hr>
    <div class="form-group mt-10">
    	<div class="table-responsive-lg">
			<table class="table table-hover table-bordered tableprofil ">
				<thead>
					<tr class="bg-secondary text-white">				
						<th class="text-center">Date</th>
						<th class="text-center">Produit</th>
						<th class="text-center">Montant</th>											
					</tr>
					</thead>
					<tbody>
						<?php foreach ($facture as $value): ?>
							<tr>
								<td><?= $value->data_de_livraison?></td>
								<td><?= $value->Code_produit?></td>
								<td><?= number_format($value->Quantite * $value->Prix_detail, 0, ',', ' ') ?></td>
							</tr>
						<?php endforeach ?>

					</tbody>
			</table>
		</div>
    </div>
  </div>
</div>


