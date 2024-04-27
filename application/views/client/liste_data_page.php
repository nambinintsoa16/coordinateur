<?php 
$this->load->model('Accueil_model');

?>
        <div class="table-responsive w-25" style="width: 50px;">
            <table class="table table-sm table-hover table-bordered">
                <thead class="bg-dark text-white">
                    <tr>
                        <td>Code client</td>
                        <td>Compte Facebook</td>
                        <td>Commun</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) : 
                        
                      $reponse = $this->Accueil_model->select_client(["Code_client"=>$row->client]);
                        
                        ?>
                        <tr>
                            <td><?= $row->client ?></td>
                                <?php if($reponse):?>
                                    <td><a href="<?=$reponse->lien_facebook?>" target="_blank"><?=$reponse->Compte_facebook?></a></td>
                                <?php else:?>
                                    <td>Erreur_client</td>
                                <?php endif?>
                            <td><a href="#" id="<?=$row->client?>" class="detail"><?= count($this->Accueil_model->return_liste_page(["client"=>$row->client]))?></a></td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

<script>
$(document).ready(function(){
  $('.detail').on('click',function(event){
    event.preventDefault();
    let refnum = $(this).attr('id');
    $.post(base_url+'client/liste_page_client',{refnum},function(data){
        $.alert({
            title: '',
            content: data,
            columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
            containerFluid: true,
        });
    });
  });
});
</script>