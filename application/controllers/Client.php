<?php

defined('BASEPATH') or exit('No direct script access allowed');

include APPPATH .'libraries/SimpleXLSX/SimpleXLSX.php';



class Client extends My_Controller

{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('client_model');
			$this->load->helper('url');
			$this->load->library("pagination");
		}

		public function index()
			{

			}
		public function liste(){

			$this->render_view('client/liste');

		}	

        public function pageclient()
		{
			$config = array();
			$config["base_url"] = base_url("Developpeur/client/client_par_page/");
			$config["total_rows"] = $this->client_model->nombre_client();
			$config["per_page"] = 10;
			$config["uri_segment"] = 4;
			$config["full_tag_open"] = '<ul class="pagination">';
			$config["full_tag_close"] = '</ul>';
			$config["first_link"] = "Première";
			$config["first_tag_open"] = "<li>";
			$config["first_tag_close"] = "</li>";
			$config["last_link"] = "Dernière";
			$config["last_tag_open"] = "<li>";
			$config["last_tag_close"] = "</li>";
			$config['next_link'] = 'Suivante';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '<li>';
			$config['prev_link'] = 'Précedante';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '<li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data["links"] = $this->pagination->create_links();
			$data['client'] =$this->dataClientPage($config["per_page"], $page);
			$data['pageliste'] = $this->client_model->pageliste(); 
			$this->render_view('client/ClientPAgeliste',$data);
        }

        public function  dataClientPage($config, $page){

            $donne = $this->client_model->get_client($config, $page); 

            $data = array();

            $i=0;

            foreach ($donne as $key => $donne) {

            $data[$i]['id']=$donne->id;

            $data[$i]['Code_client']=$donne->Code_client;

            $data[$i]['Nom']=$donne->Compte_facebook;
            $data[$i]['donne']=$this->clientPaseTd($donne->Code_client);
				$i++;
			}return $data;

        }

        public function clientPaseTd($Code_client){
		$listePage =  $this->client_model->pageliste();
        $html = "";
        foreach($listePage as $key => $listePage) {

        $data = "";

        $data = $this->testPage($Code_client,$listePage->id);
		if($data){
		$html .="<td class='bg-success text-white'>".$data->date."</td>";

        }else
		{
        $html .="<td class='bg-danger text-white'></td>";
		}
        }
        return $html;

        }

        public function testPage($Code_client,$Id){

        return $this->client_model->testPage($Code_client,$Id);

        }

       public function liste_des_clients(){
		
        $this->load->model("Accueil_model");
        
        $data = ['liste'=>$this->Accueil_model->liste_compte_fb()];
		$this->render_view("client/liste_client_par_page",$data);
	   }
      
	    public function list_client_page_data(){
			$this->load->model('Accueil_model');
			$refnum = $this->input->post('refnum');
			$page_name = $this->input->post('page_name');
			$liste_client = $this->Accueil_model->return_liste_client_page(['page'=>$refnum]);
			$data = ["data"=>$liste_client,"page_name"=>$page_name];
			$this->load->view('client/liste_data_page',$data);
			
		}
		public function liste_page_client(){
			$this->load->model('Accueil_model');
			$refnum = $this->input->post('refnum');
			$data = ["data"=>$this->Accueil_model->return_liste_page(["client"=>$refnum])];
			$this->load->view('client/liste_client_data_page',$data);
		}
		public function dataClient(){

		$datas=$this->client_model->dataClientInfo();

			foreach($datas as $row) {

			$sub_array = array();

			$sub_array[] = $row->CODECLIENT;

			$sub_array[] = $row->LIENFACEBOOK;

			$sub_array[] = $row->COMPTEFACEBOOK;

			$sub_array[] = $row->CONTACT;

			$sub_array[] = number_format($row->CHIFFREAFFAIRE,'2',',',' ');

			$sub_array[] = $row->NBREDARTICLESACHETES;

			$sub_array[] = $row->NBREDACHATSEFFECTUES;

			$sub_array[] = $row->DERNIERARTICLEACHETE;

			$sub_array[] = $row->DATEDERNIEREACHAT;

			$sub_array[] = $row->NOMBREDEPAGECONTACTE;

            $sub_array[] = $row->DERNIEREDISTRICTDELIVRAISON;

			$sub_array[] = $row->DERNIEREVILLERDELIVRAISON;

			$sub_array[] = $row->DERNIEREQUARTIERDELIVRAISON;

			$data[] = $sub_array;

		}

		$output = array("data" =>$data);
		echo json_encode($output);

		}

public function dataExportClient($Code_client){

	$listePage =  $this->client_model->pageliste();

    $html = "";

    foreach ($listePage as $key => $listePage) {

        $data = "";

        $data = $this->testPage($Code_client,$listePage->id);

        if($data){

            $html .="\t".$data->date;

            }else{

            $html .="\t null";

            }

    }

    return $html;

}       

public function export_pageClient(){

            $result = array();



    $donne = $this->client_model->listeClient();  

            $data = array();

            $i=0;

            

    $excel = "";

    /*$excel .=  "Code client\tNum Commande\tClient\tDate de Commande\tDate de Livraison\tLien Facebook\tContact\tProduit\tPU\tQTT\tlieu de livraison\tOPL\tStatut\tQuartier\tVille\tLocalisation\tFrais\n";*/



    foreach ($donne as $key=>$row) {

    $excel .= "$row->id\t$row->Code_client\t$row->Nom\t$row->Compte_facebook".$this->clientPaseTd($donne->Code_client)."\n";

    }



    header("Content-type: application/vnd.ms-excel");

    header("Content-disposition: attachment; filename=export". date('d-m-Y') . ".xls");



    print $excel;

    exit;

        }

    public function data_discussion(){

        echo json_encode($this->client_model->discussion_content());

    }
	public function clientsacParam(){
		$this->load->model('client_model');
		$param = $_GET['param'];
		$result = array('ios'=>21,'ios1'=>28,'ios2'=>35,'ios3'=>42,'ios4'=>49,'ios5'=>56,'ios6'=>63,'ios7'=>70);
		$data = array();
		$array =  json_decode($param);
		$datas = $this->client_model->liste_oplgg(date("Y-m"));
		foreach($datas as $row) {
			$sub_array = array();
            $sub_array[] = $row->Matricule_personnel;	
			if(in_array('ios',$array)){
			$sub_array[] =  count($this->client_model->client_a_traiterAAC7S($row->Matricule_personnel));		
			}else{
			$sub_array[] = "";	
			}
			
			if(in_array('ios1',$array)){
				$sub_array[] = count($this->client_model->client_a_traiterAAC7SSS($row->Matricule_personnel));;		
			}else{
				$sub_array[] = "";	
			}


			if(in_array('ios2',$array)){
				$sub_array[] = count($this->client_model->client_a_traiterAAC735($row->Matricule_personnel));		
			}else{
				$sub_array[] = "";	
			}

			if(in_array('ios3',$array)){
				$sub_array[] = count($this->client_model->client_a_traiterAAC7Sa($row->Matricule_personnel));		
			}else{
				$sub_array[] = "";	
			}


			if(in_array('ios4',$array)){
				$sub_array[] = count($this->client_model->client_a_traiterAAC749($row->Matricule_personnel));		
			}else{
				$sub_array[] = "";	
			}

			if(in_array('ios5',$array)){
				$sub_array[] = "";		
			}else{
				$sub_array[] = "";	
			}

			if(in_array('ios6',$array)){
				$sub_array[] = "";		
			}else{
				$sub_array[] = "";	
			}
			
			if(in_array('ios7',$array)){
				$sub_array[] = "";		
			}else{
				$sub_array[] = "";	
			}
			
	
			$data[] = $sub_array;
		}
		$output = array("data" =>$data);
		echo json_encode($output);
	}
    public function clientsacs(){
		$mois = date('Y-m');
        $datas = $this->client_model->liste_oplgg($mois);
		//$datas = $this->client_model->liste_oplgg($mois);
		$data = array();
		foreach($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->Matricule_personnel;
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";	
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";			
			$data[] = $sub_array;
		}
		$output = array("data" =>$data);
	echo json_encode($output);
	}

	public function clientsaca(){
		$mois = date('Y-m');
        $datas = $this->client_model->liste_oplgg($mois);
	
		//$datas = $this->client_model->liste_oplgg($mois);
		$data = array();
		foreach($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->Matricule_personnel;
			$sub_array[] = "";
			$sub_array[] = count($this->client_model->client_a_traiterAAC7Sa($row->Matricule_personnel));
			$sub_array[] ="";
			$sub_array[] = "";
			$sub_array[] = "";			
			$data[] = $sub_array;
		}
		$output = array("data" =>$data);
	echo json_encode($output);
	}
	public function clientsac(){
		$this->load->model('client_model');
		$dt=12;
		$data=[
			'dataopl'=>$this->client_model->liste_oplgg(date('Y-m')),
			'dt'=>$dt
		];
		$this->render_view('client/clientsac',$data);
	}
	public function relancer(){
		$this->load->model('client_model');
         $user =  $this->input->post('user');
         $datax =   $this->input->post('data');
		 $array =  json_decode($datax);

		 $this->client_model->updateParametre(['operatrice'=>$user],[ 'status'=>'off']);
		 foreach ($array as $key => $array) {
			 $this->client_model->insertparametreRelance(['operatrice'=>$user,'type'=>$array, 'status'=>'on']);
		 }
	}

	public function rang()
	{
		$this->load->model('client_model');
        $client = $this->input->post('codeclient');
        $code = substr($client, 0, 22);        
        $facture = $this->client_model->rang_koty();
        $content = ""; 
        $contenu = "";
        $totalCA =0;
		$CATOTAL=0;
        $ca = 0;
		$CA=0;
        $i=1;
        foreach ($facture as $facture) {
          $detailkotysmiles = $this->client_model->getkotysmiletotalpossible(trim($facture->Id_facture));
          foreach($detailkotysmiles as $value){
            $Koty = $value->koty;
            $smiles = $value->smiles;
  
          }
          $totalkotysmile = $this->client_model->gettotalsmileskotyGlobale($client);
          foreach($totalkotysmile as $value){
             $KotyT = $value->koty;
             $SmilesT = $value->smiles;   
         }
          $ca = $facture->Quantite * $facture->Prix_detail;
          $produit = $facture->Designation;
          $totalCA+=$ca;
          $content .= "<tr><td>".$facture->Code_client."</td><td><a href='#' class='produit'>".$facture->Code_produit."</a></td><td class='text-center' style='font-size:12px'>".$facture->Quantite."</td><td style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</td><td>".$Koty."</td><td>".$smiles."</td></td></tr>";
          
      }        
        if ($facture) {
          $contact= $facture->contacts;
        } else {
          $contact = "";
        }
  
        if ($facture) {
          $clients =$facture->Compte_facebook;
        } else {
          $clients = "";
        }       
        
       
        $client = $this->client_model->client($this->session->userdata('matricule'));
        foreach($client as $result){

          $totalkotysmiles = $this->client_model->gettotalsmileskotyGlobale($result->Code_client);
         foreach($totalkotysmiles as $value){
            $KotyT = $value->koty;
            $SmilesT = $value->smiles;  
            }

           
          $contenu .= "<tr><td></td><td><a href='#' class='client'>".$result->Code_client."</a></td><td>".$result->Compte_facebook."</td><td>".$result->lien_facebook."</td><td>".strtoupper($result->Nom_page)."</td><td>".$KotyT."</td><td>".$SmilesT."</td></tr>";
          $i++;

        }
        $data=[
          'data'=>$content,
          'contact' =>$contact,
          'contenu' =>$contenu,
          'totalCA'=>$totalCA,
          'clients' =>$clients,
          'dernier' =>$this->client_model->dernier_contact($code)
   
      ];
       // $statuttrim = $this->client_model->getclientstatuttrimes($SmilesT);
        //$statutannuel = $this->client_model->getclientstatutAnnuel($SmilesT);
        //$data['trimstatus'] =  $statuttrim;
        //$data['annuelstatus'] =   $statutannuel;
		$this->render_view('client/rang',$data);
	}

	public function client_details( ){
		$this->load->model('client_model');
		$client = $this->input->post('codeclient');
		$code = substr($client, 0, 22);        
		$facture = $this->client_model->stat($client);
		$arrayContent = array();
		$content = ""; 
		$cont ="";
		$totalCA =0;
		$ca = 0;
		$produit = 0;
		$total = array();
		foreach ($facture as $facture) {
		  $detailkotysmiles = $this->client_model->getkotysmiletotalpossible(trim($facture->Id_facture));
		  foreach($detailkotysmiles as $value){
			$Koty = $value->koty;
			$smiles = $value->smiles;
  
		  }
		  $ca = $facture->Quantite * $facture->Prix_detail;
		  $produit = $facture->Designation;
		  $totalCA+=$ca;
		  $content .= "<tr><td>".$facture->Date."</td><td>".$facture->Nom_page."</td><td>".$facture->Matricule_personnel."</td><td>".$facture->Ress_sec_oplg."</td><td>".$facture->Code_produit."</td><td class='text-center' style='font-size:12px'>" . $produit . "</td><td class='text-center' style='font-size:12px'>".$facture->Quantite."</td><td style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</td><td>".$Koty."</td><td>".$smiles."</td></td></tr>";
		  
	  }
		//$dernier = $this->client_model->dernier_contact($this->session->userdata('matricule'),$client);
		if ($facture) {
		  $contact= $facture->contacts;
		} else {
		  $contact = "";
		}
  
		if ($facture) {
		  $clients =$facture->Compte_facebook;
		} else {
		  $clients = "";
		}

		if ($facture) {
			$lien =$facture->lien_facebook;
		  } else {
			$lien = "";
		  }
		
		
	   
		$data=[
			'data'=>$content,
			'contact' =>$contact,
			'totalCA'=>$totalCA,
			'clients' =>$clients,
			'lien'=>$lien,
			'dernier' =>$this->client_model->dernier_contact($code)
	 
		];
  
		 $totalkotysmile = $this->client_model->gettotalsmileskotyGlobale($client);
		 foreach($totalkotysmile as $value){
			$KotyT = $value->koty;
			$SmilesT = $value->smiles;
  
		}
		$data['KotyT']=$KotyT;
		$data['SmilesT']=$SmilesT;
		$statuttrim = $this->client_model->getclientstatuttrimes($SmilesT);
		$statutannuel = $this->client_model->getclientstatutAnnuel($SmilesT);
		$data['trimstatus'] =  $statuttrim;
		$data['annuelstatus'] =   $statutannuel;
  
		$this->load->view('client/client_detail', $data);
		}
	public function rangs()
	{
		$this->load->model('client_model');
        $client = $this->input->post('codeclient');
        $code = substr($client, 0, 22);        
        $content = ""; 
        $contenu = "";
		$content1="";
		$content2="";
		$content3="";
		$content4="";
		$content5="";
		$content6="";
		$content7="";
        $totalCA =0;
        $ca = 0;
        $i=1;    
        $client = $this->client_model->clients($this->session->userdata('matricule'));
        foreach($client as $result){

          $totalkotysmiles = $this->client_model->gettotalsmileskotyGlobale($result->Code_client);
         foreach($totalkotysmiles as $value){
            $KotyT = $value->koty;
            $SmilesT = $value->smiles;  
            }
           
          $contenu .= "<tr><td></td><td><a href='#' class='client'>".$result->Code_client."</a></td><td>".$result->Compte_facebook."</td><td>".$KotyT."</td><td>".$SmilesT."</td></tr>";
          $i++;

        }

		$client1 = $this->client_model->client1($this->session->userdata('matricule'));
        foreach($client1 as $result){

          $totalkotysmiles = $this->client_model->gettotalsmileskotyGlobale($result->Code_client);
         foreach($totalkotysmiles as $value){
            $KotyT = $value->koty;
            $SmilesT = $value->smiles;  
            }
           
          $content .= "<tr><td></td><td><a href='#' class='client'>".$result->Code_client."</a></td><td>".$result->Compte_facebook."</td><td>".$KotyT."</td><td>".$SmilesT."</td></tr>";
          $i++;

        }

		$vivitecwjii = $this->client_model->vivitecwjii($this->session->userdata('matricule'));
        foreach($vivitecwjii as $result){

          $totalkotysmiles = $this->client_model->gettotalsmileskotyGlobale($result->Code_client);
         foreach($totalkotysmiles as $value){
            $KotyT = $value->koty;
            $SmilesT = $value->smiles;  
            }
           
          $content1 .= "<tr><td></td><td><a href='#' class='client'>".$result->Code_client."</a></td><td>".$result->Compte_facebook."</td><td>".$KotyT."</td><td>".$SmilesT."</td></tr>";
          $i++;

        }

		$viviteccjia = $this->client_model->viviteccjia($this->session->userdata('matricule'));
        foreach($viviteccjia as $result){

          $totalkotysmiles = $this->client_model->gettotalsmileskotyGlobale($result->Code_client);
         foreach($totalkotysmiles as $value){
            $KotyT = $value->koty;
            $SmilesT = $value->smiles;  
            }
           
          $content2 .= "<tr><td></td><td><a href='#' class='client'>".$result->Code_client."</a></td><td>".$result->Compte_facebook."</td><td>".$KotyT."</td><td>".$SmilesT."</td></tr>";
          $i++;

        }
        
		$viviteccjii = $this->client_model->viviteccjii($this->session->userdata('matricule'));
        foreach($viviteccjii as $result){

          $totalkotysmiles = $this->client_model->gettotalsmileskotyGlobale($result->Code_client);
         foreach($totalkotysmiles as $value){
            $KotyT = $value->koty;
            $SmilesT = $value->smiles;  
            }
           
          $content3 .= "<tr><td></td><td><a href='#' class='client'>".$result->Code_client."</a></td><td>".$result->Compte_facebook."</td><td>".$KotyT."</td><td>".$SmilesT."</td></tr>";
          $i++;

        }

		$viviteswjii = $this->client_model->viviteswjii($this->session->userdata('matricule'));
        foreach($viviteswjii as $result){

          $totalkotysmiles = $this->client_model->gettotalsmileskotyGlobale($result->Code_client);
         foreach($totalkotysmiles as $value){
            $KotyT = $value->koty;
            $SmilesT = $value->smiles;  
            }
           
          $content4 .= "<tr><td></td><td><a href='#' class='client'>".$result->Code_client."</a></td><td>".$result->Compte_facebook."</td><td>".$KotyT."</td><td>".$SmilesT."</td></tr>";
          $i++;

        }

		$gelnbiifl = $this->client_model->gelnbiifl($this->session->userdata('matricule'));
        foreach($gelnbiifl as $result){

          $totalkotysmiles = $this->client_model->gettotalsmileskotyGlobale($result->Code_client);
         foreach($totalkotysmiles as $value){
            $KotyT = $value->koty;
            $SmilesT = $value->smiles;  
            }
           
          $content5 .= "<tr><td></td><td><a href='#' class='client'>".$result->Code_client."</a></td><td>".$result->Compte_facebook."</td><td>".$KotyT."</td><td>".$SmilesT."</td></tr>";
          $i++;

        }

		$gelnpjiifl = $this->client_model->gelnpjiifl($this->session->userdata('matricule'));
        foreach($gelnpjiifl as $result){

          $totalkotysmiles = $this->client_model->gettotalsmileskotyGlobale($result->Code_client);
         foreach($totalkotysmiles as $value){
            $KotyT = $value->koty;
            $SmilesT = $value->smiles;  
            }
           
          $content6 .= "<tr><td></td><td><a href='#' class='client'>".$result->Code_client."</a></td><td>".$result->Compte_facebook."</td><td>".$KotyT."</td><td>".$SmilesT."</td></tr>";
          $i++;

        }

		$gelnpfpji = $this->client_model->gelnpfpji($this->session->userdata('matricule'));
        foreach($gelnpfpji as $result){

          $totalkotysmiles = $this->client_model->gettotalsmileskotyGlobale($result->Code_client);
         foreach($totalkotysmiles as $value){
            $KotyT = $value->koty;
            $SmilesT = $value->smiles;  
            }
           
          $content7 .= "<tr><td></td><td><a href='#' class='client'>".$result->Code_client."</a></td><td>".$result->Compte_facebook."</td><td>".$KotyT."</td><td>".$SmilesT."</td></tr>";
          $i++;

        }
        

        $data=[
		  'content1'=>$content1,
	      'content2'=>$content2,
		  'content3'=>$content3,
		  'content4'=>$content4,
		  'content5'=>$content5,
		  'content6'=>$content6,
		  'content7'=>$content7,
          'content'=>$content,
          'contenu' =>$contenu,
          'totalCA'=>$totalCA,
          'dernier' =>$this->client_model->dernier_contact($code)
   
      ];
		$this->render_view('client/rangs',$data);
	}
}			

		