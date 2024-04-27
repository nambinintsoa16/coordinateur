<div class="container" style="font-size: 8px;">
		<div class="border">
			<ul class="list-group list-group-flush">
			  <li class="list-group-item">Nomss : <?= $clients?>  </li>
			  <li class="list-group-item">Numéro : <?= $contact?></li>
			  <li class="list-group-item">Total achat : <?= number_format($totalCA, 0, '.', ',')?> Ar</li>
			  <li class="list-group-item bg-info text-white historique">Historiques de discussions</li>
			</ul>
		</div>
		<!--<div class="col-6">
			<ul class="list-group list-group-flush">
			  <li class="list-group-item">Status : <span style="background:#fff;border-radius:3px; padding:3px 5px"> <?= $trimstatus?>   | <?= $annuelstatus?> </span></li>
			  <li class="list-group-item">Total Koty : <?= $KotyT ?> </li>
			  <li class="list-group-item">Total Smiles : <?= $SmilesT ?></li>
			 
			</ul>
		</div>-->

	<span class="collapse codeclient"><?= $codeClient?></span>
	<hr>
	<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered  nowrap" >
				<thead class="bg-info text-white text-center" style="font-size:7px;">
					<tr>
						<th scope="col" style="font-size:7px;">Date</th>
						<th scope="col" style="font-size:7px;">Page</th>
						<th scope="col" style="font-size:7px;">Matricule</th>
						<th scope="col" style="font-size:7px;">Montant</th>
					</tr>
				</thead>
				<tbody style="font-size:7px;">
					<?= $data?>
				</tbody>
			</table>
		</div>
	</div>
<!--<script>
	$(document).ready(function(){
		$('.historique').on('click', function(e){

			var codeclient = $('.codeclient').text();
			 $.post(base_url + 'Operatrice/historique_discu', { codeclient: codeclient }, function(data) {
            $.alert({
                title: codeclient,
                content: data,
                columnClass: 'col-md-6',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',
                    buttons: {
                    fermer: {
                        btnClass: 'btn-red text-center', // multiple classes.
                        
                    },
                }

            });
        });
		})
		
	});
</script>-->
