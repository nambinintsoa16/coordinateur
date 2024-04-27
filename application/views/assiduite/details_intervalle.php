<div class="form-container">
    <table class='table table-bordered table-striped table-responsive-lg'>
        <thead style='background-color:#90CAF9'>
            <th class="text-center">Heure</th>
            <th class="text-center">Présence</th>
            <th class="text-center">Nbr<br>activités</th>
        </thead>
        <tbody class="border-1">
            <tr><td class="text-center">7h-8h</td><td <?php if($interval1 == 0){echo 'style="padding 3px 5px;border-radius:5px;color:red"';}else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';};?>class="text-center"><?php if($interval1 == 0){echo 'PASSIVE';}else{echo 'ACTIVE';};?></td>
                
                <td class="text-center" <?if($donne1 < 10){echo 'style="padding 3px 5px;border-radius:5px;color:red"';
                }elseif($donne1 >= 10 && $donne1 <16 ){echo 'style="padding 3px 5px;border-radius:5px;color:orange"';
                }elseif($donne1 >= 16 && $donne1 <25 ){echo 'style="padding 3px 5px;border-radius:5px;color:blue"';
                }else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';}?> ><?=$donne1?></td></tr>
            <tr><td class="text-center">8h-9h</td><td <?php if($interval2 == 0){echo 'style="padding 3px 5px;border-radius:5px;color:red"';}else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';};?>class="text-center"><?php if($interval2 == 0){echo 'PASSIVE';}else{echo 'ACTIVE';};?></td>
                <td class="text-center" <?if($donne2 < 10){echo 'style="padding 3px 5px;border-radius:5px;color:red"';
                }elseif($donne2 >= 10 && $donne2 <16 ){echo 'style="padding 3px 5px;border-radius:5px;color:orange"';
                }elseif($donne2 >= 16 && $donne2 <25 ){echo 'style="padding 3px 5px;border-radius:5px;color:blue"';
                }else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';}?>><?= $donne2?></td></tr>
            <tr><td class="text-center">9h-10h</td><td <?php if($interval3 == 0){echo 'style="padding 3px 5px;border-radius:5px;color:red"';}else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';};?>class="text-center"><?php if($interval3 == 0){echo 'PASSIVE';}else{echo 'ACTIVE';};?></td>
                <td class="text-center"  <?if($donne3 < 10){echo 'style="padding 3px 5px;border-radius:5px;color:red"';
                }elseif($donne3 >= 10 && $donne3 <16 ){echo 'style="padding 3px 5px;border-radius:5px;color:orange"';
                }elseif($donne3 >= 16 && $donne3 <25 ){echo 'style="padding 3px 5px;border-radius:5px;color:blue"';
                }else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';}?> ><?= $donne3?></td></tr>
            <tr><td class="text-center">10h-11h</td><td <?php if($interval4 == 0){echo 'style="padding 3px 5px;border-radius:5px;color:red"';}else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';};?>class="text-center"><?php if($interval4 == 0){echo 'PASSIVE';}else{echo 'ACTIVE';};?></td>
                <td class="text-center" <?if($donne4 < 10){echo 'style="padding 3px 5px;border-radius:5px;color:red"';
                }elseif($donne4 >= 10 && $donne4 <16 ){echo 'style="padding 3px 5px;border-radius:5px;color:orange"';
                }elseif($donne4 >= 16 && $donne4 <25 ){echo 'style="padding 3px 5px;border-radius:5px;color:blue"';
                }else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';}?> ><?= $donne4?></td></tr>
            <tr><td class="text-center">11h-12h</td><td <?php if($interval5 == 0){echo 'style="padding 3px 5px;border-radius:5px;color:red"';}else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';};?>class="text-center"><?php if($interval5 == 0){echo 'PASSIVE';}else{echo 'ACTIVE';};?></td>
                <td class="text-center" <?if($donne5 < 10){echo 'style="padding 3px 5px;border-radius:5px;color:red"';
                }elseif($donne5 >= 10 && $donne5 <16 ){echo 'style="padding 3px 5px;border-radius:5px;color:orange"';
                }elseif($donne5 >= 16 && $donne5 <25 ){echo 'style="padding 3px 5px;border-radius:5px;color:blue"';
                }else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';}?> ><?= $donne5?></td></tr>
            <tr><td class="text-center">13h-14h</td><td <?php if($interval7 == 0){echo 'style="padding 3px 5px;border-radius:5px;color:red"';}else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';};?>class="text-center"><?php if($interval7 == 0){echo 'PASSIVE';}else{echo 'ACTIVE';};?></td>
                <td class="text-center" <?if($donne7 < 10){echo 'style="padding 3px 5px;border-radius:5px;color:red"';
                }elseif($donne7 >= 10 && $donne7 <16 ){echo 'style="padding 3px 5px;border-radius:5px;color:orange"';
                }elseif($donne7 >= 16 && $donne7 <25 ){echo 'style="padding 3px 5px;border-radius:5px;color:blue"';
                }else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';}?> ><?= $donne7?></td></tr>
            <tr><td class="text-center">14h-15h</td><td <?php if($interval8 == 0){echo 'style="padding 3px 5px;border-radius:5px;color:red"';}else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';};?>class="text-center"><?php if($interval8 == 0){echo 'PASSIVE';}else{echo 'ACTIVE';};?></td>
                <td class="text-center" <?if($donne8 < 10){echo 'style="padding 3px 5px;border-radius:5px;color:red"';
                }elseif($donne8 >= 10 && $donne8 <16 ){echo 'style="padding 3px 5px;border-radius:5px;color:orange"';
                }elseif($donne8 >= 16 && $donne8 <25 ){echo 'style="padding 3px 5px;border-radius:5px;color:blue"';
                }else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';}?> ><?= $donne8?></td></tr>
            <tr><td class="text-center">15h-16h</td><td <?php if($interval9 == 0){echo 'style="padding 3px 5px;border-radius:5px;color:red"';}else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';};?>class="text-center"><?php if($interval9 == 0){echo 'PASSIVE';}else{echo 'ACTIVE';};?></td>
                <td class="text-center"  <?if($donne9 < 10){echo 'style="padding 3px 5px;border-radius:5px;color:red"';
                }elseif($donne9 >= 10 && $donne9 <16 ){echo 'style="padding 3px 5px;border-radius:5px;color:orange"';
                }elseif($donne9 >= 16 && $donne9 <25 ){echo 'style="padding 3px 5px;border-radius:5px;color:blue"';
                }else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';}?> ><?= $donne9?></td></tr>
            <tr><td class="text-center">16h-17h</td><td <?php if($interval10 == 0){echo 'style="padding 3px 5px;border-radius:5px;color:red"';}else{echo 'style="padding:5px 10px;border-radius:5px;color:green"';};?>class="text-center"><?php if($interval10 == 0){echo 'PASSIVE';}else{echo 'ACTIVE';};?></td>
                <td class="text-center" <?if($donne10 < 10){echo 'style="padding 3px 5px;border-radius:5px;color:red"';
                }elseif($donne10 >= 10 && $donne10 <16 ){echo 'style="padding 3px 5px;border-radius:5px;color:orange"';
                }elseif($donne10 >= 16 && $donne10 <25 ){echo 'style="padding 3px 5px;border-radius:5px;color:blue"';
                }else{echo 'style="padding 3px 5px;border-radius:5px;color:green"';}?> ><?= $donne10?></td></tr>
        </tbody>
    </table>
</div>
