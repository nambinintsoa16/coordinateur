<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hebdomadaire extends My_Controller
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

    public function previsionnel()
    {
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $mois = date('Y-m');

        $dt = new dateTime();
        $dt1 = new dateTime();
        $dt2 = new dateTime();
        $dt3 = new dateTime();
        $dt4 = new dateTime();
        $dt5 = new dateTime();
        $month = new DateTime();
        $dt->modify('-1day');
        $dt1->modify('-2day');
        $dt2->modify('-3day');
        $dt3->modify('-4day');
        $dt4->modify('-5day');
        $dt5->modify('-6day');
        $month->modify('-1month');
        $dat = $dt->format("Y-m-d");
        $dat1 = $dt1->format("Y-m-d");
        $dat2 = $dt2->format("Y-m-d");
        $dat3 = $dt3->format("Y-m-d");
        $dat4 = $dt4->format("Y-m-d");
        $dat5 = $dt5->format("Y-m-d");
        $month1 = $month->format("Y-m");

        $content = "";
        $tca3 = 0;
        $tca2 = 0;
        $tca1 = 0;
        $tca = 0;
        $cajour = 0;
        $tca4 = 0;
        $totalhebdo = 0;
        $tca5 = 0;
        $datas = $this->accueil_model->listeDesOplg();
        foreach ($datas as $key => $datas) {
            $data = array();
            $produit = 0;
            $caf = 0;
            $caj = 0;
            $ca1 = 0;
            $ca2 = 0;
            $ca3 = 0;
            $ca4 = 0;
            $ca5 = 0;
            $caT1 = 0;


            $facture = $this->accueil_model->ca_opl($datas->Matricule, $date);
            $fact = $this->accueil_model->ca_facture_jour_passe($dat, $datas->Matricule);
            $fact1 = $this->accueil_model->ca_facture_jour1($dat1, $datas->Matricule);
            $fact2 = $this->accueil_model->ca_facture_jour2($dat2, $datas->Matricule);
            $fact3 = $this->accueil_model->ca_facture_jour3($dat3, $datas->Matricule);
            $fact4 = $this->accueil_model->ca_facture_jour4($dat4, $datas->Matricule);
            $fact5 = $this->accueil_model->ca_facture_jour5($dat5, $datas->Matricule);
            $factTOTAL = $this->accueil_model->ca_facture_total_previ($date, $dat5, $datas->Matricule);
            foreach ($factTOTAL as $factTOTAL) {
                $produit += $factTOTAL->Quantite;
                $caT1 += ($factTOTAL->Quantite * $factTOTAL->Prix_detail);
            }

            foreach ($facture as $facture) {
                $produit += $facture->Quantite;
                $caf += ($facture->Quantite * $facture->Prix_detail);
            }
            foreach ($fact as $fact) {
                $caj += ($fact->Quantite * $fact->Prix_detail);
            }
            foreach ($fact1 as $fact1) {
                $ca1 += ($fact1->Quantite * $fact1->Prix_detail);
            }
            foreach ($fact2 as $fact2) {
                $ca2 += ($fact2->Quantite * $fact2->Prix_detail);
            }
            foreach ($fact3 as $fact3) {
                $ca3 += ($fact3->Quantite * $fact3->Prix_detail);
            }
            foreach ($fact4 as $fact4) {
                $ca4 += ($fact4->Quantite * $fact4->Prix_detail);
            }
            foreach ($fact5 as $fact5) {
                $ca5 += ($fact5->Quantite * $fact5->Prix_detail);
            }
            $page = $this->accueil_model->codification_page($datas->Matricule);
            if ($page) {
              $page_name = $page->Code_page;
            } else {
              $page_name = "";
            }
             $content .= "<tr text><td class='collapse'>".$datas->Matricule."</td>
            <td>" .substr($datas->Matricule, 0, 7). "</td>
            <td>" . strtoupper($datas->Prenom) . "</td>
            <td><b class='text-primary pageName' style='font-size:10px;'>".$page_name."</b></td>
            <td class='text-right'><a href='#' class='produit'>" . number_format($caT1, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#' class='test1'>" . number_format($caf, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'>" . number_format($caj, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'>" . number_format($ca1, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'>" . number_format($ca2, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'>" . number_format($ca3, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'>" . number_format($ca4, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'>" . number_format($ca5, 0, ',', ' ') . "</a></td></tr>";
            $tca5 += $ca5;
            $tca4 += $ca4;
            $tca3 += $ca3;
            $tca2 += $ca2;
            $tca1 += $ca1;
            $tca += $caj;
            $cajour += $caf;
            $totalhebdo += $caT1;
        }
        $data = ['data' => $content, 'totalhebdo' => $totalhebdo, 'tca5' => $tca5, 'dat' => $dat, 'date' => $date, 'tca3' => $tca3, 'tca2' => $tca2, 'tca1' => $tca1, 'tca' => $tca, 'cajour' => $cajour, 'tca4' => $tca4];

        $this->render_view('hebdomadaire/index', $data);
    }

    public function produitUser()
    {
        $this->load->model('accueil_model');
        $prenom = $this->input->post('Prenom');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->ca_facture_opl($prenom, $date);
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


    public function totalpo()
    {
        $this->load->model('accueil_model');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->produittotal($date);
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

            $content .= "<tr><td class='text-center' style='font-size:12px'><a href='#' class='product'>" . $key . "</a></td><td class='text-center' style='font-size:12px'>" . $arrayContent . "</td><td style='font-size:12px'>" . number_format($total[$key], 0, ' ', ',') . "</style></td></tr>";
        }

        echo "<table class='table table-bordered table1'><thead style='background-color:#E8EAF6'><th class='text-center' style='font-size:12px'>TOTAL</th><th class='text-center' style='font-size:12px'>" . $produit . "</th><th style='font-size:12px'>" . number_format($ca, 0, ' ', ',') . "</th></thead>   <thead style='background-color:#90CAF9'><th class='text-center' style='font-size:12px'>PRODUIT(S)</th><th class='text-center' style='font-size:12px'>NOMBRE</th><th style='font-size:12px'>PRIX</th></thead><tbody style='font-size:12px'>" . $content . "</tbody></table>";
    }

    public function totalpolivre()
    {
        $this->load->model('accueil_model');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->produittotallivre($date);
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

    public function totalporeel()
    {
        $this->load->model('accueil_model');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->produitreeltotal($date);
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

        echo "<table class='table table-bordered table1'>
        <thead style='background-color:#E8EAF6'>
            <th class='text-center' style='font-size:12px'>TOTAL</th>
            <th class='text-center' style='font-size:12px'>" . $produit . "</th>
            <th style='font-size:12px'>" . number_format($ca, 0, ' ', ',') . "</th>
        </thead>   
        <thead style='background-color:#90CAF9'>
            <th class='text-center' style='font-size:12px'>PRODUIT(S)</th>
            <th class='text-center' style='font-size:12px'>NOMBRE</th>
            <th style='font-size:12px'>PRIX</th>
        </thead>
        <tbody style='font-size:12px'>" . $content . "</tbody></table>";
    }


    public function reel()
    {
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $mois = date('Y-m');

        $dt = new dateTime();
        $dt1 = new dateTime();
        $dt2 = new dateTime();
        $dt3 = new dateTime();
        $dt4 = new dateTime();
        $dt5 = new dateTime();
        $month = new DateTime();
        $dt->modify('-1day');
        $dt1->modify('-2day');
        $dt2->modify('-3day');
        $dt3->modify('-4day');
        $dt4->modify('-5day');
        $dt5->modify('-6day');
        $month->modify('-1month');
        $dat = $dt->format("Y-m-d");
        $dat1 = $dt1->format("Y-m-d");
        $dat2 = $dt2->format("Y-m-d");
        $dat3 = $dt3->format("Y-m-d");
        $dat4 = $dt4->format("Y-m-d");
        $dat5 = $dt5->format("Y-m-d");
        $month1 = $month->format("Y-m");
        $content = "";
        $tca3 = 0;
        $tca2 = 0;
        $tca1 = 0;
        $tca = 0;
        $cajour = 0;
        $camois = 0;
        $tca4 = 0;
        $tca5 = 0;
        $totalhebdo = 0;
        $datas = $this->accueil_model->listeDesOplg();

        foreach ($datas as $key => $datas) {
            $data = array();
            $produit = 0;
            $caf = 0;
            $cam = 0;
            $caj = 0;
            $ca1 = 0;
            $ca2 = 0;
            $ca3 = 0;
            $ca4 = 0;
            $ca5 = 0;
            $caT1 = 0;

            $facture = $this->accueil_model->ca_oplivre($datas->Matricule, $dat4);
            $fact3 = $this->accueil_model->ca_facture_jour3l($dat3, $datas->Matricule);
            $fact2 = $this->accueil_model->ca_facture_jour2l($dat2, $datas->Matricule);
            $fact1 = $this->accueil_model->ca_facture_jour1l($dat1, $datas->Matricule);
            $fact4 = $this->accueil_model->ca_facture_jour($date, $datas->Matricule);
            $fact = $this->accueil_model->ca_facture_jour_passel($dat, $datas->Matricule);
            $fact5 = $this->accueil_model->ca_facture5($dat5, $datas->Matricule);
            $factTOTAL = $this->accueil_model->ca_facture_total_reel($date, $dat5, $datas->Matricule);
            foreach ($factTOTAL as $factTOTAL) {
                $produit += $factTOTAL->Quantite;
                $caT1 += ($factTOTAL->Quantite * $factTOTAL->Prix_detail);
            }
            foreach ($fact as $fact) {
                $caj += ($fact->Quantite * $fact->Prix_detail);
            }
            foreach ($fact5 as $fact5) {
                $ca5 += ($fact5->Quantite * $fact5->Prix_detail);
            }
            foreach ($fact4 as $fact4) {
                $caf += ($fact4->Quantite * $fact4->Prix_detail);
            }
            foreach ($fact1 as $fact1) {
                $ca1 += ($fact1->Quantite * $fact1->Prix_detail);
            }
            foreach ($fact2 as $fact2) {
                $ca2 += ($fact2->Quantite * $fact2->Prix_detail);
            }
            foreach ($facture as $facture) {
                $ca4 += ($facture->Quantite * $facture->Prix_detail);
            }
            foreach ($fact3 as $fact3) {
                $ca3 += ($fact3->Quantite * $fact3->Prix_detail);
            }
            $page = $this->accueil_model->codification_page($datas->Matricule);
            if ($page) {
              $page_name = $page->Code_page;
            } else {
              $page_name = "";
            }
            $content .= "<tr text><td class='collapse'>".$datas->Matricule."</td>
            <td>" .substr($datas->Matricule, 0, 7). "</td>
            <td>" . strtoupper($datas->Prenom) . "</td>
            <td><b class='text-primary pageName' style='font-size:10px;'>".$page_name."</b></td>
            <td class='text-right'><a href='#' class='produit'>" . number_format($caT1, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#' class='test1'>" . number_format($caf, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'>" . number_format($caj, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'>" . number_format($ca1, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'>" . number_format($ca2, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'>" . number_format($ca3, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'>" . number_format($ca4, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'>" . number_format($ca5, 0, ',', ' ') . "</a></td></tr>";

            $tca5 += $ca5;
            $tca4 += $ca4;
            $tca3 += $ca3;
            $tca2 += $ca2;
            $tca1 += $ca1;
            $tca += $caj;
            $cajour += $caf;
            $totalhebdo += $caT1;
        }
        $data = ['data' => $content, 'totalhebdo' => $totalhebdo, 'dat' => $dat, 'date' => $date, 'tca5' => $tca5, 'tca3' => $tca3, 'tca2' => $tca2, 'tca1' => $tca1, 'tca' => $tca, 'cajour' => $cajour,  'tca4' => $tca4];


        $this->render_view('hebdomadaire/index', $data);
    }

    public function livre()
    {
        $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $mois = date('Y-m');

        $dt = new dateTime();
        $dt1 = new dateTime();
        $dt2 = new dateTime();
        $dt3 = new dateTime();
        $dt4 = new dateTime();
        $dt5 = new dateTime();
        $month = new DateTime();
        $dt->modify('-1day');
        $dt1->modify('-2day');
        $dt2->modify('-3day');
        $dt3->modify('-4day');
        $dt4->modify('-5day');
        $dt5->modify('-6day');
        $month->modify('-1month');
        $dat = $dt->format("Y-m-d");
        $dat1 = $dt1->format("Y-m-d");
        $dat2 = $dt2->format("Y-m-d");
        $dat3 = $dt3->format("Y-m-d");
        $dat4 = $dt4->format("Y-m-d");
        $dat5 = $dt5->format("Y-m-d");
        $month1 = $month->format("Y-m");
        $content = "";
        $tca3 = 0;
        $tca2 = 0;
        $tca1 = 0;
        $tca = 0;
        $cajour = 0;
        $camois = 0;
        $tca4 = 0;
        $tca5 = 0;
        $totalhebdo = 0;
        $datas = $this->accueil_model->listeDesOplg();
        foreach ($datas as $key => $datas) {
            $data = array();
            $produit = 0;
            $caf = 0;
            $cam = 0;
            $caj = 0;
            $ca1 = 0;
            $ca2 = 0;
            $ca3 = 0;
            $ca4 = 0;
            $ca5 = 0;
            $caT1 = 0;
            $facture = $this->accueil_model->ca_livre($datas->Matricule, $dat4);
            $fact3 = $this->accueil_model->ca_livre1($dat3, $datas->Matricule);
            $fact2 = $this->accueil_model->ca_livre2($dat2, $datas->Matricule);
            $fact1 = $this->accueil_model->ca_livre3($dat1, $datas->Matricule);
            $fact4 = $this->accueil_model->ca_livre4($date, $datas->Matricule);
            $fact = $this->accueil_model->ca_livre5($dat, $datas->Matricule);
            $fact5 = $this->accueil_model->ca_livre6($dat5, $datas->Matricule);
            $factTOTAL = $this->accueil_model->ca_facture_total_livre($date, $dat5, $datas->Matricule);
            foreach ($factTOTAL as $factTOTAL) {
                $produit += $factTOTAL->Quantite;
                $caT1 += ($factTOTAL->Quantite * $factTOTAL->Prix_detail);
            }
            foreach ($fact as $fact) {
                $caj += ($fact->Quantite * $fact->Prix_detail);
            }
            foreach ($fact5 as $fact5) {
                $ca5 += ($fact5->Quantite * $fact5->Prix_detail);
            }
            foreach ($fact4 as $fact4) {
                $caf += ($fact4->Quantite * $fact4->Prix_detail);
            }
            foreach ($fact1 as $fact1) {
                $ca1 += ($fact1->Quantite * $fact1->Prix_detail);
            }
            foreach ($fact2 as $fact2) {
                $ca2 += ($fact2->Quantite * $fact2->Prix_detail);
            }
            foreach ($facture as $facture) {
                $ca4 += ($facture->Quantite * $facture->Prix_detail);
            }
            foreach ($fact3 as $fact3) {
                $ca3 += ($fact3->Quantite * $fact3->Prix_detail);
            }
            $page = $this->accueil_model->codification_page($datas->Matricule);
            if ($page) {
              $page_name = $page->Code_page;
            } else {
              $page_name = "";
            }
            $content .= "<tr text><td class='collapse'>".$datas->Matricule."</td>
            <td>" .substr($datas->Matricule, 0, 7). "</td>
            <td>" . strtoupper($datas->Prenom) . "</td>
            <td><b class='text-primary pageName' style='font-size:10px;'>".$page_name."</b></td>
            <td class='text-center'><a href='#' class='produit'>" . number_format($caT1, 0, ',', ' ') . "</a></td>
            <td class='text-center'><a href='#' class='test1'>" . number_format($caf, 0, ',', ' ') . "</a></td>
            <td class='text-center'><a href='#'>" . number_format($caj, 0, ',', ' ') . "</a></td>
            <td class='text-center'><a href='#'>" . number_format($ca1, 0, ',', ' ') . "</a></td>
            <td class='text-center'><a href='#'>" . number_format($ca2, 0, ',', ' ') . "</a></td>
            <td class='text-center'><a href='#'>" . number_format($ca3, 0, ',', ' ') . "</a></td>
            <td class='text-center'><a href='#'>" . number_format($ca4, 0, ',', ' ') . "</a></td>
            <td class='text-center'><a href='#'>" . number_format($ca5, 0, ',', ' ') . "</a></td></tr>";

            $tca5 += $ca5;
            $tca4 += $ca4;
            $tca3 += $ca3;
            $tca2 += $ca2;
            $tca1 += $ca1;
            $tca += $caj;
            $cajour += $caf;
            $camois += $cam;
            $totalhebdo += $caT1;
        }
        $data = ['data' => $content, 'totalhebdo' => $totalhebdo, 'dat' => $dat, 'tca5' => $tca5, 'date' => $date, 'tca3' => $tca3, 'tca2' => $tca2, 'tca1' => $tca1, 'tca' => $tca, 'cajour' => $cajour, 'camois' => $camois, 'tca4' => $tca4];


        $this->render_view('hebdomadaire/index', $data);
    }

    public function ca7()
    {
        $this->load->model('accueil_model');
        $Matricule_personnel = $this->input->post('Matricule_personnel');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->produithebdo($Matricule_personnel, $date);
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

    public function produitprevisionnel()
    {
        $this->load->model('accueil_model');
        $Matricule = $this->input->post('Matricule_personnel');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->produitprevisionnel($Matricule, $date);
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

    public function produitReel()
    {
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $this->load->model('accueil_model');
        $matricule = $this->input->post('Matricule_personnel');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->produithebdo($matricule, $date);
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


    public function TotalproduitReel()
    {
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $dt5 = new dateTime();
        $dt5->modify('-6day'); 
        $dat5 = $dt5->format("Y-m-d");
        $facture = $this->accueil_model->Totalproduithebdo($matricule, $dat5, date('Y-m-d'));
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
    public function TotalproduitLivre()
    {
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $dt5 = new dateTime();
        $dt5->modify('-6day'); 
        $dat5 = $dt5->format("Y-m-d");
        $facture = $this->accueil_model->totalHebdoLivre($matricule, $dat5, date('Y-m-d'));
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

    public function TotalproduitsLivres()
    {
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = $this->input->post('date');
        $dt5 = new dateTime();
        $dt5->modify('-6day'); 
        $dat5 = $dt5->format("Y-m-d");
        $facture = $this->accueil_model->totalHebdoLivres($dat5, date('Y-m-d'));
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

     public function TotalproduitReels()
    {
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $this->load->model('accueil_model');
        $date = $this->input->post('date');
        $dt5 = new dateTime();
        $dt5->modify('-6day'); 
        $dat5 = $dt5->format("Y-m-d");
        $facture = $this->accueil_model->Totalproduithebdos( $dat5, date('Y-m-d'));
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
    public function produitlivre()
    {

/* if ($page) {
        $link_page = $page->Lien_page;
        $page_name = $page->Nom_page;
    } else {
        $link_page = "";
        $page_name = "";
    } 
    //$new_client = $this->accueil_model->count_nouv_client_journalier($page->id);

    $content .= "<tr style='font-size:10px;'><td class='text-center' style='font-size: 9px;'>" . $page_name . "</td><td style='font-size: 9px;'>".$this->accueil_model->count_nouv_client_journalier($page->id)."</td><td style='font-size: 9px;'></td><td style='font-size: 9px;'></td></tr>";
    }
    //echo "<table class='table table-bordered table1' style='font-size:10px;'><thead></thead><tbody>" . $content . "</tbody></table>";

    $data =[
        "content"=>$content,
        "page"=>$this->accueil_model->namepage($this->input->post('prenom'))
        ];
    $this->load->view('detail/detail',$data);*/
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $this->load->model('accueil_model');
        $matricule = $this->input->post('Matricule_personnel');
        $date = $this->input->post('date');
        $facture = $this->accueil_model->produitlivre($matricule, $date);
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
    
    public function page()
    {
    $this->load->model('accueil_model');
    //$matricule = $this->input->post('matricule');
    $content = "";
    $data = array();
    $page = $this->accueil_model->namepage($this->input->get('matricule'));
    foreach($page as $row){   
    $sub_array= array();
        $sub_array[] = strtoupper($row->Nom_page);
        $sub_array[] = $this->accueil_model->count_total_client($row->id); 
        $sub_array[] = $this->accueil_model->count_nouv_client_journalier($row->id);
        $sub_array[] = $this->accueil_model->count_client_existant($row->id);
        $sub_array[] = $this->accueil_model->count_total_client($row->id) - ($this->accueil_model->count_nouv_client_journalier($row->id) + $this->accueil_model->count_client_existant($row->id));             
        $data[] = $sub_array;
        }
        $output = array(
        "data" => $data
    );
    echo json_encode($output);
}

 public function relance_page()
    {
    $this->load->model('accueil_model');
    //$matricule = $this->input->post('matricule');
    $content = "";
    $data = array();
    $page = $this->accueil_model->namepage($this->input->get('matricule'));
    foreach($page as $row){   
    $sub_array= array();
        $sub_array[] = strtoupper($row->Nom_page);
        $sub_array[] = $this->accueil_model->count_total_client($row->id); 
        $sub_array[] = $this->accueil_model->count_nouv_client_journalier($row->id);
        $sub_array[] = $this->accueil_model->count_client_existant($row->id);
        $sub_array[] = $this->accueil_model->count_total_client($row->id) - ($this->accueil_model->count_nouv_client_journalier($row->id) + $this->accueil_model->count_client_existant($row->id));             
        $data[] = $sub_array;
        }
        $output = array(
        "data" => $data
    );
    echo json_encode($output);
}

public function rapport_previsionnel(){
    $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $mois = date('Y-m');

        $dt = new dateTime();
        $dt1 = new dateTime();
        $dt2 = new dateTime();
        $dt3 = new dateTime();
        $dt4 = new dateTime();
        $dt5 = new dateTime();
        $month = new DateTime();
        $dt->modify('-1day');
        $dt1->modify('-2day');
        $dt2->modify('-3day');
        $dt3->modify('-4day');
        $dt4->modify('-5day');
        $dt5->modify('-6day');
        $month->modify('-1month');
        $dat = $dt->format("Y-m-d");
        $dat1 = $dt1->format("Y-m-d");
        $dat2 = $dt2->format("Y-m-d");
        $dat3 = $dt3->format("Y-m-d");
        $dat4 = $dt4->format("Y-m-d");
        $dat5 = $dt5->format("Y-m-d");
        $month1 = $month->format("Y-m");

        $content = "";
        $tca3 = 0;
        $tca2 = 0;
        $tca1 = 0;
        $tca = 0;
        $cajour = 0;
        $tca4 = 0;
        $totalhebdo = 0;
        $tca5 = 0;
        $datas = $this->accueil_model->prenom_oplg();
        foreach ($datas as $key => $datas) {
            $data = array();
            $produit = 0;
            $caf = 0;
            $caj = 0;
            $ca1 = 0;
            $ca2 = 0;
            $ca3 = 0;
            $ca4 = 0;
            $ca5 = 0;
            $caT1 = 0;


            $facture = $this->accueil_model->rapport_ca_opl($datas->Prenom, $date);
            $fact = $this->accueil_model->rapport_ca_facture_jour_passe($dat, $datas->Prenom);
            $fact1 = $this->accueil_model->rapport_ca_facture_jour1($dat1, $datas->Prenom);
            $fact2 = $this->accueil_model->rapport_ca_facture_jour2($dat2, $datas->Prenom);
            $fact3 = $this->accueil_model->rapport_ca_facture_jour3($dat3, $datas->Prenom);
            $fact4 = $this->accueil_model->rapport_ca_facture_jour4($dat4, $datas->Prenom);
            $fact5 = $this->accueil_model->rapport_ca_facture_jour5($dat5, $datas->Prenom);
            $factTOTAL = $this->accueil_model->rapport_ca_facture_total_previ($date, $dat5, $datas->Prenom);
            foreach ($factTOTAL as $factTOTAL) {
                $produit += $factTOTAL->Quantite;
                $caT1 += ($factTOTAL->Quantite * $factTOTAL->Prix_detail);
            }

            foreach ($facture as $facture) {
                $produit += $facture->Quantite;
                $caf += ($facture->Quantite * $facture->Prix_detail);
                $Matricule = $facture->Matricule_personnel;
            }

            foreach ($fact5 as $fact5) {
                $ca5 += ($fact5->Quantite * $fact5->Prix_detail);
            }
             foreach ($fact4 as $fact4) {
                $ca4 += ($fact4->Quantite * $fact4->Prix_detail);
            }

            foreach ($fact3 as $fact3) {
                $ca3 += ($fact3->Quantite * $fact3->Prix_detail);
            }

            foreach ($fact2 as $fact2) {
                $ca2 += ($fact2->Quantite * $fact2->Prix_detail);
            }

            foreach ($fact1 as $fact1) {
                $ca1 += ($fact1->Quantite * $fact1->Prix_detail);
            }
            foreach ($fact as $fact) {
                $caj += ($fact->Quantite * $fact->Prix_detail);
            }

              $content .= "<tr text>
              <td><a href='#' class='result' data-toggle='modal' data-target='#exampleModalCenter'>".substr($datas->Matricule, 2, 5)."</a></td><td>
              ".$datas->Prenom."</td><td class='text-right'><a href='#' class='produit'>
              " . number_format($caT1, 0, ',', ' ') . "</a>
              </td><td class='text-right'><a href='#' class='caf'>
              " . number_format($caf, 0, ',', ' ') . " </a>
              </td><td class='text-right'><a href='#' class='caj'>
              " . number_format($caj, 0, ',', ' ') . "</a>  
              </td><td class='text-right'><a href='#' class='ca1'>
              " . number_format($ca1, 0, ',', ' ') . "</a>  
              </td><td class='text-right'><a href='#' class='ca2'>
              " . number_format($ca2, 0, ',', ' ') . "</a> 
              </td><td class='text-right'><a href='#' class='ca3'>
              " . number_format($ca3, 0, ',', ' ') . "</a> 
              </td><td class='text-right'><a href='#' class='ca4'>
              " . number_format($ca4, 0, ',', ' ') . "</a>  
              </td><td class='text-right'><a href='#' class='ca5'>
              " . number_format($ca5, 0, ',', ' ') . "</a> 
              </td></tr>";

            $tca5 += $ca5;
            $tca4 += $ca4;
            $tca3 += $ca3;
            $tca2 += $ca2;
            $tca1 += $ca1;
            $tca += $caj;
            $cajour += $caf;
            $totalhebdo += $caT1;
        }
        $data = ['data' => $content, 'totalhebdo' => $totalhebdo, 'tca5' => $tca5, 'dat' => $dat, 'date' => $date, 'tca3' => $tca3, 'tca2' => $tca2, 'tca1' => $tca1, 'tca' => $tca, 'cajour' => $cajour, 'tca4' => $tca4];
        //$data = ['data'=>$content];
    $this->render_view('hebdomadaire/rapport',$data);
}


public function rapport_livre(){
      $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $mois = date('Y-m');

        $dt = new dateTime();
        $dt1 = new dateTime();
        $dt2 = new dateTime();
        $dt3 = new dateTime();
        $dt4 = new dateTime();
        $dt5 = new dateTime();
        $month = new DateTime();
        $dt->modify('-1day');
        $dt1->modify('-2day');
        $dt2->modify('-3day');
        $dt3->modify('-4day');
        $dt4->modify('-5day');
        $dt5->modify('-6day');
        $month->modify('-1month');
        $dat = $dt->format("Y-m-d");
        $dat1 = $dt1->format("Y-m-d");
        $dat2 = $dt2->format("Y-m-d");
        $dat3 = $dt3->format("Y-m-d");
        $dat4 = $dt4->format("Y-m-d");
        $dat5 = $dt5->format("Y-m-d");
        $month1 = $month->format("Y-m");
        $content = "";
        $tca3 = 0;
        $tca2 = 0;
        $tca1 = 0;
        $tca = 0;
        $cajour = 0;
        $camois = 0;
        $tca4 = 0;
        $tca5 = 0;
        $totalhebdo = 0;
        $datas = $this->accueil_model->prenom_oplg();
        foreach ($datas as $key => $datas) {
            $data = array();
            $produit = 0;
            $caf = 0;
            $cam = 0;
            $caj = 0;
            $ca1 = 0;
            $ca2 = 0;
            $ca3 = 0;
            $ca4 = 0;
            $ca5 = 0;
            $caT1 = 0;
            $facture = $this->accueil_model->rapport_ca_livre($datas->Prenom, $dat4);
            $fact3 = $this->accueil_model->rapport_ca_livre1($dat3, $datas->Prenom);
            $fact2 = $this->accueil_model->rapport_ca_livre2($dat2, $datas->Prenom);
            $fact1 = $this->accueil_model->rapport_ca_livre3($dat1, $datas->Prenom);
            $fact4 = $this->accueil_model->rapport_ca_livre4($date, $datas->Prenom);
            $fact = $this->accueil_model->rapport_ca_livre5($dat, $datas->Prenom);
            $fact5 = $this->accueil_model->rapport_ca_livre6($dat5, $datas->Prenom);
            $factTOTAL = $this->accueil_model->rapport_ca_facture_total_livre($date, $dat5, $datas->Prenom);
            foreach ($factTOTAL as $factTOTAL) {
                $produit += $factTOTAL->Quantite;
                $caT1 += ($factTOTAL->Quantite * $factTOTAL->Prix_detail);
            }
            foreach ($fact as $fact) {
                $caj += ($fact->Quantite * $fact->Prix_detail);
            }
            foreach ($fact5 as $fact5) {
                $ca5 += ($fact5->Quantite * $fact5->Prix_detail);
            }
            foreach ($fact4 as $fact4) {
                $caf += ($fact4->Quantite * $fact4->Prix_detail);
            }
            foreach ($fact1 as $fact1) {
                $ca1 += ($fact1->Quantite * $fact1->Prix_detail);
            }
            foreach ($fact2 as $fact2) {
                $ca2 += ($fact2->Quantite * $fact2->Prix_detail);
            }
            foreach ($facture as $facture) {
                $ca4 += ($facture->Quantite * $facture->Prix_detail);
            }
            foreach ($fact3 as $fact3) {
                $ca3 += ($fact3->Quantite * $fact3->Prix_detail);
            }

            $content .= "<tr text>
                <td><a href='#' class='resultlivre' data-toggle='modal' data-target='#exampleModalCenter'>".substr($datas->Matricule, 2, 5)."</a></td>
                <td>" . $datas->Prenom . "</td>
                <td class='text-right'><a href='#' class='produit'>" . number_format($caT1, 0, ',', ' ') . "</a></td>
                <td class='text-right'><a href='#'>" . number_format($caf, 0, ',', ' ') . "</a></td>
                <td class='text-right'><a href='#'>" . number_format($caj, 0, ',', ' ') . "</a></td>
                <td class='text-right'><a href='#'>" . number_format($ca1, 0, ',', ' ') . "</a></td>
                <td class='text-right'><a href='#'>" . number_format($ca2, 0, ',', ' ') . "</a></td>
                <td class='text-right'><a href='#'>" . number_format($ca3, 0, ',', ' ') . "</a></td>
                <td class='text-right'><a href='#'>" . number_format($ca4, 0, ',', ' ') . "</a></td>
                <td class='text-right'><a href='#'>" . number_format($ca5, 0, ',', ' ') . "</a></td></tr>";

            $tca5 += $ca5;
            $tca4 += $ca4;
            $tca3 += $ca3;
            $tca2 += $ca2;
            $tca1 += $ca1;
            $tca += $caj;
            $cajour += $caf;
            $camois += $cam;
            $totalhebdo += $caT1;
        }
        $data = ['data' => $content, 'totalhebdo' => $totalhebdo, 'dat' => $dat, 'tca5' => $tca5, 'date' => $date, 'tca3' => $tca3, 'tca2' => $tca2, 'tca1' => $tca1, 'tca' => $tca, 'cajour' => $cajour,  'tca4' => $tca4];

    $this->render_view('hebdomadaire/rapport',$data);
}

public function rapport_reel()
{
    $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $mois = date('Y-m');

        $dt = new dateTime();
        $dt1 = new dateTime();
        $dt2 = new dateTime();
        $dt3 = new dateTime();
        $dt4 = new dateTime();
        $dt5 = new dateTime();
        $month = new DateTime();
        $dt->modify('-1day');
        $dt1->modify('-2day');
        $dt2->modify('-3day');
        $dt3->modify('-4day');
        $dt4->modify('-5day');
        $dt5->modify('-6day');
        $month->modify('-1month');
        $dat = $dt->format("Y-m-d");
        $dat1 = $dt1->format("Y-m-d");
        $dat2 = $dt2->format("Y-m-d");
        $dat3 = $dt3->format("Y-m-d");
        $dat4 = $dt4->format("Y-m-d");
        $dat5 = $dt5->format("Y-m-d");
        $month1 = $month->format("Y-m");
        $content = "";
        $tca3 = 0;
        $tca2 = 0;
        $tca1 = 0;
        $tca = 0;
        $cajour = 0;
        $camois = 0;
        $tca4 = 0;
        $tca5 = 0;
        $totalhebdo = 0;
        $datas = $this->accueil_model->prenom_oplg();
        foreach ($datas as $key => $datas) {
            $data = array();
            $produit = 0;
            $caf = 0;
            $cam = 0;
            $caj = 0;
            $ca1 = 0;
            $ca2 = 0;
            $ca3 = 0;
            $ca4 = 0;
            $ca5 = 0;
            $caT1 = 0;
            $facture = $this->accueil_model->rapport_ca_oplivre($datas->Prenom, $dat4);
            $fact3 = $this->accueil_model->rapport_ca_facture_jour3l($dat3, $datas->Prenom);
            $fact2 = $this->accueil_model->rapport_ca_facture_jour2l($dat2, $datas->Prenom);
            $fact1 = $this->accueil_model->rapport_ca_facture_jour1l($dat1, $datas->Prenom);
            $fact4 = $this->accueil_model->rapport_ca_facture_jour($date, $datas->Prenom);
            $fact = $this->accueil_model->rapport_ca_facture_jour_passel($dat, $datas->Prenom);
            $fact5 = $this->accueil_model->rapport_ca_facture5($dat5, $datas->Prenom);
            $factTOTAL = $this->accueil_model->rapport_ca_facture_total_reel($date, $dat5, $datas->Prenom);
            foreach ($factTOTAL as $factTOTAL) {
                $produit += $factTOTAL->Quantite;
                $caT1 += ($factTOTAL->Quantite * $factTOTAL->Prix_detail);
            }
            foreach ($fact as $fact) {
                $caj += ($fact->Quantite * $fact->Prix_detail);
            }
            foreach ($fact5 as $fact5) {
                $ca5 += ($fact5->Quantite * $fact5->Prix_detail);
            }
            foreach ($fact4 as $fact4) {
                $caf += ($fact4->Quantite * $fact4->Prix_detail);
            }
            foreach ($fact1 as $fact1) {
                $ca1 += ($fact1->Quantite * $fact1->Prix_detail);
            }
            foreach ($fact2 as $fact2) {
                $ca2 += ($fact2->Quantite * $fact2->Prix_detail);
            }
            foreach ($facture as $facture) {
                $ca4 += ($facture->Quantite * $facture->Prix_detail);
            }
            foreach ($fact3 as $fact3) {
                $ca3 += ($fact3->Quantite * $fact3->Prix_detail);
            }
            $content .= "<tr>
            <td><a href='#' class='result_reel' data-toggle='modal' data-target='#exampleModalCenter'>" . substr($datas->Matricule, 2, 5) . "</a></td>
            <td>".strtoupper($datas->Prenom)."</td>
            <td class='text-right'><a href='#' class='produit'>" . number_format($caT1, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#' class='ca1'>" . number_format($caf, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#' class='ca2'>" . number_format($caj, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#' class='ca3'>" . number_format($ca1, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#' class='ca4'>" . number_format($ca2, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#' >" . number_format($ca3, 0, ',', ' ') . "</td></a>
            <td class='text-right'><a href='#' class='ca7'>" . number_format($ca4, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#' class='ca7'>" . number_format($ca5, 0, ',', ' ') . "</a></td>
            </tr>";

            $tca5 += $ca5;
            $tca4 += $ca4;
            $tca3 += $ca3;
            $tca2 += $ca2;
            $tca1 += $ca1;
            $tca += $caj;
            $cajour += $caf;
            $totalhebdo += $caT1;
        }
        $data = ['data' => $content, 'totalhebdo' => $totalhebdo, 'dat' => $dat, 'date' => $date, 'tca5' => $tca5, 'tca3' => $tca3, 'tca2' => $tca2, 'tca1' => $tca1, 'tca' => $tca, 'cajour' => $cajour,  'tca4' => $tca4];
     $this->render_view('hebdomadaire/rapport',$data);
}

public function anarana_page()
{
    $this->load->model('accueil_model');
    $Code = $this->input->post('Code');
    $content = "";
    $data = array();
    $page = $this->accueil_model->anarana_page($Code, $this->input->post('Matricule_personnel'));
    foreach($page as $row){ 
      $content = "<tr><td class='text-center'>".strtoupper($row->Nom_page)."</td></tr>";
    /*$sub_array= array();
        $sub_array[] = strtoupper($row->Nom_page);               
        $data[] = $sub_array;
        }

        $output = array(
        "data" => $data
    );
    echo json_encode($output);*/
}
 echo "<table class='table table-bordered table1'>  
        <thead style='background-color:#90CAF9'>
            <th class='text-center'>PAGE RATTACHEE</th>
        </thead>
        <tbody>" . $content . "</tbody></table>";
}

public function detailPrevisionnel()
{
     $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $mois = date('Y-m');

        $dt = new dateTime();
        $dt1 = new dateTime();
        $dt2 = new dateTime();
        $dt3 = new dateTime();
        $dt4 = new dateTime();
        $dt5 = new dateTime();
        $month = new DateTime();
        $dt->modify('-1day');
        $dt1->modify('-2day');
        $dt2->modify('-3day');
        $dt3->modify('-4day');
        $dt4->modify('-5day');
        $dt5->modify('-6day');
        $month->modify('-1month');
        $dat = $dt->format("Y-m-d");
        $dat1 = $dt1->format("Y-m-d");
        $dat2 = $dt2->format("Y-m-d");
        $dat3 = $dt3->format("Y-m-d");
        $dat4 = $dt4->format("Y-m-d");
        $dat5 = $dt5->format("Y-m-d");
        $month1 = $month->format("Y-m");

        $content = "";
        $tca3 = 0;
        $tca2 = 0;
        $tca1 = 0;
        $tca = 0;
        $cajour = 0;
        $tca4 = 0;
        $totalhebdo = 0;
        $tca5 = 0;
        $datas = $this->accueil_model->page_list();
        foreach ($datas as $key => $datas) {
            $data = array();
            $produit = 0;
            $caf = 0;
            $caj = 0;
            $ca1 = 0;
            $ca2 = 0;
            $ca3 = 0;
            $ca4 = 0;
            $ca5 = 0;
            $caT1 = 0;


            $facture = $this->accueil_model->ca_opl_page($datas->id, $date);
            $fact = $this->accueil_model->ca_facture_jour_passe_page($dat, $datas->id);
            $fact1 = $this->accueil_model->ca_facture_jour1_page($dat1, $datas->id);
            $fact2 = $this->accueil_model->ca_facture_jour2_page($dat2, $datas->id);
            $fact3 = $this->accueil_model->ca_facture_jour3_page($dat3, $datas->id);
            $fact4 = $this->accueil_model->ca_facture_jour4_page($dat4, $datas->id);
            $fact5 = $this->accueil_model->ca_facture_jour5_page($dat5, $datas->id);
            $factTOTAL = $this->accueil_model->ca_facture_total_previ_page($date, $dat5, $datas->id);
            foreach ($factTOTAL as $factTOTAL) {
                $caT1 += ($factTOTAL->Quantite * $factTOTAL->Prix_detail);
            }

            foreach ($facture as $facture) {
                $caf += ($facture->Quantite * $facture->Prix_detail);
            }
            foreach ($fact as $fact) {
                $caj += ($fact->Quantite * $fact->Prix_detail);
            }
            foreach ($fact1 as $fact1) {
                $ca1 += ($fact1->Quantite * $fact1->Prix_detail);
            }
            foreach ($fact2 as $fact2) {
                $ca2 += ($fact2->Quantite * $fact2->Prix_detail);
            }
            foreach ($fact3 as $fact3) {
                $ca3 += ($fact3->Quantite * $fact3->Prix_detail);
            }
            foreach ($fact4 as $fact4) {
                $ca4 += ($fact4->Quantite * $fact4->Prix_detail);
            }
            foreach ($fact5 as $fact5) {
                $ca5 += ($fact5->Quantite * $fact5->Prix_detail);
            }
            $content .="<tr><td>" . strtoupper($datas->Nom_page) . "</td>
            <td><b style='font-size:10px;'>".strtoupper($datas->Type)."</b></td>
            <td class='text-right'><a href='#' class='produit'>" . number_format($caT1, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'></a>" . number_format($caf, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($caj, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($ca1, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($ca2, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($ca3, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($ca4, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#' class='test1'></a>" . number_format($ca5, 0, ',', ' ') . "</td></tr>";
            $tca5 += $ca5;
            $tca4 += $ca4;
            $tca3 += $ca3;
            $tca2 += $ca2;
            $tca1 += $ca1;
            $tca += $caj;
            $cajour += $caf;
            $totalhebdo += $caT1;
        }
        $data = ['data' => $content, 'totalhebdo' => $totalhebdo, 'tca5' => $tca5, 'dat' => $dat, 'date' => $date, 'tca3' => $tca3, 'tca2' => $tca2, 'tca1' => $tca1, 'tca' => $tca, 'cajour' => $cajour, 'tca4' => $tca4];
    $this->render_view('hebdomadaire/detail',$data);   
}

public function detailReel()
{
      $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $mois = date('Y-m');

        $dt = new dateTime();
        $dt1 = new dateTime();
        $dt2 = new dateTime();
        $dt3 = new dateTime();
        $dt4 = new dateTime();
        $dt5 = new dateTime();
        $month = new DateTime();
        $dt->modify('-1day');
        $dt1->modify('-2day');
        $dt2->modify('-3day');
        $dt3->modify('-4day');
        $dt4->modify('-5day');
        $dt5->modify('-6day');
        $month->modify('-1month');
        $dat = $dt->format("Y-m-d");
        $dat1 = $dt1->format("Y-m-d");
        $dat2 = $dt2->format("Y-m-d");
        $dat3 = $dt3->format("Y-m-d");
        $dat4 = $dt4->format("Y-m-d");
        $dat5 = $dt5->format("Y-m-d");
        $month1 = $month->format("Y-m");
        $content = "";
        $tca3 = 0;
        $tca2 = 0;
        $tca1 = 0;
        $tca = 0;
        $cajour = 0;
        $camois = 0;
        $tca4 = 0;
        $tca5 = 0;
        $totalhebdo = 0;
        $datas = $this->accueil_model->page_list();

        foreach ($datas as $key => $datas) {
            $data = array();
            $produit = 0;
            $caf = 0;
            $cam = 0;
            $caj = 0;
            $ca1 = 0;
            $ca2 = 0;
            $ca3 = 0;
            $ca4 = 0;
            $ca5 = 0;
            $caT1 = 0;

            $facture = $this->accueil_model->ca_oplivre_page($datas->id, $dat4);
            $fact3 = $this->accueil_model->ca_facture_jour3l_page($dat3, $datas->id);
            $fact2 = $this->accueil_model->ca_facture_jour2l_page($dat2, $datas->id);
            $fact1 = $this->accueil_model->ca_facture_jour1l_page($dat1, $datas->id);
            $fact4 = $this->accueil_model->ca_facture_jour_page($date, $datas->id);
            $fact = $this->accueil_model->ca_facture_jour_passel_page($dat, $datas->id);
            $fact5 = $this->accueil_model->ca_facture5_page($dat5, $datas->id);
            $factTOTAL = $this->accueil_model->ca_facture_total_reel_page($date, $dat5, $datas->id);
            foreach ($factTOTAL as $factTOTAL) {
                $produit += $factTOTAL->Quantite;
                $caT1 += ($factTOTAL->Quantite * $factTOTAL->Prix_detail);
            }
            foreach ($fact as $fact) {
                $caj += ($fact->Quantite * $fact->Prix_detail);
            }
            foreach ($fact5 as $fact5) {
                $ca5 += ($fact5->Quantite * $fact5->Prix_detail);
            }
            foreach ($fact4 as $fact4) {
                $caf += ($fact4->Quantite * $fact4->Prix_detail);
            }
            foreach ($fact1 as $fact1) {
                $ca1 += ($fact1->Quantite * $fact1->Prix_detail);
            }
            foreach ($fact2 as $fact2) {
                $ca2 += ($fact2->Quantite * $fact2->Prix_detail);
            }
            foreach ($facture as $facture) {
                $ca4 += ($facture->Quantite * $facture->Prix_detail);
            }
            foreach ($fact3 as $fact3) {
                $ca3 += ($fact3->Quantite * $fact3->Prix_detail);
            }
            
            $content .="<tr><td>" . strtoupper($datas->Nom_page) . "</td>
            <td><b style='font-size:10px;'>".strtoupper($datas->Type)."</b></td>
            <td class='text-right'><a href='#' class='produit'>" . number_format($caT1, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'></a>" . number_format($caf, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($caj, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($ca1, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($ca2, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($ca3, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($ca4, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#' class='test1'></a>" . number_format($ca5, 0, ',', ' ') . "</td></tr>";

            $tca5 += $ca5;
            $tca4 += $ca4;
            $tca3 += $ca3;
            $tca2 += $ca2;
            $tca1 += $ca1;
            $tca += $caj;
            $cajour += $caf;
            $totalhebdo += $caT1;
        }
        $data = ['data' => $content, 'totalhebdo' => $totalhebdo, 'dat' => $dat, 'date' => $date, 'tca5' => $tca5, 'tca3' => $tca3, 'tca2' => $tca2, 'tca1' => $tca1, 'tca' => $tca, 'cajour' => $cajour,  'tca4' => $tca4];

    $this->render_view('hebdomadaire/detail',$data);   
}

public function detailLivre()
{
    $date = $this->input->post('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $mois = date('Y-m');

        $dt = new dateTime();
        $dt1 = new dateTime();
        $dt2 = new dateTime();
        $dt3 = new dateTime();
        $dt4 = new dateTime();
        $dt5 = new dateTime();
        $month = new DateTime();
        $dt->modify('-1day');
        $dt1->modify('-2day');
        $dt2->modify('-3day');
        $dt3->modify('-4day');
        $dt4->modify('-5day');
        $dt5->modify('-6day');
        $month->modify('-1month');
        $dat = $dt->format("Y-m-d");
        $dat1 = $dt1->format("Y-m-d");
        $dat2 = $dt2->format("Y-m-d");
        $dat3 = $dt3->format("Y-m-d");
        $dat4 = $dt4->format("Y-m-d");
        $dat5 = $dt5->format("Y-m-d");
        $month1 = $month->format("Y-m");
        $content = "";
        $tca3 = 0;
        $tca2 = 0;
        $tca1 = 0;
        $tca = 0;
        $cajour = 0;
        $camois = 0;
        $tca4 = 0;
        $tca5 = 0;
        $totalhebdo = 0;
        $datas = $this->accueil_model->page_list();
        foreach ($datas as $key => $datas) {
            $data = array();
            $produit = 0;
            $caf = 0;
            $cam = 0;
            $caj = 0;
            $ca1 = 0;
            $ca2 = 0;
            $ca3 = 0;
            $ca4 = 0;
            $ca5 = 0;
            $caT1 = 0;
            $facture = $this->accueil_model->ca_livre_page($datas->id, $dat4);
            $fact3 = $this->accueil_model->ca_livre1_page($dat3, $datas->id);
            $fact2 = $this->accueil_model->ca_livre2_page($dat2, $datas->id);
            $fact1 = $this->accueil_model->ca_livre3_page($dat1, $datas->id);
            $fact4 = $this->accueil_model->ca_livre4_page($date, $datas->id);
            $fact = $this->accueil_model->ca_livre5_page($dat, $datas->id);
            $fact5 = $this->accueil_model->ca_livre6_page($dat5, $datas->id);
            $factTOTAL = $this->accueil_model->ca_facture_total_livre_page($date, $dat5, $datas->id);
            foreach ($factTOTAL as $factTOTAL) {
                $produit += $factTOTAL->Quantite;
                $caT1 += ($factTOTAL->Quantite * $factTOTAL->Prix_detail);
            }
            foreach ($fact as $fact) {
                $caj += ($fact->Quantite * $fact->Prix_detail);
            }
            foreach ($fact5 as $fact5) {
                $ca5 += ($fact5->Quantite * $fact5->Prix_detail);
            }
            foreach ($fact4 as $fact4) {
                $caf += ($fact4->Quantite * $fact4->Prix_detail);
            }
            foreach ($fact1 as $fact1) {
                $ca1 += ($fact1->Quantite * $fact1->Prix_detail);
            }
            foreach ($fact2 as $fact2) {
                $ca2 += ($fact2->Quantite * $fact2->Prix_detail);
            }
            foreach ($facture as $facture) {
                $ca4 += ($facture->Quantite * $facture->Prix_detail);
            }
            foreach ($fact3 as $fact3) {
                $ca3 += ($fact3->Quantite * $fact3->Prix_detail);
            }
           
             $content .="<tr><td>" . strtoupper($datas->Nom_page) . "</td>
            <td><b style='font-size:10px;'>".strtoupper($datas->Type)."</b></td>
            <td class='text-right'><a href='#' class='produit'>" . number_format($caT1, 0, ',', ' ') . "</a></td>
            <td class='text-right'><a href='#'></a>" . number_format($caf, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($caj, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($ca1, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($ca2, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($ca3, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#'></a>" . number_format($ca4, 0, ',', ' ') . "</td>
            <td class='text-right'><a href='#' class='test1'></a>" . number_format($ca5, 0, ',', ' ') . "</td></tr>";

            $tca5 += $ca5;
            $tca4 += $ca4;
            $tca3 += $ca3;
            $tca2 += $ca2;
            $tca1 += $ca1;
            $tca += $caj;
            $cajour += $caf;
            $camois += $cam;
            $totalhebdo += $caT1;
        }
        $data = ['data' => $content, 'totalhebdo' => $totalhebdo, 'dat' => $dat, 'tca5' => $tca5, 'date' => $date, 'tca3' => $tca3, 'tca2' => $tca2, 'tca1' => $tca1, 'tca' => $tca, 'cajour' => $cajour, 'camois' => $camois, 'tca4' => $tca4];
    $this->render_view('hebdomadaire/detail',$data);   
}

public function detailParMatriculePrevi()
{
    
    $codeOplg = $this->input->post('codeOplg');
    $content="";
    $mois=date('Y-m');
    $value = $this->accueil_model->dateAchat($mois);
    $chiffreDaffaire = 0;
    $chiffreDaffaireVB= 0;
    $chiffreDaffaireVO= 0;
    $chiffreDaffaireVD= 0;
    $chiffreDaffaireVN= 0;
    $chiffreDaffaireVM= 0;
    $chiffreDaffaireVH= 0;
    $chiffreDaffaireCT= 0;
    $total = 0;
        foreach ($value as $key => $value) {            
            $facture =$this->accueil_model->CaParJourMois($value->Date, $codeOplg);
            $facturevb =$this->accueil_model->CaParJourMois($value->Date, "VB"."$codeOplg");
            $facturevo =$this->accueil_model->CaParJourMois($value->Date, "VO"."$codeOplg");
            $facturevd =$this->accueil_model->CaParJourMois($value->Date, "VD"."$codeOplg");
            $facturevn =$this->accueil_model->CaParJourMois($value->Date, "VN"."$codeOplg");
            $facturevm =$this->accueil_model->CaParJourMois($value->Date, "VM"."$codeOplg");
            $facturevh =$this->accueil_model->CaParJourMois($value->Date, "VH"."$codeOplg");
            $facturect =$this->accueil_model->CaParJourMois($value->Date, "CT"."$codeOplg");
            $chiffreDaffaire = $facture->CA;  
            $chiffreDaffaireVB=$facturevb->CA;
            $chiffreDaffaireVO=$facturevo->CA;
            $chiffreDaffaireVD=$facturevd->CA; 
            $chiffreDaffaireVN=$facturevn->CA;
            $chiffreDaffaireVM=$facturevm->CA;
            $chiffreDaffaireVH=$facturevh->CA;
            $chiffreDaffaireCT=$facturect->CA;
            $total +=$chiffreDaffaire;      
            $content .= "<tr>
            <td><a href='#'></a>".$value->Date."</td>
            <td class='text-right'>".number_format($chiffreDaffaire, 0, ',', ' ') ."</td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVB, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVD, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVO, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVN, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVM, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVH, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireCT, 0, ',', ' ') ."</a></td></tr>";
            }

     $data =[
            'infoclient'=>$this->accueil_model->CodeOperatrice($codeOplg),
            'result'=>$this->accueil_model->timeline($this->input->post('matricule')),
            'resultat'=>$content,
            'total'=>$total

        ]; 
    $this->load->view('hebdomadaire/detailParMatricule',$data);
}

public function detailParMatriculeP()
    {
        $this->load->model('accueil_model');        
        $matricule = $this->input->get('matricule');
        $content="";
        $mois=date('Y-m');
        $value = $this->accueil_model->dateAchat($mois);   
        $data =array();
        $chiffreDaffaire = 0;
        $chiffreDaffaireVB= 0;
        $chiffreDaffaireVO= 0;
        $chiffreDaffaireVD= 0;
        $chiffreDaffaireVN= 0;
        $chiffreDaffaireVM= 0;
        $chiffreDaffaireVH= 0;
        $chiffreDaffaireCT= 0;
        foreach ($value as $row) {
        $facture =$this->accueil_model->CaParJourMois($row->Date, $matricule);
        $facturevb =$this->accueil_model->CaParJourMois($row->Date, "VB"."$matricule");
            $facturevo =$this->accueil_model->CaParJourMois($row->Date, "VO"."$matricule");
            $facturevd =$this->accueil_model->CaParJourMois($row->Date, "VD"."$matricule");
            $facturevn =$this->accueil_model->CaParJourMois($row->Date, "VN"."$matricule");
            $facturevm =$this->accueil_model->CaParJourMois($row->Date, "VM"."$matricule");
            $facturevh =$this->accueil_model->CaParJourMois($row->Date, "VH"."$matricule");
            $facturect =$this->accueil_model->CaParJourMois($row->Date, "CT"."$matricule");
            $chiffreDaffaire = $facture->CA;  
            $chiffreDaffaireVB=$facturevb->CA;
            $chiffreDaffaireVO=$facturevo->CA;
            $chiffreDaffaireVD=$facturevd->CA; 
            $chiffreDaffaireVN=$facturevn->CA;
            $chiffreDaffaireVM=$facturevm->CA;
            $chiffreDaffaireVH=$facturevh->CA;
            $chiffreDaffaireCT=$facturect->CA;
            $chiffreDaffaire = $facture->CA; 
            $sub_array= array();
            $sub_array[] = $row->Date;
            $sub_array[] = "<a href='#'>".number_format($chiffreDaffaire, 0, ',', ' ')."</a>";
            $sub_array[] = "<a href='#'>".number_format($chiffreDaffaireVB, 0, ',', ' ')."</a>";
            $sub_array[] = "<a href='#'>".number_format($chiffreDaffaireVD, 0, ',', ' ')."</a>";
            $sub_array[] = "<a href='#'>".number_format($chiffreDaffaireVO, 0, ',', ' ')."</a>";
            $sub_array[] = "<a href='#'>".number_format($chiffreDaffaireVN, 0, ',', ' ')."</a>";
            $sub_array[] = "<a href='#'>".number_format($chiffreDaffaireVM, 0, ',', ' ')."</a>";
            $sub_array[] = "<a href='#'>".number_format($chiffreDaffaireVH, 0, ',', ' ')."</a>";
            $sub_array[] = "<a href='#'>".number_format($chiffreDaffaireCT, 0, ',', ' ')."</a>";
                 
            $data[] = $sub_array;
            }
            $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }  


    public function detailParMatriculeR()
    {
        $this->load->model('accueil_model');        
        $matricule = $this->input->get('matricule');
        $content="";
        $mois=date('Y-m');
        $value = $this->accueil_model->dateAchat($mois);   
        $data =array();
        $chiffreDaffaire = 0;
        $chiffreDaffaireVB= 0;
        $chiffreDaffaireVO= 0;
        $chiffreDaffaireVD= 0;
        $chiffreDaffaireVN= 0;
        $chiffreDaffaireVM= 0;
        $chiffreDaffaireVH= 0;
        $chiffreDaffaireCT= 0;
        foreach ($value as $row) {
        $facture =$this->accueil_model->CaParJourMoisReel($row->Date, $matricule);
        $facturevb =$this->accueil_model->CaParJourMoisReel($row->Date, "VB"."$matricule");
            $facturevo =$this->accueil_model->CaParJourMoisReel($row->Date, "VO"."$matricule");
            $facturevd =$this->accueil_model->CaParJourMoisReel($row->Date, "VD"."$matricule");
            $facturevn =$this->accueil_model->CaParJourMoisReel($row->Date, "VN"."$matricule");
            $facturevm =$this->accueil_model->CaParJourMoisReel($row->Date, "VM"."$matricule");
            $facturevh =$this->accueil_model->CaParJourMoisReel($row->Date, "VH"."$matricule");
            $facturect =$this->accueil_model->CaParJourMoisReel($row->Date, "CT"."$matricule");
            $chiffreDaffaire = $facture->CA;  
            $chiffreDaffaireVB=$facturevb->CA;
            $chiffreDaffaireVO=$facturevo->CA;
            $chiffreDaffaireVD=$facturevd->CA; 
            $chiffreDaffaireVN=$facturevn->CA;
            $chiffreDaffaireVM=$facturevm->CA;
            $chiffreDaffaireVH=$facturevh->CA;
            $chiffreDaffaireCT=$facturect->CA;
            $chiffreDaffaire = $facture->CA; 
            $sub_array= array();
            $sub_array[] = $row->Date;
            $sub_array[] = number_format($chiffreDaffaire, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireVB, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireVD, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireVO, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireVN, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireVM, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireVH, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireCT, 0, ',', ' ');
                 
            $data[] = $sub_array;
            }
            $output = array(
            "data" => $data
        );
        echo json_encode($output);
    } 

    public function detailParMatriculeL()
    {
        $this->load->model('accueil_model');        
        $matricule = $this->input->get('matricule');
        $content="";
        $mois=date('Y-m');
        $value = $this->accueil_model->dateAchat($mois);   
        $data =array();
        $chiffreDaffaire = 0;
        $chiffreDaffaireVB= 0;
        $chiffreDaffaireVO= 0;
        $chiffreDaffaireVD= 0;
        $chiffreDaffaireVN= 0;
        $chiffreDaffaireVM= 0;
        $chiffreDaffaireVH= 0;
        $chiffreDaffaireCT= 0;
        foreach ($value as $row) {
        $facture =$this->accueil_model->CaParJourMoisLivre($row->Date, $matricule);
        $facturevb =$this->accueil_model->CaParJourMoisLivre($row->Date, "VB"."$matricule");
            $facturevo =$this->accueil_model->CaParJourMoisLivre($row->Date, "VO"."$matricule");
            $facturevd =$this->accueil_model->CaParJourMoisLivre($row->Date, "VD"."$matricule");
            $facturevn =$this->accueil_model->CaParJourMoisLivre($row->Date, "VN"."$matricule");
            $facturevm =$this->accueil_model->CaParJourMoisLivre($row->Date, "VM"."$matricule");
            $facturevh =$this->accueil_model->CaParJourMoisLivre($row->Date, "VH"."$matricule");
            $facturect =$this->accueil_model->CaParJourMoisLivre($row->Date, "CT"."$matricule");
            $chiffreDaffaire = $facture->CA;  
            $chiffreDaffaireVB=$facturevb->CA;
            $chiffreDaffaireVO=$facturevo->CA;
            $chiffreDaffaireVD=$facturevd->CA; 
            $chiffreDaffaireVN=$facturevn->CA;
            $chiffreDaffaireVM=$facturevm->CA;
            $chiffreDaffaireVH=$facturevh->CA;
            $chiffreDaffaireCT=$facturect->CA;
            $chiffreDaffaire = $facture->CA; 
            $sub_array= array();
            $sub_array[] = $row->Date;
            $sub_array[] = number_format($chiffreDaffaire, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireVB, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireVD, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireVO, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireVN, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireVM, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireVH, 0, ',', ' ');
            $sub_array[] = number_format($chiffreDaffaireCT, 0, ',', ' ');
                 
            $data[] = $sub_array;
            }
            $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }  

public function details_operatrice()
{
    $this->load->model('accueil_model');
    $data =array();
    $infoclient = $this->accueil_model->CodeOperatrice($this->input->post('matricule'));
    $data['info_opl'] = $infoclient;
   /* foreach ($infoclient as $row) { 
        $sub_array= array();
        $sub_array[] = $row->Prenom;
                 
        $data[] = $sub_array;
    }
      $json = array(
            "data" => $data
        );   
    echo json_encode($json);*/
    $this->load->view('hebdomadaire/info_opl',$data);
}

public function detailParMatriculeReel()
{
    
    $codeOplg = $this->input->post('codeOplg');
    $content="";
    $mois=date('Y-m');
    $value = $this->accueil_model->dateAchat($mois);
    $chiffreDaffaire = 0;
    $chiffreDaffaireVB= 0;
    $chiffreDaffaireVO= 0;
    $chiffreDaffaireVD= 0;
    $chiffreDaffaireVN= 0;
    $chiffreDaffaireVM= 0;
    $chiffreDaffaireVH= 0;
    $chiffreDaffaireCT= 0;
    $total = 0;
        foreach ($value as $key => $value) {            
            $facture =$this->accueil_model->CaParJourMoisReel($value->Date, $codeOplg);
            $facturevb =$this->accueil_model->CaParJourMoisReel($value->Date, "VB"."$codeOplg");
            $facturevo =$this->accueil_model->CaParJourMoisReel($value->Date, "VO"."$codeOplg");
            $facturevd =$this->accueil_model->CaParJourMoisReel($value->Date, "VD"."$codeOplg");
            $facturevn =$this->accueil_model->CaParJourMoisReel($value->Date, "VN"."$codeOplg");
            $facturevm =$this->accueil_model->CaParJourMoisReel($value->Date, "VM"."$codeOplg");
            $facturevh =$this->accueil_model->CaParJourMoisReel($value->Date, "VH"."$codeOplg");
            $facturect =$this->accueil_model->CaParJourMoisReel($value->Date, "CT"."$codeOplg");
            $chiffreDaffaire = $facture->CA;  
            $chiffreDaffaireVB=$facturevb->CA;
            $chiffreDaffaireVO=$facturevo->CA;
            $chiffreDaffaireVD=$facturevd->CA; 
            $chiffreDaffaireVN=$facturevn->CA;
            $chiffreDaffaireVM=$facturevm->CA;
            $chiffreDaffaireVH=$facturevh->CA;
            $chiffreDaffaireCT=$facturect->CA;
            $total +=$chiffreDaffaire;      
            $content .= "<tr>
            <td><a href='#'></a>".$value->Date."</td>
            <td class='text-right'>".number_format($chiffreDaffaire, 0, ',', ' ') ."</td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVB, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVD, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVO, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVN, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVM, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVH, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireCT, 0, ',', ' ') ."</a></td></tr>";
            }

     $data =[
            'infoclient'=>$this->accueil_model->CodeOperatrice($codeOplg),
            'result'=>$this->accueil_model->timeline($this->input->post('matricule')),
            'resultat'=>$content,
            'total'=>$total

        ]; 
    $this->load->view('hebdomadaire/detailParMatricule',$data);
}

public function detailParMatriculeLivre()
{
    
    $codeOplg = $this->input->post('codeOplg');
    $content="";
    $mois=date('Y-m');
    $value = $this->accueil_model->dateAchat($mois);
    $chiffreDaffaire = 0;
    $chiffreDaffaireVB= 0;
    $chiffreDaffaireVO= 0;
    $chiffreDaffaireVD= 0;
    $chiffreDaffaireVN= 0;
    $chiffreDaffaireVM= 0;
    $chiffreDaffaireVH= 0;
    $chiffreDaffaireCT= 0;
    $total = 0;
        foreach ($value as $key => $value) {            
            $facture =$this->accueil_model->CaParJourMoisLivre($value->Date, $codeOplg);
            $facturevb =$this->accueil_model->CaParJourMoisLivre($value->Date, "VB"."$codeOplg");
            $facturevo =$this->accueil_model->CaParJourMoisLivre($value->Date, "VO"."$codeOplg");
            $facturevd =$this->accueil_model->CaParJourMoisLivre($value->Date, "VD"."$codeOplg");
            $facturevn =$this->accueil_model->CaParJourMoisLivre($value->Date, "VN"."$codeOplg");
            $facturevm =$this->accueil_model->CaParJourMoisLivre($value->Date, "VM"."$codeOplg");
            $facturevh =$this->accueil_model->CaParJourMoisLivre($value->Date, "VH"."$codeOplg");
            $facturect =$this->accueil_model->CaParJourMoisLivre($value->Date, "CT"."$codeOplg");
            $chiffreDaffaire = $facture->CA;  
            $chiffreDaffaireVB=$facturevb->CA;
            $chiffreDaffaireVO=$facturevo->CA;
            $chiffreDaffaireVD=$facturevd->CA; 
            $chiffreDaffaireVN=$facturevn->CA;
            $chiffreDaffaireVM=$facturevm->CA;
            $chiffreDaffaireVH=$facturevh->CA;
            $chiffreDaffaireCT=$facturect->CA;
            $total +=$chiffreDaffaire;      
            $content .= "<tr>
            <td><a href='#'></a>".$value->Date."</td>
            <td class='text-right'>".number_format($chiffreDaffaire, 0, ',', ' ') ."</td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVB, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVD, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVO, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVN, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVM, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireVH, 0, ',', ' ') ."</a></td>
            <td class='text-right'><a href='#'>".number_format($chiffreDaffaireCT, 0, ',', ' ') ."</a></td></tr>";
            }

     $data =[
            'infoclient'=>$this->accueil_model->CodeOperatrice($codeOplg),
            'result'=>$this->accueil_model->timeline($this->input->post('matricule')),
            'resultat'=>$content,
            'total'=>$total

        ]; 
    $this->load->view('hebdomadaire/detailParMatricule',$data);
}

public function totalPro()
    {
       $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = date("Y-m-d");
        $dt5 = new dateTime();
        $dt5->modify('-6day'); 
        $dat5 = $dt5->format("Y-m-d");
        $facture = $this->accueil_model->totalProduit($matricule,$dat5, $date);
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

public function totalProds()
    {
       $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $date = date("Y-m-d");
        $dt5 = new dateTime();
        $dt5->modify('-6day'); 
        $dat5 = $dt5->format("Y-m-d");
        $facture = $this->accueil_model->totalProduits($dat5, $date);
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

public function detailcaf()
    {
       $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
       $date = date("Y-m-d");
        $facture = $this->accueil_model->totalProduit($matricule, $dateD, $dateF);
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

public function detailca1()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $dt1 = new dateTime();
        $dt1->modify('-2day');
        $date = $dt1->format("Y-m-d");
        $facture = $this->accueil_model->ca_facture_opl($matricule, $date);
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

public function detailcaj()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $dt1 = new dateTime();
        $dt1->modify('-1day');
        $date = $dt1->format("Y-m-d");
        $facture = $this->accueil_model->ca_facture_opl($matricule, $date);
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


    public function detailca2()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $dt1 = new dateTime();
        $dt1->modify('-3day');
        $date = $dt1->format("Y-m-d");
        $facture = $this->accueil_model->ca_facture_opl($matricule, $date);
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

    public function detailca3()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $dt1 = new dateTime();
        $dt1->modify('-4day');
        $date = $dt1->format("Y-m-d");
        $facture = $this->accueil_model->ca_facture_opl($matricule, $date);
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

    public function detailca4()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $dt1 = new dateTime();
        $dt1->modify('-5day');
        $date = $dt1->format("Y-m-d");
        $facture = $this->accueil_model->ca_facture_opl($matricule, $date);
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

    public function detailca5()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $dt1 = new dateTime();
        $dt1->modify('-6day');
        $date = $dt1->format("Y-m-d");
        $facture = $this->accueil_model->ca_facture_opl($matricule, $date);
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


    public function detailcafR()
    {
       $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
       $date = date("Y-m-d");
        $facture = $this->accueil_model->rapport_ca_oplivreR($date, $matricule);
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

public function detailca1R()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $dt1 = new dateTime();
        $dt1->modify('-2day');
        $date = $dt1->format("Y-m-d");
        $facture = $this->accueil_model->rapport_ca_oplivreR($date, $matricule);
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

public function detailcajR()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $dt1 = new dateTime();
        $dt1->modify('-1day');
        $date = $dt1->format("Y-m-d");
        $facture = $this->accueil_model->rapport_ca_oplivreR($date, $matricule);
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


    public function detailca2R()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $dt1 = new dateTime();
        $dt1->modify('-3day');
        $date = $dt1->format("Y-m-d");
        $facture = $this->accueil_model->rapport_ca_oplivreR($date, $matricule);
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

    public function detailca3R()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $dt1 = new dateTime();
        $dt1->modify('-4day');
        $date = $dt1->format("Y-m-d");
        $facture = $this->accueil_model->rapport_ca_oplivreR($date, $matricule);
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

    public function detailca4R()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $dt1 = new dateTime();
        $dt1->modify('-5day');
        $date = $dt1->format("Y-m-d");
        $facture = $this->accueil_model->rapport_ca_oplivreR($date, $matricule);
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

    public function detailca5R()
    {
        $this->load->model('accueil_model');
        $matricule = $this->input->post('matricule');
        $dt1 = new dateTime();
        $dt1->modify('-6day');
        $date = $dt1->format("Y-m-d");
        $facture = $this->accueil_model->rapport_ca_oplivreR($date, $matricule);
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
  public function par_matricule(){
    $this->load->model('accueil_model');
     $date = $this->input->post('date');
         if(!isset($date) OR empty($date)){
            $date = date("Y-m-d");
         }
    $data = [ "datas" => $this->accueil_model->listeDesOplg(),"date"=>$date];
     
    $this->render_view('chiffre_d_affaire/par_matricule', $data);

   }
    public function par_page(){
        $this->load->model('client_model');
         $date = $this->input->post('date');
         if(!isset($date) OR empty($date)){
            $date = date("Y-m-d");
         }
        
        $data = ["data"=>$this->client_model->get_page_facture("facture.Date = '$date'"),"date"=>$date];
        $this->render_view('chiffre_d_affaire/par_page', $data);
   }

   public function par_mensuel(){
        $date = $this->input->post('date');
         if(!isset($date) OR empty($date)){
            $date = date("Y-m-d");
         }
        
         $data = ["date"=> $this->dateDuMois(),"dt"=>$date];
        $this->render_view('chiffre_d_affaire/par_date', $data);
    
   }

   public function get_detail_ca_par_heure(){
      $date = $this->input->post('date');
      $type = $this->input->post('type');
     
      switch ($type) {
        case 'detail page':
            $data =["data"=>$this->client_model->get_page_facture("facture.Date = '$date'"),"date"=>$date];
            $this->load->view('chiffre_d_affaire/detail_par_page_tranche_d_heure',$data);
            break;
        case 'detail matricule':
            $data =["data"=>$this->client_model->get_ca_haours_client("facture.Date = '$date'"),"date"=>$date];
            $this->load->view('chiffre_d_affaire/detail_par_matricule_tranche_d_heure',$data);  
            break;
        default:
            echo "Aucun donnée trouvée";
            break;
      }
      
      
      
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

}
