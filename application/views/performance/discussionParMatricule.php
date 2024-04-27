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
            <form class="col-md-12 w-100">
                    <fieldset class="border bg-light p-1 w-100">
                    <legend class="w-auto"><b class="text-sm">Etat de discussion journalière par matricule <span id="date_content"><?=date('d-m-Y')?></span></b></legend>    
                    <div class="row">
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="date_perf">
                         </div>
                        <div class="col-md-4">
                            <button class="btn btn-success" id="valid_perf">Valider</button> 
                        </div>
                    </div>                
                    </fieldset>
                </form>
                <div class="col-md-12 mt-2">
                    <div class="table-responsive w-100">
                        <table class="table table-striped table-bordered-bd-secondary table-responsive-lg table-hover tableResult table-head-bg-secondary">
                            <thead>
                                <tr>
                                    <th class="test"></th>
                                    <th></th>
                                    <th class="text-sm text-center">TOTAL</th>
                                    <th class="text-sm text-center">ANCIENS CLIENTS</th>
                                    <th class="text-sm text-center">NOUVEAUX CLIENTS</th>
                                   
                                </tr>
                                <tr>
                                    <th class="test"></th>
                                    <th></th>
                                    <th class="text-sm text-center"></th>
                                    <th class="text-sm text-center"></th>
                                    <th class="text-sm text-center"></th>
                                   
                                </tr>
                            </thead>
                            <tbody class="text-sm text-center">
                                <!-- <?php foreach ($oplg as $value): ?>                  
                                <tr>
                                    <td  class="tbody text-center"><?= substr($value->Matricule_personnel, 0, 7)?></td>                                    
                                    <td  class="tbody text-center"></td>  
                                    <td  class="tbody text-center"><?= $this->accueil_model->countAncienClient($value->Matricule_personnel)?></td> 
                                    <td  class="tbody text-center"><?= $this->accueil_model->countNvxClient($value->Matricule_personnel)?></td>
                                </tr>
                                <?php endforeach ?> -->
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

			
