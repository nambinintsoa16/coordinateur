<div class="table-responsive">
	<table class="table table-hover table-bordered table-responsive-lg ">
		<thead>
			<tr class="bg-secondary text-white">				
				<th class="text-center">Heure</th>
				<th class="text-center">Code client</th>
				<th class="text-center">Nom client</th>						
			</tr>
		</thead>
		<tbody>
			<?php foreach ($infoclient as $value): ?>
				<tr>
					<td><?=$value->heure?></td>
					<td><a href="#" class="codeclient"><?=$value->client?></a></td>
					<td><a href="<?=$value->lien_facebook?>" target="_blank" ><?=$value->Nom?></a></td>
					
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