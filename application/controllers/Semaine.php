<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Semaine extends My_Controller
{

    public function index()
    {
    }
    public function previsionnel()
    {
        $data = [

            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre")

        ];
        $this->render_view('semaine/previsionnel', $data);
    }

    public function W1()
    {

        $dateD = date('Y-m-1');
        $dateF = date('Y-m-7');
        $mois = date('Y-m');
        $content = "";
        $datas = $this->accueil_model->opl_liste($mois);
        foreach ($datas as $row) {
            $ca = 0;
            $facture = $this->accueil_model->S2($dateD, $dateF, $row->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
           /* $sub_array = array();
            $sub_array[] = "<a href='#' class='nompage'>".$row->Prenom."</a>";
            $sub_array[] =  substr($row->Matricule_personnel, 0, 7);
            $sub_array[] =  "<a href='#' class='produit1'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='produit2'>" . number_format($this->W2(date('Y-m-8'), date('Y-m-13'), $row->Prenom), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='produit3'>" . number_format($this->W2(date('Y-m-15'), date('Y-m-21'), $row->Prenom), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='produit4'>" . number_format($this->W2(date('Y-m-22'), date('Y-m-31'), $row->Prenom), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='produit5'>" . number_format($this->W2(date('Y-m-1'), date('Y-m-31'), $row->Prenom), 0, ',', ' ') . "</a>";
            $data[] = $sub_array;*/
             $sub_array = array();
            $sub_array[] = "<a href='#' class='nompage'>".$row->Matricule_personnel."</a>";
            $sub_array[] =  $row->Prenom;
            $sub_array[] =  "<a href='#' class='produit1'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='produit2'>" . number_format($this->W2(date('Y-m-8'), date('Y-m-13'), $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='produit3'>" . number_format($this->W2(date('Y-m-15'), date('Y-m-21'), $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='produit4'>" . number_format($this->W2(date('Y-m-22'), date('Y-m-31'), $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='produit5'>" . number_format($this->W2(date('Y-m-1'), date('Y-m-31'), $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }
    public function W2($dateD, $dateF, $Matricule_personnel)
    {
        $mois = date('Y-m');
        $content = "";
        $ca = 0;
        $facture = $this->accueil_model->S2($dateD, $dateF, $Matricule_personnel);
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
        $tesx = 0;
        $test = 0;
        $dateD = date($mo[$parametre] . '-01');
        $dateF = date($mo[$parametre] . '-07');
        $facture = $this->accueil_model->S3(date($mo[$parametre] . '-01'), date($mo[$parametre] . '-07'));
        $factur = $this->accueil_model->S3(date($mo[$parametre] . '-08'), date($mo[$parametre] . '-14'));
        $factu = $this->accueil_model->S3(date($mo[$parametre] . '-15'), date($mo[$parametre] . '-21'));
        $fact = $this->accueil_model->S3(date($mo[$parametre] . '-22'), date($mo[$parametre] . '-31'));
        $fac = $this->accueil_model->S3(date($mo[$parametre] . '-01'), date($mo[$parametre] . '-31'));
        foreach ($facture as $facture) {
            $tes += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($factur as $factur) {
            $te += ($factur->Quantite * $factur->Prix_detail);
        }
        foreach ($factu as $factu) {
            $t += ($factu->Quantite * $factu->Prix_detail);
        }
        foreach ($fact as $fact) {
            $tesx += ($fact->Quantite * $fact->Prix_detail);
        }
        foreach ($fac as $fac) {
            $test += ($fac->Quantite * $fac->Prix_detail);
        }


        $data = [

            "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"),
            "tes" => number_format($tes, 0, ',', ' '),
            "te" => number_format($te, 0, ',', ' '),
            "t" => number_format($t, 0, ',', ' '),
            "tesx" => number_format($tesx, 0, ',', ' '),
            "test" => number_format($test, 0, ',', ' ')

        ];

        echo json_encode($data);
    }
    public function months($s2)
    {

        $moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $dateD = date($moi[$s2] . '-01');
        $dateF = date($moi[$s2] . '-07');
        $mois = $moi[$s2];
        $content = "";
        $datas = $this->accueil_model->opl_liste($mois);
        $data = array();
        foreach ($datas as $row) {
            $ca = 0;
            $facture = $this->accueil_model->S2($dateD, $dateF, $row->Matricule_personnel);
            foreach ($facture as $facture) {
                $ca += ($facture->Quantite * $facture->Prix_detail);
            }
            $sub_array = array();
            $sub_array[] = "<a href='#' class='nompage'>".$row->Matricule_personnel."</a>";
            $sub_array[] =  $row->Prenom;
            $sub_array[] =   "<a href='#' class='produit1'>" . number_format($ca, 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='produit2'>" . number_format($this->W2($moi[$s2] . '-08', $moi[$s2] . '-14', $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='produit3'>" . number_format($this->W2($moi[$s2] . '-15', $moi[$s2] . '-21', $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='produit4'>" . number_format($this->W2($moi[$s2] . '-22', $moi[$s2] . '-31', $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $sub_array[] =  "<a href='#' class='produit5'>" . number_format($this->W2($moi[$s2] . '-01', $moi[$s2] . '-31', $row->Matricule_personnel), 0, ',', ' ') . "</a>";
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }
    public function produit()
    {
        $this->load->model('accueil_model');
        $Matricule = $this->input->post('Matricule_personnel');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $dateD = date($mo[$parametre] . '-01');
        $dateF = date($mo[$parametre] . '-07');
        $facture = $this->accueil_model->detail_produit_previ($dateD, $dateF, $Matricule);
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

    public function produits()
    {
        $this->load->model('accueil_model');
        $Matricule = $this->input->post('Matricule_personnel');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $dateD = date($mo[$parametre] . '-08');
        $dateF = date($mo[$parametre] . '-14');
        $facture = $this->accueil_model->detail_produit_previ($dateD, $dateF, $Matricule);
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
    public function produi()
    {
        $this->load->model('accueil_model');
        $Matricule_personnel = $this->input->post('Matricule_personnel');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $dateD = date($mo[$parametre] . '-15');
        $dateF = date($mo[$parametre] . '-21');
        $facture = $this->accueil_model->detail_produit_previ($dateD, $dateF, $Matricule_personnel);
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
    public function produit4()
    {
        $this->load->model('accueil_model');
        $Matricule = $this->input->post('Matricule_personnel');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $dateD = date($mo[$parametre] . '-22');
        $dateF = date($mo[$parametre] . '-31');
        $facture = $this->accueil_model->detail_produit_previ($dateD, $dateF, $Matricule);
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
    public function produitTotal()
    {
        $this->load->model('accueil_model');
        $Matricule = $this->input->post('Matricule_personnel');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $dateD = date($mo[$parametre] . '-01');
        $dateF = date($mo[$parametre] . '-31');
        $facture = $this->accueil_model->detail_produit_previ($dateD, $dateF, $Matricule);
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
    public function totalpro1()
    {
        $this->load->model('accueil_model');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $dateD = date($mo[$parametre] . '-01');
        $dateF = date($mo[$parametre] . '-07');

        $facture = $this->accueil_model->detail_produit_previs($dateD, $dateF);
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

    public function totalpro2()
    {
        $this->load->model('accueil_model');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $dateD = date($mo[$parametre] . '-08');
        $dateF = date($mo[$parametre] . '-14');
        $facture = $this->accueil_model->detail_produits_reels($dateD, $dateF);
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

    public function totalpro3()
    {
        $this->load->model('accueil_model');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $dateD = date($mo[$parametre] . '-15');
        $dateF = date($mo[$parametre] . '-21');
        $facture = $this->accueil_model->detail_produits_reels($dateD, $dateF);
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

    public function totalpro4()
    {
        $this->load->model('accueil_model');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $dateD = date($mo[$parametre] . '-22');
        $dateF = date($mo[$parametre] . '-31');
        $facture = $this->accueil_model->detail_produits_reels($dateD, $dateF);
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
    public function totalpro5()
    {
        $this->load->model('accueil_model');
        $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Aout" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
        $parametre = $this->input->post('mois');
        $dateD = date($mo[$parametre] . '-01');
        $dateF = date($mo[$parametre] . '-31');

        $facture = $this->accueil_model->detail_produits_reels($dateD, $dateF);
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


    public function livre()
    {
        $data = [

            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre")

        ];
        $this->render_view('semaine/livre', $data);
    }
    public function reel()
    {
        $data = [

            "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Aout", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre")

        ];
        $this->render_view('semaine/reel', $data);
    }
}
