<div class="container-fluid">
    <div id="accordion">
    <div class="card">
        <div class="card-header" id="headingn">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen" aria-expanded="false" aria-controls="collapsen">
                <div class="col-md-12">BILAN CA 2021</div>                
                </button>
                <span class="border"><label><b>CA previ: <a href="#" class="caannuelprevi"><?= number_format($caannuelprevi, 0, ',', ' ')?></a> Ariary</label>&nbsp   &nbsp | &nbsp CA réels: <a href="#" class="caannuelreel"><?= number_format($caannuelreel, 0, ',', ' ')?></a> Ariary  &nbsp |&nbsp  
        CA livrés: <a href="#" class="caannuellivre"> <?= number_format($caannuellivre, 0, ',', ' ')?></a> Ariary &nbsp |&nbsp Taux: <?= number_format( ($caannuelreel * 100)/$caannuelprevi, 2, ',', ' ')?> % </b></span>
            </h5>
            </div>
            <div id="collapsen" class="collapse" aria-labelledby="headingn" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group contentTable table-striped ">
                  <!--Accordion wrapper-->
                    <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                   
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingThree3">
                        <a class="collapsed promo3" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
                          aria-expanded="false" aria-controls="collapseThree3">
                          <h5 class="mb-0">
                          
                          Mars  <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a><span class="text-center pl-5"><b>chiffres d'affaires réels: &nbsp <a href="#" class="">  <?= number_format($careelmars, 0, ',', ' ')?> </a> Ariary</b></span>
                      </div>

                      <!-- Card body  -->
                      <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse3 collapse"> <?php echo $date3; ?></span>
                            <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted table3">
                                    <thead>

                                        <tr class="camois3 bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->
                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingFor4">
                        <a class="promo4" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFor4" aria-expanded="true"
                          aria-controls="collapseFor4">
                          <h5 class="mb-0">
                          Avril  <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class="">  <?= number_format($careelavril, 0, ',', ' ')?></a> Ariary </b> </span>
                      </div>

                      <!-- Card body -->
                      <div id="collapseFor4" class="collapse " role="tabpanel" aria-labelledby="headingFor4"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse4 collapse"> <?php echo $date4; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted table4">
                                    <thead>

                                        <tr class="camois4 bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingFive5">
                        <a class="collapsed promo5" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFive5"
                          aria-expanded="false" aria-controls="collapseFive5">
                          <h5 class="mb-0">
                          Mai  <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""> <?= number_format($careelmai, 0, ',', ' ')?></a> Ariary </b></span>
                      </div>

                      <!-- Card body -->
                      <div id="collapseFive5" class="collapse" role="tabpanel" aria-labelledby="headingFive5"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse5 collapse"> <?php echo $date5; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted table5">
                                    <thead>

                                        <tr class="camois5 bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div> 
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingSix6">
                        <a class="collapsed promo6" data-toggle="collapse" data-parent="#accordionEx" href="#collapseSix6"
                          aria-expanded="false" aria-controls="collapseSix6">
                          <h5 class="mb-0">
                         Juin  <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""> <?= number_format($careeljuin, 0, ',', ' ')?></a> Ariary</b> </span>
                      </div>

                      <!-- Card body -->
                      <div id="collapseSix6" class="collapse" role="tabpanel" aria-labelledby="headingSix6"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse6 collapse"> <?php echo $date6; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted table6">
                                    <thead>

                                        <tr class="camois6 bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div> 
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingSeven7">
                        <a class=promo7 data-toggle="collapse" data-parent="#accordionEx" href="#collapseSeven7" aria-expanded="true"
                          aria-controls="collapseSeven7">
                          <h5 class="mb-0">
                          Juillet  <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""> <?= number_format($careeljuillet, 0, ',', ' ')?></a> Ariary </b></span>
                      </div>

                      <!-- Card body -->
                      <div id="collapseSeven7" class="collapse " role="tabpanel" aria-labelledby="headingSeven7"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse7 collapse"> <?php echo $date7; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted table7">
                                    <thead>

                                        <tr class="camois7 bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingEight8">
                        <a class="collapsed promo8" data-toggle="collapse" data-parent="#accordionEx" href="#collapseEight8"
                          aria-expanded="false" aria-controls="collapseEight8">
                          <h5 class="mb-0">
                         Août  <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class="">  <?= number_format($careelaout, 0, ',', ' ')?> </a>&nbsp Ariary</b></span>
                      </div>

                      <!-- Card body -->
                      <div id="collapseEight8" class="collapse" role="tabpanel" aria-labelledby="headingEight8"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse8 collapse"> <?php echo $date8; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted table8">
                                    <thead>

                                        <tr class="camois8 bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div> 
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingNine9">
                        <a class="collapsed promo9" data-toggle="collapse" data-parent="#accordionEx" href="#collapseNine9"
                          aria-expanded="false" aria-controls="collapseNine9">
                          <h5 class="mb-0">
                          Septembre  <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a><span class="text-center pl-5"><b> chiffres d'affaires réels:&nbsp <a href="#" class="">  <?= number_format($careelsept, 0, ',', ' ')?> </a> &nbsp Ariary</b></span>
                      </div>

                      <!-- Card body -->
                      <div id="collapseNine9" class="collapse" role="tabpanel" aria-labelledby="headingNine9"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse9 collapse"> <?php echo $date9; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted table9">
                                    <thead>

                                        <tr class="camois9 bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div> 
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->
                     <!-- Accordion card -->
                     <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingtine10">
                    <a class=promo10 data-toggle="collapse" data-parent="#accordionEx" href="#collapsetine10" aria-expanded="true"
                        aria-controls="collapsetine10">
                        <h5 class="mb-0">
                        Octobre  <i class="fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""><?= number_format($careeloct, 0, ',', ' ')?> </a>&nbsp Ariary</b></span>
                    </div>

                    <!-- Card body -->
                    <div id="collapsetine10" class="collapse " role="tabpanel" aria-labelledby="headingtine10"
                    data-parent="#accordionEx">
                    <div class="card-body">
                    <span class="date_collapse10 collapse"> <?php echo $date10; ?></span>
                    <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted table10">
                                    <thead>

                                        <tr class="camois10 bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div>  
                    </div>
                    </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingEleven">
                    <a class="collapsed promo11" data-toggle="collapse" data-parent="#accordionEx" href="#collapseEleven"
                        aria-expanded="false" aria-controls="collapseEleven">
                        <h5 class="mb-0">
                    Novembre  <i class="fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""><?= number_format($careelnov, 0, ',', ' ')?></a> &nbsp Ariary </b></span>
                    </div>

                    <!-- Card body -->
                    <div id="collapseEleven" class="collapse" role="tabpanel" aria-labelledby="headingEleven"
                    data-parent="#accordionEx">
                    <div class="card-body">
                    <span class="date_collapse11 collapse"> <?php echo $date11; ?></span>
                    <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted table11">
                                    <thead>

                                        <tr class="camois11 bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div> 
                    </div>
                    </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingTwelve12">
                    <a class="collapsed promo12" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwelve12"
                        aria-expanded="false" aria-controls="collapseTwelve12">
                        <h5 class="mb-0">
                        Décembre  <i class="fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""><?= number_format($careeldec, 0, ',', ' ')?></a> &nbsp Ariary </b></span>
                    </div>

                    <!-- Card body -->
                    <div id="collapseTwelve12" class="collapse" role="tabpanel" aria-labelledby="headingTwelve12"
                    data-parent="#accordionEx">
                    <div class="card-body">
                    <span class="date_collapse12 collapse"> <?php echo $date12; ?></span>
                    <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted table12">
                                    <thead>

                                        <tr class="camois12 bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div>  
                    </div>
                    </div>

                    </div>
                    <!-- Accordion card -->

                    </div>
                    <!-- Accordion wrapper --> 

                    </div>
                    <!-- Accordion wrapper -->                    
                    
                </div>
              </div>
            </div>
      </div>
      
      <div class="card">
        <div class="card-header" id="headingn2022">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen2022" aria-expanded="false" aria-controls="collapsen2022">
                <div class="col-md-12">BILAN CA 2022</div>
                </button>
                <span class="border"><label><b>CA previ: <?= number_format($caannuelprevi2022, 0, ',', ' ')?> Ariary</label>&nbsp   &nbsp | &nbsp CA réels: <?= number_format($caannuelreel2022, 0, ',', ' ')?> Ariary  &nbsp |&nbsp  
        CA livrés: <?= number_format($caannuellivre2022, 0, ',', ' ')?> Ariary &nbsp |&nbsp Taux: <?= number_format( ($caannuelreel2022 * 100)/$caannuelprevi2022, 2, ',', ' ')?> % </b></span>
            </h5>
            </div>
            <div id="collapsen2022" class="collapse" aria-labelledby="headingn2022" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group contentTable table-striped ">
                  <!--Accordion wrapper-->
                    <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingjanv">
                        <a data-toggle="collapse" class="janv2022" data-parent="#accordionEx" href="#collapsejanv" aria-expanded="true"
                          aria-controls="collapsejanv">
                          <h5 class="mb-0">
                          Janvier <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                          </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""> <?= number_format($careeljan2022, 0, ',', ' ')?></a> Ariary </b></span>
                      </div>

                      <!-- Card body -->
                      <div id="collapsejanv" class="collapse " role="tabpanel" aria-labelledby="headingjanv"
                        data-parent="#accordionEx">
                        <div class="card-body">
                            <span class="date_collapse collapse"> <?php echo $date; ?></span>
                            <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted tablejanvier">
                                    <thead>

                                        <tr class="camoisjanv bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</th>
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>                                     
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div>
                          
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingfev">
                        <a class="collapsed fevr2022" data-toggle="collapse" data-parent="#accordionEx" href="#collapsefev"
                          aria-expanded="false" aria-controls="collapsefev">
                          <h5 class="mb-0">
                         Février  <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                          </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""> <?= number_format($careelfev2022, 0, ',', ' ')?></a> Ariary </b></span>
                      </div>

                      <!-- Card body -->
                      <div id="collapsefev" class="collapse" role="tabpanel" aria-labelledby="headingfev"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted tablefevrier">
                                    <thead>

                                        <tr class="camoisfevrier bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</th>
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>                                     
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingMars">
                        <a class="mars2022" data-toggle="collapse" data-parent="#accordionEx" href="#collapseMars"
                          aria-expanded="false" aria-controls="collapseMars">
                          <h5 class="mb-0">
                          Mars  <i class="fas fa-angle-down rotate-icon"></i>
                          </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""> <?= number_format($careelmars2022, 0, ',', ' ')?></a> Ariary </b></span>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapseMars" class="collapse" role="tabpanel" aria-labelledby="headingMars"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted tablemars">
                                    <thead>

                                        <tr class="camoismars bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</th>
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>                                     
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->
                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingavril">
                        <a class="avril2022" data-toggle="collapse" data-parent="#accordionEx" href="#collapseavril" aria-expanded="true"
                          aria-controls="collapseavril">
                          <h5 class="mb-0">
                          Avril  <i class="fas fa-angle-down rotate-icon"></i>
                          </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""><?= number_format($careelavril2022, 0, ',', ' ')?> </a> Ariary </b></span>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapseavril" class="collapse " role="tabpanel" aria-labelledby="headingavril"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted tableavril22">
                                    <thead>

                                        <tr class="camoisavril bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingmai">
                        <a class="collapsed promomai" data-toggle="collapse" data-parent="#accordionEx" href="#collapsemai"
                          aria-expanded="false" aria-controls="collapsemai">
                          <h5 class="mb-0">
                          Mai  <i class="fas fa-angle-down rotate-icon"></i>
                          </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""> <?= number_format($careemai2022, 0, ',', ' ')?></a> Ariary </b></span>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapsemai" class="collapse" role="tabpanel" aria-labelledby="headingmai"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted tablemai22">
                                    <thead>

                                        <tr class="camoismai bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div> 
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingjuin">
                        <a class="collapsed promojuin" data-toggle="collapse" data-parent="#accordionEx" href="#collapsejuin"
                          aria-expanded="false" aria-controls="collapsejuin">
                          <h5 class="mb-0">
                          Juin  <i class="fas fa-angle-down rotate-icon"></i>
                          </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""> <?= number_format($careeljuin2022, 0, ',', ' ')?></a> Ariary </b></span>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapsejuin" class="collapse" role="tabpanel" aria-labelledby="headingjuin"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted tablejuin22">
                                    <thead>

                                        <tr class="camoisjuin bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div> 
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingjuil">
                        <a class=promojuillet data-toggle="collapse" data-parent="#accordionEx" href="#collapsejuil" aria-expanded="true"
                          aria-controls="collapsejuil">
                          <h5 class="mb-0">
                          Juillet  <i class="fas fa-angle-down rotate-icon"></i>
                          </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""> <?= number_format($careeljuillet2022, 0, ',', ' ')?></a> Ariary </b></span>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapsejuil" class="collapse " role="tabpanel" aria-labelledby="headingjuil"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted tablejuillet22">
                                    <thead>

                                        <tr class="camoisjuillet bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingaout">
                        <a class="collapsed promoaout" data-toggle="collapse" data-parent="#accordionEx" href="#collapseaout"
                          aria-expanded="false" aria-controls="collapseaout">
                          <h5 class="mb-0">
                        Août  <i class="fas fa-angle-down rotate-icon"></i>
                          </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""> <?= number_format($careelaout2022, 0, ',', ' ')?></a> Ariary </b></span>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapseaout" class="collapse" role="tabpanel" aria-labelledby="headingaout"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted tableaout22">
                                    <thead>

                                        <tr class="camoisaout bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div> 
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingsept">
                        <a class="collapsed promosept" data-toggle="collapse" data-parent="#accordionEx" href="#collapsesept"
                          aria-expanded="false" aria-controls="collapsesept">
                        <h5 class="mb-0">
                        Septembre  <i class="fas fa-angle-down rotate-icon"></i>
                          </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""> <?= number_format($careelsept2022, 0, ',', ' ')?></a> Ariary </b></span>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapsesept" class="collapse" role="tabpanel" aria-labelledby="headingsept"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                        <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted tablesept2022">
                                    <thead>

                                        <tr class="camoissept bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div> 
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->
                     <!-- Accordion card -->
                     <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingoct">
                    <a class="collapsed promoctobre" data-toggle="collapse" data-parent="#accordionEx" href="#collapseoct" aria-expanded="true"
                        aria-controls="collapseoct">
                        <h5 class="mb-0">
                        Octobre  <i class="fas fa-angle-down rotate-icon"></i>
                        </a><span class="text-center pl-5"><b> chiffres d'affaires réels: &nbsp <a href="#" class=""> <?= number_format($careeloct2022, 0, ',', ' ')?></a> Ariary </b></span>
                        </h5>
                    </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapseoct" class="collapse " role="tabpanel" aria-labelledby="headingoct"
                    data-parent="#accordionEx">
                    <div class="card-body">
                    <span class="date_collapse collapse"> <?php echo $date; ?></span>
                    <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted tableoct2022">
                                    <thead>

                                        <tr class="camoisoct bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div>  
                    </div>
                    </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingnov">
                    <a class="collapsed promonov" data-toggle="collapse" data-parent="#accordionEx" href="#collapsenov"
                        aria-expanded="false" aria-controls="collapsenov">
                        <h5 class="mb-0">
                    Novembre  <i class="fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapsenov" class="collapse" role="tabpanel" aria-labelledby="headingnov"
                    data-parent="#accordionEx">
                    <div class="card-body">
                    <span class="date_collapse collapse"> <?php echo $date; ?></span>
                    <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted table_mois">
                                    <thead>

                                        <tr class="camois bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div> 
                    </div>
                    </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingdec">
                    <a class="collapsed promodec" data-toggle="collapse" data-parent="#accordionEx" href="#collapsedec"
                        aria-expanded="false" aria-controls="collapsedec">
                        <h5 class="mb-0">
                        Décembre  <i class="fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapseT" class="collapse" role="tabpanel" aria-labelledby="headingdec"
                    data-parent="#accordionEx">
                    <div class="card-body">
                    <span class="date_collapse collapse"> <?php echo $date; ?></span>
                    <div class=" table-responsive-lg">
                                <table class="table table-bordered table-stripted table_mois">
                                    <thead>

                                        <tr class="camois bg-primary text-white">
                                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                                            <th style="font-size: 12px;" class="text-center text-white"></th>
                                        </tr>

                                        <tr class="bg-secondary text-white">
                                            <th style="font-size: 12px;" class="text-center">OPLG</th>
                                            <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                </table>
                            </div>  
                    </div>
                    </div>

                    </div>
                    <!-- Accordion card -->

                    </div>
                    <!-- Accordion wrapper --> 

                    </div>
                    <!-- Accordion wrapper -->                    
                    
                </div>
              </div>
            </div>
      </div>
  </div>
</div>

