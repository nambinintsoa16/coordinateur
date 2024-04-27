<div class="table-responsive">
	<table class="table table-hover table-bordered table-responsive-lg DataTables">
		<thead>
		<tr class="bg-secondary text-white">
			<th scope="col" style="font-size:12px" class="text-center">Nombre d'intervale</th>
			<th scope="col" style="font-size:12px" class="text-center">Etat</th>
			
		</tr>
		</thead>
		<tbody>
			<?=$data?>
		</tbody>
	</table>
</div>
<script>
	$('.intervalle').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text();
        $.post(base_url + 'Assiduite/details_intervalle', { date: date, matricule: matricule }, function (data) {
            $.alert({
                title: '',
                content: data,

            });
        });

    });
</script>