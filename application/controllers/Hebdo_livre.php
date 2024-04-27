<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hebdo_livre extends My_Controller
{

    public function index()
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
        $tcamonth = 0;
        $datas = $this->accueil_model->table_ca1($mois);


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
            $camonth = 0;

            $facture = $this->accueil_model->ca_oplivre($datas->Prenom, $dat4);
            $factur = $this->accueil_model->ca_facture_oplivr($mois, $datas->Prenom);

            $fact3 = $this->accueil_model->ca_facture_jour3l($dat3, $datas->Prenom);
            $fact2 = $this->accueil_model->ca_facture_jour2l($dat2, $datas->Prenom);
            $fact1 = $this->accueil_model->ca_facture_jour1l($dat1, $datas->Prenom);
            $fact4 = $this->accueil_model->ca_facture_jour($date, $datas->Prenom);
            $fact = $this->accueil_model->ca_facture_jour_passel($dat, $datas->Prenom);
            $fact5 = $this->accueil_model->ca_facture5($dat5, $datas->Prenom);
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
            foreach ($factur as $factur) {
                $cam += ($factur->Quantite * $factur->Prix_detail);
            }
            foreach ($facture as $facture) {
                $ca4 += ($facture->Quantite * $facture->Prix_detail);
            }
            foreach ($fact3 as $fact3) {
                $ca3 += ($fact3->Quantite * $fact3->Prix_detail);
            }
            $content .= "<tr text><td style='font-size:10px'>" . strtoupper($datas->Prenom) . "</td><td style='font-size:10px'>" . substr($datas->Matricule, 0, 7) . "</td><td class='text-center' style='font-size:10px'>" . number_format($ca5, 0, ',', ' ') . "</td><td class='text-center' style='font-size:10px'>" . number_format($ca4, 0, ',', ' ') . "</td><td class='text-center' style='font-size:10px'>" . number_format($ca3, 0, ',', ' ') . "</td><td class='text-center' style='font-size:10px'>" . number_format($ca2, 0, ',', ' ') . "</td><td class='text-center' style='font-size:10px'>" . number_format($ca1, 0, ',', ' ') . "</td><td class='text-center' style='font-size:10px'>" . number_format($caj, 0, ',', ' ') . "</td><td class='text-center' style='font-size:10px'>" . number_format($caf, 0, ',', ' ') . "</td></tr>";
            $tca5 += $ca5;
            $tca4 += $ca4;
            $tca3 += $ca3;
            $tca2 += $ca2;
            $tca1 += $ca1;
            $tca += $caj;
            $cajour += $caf;
            $camois += $cam;
            $tcamonth += $camonth;
        }
        $data = ['data' => $content, 'tcamonth' => $tcamonth, 'dat' => $dat, 'tca5' => $tca5, 'tca3' => $tca3, 'tca2' => $tca2, 'tca1' => $tca1, 'tca' => $tca, 'cajour' => $cajour, 'camois' => $camois, 'tca4' => $tca4];


        $this->render_view('Semaine/hebdo_livre', $data);
    }
}
