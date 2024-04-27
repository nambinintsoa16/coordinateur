<div class="container">

    <span class="date_collapse collapse"> <?php if ($date == "") {
                                                $date = date('Y-m-d');
                                            }
                                            echo $date; ?></span>
    <div class="form-group contentTable">

        <table class="table table-light DataTables table-hover table-responsive">
            <thead class="thead-light">
                <tr>
                    <th>Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Nombre de discussions</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody class="tbody">
        </table>
    </div>
</div>