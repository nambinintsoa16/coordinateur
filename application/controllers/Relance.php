<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Relance extends My_Controller
{

    public function index()
    {
    }
    public function rapportRelance()
    {
         $this->load->model('Client_model');
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
		

		

		$datas = $this->accueil_model->listeDesOplg();
		foreach ($datas as $key => $datas) {
            $page = $this->accueil_model->codification_page($datas->Matricule);
            if ($page) {
              $page_name = $page->Code_page;
              $page_id = $page->id;
            } else {
              $page_name = "";
               $page_id = "";
            }
            $relance_Preve = $this->Client_model->selectsRelanceDiscussion(["PageRD"=> $page_id ,"DateRD"=>$date,'Type'=>"Relance sans achat"]);
            $relance_fait = $this->Client_model->selectsRelanceDiscussion(["PageRD"=> $page_id ,"DateRD"=>$date,"statuRelanceRD"=>'off','Type'=>"Relance sans achat"]);
            $relance_fait_pas = $this->Client_model->selectsRelanceDiscussion(["PageRD"=> $page_id ,"DateRD"=>$date,"statuRelanceRD"=>'on','Type'=>"Relance sans achat"]);
            $relance_global = $this->Client_model->selectsRelanceDiscussion(["PageRD"=> $page_id ,"statuRelanceRD"=>'on','Type'=>"Relance sans achat"]);
            $relance_global_realise = $this->Client_model->selectsRelanceDiscussion(["PageRD"=> $page_id ,"statuRelanceRD"=>'off','Type'=>"Relance sans achat"]);

            
			$content .= "<tr><td class='collapse'>". $datas->Matricule. "</td>
			<td style='font-size:12px'><a href='#' class='nompages'>" . substr($datas->Matricule, 0, 7). "</td>
			<td class='text-left' style='font-size:12px'><a href='#' class='nompages'>" . $datas->Prenom. "</td>
            <td class='text-left' style='font-size:12px'><a href='#' class='nompages'>" . $page_name."</td>
			<td class='text-right' style='font-size:12px'>". number_format(count($relance_Preve), 0, ',', ' ') . "</td>
			<td class='text-right' style='font-size:12px'>" . number_format(count($relance_fait), 0, ',', ' ') . "</td>
            <td class='text-right' style='font-size:12px'>" . number_format(count($relance_fait_pas ), 0, ',', ' ') . "</td>
            <td class='text-right' style='font-size:12px'>" . number_format(count($relance_global), 0, ',', ' ') . "</a></td>
            <td class='text-right' style='font-size:12px'>" . number_format(count($relance_global_realise), 0, ',', ' ') . "</a></td>
            <td class='text-right' style='font-size:12px'>" . number_format(count($relance_global)-count($relance_global_realise), 0, ',', ' ') . "</td>
			<td class='text-right'>" . number_format(0, 2, ',', ' ') . "</td></tr>";
			
		}
        $data = [
        'data' => $content,
        'date'=>$date
        ];
        $this->render_view('relance/rapport',$data);
    }

     public function detailParMatricule()
    {
        $this->load->model('accueil_model');        
        $matricule = $this->input->get('matricule');        
        $mois=date('Y-m');
        $value = $this->accueil_model->listePageOn( $matricule);   
        $data =array();
        foreach ($value as $row) {           
            $sub_array= array();
            $sub_array[] = $row->Code_page;
            $sub_array[] = strtolower($row->Nom_page);
            $sub_array[] = number_format($caprevi, 0, ',', ' ');
                 
            $data[] = $sub_array;
            }
            $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }  
}
