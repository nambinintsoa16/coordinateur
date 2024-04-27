<style type="text/css">
 table.dataTable tbody td {
    padding-right: 5px;
    height: 30px !important;
    font-size: 14px !important;
    width: 200px !important;
}
<?php
  $date_matricule = $date;

?>
</style>
		
                <form class="col-md-12">
                    <fieldset class="border bg-light p-1">
                    <legend class="w-auto"><b class="text-sm">ETAT DISCUSSION JOURNALIERE</b></legend>                    
                    </fieldset>
                </form>
                <div class="col-md-12 mt-2">
                    <div class="table-responsive w-100">
                        <table class="table table-striped table-bordered-bd-secondary table-responsive-lg table-hover tableResult ">
                            <thead>
                                <tr class="bg-secondary text-white">
                                    <td>Matricule</td>
                                    <td>Code page</td>
                                    <?php foreach($date as $date):?>
                                        <td><?=$date->format('d-m')?></td>
                                    <?php endforeach;?>    
                                </tr>
                            </thead>
                            <tbody class="text-sm text-center">
                               <?php foreach($page as $page): $date_temp = $date_matricule; ?>
                                <tr>
                                    <td><?=$page->Nom_page?></td>
                                    <td><?=$page->Code_page?></td>
                                    
                                    <?php foreach($date_temp  as  $date_temp):?>
                                        <td><a href="#"><?=$date_temp->format('d-m')?></a></td>
                                    <?php endforeach;?>
                                </tr>
                                <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>




			

			
