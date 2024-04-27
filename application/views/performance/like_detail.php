<div class="form-group contentTable table-striped ">
<span class="date_collapse collapse"> <?php echo $date; ?></span>

    <table class="table table-hover table-bordered DataTables table-responsive-lg">
        <thead>
            <tr class="bg-secondary text-white">
                <th >N°</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Status</th>                
            </tr>
        </thead>
        <tbody class="tbody">
            <?=$donnees?>
        </tbody>
    </table>
</div>