<div class="form-group contentTable table-striped ">
<span class="date_collapse collapse"> <?php  echo $date; ?></span>

    <table class="table table-hover table-bordered DataTables table-responsive-lg">
        <thead>
            <div form-control><b>
                <fieldset>
                Conlcus: <?= $conclu?> <br>
                Echoués: <?= $echoue?>
                </fieldset>
            </div></b>
            <tr class="bg-secondary text-white">
                <th >N°</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Type</th>                
            </tr>
        </thead>
        <tbody class="tbody">
        <?= $donnees?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
     $('.code').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var index = $(this).parent().index();
        var codeclient = parent.children().first().next().text();
        $.post(base_url + 'Performance/detailappel', { codeclient: codeclient}, function(data) {
            $.alert({
                title: "",
                content: data,
                columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-10',
                type: 'yellow',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });
});
</script>
