<div class="form-group contentTable table-striped ">
    <span class="date_collapse collapse"> <?php echo $date; ?></span>

    <table class="table table-hover table-bordered DataTables table-responsive-lg">
        <thead>
            <tr class="bg-secondary text-white">
                <th class="text-center">Code produit</th>
                <th class="text-center">Nom <br> produit</th>

            </tr>
        </thead>
        <tbody class="tbody" style="font-size:11px">
            <?= $data?>
        </tbody>
    </table>
</div>