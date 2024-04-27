<?php 
$this->load->model('Accueil_model');

?>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-sm table-hover table-bordered table-responsive">
                <thead class="bg-dark text-white">
                    <tr>
                        <td>Code page/compte</td>
                        <td>Nom  page/compte</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) :    
                    $reponse=$this->Accueil_model->get_compte_fb(['id'=>$row->page]);
                        ?>
                    <?php if($reponse):?>
                        <tr>
                            <td><?= $reponse->code_page_compte?></td>
                            <td><?= $reponse->Nom_page?></td>
                        </tr>
                    <?endif;?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>