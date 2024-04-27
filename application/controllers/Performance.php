<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Performance extends My_Controller
{

    public function index()
    {
    }
    public function perfo()
    {

        $this->load->model('accueil_model');
        $date = $this->input->post('date');

        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $mois = date('Y-m');
        $content = "";
        $entete = array('totalclient' => 0, 'totalreponse' => 0, 'ca' => 0, 'totalproduit' => 0, 'totalpublication' => 0, 'totalcomment' => 0);
        $datas = $this->accueil_model->opl_liste2($mois);
        foreach ($datas as $key => $datas) {
            $data = array();
            $produit = 0;
            $page = $this->accueil_model->groupeuser($datas->Matricule);
            $publica = $this->accueil_model->reppublication($datas->Matricule, $date);
            $commentaire = $this->accueil_model->commentaire($datas->Matricule, $date);
            $client = $this->accueil_model->table_rapport($date, $datas->Matricule);
            $sender = $this->accueil_model->repopl($date, $datas->Matricule);
            $facture = $this->accueil_model->nbr_produits($datas->Matricule, $date);
            foreach ($facture as $facture) {
                $produit += $facture->Quantite;
            }
            if ($page) {
                $link_page = $page->Lien_page;
                $page_name = $page->Nom_page;
            } else {
                $link_page = "";
                $page_name = "";
            }

            $entete['totalcomment'] += count($commentaire);
            $entete['totalclient'] += count($client);
            $entete['totalreponse'] += count($sender);
            $entete['totalproduit'] += $produit;
            $entete['totalpublication'] += count($publica);
            $content .= "<tr><td class='collapse'>" . $datas->Matricule . "</td><td style='font-size:12px' class='col_1'>" . $datas->Prenom . "</td><td class='text-center' style='font-size:12px'>" . substr($datas->Matricule, 0, 7) . "</td></td><td style='font-size:10px' class='text-center'><a href='" . $link_page . "' target='_blank'>" . strtoupper($page_name) . "</a></td><td class='text-center'>" . count($commentaire) . "</td><td class='text-center'>" . count($client) . "</td></td><td class='text-center'>" . count($sender) . "</td><td class='text-center'><a href='#' class='produit'>" . $produit . "</a></td><td class='text-center'>" . count($publica) . "</td></tr>";
        }

        $data = ['data' => $content, 'date' => $date, 'entete' => $entete];

        $this->render_view('performance/perfo', $data);
    }
    public function dateDuMois($mois=FALSE){
        $i=1;
        $date=array();
        if($mois == FALSE){
            $mois=date('Y-m');
        }
        $testdate=explode("-",$mois);
        if(count($testdate)>1){
          $mois=$testdate[0]."-".$testdate[1]; 
        }
          $dt=new dateTime($mois);
          $nbJour=$dt->format('t');
        
         do{
          $dt=new dateTime($mois.'-'.$i);
          $date[]=$dt;
          $i++;  
             
         }while ($i <=  $nbJour);
          
          
        return $date;
    }
    public function Etat_discussion_mensuel(){
        $this->load->model('accueil_model');
        $data = [
            'date'=>$this->dateDuMois(),
            'matricule'=>$this->accueil_model->listeDesOplg()
         ];
        $this->render_view('performance/performance_matricule_mensuel', $data);
    }
    public function  Etat_discussion_par_page_mensuel(){
        $this->load->model('accueil_model');
        $data = [
            'date'=>$this->dateDuMois(),
            'page'=>$this->accueil_model->get_page_facebook(['statut'=>'on'])
        ];
        $this->render_view('performance/performance_page_mensuel', $data);
    }

    public function liste_facture(){
        $this->render_view('performance/list_facture');
    }
    public function return_operateur($contacts){
        $length_num= strlen($contacts);
        if($length_num >10){
			$num = "0".substr($contacts, 5, -10);
        }else{
        	$num = substr($contacts, 0, -7);
        }
    	switch ($num) {
    		case "033":
    			return 'Airtel';
    			break;
    		case "032":
    			return 'Orange';
    			break;	
    		case "034":
    			return 'Telma';
    			break;	
    		case "038":
    			return 'Telma';
    			break;	
    		default:
    			return $num;
    			break;
    	}
    }


    public function return_label_koty($level){
    	switch ($level) {
    		case "Level_1":
    			return 'Zen_LV1';
    			break;
    		case "Level_2":
    			return 'Zen_LV2';
    			break;	
    		case "Level_3":
    			return 'Zen_LV3';
    			break;	
    		case "Level_4":
    			return 'Zen_LV4';
    			break;	
    		case "Level_5":
    			return 'Zen_LV5';
    			break;
    		default:
    			return "Level_1";
    			break;
    	}
    }
    public function liste_facture_data(){
        $this->load->model('accueil_model');  
        $debut = $this->input->get('debut');
        $fin = $this->input->get('fin');      
        $date =date('Y-m-d'); 
    
        if($debut !="" && $fin !=""){
        	$requette =  "livraison.date_de_livraison BETWEEN '$debut' AND '$fin'";
        }else if($debut !="") {
        	$requette =  "livraison.date_de_livraison ='$debut'";
        }else{
        	$requette =  "livraison.date_de_livraison ='$date' ";
        }
       

        $data =array();          
        $datas = $this->accueil_model->get_livraisonS($requette);
        foreach ($datas as $row) {               
            $sub_array= array();
            $label_koty = $this->return_label_koty($row->Level); 
            $sub_array[] = $row->Code_client;
            $sub_array[] = $row->Nom;
            $sub_array[] = $row->date_de_livraison;
            $sub_array[] = $row->contacts;
            $sub_array[] = $this->return_operateur($row->contacts);
            $sub_array[] = $row->Nom_page;
            $sub_array[] = $row->lieu_de_livraison;
            $sub_array[] = $row->Localite;
            $sub_array[] = $row->lieu_livre_clt;
            $sub_array[] = number_format($row->Prix_detail);
            $sub_array[] = number_format($row->Quantite);
            $sub_array[] = number_format($row->Quantite * $row->Prix_detail);
            $sub_array[] = number_format($row->$label_koty * $row->Quantite);
            $sub_array[] = $row->Status;
       

            $data[] = $sub_array;
            }
            $output = array(
            "data" => $data
        );
        echo json_encode($output);



    }
 
    public function produitUser()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->produits_details($matricule, $date);
        $arrayContent = array();
        $content = "";
        $ca = 0;
        $produit = 0;
        $total = array();

        foreach ($facture as $facture) {
            if (array_key_exists($facture->Designation, $total)) {
                $total[$facture->Designation] += ($facture->Quantite * $facture->Prix_detail);
            } else {
                $total[$facture->Designation] = ($facture->Quantite * $facture->Prix_detail);
            }
            if (array_key_exists($facture->Designation, $arrayContent)) {
                $arrayContent[$facture->Designation] += $facture->Quantite;
            } else {
                $arrayContent[$facture->Designation] = $facture->Quantite;
            }
        }

        foreach ($arrayContent as $key => $arrayContent) {
            $ca += $total[$key];
            $produit += $arrayContent;

            $content .= "<tr><td class='text-center' style='font-size:12px'>" . $key . "</td><td class='text-center' style='font-size:12px'>" . $arrayContent . "</td><td style='font-size:12px'>" . number_format($total[$key], 0, '.', ',') . "</style></td></tr>";
        }

        echo "<table class='table table-bordered table-striped  table-responsive-lg'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
    }

    public function totalproduitUser()
    {
        $this->load->model('accueil_model');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->total_produits_details($date);
        $arrayContent = array();
        $content = "";
        $ca = 0;
        $produit = 0;
        $total = array();

        foreach ($facture as $facture) {
            if (array_key_exists($facture->Designation, $total)) {
                $total[$facture->Designation] += ($facture->Quantite * $facture->Prix_detail);
            } else {
                $total[$facture->Designation] = ($facture->Quantite * $facture->Prix_detail);
            }
            if (array_key_exists($facture->Designation, $arrayContent)) {
                $arrayContent[$facture->Designation] += $facture->Quantite;
            } else {
                $arrayContent[$facture->Designation] = $facture->Quantite;
            }
        }

        foreach ($arrayContent as $key => $arrayContent) {
            $ca += $total[$key];
            $produit += $arrayContent;

            $content .= "<tr><td class='text-center' style='font-size:12px'>" . $key . "</td><td class='text-center' style='font-size:12px'>" . $arrayContent . "</td><td style='font-size:12px'>" . number_format($total[$key], 0, '.', ',') . "</style></td></tr>";
        }

        echo "<table class='table table-bordered table-striped  table-responsive-lg'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
    }



    public function liste_clients()
    {
        $this->load->model('accueil_model');

        $content = 0;
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $i = 0;
        $reponse = $this->accueil_model->table_listeclient($date, $matricule);
        $statut = $this->accueil_model->statut($date, $matricule);
        foreach ($reponse as  $reponse) {

            $discusss = $this->accueil_model->detail_discussion_operatrice($date, $matricule, $reponse->client);
            $content .= "<tr><td>" . $reponse->client . "</td><td>" . count($discusss) . "</td><td>" . $this->statut($reponse->client, $matricule, $date) . "</td></tr>";
            $i++;
        }


        echo "<table class='table table-bordered table-striped  table-responsive-lg'><thead style='background-color:#E8EAF6'>
        <th class='text-center'>CLIENT</th>
        <th class='text-center'>NBRE DE DISCUSSIONS</th>
        <th class='text-center'>STATUT</th>
        </thead><thead style='background-color:#90CAF9'></thead>
        <tbody style='font-size:12px'>" . $content . " 
        </tbody></table>";
    }
    public function statut($client, $user, $date = FALSE)
    {
        $this->load->model('accueil_model');
        $test = 'En cours';
        $statut = '<span style="background-color:#007E33;padding:5px 10px;border-radius:5px;color:#fff;">En cours</span>';
        $data = $this->accueil_model->statut($client, $user, $date);
        foreach ($data as $data) {
            if ($data->Type == "vente") {
                $statut = '<span style="background-color:#0099CC;padding:5px 10px;border-radius:5px;color:#fff;">Conclue</span>';
                $test = 'Conclue';
            } else if ($data->Type == "Termnier") {
                if ($test != "Conclue") {
                    $statut = '<span style="background-color:#CC0000;padding:5px 10px;border-radius:5px;color:#fff;">Terminée</span>';
                }
            }
        }
        return $statut;
    }
    public function mois()
    {
        $data = [

            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre")

        ];
        $this->render_view('performance/mois', $data);
    }

    public function months()
    {
        $mois = date('Y-m');
        $datas = $this->accueil_model->opl_liste($mois);
        $page = $this->accueil_model->groupeuser($datas->Matricule);
        foreach ($datas as $row) {
            $sub_array = array();
            $page = $this->accueil_model->groupeuser($datas->Matricule);
            $sub_array[] = $row->Prenom;
            $sub_array[] =  $page->Nom_page;
            $sub_array[] = count($this->accueil_model->commentairemois($row->Matricule, $mois));
            $sub_array[] = count($this->accueil_model->table_rapportmois($mois, $row->Matricule));
            $sub_array[] = count($this->accueil_model->repoplmois($mois, $row->Matricule));
            $sub_array[] = count($this->accueil_model->nbr_produits_mois($row->Matricule, $mois));
            $sub_array[] = count($this->accueil_model->reppublicationmois($mois, $row->Matricule));

            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }


    public function dataWeek()
    {
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal(date($mo[$parametre]));
        $factur = $this->accueil_model->ca_mensuel_reeltotal(date($mo[$parametre]));
        $factu = $this->accueil_model->ca_mensuel_livretotal(date($mo[$parametre]));


        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function mensuelle()
    {
        $data = [

            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre")

        ];      
        $this->render_view('performance/mensuelle', $data);
    }
        
    public function produitUserMensuel()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->produits_details_mensuel($date,$matricule);
        $arrayContent = array();
        $content = "";
        $ca = 0;
        $produit = 0;
        $total = array();

        foreach ($facture as $facture) {
            if (array_key_exists($facture->Designation, $total)) {
                $total[$facture->Designation] += ($facture->Quantite * $facture->Prix_detail);
            } else {
                $total[$facture->Designation] = ($facture->Quantite * $facture->Prix_detail);
            }
            if (array_key_exists($facture->Designation, $arrayContent)) {
                $arrayContent[$facture->Designation] += $facture->Quantite;
            } else {
                $arrayContent[$facture->Designation] = $facture->Quantite;
            }
        }

        foreach ($arrayContent as $key => $arrayContent) {
            $ca += $total[$key];
            $produit += $arrayContent;

            $content .= "<tr><td class='text-center' style='font-size:12px'>" . $key . "</td><td class='text-center' style='font-size:12px'>" . $arrayContent . "</td><td style='font-size:12px'>" . number_format($total[$key], 0, '.', ',') . "</style></td></tr>";
        }

        echo "<table class='table table-bordered table-striped  table-responsive-lg'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
    }

    public function totalproduitUserMensuel()
    {
        $this->load->model('accueil_model');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->total_produits_details_mensuel($date);
        $arrayContent = array();
        $content = "";
        $ca = 0;
        $produit = 0;
        $total = array();

        foreach ($facture as $facture) {
            if (array_key_exists($facture->Designation, $total)) {
                $total[$facture->Designation] += ($facture->Quantite * $facture->Prix_detail);
            } else {
                $total[$facture->Designation] = ($facture->Quantite * $facture->Prix_detail);
            }
            if (array_key_exists($facture->Designation, $arrayContent)) {
                $arrayContent[$facture->Designation] += $facture->Quantite;
            } else {
                $arrayContent[$facture->Designation] = $facture->Quantite;
            }
        }

        foreach ($arrayContent as $key => $arrayContent) {
            $ca += $total[$key];
            $produit += $arrayContent;

            $content .= "<tr><td class='text-center' style='font-size:12px'>" . $key . "</td><td class='text-center' style='font-size:12px'>" . $arrayContent . "</td><td style='font-size:12px'>" . number_format($total[$key], 0, '.', ',') . "</style></td></tr>";
        }

        echo "<table class='t
        able table-bordered table-striped  table-responsive-lg'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
    }

    public function jour()
    {
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $content="";
        
        $result=$this->accueil_model->liste_oplg($date);
        foreach($result as $key=>$result)
        {
            $data=array();
            $b=$this->accueil_model->comptage($result->operatrice,$date,'PARTAGER LES PUBLICATIONS DANS LES GROUPES');
            $c=$this->accueil_model->comptage($result->operatrice,$date,'REPONDRE AUX COMMENTAIRES DES COLLABORATEURS SUR  PAGE');
            $d=$this->accueil_model->comptage($result->operatrice,$date,'REPONDRE AUX COMMENTAIRES DES COLLABORATEURS SUR  COMPTE');
            $e=$this->accueil_model->comptage($result->operatrice,$date,'POSER DES QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  PAGE');
            $f=$this->accueil_model->comptage($result->operatrice,$date,'POSER DES QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  COMPTE');

            $content.="<tr><td>".$result->operatrice."</td><td>".substr($result->Prenom, 0, 17)."</td><td class='text-center'>".(count($b)+count($c)+count($d)+count($e)+count($f))."</td><td class='text-center'>".count($b)."</td><td class='text-center'>".count($c)."</td><td class='text-center'>".count($d)."</td><td class='text-center'>".count($e)."</td><td class='text-center'>".count($f)."</td></tr>";

        }
        $data=[
            'date'=>$date,
            'data'=>$content
        ];
        $this->render_view('performance/jour',$data);
    }
    public function month()
    {
        $mois = date('Y-m');
        $datas = $this->accueil_model->liste_oplgg($mois);
        foreach ($datas as $row) {
            $sub_array = array();
            $sub_array[] = $row->operatrice;
            $sub_array[] = $row->Prenom;           
            $sub_array[] = count($this->accueil_model->comptages($row->operatrice, $mois,'PARTAGER DES PUBLICATIONS DANS LES GROUPES.')) 
            + count($this->accueil_model->comptages($row->operatrice, $mois,'REPONDRE AUX QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  PAGE')) 
            + count($this->accueil_model->comptages($row->operatrice, $mois,'REPONDRE AUX QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  COMPTE')) 
            + count($this->accueil_model->comptages($row->operatrice, $mois,'POSER DES QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  PAGE')) 
            + count($this->accueil_model->comptages($row->operatrice, $mois,'POSER DES QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  COMPTE'));
            $sub_array[] = count($this->accueil_model->comptages($row->operatrice, $mois,'PARTAGER DES PUBLICATIONS DANS LES GROUPES.'));
            $sub_array[] = count($this->accueil_model->comptages($row->operatrice, $mois,'REPONDRE AUX QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  PAGE'));
            $sub_array[] = count($this->accueil_model->comptages($row->operatrice, $mois,'REPONDRE AUX QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  COMPTE'));
            $sub_array[] = count($this->accueil_model->comptages($row->operatrice, $mois,'POSER DES QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  PAGE'));
            $sub_array[] = count($this->accueil_model->comptages($row->operatrice, $mois,'POSER DES QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  COMPTE'));

            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function datamonths($s2)
    {
        $moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $dateD = date($moi[$s2]);
        $mois = $moi[$s2];
        //$datas = $this->accueil_model->opl_listes($mois);      
        $result=$this->accueil_model->liste_oplgg($mois);
        foreach($result as $row)
        {
            $sub_array = array();
            $sub_array[] = $row->operatrice;
            $sub_array[] = $row->Prenom;            
            $sub_array[] = count($this->accueil_model->comptages($row->operatrice, $dateD,'PARTAGER DES PUBLICATIONS DANS LES GROUPES.')) 
            + count($this->accueil_model->comptages($row->operatrice, $dateD,'REPONDRE AUX QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR PAGE'))
            + count($this->accueil_model->comptages($row->operatrice, $dateD,'REPONDRE AUX QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  COMPTE'))
            + count($this->accueil_model->comptages($row->operatrice, $dateD,'POSER DES QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  PAGE'))
            + count($this->accueil_model->comptages($row->operatrice, $dateD,'POSER DES QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  COMPTE'));
            $sub_array[] = count($this->accueil_model->comptages($row->operatrice, $dateD,'PARTAGER DES PUBLICATIONS DANS LES GROUPES.'));
            $sub_array[] = count($this->accueil_model->comptages($row->operatrice, $dateD,'REPONDRE AUX QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR PAGE'));
            $sub_array[] = count($this->accueil_model->comptages($row->operatrice, $dateD,'REPONDRE AUX QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  COMPTE'));
            $sub_array[] = count($this->accueil_model->comptages($row->operatrice, $dateD,'POSER DES QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  PAGE'));
            $sub_array[] = count($this->accueil_model->comptages($row->operatrice, $dateD,'POSER DES QUESTIONS AUX COMMENTAIRES DES COLLABORATEURS SUR  COMPTE'));

            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function like()
    {
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $content="";
        $contents="";
        $result=$this->accueil_model->liste_oplg($date);
        foreach($result as $key=>$result)
        {
            $data=array();   
            $clt=$this->accueil_model->liste_clients($date, $result->operatrice);
            $a=$this->accueil_model->comptejm($date, $result->operatrice);
            $b=$this->accueil_model->countPROP_CLT_AAC07($date, $result->operatrice);
            $c=$this->accueil_model->countPROP_CLT_AAC14($date, $result->operatrice);
            $d=$this->accueil_model->countRELN_CLT_SAC07($date, $result->operatrice);
            $e=$this->accueil_model->countREAP_CLT_AAC30($date, $result->operatrice);
            $f=$this->accueil_model->countTRTM_VTE_NNLIV($date, $result->operatrice);
            $appel=$this->accueil_model->countappel($date, $result->operatrice);

            $content.="<tr><td>".$result->operatrice."</td><td>".substr($result->Prenom, 0, 17)."</td><td class='text-center'>".(count($a)+count($b)+count($c)+count($d))."</td><td class='text-center'><a href='#' class='clientjm'>".count($a)."</a></td><td class='text-center'><a href='#' class='clientaac7'>".count($b)."</a></td><td class='text-center'><a href='#' class='clientaac14'>".count($c)."</a></td><td class='text-center'><a href='' class='clientsac07'>".count($d)."</a></td><td class='text-center'><a href='' class='clientaac30'>".count($e)."</a></td><td class='text-center'><a href='#' class='clientvnl'>".count($f)."</a></td><td class='text-center'><a href='#' class='client'>".count($clt)."</a></td><td><a href='#' class='appel'>".count($appel)."</a></td></tr>";
            $contents.="";
        }
        $data=[
            'date'=>$date,
            'data' =>$content
        ];

        $this->render_view('performance/like',$data);
    } 
    public function jaime()
    {
        $data = [
            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre")
        ];      
        $this->render_view('performance/jaime',$data);
    } 

    public function jaime_mois()
    {
        $mois = date('Y-m');
        $datas = $this->accueil_model->liste_oplgg($mois);
        foreach ($datas as $row) {
            $sub_array = array();
            $sub_array[] = $row->operatrice;
            $sub_array[] = $row->Prenom;
            $sub_array[] = count($this->accueil_model->comptejm_mois($row->operatrice, $mois))
            + count($this->accueil_model->countPROP_CLT_AAC07_mois($row->operatrice, $mois))
            + count($this->accueil_model->countPROP_CLT_AAC14_mois($row->operatrice, $mois))
            + count($this->accueil_model->countRELN_CLT_SAC07_mois($row->operatrice, $mois))
            + count($this->accueil_model->countREAP_CLT_AAC30_mois($row->operatrice, $mois))
            + count($this->accueil_model->countTRTM_VTE_NNLIV_mois($row->operatrice, $mois));
            $sub_array[] = "<a href='#' class='clientjm'>".count($this->accueil_model->comptejm_mois($row->operatrice, $mois))."</a>";
            $sub_array[] = "<a href='#' class='clientAAC07'>".count($this->accueil_model->countPROP_CLT_AAC07_mois($row->operatrice, $mois))."</a>";
            $sub_array[] = "<a href='#' class='clientAAC14'>".count($this->accueil_model->countPROP_CLT_AAC14_mois($row->operatrice, $mois))."</a>";
            $sub_array[] = "<a href='#' class='clientSAC07'>".count($this->accueil_model->countRELN_CLT_SAC07_mois($row->operatrice, $mois))."</a>";
            $sub_array[] = "<a href='#' class='clientAAC30'>".count($this->accueil_model->countREAP_CLT_AAC30_mois($row->operatrice, $mois))."</a>";
            $sub_array[] = count($this->accueil_model->countTRTM_VTE_NNLIV_mois($row->operatrice, $mois));
            $sub_array[] = "<a href='#' class='liste_mois'>".count($this->accueil_model->liste_client_mois($row->operatrice, $mois))."</a>";
            $sub_array[] = "";

            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function jaimes($s2=false)
    {
        $moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $dateD = date($moi[$s2]);
        $mois = $moi[$s2];
        //$datas = $this->accueil_model->opl_listes($mois);      
        $result=$this->accueil_model->liste_oplgg($mois);
        foreach($result as $row)
        {
            $sub_array = array();            
            $sub_array[] = $row->operatrice;
            $sub_array[] = $row->Prenom;
            $sub_array[] = count($this->accueil_model->comptejm_mois($row->operatrice, $dateD))
            +count($this->accueil_model->countPROP_CLT_AAC07_mois($row->operatrice, $dateD))
            +count($this->accueil_model->countPROP_CLT_AAC14_mois($row->operatrice, $dateD))
            +count($this->accueil_model->countRELN_CLT_SAC07_mois($row->operatrice, $dateD))
            +count($this->accueil_model->countREAP_CLT_AAC30_mois($row->operatrice, $dateD))
            +count($this->accueil_model->countTRTM_VTE_NNLIV_mois($row->operatrice, $dateD));
            $sub_array[] = "<a href='#' class='clientjm'>".count($this->accueil_model->comptejm_mois($row->operatrice, $dateD))."</a>";
            $sub_array[] = count($this->accueil_model->countPROP_CLT_AAC07_mois($row->operatrice, $dateD));
            $sub_array[] = count($this->accueil_model->countPROP_CLT_AAC14_mois($row->operatrice, $dateD));
            $sub_array[] = count($this->accueil_model->countRELN_CLT_SAC07_mois($row->operatrice, $dateD));
            $sub_array[] = count($this->accueil_model->countREAP_CLT_AAC30_mois($row->operatrice, $dateD));
            $sub_array[] = count($this->accueil_model->countTRTM_VTE_NNLIV_mois($row->operatrice, $dateD));
            $sub_array[] = count($this->accueil_model->liste_client_mois($row->operatrice,$dateD));
            $sub_array[] = "";

            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function listeclients()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $content = "";
        $i=1;
        $data = array();
        $client = $this->accueil_model->liste_clients($date, $matricule);
        
        foreach($client as $client)
        {
            $msg = $this->accueil_model->nombre_discu($date, $matricule ,$client->Code_client);
            $content .= "<tr><td>".$i."</td><td  class='text-center'>".$client->Code_client."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td><td class='text-center'>".count($msg)."</td></tr>"; 
            $i++;
        }

        echo "<table class='table table-bordered table1'><thead style='background=blue'><th>N°</th><th class='text-center'>Code client</th><th class='text-center'>Nom client</th><th>Nbre discu</th></thead><tbody>" . $content . "</tbody></table>";
    }


    public function listeclientsjaime()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $i=1;
        $content = "";
        $data = array();
        $client = $this->accueil_model->liste_clients_jaime($date, $matricule);
        foreach($client as $client)
        {
            $content .= "<tr><td>".$i."</td><td>".$client->heure."</td><td  class='text-center'>".$client->Code_client."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
        $i++;
        }

        echo "<table class='table table-bordered table1'><thead><th>N°</th><th>Heure</th><th class='text-center'>Code client</th><th class='text-center'>Nom client</th></thead><tbody>" . $content . "</tbody></table>";
    }

    public function PROP_CLT_AAC07()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $content = "";
        $i=1;
        $data = array();
        $client = $this->accueil_model->PROP_CLT_AAC07($date, $matricule);
        foreach($client as $client)
        {
            $content .= "<tr><td>".$i."</td><td>".$client->heure."</td><td  class='text-center'>".$client->Code_client."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++;
        }

        echo "<table class='table table-bordered table1'><thead><th>N°</th><th>Heure</th><th class='text-center'>Code client</th><th class='text-center'>Nom client</th></thead><tbody>" . $content . "</tbody></table>";
    }

    public function RELN_CLT_SAC07()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $content = "";
        $i=1;
        $data = array();
        $client = $this->accueil_model->RELN_CLT_SAC07($date, $matricule);
        foreach($client as $client)
        {
            
            $content .= "<tr><td>".$i."</td><td>".$client->heure."</td><td class='text-center'>".$client->Code_client."</td><td ><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++;
        }

        echo "<table class='table table-bordered table1'><thead><th>N°</th><th>Heure</th><th class='text-center'>Code client</th><th class='text-center'>Nom client</th></thead><tbody>" . $content . "</tbody></table>";
    }
    

    public function REAP_CLT_AAC30()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $content = "";
        $data = array();
        $i=1;
        $client = $this->accueil_model->REAP_CLT_AAC30($date, $matricule);
        foreach($client as $client)
        {
            
            $content .= "<tr><td>".$i."</td><td>".$client->heure."</td><td class='text-center'>".$client->Code_client."</td><td ><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++;
        }

        $data=[
            'data'=>$content
        ];
        $this->load->view('performance/REAP_CLT_AAC30', $data);
    }

    
    public function TRTM_VTE_NNLIV()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $content = "";
        $data = array();
        $i=1;
        $client = $this->accueil_model->countTRTM_VTE_NNLIV($date, $matricule);
        foreach($client as $client)
        {
            
            $content .= "<tr><td>".$i."</td><td>".$client->heure."</td><td class='text-center'>".$client->Code_client."</td><td ><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++;
        }

        echo "<table class='table table-bordered table1'><thead style='background:#C5CAE9'><th>N°</th><th>Heure</th><th class='text-center'>Code client</th><th class='text-center'>Nom client</th></thead><tbody>" . $content . "</tbody></table>";
    }

    public function listeclientsjaimemois()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $content = "";
        $data = array();
        $i=1;
        $client = $this->accueil_model->listeclientsjaimemois(date($mo[$parametre]), $matricule);
        foreach($client as $client)
        {
            $content .= "<tr><td>".$i."</td><td>".$client->date."</td><td class='text-center'>".$client->Code_client."</td><td ><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++;
        }

        echo "<table class='table table-bordered table1'><thead style='background:#C5CAE9'><th>N°</th><th>Date</th><th class='text-center'>Code client</th><th class='text-center'>Nom client</th></thead><tbody>" . $content . "</tbody></table>";
    }

    /*********************************************details jaime mensuels**************************************************************** */
    public function listeclients_mois()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $content = "";
        $i=1;
        $data = array();
        $client = $this->accueil_model->liste_clients_mois($matricule,date($mo[$parametre]));
        foreach($client as $client)
        {
            $content .= "<tr><td>".$i."</td><td  class='text-center'>".$client->Code_client."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++;
        }

        echo "<table class='table table-bordered table1'><thead style='background=blue'><th>N°</th><th class='text-center'>Code client</th><th class='text-center'>Nom client</th></thead><tbody>" . $content . "</tbody></table>";
    }
    /*************************************************************Page************************************************************************** */

    public function page()
    {
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $content="";
        
        $result=$this->accueil_model->liste_oplg($date);
        foreach($result as $result)
        {
            $data=array();           
            $a=$this->accueil_model->countpage($result->operatrice,$date,"REPONDRE AUX CLIENTS SUR MESSENGER-PAGE");
            $b=$this->accueil_model->countpage($result->operatrice,$date,"ECRIRE AUX CLIENTS SUR MESSENGER-PAGE");
            $c=$this->accueil_model->countpage($result->operatrice,$date,"POSER DES QUESTIONS SUR MESSENGER-PAGE");
            $d=$this->accueil_model->countpagess($result->operatrice,$date);
            $e=$this->accueil_model->countpages($result->operatrice,$date,'M1NTS_ABN_PAGE');

            $content.="<tr><td>".$result->operatrice."</td><td>".substr($result->Prenom, 0, 17)."</td><td class='text-center'>".(count($a)+count($b)+count($c)+count($d)+count($e))."</td><td class='text-center'>".count($a)."</td><td class='text-center'>".count($b)."</td><td class='text-center'>".count($c)."</td><td class='text-center'>".count($d)."</td><td class='text-center'>".count($e)."</td></tr>";

        }
        $data=[
            'date'=>$date,
            'data'=>$content
        ];
        $this->render_view('performance/page',$data);
    }

    public function page_mensuelle()
    {
        $data = [

            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre")

        ];      
        $this->render_view('performance/page_mensuelle',$data);
    } 

    public function contentpage_mensuelle()
    {
        $mois = date('Y-m');
        $datas = $this->accueil_model->liste_oplgg($mois);
        foreach ($datas as $row) {
            $sub_array = array();
            $sub_array[] = $row->operatrice;
            $sub_array[] = $row->Prenom;
            $sub_array[] = count($this->accueil_model->countpagemensuelle($row->operatrice,$mois,"REPONDRE AUX CLIENTS SUR MESSENGER-PAGE"))
            + count($this->accueil_model->countpagemensuelle($row->operatrice,$mois,"ECRIRE AUX CLIENTS SUR MESSENGER-PAGE"))
            + count($this->accueil_model->countpagemensuelle($row->operatrice,$mois,"POSER DES QUESTIONS SUR MESSENGER-PAGE"))
            + count($this->accueil_model->countpagemensuelle($row->operatrice,$mois,'38'));
            $sub_array[] = count($this->accueil_model->countpagemensuelle($row->operatrice,$mois,"REPONDRE AUX CLIENTS SUR MESSENGER-PAGE"));
            $sub_array[] = count($this->accueil_model->countpagemensuelle($row->operatrice,$mois,"ECRIRE AUX CLIENTS SUR MESSENGER-PAGE"));
            $sub_array[] = count($this->accueil_model->countpagemensuelle($row->operatrice,$mois,"POSER DES QUESTIONS SUR MESSENGER-PAGE"));
            $sub_array[] = count($this->accueil_model->countpagemensuelles($row->operatrice,$mois,'M1NTS_ABN_PAGE'));
            $data[] = $sub_array;        
        }

        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }
    public function pagemonth($s2=false)
    {
        $moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $dateD = date($moi[$s2]);
        $mois = $moi[$s2];
        //$datas = $this->accueil_model->opl_listes($mois);      
        $result=$this->accueil_model->liste_oplgg($mois);
        foreach($result as $row)
        {
            $sub_array = array();            
            $sub_array[] = $row->operatrice;
            $sub_array[] = $row->Prenom;
            $sub_array[] = count($this->accueil_model->countpagemensuelle($row->operatrice,$dateD,"REPONDRE AUX CLIENTS SUR MESSENGER-PAGE"))
            + count($this->accueil_model->countpagemensuelle($row->operatrice,$dateD,"ECRIRE AUX CLIENTS SUR MESSENGER-PAGE"))
            + count($this->accueil_model->countpagemensuelle($row->operatrice,$dateD,"POSER DES QUESTIONS SUR MESSENGER-PAGE"))
            + count($this->accueil_model->countpagemensuelle($row->operatrice,$dateD,'38'));
            $sub_array[] = count($this->accueil_model->countpagemensuelle($row->operatrice,$dateD,"REPONDRE AUX CLIENTS SUR MESSENGER-PAGE"));
            $sub_array[] = count($this->accueil_model->countpagemensuelle($row->operatrice,$dateD,"ECRIRE AUX CLIENTS SUR MESSENGER-PAGE"));
            $sub_array[] = count($this->accueil_model->countpagemensuelle($row->operatrice,$dateD,"POSER DES QUESTIONS SUR MESSENGER-PAGE"));
            $sub_array[] = count($this->accueil_model->countpagemensuelles($row->operatrice,$dateD,'M1NTS_ABN_PAGE'));
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function listeclientsSAC07mois()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $content = "";
        $data = array();
        $i=1;
        $client = $this->accueil_model->cleintSAC07_mois($matricule, date($mo[$parametre]));
        foreach($client as $client)
        {
            $content .= "<tr><td>".$i."</td><td>".$client->date."</td><td class='text-center'>".$client->Code_client."</td><td ><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++;
        }

        echo "<table class='table table-bordered table1'><thead style='background:#C5CAE9'><th>N°</th><th>Date</th><th class='text-center'>Code client</th><th class='text-center'>Nom client</th></thead><tbody>" . $content . "</tbody></table>";
    }

    public function listeclientsAAC14mois()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $content = "";
        $data = array();
        $i=1;
        $client = $this->accueil_model->cleintAAC14_mois($matricule, date($mo[$parametre]));
        foreach($client as $client)
        {
            $content .= "<tr><td>".$i."</td><td>".$client->date."</td><td class='text-center'>".$client->Code_client."</td><td ><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++;
        }

        echo "<table class='table table-bordered table1'><thead style='background:#C5CAE9'><th>N°</th><th>Date</th><th class='text-center'>Code client</th><th class='text-center'>Nom client</th></thead><tbody>" . $content . "</tbody></table>";
    }
    

    public function listeclientsAAC30mois()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $content = "";
        $data = array();
        $i=1;
        $client = $this->accueil_model->cleintAAC30_mois($matricule, date($mo[$parametre]));
        foreach($client as $client)
        {
            $content .= "<tr><td>".$i."</td><td>".$client->date."</td><td class='text-center'>".$client->Code_client."</td><td ><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++;
        }

        echo "<table class='table table-bordered table1'><thead style='background:#C5CAE9'><th>N°</th><th>Date</th><th class='text-center'>Code client</th><th class='text-center'>Nom client</th></thead><tbody>" . $content . "</tbody></table>";
    }

    public function listeclientsAAC7mois()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $content = "";
        $data = array();
        $i=1;
        $client = $this->accueil_model->cleintSAC07_mois($matricule, date($mo[$parametre]));
        foreach($client as $client)
        {
            $content .= "<tr><td>".$i."</td><td>".$client->date."</td><td class='text-center'>".$client->Code_client."</td><td ><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++;
        }

        echo "<table class='table table-bordered table1'><thead style='background:#C5CAE9'><th>N°</th><th>Date</th><th class='text-center'>Code client</th><th class='text-center'>Nom client</th></thead><tbody>" . $content . "</tbody></table>";
    }

    public function like_detail()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $content = "";
        $contents = "";
        $i=1;
        $a=1;
        $data = array();
        $TestCont = array();
        $lien =array();
        $client = $this->accueil_model->liste_clientAAC7($matricule);
        foreach($client as $client)        {
            
            $TestCont[$i]= $client->lien_facebook;

            $content .= "<tr><td>".$i."</td><td  class='text-center'>".$client->Code_client."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++;
        }   

        $clients = $this->accueil_model->PROP_CLT_AAC07($date,$matricule);
        foreach($clients as $clients)
        {
            if(in_array($clients->lien_facebook,$TestCont)){
                $statut = "<i class='fa fa-check-circle text-success'></i>"; 
            }else{
                $statut = "<i class='fa fa-warning text-danger'></i>";
            } 
            
                $contents .= "<tr><td>".$a."</td><td  class='text-center'>".$clients->Code_client."</td><td><a href='" .$clients->lien_facebook. "' target='_blank'>" . $clients->Compte_facebook . "</a></td><td class='text-center'>".$statut."</td></tr>"; 
                $a++;
        } 
     

           
        $data=[
            'data'=>$content,
            'date'=>$date,
            'donnees' =>$contents
           
        ];
        
        $this->load->view('performance/like_detail', $data);
        
    }
    public function PROP_CLT_AAC14()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $content = "";
        $contents = "";
        $a=1;
        $i=1;
        $data = array();
       /* $clients = $this->accueil_model->liste_clientAAC14($matricule);
        foreach ($clients as $clients) {
            
        }

        $client = $this->accueil_model->PROP_CLT_AAC14($date, $matricule);
        foreach($client as $client)
        {
            $content .= "<tr><td>".$i."</td><td>".$client->heure."</td><td  class='text-center'>".$client->Code_client."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++;
        }*/

        $TestCont = array();
        $clients = $this->accueil_model->PROP_CLT_AAC14($date,$matricule);
        foreach($clients as $clients)
        {
            $TestCont[$a]= $clients->lien_facebook; 
            $contents .= "<tr><td>".$a."</td><td>".$clients->heure."</td><td  class='text-center'>".$clients->Code_client."</td><td><a href='" .$clients->lien_facebook. "' target='_blank'>" . $clients->Compte_facebook . "</a></td></tr>"; 
            $a++;
        }

        $client = $this->accueil_model->liste_clientAAC14($matricule);
        foreach($client as $client)
        {
            if(in_array($client->lien_facebook,$TestCont)){
                $statut = "<i class='fa fa-check-circle text-success'></i>"; 
            }else{
                $statut = "<i class='fa fa-warning text-danger'></i>";
            }

            $content .= "<tr><td>".$i."</td><td  class='text-center'>".$client->Code_client."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td><td class='text-center'>".$statut."</td></tr>"; 
            $i++;
        }

        $data=[
            'data'=>$content,
            'donnees'=>$contents,
            'date'=> $date
        ];
        $this->load->view('performance/like_detail_aac14', $data);

    }


      
        public function countappel()
        {
            $this->load->model('accueil_model');
            $matricule = $this->input->post('matricule');
            $date = $this->input->post('date');
            $content = "";
            $contents = "";
            $i=1;  
            $a=1;

            $TestContS = array();
            $clients = $this->accueil_model->appel_vente($date,$matricule);
            foreach($clients as $clients)
            {
                $TestContS[$a]= $clients->lien_facebook; 
                $content .= "<tr><td>".$a."</td><td  class='text-center'>".$clients->client."</td><td><a href='" .$clients->lien_facebook. "' target='_blank'>" . $clients->Compte_facebook . "</a></td></tr>"; 
                $a++;
            }
    



            $client = $this->accueil_model->appel($date,$matricule);
            foreach($client as $client)
            {

                if(in_array($client->lien_facebook,$TestContS)){
                    $statut = "<i class='fa fa-check-circle text-success'></i>"; 
                }else{
                    $statut = "<i class='fa fa-times-circle text-danger'></i>";
                }

                $client->types;
                if($client->types == "APP_CLT_ECHOUE"){
                    $contents .= "<tr><td>".$i."</td><td  class='text-center'><a href='#' class='code'>".$client->client."</a></td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td><td class='text-center'>ECHOUE </td></tr>"; 
                    $i++;
                }else{
                    $contents .= "<tr><td>".$i."</td><td  class='text-center'><a href='#' class='code'>".$client->client."</a></td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td><td class='text-center'>CONCLU ".$statut."</td></tr>"; 
                    $i++;
                }
    
               
            }        
        
            $data=[
                'date'=>$date,
                'donnees' =>$contents,
                'conclu' =>count($this->accueil_model->appelconclu($date,$matricule)),
                'echoue' =>count($this->accueil_model->appelechoue($date,$matricule))
                
            ];


            $this->load->view('performance/appel',$data);

        }

        public function detailappel( ){
        $this->load->model('accueil_model');
        $client = $this->input->post('codeclient');
        $facture = $this->accueil_model->stat($client);
        $arrayContent = array();
        $content = "";
        $i=1;
        $ca = 0;
        $produit = 0;
        $total = array();
        foreach ($facture as $facture) {
           
      
                $ca = $facture->Quantite * $facture->Prix_detail;
                $produit = $facture->Designation;
                //$totalCA+=$ca;
                $content .= "<tr><td>".$facture->Date."</td><td>".$facture->Nom_page."</td><td>".$facture->Code_produit."</td><td class='text-center' style='font-size:12px'>" . $produit . "</td><td class='text-center' style='font-size:12px'>".$facture->Quantite."</td><td style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</style></td></tr>";
                
            }
       
        $data=[
            'data'=>$content
        ];
            $this->load->view('performance/detail_appel',$data);
        }

        public function journalier()
    {
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $mois = date('Y-m');
        $dt = new dateTime();
        $dt->modify('+1day');
        $dat = $dt->format("Y-m-d");
        $content = "";
        $datas = $this->accueil_model->liste_oplg_en_fonction();
        $totalca = 0;
        $totalreel = 0;
        $totalp = 0;
        $totalcalivre =0;
        $totalpro = 0;
        $totalprod = 0;
        $totalconfirmer= 0;
        $totalsomme=0;
        $sommes=0;
        $totalratio=0;
        $totalnonlivre = 0;
        foreach ($datas as $key => $datas) {
            $ca = 0;
            $calivre = 0;
            $produit = 0;
            $confirm =0;
            $prod = 0;
            $pro = 0;
            $ratio = 0;
            $calivrejour  =0;
            $canonlivre =0;
            $cajour=0;
            $previlivre=0;
            $facture = $this->accueil_model->chiffre_d_affaires($date, $datas->Matricule);
            $fact = $this->accueil_model->chiffre_d_affaires_reel_non_livre($date, $datas->Matricule);
            $facts = $this->accueil_model->livraison_previ_du_jour($datas->Matricule);
            $factu = $this->accueil_model->chiffre_d_affaires_livre($date, $datas->Matricule);
            $confirmer = $this->accueil_model->chiffre_d_affaires_confirme($datas->Matricule,$dat);
            $livrereel = $this->accueil_model->chiffre_d_affaires_reel_du_jour($date,$datas->Matricule);            
            $totalcaj = $this->accueil_model->totalchiffre_d_affaires($date);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
                $produit += $facture->Quantite;
            }
            foreach ($facts as $facts) {
                $previlivre += ($facts->Quantite * $facts->Prix_detail);
                $produit += $facts->Quantite;
            }           
            foreach ($totalcaj as $totalcaj) {
                $cajour += ($totalcaj->Quantite * $totalcaj->Prix_detail);
                $produit += $totalcaj->Quantite;
            }
            foreach ($livrereel as $livrereel) {
                $calivrejour += ($livrereel->Quantite * $livrereel->Prix_detail);
            }
            foreach ($fact as $fact) {
                $canonlivre += ($fact->Quantite * $fact->Prix_detail);
                }
            foreach ($factu as $factu) {
                $calivre += ($factu->Quantite * $factu->Prix_detail);               
            }
            foreach ($confirmer as $confirmer) {
                $confirm += ($confirmer->Quantite * $confirmer->Prix_detail);           
            }
            
            
            if ($calivre != 0 and $previlivre != 0) {
                $ratio =  ($calivre *100 )/($previlivre );
            } else {
                $ratio = 0;
            }

            
            $data = array();
            $totalca += $ca;
            $totalcalivre += $calivre;
            $totalnonlivre += $canonlivre;
            $totalp += $produit;
            $totalpro += $prod;
            $totalprod += $pro;
            $totalconfirmer+= $confirm;
            $totalsomme+= $previlivre;
            $sommes+= $calivrejour;

            
            $content .= "<tr><td class='collapse'>". $datas->Matricule. "</td><td style='font-size:12px' class='col_1'><a href='#' class='nompage'>" . $datas->Matricule. "</a></td><td class='text-center' style='font-size:12px'>" . $datas->Prenom. "</td><td class='text-center' style='font-size:12px'><a href='' class='ca'>" . number_format($ca, 0, ',', ' ') . "</a></td><td class='text-center' style='font-size:12px'><a href='' class='car'>" . number_format($calivre, 0, ',', ' ') . "</a></td><td class='text-center' style='font-size:12px'><a href='' class='reel'>" . number_format($canonlivre, 0, ',', ' ') . "</a></td><td class='text-center' style='font-size:12px'><a href='#' class='calivrejour'>".number_format($calivrejour, 0, ',', ' ')."</a></td><td class='text-center' style='font-size:12px'><a href='#' class='previlivre'>".number_format($previlivre, 0, ',', ' ')."</a></td><td class='text-center' style='font-size:12px'><a href='#' class='confirmer'>".number_format($confirm, 0, ',', ' ')."</a></td><td class='text-center'>" . number_format($ratio, 2, ',', ' ') . "</td></tr>";
            
        }
        $data = ['data' => $content,'totalcalivre'=>$totalcalivre,'cajour'=>$cajour,'totalratio'=>$totalratio,'sommes'=>$sommes,'totalsomme'=>$totalsomme,'totalconfirmer'=>$totalconfirmer, 'totalp' => $totalp, 'totalpro' => $totalpro, 'totalprod' => $totalprod, 'date' => $date, 'totalca' => $totalca, 'totalnonlivre' => $totalnonlivre, 'totalreel' => $totalreel];

        $this->render_view('performance/accueil', $data);
    }

    public function prime()
    {
        $mois=date('Y-m');
        $content="";
        $result=$this->accueil_model->liste_oplg_en_fonction(date('Y-m-d'));
        foreach($result as $key=>$result)        {
            $data=array();        
            $value =100;
            $prime = $this->accueil_model->prime($result->Matricule,$mois);
            if($prime->nombre == ""){
                $content.="<tr><td>".$result->Matricule."</td><td>".strtoupper(substr($result->Prenom, 0, 22))."</td><td class='text-center'>0</td><td class='text-center'>0</td></tr>";
            }else{
                $content.="<tr><td>".$result->Matricule."</td><td>".strtoupper(substr($result->Prenom, 0, 22))."</td><td class='text-center'>".number_format(($prime->nombre * $value), 0, ',', ' ')."</td><td class='text-center'><a href='#' class='prime'>".$prime->nombre."</a></td></tr>";
            }            

        }
        $data=[
            'data'=>$content
        ];
         $this->render_view('prime/prime',$data);
    }

    public function detailproduit()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $mois =date('Y-m');
        $content = "";
        $data = array();
        $value = $this->accueil_model->produit_prime($matricule, $mois);
        foreach($value as $value)
        {
            $content .= "<tr><td style='font-size:10px'>".$value->Code_produit."</td><td  class='text-center' style='font-size:10px'>".$value->nombre."</td><td style='font-size:10px'>".$value->Designation."</td></tr>"; 
       
        }
        echo "<table class='table table-bordered table1 table-striped'><thead class='bg-secondary'><th style='font-size:10px' class='text-center text-white '>CODE_PRODUIT</th><th style='font-size:10px' class='text-center text-white'>QUANTITE</th><th style='font-size:10px' class='text-center text-white'>PRODUIT</th></thead><tbody>" . $content . "</tbody></table>";
    }   

      public function printdataPrime()
    {
    $mois=date('Y-m');
    $date = date('Y-m-d');
    $prime = 0;
    $excel = "PRIME DU : $mois\n\n";

    $excel .= "MATRICULE\tPRENOM OPLG\tPRIME\tNBR PORDUIT\n";
    $datas=$this->accueil_model->liste_oplg_en_fonction(date('Y-m-d'));
    $data = array();
    foreach ($datas as $row) {
        $result = $this->accueil_model->prime($row->Matricule,$mois);
        $prime = $result->nombre * 100;
        if($result->nombre == ""){
                  $excel .= "$row->Matricule\t".strtoupper($row->Prenom)."\t0\t0\n";
            }else{
                 $excel .= "$row->Matricule\t".strtoupper($row->Prenom)."\t$prime\t$result->nombre\n";
            }     

    }

        header("Content-type: application/vnd.ms-excel");
        header("Content-disposition: attachment; filename=Prime du : " . $mois . ".xls");
        print $excel;
        exit;
    } 

    public function discussionJournaliere()
    {
     // $data = [
     //        "oplg"=>$this->accueil_model->listeoperatrice(date('Y-m')),      
     //    ];
        $this->render_view('performance/discussionJournaliere');
    }

    public function discussionJournalieres()
    {
    $this->load->model('accueil_model');
    //$matricule = $this->input->post('matricule');
	$date = date('Y-m-d');

	$methodOk = isset($_GET['date']) && !empty($_GET['date']);
	if($methodOk){
		$date = $_GET['date']; 
	}
	$dt = new DateTime($date);
	$mois = $dt->format('Y-m');
	$date_jour = $mois."-01";
    $content = "";
    $data = array();
    $result = $this->accueil_model->oplgList();
    foreach($result as $row){   
         $page = $this->accueil_model->codification_page($row->Matricule);
            if ($page) {
              $page_name = $page->Code_page;
            } else {
              $page_name = "";
            }
    $sub_array= array();
        $sub_array[] = substr($row->Matricule, 0, 7);
        $sub_array[] = $row->Prenom;
        $sub_array[] = "<a href='#' class='nompage'>".$page_name."</a>";
        $sub_array[] = $this->accueil_model->countAncienClient($row->Matricule, $date_jour,$date)+$this->accueil_model->countNvxClient($row->Matricule,$mois,$date);
        $sub_array[] = $this->accueil_model->countAncienClient($row->Matricule, $date_jour,$date);
        $sub_array[] = $this->accueil_model->countNvxClient($row->Matricule,$mois,$date);
        //$sub_array[] = $this->accueil_model->countAncienClient($row->Matricule_personnel)+$this->accueil_model->countNvxClient($row->Matricule_personnel);
        //$sub_array[] = $this->accueil_model->countAncienClient($row->Matricule_personnel);
        //$sub_array[] = $this->accueil_model->countNvxClient($row->Matricule_personnel);
        $data[] = $sub_array;
        }
        $output = array(
        "data" => $data
    );
    echo json_encode($output);
    }

    public function discussionParMatricule()
    {
     // $data = [
     //        "oplg"=>$this->accueil_model->listeoperatrice(date('Y-m')),      
     //    ];
        $this->render_view('performance/discussionParMatricule');
    }

    public function discussionParMatricuL()
    {
    $this->load->model('accueil_model');
    //$matricule = $this->input->post('matricule');
    $date = date('Y-m-d');
    $methodOk = isset($_GET['date']) && !empty($_GET['date']);
	if($methodOk){
		$date = $_GET['date']; 
	}
	$dt = new DateTime($date);
	$mois = $dt->format('Y-m');
	$date_jour = $mois."-01";
    $content = "";
    $data = array();
    $page = $this->accueil_model->oplgListgroupe();

    foreach($page as $row){   
    $sub_array= array();
        $sub_array[] = substr($row->Matricule, 2 , 5);
        $sub_array[] = $row->Prenom;
        $sub_array[] = $this->accueil_model->countAncienClient(substr($row->Matricule, 2 , 5),$date_jour,$date) + $this->accueil_model->countNvxClient(substr($row->Matricule, 2 , 5),$mois,$date);
        $sub_array[] = $this->accueil_model->countAncienClient(substr($row->Matricule, 2 , 5),$date_jour,$date);
        $sub_array[] = $this->accueil_model->countNvxClient(substr($row->Matricule, 2 , 5),$mois,$date);
        $data[] = $sub_array;
        }
        $output = array(
        "data" => $data
    );
    echo json_encode($output);
    }

    public function EtatDiscussion()
    {
         
        $data=[
            'oplg'=>$this->accueil_model->listeoperatrice(date('Y-m')),
            'date'=>$this->accueil_model->listeJour(),
        ];
        $this->render_view('performance/EtatDiscussion',$data);
    }

     public function etatNouveauxClt()
    {
        $data=[
            'result'=>$this->accueil_model->totalNvxClient(date('Y-m'))
        ];
        $this->render_view('performance/nouveaux',$data);
    }

    public function etatAncienClt()
    {
        $data=[
            'result'=>$this->accueil_model->totalAncienClient(date('Y-m-01'))
        ];
        $this->render_view('performance/etatAncienClt',$data);
    }

    public function etatNouveauxCltBody()
    {
    $this->load->model('accueil_model');
    //$matricule = $this->input->post('matricule');
    $content = "";
    $data = array();
    $date = date('Y-m-d');

	$methodOk = isset($_GET['date']) && !empty($_GET['date']);
	if($methodOk){
		$date = $_GET['date']; 
	}
    $result = $this->accueil_model->oplgList();
    foreach($result as $row){   
         $page = $this->accueil_model->codification_page($row->Matricule);
            if ($page) {
              $page_name = $page->Code_page;
            } else {
              $page_name = "";
            }

        $param=["date"=>$date,"personnel"=>$row->Matricule];
        $sub_array= array();
        $sub_array[] = substr($row->Matricule, 0, 7);
        $sub_array[] = $row->Prenom;
        $sub_array[] = "<a href='#' class='nompage' >".$page_name."</a>";
        $sub_array[] = "<a href='#' class='client' data-toggle='modal' data-target='#exampleModalCenter'>".count($this->accueil_model->get_nouveau_contact($param))."</a>";
        $data[] = $sub_array;
        }
        $output = array(
        "data" => $data
    );
    echo json_encode($output);
    }

    public function etatAncienCltBody()
    {
    $this->load->model('accueil_model');
    //$matricule = $this->input->post('matricule');
    $content = "";
    $data = array();
    $result = $this->accueil_model->oplgList();
    foreach($result as $row){   
         $page = $this->accueil_model->codification_page($row->Matricule);
            if ($page) {
              $page_name = $page->Code_page;
            } else {
              $page_name = "";
            }
    $sub_array= array();
        $sub_array[] = substr($row->Matricule, 0, 7);
        $sub_array[] = $row->Prenom."";
        $sub_array[] = "<a href='#' class='nompage'>".$page_name."</a>";
        $sub_array[] = "<a href='#' class='client' data-toggle='modal' data-target='#exampleModalCenter'>".$this->accueil_model->countAncienClient($row->Matricule, date('Y-m-01'))."</a>";
        $data[] = $sub_array;
        }
        $output = array(
        "data" => $data
    );
    echo json_encode($output);
    }

    //  public function listeNouveauxclients()
    // {
    //     $this->load->model('accueil_model');
    //     $matricule = $this->input->post('Matricule_personnel');
    //     $content = "";
    //     $data = array();
    //     $i=1;
    //     $client = $this->accueil_model->ListeNvxClients($matricule, date('Y-m'));
    //     foreach($client as $client)
    //     {
    //         $content .= "<tr><td>".$i."</td><td class='text-left'>".$client->client."</td><td class='text-left'><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
    //     $i++;
    //     }

    //     echo "<table class='table table-bordered table1'><thead style='background:#C5CAE9'><th></h><th class='text-center'>Code client</th><th class='text-center'>Nom client</th></thead><tbody>" . $content . "</tbody></table>";
    // }

    public function listeNouveauxclients()
    {
    $this->load->model('accueil_model');
    //$matricule = $this->input->post('Matricule_personnel');
    $content = "";
    $data = array();
    $date = $this->input->get('date');
    if($date ==""){
    	$date = date('Y-m-d');
    }
    $client = $this->accueil_model->get_nouveau_contact(["personnel"=>$this->input->get('Matricule_personnel'),"date"=>$date]);
    foreach($client as $row){ 
    $i=1;  
         $sub_array= array();
        $sub_array[] = $row->code_client;
        $client_detail = $this->accueil_model->select_client(["Code_client"=>$row->code_client]);
        $sub_array[] = "<a href='" .$client_detail->lien_facebook. "' target='_blank'>" . $client_detail->Compte_facebook . "</a>";
        $data[] = $sub_array;
       
        }
        $output = array(
        "data" => $data
    );
    echo json_encode($output);
    }

    public function listeAnciensclients()
    {
    $this->load->model('accueil_model');
    //$matricule = $this->input->post('Matricule_personnel');
    $content = "";
    $data = array();

    $client = $this->accueil_model->ListeAncienClient($this->input->get('Matricule_personnel'), date('Y-m-01'));
    foreach($client as $row){ 
    $i=1;  
    $sub_array= array();
        $sub_array[] = $row->client;
        $sub_array[] = "<a href='" .$row->lien_facebook. "' target='_blank'>" . $row->Compte_facebook . "</a>";
        $data[] = $sub_array;
       
        }
        $output = array(
        "data" => $data
    );
    echo json_encode($output);
    }

    public function etatParPage(){
        $date = date('Y-m-d');
        $methodOk = isset($_GET['date']) && !empty($_GET['date']);
        if($methodOk){
            $date = $_GET['date']; 
        }
        $dt = new DateTime($date);
        $mois = $dt->format('Y-m');
        $date_jour = $mois."-01";
        $data=[
            'page'=>$client = $this->accueil_model->listePage(),
            'mois' => $dt->format('Y-m'),
            'date_jour' => $mois."-01",
            'date'=>$date
        ];
        $this->render_view('performance/etatParPage',$data);
    }
}
