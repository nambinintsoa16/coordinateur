<div class="table-responsive">
	<table class="table table-hover table-bordered table-responsive-lg ">
		<thead>
			<tr class="bg-secondary text-white">	
				<th class="text-center">Code client</th>
				<th class="text-center">Nom client</th>	
				<th class="text-center">Téléphone</th>					
			</tr>
		</thead>
		<tbody>
			<?php foreach ($infoclient as $value): ?>
				<tr>
					<td><a href="#" class="codeclient"><?=$value->Code_client?></a></td>
					<td><a href="<?=$value->lien_facebook?>" target="_blank" ><?=$value->Compte_facebook?></a></td>
					<td><?=$value->contacts?></td>
				</tr>
			<?php endforeach ?>											
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('.codeclient').on('click', function (e) {
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

    });
</script>