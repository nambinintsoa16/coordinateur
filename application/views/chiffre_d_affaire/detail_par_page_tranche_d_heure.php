<table class="table " id="table_detail">
   <thead class="bg-dark text-white">
        <tr>
            <th>Page</th>
            <th>Code page</th>
        </tr>
   </thead>
   <tbody>
    <?php  foreach($data as $data):?>
        <tr>
             <td><?=$data->Nom_page?></td>
             <td><?=$data->Code_page?></td>
        </tr>    
    <?php endforeach;?>
</tbody>
</table>
<script>
$(document).ready(function(){
   $("#table_detail").DataTable()
})
</script>