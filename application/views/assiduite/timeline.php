<div class="container col-md-12">
	 
	<div class="card fixed col-md-12">
		<div class="row">
			<div class="col-md-3">
				<?php foreach ($infoclient as $key): ?>
					<h4 class="text-center"><?=$key->Prenom ?></h4>
					<span class="collapse codeclient"><?=$key->Matricule?></span>
				<?php endforeach ?>
			</div>
			<div class="col-md-3">
				<h4 class="text-center"><?php echo date('Y-m-d')?></h4>
			</div>
			<div class="col-md-3">
				<h4 class="text-center"><a href="#" class="CAJ">CAJ : <?= number_format($caj, 0, ',', ' ')?> Ar</a> </h4>
			</div>
			<div class="col-md-3">
				<h4 class="text-center"><a href="#" class="CAM">CAM : <?= number_format($ca, 0, ',', ' ')?> Ar </a></h4>
			</div>
		</div>
	</div>
	
	
	<div class="table-responsive">
		<table class="table table-hover table-bordered table-responsive-lg ">
			<thead>
				<tr class="bg-secondary text-white">				
					<th class="text-center">Heure</th>
					<th class="text-center">Tâche</th>
					<th class="text-center">Action</th>	
					<th class="text-center"><a href="#" class="text-white listeclient">Code client</a></th>
					<th class="text-center">Cannaux de <br> discussion</th>					
				</tr>
			</thead>
			<tbody>
				<?php foreach ($result as $value): ?> 
					<tr>
						<td><?= $value->heure?></td>
						<td><?= $value->tache?></td>
						<td><?= strtoupper($value->action)?></td>
						<td><a href="#" class="clientprofil"><?= $value->client?></a></td>
						<td><?= strtoupper($value->Nom_page)?></td>
					</tr>
				<?php endforeach ?>											
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('.clientprofil').on('click', function (e) {
	        e.preventDefault();
	        var code_client = $(this).text();
	         $.post(base_url + 'Assiduite/profilClient', { code_client: code_client }, function (data) {
	            $.alert({
	                title: "",
	                content: data,
	                columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
	                boxWidth: '400px',
	                useBootstrap: false,
	                buttons: {
	                    OK : {
	                    text: 'Fermer',
	                    btnClass: 'btn-blue',
	                    },
	                }

	                
	            });
	        });      

        	});
		

        $('.listeclient').on('click', function (e) {
        	 e.preventDefault();
	        var code_client = $('.codeclient').text();
	         $.post(base_url + 'Assiduite/listeClients', { code_client: code_client }, function (data) {
	            $.alert({
	                title: "",
	                content: data,
	                columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
	                boxWidth: '80%',
	                useBootstrap: false,
	                buttons: {
	                    OK : {
	                    text: 'Fermer',
	                    btnClass: 'btn-blue',
	                    },
	                }

	                
	            });
	        });
		});


		$('.CAJ').on('click', function(e){
			e.preventDefault();
			var matricule = $('.codeclient').text();
			   $.post(base_url + 'Assiduite/clientAvecAchat', { matricule: matricule }, function (data) {
	            $.alert({
	                title: "",
	                content: data,
	                resizable: true,
	                columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
	                boxWidth: '400px',
	                useBootstrap: true,
	                buttons: {
	                    OK : {
	                    text: 'Fermer',
	                    btnClass: 'btn-blue',
	                    },
	                }

	                
	            });
	        });
		});

			$('.CAM').on('click', function(e){
			e.preventDefault();
			var matricule = $('.codeclient').text();
			   $.post(base_url + 'Assiduite/clientAvecAchatMensuel', { matricule: matricule }, function (data) {
	            $.alert({
	                title: "",
	                content: data,
	                resizable: true,
	                columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
	                boxWidth: '400px',
	                useBootstrap: true,
	                buttons: {
	                    OK : {
	                    text: 'Fermer',
	                    btnClass: 'btn-blue',
	                    },
	                }

	                
	            });
	        });
		});


    });
</script>