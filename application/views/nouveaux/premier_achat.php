<div class="form-group contentTable table-striped ">
    <form method="POST" action="<?= base_url("Developpeur/nouveaux/premier_achat") ?>" class="col-md-12">
        <fieldset class="border p-1">
            <legend class="w-auto"><b class="text-sm">PREMIERS ACHATS</b></legend>
            <div class="form-group col-md-12">
                <div class="input-group">

                    <input type="date" class="form-control date_collapse" value="<?php echo $date ?>" name="date">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-success but btn-success-sm p-1"> valider</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>

    <table class="table table-hover table-bordered DataTables table-responsive-lg">
        <thead>
            <tr class="bg-secondary text-white">
                <th class="text-center">Oplg</th>
                <th class="text-center">Premier achat <br> après 7 jours</th>
                <th class="text-center">Premier achat <br> après 14 jours</th>
                <th class="text-center">Premier achat <br> après 28 jours</th>
                <th class="text-center">Premier achat <br> après 42 jours</th>
                <th class="text-center">Premier achat <br> après + de 42 jours</th>
 
            </tr>
        </thead>
        <tbody class="tbody" style="font-size:11px">
            <?= $data?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
    $(".DataTables").DataTable({
        searching: false,
        ordering: true,
        paging: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });    
});
</script>

