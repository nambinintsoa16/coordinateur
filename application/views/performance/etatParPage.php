<style type="text/css">
 table.dataTable tbody td {
    padding-right: 5px;
    height: 30px !important;
    font-size: 14px !important;
    width: 200px !important;
}
.test{
    width: 100px;
}
</style>
<div class="content col-md-12">
		<div class="page-inner mt-3">
			<div class="row">
                <form class="col-md-12">
                    <fieldset class="border bg-light p-1">
                    <legend class="w-auto"><b class="text-sm">Etat de discussion journalière par page </b><span id="date_content"><?=$date?></span></b></legend>    
                    <div class="row">
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="date" id="date_perf">
                         </div>
                        <div class="col-md-4">
                            <button class="btn btn-success" id="valid_perf">Valider</button> 
                        </div>
                    </div>                                  
                    </fieldset>
                </form>
                <div class="col-md-12 mt-2">
                    <div class="table-responsive w-100">
                        <table class="table table-striped table-bordered-bd-secondary table-responsive-lg table-hover tableResult ">
                            <thead>
                                <tr class="bg-secondary text-white">
                                    <th></th>
                                    <th></th>
                                    <th class="text-sm text-center">TOTAL</th>
                                    <th class="text-sm text-center">ANCIENS CLIENTS</th>
                                    <th class="text-sm text-center">NOUVEAUX CLIENTS</th>
                                   
                                </tr>
                                <tr class="bg-primary text-white">
                                    <th></th>
                                    <th></th>
                                    <th class="text-sm text-center"></th>
                                    <th class="text-sm text-center"></th>
                                    <th class="text-sm text-center"></th>
                                   
                                </tr>
                            </thead>
                            <tbody class="text-sm text-center">
                                <?php foreach ($page as $value): ?>                  
                                <tr>
                                    <td><?=$value->Code_page?></td>
                                    <td  class="tbody text-left"><?=strtolower($value->Nom_page)?></td>                                    
                                    <td  class="tbody text-center"><?= $this->accueil_model->countClientParPage($value->Code_page,$date)?></td>  
                                    <td  class="tbody text-center"><?= $this->accueil_model->countClientParPage($value->Code_page,$date) - $this->accueil_model->NvxClientParPage($value->Code_page,$mois,$date)?></td> 
                                    <td  class="tbody text-center"><?= $this->accueil_model->NvxClientParPage($value->Code_page,$mois,$date)?></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

			
