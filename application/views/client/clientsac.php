<style>
    .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; font-size: 8px!important ;padding-top:-15px!important; height: 10px!important;}
    .toggle.ios .toggle-handle { border-radius: 20px;}
    .toggle.ios1, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; font-size: 8px!important ;padding-top:-15px!important; height: 10px!important;}
    .toggle.ios1 .toggle-handle { border-radius: 20px; }
    .toggle.ios2, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; font-size: 8px!important ;padding-top:-15px!important; height: 10px!important;}
    .toggle.ios2 .toggle-handle { border-radius: 20px; }
    .toggle.ios3, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; font-size: 8px!important ;padding-top:-15px!important; height: 10px!important;}
    .toggle.ios3 .toggle-handle { border-radius: 20px; }
    .toggle.ios4, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; font-size: 8px!important ;padding-top:-15px!important; height: 10px!important;}
    .toggle.ios4 .toggle-handle { border-radius: 20px; }
    .toggle.ios5, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; font-size: 8px!important ;padding-top:-15px!important; height: 10px!important;}
    .toggle.ios5 .toggle-handle { border-radius: 20px; }
    .toggle.ios6, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; font-size: 8px!important ;padding-top:-15px!important; height: 10px!important;}
    .toggle.ios6 .toggle-handle { border-radius: 20px; }
    .toggle.ios7, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; font-size: 8px!important ;padding-top:-15px!important; height: 10px!important;}
    .toggle.ios7 .toggle-handle { border-radius: 20px; }
    .btn:not(:disabled):not(.disabled) {
    cursor: pointer;
    padding-top: 1px!important;}
    
</style>
<div class="form-control">
    <form class="form-control">
    <!--<form method="POST" action="<?= base_url("") ?>" class="col-md-12">-->
        <fieldset class="border p-1">
            <legend class="w-auto"><b class="text-sm">SAC RELANCE CATALOGUE</b></legend>
            <div class="form-group col-md-12">  
                <div class="form-row"></div>
                    <div class="text-center">
                        <label class="checkbox-inline">paramètre -21</label>&nbsp<input class="check1" id="toggle-demo" type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="danger" data-style="ios link">
                        <label  class="checkbox-inline ml-5">paramètre -28</label>&nbsp<input id="toggle-demo" type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="danger" data-style="ios1 link">
                        <label  class="checkbox-inline ml-5">paramètre -35</label>&nbsp<input id="toggle-demo" type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="danger" data-style="ios2 link">
                        <label  class="checkbox-inline ml-5">paramètre -42</label>&nbsp<input id="toggle-demo" type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="danger" data-style="ios3 link">
                    </div>
                    <hr style="background-color:black">
                    <div class="text-center">
                        <label class="checkbox-inline">paramètre -49</label>&nbsp<input id="toggle-demo" type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="danger" data-style="ios4 link"> 
                        <label class="checkbox-inline ml-5">paramètre -56</label>&nbsp<input id="toggle-demo" type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="danger" data-style="ios5 link ">
                        <label  class="checkbox-inline ml-5">paramètre -63</label>&nbsp<input id="toggle-demo" type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="danger" data-style="ios6 link ">
                        <label  class="checkbox-inline ml-5">paramètre -70</label>&nbsp<input id="toggle-demo" type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="danger" data-style="ios7 link ">             
                    </div>
                    <div class="text-center">
                       <a href="#" class="btn btn-success validChoix">valider</a>
                    </div>
                </div>
                <div class="form-control d-flex">
                    <div class="form-group col-md-8 d-flex">
                        <label class="col-md-2 p-1">Choisir OPLG:</label>
                        <select class="form-control col-md-4 opls">
                            <option hidden></option>
                            <?php foreach($dataopl as $key=>$dataopl):?>
                            <option><?= $dataopl->Matricule_personnel?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-md-4 text-right p-2">
                        <button type="button" class="btn btn-primary btn-lg btn1 ">Valider</button>
                    </div>
                    
                    
                </div>
                

            </div>
        </fieldset>
    </form>
    <div class="form-group contentTable">
        <span class="date_collapse collapse"> <?php if ($date == "") {
                                                $date = date('Y-m-d');
                                            }
                                            echo $date; ?></span>
        <table class="table table-striped table-hover DataTables table-bordered table-responsive-lg tablesac">
            <thead>
                <tr class="bg-secondary text-white text-center">
                    <th >N°</th>
                    <th>Param 21</th>
                    <th>Param 28</th>
                    <th>Param 35</th>
                    <th>Param 42</th>
                    <th>Param 49</th> 
                    <th>Param 56</th>
                    <th>Param 63</th>
                    <th>Param 70</th>            
                </tr>
            </thead>
            <tbody class="tbody text-center">
                    
            </tbody>
        </table>      
    </div>
</div>

