<div class="form-group contentTable table-striped ">
<span class="date_collapse collapse"> <?php echo $date; ?></span>

    <table class="table table-hover table-bordered DataTables table-responsive-lg">
        <thead>
            <tr class="bg-secondary text-white">
                <th >Code client</th>
                <th >Nom client</th>
                </tr>
        </thead>
        <tbody class="tbody">
            <?= $data?>
        </tbody>
    </table>
</div>