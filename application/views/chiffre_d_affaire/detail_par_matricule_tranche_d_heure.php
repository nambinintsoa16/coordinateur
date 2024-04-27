<table class="table " id="table_detail">
   <thead class="bg-dark text-white">
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>C.A</th>
        </tr>
   </thead>
   <tbody>
    <?php  foreach($data as $data):?>
        <tr>
             <td><?=$data->matricule?></td>
             <td><?=$data->Nom." ".$data->Prenom?></td>
             <td><?=$data->vente?></td>
        </tr>    
    <?php endforeach;?>
</tbody>
</table>
<script>
$(document).ready(function(){
   $("#table_detail").DataTable()
})
</script>