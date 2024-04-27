<div class="container">
    <form method="POST" action="<?= base_url("Developpeur/performance/like") ?>" class="col-md-12">
        <fieldset class="border p-1">
            <legend class="w-auto"><b class="text-sm">STATISTIQUE DE RELANCE CLIENTELE</b></legend>
            <div class="form-group col-md-12">
                <div class="input-group">

                    <input type="date" class="form-control" value="<?php echo $date ?>" name="date">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-success but btn-success-sm p-1"> valider</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <span class="date_collapse collapse"> <?php if ($date == "") {
                                                $date = date('Y-m-d');
                                            }
                                            echo $date; ?></span>
    <div class="form-group contentTable table-striped ">

        <table class="table table-hover table-bordered DataTables table-responsive">
            <thead>
                <tr class="bg-secondary text-white">
                    <th class="collapse"></th>
                    <th class="collapse"></th>
                    <th style="font-size: 11px;">MATRICULE</th>
                    <th class="text-center" style="font-size: 11px;">OPLG</th>
                    <th class="text-center" style="font-size: 11px;">SITUATION</th>
                    <th class="text-center" style="font-size: 11px;">REA_CLT_J'AIME</th>
                    <th class="text-center" style="font-size: 11px;">PROP_CLT_AAC07</th>
                    <th class="text-center" style="font-size: 11px;">PROP_CLT_AAC14</th>
                    <th class="text-center" style="font-size: 11px;">RELN_CLT_SAC07</th>
                    <th class="text-center" style="font-size: 11px;">REAP_CLT_AAC30</th>
                    <th class="text-center" style="font-size: 11px;">TRTM_VTE_NNLIV</th>                                     
                    <th class="text-center" style="font-size: 11px;">NOUVEAU_CLIENT</th>
                    <th class="text-center" style="font-size: 11px;">APPEL</th>
                </tr>
            </thead>
            <tbody class="tbody">
                <?=$data?>
            </tbody>
        </table>
    </div>
</div>


<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <table class=" table-hover  table-striped table-Light table-bordered DataTables table-responsive-lg">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th >N°</th>
                        <th class="text-center">Heure</th>
                        <th class="text-center">Code client</th>
                        <th class="text-center">Nom client</th>
                        <th class="text-center">Status</th>                
                    </tr>
                </thead>  
                <tbody class="tbody">
                    <td>1</td>
                    <td>07:50</td>
                    <td>test</td>
                    <td>gseg</td>
                    <td>gg</td>

                </tbody>
            </table> 
            <hr style="background-color: red;">
            <h3 class="text-center">Liste additive</h3>
            <table class=" table-hover table-bordered DataTables table-responsive-lg">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th >N°</th>
                        <th class="text-center">Heure</th>
                        <th class="text-center">Code client</th>
                        <th class="text-center">Nom client</th>
                    </tr>
                </thead>  
                <tbody class="tbody">
               <?=$donnees?>             
                </tbody>
            </table> 
        </div>
    </div>
</div>

