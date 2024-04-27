<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nouveaux extends My_Controller
{

    public function index()
    {
    }
    public function journalier()
    {
        $this->load->model('accueil_model');
        $date = $this->input->post('date');
        if (empty($date)) {
			$date = date('Y-m-d');
		}
        $mois=date('Y-m');
        $content="";     
        $datas = $this->accueil_model->opl_nv($mois);
            foreach ($datas as $datas) {
            $countnvclts = 0;
            $countnvcltac =0;
            $ratioac =0;
            $countSAC =0; 
            $nvclts=$this->accueil_model->liste_clients($date, $datas->Matricule);
            $nvcltac=$this->accueil_model->nouveaux_clients_AC($date, $datas->Matricule);
            $nvcltsac=$this->accueil_model->nouveaux_clients_SAC($date, $datas->Matricule);
            $countnvclts = count($nvclts);
            $countnvcltac = count($nvcltac); 
            $countSAC = $countnvclts - $countnvcltac;   
                        
            if($countnvclts != 0 and $countnvcltac !=0 or  $countSAC != 0 ){
                $content.="<tr><td>".$datas->Matricule."</td><td>".$datas->Prenom."</td><td class='text-center'><a href='#' class='countnvclts'>".$countnvclts."</a></td><td class='text-center'><a href='#' class='countnvcltac'>".$countnvcltac."</a></td><td class='text-center'>".number_format(($countnvcltac *100) /($countnvclts), 2, ',', ' ')."&nbsp  %</td><td class='text-center'>".$countSAC."</td><td class='text-center'>".number_format(($countSAC *100) /($countnvclts), 2, ',', ' ')." &nbsp %</td></tr>";
            }else{
                $content.="<tr><td>".$datas->Matricule."</td><td>".$datas->Prenom."</td><td class='text-center'><a href='#' class='countnvclts'>".$countnvclts."</a></td><td class='text-center'><a href='#' class='countnvcltac'>".$countnvcltac."</a></td><td class='text-center'>0 &nbsp%</td><td class='text-center' class='text-center'>".$countSAC."</td><td class='text-center'>0 &nbsp %</td></tr>";
            }
            }

        $data=[
            'date'=>$date,
            'data'=>$content
        ];
        $this->render_view('nouveaux/journalier',$data);

    }

    public function jours_derniers()
    {
        $this->load->model('accueil_model');
        $date = $this->input->post('date');
        if (empty($date)) {
			$date = date('Y-m-d');
		}
        $mois=date('Y-m');
        $content="";     
        $datas = $this->accueil_model->opl_nv($mois);
            foreach ($datas as $datas) {
            $countnvclts = 0;
            $countnvcltac =0;
            $countSAC =0; 
            $nvclts=$this->accueil_model->liste_clients_derniers($datas->Matricule);
            $nvcltac=$this->accueil_model->nouveaux_clients_30AC($datas->Matricule);
            $countnvclts = count($nvclts);
            $countnvcltac = count($nvcltac); 
            $countSAC = $countnvclts - $countnvcltac;                           
            if($countnvclts != 0 and $countnvcltac !=0 or  $countSAC != 0 ){
                $content.="<tr><td>".$datas->Matricule."</td><td>".$datas->Prenom."</td><td class='text-center'><a href='#' class='countnvcltss'>".$countnvclts."</a></td><td class='text-center'><a href='#' class='countnvcltac'>".$countnvcltac."</a></td><td class='text-center'>".number_format(($countnvcltac *100) /($countnvclts), 2, ',', ' ')."&nbsp  %</td><td class='text-center'>".$countSAC."</td><td class='text-center'>".number_format(($countSAC *100) /($countnvclts), 2, ',', ' ')." &nbsp %</td></tr>";
            }else{
                $content.="<tr><td>".$datas->Matricule."</td><td>".$datas->Prenom."</td><td class='text-center'><a href='#' class='countnvcltss'>".$countnvclts."</a></td><td class='text-center'><a href='#' class='countnvcltac'>".$countnvcltac."</a></td><td class='text-center'>0 &nbsp%</td><td class='text-center' class='text-center'>".$countSAC."</td><td class='text-center'>0 &nbsp %</td></tr>";
            }
            }

        $data=[
            'date'=>$date,
            'data'=>$content
        ];
        $this->render_view('nouveaux/jours_derniers',$data);

    }

    public function mensuel()
    {
        $data = [
            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre")];
        $this->render_view('nouveaux/mensuel',$data);

    }

    public function listeclients()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $client = $this->input->post('codeclient');
        $date = $this->input->post('date');
        $content = "";       
        $i=1;       
        $data = array();
        $client = $this->accueil_model->liste_clients($date,$matricule);
        foreach($client as $client) {    
            $content .= "<tr><td>".$i."</td><td  class='text-center'>".$client->Code_client."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++; 
        } 
        $data=[
            'data'=>$content,
            'date'=>$date
        ];
        
        $this->load->view('nouveaux/liste_clients', $data);
        
    }

    public function listeclients30()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $content = "";       
        $i=1;       
        $data = array();
        $client = $this->accueil_model->liste_clients_derniers($matricule);
        foreach($client as $client) {    
            $content .= "<tr><td>".$i."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++; 
        } 
        $data=[
            'data'=>$content,
            'date'=>$date
        ];
        
        $this->load->view('nouveaux/liste_clients', $data);
        
    }

    public function listeclientsmensuels()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $client = $this->input->post('codeclient');
        $date = $this->input->post('date');
        $mois=date('Y-m');
        $content = "";       
        $i=1;       
        $data = array();
        $client = $this->accueil_model->liste_clients_mois($mois,$matricule);
        foreach($client as $client) {    
            $content .= "<tr><td>".$i."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td></tr>"; 
            $i++; 
        } 
        $data=[
            'data'=>$content,
            'date'=>$date
        ];
        
        $this->load->view('nouveaux/liste_clients', $data);
        
    }

    public function listeclientsAAC()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $client = $this->input->post('codeclient');
        $date = $this->input->post('date');
        $content = "";       
        $i=1;       
        $data = array();
        $client = $this->accueil_model->nouveaux_clients_AC($date,$matricule);
        foreach($client as $client) {    
            $CA =0;    
            $produit =0;  
            $facture = $this->accueil_model->stat($client->Code_client);
            foreach($facture as $facture){
                $CA += ($facture->Quantite * $facture->Prix_detail);
                $produit += $facture->Quantite;	
            }
            $content .= "<tr><td class='collapse'>".$client->Code_client."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td><td class='text-center'><a href='#' class='produit'>".$produit."</a></td><td class='text-center'>".number_format($CA, 0, ',', ' ')."</td></tr>"; 
            $i++; 
        } 
        $data=[
            'data'=>$content,
            'date'=>$date
        ];
        
        $this->load->view('nouveaux/detail_liste', $data);
        
    }

    public function listeclientsAACmois()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $client = $this->input->post('codeclient');
        $date = $this->input->post('date');
        $mois =date('Y-m');
        $content = "";       
        $i=1;       
        $data = array();
        $client = $this->accueil_model->nouveaux_clients_AC_mois($mois,$matricule);
        foreach($client as $client) {    
            $CA =0;    
            $produit =0;  
            $facture = $this->accueil_model->stat($client->Code_client);
            foreach($facture as $facture){
                $CA += ($facture->Quantite * $facture->Prix_detail);
                $produit += $facture->Quantite;	
            }
            $content .= "<tr><td class='collapse'>".$client->Code_client."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td><td class='text-center'><a href='#' class='produit'>".$produit."</a></td><td class='text-center'>".number_format($CA, 0, ',', ' ')."</td></tr>"; 
            $i++; 
        } 
        $data=[
            'data'=>$content,
            'date'=>$date
        ];
        
        $this->load->view('nouveaux/detail_liste', $data);
        
    }


    public function months()
    {
        $mois = date('Y-m');
        $datas = $this->accueil_model->opl_liste($mois);
        foreach ($datas as $row) {
            $ratioac =0;
            $nbrclientsSAC=0;
            if(count($this->accueil_model->liste_clients_mois( $mois,$row->Matricule_personnel)) !=0 and count($this->accueil_model->nouveaux_clients_AC_mois( $mois,$row->Matricule_personnel)) !=0)
            {
                $ratioac = (count($this->accueil_model->nouveaux_clients_AC_mois( $mois,$row->Matricule_personnel)) * 100 )/(count($this->accueil_model->liste_clients_mois( $mois,$row->Matricule_personnel)));
            }else{
                $ratioac =0;
            }
            $nbrclientsSAC = count($this->accueil_model->liste_clients_mois( $mois,$row->Matricule_personnel)) - count($this->accueil_model->nouveaux_clients_AC_mois( $mois,$row->Matricule_personnel));
            
            if ($nbrclientsSAC !=0 and count($this->accueil_model->liste_clients_mois( $mois,$row->Matricule_personnel)) !=0 ){
                $ratiosc =($nbrclientsSAC *100)/count($this->accueil_model->liste_clients_mois( $mois,$row->Matricule_personnel));
            }else{
                $ratiosc =0;
            }

            $sub_array = array();
            $sub_array[] = $row->Matricule_personnel;  
            $sub_array[] =  $row->Prenom;
            $sub_array[] = "<td><a href='#' class='listemois'>".count($this->accueil_model->liste_clients_mois( $mois,$row->Matricule_personnel))."</a></td>";
            $sub_array[] = "<td><a href='#' class='listecamois'>".count($this->accueil_model->nouveaux_clients_AC_mois( $mois,$row->Matricule_personnel))."</a></td>";
            $sub_array[] = number_format($ratioac, 2, ',', ' ') ;
            $sub_array[] = $nbrclientsSAC;
            $sub_array[] = number_format($ratiosc, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function mois($s2=false)
    {
        $moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $dateD = date($moi[$s2]);
        $mois = $moi[$s2];     
        $result=$this->accueil_model->opl_liste($dateD);
        foreach($result as $row)
        {

            $ratiosc =0;
            $nbrclientsSAC=0;
            if(count($this->accueil_model->liste_clients_mois( $dateD,$row->Matricule_personnel)) !=0 and count($this->accueil_model->nouveaux_clients_AC_mois( $dateD,$row->Matricule_personnel)) !=0)
            {
                $ratioac = (count($this->accueil_model->nouveaux_clients_AC_mois( $dateD,$row->Matricule_personnel)) * 100 )/(count($this->accueil_model->liste_clients_mois( $dateD,$row->Matricule_personnel)));
            }else{
                $ratioac =0;
            }
            $nbrclientsSAC = count($this->accueil_model->liste_clients_mois( $dateD,$row->Matricule_personnel)) - count($this->accueil_model->nouveaux_clients_AC_mois( $dateD,$row->Matricule_personnel));
            
            if ($nbrclientsSAC !=0 and count($this->accueil_model->liste_clients_mois( $dateD,$row->Matricule_personnel)) !=0 ){
                $ratiosc =($nbrclientsSAC *100)/count($this->accueil_model->liste_clients_mois( $dateD,$row->Matricule_personnel));
            }else{
                $ratiosc =0;
            }
            $sub_array = array();            
            $sub_array[] = $row->Matricule_personnel;
            $sub_array[] = $row->Prenom;            
            $sub_array[] = "<td><a href='#' class='listemois'>".count($this->accueil_model->liste_clients_mois( $dateD,$row->Matricule_personnel))."</a></td>";
            $sub_array[] = "<td><a href='#' class='listecamois'>".count($this->accueil_model->nouveaux_clients_AC_mois( $dateD,$row->Matricule_personnel))."</a></td>";
            $sub_array[] = number_format($ratioac, 2, ',', ' ') ;;
            $sub_array[] = $nbrclientsSAC;
            $sub_array[] = number_format($ratiosc, 2, ',', ' ');

            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function listeproduits()
    {
        $this->load->model('accueil_model');
        $client = $this->input->post('codeclient');
        $date = $this->input->post('date');
        $content = "";       
        $data = array();
        $facture = $this->accueil_model->stat($client);
        foreach($facture as $facture){
            $content .= "<tr><td>" .$facture->Code_produit. "</td><td>".$facture->Designation . "</td></tr>"; 
        } 
        $data=[
            'data'=>$content,
            'date'=>$date
            ];        
        $this->load->view('nouveaux/liste_produit', $data);        
    }
    public function premier_achat()
    {  
        if (empty($date)) {
        $date = date('Y-m-d');
        }
        $data = array();
        $mois =date('Y-m');
       
        $dt = new dateTime();
        
        $dt ->modify('+7day');
        $dat7 = $dt->format("Y-m-d");
        $dt->modify('+14day');
        $dat14 = $dt->format("Y-m-d");
        $dt->modify('+28day');
        $dat28 = $dt->format("Y-m-d");
        $dt->modify('+42day');
        $dat42 = $dt->format("Y-m-d");
        $dt->modify('+43day');
        $dat43 = $dt->format("Y-m-d"); 
       
        $matricule = $this->input->post('matricule');  
        $date = $this->input->post('date');  
       

        $content="";     
        $datas = $this->accueil_model->opl_nv($mois);
            foreach ($datas as $datas) {
                $client7 =$this->accueil_model->premier_achat7($datas->Matricule,$date);
                $client14 =$this->accueil_model->premier_achat14($datas->Matricule,$date);
                $client28 =$this->accueil_model->premier_achat28($datas->Matricule,$date);
                $client42 =$this->accueil_model->premier_achat42($datas->Matricule,$date);
                $client43 =$this->accueil_model->premier_achat49($datas->Matricule,$date);
                $content.="<tr><td>".$datas->Matricule."</td><td class='text-center'><a href='#' class='client7'>".count($client7)."</a></td><td class='text-center'><a href='#' class='client14'>".count($client14)."</a></td><td class='text-center'><a href='#' class='client28'>".count($client28)."</a></td><td class='text-center'><a href='#' class='client42'>".count($client42)."</a></td><td class='text-center'><a href='#' class='client43'>".count($client43)."</a></td></tr>";
            }

        $data=[
            'date'=>$date,
            'data'=>$content
        ];
        $this->render_view('nouveaux/premier_achat',$data);
    }

    public function listeclientsAAC30()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $client = $this->input->post('codeclient');
        $date = $this->input->post('date');
        $content = "";       
        $i=1;       
        $data = array();
        $client = $this->accueil_model->nouveaux_clients_30AC($matricule);
        foreach($client as $client) {    
            $CA =0;    
            $produit =0;  
            $facture = $this->accueil_model->stat($client->Code_client);
            foreach($facture as $facture){
                $CA += ($facture->Quantite * $facture->Prix_detail);
                $produit += $facture->Quantite;	
            }
            $content .= "<tr><td class='collapse'>".$client->Code_client."</td><td><a href='" .$client->lien_facebook. "' target='_blank'>" . $client->Compte_facebook . "</a></td><td class='text-center'><a href='#' class='produit'>".$produit."</a></td><td class='text-center'>".number_format($CA, 0, ',', ' ')."</td></tr>"; 
            $i++; 
        } 
        $data=[
            'data'=>$content,
            'date'=>$date
        ];
        
        $this->load->view('nouveaux/detail_clients', $data);
        
    }
    public function liste_premier_achat()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $dt7 = new dateTime( $date);          
        $dt7 ->modify('+7day'); 
        $date = $dt7->format("Y-m-d");
        $date = $this->input->post('date');
        $content = "";       
        $data = array();
        $client7 = $this->accueil_model->premier_achat7($matricule,$date);
        foreach($client7 as $client7){
            $content .= "<tr><td>".$client7->Code_client. "</td><td>".$client7->Compte_facebook . "</td></tr>"; 
        } 
        $data=[
            'data'=>$content,
            'date'=>$date
            ];      
        $this->load->view('nouveaux/liste_premier_achat', $data);        
    }

    public function liste_premier_achat14()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $dt7 = new dateTime( $date);          
        $dt7 ->modify('+7day'); 
        $date = $dt7->format("Y-m-d");
        $date = $this->input->post('date');
        $content = "";       
        $data = array();
        $client7 = $this->accueil_model->premier_achat14($matricule,$date);
        foreach($client7 as $client7){
            $content .= "<tr><td>".$client7->Code_client. "</td><td>".$client7->Compte_facebook . "</td></tr>"; 
        } 
        $data=[
            'data'=>$content,
            'date'=>$date
            ];      
        $this->load->view('nouveaux/liste_premier_achat', $data);        
    }

    public function liste_premier_achat28()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $dt7 = new dateTime( $date);          
        $dt7 ->modify('+7day'); 
        $date = $dt7->format("Y-m-d");
        $date = $this->input->post('date');
        $content = "";       
        $data = array();
        $client7 = $this->accueil_model->premier_achat28($matricule,$date);
        foreach($client7 as $client7){
            $content .= "<tr><td>".$client7->Code_client. "</td><td>".$client7->Compte_facebook . "</td></tr>"; 
        } 
        $data=[
            'data'=>$content,
            'date'=>$date
            ];      
        $this->load->view('nouveaux/liste_premier_achat', $data);        
    }

    public function liste_premier_achat42()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $dt7 = new dateTime( $date);          
        $dt7 ->modify('+7day'); 
        $date = $dt7->format("Y-m-d");
        $date = $this->input->post('date');
        $content = "";       
        $data = array();
        $client7 = $this->accueil_model->premier_achat42($matricule,$date);
        foreach($client7 as $client7){
            $content .= "<tr><td>".$client7->Code_client. "</td><td>".$client7->Compte_facebook . "</td></tr>"; 
        } 
        $data=[
            'data'=>$content,
            'date'=>$date
            ];      
        $this->load->view('nouveaux/liste_premier_achat', $data);        
    }


    public function liste_premier_achat43()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $dt7 = new dateTime( $date);          
        $dt7 ->modify('+7day'); 
        $date = $dt7->format("Y-m-d");
        $date = $this->input->post('date');
        $content = "";       
        $data = array();
        $client7 = $this->accueil_model->premier_achat49($matricule,$date);
        foreach($client7 as $client7){
            $content .= "<tr><td>".$client7->Code_client. "</td><td>".$client7->Compte_facebook . "</td></tr>"; 
        } 
        $data=[
            'data'=>$content,
            'date'=>$date
            ];      
        $this->load->view('nouveaux/liste_premier_achat', $data);        
    }
    
}
