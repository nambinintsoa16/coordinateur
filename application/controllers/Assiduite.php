<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assiduite extends My_Controller
{
    public function presence()
    {
        $date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}
        $content="";
        
        $result=$this->accueil_model->liste_oplg($date);
        foreach($result as $key=>$result)
        {
            $data = array();
            $prese=$this->accueil_model->heure($result->operatrice,$date);
            $heurediscu=$this->accueil_model->heure_premiere_discussion($result->operatrice,$date);
            $heureFdiscu=$this->accueil_model->heure_derniere_discussion($result->operatrice,$date);
            $heureDtache=$this->accueil_model->debut_tache($result->operatrice,$date);
            $heureFtache=$this->accueil_model->fin_tache($result->operatrice,$date);
            $int=$this->accueil_model->intervalle($date,'07:00:00','08:00:00',$result->operatrice);
            $int2=$this->accueil_model->intervalle($date,'08:00:00','09:00:00',$result->operatrice);
            $int3=$this->accueil_model->intervalle($date,'09:00:00','10:00:00',$result->operatrice);
            $int4=$this->accueil_model->intervalle($date,'10:00:00','11:00:00',$result->operatrice);
            $int5=$this->accueil_model->intervalle($date,'11:00:00','12:00:00',$result->operatrice);
            $int7=$this->accueil_model->intervalle($date,'13:00:00','14:00:00',$result->operatrice);
            $int8=$this->accueil_model->intervalle($date,'14:00:00','15:00:00',$result->operatrice);
            $int9=$this->accueil_model->intervalle($date,'15:00:00','16:00:00',$result->operatrice);
            $int10=$this->accueil_model->intervalle($date,'16:00:00','17:00:00',$result->operatrice);
            if($prese){
                $heure = $prese->heure;
            }else{
                $heure = "";
            }

            if($heurediscu){
                $heureD = $heurediscu->heure;
            }else{
                $heureD="";
            }

            if($heureFdiscu){
                $heureF = $heureFdiscu->heure;
            }else{
                $heureF="";
            }

            if($heureDtache){
                $heureDT = $heureDtache->heure;
            }else{
                $heureDT="";
            }

            if($heureFtache){
                $heureFT = $heureFtache->heure;
            }else{
                $heureFT = "";
            }

            if(count($int)!=0){
                $interval1 = 1;
            }else{
                $interval1 =0;
            }

            if(count($int2)!=0){
                $interval2 = 1;
            }else{
                $interval2 =0;
            }

            if(count($int3)!=0){
                $interval3 = 1;
            }else{
                $interval3 =0;
            }

            if(count($int4)!=0){
                $interval4 = 1;
            }else{
                $interval4 =0;
            }

            if(count($int5)!=0){
                $interval5 = 1;
            }else{
                $interval5 =0;
            }

            if(count($int7)!=0){
                $interval7 = 1;
            }else{
                $interval7 =0;
            }

            if(count($int8)!=0){
                $interval8 = 1;
            }else{
                $interval8 =0;
            }

            if(count($int9)!=0){
                $interval9 = 1;
            }else{
                $interval9 =0;
            }

            if(count($int10)!=0){
                $interval10 = 1;
            }else{
                $interval10 =0;
            }

            $totalintervalle=$interval1 + $interval2 + $interval3 + $interval4 + $interval5 + $interval7 + $interval8 + $interval9 + $interval10;
            if($totalintervalle >=8){
                    $content.="<tr><td class='collapse'><a href='#'>".$result->operatrice."</a></td><td class='text-center'>". $heure."</td><td>".$result->operatrice."</td><td><a href='#' class='prenom'>".substr($result->Prenom,0 , 25)."</a></td><td class='text-center'>".$heureD."</td><td class='text-center'>".$heureF."</td><td>".$heureDT."</td><td>".$heureFT."</td><td class='text-center'><a href='#' class='intervalle'>".$totalintervalle."</a></td><td style='background:#00B74A;'></td></tr>";
            }else{
                    $content.="<tr><td class='collapse'><a href='#'>".$result->operatrice."</a></td><td class='text-center'>". $heure."</td><td>".$result->operatrice."</td><td><a href='#' class='prenom'>".substr($result->Prenom,0 , 25)."</a></td><td class='text-center'>".$heureD."</td><td class='text-center'>".$heureF."</td><td>".$heureDT."</td><td>".$heureFT."</td><td class='text-center'><a href='#' class='intervalle'>".$totalintervalle."</a></td><td style='background:#F93154;'></td></tr>";
                }
        }
        $data=[
            'date'=>$date,
            'data'=>$content
        ];
        $this->render_view('assiduite/presence',$data);
    }
    public function details_heures()
    {
        $this->load->model('accueil_model');
        $color=array('#F93154','#00B74A');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $result=$this->accueil_model->liste_oplg2($date,$matricule);
        $int=array();
        $int2=array();
        foreach($result as $key=>$result)
        {
            $int=$this->accueil_model->intervalles($date,'07:00:00','08:00:00',$result->operatrice);
            $int2=$this->accueil_model->intervalle($date,'08:00:00','09:00:00',$result->operatrice);
            $int3=$this->accueil_model->intervalle($date,'09:00:00','10:00:00',$result->operatrice);
            $int4=$this->accueil_model->intervalle($date,'10:00:00','11:00:00',$result->operatrice);
            $int5=$this->accueil_model->intervalle($date,'11:00:00','12:00:00',$result->operatrice);
            $int7=$this->accueil_model->intervalle($date,'13:00:00','14:00:00',$result->operatrice);
            $int8=$this->accueil_model->intervalle($date,'14:00:00','15:00:00',$result->operatrice);
            $int9=$this->accueil_model->intervalle($date,'15:00:00','16:00:00',$result->operatrice);
            $int10=$this->accueil_model->intervalle($date,'16:00:00','17:00:00',$result->operatrice);
        }
        if(count($int)!=0){
            $interval1 = 1;
        }else{
            $interval1 =0;
        }

        if(count($int2)!=0){
            $interval2 = 1;
        }else{
            $interval2 =0;
        }
            echo "<table class='table table-bordered table-striped  table-responsive-lg'>
                    <thead style='background-color:#90CAF9'>
                        <th class='text-center'>Heure</th>
                        <th class='text-center'>Présence</th>
                    </thead>
                    <tbody>
                        <tr><th class='text-center'>7h - 8h</th><td style='background-color:".$color[$interval1]."'></td></tr>
                        <tr><th class='text-center'>8h - 9h</th><td style='background-color:".$color[$interval2]."'></td></tr>
                        <tr><th class='text-center'>9h - 10h</th><td></td></tr>
                        <tr><th class='text-center'>10h - 11h</th><td></td></tr>
                        <tr><th class='text-center'>11h - 12h</th><td></td></tr>
                        <tr><th class='text-center'>13h - 14h</th><td></td></tr>
                        <tr><th class='text-center'>14h - 15h</th><td></td></tr>
                        <tr><th class='text-center'>15h - 16h</th><td></td></tr>
                        <tr><th class='text-center'>16h - 17h</th><td></td></tr>
                        </tbody>
                </table>";
        
    }
    public function details_intervalle()
    {
        $date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}

        $interval1=array();
        $interval2=array();
        $interval3=array();
        $interval4=array();
        $interval5=array();
        $interval7=array();
        $interval8=array();
        $interval9=array();
        $interval10=array();

        $donne=0;
    
            $data = array();
            $int2=$this->accueil_model->intervalle($date,'08:00:00','09:00:00',$this->input->post('matricule'));
            $int3=$this->accueil_model->intervalle($date,'09:00:00','10:00:00',$this->input->post('matricule'));
            $int4=$this->accueil_model->intervalle($date,'10:00:00','11:00:00',$this->input->post('matricule'));
            $int5=$this->accueil_model->intervalle($date,'11:00:00','12:00:00',$this->input->post('matricule'));
            $int7=$this->accueil_model->intervalle($date,'13:00:00','14:00:00',$this->input->post('matricule'));
            $int8=$this->accueil_model->intervalle($date,'14:00:00','15:00:00',$this->input->post('matricule'));
            $int9=$this->accueil_model->intervalle($date,'15:00:00','16:00:00',$this->input->post('matricule'));
            $int10=$this->accueil_model->intervalle($date,'16:00:00','17:00:00',$this->input->post('matricule'));

            $count1=$this->accueil_model->counttache($date,'07:00:00','08:00:00',$this->input->post('matricule'));
            $count2=$this->accueil_model->counttache($date,'08:00:00','09:00:00',$this->input->post('matricule'));
            $count3=$this->accueil_model->counttache($date,'09:00:00','10:00:00',$this->input->post('matricule'));
            $count4=$this->accueil_model->counttache($date,'10:00:00','11:00:00',$this->input->post('matricule'));
            $count5=$this->accueil_model->counttache($date,'11:00:00','12:00:00',$this->input->post('matricule'));
            $count7=$this->accueil_model->counttache($date,'13:00:00','14:00:00',$this->input->post('matricule'));
            $count8=$this->accueil_model->counttache($date,'14:00:00','15:00:00',$this->input->post('matricule'));
            $count9=$this->accueil_model->counttache($date,'15:00:00','16:00:00',$this->input->post('matricule'));
            $count10=$this->accueil_model->counttache($date,'16:00:00','17:00:00',$this->input->post('matricule'));

            if(count($this->accueil_model->intervalle($date,'07:00:00','08:00:00',$this->input->post('matricule')))!=0){
                $interval1 = 1;
            }else{
                $interval1 =0;
            }

            if(count($int2)!=0){
                $interval2 = 1;
            }else{
                $interval2 =0;
            }

            if(count($int3)!=0){
                $interval3 = 1;
            }else{
                $interval3 =0;
            }

            if(count($int4)!=0){
                $interval4 = 1;
            }else{
                $interval4 =0;
            }

            if(count($int5)!=0){
                $interval5 = 1;
            }else{
                $interval5 =0;
            }

            if(count($int7)!=0){
                $interval7 = 1;
            }else{
                $interval7 =0;
            }

            if(count($int8)!=0){
                $interval8 = 1;
            }else{
                $interval8 =0;
            }

            if(count($int9)!=0){
                $interval9 = 1;
            }else{
                $interval9 =0;
            }

            if(count($int10)!=0){
                $interval10 = 1;
            }else{
                $interval10 =0;
            }

            
        
        $data=[
            'date'=>$date,
            'donne1'=>count($count1),
            'donne2'=>count($count2),
            'donne3'=>count($count3),
            'donne4'=>count($count4),
            'donne5'=>count($count5),
            'donne7'=>count($count7),
            'donne8'=>count($count8),
            'donne9'=>count($count9),
            'donne10'=>count($count10),
            'interval1'=>$interval1, 
            'interval2'=>$interval2, 
            'interval3'=>$interval3,
            'interval4'=>$interval4,
            'interval5'=>$interval5, 
            'interval7'=>$interval7, 
            'interval8'=>$interval8, 
            'interval9'=>$interval9,
            'interval10'=>$interval10,
        ];
        $this->load->view('assiduite/details_intervalle',$data);
    }

    public function presence_mensuelle()
    {
        $data = [
            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Août", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre")
        ];
        $this->render_view('assiduite/presence_mensuelle',$data);
    }
    public function detail_calendrier()
	{
		$this->render_view('assiduite/detail_calendrier');
	}

    public function mois()
    {
        $mois = date('Y-m');
        $retard1 = 0;
        $datesession = '07:15:00';
        $test = 0;
        $retardse=0;
        $retards=0;
        $times="";
        $temps="";
        
        $detailretard = $this->accueil_model->detailretard($mois);
        $datas = $this->accueil_model->opl_listes($mois);
        foreach ($datas as $row) {              
            $sub_array = array(); 
            $entree =0;  
            $sortie =0;                     
            $retard = $this->accueil_model->retard($mois,$row->Matricule_personnel);
            if($retard > $datesession){
                $retard1 = count($retard);
            }else{
                $retard1 = 0;
            }

            $result = $this->accueil_model->sommesolde($mois,$row->Matricule_personnel);
            foreach($result as $result)
            {
                $entree += $result->secentree;
                $sortie += $result->secrecup;
            }
            
            
            $test = count($detailretard);
            $sub_array[] = $row->Matricule_personnel;
            $sub_array[] = strtoupper($row->Prenom); 
            $sub_array[] = "<center>".$this->sec_to_time($entree-$sortie)."</center>";           
            $sub_array[] =  "<a href='#' class='retard'>".$retard1."</a>";
            //$sub_array[] =  "<a href='#' class=''>".count($this->accueil_model->recuperation($mois,$row->Matricule_personnel))."</a>";
            $sub_array[] = $test - count($this->accueil_model->presence($mois,$row->Matricule_personnel));
            $sub_array[] = "<a href='#' class='presence'>".count($this->accueil_model->presence($mois,$row->Matricule_personnel))."</a>";
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );    
        echo json_encode($output);
    }

    public function months($s2)
    {
        $moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Août" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $dateD = date($moi[$s2]);
        $mois = $moi[$s2];
        $datas = $this->accueil_model->opl_listes($mois);
        $test = 0;
        $detailretard = $this->accueil_model->detailretard($mois);
        $data = array();
        $datesession = '07:15:00';
        
        foreach ($datas as $row) {
            $sub_array = array();
            $entree =0;  
            $sortie =0; 
            $retard = $this->accueil_model->retard($dateD,$row->Matricule_personnel);
            $absence = $this->accueil_model->presence($dateD,$row->Matricule_personnel);
            if($retard > $datesession){
                $retard1 = count($retard);
            }else{
                $retard1 = 0;
            }

            $result = $this->accueil_model->sommesolde($mois,$row->Matricule_personnel);
            foreach($result as $result)
            {
                $entree += $result->secentree;
                $sortie += $result->secrecup;
            }
            
            $test = count($detailretard);
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  strtoupper(substr($row->Prenom, 0, 15));
            $sub_array[] = $this->sec_to_time($entree-$sortie);  ;             
            $sub_array[] =  "<a href='#' class='retard'>".$retard1."</a>";
            //$sub_array[] =  "<a href='#' class=''>".count($this->accueil_model->recuperation($dateD,$row->Matricule_personnel))."</a>";
            $sub_array[] =  $test - count($this->accueil_model->presence($dateD,$row->Matricule_personnel));
            $sub_array[] =  "<a href='#'>".count($this->accueil_model->presence($dateD,$row->Matricule_personnel))."</a>";
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }
    public function detailpresence()
    {
        $this->load->model('accueil_model');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Août" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $content="";
        $result=$this->accueil_model->presence(date($mo[$parametre]),$this->input->post('matricule'));   
        foreach($result as $result){            
            $content .= "<tr><td class='text-center'>" .$result->date. "</td></tr>";
        
        }      
        echo "<table class='table table-bordered table1'><thead style='background-color:#90CAF9'><th class='text-center'>Date</th></thead><tbody>" . $content . "</tbody></table>";
    }

    public function detailabsence()
    {
        $this->load->model('accueil_model');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Août" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $content="";
        $retardse=0;
        $retards=0;
        $times="";
        $temps="";
        $result=$this->accueil_model->sommeretard(date($mo[$parametre]),$this->input->post('matricule'));   
        foreach($result as $result){

        $content .= "<tr style='font-size:8px'><td class='collapse'>" .$result->entree. "</td><td class='text-center'>" .$result->date. "</td><td class='text-center'>".$result->Date."</td><td>".$result->entree."</td><td  class='text-center'>".$result->sortie."</td><td  class='text-center'>".$result->solde."</td></tr>";
        if($result->solde!=""){
        $dt= new dateTime($result->solde);
        $times= $dt->format('H:i:s');
        $retardse+=$this->time_to_sec($times);
        }

        if($result->entree!=""){
        $dt= new dateTime($result->entree);
        $temps= $dt->format('H:i:s');
        $retards+=$this->time_to_sec($temps);
    }

    $soldes=$retards - $retardse;

    } 
    
        echo "<table class='table table-bordered columnClass'><thead><th class='text-center'></th><th></th><th class='text-center'>".$this->sec_to_time($retards)."</th><th class='text-center'></th><th class='text-center'>".$this->sec_to_time($retardse)."</th></thead><thead style='background-color:#90CAF9'  style='font-size:8px'><th class='text-center'>Date</th><th class='text-center'>Heure d'entrée</th><th>Retard</th><th  class='text-center'>Heure de sortie</th><th  class='text-center'>Récuperation</th></thead><tbody>" . $content . "</tbody></table>";
    }    

    function time_to_sec($time) {
        list($h, $m, $s) = explode (":", $time);
        $seconds = 0;
        $seconds += (intval($h) * 3600);
        $seconds += (intval($m) * 60);
        $seconds += (intval($s));
        return $seconds;
        }
        function sec_to_time($sec) {
        return sprintf('%02d:%02d:%02d', floor($sec / 3600), floor($sec / 60 % 60), floor($sec % 60));
        }
        
    public function detailrecuperation()
    {
        $this->load->model('accueil_model');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Août" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $content="";
        $result=$this->accueil_model->sommerecup(date($mo[$parametre]),$this->input->post('matricule'));   
        foreach($result as $result){                        
            $content .= "<tr><td class='text-center'>" .$result->date. "</td><td class='text-center'>".$result->heure."</td><td>".$result->Diff."</td></tr>";
        }      
        echo "<table class='table table-bordered table1'><thead><th></th><th></th><th class='texte-center'></th></thead><thead style='background-color:#90CAF9'><th class='text-center'>Date </th><th class='text-center'>Heure</th><th>Heure récup</th></thead><tbody>" . $content . "</tbody></table>";
    }

    public function timeline(){

        $this->load->model('accueil_model');      
        $content="";
        $result=$this->accueil_model->timeline($this->input->post('matricule'));   
        foreach($result as $result){                        
            $content .= "<tr><td class='text-center'>" .$result->date. "</td><td class='text-center'>".$result->heure."</td><td>".$result->tache."</td><td>".$result->action."</td></tr>";
        }      
        echo "<div class='container' style='background-color:#e6e6fa'><table class='table table-bordered table1 table-responsive-lg'><thead class='text-white bg-secondary'><th class='text-center'>Date </th><th class='text-center'>Heure</th><th class='text-center'>Tâches</th><th class='text-center'>Action</th></thead><tbody>" . $content . "</tbody></table></div>";

    }

    public function TimeLines()
          {
            $this->load->model('accueil_model');
            
            $data =array();
            $datas = $this->accueil_model->timeline($this->input->get('matricule'));
            foreach ($datas as $row) {
            $sub_array= array();
            $sub_array[] = $row->heure;
            $sub_array[] = $row->tache;
            $sub_array[] =strtoupper($row->action);
            $sub_array[] = "<a href='#' class='client'>".$row->client."</a>";
            $sub_array[] = strtoupper($row->Nom_page);
             
            $data[] = $sub_array;
            }
            $output = array(
            "data" => $data
            );
        echo json_encode($output);
    }  

    public function Time_Line(){

        $this->load->model('accueil_model'); 
        $caj=0;
        $ca=0;
        $facture = $this->accueil_model->ca_par_oplg($this->input->post('matricule'),date('Y-m-d'));
        foreach ($facture as $facture) {
                $caj += ($facture->Quantite * $facture->Prix_detail);
            } 

        $camensuel = $this->accueil_model->ca_par_oplg($this->input->post('matricule'),date('Y-m'));
        foreach ($camensuel as $camensuel) {
                $ca += ($camensuel->Quantite * $camensuel->Prix_detail);
            }     
        $data =[
            'caj'=>$caj,
            'ca'=>$ca,
            'infoclient'=>$this->accueil_model->operatrice($this->input->post('matricule')),
            'result'=>$this->accueil_model->timeline($this->input->post('matricule'))

        ]; 
        //var_dump($data);
        $this->load->view('assiduite/timeline',$data);
    }



    public function assiduit()
    {
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $data=[
            'date'=>$date,
            'oplg'=>$this->accueil_model->liste_oplg($date)
         ];
        $this->render_view('assiduite/assiduit',$data);
    }

    public function detailInervale()
    {

         $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $content="";
        
            $data = array();
            $int=$this->accueil_model->intervalle($date,'07:00:00','08:00:00',$this->input->post('matricule'));
            $int2=$this->accueil_model->intervalle($date,'08:00:00','09:00:00',$this->input->post('matricule'));
            $int3=$this->accueil_model->intervalle($date,'09:00:00','10:00:00',$this->input->post('matricule'));
            $int4=$this->accueil_model->intervalle($date,'10:00:00','11:00:00',$this->input->post('matricule'));
            $int5=$this->accueil_model->intervalle($date,'11:00:00','12:00:00',$this->input->post('matricule'));
            $int7=$this->accueil_model->intervalle($date,'13:00:00','14:00:00',$this->input->post('matricule'));
            $int8=$this->accueil_model->intervalle($date,'14:00:00','15:00:00',$this->input->post('matricule'));
            $int9=$this->accueil_model->intervalle($date,'15:00:00','16:00:00',$this->input->post('matricule'));
            $int10=$this->accueil_model->intervalle($date,'16:00:00','17:00:00',$this->input->post('matricule'));
            
            if(count($int)!=0){
                $interval1 = 1;
            }else{
                $interval1 =0;
            }

            if(count($int2)!=0){
                $interval2 = 1;
            }else{
                $interval2 =0;
            }

            if(count($int3)!=0){
                $interval3 = 1;
            }else{
                $interval3 =0;
            }

            if(count($int4)!=0){
                $interval4 = 1;
            }else{
                $interval4 =0;
            }

            if(count($int5)!=0){
                $interval5 = 1;
            }else{
                $interval5 =0;
            }

            if(count($int7)!=0){
                $interval7 = 1;
            }else{
                $interval7 =0;
            }

            if(count($int8)!=0){
                $interval8 = 1;
            }else{
                $interval8 =0;
            }

            if(count($int9)!=0){
                $interval9 = 1;
            }else{
                $interval9 =0;
            }

            if(count($int10)!=0){
                $interval10 = 1;
            }else{
                $interval10 =0;
            }

            $totalintervalle=$interval1 + $interval2 + $interval3 + $interval4 + $interval5 + $interval7 + $interval8 + $interval9 + $interval10;
            if($totalintervalle >=8){
                    $content.="<tr><td class='text-center'><a href='#' class='intervalle'>".$totalintervalle."</a></td><td style='background:#00B74A;'></td></tr>";
            }else{
                    $content.="<tr><td class='text-center'><a href='#' class='intervalle'>".$totalintervalle."</a></td><td style='background:#F93154;'></td></tr>";
                }
             $data=[
            'date'=>$date,
            'data'=>$content
        ];
        $this->load->view('assiduite/detailIntervale',$data);

    }

    public function profilClient()
    {

        $ca=0;
        $montant=0;
        $produit=0;
        $facture = $this->accueil_model->ca_par_client($this->input->post('code_client'));
        foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
                }
        $data=[
            'ca'=>$ca,
            'infoclient'=>$this->accueil_model->infoclients($this->input->post('code_client')),
            'facture'=>$this->accueil_model->ca_par_client($this->input->post('code_client')),
            'profil'=>$this->accueil_model->infoclient($this->input->post('code_client'))
        ];
        $this->load->view('assiduite/profil', $data);
    }

    public function listeClients()
    {
        $data=[

            'infoclient'=>$this->accueil_model->listeClients($this->input->post('code_client'))            
        ];
        $this->load->view('assiduite/listeClient',$data);
    }

    public function clientAvecAchat()
    {
        $data=[
            'infoclient'=>$this->accueil_model->client_avec_achat($this->input->post('matricule'),date('Y-m-d')) 
        ];
        $this->load->view('assiduite/listClient',$data);
    }

    public function clientAvecAchatMensuel()
    {
        $data=[
            'infoclient'=>$this->accueil_model->client_avec_achat($this->input->post('matricule'),date('Y-m')) 
        ];
        $this->load->view('assiduite/listClient',$data);
    }


    public function Time_Lines(){

        $this->load->model('accueil_model'); 
        $caj=0;
        $ca=0;
        $facture = $this->accueil_model->ca_par_oplg($this->input->post('matricule'),date('Y-m-d'));
        foreach ($facture as $facture) {
                $caj += ($facture->Quantite * $facture->Prix_detail);
            } 

        $camensuel = $this->accueil_model->ca_par_oplg($this->input->post('matricule'),date('Y-m'));
        foreach ($camensuel as $camensuel) {
                $ca += ($camensuel->Quantite * $camensuel->Prix_detail);
            }     
        $data =[
            'caj'=>$caj,
            'ca'=>$ca,
            'infoclient'=>$this->accueil_model->operatrice($this->input->post('matricule')),
            'result'=>$this->accueil_model->timeline($this->input->post('matricule'))

        ]; 
        $this->load->view('assiduite/time_line',$data);
    }
    
}
