<style>
    .aa {
        font-size: 8px;
    }
</style>

  <fieldset class="border p-0">
      <legend class="w-auto"><b class="text-sm" style="font-size:11px">
                 ETAT DE VENTE JOURNALIER PAR TRANCHE D'HEURE ET PAR MATRICULE</b>
                 
    </legend> 
    <br/><b>DATE DU <?=$date?></b>
<form method="post" action="" class="w-100 row">
        <div class="col-md-3 w-100">
            <label class="label">Date</label>
        </div>
         
        <div class="col-md-4 col-sm-4">
              <input type="date" name="date" class="form-control">
        </div>  
        <div class="col-md-3 col-sm-3">  
              <button class="btn btn-success btn-sm">Valider</button>
        </div> 
       
    </form> 


<div class="table table-responsive col-md-12 p-0 m-0">
<table class="table table-striped table-hover table-bordered dataTables table-responsive table_previsionnel">
     <thead class="thead">
         <tr style="border-bottom: 1px white solid;">
                        <th class="bg-primary text-white" colspan="2" style="font-size: 10px;">GRAND TOTAL</th>
                        <?php   $vente = $this->client_model->get_ca_haours("facture.date ='$date'"); ?>
                        <th   class="bg-primary text-white"><?= number_format($vente->vente);?></th>
                        <th   class="bg-primary text-white">
                            <?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '07:00' AND '09:00' AND facture.date ='".$date."')"); 
                                   echo  $vente == "NULL" ? "0" : number_format($vente->vente);
                               ?>
                        </th>
                        <th   class="bg-primary text-white">
                            
                            <?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '09:00' AND '11:00' AND facture.date ='".$date."')"); 
                                   echo  $vente == "NULL" ? "0" : number_format($vente->vente);
                               ?>
                        </th>
                        <th   class="bg-primary text-white"><?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '11:00' AND '13:00' AND facture.date ='".$date."')"); 
                                  echo  $vente == "NULL" ? "0" : number_format($vente->vente);
                               ?></th>
                        <th   class="bg-primary text-white">
                            <?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '13:00' AND '15:00' AND facture.date ='".$date."')"); 
                                  echo  $vente == "NULL" ? "0" : number_format($vente->vente);
                               ?>
                        </th>
                        <th   class="bg-primary text-white">
                            <?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '15:00' AND '17:00' AND facture.date ='".$date."')"); 
                                  echo  $vente == "NULL" ? "0" :  number_format($vente->vente);
                               ?>
                        </th>
                        <th   class="bg-primary text-white">
                            <?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '17:00' AND '19:00' AND facture.date ='".$date."')"); 
                                   echo  $vente == "NULL" ? "0" : number_format($vente->vente);
                               ?>
                        </th>
                           <th   class="bg-primary text-white">
                            <?php 
                                   $vente = $this->client_model->get_ca_haours("(facture.Heure BETWEEN '19:00' AND '21:00' AND facture.date ='".$date."')"); 
                                   echo  $vente == "NULL" ? "0" : number_format($vente->vente);
                               ?>
                        </th>
                    </tr>    
        <tr  class="bg-primary text-white">
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">Matricule</th>
                  <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">Nom</th>
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">TOTAL</th>  
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">[07:00 - 09:00]</th> 
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">]09:00 - 11:00]</th> 
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">]11:00 - 13:00]</th> 
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">]13:00 - 15:00]</th>     
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">]15:00 - 17:00]</th>    
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">]17:00 - 19:00] </th>       
            <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white">]19:00 - 21:00] </th>                       
     </tr>
     </thead>
     <tbody>

        <?php  
           $this->load->model('client_model');
       
        foreach ($datas as $key => $datas):
      
            ?>
            <tr>
            <th><a href="#" class="matriclue"> <?php 
                   echo $datas->Matricule;
              ?></a></th>
                <th><?php 
                   echo $datas->Prenom;
              ?></th>
            <th><?php 
               $data = $this->client_model->get_ca_haours("facture.Matricule_personnel ='".$datas->Matricule."' AND  facture.date ='".$date."'"); 
                echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>  
           <th><?php 
               $data = $this->client_model->get_ca_haours("facture.Matricule_personnel ='".$datas->Matricule."' AND (facture.Heure BETWEEN '07:00' AND '09:00' AND facture.date ='".$date."')"); 
               echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>
           <th><?php 
               $data = $this->client_model->get_ca_haours("facture.Matricule_personnel ='".$datas->Matricule."' AND (facture.Heure BETWEEN '09:00' AND '11:00' AND facture.date ='".$date."')"); 
               echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>
           <th><?php 
               $data = $this->client_model->get_ca_haours("facture.Matricule_personnel ='".$datas->Matricule."' AND (facture.Heure BETWEEN '11:00' AND '13:00' AND facture.date ='".$date."')"); 
              echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>
           <th><?php 
               $data = $this->client_model->get_ca_haours("facture.Matricule_personnel ='".$datas->Matricule."' AND (facture.Heure BETWEEN '13:00' AND '15:00' AND facture.date ='".$date."')"); 
              echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>
            <th><?php 
               $data = $this->client_model->get_ca_haours("facture.Matricule_personnel ='".$datas->Matricule."' AND (facture.Heure BETWEEN '15:00' AND '17:00' AND facture.date ='".$date."')"); 
              echo  $data == "NULL" ? "0" :  number_format($data->vente);
           ?></th>
              <th><?php 
               $data = $this->client_model->get_ca_haours("facture.Matricule_personnel ='".$datas->Matricule."' AND (facture.Heure BETWEEN '17:00' AND '19:00' AND facture.date ='".$date."')"); 
               echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>
           <th><?php 
               $data = $this->client_model->get_ca_haours("facture.Matricule_personnel ='".$datas->Matricule."' AND  (facture.Heure BETWEEN '19:00' AND '21:00' AND facture.date ='".$date."')"); 
               echo  $data == "NULL" ? "0" : number_format($data->vente);
           ?></th>
                       
     </tr>
        <?php endforeach;?>
     </tbody>
</table>
</div>
</fieldset>

 <div class="modal" tabindex="-1" role="dialog" id="modal_detail">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>


