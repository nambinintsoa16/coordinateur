<div class="container">
<fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm">J'AIME MENSUELS</b></legend>
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

        <table class="table table-hover table-bordered DataTables table-responsive table_jaime">
            <thead>
                <tr class="bg-secondary text-white dataClass">
                    <th style="font-size: 11px;">MATRICULE</th>
                    <th class="text-center" style="font-size: 11px;">OPLG</th>
                    <th class="text-center" style="font-size: 11px;">SITUATION</th>
                    <th class="text-center" style="font-size: 11px;">REA_CLT_J'AIME</th>
                    <th class="text-center" style="font-size: 11px;">PROP_CLT_AAC07</th>
                    <th class="text-center" style="font-size: 11px;">PROP_CLT_AAC14</th>
                    <th class="text-center" style="font-size: 11px;">RELN_CLT_SAC07</th>
                    <th class="text-center" style="font-size: 11px;">REAP_CLT_AAC30</th>
                    <th class="text-center" style="font-size: 11px;">TRTM_VTE_NNLIV</th>                                     
                    <th class="text-center" style="font-size: 11px;">NOUVEAU_CLIENT</th>
                    <th class="text-center" style="font-size: 11px;">AUTRES</th>
                </tr>
            </thead>
            <tbody class="tbody text-center">
            
            </tbody>
        </table>
    </div>
</div>