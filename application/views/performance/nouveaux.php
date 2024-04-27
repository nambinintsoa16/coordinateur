<style type="text/css">
 table.dataTable tbody td {
    padding-right: 5px;
    height: 30px !important;
    font-size: 14px !important;
    width: 150px !important;
}

</style>
<div class="content col-md-12">
		<div class="page-inner mt-3">
			<div class="row">
                <form class="col-md-12">
                    <fieldset class="border bg-light p-1">
                    <legend class="w-auto"><b class="text-sm">Etat discussion nouveaux clients</b></legend> <span id="date_content"><?=date('d-m-Y')?></span></b></legend>  
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="date_perf">
                         </div>
                        <div class="col-md-4">
                           <button class="btn btn-success" id="valid_perf">Valider</button>          					
                    </fieldset>
                </form>
                <div class="col-md-12 mt-2">
                    <div class="table-responsive w-100">
                        <table class="table table-striped table-bordered-bd-secondary table-responsive-lg table-hover tableResult">
                            <thead>
                                <tr class="bg-secondary text-white">
                                    <th class="text-sm text-center">MATRICULE</th>
                                    <th class="text-sm text-center test">OPLG</th>
                                    <th class="text-sm text-center">PAGE</th>
                                    <th class="text-sm text-center">NOMBRE CLIENTS</th>
                                   
                                </tr>
                                 <tr class="bg-primary ">
                                    <th class="text-sm text-center"></th>
                                    <th class="text-sm text-center test"></th>
                                    <th class="text-sm text-center"></th>
                                    <th class="text-sm text-center text-white"><?=$result?></th>
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                    <div class="content">
                    <div class="page-inner mt-3">
                        <div class="row">
                            <form class="col-md-12">
                                <fieldset class="border bg-light p-1">
                                <legend class="w-auto"><b class="text-sm">Liste des clients</b></legend>
                                <div class="col-md-12 m-auto">
                                                                 
                                    
                                </div>  
                                <div class="col-md-12 info_opl">
                                    
                                </div>

                                </fieldset>
                            </form>
                            <div class="col-md-12 mt-2">
                                <div class="table-responsive w-100">
                                    <table class="table table-striped table-bordered-bd-secondary table-responsive-lg table-hover tableListe table-head-bg-secondary">
                                        <thead>
                                            <tr>
                                                <th class="text-sm text-center">Code client</th>
                                                <th class="text-sm text-center">Nom client</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm text-center">
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</div>
</div>
</div>
</div>

			
