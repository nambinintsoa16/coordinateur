<div class="form-group contentTable table-striped ">
<span class="date_collapse collapse"> <?php if ($date == "") {
                                                $date = date('Y-m-d');
                                            }
                                            echo $date; ?></span>

    <table class="table table-hover table-bordered DataTables table-responsive-lg">
        <thead>
            <tr class="bg-secondary text-white">
                <th >N°</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Status</th>                
            </tr>
        </thead>
        <tbody class="tbody">
            <?=$data?>
        </tbody>
    </table>
<!--
    <hr style="background-color: red;">
            <h3 class="text-center">Liste clients traités</h3>
            <table class="table table-hover table-bordered DataTables table-responsive-lg">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th >N°</th>
                        <th class="text-center">Heure</th>
                        <th class="text-center">Code client</th>
                        <th class="text-center">Nom client</th>
                    </tr>
                </thead>  
            <tbody class="tbody">
                <?=$donnees?>          
            </tbody>
        </table> -->
</div>