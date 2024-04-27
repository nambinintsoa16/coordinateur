<div class="form-group contentTable table-striped table-responsive-xs ">
    <span class="date_collapse collapse"> <?php echo $date; ?></span>

    <table class="table table-hover table-bordered DataTables">
        <thead style="font-size:11px">
            <tr class="bg-secondary text-white">
                <th class="collapse"></th>
                <th class="text-center">Nom client</th>
                <th class="text-center">Nombre <br> produits</th>
                <th class="text-center">Montant</th>

            </tr>
        </thead>
        <tbody class="tbody" style="font-size:11px">
            <?= $data?>
        </tbody>
    </table>
</div>
<script>
$(document).ready(function() {
    $('.produit').on('click', function() {
        var parent = $(this).parent().parent();       
        var codeclient = parent.children().first().text();
        $.post(base_url + 'nouveaux/listeproduits', {codeclient: codeclient }, function(data) {
            $.alert({
                title: codeclient,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4',
                type: 'grey',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });
});
</script>