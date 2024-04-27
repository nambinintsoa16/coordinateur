<div class="container">
    <form method="POST" action="<?= base_url("Developpeur/nouveaux/journalier") ?>" class="col-md-12">
        <fieldset class="border p-1">
            <legend class="w-auto"><b class="text-sm">NOUVEAUX CLIENTS JOURNALIERS</b></legend>
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
    <div class="form-group contentTable table-striped table-responsive ">

        <table class="table table-hover table-bordered DataTables">
            <thead>
                <tr class="bg-secondary text-white">
                    <th style="font-size: 11px;">Matricule</th>
                    <th class="text-center" style="font-size: 11px;">OPLG</th>
                    <th class="text-center" style="font-size: 11px;">Nouveaux <br> clients</th>
                    <th class="text-center" style="font-size: 11px;">Clients AC</th>
                    <th class="text-center" style="font-size: 11px;">Ratio AC</th>
                    <th class="text-center" style="font-size: 11px;">Clients SAC</th>
                    <th class="text-center" style="font-size: 11px;">Ratio SAC</th>
                </tr>
            </thead>
            <tbody class="tbody">
               <?= $data?>
            </tbody>
        </table>
    </div>
</div>


