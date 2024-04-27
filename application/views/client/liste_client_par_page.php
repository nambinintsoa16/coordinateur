<?php 
$this->load->model('Accueil_model');

?>
    
    <div class="row ">
<div class="table-responsive">
        <table class="table table-sm"  id="dataTable">
            <thead class="bg-dark text-white table-hover table-stripted table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Code_page/compte</th>
                    <th>Nom_page/compte</th>
                    <th>Nombre_de_client</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($liste as $liste):?>
                    <tr>
                        <td><?= $liste->id?></td>
                        <td><?= $liste->Code_page?></td>
                        <td><?=$liste->Nom_page?></td>
                        <td><a href="#" class="detail-page"><?=count($this->Accueil_model->return_liste_client_page(['page'=>$liste->id])) ?></a></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    </div>
