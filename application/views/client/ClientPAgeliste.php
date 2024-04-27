<?php $CI     = & get_instance();?>
<div class="container">
	<div class="row">
    <div class="col-md-12">
       <a href="<?=base_url("Developpeur/client/export_pageClient")?>">Export</a>
    </div>  
		<div class="table">
			<table class="table table-stripted table-hover table-sm table-bordered table-responsive">
               <thead class="bg-primary text-white">
               	 <tr >
               	 	<th style="font-size: 12px;">ID</th>
               	 	<th style="font-size: 12px;">CODE CLIENT</th>
               	 	<th style="font-size: 12px;">CLIENT</th>
               	 	<?php foreach ($pageliste as $key => $pageliste) :?>
               	 		<th style="font-size: 12px;"><?= $pageliste->Nom_page?>
               	 	<?php endforeach;?>
               	 </tr>
               </thead>		
               <tbody>
                <?php foreach ($client as $client): ?>
                       <tr>
                              <td><?= $client['id']?></td>
                              <td><?= $client['Code_client']; ?></td>
                              <td><?= $client['Nom']; ?></td>
                              <?= $client['donne'] ?>
                              <?php //$CI->dataClientPage($client->Code_client);?>
                            </tr>
                        <?php endforeach; ?>
               </tbody>		
			</table>
			<p><?=$links?></p>
		</div>
	</div>
</div>
