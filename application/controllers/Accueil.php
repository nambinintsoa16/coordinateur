<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accueil extends My_Controller
{
	 public function __construct()
	  {
	    parent::__construct();
	    date_default_timezone_set('Europe/Moscow');
	    $this->load->helper('url');
	    $this->load->library("pagination");
	    $this->load->library('email');
	  }

	public function index()
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
		
		//$datas = $this->accueil_model->opl_liste(date('Y-m'));
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
		$totareport = 0;

		$produits = 0;
		$totalproduit=0;
		$chiffre = 0;
		$totalchiffre =0;

		
		$arrayContent = array();
		$content = "";
		$ca = 0;
		
		$factures = $this->accueil_model->chiffre_d_affaires_livr($date);
		foreach ($factures as $factures) {

			$chiffre = ($factures->Quantite * $factures->Prix_detail);
			$produits = $factures->Quantite;
			$totalchiffre+=$chiffre;
			$totalproduit +=$produits;
		}		

		$datas = $this->accueil_model->listeDesOplg();
		foreach ($datas as $key => $datas) {
			$ca = 0;
			$calivre = 0;
			$produit = 0;
			$confirm =0;
			$prod = 0;
			$careport = 0;
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
			$livrereport = $this->accueil_model->chiffre_d_affaires_livre_reporte($date,$datas->Matricule);
			foreach ($livrereport as $livrereport) {
				$careport += ($livrereport->Quantite * $livrereport->Prix_detail);
				$produit += $livrereport->Quantite;
			}

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
			$totareport += $careport;
			

			
			$content .= "<tr><td class='collapse'>". $datas->Matricule. "</td>
			<td style='font-size:12px'><a href='#' class='detail'>" . substr($datas->Matricule, 0, 7). "</a></td>
			<td class='text-left' style='font-size:12px'><a href='#' class='nompage'>" . $datas->Prenom. "</a></td>
			<td class='text-right' style='font-size:12px'><a href='' class='ca'>" . number_format($ca, 0, ',', ' ') . "</a></td>
			<td class='text-right' style='font-size:12px'><a href='' class='car'>" . number_format($calivre, 0, ',', ' ') . "</a></td>
			<td class='text-right' style='font-size:12px'><a href='' class='reel'>" . number_format($canonlivre, 0, ',', ' ') . "</a></td>
			<td class='text-right' style='font-size:12px'><a href='#' class='calivrejour'>".number_format($calivrejour, 0, ',', ' ')."</a></td>
			<td class='text-right' style='font-size:12px'><a href='#' class='previlivre'>".number_format($previlivre, 0, ',', ' ')."</a></td>
			<td class='text-right' style='font-size:12px'><a href='#' class='confirmer'>".number_format($confirm, 0, ',', ' ')."</a></td>
			<td class='text-right'>" . number_format($ratio, 2, ',', ' ') . "</td></tr>";
			
		}
		$data = ['data' => $content,'totalcalivre'=>$totalcalivre,'cajour'=>$cajour,'totalratio'=>$totalratio,'sommes'=>$sommes,'totalsomme'=>$totalsomme,'totalconfirmer'=>$totalconfirmer, 'totalp' => $totalp, 'totalpro' => $totalpro, 'totalprod' => $totalprod, 'date' => $date, 'totalca' => $totalca, 'totalnonlivre' => $totalnonlivre, 'totalreel' => $totalreel,"chiffre"=>$totalchiffre,"produits"=>$totalproduit, "totareport"=>$totareport];
		

		$this->render_view('global/accueil', $data);
	}


	
	public function totalp()
	{
		$this->load->model('accueil_model');
		//$matricule = $this->input->post('matricule');
		$date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}

		$facture = $this->accueil_model->ca_facture_opl_total($date);
		$arrayContent = array();
		$content = "";
		$ca = 0;
		$produit = 0;
		$total = array();
		$Code_produit =array();

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

			$Code_produit = $facture->Code_produit;
		}


		foreach ($arrayContent as $key => $arrayContent) {
			$ca += $total[$key];
			$produit += $arrayContent;
			$content .= "<tr><td class='' style='font-size:12px'><a href='#' class='product'>" . $key . "</a></td><td class='text-center' style='font-size:12px'>" . $arrayContent . "</td><td style='font-size:12px'>" . number_format($total[$key], 0, '.', ',') . "</style></td></tr>";
		}

		echo "<table class='table table-bordered table-striped table-hover table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
		/*$data = [
			"ca"=>$ca,
			"produit"=>$produit,
			"content"=>$content
		];
		$this->load->view('detail/totalproduit',$data);*/
	}

	
	public function detail_vente()
	{
		/*$this->load->model('accueil_model');
		//$matricule = $this->input->post('matricule');
		$date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');			
		}
		$ca = 0;
		$data =array();
		$facture = $this->accueil_model->ca_facture_opl_total($date);
		foreach ($facture as $facture) {
            $ca = ($facture->Quantite * $facture->Prix_detail);
            $produit = $facture->Designation;
            $quantite = $facture->Quantite;

            $sub_array = array();
            $sub_array[] =  "<a href='#' class='caprevi'>" . $produit . "</a>";
            $sub_array[] = "<a href='#' class='careel'>" . number_format($ca, 0, ',', ' '). "</a>";
            $sub_array[] = "<a href='#' class='calivre'>" . $quantite . "</a>";
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
        */
        $date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}

		$facture = $this->accueil_model->ca_facture_opl_total($date);
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

	            $sub_array= array();
	            $sub_array[] = "<a href='#' class='product'>" . $key . "</a>";
	            $sub_array[] = number_format($arrayContent, 0, ',', ' ');
	            $sub_array[] =  number_format($total[$key], 0, '.', ',')  ;
	            $data[] = $sub_array;
	            }
	            $output = array(
	            "data" => $data
            );
        echo json_encode($output);


     }

	public function totalpro()
	{
		$this->load->model('accueil_model');
		//$matricule = $this->input->post('matricule');
		$date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}

		$facture = $this->accueil_model->ca_facture_op1_total($date);
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
			$content .= "<tr><td class='text-center' style='font-size:12px'><a href='#' class='produits'>" . $key . "</a></td><td class='text-center' style='font-size:12px'>" . $arrayContent . "</td><td style='font-size:12px'>" . number_format($total[$key], 0, '.', ',') . "</style></td></tr>";
		}

		echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}

	public function totalpo()
	{
		$this->load->model('accueil_model');
		//$matricule = $this->input->post('matricule');
		$date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}

		$facture = $this->accueil_model->chiffre_d_affaires_livr($date);
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

			$content .= "<tr><td class='text-center' style='font-size:12px'><a href ='#' class='products'>" . $key . "</a></td><td class='text-center' style='font-size:12px'>" . $arrayContent . "</td><td style='font-size:12px'>" . number_format($total[$key], 0, '.', ',') . "</style></td></tr>";
		}

		echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}

	public function produitUser()
	{
		$this->load->model('accueil_model');
		//$prenom = $this->input->post('Prenom');
		$matricule = $this->input->post('matricule');
		$date = $this->input->post('date');
		$facture = $this->accueil_model->ca_facture_opl($matricule, $date);
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

		echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}

	public function produitUse()
	{
		$this->load->model('accueil_model');
		$matricule = $this->input->post('matricule');
		$date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}
		$facture = $this->accueil_model->ca_facture_opls($date,$matricule);
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

		echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}


	public function produit()
	{
		$this->load->model('accueil_model');
		$matricule = $this->input->post('matricule');
		$date = $this->input->post('date');
		$facture = $this->accueil_model->ca_facture($matricule, $date);
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

		echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}

	public function logindata($pass, $user)
	{
		$this->load->model('accueil_model');
		$datas = $this->accueil_model->login($pass, $user);
		if ($datas) {
			$data = [
				"message" => true,
				"data" => $datas
			];
		} else {
			$data = [
				"message" => "false"
			];
		}
		echo json_encode(array($data));
	}
	public function livre()
	{
		$this->render_view('global/livre');
	}

	

	
	public function calivredujour()
	{
		$this->load->model('accueil_model');
		$matricule = $this->input->post('matricule');
		$date = $this->input->post('date');
		$facture = $this->accueil_model->ca_reel_du_jour($matricule,$date );
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

		echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}
	public function previlivre()
	{
		$this->load->model('accueil_model');
		$matricule = $this->input->post('matricule');
		$date = $this->input->post('date');
		$facture = $this->accueil_model->previlivre($matricule,$date );
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

		echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}


	public function totalpoduitlivre()
	{
		$this->load->model('accueil_model');
		//$matricule = $this->input->post('matricule');
		$date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}

		$facture = $this->accueil_model->total_ca_reel_du_jour($date);
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

		echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}

	public function totalsomme()
	{
		$this->load->model('accueil_model');
		//$matricule = $this->input->post('matricule');
		$date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}

		$facture = $this->accueil_model->totalsomme($date);
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

		echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}

	public function totalconfirmer()
	{
		$this->load->model('accueil_model');
		//$matricule = $this->input->post('matricule');
		$date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}

		$facture = $this->accueil_model->totalconfirmer();
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

		echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}

	public function produitUseconfirmer()
	{
		$this->load->model('accueil_model');
		$matricule = $this->input->post('matricule');
		$facture = $this->accueil_model->confirmer($matricule);
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

		echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}

	public function detail(){
	
		$data = [
			'nvx_clts'=>$this->accueil_model->nvx_Clients($this->input->post('matricule')),
			'totalnvx_clts'=>$this->accueil_model->total_nvx_Clients($this->input->post('matricule')),
			'ancien_clts'=>$this->accueil_model->ancien_clients($this->input->post('matricule')),
			'totalancien_clts'=>$this->accueil_model->total_ancien_clients($this->input->post('matricule')),
			  
		];

		$this->load->view('detail/detail_produit',$data);
	}

	public function detail_achat()
	{
		$content="";
		$ca=0;
		$qte=0;
		$oplg = $this->accueil_model->detail_oplg($this->input->post('produit'));		
		foreach ($oplg as $oplg) {
		$facture = $this->accueil_model->detail_achat($this->input->post('produit'),$oplg->Matricule_personnel);
		$content .= "<tr><td class='text-center' style='font-size:12px'><a href='#' class='anarana'>" . $oplg->Matricule_personnel . "</a></td><td class='text-center' style='font-size:12px'>" . $facture->Qte . "</td><td style='font-size:12px'>" . number_format($facture->CA, 0, '.', ',') . "</style></td></tr>";
		//$content .= "<tr><td class='text-center' style='font-size:12px'>" . $oplg->Matricule_personnel . "</td><td class='text-center' style='font-size:12px'></td><td style='font-size:12px'></style></td></tr>";
		}


	echo "<table class='table table-bordered table-hover table-striped table1'> <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>OPLG</th><th class='text-center' style='font-size:12px'>QUANTITE</th><th style='font-size:12px'>C.A</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}

	public function detail_achats()
	{
		$content="";
		$facture = $this->accueil_model->detail_achats($this->input->post('produit'));
		foreach ($facture as $facture) {
			$content .= "<tr><td class='text-center' style='font-size:12px'>" . $facture->Matricule_personnel . "</td><td class='text-center' style='font-size:12px'>" . $facture->Quantite . "</td><td style='font-size:12px'>" . number_format($facture->CA, 0, '.', ',') . "</style></td></tr>";
		}


	echo "<table class='table table-bordered table-hover table-striped table1'> <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>OPLG</th><th class='text-center' style='font-size:12px'>QUANTITE</th><th style='font-size:12px'>C.A</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}

	public function detail_achats_livre()
	{
		$content="";
		$facture = $this->accueil_model->detail_achats_livr($this->input->post('produit'));
		foreach ($facture as $facture) {
			$content .= "<tr><td class='text-center' style='font-size:12px'>" . $facture->Matricule_personnel . "</td><td class='text-center' style='font-size:12px'>" . $facture->Quantite . "</td><td style='font-size:12px'>" . number_format($facture->CA, 0, '.', ',') . "</style></td></tr>";
		}


	echo "<table class='table table-bordered table-hover table-striped table1'> <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>OPLG</th><th class='text-center' style='font-size:12px'>QUANTITE</th><th style='font-size:12px'>C.A</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
	}

	public function client_details( ){
      $this->load->model('accueil_model');
      $client = $this->input->post('client');
      $code = substr($client, 0, 22);        
      $facture = $this->accueil_model->stats($client);
      $arrayContent = array();
      $content = ""; 
      $cont ="";
      $totalCA =0;
      $ca = 0;
      $produit = 0;
      $total = array();
      foreach ($facture as $facture) {
        $detailkotysmiles = $this->accueil_model->getkotysmiletotalpossible(trim($facture->Id_facture));
        foreach($detailkotysmiles as $value){
          $Koty = $value->koty;
          $smiles = $value->smiles;

        }
        $ca = $facture->Quantite * $facture->Prix_detail;
        $produit = $facture->Designation;
        $totalCA+=$ca;
        $content .= "<tr><td>".$facture->Date."</td><td>".$facture->Nom_page."</td><td>".$facture->Matricule_personnel."</td><td>" . number_format($ca, 0, '.', ',') . "</td></tr>";
        
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

      if ($facture) {
        $codeClient =$facture->Code_client;
      } else {
        $codeClient = "";
      }

       if ($facture) {
        $Quartier =$facture->Quartier;
      } else {
        $Quartier = "";
      }

      if ($facture) {
        $lien_facebook =$facture->lien_facebook;
      } else {
        $lien_facebook = "";
      }

            
      $totalkotysmile = $this->accueil_model->gettotalsmileskotyGlobale($client);
       foreach($totalkotysmile as $value){
          $KotyT = $value->koty;
          $SmilesT = $value->smiles;

      }

      $trimstatus = $this->accueil_model->getclientstatuttrimes($SmilesT);
      $annuelstatus = $this->accueil_model->getclientstatutAnnuel($SmilesT);
      
      $heure =$this->accueil_model->premier_contact($client);
     
      /*$data=[
          'data'=>$content,
          'contact' =>$contact,
          'totalCA'=>$totalCA,
          'clients' =>$clients,
          'codeClient' => $codeClient,
          'dernier' =>$this->accueil_model->dernier_contact($code),
          'KotyT' => $KotyT,
          'SmilesT' =>$SmilesT,
          'trimstatus' => $this->accueil_model->getclientstatuttrimes($SmilesT),
          'annuelstatus'=> $this->accueil_model->getclientstatutAnnuel($SmilesT)
      ];
       
     
      $this->load->view('detail/client_detail', $data);*/
      echo "<div class='form table-responsive'>
	    <div class='row'>
	      	<div class='col border'>
	      		<div class='mt-3'>
				  <span><b>-</b> &nbsp Nom :  ".$clients."  </span><br>
				  <span><b>-</b> &nbsp ".$codeClient."</span><br>
				  <span><b>-</b> &nbsp Premier contact: ".substr($heure->heure, 0, 10)."</span><br>
				  <span><b>-</b> &nbsp Lieu : ".$Quartier." </span><br>
				  <span><b>-</b> &nbsp Total achat : ".number_format($totalCA, 0, '.', ',')." Ar</span><br>
				  <span class='text-center'><a href='".$lien_facebook."' target='_blank'><i class='fab fa-facebook'></i>
                                 facebook </a></span>
				  <span class='collapse codeclient'>".$codeClient."</span>
				</div>
			</div>
			<div class='col border'>
                <span class='profile-picture'>
                    <img alt='' src='".code_client_img_link($codeClient)."'  class='img-thumbnail avatar mt-3 rounded mx-auto d-block' style='height:50%; width: 100px;'>
                </span>
              	<div class='mt-2 text-center'>
	              	<span class='mt-2'>Statut: ".$trimstatus."  | ".$annuelstatus."</span><br>
	              	<span class='mt-2'>Koty: $KotyT</span>&nbsp | &nbsp <span class='mt-2'>Smile: $SmilesT</span>
              	</div>
            </div>
		</div>
		<span class='list-group-item bg-info text-center text-white historique mt-3'>Historiques de discussions</span>
	      <table class='mt-2 table table-bordered table-hover table-striped table1'> 
	      <thead class='bg-secondary'>
	      	<th class='text-center text-white' style='font-size:10px;'>DATE</th>
	      	<th class='text-center text-white' style='font-size:10px;'>PAGE</th>
	      	<th class='text-center text-white' style='font-size:10px;'>OPLG</th>
	      	<th class='text-center text-white' style='font-size:10px;'>MONTANT</th>
	      </thead>
	      <tbody>" . $content . "</tbody>
	      </table>
      </div>";
	
      }

      public function historique_discu()
      {
        $this->load->model('accueil_model');
        $Code_client = $this->input->post('codeclient');
        $content="";
        $historique = $this->accueil_model->historique_discussion($Code_client);
        foreach($historique as $historique){
        if($historique->action == 'vente'){
        $content.="<tr><td style='font-size:9px;'>".$historique->date." &nbsp; |".$historique->heure."</td><td style='font-size:9px;'>".$historique->operatrice."</td><td style='font-size:9px;'>".$historique->Nom_page."</td><td style='font-size:9px;'><i class='fa fa-check-circle text-success'></i> &nbsp CONCLUE</td></tr>";
        }else{
        $content.="<tr><td style='font-size:9px;'>".$historique->date." &nbsp; |".$historique->heure."</td><td style='font-size:9px;'>".$historique->operatrice."</td><td style='font-size:9px;'>".$historique->Nom_page."</td><td></td></tr>";
        }
        }
        echo "<table class='table table-bordered table-striped table-hover'><thead class='text-center bg-primary text-white'><tr><th>Date</th><th>Oplg</th><th>Nom page</th><th>Action</th></tr></thead><tbody>".$content."</tbody></table>";

    }

    public function prenom()
    {
    	$content="";
        $prenom = $this->accueil_model->prenom($this->input->post('matricule'));
        $content .= "<tr style='font-size:10px;'><td class='text-center'>" . $prenom->Prenom . "</td></tr>";
    
    echo "<table class='table table-bordered table1'><thead></thead><tbody>" . $content . "</tbody></table>";
    }

}
