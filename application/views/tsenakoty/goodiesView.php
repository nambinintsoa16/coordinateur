<div class="container">
    <fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm">GOODIES</b></legend>
            <div class="col-md-12">
                
                    <select class="form-control dateRecap" style="width:100%;">
                        <?php
                        $data = $mois;
                        foreach ($mois as $key => $mois) :
                            if ($key == date("m")) :
                        ?>
-                                <option selected><?= $mois ?></option>
                            <?php else : ?>
                                <option><?= $mois ?></option>
                        <?php endif;
                        endforeach; ?>

                    </select>               
            </div>

    </fieldset>    
        <div class="table-responsive-lg">
            <table class="table table-bordered table-stripted table-hover tableGoodies">
                <thead>
                     <tr class="text-white datatr" style="background-color: black;">
                        <th class="text-center"></th>
                        <th class="text-center">TOTAL</th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                    </tr>
                    <tr class="bg-primary text-white">
                        <th class="text-center">LISTE</th>
                        <th class="text-center"></th>
                        <th class="text-center"><a href="#" class="text-white pao">PAO </a><br>PK-LES006</th>
                        <th class="text-center"><a href="#" class="text-white lipstick">LIPSTICK </a><br>PK-BTY014</th>
                        <th class="text-center"><a href="#" class="text-white eversence">EVERSENCE </a> <br>PK-FUM072</th>
                        <th class="text-center"><a href="#" class="text-white fineline">FINELINE </a><br>PK-LES00%</th>
                        <th class="text-center"><a href="#" class="text-white bonsoir">BONSOIR </a><br>PTK011-98</th>
                    </tr>
                </thead>
                    <tbody class="tbody text-center">
                        
                    </tbody>
                </table>
            
        </div>

</div>