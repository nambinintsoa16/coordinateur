<div class="container">
    <form method="POST" action="<?= base_url("Developpeur/performance/jour") ?>" class="col-md-12">
        <fieldset class="border p-1">
            <legend class="w-auto"><b class="text-sm">STATISTIQUES COMMENTAIRES JOURNALIERS</b></legend>
            <div class="form-group col-md-12">
                <div class="input-group">

                    <input type="date" class="form-control" value="<?php echo $date ?>" name="date">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-success but btn-success-sm p-1"> valider</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <span class="date_collapse collapse"> <?php if ($date == "") {
                                                $date = date('Y-m-d');
                                            }
                                            echo $date; ?></span>
    <div class="form-group contentTable table-striped ">

        <table class="table table-hover table-bordered DataTables table-responsive">
            <thead>
                <tr class="bg-secondary text-white">
                    <th class="collapse"></th>
                    <th class="collapse"></th>
                    <th style="font-size: 11px;">MATRICULE</th>
                    <th class="text-center" style="font-size: 11px;">OPLG</th>
                    <th class="text-center" style="font-size: 11px;">SITUATION</th>
                    <th class="text-center" style="font-size: 11px;">PARTG_PUB_GRPE</th>
                    <th class="text-center" style="font-size: 11px;">COM_COL_ANS_PG</th>
                    <th class="text-center" style="font-size: 11px;">COM_COL_ANS_CP</th>
                    <th class="text-center" style="font-size: 11px;">COM_COL_ASK_PG</th>
                    <th class="text-center" style="font-size: 11px;">COM_COL_ASK_CP</th>
                    
                </tr>
            </thead>
            <tbody class="tbody">
                <?=$data?>
            </tbody>
        </table>
    </div>
</div>