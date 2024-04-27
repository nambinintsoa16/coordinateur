<div class="form">
	<div>
		<legend class="bg-primary"><h5 class="text-white text-center">Performance commerciale</h5></legend>
	</div>
	<div class="table-responsive">
		<table class="table table-striped  table-hover table-bordered DataTable">
			<thead class="bg-secondary text-white">
				<tr >
					<th class="collapse"></th>
					<th style="font-size: 9px;">Page / Compte</th>
					<th style="font-size: 9px;">Nouv clts</th>
					<th style="font-size: 9px;">Clts fidèles</th>
					<th style="font-size: 9px;">Ratio</th>
				</tr>
				
			</thead>
			<tbody >
				<!--<?php foreach ($page as $value): ?>
					<tr>
						<td class="collapse" style="font-size: 9px;"><?=$value->id?></td>
						<td style="font-size: 9px;"><?=strtoupper($value->Nom_page)?></td>
						<td style="font-size: 9px;"></td>
						<td style="font-size: 9px;"></td>
						<td style="font-size: 9px;"></td>
					</tr>
				<?php endforeach ?>-->	
				<?=$content?>			
			</tbody>
		</table>
		
	</div>
</div>
