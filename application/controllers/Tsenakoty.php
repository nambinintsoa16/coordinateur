<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tsenakoty extends My_Controller {

	public function __construct()
    {
      parent::__construct();
      date_default_timezone_set('Europe/Moscow');
      $this->load->helper('url');
      $this->load->library("pagination");
      $this->load->model('tsenakoty_model');
    }

	public function index()
	{
		//$this->render_view('welcome_message');
	}


	public function etat_tsenakoty(){

		$data = [

            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
		$this->render_view('tsenakoty/etat_tsenakoty',$data);
	}

	public function mois_actuel(){
        $mois = date('Y-m');
        $i=1;
        $datas = $this->tsenakoty_model->liste_client_facture_tsena_koty($mois);
        foreach ($datas as $row) { 
            $sub_array = array();
            $sub_array[] = $i++;
            $sub_array[] = $row->Compte_facebook;
            $sub_array[] = $row->Designation;
            $sub_array[] = $row->Status;
            $sub_array[] = $row->lieu_de_livraison;
            $sub_array[] = $row->data_de_livraison;
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function months($s2)
    {

        $moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('2021') . "-11", "Decembre_2021" => date('2021') . "-12");
        $dateD = date($moi[$s2]);
        $mois = $moi[$s2];
        $i = 1;
        $datas = $this->tsenakoty_model->liste_client_facture_tsena_koty($mois);
        foreach ($datas as $row) {   
            $sub_array = array();
            $sub_array[] = $i++;
            $sub_array[] = $row->Compte_facebook;
            $sub_array[] = $row->Designation;
            $sub_array[] = $row->Status;
            $sub_array[] = $row->lieu_de_livraison;
            $sub_array[] = $row->data_de_livraison;
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function goodies(){
        $data = [

            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
        $this->render_view('tsenakoty/goodiesView',$data);
    }

    public function listeproduitGoodies(){
        /*$moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('2021') . "-11", "Decembre_2021" => date('2021') . "-12");
        $dateD = date($moi[$s2]);
        $mois = $moi[$s2];*/
        $mois = date('Y-m');
        $datas = $this->tsenakoty_model->listeOplg($mois);
        foreach ($datas as $row) { 
            $sub_array = array();
            $sub_array[] = substr($row->Ress_sec_oplg, 0, 7);
            $sub_array[] = $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$mois,'PK-LES006') + $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$mois,'PK-BTY014') + $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$mois,'PK-FUM072') + $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$mois,'PK-LES0');
            $sub_array[] = $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$mois,'PK-LES006');
            $sub_array[] = $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$mois,'PK-BTY014');
            $sub_array[] = $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$mois,'PK-FUM072');
            $sub_array[] = $this->tsenakoty_model->count_Produits($row->Ress_sec_oplg,$mois);
            $sub_array[] = $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$mois,'PTK011-98');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);


    }


    public function listeproduitGoodie($s2){
         $moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('2021') . "-11", "Decembre_2021" => date('2021') . "-12");
        $dateD = date($moi[$s2]);
        $mois = $moi[$s2];
        //$mois = date('Y-m');
        $data = array();
        $datas = $this->tsenakoty_model->listeOplg($dateD);
        foreach ($datas as $row) { 
            $sub_array = array();
            $sub_array[] = substr($row->Ress_sec_oplg, 0, 7);
            $sub_array[] = $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$dateD,'PK-LES006') + $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$dateD,'PK-BTY014') + $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$dateD,'PK-FUM072') + $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$dateD,'PK-LES0');
            $sub_array[] = $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$dateD,'PK-LES006');
            $sub_array[] = $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$dateD,'PK-BTY014');
            $sub_array[] = $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$dateD,'PK-FUM072');
            $sub_array[] = $this->tsenakoty_model->count_Produits($row->Ress_sec_oplg,$dateD);
            $sub_array[] = $this->tsenakoty_model->countProduits($row->Ress_sec_oplg,$dateD,'PTK011-98');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);


    }

    public function dataHeader()
    {
       $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('2021') . "-11", "Decembre" => date('2021') . "-12");
        $parametre = $this->input->post('mois');
        $mois = date('Y-m');     
       
        $data = [
            'pao' => $this->tsenakoty_model->countProduitsMensuels(date($mo[$parametre]),'PK-LES006'),
            'lipstick' => $this->tsenakoty_model->countProduitsMensuels(date($mo[$parametre]),'PK-BTY014'),
            'eversence' => $this->tsenakoty_model->countProduitsMensuels(date($mo[$parametre]),'PK-FUM072'),
            'bonsoir' => $this->tsenakoty_model->countProduitsMensuels(date($mo[$parametre]),'PTK011-98'),
            'fineline' => $this->tsenakoty_model->count_Produit(date($mo[$parametre])) 
        ];

        echo json_encode($data);
    }


    public function offre_promo(){

         $data = [

            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021"),
            "type" => $this->tsenakoty_model->offre_promotionnel()

        ];

        $this->render_view('tsenakoty/offrePromoView', $data);
    }

    public function listeClients()
    {
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        //$mois = date('Y-m');
        $data = [
            'liste'=>$this->tsenakoty_model->listeClients(date($mo[$parametre]),'PK-LES006')
        ];

    $this->load->view('tsenakoty/listeClient',$data);

    }

    public function listeClient()
    {
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        //$mois = date('Y-m');
        $data = [
            'liste'=>$this->tsenakoty_model->listeClients(date($mo[$parametre]),'PK-BTY014')
        ];

    $this->load->view('tsenakoty/listeClient',$data);

    }

    public function liste_Client()
    {
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        //$mois = date('Y-m');
        $data = [
            'liste'=>$this->tsenakoty_model->liste_Clients(date($mo[$parametre]))
        ];

    $this->load->view('tsenakoty/listeClient',$data);

    }
      public function liste_Clients()
    {

        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        //$mois = date('Y-m');
        $data = [
            'liste'=>$this->tsenakoty_model->listeClients(date($mo[$parametre]),'PK-FUM072')
        ];

    $this->load->view('tsenakoty/listeClient',$data);

    }

    public function client_list()
    {
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        //$mois = date('Y-m');
        $data = [
            'liste'=>$this->tsenakoty_model->listeClients(date($mo[$parametre]),'PTK011-98')
        ];

    $this->load->view('tsenakoty/listeClient',$data);

    }


        public function tablecapromotion(){
        /*$moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('2021') . "-11", "Decembre_2021" => date('2021') . "-12");
        $dateD = date($moi[$s2]);
        $mois = $moi[$s2];*/
        $mois = date('Y-m');
        $datas = $this->tsenakoty_model->listecommerciales($mois);
        foreach ($datas as $row) { 
            $sub_array = array();
            $sub_array[] = substr($row->Matricule_personnel, 0, 7);
            $sub_array[] = number_format($this->ca_previ(date('Y-m'), $row->Matricule_personnel), 0, ',', ' ');
            $sub_array[] = number_format($this->ca_reel(date('Y-m'), $row->Matricule_personnel), 0, ',', ' ');;
            $sub_array[] = number_format($this->ca_livre(date('Y-m'), $row->Matricule_personnel), 0, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);


    }

    public function ca_previ($mois, $Matricule)
    {
        $mois = date('Y-m');
        $ca = 0;
        $facture = $this->tsenakoty_model->ca_previ_par_oplg($mois, $Matricule);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        return $ca;
    }

    public function ca_livre($mois, $Matricule)
    {
        $mois = date('Y-m');
        $ca = 0;
        $facture = $this->tsenakoty_model->ca_livre_par_oplg($mois, $Matricule);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        return $ca;
    }

    public function ca_reel($mois, $Matricule)
    {
        $mois = date('Y-m');
        $ca = 0;
        $facture = $this->tsenakoty_model->ca_reel_par_oplg($mois, $Matricule);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        return $ca;
    }


}
