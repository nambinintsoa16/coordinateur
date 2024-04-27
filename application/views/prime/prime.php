<div class="container">
    <fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm">PRIME OBTENU SUR LES PRODUITS LESSIVES</b></legend>
      
    </fieldset>    
    
        <div class="col-md-12 m-0 p-0">
            <div class="table-responsive">
                <table class="table table-bordered  table-striped table-hover table_prime">
                    <thead class="">

                        <tr class="perfomois bg-secondary text-white">
                            <th style="font-size: 12px;" class="text-center text-white">MATRICULE</th>
                             <th style="font-size: 12px;" class="text-center text-white">PRENOM</th>
                            <th style="font-size: 12px;" class="text-center text-white">PRIME</th>
                            <th style="font-size: 12px;" class="text-center text-white totalprevisio">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$data?>
                    </tbody>
                </table>
            </div>
        </div>
    <div class="form-group col-md-12 text-right pr-5">
        <a href="<?=base_url('performance/printdataPrime')?>" class="btn btn-success"><i class="flaticon-inbox"></i> EXPORT</a>
    </div>
</div>