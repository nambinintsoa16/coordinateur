<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mensuel extends My_Controller
{

    public function __construct()
    {
      parent::__construct();
      date_default_timezone_set('Europe/Moscow');
      $this->load->helper('url');
      $this->load->library("pagination");
    }
    public function index()
    {
    }
    public function mois()
    {
        $data = [

            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
        $this->render_view('mensuel/mois', $data);
    }

    public function years()
    {
        
    }
    public function W1()
    {
        $mois = date('Y-m');
        $content = "";
        $datas = $this->accueil_model->opl_listes($mois);
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->ca_mensuel_previsionnelle($mois, $row->Matricule);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->ca_mensuel_reels($mois, $row->Matricule);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }

            $factur = $this->accueil_model->ca_mensuel_livre($mois, $row->Matricule);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }


            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
           /* $sub_array[] = $row->Prenom;
            $sub_array[] =  substr($row->Matricule, 0, 7);
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->W2(date('Y-m'), $row->Prenom), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->W3(date('Y-m'), $row->Prenom), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');*/
            $sub_array[] = $row->Matricule;
            $sub_array[] = $row->Prenom;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] = "<a href='#' class='careel'>" . number_format($this->W2(date('Y-m'), $row->Matricule), 0, ',', ' ') . "</a>";
            $sub_array[] = "<a href='#' class='calivre'>" . number_format($this->W3(date('Y-m'), $row->Matricule), 0, ',', ' ') . "</a>";
            $sub_array[] = number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function W2($mois, $Matricule)
    {
        $mois = date('Y-m');
        $ca = 0;
        $facture = $this->accueil_model->ca_mensuel_reels($mois, $Matricule);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        return $ca;
    }

    public function W3($mois, $Matricule)
    {
        $mois = date('Y-m');
        $ca = 0;
        $facture = $this->accueil_model->ca_mensuel_livres($mois, $Matricule);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        return $ca;
    }

    public function camarsreel($mois, $Prenom)
    {
        $ca = 0;
        $facture = $this->accueil_model->ca_mensuel_reel($mois, $Prenom);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        return $ca;
    }

    public function ca_mensuel_reels($mois, $Matricule_personnel)
    {
        $ca = 0;
        $facture = $this->accueil_model->ca_mensuel_reels($mois, $Matricule_personnel);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        return $ca;
    }

    public function camarslivre($mois, $Prenom)
    {
        $ca = 0;
        $facture = $this->accueil_model->ca_mensuel_livre($mois, $Prenom);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        return $ca;
    }

     public function ca_mensuel_livre($mois, $Matricule_personnel)
    {
        $ca = 0;
        $facture = $this->accueil_model->ca_mensuel_livres($mois, $Matricule_personnel);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        return $ca;
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
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($t * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),
        ];

        echo json_encode($data);
    }

    public function dataWeek1()
    {
        $mo = array("Janvier_2021" => date('2021') . "-01", "Fervier_2021" => date('2021') . "-02", "Mars_2021" => date('2021') . "-03", "Avril_2021" => date('2021') . "-04", "Mai_2021" => date('2021') . "-05", "Juin_2021" => date('2021') . "-06", "Juillet_2021" => date('2021') . "-07", "Aout_2021" => date('2021') . "-08", "Septembre_2021" => date('2021') . "-09", "Octobre_2021" => date('2021') . "-10", "Novembre_2021" => date('2021') . "-11", "Decembre_2021" => date('2021') . "-12");
        $parametre = $this->input->post('mois');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal(date($mo[$parametre]));
        $factur = $this->accueil_model->ca_mensuel_reeltotal(date($mo[$parametre]));
        $factu = $this->accueil_model->ca_mensuel_livretotal(date($mo[$parametre]));
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($t * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [
            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),
        ];

        echo json_encode($data);
    }

    public function months($s2)
    {

        $moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('2021') . "-11", "Decembre_2021" => date('2021') . "-12");
        $dateD = date($moi[$s2]);
        $mois = $moi[$s2];
        $datas = $this->accueil_model->opl_listes($mois);
        $data = array();
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->ca_mensuel_previsionnelle($dateD, $row->Matricule);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->ca_mensuel_reels($dateD, $row->Matricule);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }

            $factur = $this->accueil_model->ca_mensuel_livres($dateD, $row->Matricule);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] = $row->Matricule;
            $sub_array[] = $row->Prenom;
            $sub_array[] =  "<a href='#' class='text-center caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='text-center careel'>" . number_format($careel, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='text-center calivre'>" . number_format($calivre, 0, ',', ' ') . "</a>";
            $sub_array[] =   number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function months1($s2)
    {

        $moi = array("Janvier_2021" => date('2021') . "-01", "Fervier_2021" => date('2021') . "-02", "Mars_2021" => date('2021') . "-03", "Avril_2021" => date('2021') . "-04", "Mai_2021" => date('2021') . "-05", "Juin_2021" => date('2021') . "-06", "Juillet_2021" => date('2021') . "-07", "Aout_2021" => date('2021') . "-08", "Septembre_2021" => date('2021') . "-09", "Octobre_2021" => date('2021') . "-10", "Novembre_2021" => date('2021') . "-11", "Decembre_2021" => date('2021') . "-12");
        $dateD = date($moi[$s2]);
        $mois = $moi[$s2];
        $datas = $this->accueil_model->opl_liste($mois);
        $data = array();
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->ca_mensuel_previ($dateD, $row->Prenom);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->ca_mensuel_reel($dateD, $row->Prenom);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }

            $factur = $this->accueil_model->ca_mensuel_livre($dateD, $row->Prenom);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] = $row->Prenom;
            $sub_array[] =  substr($row->Matricule_personnel, 0, 7);
            $sub_array[] =  "<a href='#' class='text-center caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='text-center careel'>" . number_format($careel, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='text-center calivre'>" . number_format($calivre, 0, ',', ' ') . "</a>";
            $sub_array[] =   number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }
    public function produitUserPrevi()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $facture = $this->accueil_model->detail_produit_mois_previ($matricule, date($mo[$parametre]));
        //$reponse = $this->accueil_model->ca_de_ventea($dateD, $dateF);
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
    public function produitUserReel()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $facture = $this->accueil_model->detail_produit_mois_reel($matricule, date($mo[$parametre]));
        //$reponse = $this->accueil_model->ca_de_ventea($dateD, $dateF);
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

    public function produitUserLivre()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $facture = $this->accueil_model->detail_produit_mois_livre($matricule, date($mo[$parametre]));
        //$reponse = $this->accueil_model->ca_de_ventea($dateD, $dateF);
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

            $content .= "<tr><td class='text-center' style='font-size:12px'><a href='#' class='detail'>" . $key . "</a></td><td class='text-center' style='font-size:12px'>" . $arrayContent . "</td><td style='font-size:12px'>" . number_format($total[$key], 0, '.', ',') . "</style></td></tr>";
        }

        echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
    }

    public function totalproduitreel()
    {
        $this->load->model('accueil_model');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $facture = $this->accueil_model->detail_produit_total_mois_reel(date($mo[$parametre]));
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
    public function totalproduitlivre()
    {
        $this->load->model('accueil_model');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $facture = $this->accueil_model->detail_produit_total_mois_livre(date($mo[$parametre]));
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

    public function bilan()
    {        
        $caannuelprevi = 0;
        $facture = $this->accueil_model->ca_annuel_previtotal(date('2021'));
        foreach ($facture as $facture) {
            $caannuelprevi += ($facture->Quantite * $facture->Prix_detail);
        }
        
        $caannuelreel = 0;
        $facture = $this->accueil_model->ca_annuel_reel(date('2021'));
        foreach ($facture as $facture) {
            $caannuelreel += ($facture->Quantite * $facture->Prix_detail);
        }

        $caannuellivre = 0;
        $facture = $this->accueil_model->ca_annuel_livre(date('2021'));
        foreach ($facture as $facture) {
            $caannuellivre += ($facture->Quantite * $facture->Prix_detail);
        }

        $caannuelprevi2022 = 0;
        $facture = $this->accueil_model->ca_annuel_previtotal(date('2022'));
        foreach ($facture as $facture) {
            $caannuelprevi2022 += ($facture->Quantite * $facture->Prix_detail);
        }
        
        $caannuelreel2022 = 0;
        $facture = $this->accueil_model->ca_annuel_reel(date('2022'));
        foreach ($facture as $facture) {
            $caannuelreel2022 += ($facture->Quantite * $facture->Prix_detail);
        }

        $caannuellivre2022 = 0;
        $facture = $this->accueil_model->ca_annuel_livre(date('2022'));
        foreach ($facture as $facture) {
            $caannuellivre2022 += ($facture->Quantite * $facture->Prix_detail);
        }
        $careelmars=0;
        $factur = $this->accueil_model->ca_mensuel_reeltotal(date('2021-03'));
        foreach ($factur as $factur) {
            $careelmars += ($factur->Quantite * $factur->Prix_detail);
        }

        $careelavril =0;
        $factur04 = $this->accueil_model->ca_mensuel_reeltotal(date('2021-04'));
        foreach ($factur04 as $factur04) {
            $careelavril += ($factur04->Quantite * $factur04->Prix_detail);
        }

        $careelmai =0;
        $factur05 = $this->accueil_model->ca_mensuel_reeltotal(date('2021-05'));
        foreach ($factur05 as $factur05) {
            $careelmai += ($factur05->Quantite * $factur05->Prix_detail);
        }

        $careeljuin =0;
        $factur06 = $this->accueil_model->ca_mensuel_reeltotal(date('2021-06'));
        foreach ($factur06 as $factur06) {
            $careeljuin += ($factur06->Quantite * $factur06->Prix_detail);
        }

        $careeljuillet =0;
        $factur07 = $this->accueil_model->ca_mensuel_reeltotal(date('2021-07'));
        foreach ($factur07 as $factur07) {
            $careeljuillet += ($factur07->Quantite * $factur07->Prix_detail);
        }
        
        $careelaout=0;
        $factur08 = $this->accueil_model->ca_mensuel_reeltotal(date('2021-08'));
        foreach ($factur08 as $factur08) {
            $careelaout += ($factur08->Quantite * $factur08->Prix_detail);
        }

        $careelsept=0;
        $factur09 = $this->accueil_model->ca_mensuel_reeltotal(date('2021-09'));
        foreach ($factur09 as $factur09) {
            $careelsept += ($factur09->Quantite * $factur09->Prix_detail);
        }

        $careeloct=0;
        $factur10 = $this->accueil_model->ca_mensuel_reeltotal(date('2021-10'));
        foreach ($factur10 as $factur10) {
            $careeloct += ($factur10->Quantite * $factur10->Prix_detail);
        }

        $careelnov=0;
        $factur11 = $this->accueil_model->ca_mensuel_reeltotal(date('2021-11'));
        foreach ($factur11 as $factur11) {
            $careelnov += ($factur11->Quantite * $factur11->Prix_detail);
        }

        $careeldec=0;
        $factur12 = $this->accueil_model->ca_mensuel_reeltotal(date('2021-12'));
        foreach ($factur12 as $factur12) {
            $careeldec += ($factur12->Quantite * $factur12->Prix_detail);
        }

        $careeljan2022=0;
        $facturjanv22 = $this->accueil_model->ca_mensuel_reeltotal(date('2022-01'));
        foreach ($facturjanv22 as $facturjanv22) {
            $careeljan2022 += ($facturjanv22->Quantite * $facturjanv22->Prix_detail);
        }

        $careelfev2022=0;
        $facturfev22 = $this->accueil_model->ca_mensuel_reeltotal(date('2022-02'));
        foreach ($facturfev22 as $facturfev22) {
            $careelfev2022 += ($facturfev22->Quantite * $facturfev22->Prix_detail);
        }
        $careelmars2022=0;
        $facturmars22 = $this->accueil_model->ca_mensuel_reeltotal(date('2022-03'));
        foreach ($facturmars22 as $facturmars22) {
            $careelmars2022 += ($facturmars22->Quantite * $facturmars22->Prix_detail);
        }

        $careelavril2022=0;
        $facturavril22 = $this->accueil_model->ca_mensuel_reeltotal(date('2022-04'));
        foreach ($facturavril22 as $facturavril22) {
            $careelavril2022 += ($facturavril22->Quantite * $facturavril22->Prix_detail);
        }

          $careemai2022=0;
        $facturmai22 = $this->accueil_model->ca_mensuel_reeltotal(date('2022-05'));
        foreach ($facturmai22 as $facturmai22) {
            $careemai2022 += ($facturmai22->Quantite * $facturmai22->Prix_detail);
        }

          $careeljuin2022=0;
          $facturjuin22 = $this->accueil_model->ca_mensuel_reeltotal(date('2022-06'));
        foreach ($facturjuin22 as $facturjuin22) {
            $careeljuin2022 += ($facturjuin22->Quantite * $facturjuin22->Prix_detail);
        }

        $careeljuillet2022=0;
          $facturjuillet22 = $this->accueil_model->ca_mensuel_reeltotal(date('2022-07'));
        foreach ($facturjuillet22 as $facturjuillet22) {
            $careeljuillet2022 += ($facturjuillet22->Quantite * $facturjuillet22->Prix_detail);
        }

         $careelaout2022=0;
          $facturaout22 = $this->accueil_model->ca_mensuel_reeltotal(date('2022-08'));
        foreach ($facturaout22 as $facturaout22) {
            $careelaout2022 += ($facturaout22->Quantite * $facturaout22->Prix_detail);
        }

         $careelsept2022=0;
          $factursept22 = $this->accueil_model->ca_mensuel_reeltotal(date('2022-09'));
        foreach ($factursept22 as $factursept22) {
            $careelsept2022 += ($factursept22->Quantite * $factursept22->Prix_detail);
        }

        $careeloct2022=0;
          $facturoct22 = $this->accueil_model->ca_mensuel_reeltotal(date('2022-10'));
        foreach ($facturoct22 as $facturoct22) {
            $careeloct2022 += ($facturoct22->Quantite * $facturoct22->Prix_detail);
        }

        $data=[
            "date1" =>date('2021-01'),
            "date2" =>date('2021-02'),
            "date3" =>date('2021-03'),
            "date4" =>date('2021-04'),
            "date5" =>date('2021-05'),
            "caannuelprevi"=>$caannuelprevi,
            "caannuelreel"=>$caannuelreel,
            "caannuellivre"=>$caannuellivre,
            "caannuelprevi2022"=>$caannuelprevi2022,
            "caannuelreel2022"=>$caannuelreel2022,
            "caannuellivre2022"=>$caannuellivre2022,
            "careelmars"=>$careelmars,
            "careelavril"=>$careelavril,
            "careelmai"=>$careelmai,
            "careeljuin"=>$careeljuin,
            "careeljuillet"=>$careeljuillet,
            "careelaout"=>$careelaout,
            "careelsept"=>$careelsept,
            "careeloct"=>$careeloct,
            "careelnov"=>$careelnov,
            "careeldec"=>$careeldec,
            "careeljan2022"=>$careeljan2022,
            "careelfev2022"=>$careelfev2022,
            "careelmars2022"=>$careelmars2022,
            "careelavril2022"=>$careelavril2022,
            "careemai2022"=>$careemai2022,
            "careeljuin2022"=>$careeljuin2022,
            "careeljuillet2022"=>$careeljuillet2022,
            "careelaout2022"=>$careelaout2022,
            "careelsept2022"=>$careelsept2022,
            "careeloct2022"=>$careeloct2022 
            
        ];
        $this->render_view('mensuel/bilan', $data);
    }
    public function mars21(){
            
            $mois = date('2021-03');
            $datas = $this->accueil_model->opl_list(date('2021-03'));
            foreach ($datas as $row) {
                $ca = 0;
                $careel = 0;
                $calivre = 0;
                $facture = $this->accueil_model->ca_mensuel_previ(date('2021-03'), $row->Prenom);
                foreach ($facture as $facture) {
                    $ca += ($facture->Quantite * $facture->Prix_detail);
                }
                $factu = $this->accueil_model->ca_mensuel_reel(date('2021-03'), $row->Prenom);
                foreach ($factu as $factu) {
                    $careel += ($factu->Quantite * $factu->Prix_detail);
                }
                $factur = $this->accueil_model->ca_mensuel_livre(date('2021-03'), $row->Prenom);
                foreach ($factur as $factur) {
                    $calivre += ($factur->Quantite * $factur->Prix_detail);
                }
                if ($careel != 0 and $ca != 0) {
                    $ratio = ($careel * 100) / ($ca);
                } else {
                    $ratio = 0;
                }
                $sub_array = array();
                $sub_array[] =  $row->Prenom;
                $sub_array[] =  $row->Matricule_personnel;
                $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
                $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->camarsreel(date('2021-03'), $row->Prenom), 0, ',', ' ') . "</a>";
                $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->camarslivre(date('2021-03'), $row->Prenom), 0, ',', ' ') . "</a>";
                $sub_array[] =  number_format($ratio, 2, ',', ' ');
                $data[] = $sub_array;
            }
            $output = array(
                "data" => $data
            );
            echo json_encode($output);

    }

    public function avril21(){
            
        $mois = date('2021-04');
        $datas = $this->accueil_model->opl_list(date('2021-04'));
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->ca_mensuel_previ(date('2021-04'), $row->Prenom);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->ca_mensuel_reel(date('2021-04'), $row->Prenom);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }
            $factur = $this->accueil_model->ca_mensuel_livre(date('2021-04'), $row->Prenom);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->camarsreel(date('2021-04'), $row->Prenom), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->camarslivre(date('2021-04'), $row->Prenom), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);

}

public function mai21(){
            
    $mois = date('2021-05');
    $datas = $this->accueil_model->opl_list(date('2021-05'));
    foreach ($datas as $row) {
        $ca = 0;
        $careel = 0;
        $calivre = 0;
        $facture = $this->accueil_model->ca_mensuel_previ(date('2021-05'), $row->Prenom);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        $factu = $this->accueil_model->ca_mensuel_reel(date('2021-05'), $row->Prenom);
        foreach ($factu as $factu) {
            $careel += ($factu->Quantite * $factu->Prix_detail);
        }
        $factur = $this->accueil_model->ca_mensuel_livre(date('2021-05'), $row->Prenom);
        foreach ($factur as $factur) {
            $calivre += ($factur->Quantite * $factur->Prix_detail);
        }
        if ($careel != 0 and $ca != 0) {
            $ratio = ($careel * 100) / ($ca);
        } else {
            $ratio = 0;
        }
        $sub_array = array();
        $sub_array[] =  $row->Prenom;
        $sub_array[] =  $row->Matricule_personnel;
        $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->camarsreel(date('2021-05'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->camarslivre(date('2021-05'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  number_format($ratio, 2, ',', ' ');
        $data[] = $sub_array;
    }
    $output = array(
        "data" => $data
    );
    echo json_encode($output);

}

public function juin21(){
            
    $mois = date('2021-06');
    $datas = $this->accueil_model->opl_list(date('2021-06'));
    foreach ($datas as $row) {
        $ca = 0;
        $careel = 0;
        $calivre = 0;
        $facture = $this->accueil_model->ca_mensuel_previ(date('2021-06'), $row->Prenom);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        $factu = $this->accueil_model->ca_mensuel_reel(date('2021-06'), $row->Prenom);
        foreach ($factu as $factu) {
            $careel += ($factu->Quantite * $factu->Prix_detail);
        }
        $factur = $this->accueil_model->ca_mensuel_livre(date('2021-06'), $row->Prenom);
        foreach ($factur as $factur) {
            $calivre += ($factur->Quantite * $factur->Prix_detail);
        }
        if ($careel != 0 and $ca != 0) {
            $ratio = ($careel * 100) / ($ca);
        } else {
            $ratio = 0;
        }
        $sub_array = array();
        $sub_array[] =  $row->Prenom;
        $sub_array[] =  $row->Matricule_personnel;
        $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->camarsreel(date('2021-06'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->camarslivre(date('2021-06'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  number_format($ratio, 2, ',', ' ');
        $data[] = $sub_array;
    }
    $output = array(
        "data" => $data
    );
    echo json_encode($output);

}

public function juillet21(){
            
    $mois = date('2021-07');
    $datas = $this->accueil_model->opl_list(date('2021-07'));
    foreach ($datas as $row) {
        $ca = 0;
        $careel = 0;
        $calivre = 0;
        $facture = $this->accueil_model->ca_mensuel_previ(date('2021-07'), $row->Prenom);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        $factu = $this->accueil_model->ca_mensuel_reel(date('2021-07'), $row->Prenom);
        foreach ($factu as $factu) {
            $careel += ($factu->Quantite * $factu->Prix_detail);
        }
        $factur = $this->accueil_model->ca_mensuel_livre(date('2021-07'), $row->Prenom);
        foreach ($factur as $factur) {
            $calivre += ($factur->Quantite * $factur->Prix_detail);
        }
        if ($careel != 0 and $ca != 0) {
            $ratio = ($careel * 100) / ($ca);
        } else {
            $ratio = 0;
        }
        $sub_array = array();
        $sub_array[] =  $row->Prenom;
        $sub_array[] =  $row->Matricule_personnel;
        $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->camarsreel(date('2021-07'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->camarslivre(date('2021-07'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  number_format($ratio, 2, ',', ' ');
        $data[] = $sub_array;
    }
    $output = array(
        "data" => $data
    );
    echo json_encode($output);

}

public function aout21(){
            
    $mois = date('2021-08');
    $datas = $this->accueil_model->opl_list(date('2021-08'));
    foreach ($datas as $row) {
        $ca = 0;
        $careel = 0;
        $calivre = 0;
        $facture = $this->accueil_model->ca_mensuel_previ(date('2021-08'), $row->Prenom);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        $factu = $this->accueil_model->ca_mensuel_reel(date('2021-08'), $row->Prenom);
        foreach ($factu as $factu) {
            $careel += ($factu->Quantite * $factu->Prix_detail);
        }
        $factur = $this->accueil_model->ca_mensuel_livre(date('2021-08'), $row->Prenom);
        foreach ($factur as $factur) {
            $calivre += ($factur->Quantite * $factur->Prix_detail);
        }
        if ($careel != 0 and $ca != 0) {
            $ratio = ($careel * 100) / ($ca);
        } else {
            $ratio = 0;
        }
        $sub_array = array();
        $sub_array[] =  $row->Prenom;
        $sub_array[] =  $row->Matricule_personnel;
        $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->camarsreel(date('2021-08'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->camarslivre(date('2021-08'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  number_format($ratio, 2, ',', ' ');
        $data[] = $sub_array;
    }
    $output = array(
        "data" => $data
    );
    echo json_encode($output);

}

public function septembre21(){
            
    $mois = date('2021-09');
    $datas = $this->accueil_model->opl_list(date('2021-09'));
    foreach ($datas as $row) {
        $ca = 0;
        $careel = 0;
        $calivre = 0;
        $facture = $this->accueil_model->ca_mensuel_previ(date('2021-09'), $row->Prenom);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        $factu = $this->accueil_model->ca_mensuel_reel(date('2021-09'), $row->Prenom);
        foreach ($factu as $factu) {
            $careel += ($factu->Quantite * $factu->Prix_detail);
        }
        $factur = $this->accueil_model->ca_mensuel_livre(date('2021-09'), $row->Prenom);
        foreach ($factur as $factur) {
            $calivre += ($factur->Quantite * $factur->Prix_detail);
        }
        if ($careel != 0 and $ca != 0) {
            $ratio = ($careel * 100) / ($ca);
        } else {
            $ratio = 0;
        }
        $sub_array = array();
        $sub_array[] =  $row->Prenom;
        $sub_array[] =  $row->Matricule_personnel;
        $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->camarsreel(date('2021-09'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->camarslivre(date('2021-09'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  number_format($ratio, 2, ',', ' ');
        $data[] = $sub_array;
    }
    $output = array(
        "data" => $data
    );
    echo json_encode($output);

}

public function octobre21(){
            
    $mois = date('2021-10');
    $datas = $this->accueil_model->opl_list(date('2021-10'));
    foreach ($datas as $row) {
        $ca = 0;
        $careel = 0;
        $calivre = 0;
        $facture = $this->accueil_model->ca_mensuel_previ(date('2021-10'), $row->Prenom);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        $factu = $this->accueil_model->ca_mensuel_reel(date('2021-10'), $row->Prenom);
        foreach ($factu as $factu) {
            $careel += ($factu->Quantite * $factu->Prix_detail);
        }
        $factur = $this->accueil_model->ca_mensuel_livre(date('2021-10'), $row->Prenom);
        foreach ($factur as $factur) {
            $calivre += ($factur->Quantite * $factur->Prix_detail);
        }
        if ($careel != 0 and $ca != 0) {
            $ratio = ($careel * 100) / ($ca);
        } else {
            $ratio = 0;
        }
        $sub_array = array();
        $sub_array[] =  $row->Prenom;
        $sub_array[] =  $row->Matricule_personnel;
        $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->camarsreel(date('2021-10'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->camarslivre(date('2021-10'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  number_format($ratio, 2, ',', ' ');
        $data[] = $sub_array;
    }
    $output = array(
        "data" => $data
    );
    echo json_encode($output);

}

public function novembre21(){
            
    $mois = date('2021-11');
    $datas = $this->accueil_model->opl_list(date('2021-11'));
    foreach ($datas as $row) {
        $ca = 0;
        $careel = 0;
        $calivre = 0;
        $facture = $this->accueil_model->ca_mensuel_previ(date('2021-11'), $row->Prenom);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        $factu = $this->accueil_model->ca_mensuel_reel(date('2021-11'), $row->Prenom);
        foreach ($factu as $factu) {
            $careel += ($factu->Quantite * $factu->Prix_detail);
        }
        $factur = $this->accueil_model->ca_mensuel_livre(date('2021-11'), $row->Prenom);
        foreach ($factur as $factur) {
            $calivre += ($factur->Quantite * $factur->Prix_detail);
        }
        if ($careel != 0 and $ca != 0) {
            $ratio = ($careel * 100) / ($ca);
        } else {
            $ratio = 0;
        }
        $sub_array = array();
        $sub_array[] =  $row->Prenom;
        $sub_array[] =  $row->Matricule_personnel;
        $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->camarsreel(date('2021-11'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->camarslivre(date('2021-11'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  number_format($ratio, 2, ',', ' ');
        $data[] = $sub_array;
    }
    $output = array(
        "data" => $data
    );
    echo json_encode($output);

}

public function decembre21(){
            
    $mois = date('2021-12');
    $datas = $this->accueil_model->opl_list(date('2021-12'));
    foreach ($datas as $row) {
        $ca = 0;
        $careel = 0;
        $calivre = 0;
        $facture = $this->accueil_model->ca_mensuel_previ(date('2021-12'), $row->Prenom);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        $factu = $this->accueil_model->ca_mensuel_reel(date('2021-12'), $row->Prenom);
        foreach ($factu as $factu) {
            $careel += ($factu->Quantite * $factu->Prix_detail);
        }
        $factur = $this->accueil_model->ca_mensuel_livre(date('2021-12'), $row->Prenom);
        foreach ($factur as $factur) {
            $calivre += ($factur->Quantite * $factur->Prix_detail);
        }
        if ($careel != 0 and $ca != 0) {
            $ratio = ($careel * 100) / ($ca);
        } else {
            $ratio = 0;
        }
        $sub_array = array();
        $sub_array[] =  $row->Prenom;
        $sub_array[] =  $row->Matricule_personnel;
        $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->camarsreel(date('2021-12'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->camarslivre(date('2021-12'), $row->Prenom), 0, ',', ' ') . "</a>";
        $sub_array[] =  number_format($ratio, 2, ',', ' ');
        $data[] = $sub_array;
    }
    $output = array(
        "data" => $data
    );
    echo json_encode($output);

}

    public function marsthead()
    {
        $mois = date('2021-03');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function avrilthead()
    {
        $mois = date('2021-04');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function maithead()
    {
        $mois = date('2021-05');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function juinthead()
    {
        $mois = date('2021-06');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function juilletthead()
    {
        $mois = date('2021-07');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function aoutthead()
    {
        $mois = date('2021-08');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function septembrethead()
    {
        $mois = date('2021-09');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function octobrethead()
    {
        $mois = date('2021-10');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function novembrethead()
    {
        $mois = date('2021-11');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function decembrethead()
    {
        $mois = date('2021-12');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function caannuelreel($ans)
    {
        $ans= date('Y');
        $ca = 0;
        $facture = $this->accueil_model->ca_annuel_previtotal($ans);
        foreach ($facture as $facture) {
            $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        return $ca;
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function janvier22(){
            
        $datas = $this->accueil_model->listeoperatrice(date('2022-01'));
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->mensuel_previ(date('2022-01'), $row->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->mensuel_reel(date('2022-01'), $row->Matricule_personnel);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }
            $factur = $this->accueil_model->ca_mensuel_livres(date('2022-01'), $row->Matricule_personnel);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->ca_mensuel_reels(date('2022-01'), $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->ca_mensuel_livre(date('2022-01'), $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;


            /*$sub_array = array();
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->camarsreel(date('2022-01'), $row->Prenom), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->camarslivre(date('2022-01'), $row->Prenom), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;*/
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    
    }

    public function janv2022thead()
    {
        $mois = date('2022-01');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function produitUserPreviannuel()
    {
        $this->load->model('accueil_model');
        $facture = $this->accueil_model->totalproduitprevi(date('2021'));
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

            $content .= "<tr><td style='font-size:12px'>" . $key . "</td><td class='text-center' style='font-size:12px'>" . $arrayContent . "</td><td style='font-size:12px'>" . number_format($total[$key], 0, '.', ',') . "</style></td></tr>";
        }

        echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
    }

    public function totalproduitreelannuel()
    {
        $this->load->model('accueil_model');
        $facture = $this->accueil_model->detail_produit_total_mois_reel(date('2021'));
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

    public function totalproduitlivreannuel()
    {
        $this->load->model('accueil_model');
        $facture = $this->accueil_model->detail_produit_total_mois_livre(date('2021'));
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

    public function fevrier22(){
            
        $datas = $this->accueil_model->listeoperatrice(date('2022-02'));
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->mensuel_previ(date('2022-02'), $row->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->mensuel_reel(date('2022-02'), $row->Matricule_personnel);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }
            $factur = $this->accueil_model->ca_mensuel_livres(date('2022-02'), $row->Matricule_personnel);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->ca_mensuel_reels(date('2022-02'), $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->ca_mensuel_livre(date('2022-02'), $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    
    }

    public function fevr2022thead()
    {
        $mois = date('2022-02');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function mars22(){
            
        $mois = date('2022-03');
        $datas = $this->accueil_model->listeoperatrice($mois);
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->mensuel_previ($mois, $row->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->mensuel_reel($mois, $row->Matricule_personnel);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }
            $factur = $this->accueil_model->ca_mensuel_livres($mois, $row->Matricule_personnel);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->ca_mensuel_reels($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->ca_mensuel_livre($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);

}

public function mars2022thead()
    {
        $mois = date('2022-03');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }


    public function avril2022thead()
    {
        $mois = date('2022-04');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function mai2022thead()
    {
        $mois = date('2022-05');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function avril22(){
            
        $mois = date('2022-04');
        $datas = $this->accueil_model->listeoperatrice($mois);
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->mensuel_previ($mois, $row->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->mensuel_reel($mois, $row->Matricule_personnel);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }
            $factur = $this->accueil_model->ca_mensuel_livres($mois, $row->Matricule_personnel);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->ca_mensuel_reels($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->ca_mensuel_livre($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);

}


 public function mai22(){
            
        $mois = date('2022-05');
        $datas = $this->accueil_model->listeoperatrice($mois);
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->mensuel_previ($mois, $row->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->mensuel_reel($mois, $row->Matricule_personnel);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }
            $factur = $this->accueil_model->ca_mensuel_livres($mois, $row->Matricule_personnel);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->ca_mensuel_reels($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->ca_mensuel_livre($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);

    }

    public function juin22(){
            
        $mois = date('2022-06');
        $datas = $this->accueil_model->listeoperatrice($mois);
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->mensuel_previ($mois, $row->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->mensuel_reel($mois, $row->Matricule_personnel);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }
            $factur = $this->accueil_model->ca_mensuel_livres($mois, $row->Matricule_personnel);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->ca_mensuel_reels($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->ca_mensuel_livre($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);

    }

     public function juin2022thead()
    {
        $mois = date('2022-06');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }


    public function juillet22(){
            
        $mois = date('2022-07');
        $datas = $this->accueil_model->listeoperatrice($mois);
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->mensuel_previ($mois, $row->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->mensuel_reel($mois, $row->Matricule_personnel);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }
            $factur = $this->accueil_model->ca_mensuel_livres($mois, $row->Matricule_personnel);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->ca_mensuel_reels($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->ca_mensuel_livre($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);

    }

     public function juillet2022thead()
    {
        $mois = date('2022-07');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function aout22(){
            
        $mois = date('2022-08');
        $datas = $this->accueil_model->listeoperatrice($mois);
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->mensuel_previ($mois, $row->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->mensuel_reel($mois, $row->Matricule_personnel);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }
            $factur = $this->accueil_model->ca_mensuel_livres($mois, $row->Matricule_personnel);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->ca_mensuel_reels($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->ca_mensuel_livre($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);

    }

     public function aout2022thead()
    {
        $mois = date('2022-08');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }


    public function sept22(){
            
        $mois = date('2022-09');
        $datas = $this->accueil_model->listeoperatrice($mois);
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->mensuel_previ($mois, $row->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->mensuel_reel($mois, $row->Matricule_personnel);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }
            $factur = $this->accueil_model->ca_mensuel_livres($mois, $row->Matricule_personnel);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->ca_mensuel_reels($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->ca_mensuel_livre($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);

    }

     public function sept2022thead()
    {
        $mois = date('2022-09');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

      public function oct2022thead()
    {
        $mois = date('2022-10');
        $tes = 0;
        $te = 0;
        $t = 0;
        $ratio = 0;
        $facture = $this->accueil_model->ca_mensuel_previtotal($mois);
        $factur = $this->accueil_model->ca_mensuel_reeltotal($mois);
        $factu = $this->accueil_model->ca_mensuel_livretotal($mois);
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        if ($te != 0 and $tes != 0) {
            $ratio = ($te * 100) / ($tes);
        } else {
            $ratio = 0;
        }

        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => "<a href='#' class='totalprevisio  text-white'>" . number_format($tes, 0, ',', ' ') . "</a>",
            "te" => "<a href='#' class='totalproduitreel text-white'>" . number_format($te, 0, ',', ' ') . "</a>",
            "t" => "<a href='#' class='totalprolivre text-white'>" . number_format($t, 0, ',', ' ') . "</a>",
            "ratio" => number_format($ratio, 2, ',', ' '),

        ];

        echo json_encode($data);
    }

    public function oct22(){
            
        $mois = date('2022-10');
        $datas = $this->accueil_model->listeoperatrice($mois);
        foreach ($datas as $row) {
            $ca = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->mensuel_previ($mois, $row->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->mensuel_reel($mois, $row->Matricule_personnel);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }
            $factur = $this->accueil_model->ca_mensuel_livres($mois, $row->Matricule_personnel);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }
            if ($careel != 0 and $ca != 0) {
                $ratio = ($careel * 100) / ($ca);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] =  $row->Matricule_personnel;
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  "<a href='#' class='caprevi'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='careel'>" . number_format($this->ca_mensuel_reels($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='calivre'>" . number_format($this->ca_mensuel_livre($mois, $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);


        
    }

public function etatGlobal(){
    
     $data = [
            //"oplg"=>$this->accueil_model->listeoperatrice(date('Y-m')),
            "jours" => $this->accueil_model->listeJours(date('Y-m')),
            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            // "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
    $this->render_view('mensuel/etatGlobal',$data);
}

    public function etatGlobals()
    {
        $oplg = $this->accueil_model->listeoperatrices(date('Y-m'));
        $jours = $this->accueil_model->listeJours(date('Y-m'));
        
        foreach ($oplg as $value){ 
            $sub_array = array();                 
            $sub_array[] = substr($value->Matricule_personnel, 0, 7);
            $sub_array[] = strtoupper($value->Prenom);
            $page = $this->accueil_model->codification_page($value->Matricule_personnel);
            if ($page) {
              $page_name = $page->Code_page;
            } else {
              $page_name = "";
            }   
            $sub_array[] = $page_name;
            $sub_array[] = "";        
            foreach ($jours as $key){
                $facture = $this->accueil_model->etatParMatriculePrevis($key->Date, $value->Matricule_personnel);
                    $caprevi=0;
                        foreach ($facture as $facture) {
                            $caprevi += ($facture->Quantite * $facture->Prix_detail);
                        }
                    $sub_array[] = number_format($caprevi, 0, ',', ' ');                      
            }
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);        
    }

     public function etatGlobalMonth()
    {
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('2021') . "-11", "Decembre" => date('2021') . "-12");
        $parametre = $this->input->post('mois');

        $oplg = $this->accueil_model->listeoperatrices(date($mo[$parametre]));
        $jours = $this->accueil_model->listeJours(date($mo[$parametre]));
        
        foreach ($oplg as $value){ 
            $sub_array = array();                 
            $sub_array[] = substr($value->Matricule_personnel, 0, 7);
            $sub_array[] = strtoupper($value->Prenom);
            $page = $this->accueil_model->codification_page($value->Matricule_personnel);
            if ($page) {
              $page_name = $page->Code_page;
            } else {
              $page_name = "";
            }   
            $sub_array[] = $page_name;
            $sub_array[] = "";        
            foreach ($jours as $key){
                $facture = $this->accueil_model->etatParMatriculePrevis($key->Date, $value->Matricule_personnel);
                    $caprevi=0;
                        foreach ($facture as $facture) {
                            $caprevi += ($facture->Quantite * $facture->Prix_detail);
                        }
                    $sub_array[] = number_format($caprevi, 0, ',', ' ');                      
            }
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);        
    }
    public function etatGlobalReel(){
        
         $data = [
               // "oplg"=>$this->accueil_model->listeoperatrice(date('Y-m')),
                "jours" => $this->accueil_model->listeJours(date('Y-m')),

                // "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
                // "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

            ];
        $this->render_view('mensuel/etatGlobalReel',$data);
    }

    public function etatGlobalReels()
    {
        $oplg = $this->accueil_model->listeoperatrice(date('Y-m'));
        $jours = $this->accueil_model->listeJours(date('Y-m'));
            
        foreach ($oplg as $value){ 
            $sub_array = array();                 
            $sub_array[] = substr($value->Matricule_personnel, 0, 7);
            $sub_array[] = strtoupper($value->Prenom);
             $page = $this->accueil_model->codification_page($value->Matricule_personnel);
            if ($page) {
              $page_name = $page->Code_page;
            } else {
              $page_name = "";
            }   
            $sub_array[] = $page_name;
            $sub_array[] = "";
            foreach ($jours as $key){
                $facture = $this->accueil_model->etatGlobalReels($key->Date, $value->Matricule_personnel);
                    $caprevi=0;
                        foreach ($facture as $facture) {
                            $caprevi += ($facture->Quantite * $facture->Prix_detail);
                        }
                    $sub_array[] = number_format($caprevi, 0, ',', ' ');                      
            }
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);        
    }



    public function etatGlobalLivre(){
        
         $data = [
                //"oplg"=>$this->accueil_model->listeoperatrice(date('Y-m')),
                "jours" => $this->accueil_model->listeJours(date('Y-m')),

                // "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
                // "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

            ];
        $this->render_view('mensuel/etatGlobalLivre',$data);
    }


    public function etatGlobalLivres()
    {
        $oplg = $this->accueil_model->listeoperatrice(date('Y-m'));
        $jours = $this->accueil_model->listeJours(date('Y-m'));
            
        foreach ($oplg as $value){ 
            $sub_array = array();                 
            $sub_array[] = substr($value->Matricule_personnel, 0, 7);
            $sub_array[] = strtoupper($value->Prenom);
            $page = $this->accueil_model->codification_page($value->Matricule_personnel);
            if ($page) {
              $page_name = $page->Code_page;
            } else {
              $page_name = "";
            }   
            $sub_array[] = $page_name;
            $sub_array[] = "";
            foreach ($jours as $key){
                $facture = $this->accueil_model->etatGlobalLivres($key->Date, $value->Matricule_personnel);
                    $caprevi=0;
                        foreach ($facture as $facture) {
                            $caprevi += ($facture->Quantite * $facture->Prix_detail);
                        }
                    $sub_array[] = number_format($caprevi, 0, ',', ' ');                      
            }
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);        
    }



    public function etatGlobal1()
    {
        $mois = date('Y-m');
        $content = "";
        $datas = $this->accueil_model->listeJours($mois);
        foreach ($datas as $row) {
            $caprevi = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->etatGlobalPrevi($row->Date);
            foreach ($facture as $facture) {
                $caprevi += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->etatGlobalReel($row->Date);
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }

            $factur = $this->accueil_model->etatGlobalLivre($row->Date);
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }

            if ($careel != 0 and $caprevi != 0) {
                $ratio = ($careel * 100) / ($caprevi);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] = $row->Date;
            $sub_array[] = "<a href='#' class='caprevi'>" . number_format($caprevi, 0, ',', ' ') . "</a>";
            $sub_array[] = "<a href='#' class='caprevi'>" . number_format($careel, 0, ',', ' ') . "</a>";
            $sub_array[] = "<a href='#' class='caprevi'>" . number_format($calivre, 0, ',', ' ') . "</a>";
            $sub_array[] = number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function etatParMatricule(){
     $data = [
            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")
        ];
    $this->render_view('mensuel/etatParMatricule',$data);
}

    public function etatParPage(){
     $data = [
            "jours" => $this->accueil_model->listeJours(date('Y-m')),
            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
    $this->render_view('mensuel/etatParPage',$data);
}

public function etat_page_data(){

    $mois = array("Janvier"=> '01' ,"Fervier" =>'02'  , "Mars"=>'03'  , "Avril"  =>'04', "Mai" =>'05', "Juin" => '06',"Juillet" => '07' ,"Aout" =>'08'  ,"Septembre" =>'09'  , "Octobre" =>'10' ,"Novembre" =>'11'  ,"Decembre"  =>'12');
    $date_select = $this->input->get('date');
    $methokOk = $date_select != null;
    $date = date('Y-m');
    if($methokOk){
        $date = date ("Y-".$mois["$date_select"]);
    }
    $data = [
        "page" => $this->accueil_model->listePage($date),
        "jours" => $this->accueil_model->listeJours($date),
        "date_select"=>$date_select
    ];
    $this->load->view("chiffre_d_affaire/page/previ",$data);
}

public function etatParMatricule1()
    {
        $mois = date('Y-m');
        $content = "";
        $datas = $this->accueil_model->ListeMatriculeOplg();
        foreach ($datas as $row) {
            $caprevi = 0;
            $careel = 0;
            $calivre = 0;
            $facture = $this->accueil_model->etatParMatriculePrevi($mois,substr($row->Matricule, 2, 5));
            foreach ($facture as $facture) {
                $caprevi += ($facture->Quantite * $facture->Prix_detail);
            }
            $factu = $this->accueil_model->etatParMatriculeReel($mois,substr($row->Matricule, 2, 5));
            foreach ($factu as $factu) {
                $careel += ($factu->Quantite * $factu->Prix_detail);
            }

            $factur = $this->accueil_model->etatParMatriculeLivre($mois,substr($row->Matricule, 2, 5));
            foreach ($factur as $factur) {
                $calivre += ($factur->Quantite * $factur->Prix_detail);
            }

            if ($careel != 0 and $caprevi != 0) {
                $ratio = ($careel * 100) / ($caprevi);
            } else {
                $ratio = 0;
            }
            $sub_array = array();
            $sub_array[] = substr($row->Matricule, 2, 5);
            $sub_array[] = "<b class='caprevi text-left'>" .$row->Prenom."</b>";
            $sub_array[] = "<a href='#' class='caprevi text-right'>" . number_format($caprevi, 0, ',', ' ') . "</a>";
            $sub_array[] = "<a href='#' class='careel text-right'>" . number_format($careel, 0, ',', ' ') . "</a>";
            $sub_array[] = "<a href='#' class='calivre text-right'>" . number_format($calivre, 0, ',', ' ') . "</a>";
            $sub_array[] = number_format($ratio, 2, ',', ' ');
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }
    public function DataParPage()
    {

        $mois = array("Janvier"=> '01' ,"Fervier" =>'02'  , "Mars"=>'03'  , "Avril"  =>'04', "Mai" =>'05', "Juin" => '06',"Juillet" => '07' ,"Aout" =>'08'  ,"Septembre" =>'09'  , "Octobre" =>'10' ,"Novembre" =>'11'  ,"Decembre"  =>'12');
        $date_select = $this->input->get('date');
        $methokOk = $date_select != null;
        $date = date('Y-m');
        if($methokOk){
            $date = date ("Y-".$mois["$date_select"]);
        }
     
        $page = $this->accueil_model->listePage($date);
        $jours = $this->accueil_model->listeJours($date);

        
        foreach ($page as $value){ 
            $sub_array = array();                 
            $sub_array[] = $value->Code_page;
            $sub_array[] = strtoupper($value->Nom_page);
            $somme = $this->accueil_model->somme_select_vente($date, $value->Code_page);
            $somme = $somme == null ? 0:$somme->Somme;
            $sub_array[] = "<a href='#'>".number_format($somme, 0, ',', ' ')."</a>";
            foreach ($jours as $key){
                $facture = $this->accueil_model->chiffre_page($key->Date, $value->Code_page);
                $facture = $facture == null ? 0:$facture->Somme;     
                $sub_array[] = number_format($facture, 0, ',', ' ');                   
            }
            $data[] = $sub_array;
        }
       
        $output = array(
            "data" => $data
        );
        echo json_encode($output);        
    }
    public function etatLivre(){
        $data = [
            "jours" => $this->accueil_model->listeJours(date('Y-m')),
            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
        $this->render_view('mensuel/etatLivre',$data);

    }

    public function etatReel()
    {
        $data = [
            "jours" => $this->accueil_model->listeJours(date('Y-m')),
            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
        $this->render_view('mensuel/etatReel',$data);
    }

    public function return_etatReel(){
        
        $mois = array("Janvier"=> '01' ,"Fervier" =>'02'  , "Mars"=>'03'  , "Avril"  =>'04', "Mai" =>'05', "Juin" => '06',"Juillet" => '07' ,"Aout" =>'08'  ,"Septembre" =>'09'  , "Octobre" =>'10' ,"Novembre" =>'11'  ,"Decembre"  =>'12');
        $date_select = $this->input->get('date');
        $methokOk = $date_select != null;
        $date = date('Y-m');
        if($methokOk){
            $date = date ("Y-".$mois["$date_select"]);
        }
        $jour = $this->accueil_model->listeJours($date);
        $data = [
            "jours" => $jour,
            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
     
        return $this->load->view('chiffre_d_affaire/page/reel',$data);
    }

    public function DataParPageReel()
    {

        $mois = array("Janvier"=> '01' ,"Fervier" =>'02'  , "Mars"=>'03'  , "Avril"  =>'04', "Mai" =>'05', "Juin" => '06',"Juillet" => '07' ,"Aout" =>'08'  ,"Septembre" =>'09'  , "Octobre" =>'10' ,"Novembre" =>'11'  ,"Decembre"  =>'12');
        $date_select = $this->input->get('date');
        $methokOk = $date_select != null;
        $date = date('Y-m');
        if($methokOk){
            $date = date ("Y-".$mois["$date_select"]);
        }
        $page = $this->accueil_model->listePage($date);
        $jours = $this->accueil_model->listeJours($date);
        
        foreach ($page as $value){ 
            $sub_array = array();                 
            $sub_array[] = $value->Code_page;
            $sub_array[] = strtoupper($value->Nom_page);
            $somme = $this->accueil_model->somme_select_vente_param($date, $value->Code_page,'livre');
            $somme = $somme == null ? 0:$somme->Somme;
            $sub_array[] ="<a href='#'>".number_format($somme, 0, ',', ' ')."</a>" ;      
            foreach ($jours as $key){
                $facture = $this->accueil_model->DataParPageReel($key->Date, $value->Code_page);
                    $caprevi=0;
                        foreach ($facture as $facture) {
                            $caprevi += ($facture->Quantite * $facture->Prix_detail);
                        }
                    $sub_array[] = number_format($caprevi, 0, ',', ' ');                      
            }
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);        
    }

    public function changer_heder_ca(){
        $mois = array("Janvier"=> '01' ,"Fervier" =>'02'  , "Mars"=>'03'  , "Avril"  =>'04', "Mai" =>'05', "Juin" => '06',"Juillet" => '07' ,"Aout" =>'08'  ,"Septembre" =>'09'  , "Octobre" =>'10' ,"Novembre" =>'11'  ,"Decembre"  =>'12');
        $date_select = $this->input->get('date');
        $methokOk = $date_select != null;
        $date = date('Y-m');
        if($methokOk){
            $date = date ("Y-".$mois["$date_select"]);
        }
        $data = [
            "page" => $this->accueil_model->listePage($date),
            "jours" => $this->accueil_model->listeJours($date),
            "date_select"=>$date_select
        ];
       
    
        $this->load->view('chiffre_d_affaire/page/livre',$data);                       

    }

    public function DataParPageLivre()
    {

        $mois = array("Janvier"=> '01' ,"Fervier" =>'02'  , "Mars"=>'03'  , "Avril"  =>'04', "Mai" =>'05', "Juin" => '06',"Juillet" => '07' ,"Aout" =>'08'  ,"Septembre" =>'09'  , "Octobre" =>'10' ,"Novembre" =>'11'  ,"Decembre"  =>'12');
        $date_select = $this->input->get('date');
        $methokOk = $date_select != null;
        $date = date('Y-m');
        if($methokOk){
            $date = date ("Y-".$mois["$date_select"]);
        }
     
        $page = $this->accueil_model->listePage($date);
        $jours = $this->accueil_model->listeJours($date);
  
        foreach ($page as $value){ 
            $sub_array = array();                 
            $sub_array[] = $value->Code_page;
            $sub_array[] = strtoupper($value->Nom_page);
            $somme = $this->accueil_model->somme_select_vente_param($date, $value->Code_page,"livre");
            $somme = $somme == null ? 0:$somme->Somme;
            $sub_array[] ="<a href='#'>".number_format($somme, 0, ',', ' ')."</a>" ;        
            foreach ($jours as $key){
                $facture = $this->accueil_model->DataParPageLivre($key->Date, $value->Code_page);
                    $caprevi=0;
                        foreach ($facture as $facture) {
                            $caprevi += ($facture->Quantite * $facture->Prix_detail);
                        }
                    $sub_array[] = "<a href='#' class=''>".number_format($caprevi, 0, ',', ' ')."</a>";                      
            }
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);        
    }

    public function previsionnel()
    {
         $data = [
            "jours" => $this->accueil_model->listeJours(date('Y-m')),
            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
        $this->render_view('mensuel/previsionnel',$data);
    }

    public function reel()
    {
         $data = [
            "jours" => $this->accueil_model->listeJours(date('Y-m')),
            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
        $this->render_view('mensuel/reel',$data);
    }

    public function livre()
    {
         $data = [
            "jours" => $this->accueil_model->listeJours(date('Y-m')),
            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre"),
            "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
        $this->render_view('mensuel/livre',$data);
    }

    public function DataPrevi()
    {

        $mois = array("Janvier"=> '01' ,"Fervier" =>'02'  , "Mars"=>'03'  , "Avril"  =>'04', "Mai" =>'05', "Juin" => '06',"Juillet" => '07' ,"Aout" =>'08'  ,"Septembre" =>'09'  , "Octobre" =>'10' ,"Novembre" =>'11'  ,"Decembre"  =>'12');
        $date_select = $this->input->post('date');
        $methokOk = $date_select != null;
        $date = date('Y-m');
        if($methokOk){
            $date = date ("Y-".$mois["$date_select"]);
        }
        $page = $this->accueil_model->listePage($date);
        $jours = $this->accueil_model->listeJours($date);
        $datas = $this->accueil_model->ListeMatriculeOplg($page);
        $data = ["mois"=>$page,
        "page"=>$page,
        "jours"=>$jours,
        "datas"=>$datas,
        "jours" => $this->accueil_model->listeJours($date),
        "mois" =>  $mois,
        "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
        $this->load->view("mensuel/data_previsionnel",$data);      
    }

    public function DataReel()
    {

             
        $mois = date('Y-m');
        $page = $this->accueil_model->listePage(date('Y-m'));
        $jours = $this->accueil_model->listeJours(date('Y-m'));
        $datas = $this->accueil_model->ListeMatriculeOplg($mois);
        foreach ($datas as $value){ 
            $sub_array = array();                 
            $sub_array[] = substr($value->Matricule, 2, 5);
            $sub_array[] = $value->Prenom;
            $sub_array[] = "";        
            foreach ($jours as $key){
                $facture=$this->accueil_model->etatParMatriculeReel($key->Date,substr($value->Matricule, 2, 5));
                    $caprevi=0;
                        foreach ($facture as $facture) {
                            $caprevi += ($facture->Quantite * $facture->Prix_detail);
                        }
                    $sub_array[] = number_format($caprevi, 0, ',', ' ');                      
            }
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);        
    }

        public function DataLivre()
    {
         $mois = array("Janvier"=> '01' ,"Fervier" =>'02'  , "Mars"=>'03'  , "Avril"  =>'04', "Mai" =>'05', "Juin" => '06',"Juillet" => '07' ,"Aout" =>'08'  ,"Septembre" =>'09'  , "Octobre" =>'10' ,"Novembre" =>'11'  ,"Decembre"  =>'12');
        $date_select = $this->input->post('date');
        $methokOk = $date_select != null;
        $date = date('Y-m');
        if($methokOk){
            $date = date ("Y-".$mois["$date_select"]);
        }
        $page = $this->accueil_model->listePage($date);
        $jours = $this->accueil_model->listeJours($date);
        $datas = $this->accueil_model->ListeMatriculeOplg($page);
        $data = ["mois"=>$page,
        "page"=>$page,
        "jours"=>$jours,
        "datas"=>$datas,
        "jours" => $this->accueil_model->listeJours($date),
        "mois" =>  $mois,
        "annees"=> array('01' =>"Janvier_2021",'02'=>"Fervier_2021",'03'=>"Mars_2021",'04'=>"Avril_2021",'05'=>"Mai_2021",'06'=>"Juin_2021",'07'=>"Juillet_2021",'08'=>"Aout_2021",'09'=>"Septembre_2021",'10'=>"Octobre_2021", '11' =>"Novembre_2021", '12' =>"Decembre_2021")

        ];
        $this->load->view("mensuel/data_livre",$data);      
    }

    public function produitLivre()
    {
        $this->load->model('accueil_model');
        $Matricule = $this->input->post('Matricule_personnel');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->produitlivre($Matricule,$date );
        $reponse = $this->accueil_model->ca_de_vente($date);
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

            $content .= "<tr><td class='text-center' style='font-size:12px'>" . $key . "</td><td class='text-center' style='font-size:12px'>" . $arrayContent . "</td><td style='font-size:12px'>" . number_format($total[$key], 0, ' ', ',') . "</style></td></tr>";
        }

        echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, ' ', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
    }

    public function produitLivres()
    {
        $this->load->model('accueil_model');
        $Matricule = $this->input->post('Matricule_personnel');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->produitreel($Matricule,date('Y-m'));
        $reponse = $this->accueil_model->ca_de_vente($date);
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

            $content .= "<tr><td class='text-center' style='font-size:10px !important'>" . $key . "</td><td class='text-center' style='font-size:10px !important'>" . $arrayContent . "</td><td style='font-size:10px !important' class='text-right'>" . number_format($total[$key], 0, ' ', ',') . "</style></td></tr>";
        }

        echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:10px !important'>TOTAL</th><th class='text-center' style='font-size:10px !important'>" . $produit . "</th><th style='font-size:10px !important'>" . number_format($ca, 0, ' ', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:10px !important'>PRODUIT(S)</th><th class='text-center' style='font-size:10px !important'>NOMBRE</th><th style='font-size:10px !important'>PRIX</th></thead><tbody style='font-size:10px !important'>" . $content . "</tbody></table>";
    }
}

