<div class="container">
	<div class="row">
		
		<hr />
		<div class="form-group col-md-12">
		<span class="date_collapse collapse"> <?php if ($date == "") {
														$date = date('Y-m-d');
													}
													echo $date; ?></span>
			<div class="table-responsive">
				<table class="table table-hover table-bordered table-responsive-lg DataTables">
					<thead>
						<tr class="bg-secondary text-white">
							<th class="collapse"></th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>1ère session</th>
							<th scope="col" style="font-size:12px" class="text-center">Matricule</th>
							<th scope="col" style="font-size:12px" class="text-center">Nom</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>1ère discu</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>Fin discu</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>1ère tâche</th>
							<th scope="col" style="font-size:12px" class="text-center">Heure<br>Fin tâche</th>
							<th scope="col" style="font-size:12px" class="text-center">Intervalle<br>d'heure</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>