<div class="container">

    <!--<form method="POST" action="<?= base_url("Developpeur/performance/perfo") ?>" class="col-md-12">
        <fieldset class="border p-1">
            <legend class="w-auto"><b class="text-sm">PERFORMANCE</b></legend>
            <div class="form-group col-md-12">
                <div class="input-group">

                    <input type="date" class="form-control dateAutre1" value="Y-m-d" name="dateAutre1">
                    <input type="date" class="form-control dateAutre2" value="Y-m-d" name="dateAutre2">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-success but btn-success-sm p-1"> valider</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>-->

    <form method="POST" action="<?= base_url("Developpeur/performance/perfo") ?>" class="col-md-12">
        <fieldset class="border p-1">
            <legend class="w-auto"><b class="text-sm">PERFORMANCE JOURNALIERE</b></legend>
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
    <div class="form-group contentTable table-responsive-lg table-striped ">

        <table class="table table-hover table-bordered DataTable">
            <thead>

                <tr class="bg-primary text-white">
                    <th class="collapse"></th>
                    <th class="collapse"></th>
                    <th> Nom oplg</th>
                    <th class="text-center">Total</th>
                    <th class="text-center"></th>
                    <th class="text-center"><?php echo $entete['totalcomment'] ?></th>
                    <th class="text-center"><?php echo $entete['totalclient'] ?></th>
                    <th class="text-center"><?php echo $entete['totalreponse'] ?></th>
                    <th class="text-center"><a href='#' class="totalproduit text-white"><?php echo $entete['totalproduit'] ?></a></th>
                    <th class="text-center"><?php echo $entete['totalpublication'] ?></th>

                </tr>
                <tr class="bg-secondary text-white">
                    <th class="collapse"></th>
                    <th class="collapse"></th>
                    <th> Nom oplg</th>
                    <th class="text-center">Matricule</th>
                    <th class="text-center">Page</th>
                    <th class="text-center">Commentaires</th>
                    <th class="text-center">Clients</th>
                    <th class="text-center">Reponses</th>
                    <th class="text-center">Produits vendus</th>
                    <th class="text-center">Publications</th>

                </tr>
            </thead>
            <tbody class="tbody">
                <?= $data ?>
            </tbody>
        </table>
    </div>
</div>