<div class="container">
	<div class="table-responsive-lg">
		<table class="table table-bordered table-stripted table-hover tableClient">
			<thead class="bg-primary text-white text-center">
				<tr>
					<th>CODE CLIENT</th>
					<th>COMPTE FACEBOOK</th>
					<th>LIEN FACEBOOK</th>
				</tr>		
			</thead>
			<tbody>

				<?php foreach ($liste as $value):?>
				<tr>
					<td><?= $value->Code_client ?></td>
					<td><?= $value->Compte_facebook ?></td>
					<td><a href="<?= $value->lien_facebook ?>" target="_blank"><?= $value->lien_facebook ?></a></td>
				</tr>
				 <?php endforeach ?>
				 
				
			</tbody>
		</table>
	</div>
</div>