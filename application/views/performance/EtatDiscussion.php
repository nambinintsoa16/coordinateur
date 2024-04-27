<style type="text/css">
 table.dataTable tbody td {
    padding-right: 5px;
    height: 30px !important;
    font-size: 14px !important;
    width: 200px !important;
}
</style>
<div class="container col-md-12">
	<div class="page-inner mt-3">
		<form class="col-md-12">
            <fieldset class="border bg-light p-1">
                <legend class="w-auto"><b class="text-sm">Etat de discussion hebdomadaire</b></legend>                    
            </fieldset>
        </form>
        <div class="col-md-12 mt-2">
			<div class="table-responsive">
				<table class="table table-striped table-bordered-bd-secondary table-responsive-lg table-hover tableResult table-head-bg-secondary">
					<thead>
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<?php foreach ($date as $value): ?>
								<th><?= $value->Date?></th>
							<?php endforeach ?>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($oplg as $value): ?>                  
	                <tr>                         
	                    <td  class="tbody text-center"><?= substr($value->Matricule_personnel, 0, 7)?></td>
	                    <td  class="tbody text-left"><?= $value->Prenom?></td>	                     
         					<?php $page = $this->accueil_model->codification_page($value->Matricule_personnel);
	            				if ($page) {
	              					$page_name = $page->Code_page;
	            				} else {
	              					$page_name = "";
            				}?>
	                    <td class="text-center"><?=$page_name?></td>    
	                    <?php foreach ($date as $key): ?> 
	                    	<td  class="tbody text-center"><?= count($this->accueil_model->countNvxClients($value->Matricule_personnel, $key->Date))?></td>                       
	                    <?php endforeach ?>  
	                </tr>
	            	<?php endforeach ?>
							
					</tbody>				
				</table>		
			</div>
		</div>
	</div>	
</div>