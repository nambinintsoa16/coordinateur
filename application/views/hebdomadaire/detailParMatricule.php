<div class="content col-md-12">
		<div class="page-inner mt-3">
			<div class="row">
                <form class="col-md-12">
                    <fieldset class="border bg-light p-1">
                    <legend class="w-auto"><b class="text-sm">VENTE DU MOIS</b></legend>
                    <div class="col-md-12 m-auto">
                        <ul class="font-weight-bold">MATRICULE: <?= substr($infoclient->Matricule, 2, 6)?></ul>
                        <ul class="font-weight-bold">NOM: <?=strtoupper($infoclient->Prenom)?></ul>
                    </div>
                    </fieldset>
                </form>
                <div class="col-md-12 mt-2">
                    <div class="table-responsive w-100">
                        <table class="table table-striped table-bordered-bd-secondary table-responsive-lg table-hover tableResult table-head-bg-secondary">
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th class="text-sm text-center"><?= number_format($total, 0, ',', '.')?></th>
                                    <th class="text-sm text-center">VB</th>
                                    <th class="text-sm text-center">VD</th>
                                    <th class="text-sm text-center">VO</th>
                                    <th class="text-sm text-center">VN</th>
                                    <th class="text-sm text-center">VM</th>
                                    <th class="text-sm text-center">VH</th>
                                    <th class="text-sm text-center">CT</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-center">
                               <?=$resultat?>
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function() {
     $(".tableau").DataTable({
        searching: false,
        ordering: true,
        paging: false,
        processing: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }

    });
});
</script>
			
