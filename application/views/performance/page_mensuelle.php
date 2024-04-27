<div class="container">
<fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm">TRAITEMENT PAGE MENSUEL</b></legend>
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

        <table class="table table-hover table-bordered DataTables table-responsive-lg table_page">
            <thead>
                <tr class="bg-secondary text-white dataClass">
                    <th style="font-size: 11px;">MATRICULE</th>
                    <th class="text-center" style="font-size: 11px;">OPLG</th>
                    <th class="text-center" style="font-size: 11px;">SITUATION_PG</th>
                    <th class="text-center" style="font-size: 11px;">DIS_CLT_WRT_PG</th>
                    <th class="text-center" style="font-size: 11px;">DIS_CLT_ASK_PG</th>
                    <th class="text-center" style="font-size: 11px;">ENV_CLT_VIS_TT</th>
                    <th class="text-center" style="font-size: 11px;">M1NTS_ABN_PAGE</th>
            </thead>
            <tbody class="tbody text-center">
            
            </tbody>
        </table>
    </div>
</div>