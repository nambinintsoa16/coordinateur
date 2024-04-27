<div class="container">
<fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm">PERFORMANCE MENSUELLE</b></legend>
        <select class="form-control dateRecapS" style="width:100%">
            <?php
            $data = $mois;
            foreach ($mois as $key => $mois) :
                if ($key == date("m")) :
            ?>
                    <option selected><?= $mois ?></option>
                <?php else : ?>
                    <option><?= $mois ?></option>
            <?php endif;
            endforeach; ?>

        </select>
    </fieldset>
    </form>
    <span class="date_collapse collapse"> <?php if ($date == "") {
                                                $date = date('Y-m-d');
                                            }
                                            echo $date; ?></span>
    <div class="form-group contentTable table-striped ">

        <table class="table table-hover table-bordered DataTables table-responsive table_perfoMa">
            <thead>
                <tr class="bg-secondary text-white">
                    <th style="font-size: 11px;">OPLG</th>
                    <th class="text-center" style="font-size: 11px;">MATRICULE</th>
                    <th class="text-center" style="font-size: 11px;">SITUATION</th>
                    <th class="text-center" style="font-size: 11px;">PARTG_PUB_GRPE</th>
                    <th class="text-center" style="font-size: 11px;">COM_COL_ANS_PG</th>
                    <th class="text-center" style="font-size: 11px;">COM_COL_ANS_CP</th>
                    <th class="text-center" style="font-size: 11px;">COM_COL_ASK_PG</th>
                    <th class="text-center" style="font-size: 11px;">COM_COL_ASK_CP</th>
                </tr>
            </thead>
            <tbody class="tbody text-center">
            
            </tbody>
        </table>
    </div>
</div>