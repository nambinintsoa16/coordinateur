<div class="form-group contentTable table-striped ">
<span class="date_collapse collapse"> <?php echo $date; ?></span>

    <table class="table table-hover table-bordered DataTables table-responsive-lg">
        <thead>
            <tr class="bg-secondary text-white">
                <th >N°</th>
                <th class="text-center">Date</th>
                <th class="text-center">Page</th>
                <th class="text-center">Produit</th>
                <th class="text-center">Nombre <br> produits vendus</th>
                <th class="text-center">Prix</th>                                
            </tr>
        </thead>
        <tbody class="tbody">
            <?= $data?>
        </tbody>
    </table>
</div>