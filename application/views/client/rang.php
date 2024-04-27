<div class="container">
  <div class="form-group contentTable table-striped table-responsive ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover tablekoty table-bordered DataTables nowrap">
                <thead class="bg-info text-center">
					<tr>
            <th class="text-center">N°</th>
            <th class="text-center">Code client</th>
            <th class="text-center">Nom client</th>
            <th class="text-center">Lien fb</th>
            <th class="text-center">Page / Compte</th> 
            <th class="text-center">Koty</th>
            <th class="text-center">Smile</th>
                                                     
					</tr>
				</thead>
              <tbody class="tbody"> 
                <!--<?= $data?>-->  
                <?= $contenu?>                 
              </tbody>
        </table>      
  </div>
</div>

  