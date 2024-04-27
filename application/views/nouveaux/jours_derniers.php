<div class="container">
    <form method="POST" action="<?= base_url("Developpeur/nouveaux/jours_derniers") ?>" class="col-md-12">
        <fieldset class="border p-1">
            <legend class="w-auto"><b class="text-sm">NOUVEAUX CLIENTS 30 JOURS DERNIERS</b></legend>
            <div class="form-group col-md-12">
               
            </div>
        </fieldset>
    </form>
    <span class="date_collapse collapse"> <?php if ($date == "") {
                                                $date = date('Y-m-d');
                                            }
                                            echo $date; ?></span>
    <div class="form-group contentTable table-striped table-responsive ">

        <table class="table table-hover table-bordered DataTables">
            <thead>
                <tr class="bg-secondary text-white">
                    <th style="font-size: 11px;">Matricule</th>
                    <th class="text-center" style="font-size: 11px;">OPLG</th>
                    <th class="text-center" style="font-size: 11px;">Nouveaux <br> clients</th>
                    <th class="text-center" style="font-size: 11px;">Clients AC</th>
                    <th class="text-center" style="font-size: 11px;">Ratio AC</th>
                    <th class="text-center" style="font-size: 11px;">Clients SAC</th>
                    <th class="text-center" style="font-size: 11px;">Ratio SAC</th>
                </tr>
            </thead>
            <tbody class="tbody">
            <?= $data?>
            </tbody>
        </table>
    </div>
</div>
<!--<script>
    $(document).ready(function() {
    $(".DataTables").DataTable({
        searching: false,
        ordering: true,
        paging: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });

    $('.countnvcltac').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'nouveaux/listeclientsAAC', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-4 col-md-offset-4',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });

    $('.countnvcltss').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'nouveaux/listeclients', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });


});
</script>-->


