<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operatrice extends My_Controller
{
	public function listeOplg()
	{
		$data=[
			'oplInfo'=>$this->accueil_model->listeCommercial(),
		];
		$this->render_view('operatrice/listeOperatrice',$data);
	}

	public function totalproduitprevi()
    {
        $this->load->model('accueil_model');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $facture = $this->accueil_model->totalproduitprevi(date($mo[$parametre]));
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

            $content .= "<tr><td class='text-center' style='font-size:12px'><a href='#' class='detail'>" . $key . "</a></td>
				            <td class='text-center' style='font-size:12px'>" . $arrayContent . "</td>
				            <td style='font-size:12px'>" . number_format($total[$key], 0, '.', ',') . "</style></td>
				         </tr>";
        }

        echo "<table class='table table-bordered table1'>  
        		<thead style='background-color:#90CAF9'>
        			<th class='text-center' style='font-size:12px'>PAGE</th>
        			<th class='text-center' style='font-size:12px'>CA PREVI</th>
        			<th style='font-size:12px'>CA REEL</th>
        		</thead>
        		<tbody style='font-size:12px'></tbody>
        	</table>";
    }

    public function detailParMatriculeL()
    {
        $this->load->model('accueil_model');        
        $matricule = $this->input->get('matricule');        
        $mois=date('Y-m');
        $value = $this->accueil_model->listePageOn( $matricule);   
        $data =array();
        $chiffreDaffaire = 0;
        $chiffreDaffaireVB= 0;
        foreach ($value as $row) {
        	$caprevi = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->etatParMatriculePagePrevi($mois,$matricule, $row->id);
            foreach ($facture as $facture) {
                $caprevi += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->etatParMatriculePageReel($mois,$matricule, $row->id);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }

            $factur = $this->accueil_model->etatParMatriculePageLivre($mois,$matricule, $row->id);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }

            if ($careel != 0 and $caprevi != 0) {
                $ratio = ($careel * 100) / ($caprevi);
            } else {
                $ratio = 0;
            }             
            $sub_array= array();
            $sub_array[] = $row->Code_page;
            $sub_array[] = strtolower($row->Nom_page);
            $sub_array[] = number_format($caprevi, 0, ',', ' ');
            $sub_array[] = number_format($careel, 0, ',', ' ');
            $sub_array[] = number_format($calivre, 0, ',', ' ');
            $sub_array[] = number_format($ratio, 2, ',', ' ');
                 
            $data[] = $sub_array;
            }
            $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }  

    public function Livraion_du_jour_export()
      {
        $this->load->model('accueil_model');  
        $LivraisonDuJourExprot = $this->accueil_model->getlivraison($this->session->userdata('matricule'));
        $this->render_view('operatrice/exportelisteliv', ['data' => $LivraisonDuJourExprot]);
      }

    public function livraison()
    {
         $dt = new dateTime();
        $dt1 = new dateTime();
        $dt2 = new dateTime();
        $dt3 = new dateTime();
        $dt4 = new dateTime();
        $dt5 = new dateTime();
        $dt6 = new dateTime();
        $dt7 = new dateTime();
        $dt1->modify('+2day');
        $dt2->modify('+3day');
        $dt3->modify('+4day');
        $dt4->modify('+5day');
        $dt5->modify('+6day');
        $dt6->modify('+7day');                    
        $dt7->modify('+8day');
        $date1 = $dt1->format("Y-m-d");
        $date2 = $dt2->format("Y-m-d");
        $date3 = $dt3->format("Y-m-d");
        $date4 = $dt4->format("Y-m-d");
        $date5 = $dt5->format("Y-m-d");
        $date6 = $dt6->format("Y-m-d");
        $date7 = $dt7->format("Y-m-d");
        $ca = 0;
        $ca1 = 0;
        $ca2 = 0;
        $ca3 = 0;
        $ca4 = 0;
        $ca5 = 0;
        $ca6 = 0;
                            $facture = $this->accueil_model->getTotalCaLivraison($date1);
                            foreach ($facture as $facture) {
                                $ca += ($facture->Quantite * $facture->Prix_detail);
                            }
                            $factu = $this->accueil_model->getTotalCaLivraison($date2);
                            foreach ($factu as $factu) {
                                $ca1 += ($factu->Quantite * $factu->Prix_detail);
                            }
                            $factur = $this->accueil_model->getTotalCaLivraison($date3);
                            foreach ($factur as $factur) {
                                $ca2 += ($factur->Quantite * $factur->Prix_detail);
                            }
                            $facture1 = $this->accueil_model->getTotalCaLivraison($date4);
                            foreach ($facture1 as $key) {
                                $ca3 += ($key->Quantite * $key->Prix_detail);
                            }
                            $facture2 = $this->accueil_model->getTotalCaLivraison($date5);
                            foreach ($facture2 as $key) {
                                $ca4 += ($key->Quantite * $key->Prix_detail);
                            }
                            $facture3 = $this->accueil_model->getTotalCaLivraison($date6);
                            foreach ($facture3 as $key) {
                                $ca5 += ($key->Quantite * $key->Prix_detail);
                            }
                            $facture4 = $this->accueil_model->getTotalCaLivraison($date7);
                            foreach ($facture4 as $key) {
                                $ca6 += ($key->Quantite * $key->Prix_detail);
                            }
        $data=[
            'oplg' => $this->accueil_model->listeDesOplg(),
            'ca' => $ca,
            'ca1' => $ca1,
            'ca2' =>$ca2,
            'ca3' => $ca3,
            'ca4' => $ca4,
            'ca5' => $ca5,
            'ca6' => $ca6
         ];
        $this->render_view('operatrice/livraison',$data);
    }

     public function etatLivraison()
    {
        $oplg = $this->accueil_model->listeoperatrices(date('Y-m'));
        $dt = new dateTime();
        $dt1 = new dateTime();
        $dt2 = new dateTime();
        $dt3 = new dateTime();
        $dt4 = new dateTime();
        $dt5 = new dateTime();
        $dt6 = new dateTime();
        $dt7 = new dateTime();
        $dt1->modify('+2day');
        $dt2->modify('+3day');
        $dt3->modify('+4day');
        $dt4->modify('+5day');
        $dt5->modify('+6day');
        $dt6->modify('+7day');                    
        $dt7->modify('+8day');
        $date1 = $dt1->format("Y-m-d");
        $date2 = $dt2->format("Y-m-d");
        $date3 = $dt3->format("Y-m-d");
        $date4 = $dt4->format("Y-m-d");
        $date5 = $dt5->format("Y-m-d");
        $date6 = $dt6->format("Y-m-d");
        $date7 = $dt7->format("Y-m-d");
        foreach ($oplg as $value){ 
            $sub_array = array();                 
            $sub_array[] = substr($value->Matricule_personnel, 0, 7);
            $sub_array[] = strtoupper($value->Prenom);
            // $page = $this->accueil_model->codification_page($value->Matricule_personnel);
            // if ($page) {
            //   $page_name = $page->Code_page;
            // } else {
            //   $page_name = "";
            // }   
            // $sub_array[] = $page_name;
            $ca = 0;
            $ca1 = 0;
            $ca2 = 0;
            $ca3 = 0;
            $ca4 = 0;
            $ca5 = 0;
            $ca6 = 0;
            $facture = $this->accueil_model->getCaLivraison($date1, $value->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->getCaLivraison($date2, $value->Matricule_personnel);
            foreach ($factu as $factu) {
                $ca1 += ($factu->Quantite * $factu->Prix_detail);
            }
            $factur = $this->accueil_model->getCaLivraison($date3, $value->Matricule_personnel);
            foreach ($factur as $factur) {
                $ca2 += ($factur->Quantite * $factur->Prix_detail);
            }
            $facture1 = $this->accueil_model->getCaLivraison($date4, $value->Matricule_personnel);
            foreach ($facture1 as $key) {
                $ca3 += ($key->Quantite * $key->Prix_detail);
            }
            $facture2 = $this->accueil_model->getCaLivraison($date5, $value->Matricule_personnel);
            foreach ($facture2 as $key) {
                $ca4 += ($key->Quantite * $key->Prix_detail);
            }
            $facture3 = $this->accueil_model->getCaLivraison($date6, $value->Matricule_personnel);
            foreach ($facture3 as $key) {
                $ca5 += ($key->Quantite * $key->Prix_detail);
            }
            $facture4 = $this->accueil_model->getCaLivraison($date7, $value->Matricule_personnel);
            foreach ($facture4 as $key) {
                $ca6 += ($key->Quantite * $key->Prix_detail);
            }
            $sub_array[] = number_format($ca);
            $sub_array[] = number_format($ca1);
            $sub_array[] = number_format($ca2);
            $sub_array[] = number_format($ca3);
            $sub_array[] = number_format($ca4);
            $sub_array[] = number_format($ca5); 
            $sub_array[] = number_format($ca6);     
            
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);        
    }


    public function detailLivraison()
    {
        $this->load->model('accueil_model');        
        $matricule = $this->input->get('matricule'); 
        $date = $this->input->get('date');       
        $mois=date('Y-m');
        $data =array();          
        $LivraisonDuJourExprot = $this->accueil_model->getlivraisonS($date,$matricule);
        foreach ($LivraisonDuJourExprot as $row) {               
            $sub_array= array();
            $sub_array[] = $row->Nom;
            $sub_array[] = $row->date;
            $sub_array[] = $row->date_de_livraison;
            $sub_array[] = $row->contacts;
            $sub_array[] = $row->Code_produit;
            $sub_array[] = number_format($row->Prix_detail);
            $sub_array[] = $row->Quantite;
            $sub_array[] = number_format($row->Quantite * $row->Prix_detail);
            $sub_array[] = $row->lieu_de_livraison;
            $sub_array[] = $row->Status;
            $sub_array[] = $row->frais;
            
                 
            $data[] = $sub_array;
            }
            $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }
}
 