<?php
class Accueil_model extends CI_Model
{
	public function __construct()
	{
	}
	public function opl_liste($mois)
	{
		$this->db->group_by('facture.Matricule_personnel');
		//$this->db->distinct();
		$this->db->select('facture.Matricule_personnel,personnel.Prenom,personnel.Matricule');
		$this->db->like('facture.Date', $mois, 'after');
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('facture')->result_object();
	}

	public function liste_operatrice($mois)
	{
		$this->db->group_by('session.operatrice');
		//$this->db->distinct();
		$this->db->where('(session.operatrice LIKE "VB%" OR session.operatrice LIKE "VH%" OR session.operatrice LIKE "CT%" OR session.operatrice LIKE "VK%" OR session.operatrice LIKE "VN%" OR operatrice LIKE "VD%" OR operatrice LIKE "VO%" OR operatrice LIKE "VM%" )');
		$this->db->select('session.operatrice,personnel.Prenom,personnel.Matricule');
		$this->db->like('session.Date', $mois, 'after');
		//$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('personnel', 'session.operatrice=personnel.Matricule');
		return $this->db->get('session')->result_object();
	}

	public function opl_listes($mois)
	{
		$this->db->group_by('personnel.Matricule');
		//$this->db->distinct();
		$this->db->select('facture.Matricule_personnel,personnel.Prenom,personnel.Matricule');
		$this->db->like('facture.Date', $mois, 'after');
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('facture')->result_object();
	}

	public function opl_list($date)
	{
		$this->db->group_by('personnel.Prenom');
		//$this->db->distinct();
		$this->db->select('facture.Matricule_personnel,personnel.Prenom,personnel.Matricule');
		$this->db->like('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('facture')->result_object();
	}
	public function opl_liste2($mois)
	{
		
		$this->db->distinct();
		$this->db->select('facture.Matricule_personnel,personnel.Prenom,personnel.Matricule');
		$this->db->like('facture.Date', $mois, 'after');
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('facture')->result_object();
	}	

	public function opl_nv($mois)
	{
		
		$this->db->distinct();
		$this->db->select('facture.Matricule_personnel,personnel.Prenom,personnel.Matricule');
		$this->db->like('facture.Date', $mois,'after');
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('facture')->result_object();
	}
	public function pageuser($mois)
	{
		$this->db->distinct('comptefb.Nom_page');		
		$this->db->select('facture.Matricule_personnel,personnel.Prenom,personnel.Matricule,comptefb.Nom_page');
		$this->db->like('facture.Date', $mois, 'after');
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('comptefb', 'facture.Page=comptefb.id');
		$this->db->join('page_fb', 'page_fb.Lien_page=comptefb.Lien_page');	
		return $this->db->get('facture')->result_object();
	}

	public function  users($matricule)
	{
		$this->db->select('Prenom');
		$this->db->where('matricule', $matricule);
		return $this->db->get('personnel')->row_object();
	}
	public function groupeuser($opl=FALSE)
	{
		$this->db->select('page_fb.Nom_page,page_fb.Lien_page');
		$this->db->join('personnel', 'personnel.Matricule=page_fb.operatrice');
		$this->db->where('page_fb.operatrice', $opl);
		//$this->db->where('personnel.Matricule', $user);
		$this->db->where('page_fb.statut', 'on');
		return $this->db->get('page_fb')->row_object();
	}


	public function namepage($prenom)
	{
		$this->db->select('comptefb.id,page_fb.Nom_page,page_fb.Lien_page');
		$this->db->join('personnel', 'personnel.Matricule=page_fb.operatrice');
		$this->db->join('comptefb', 'page_fb.Lien_page=comptefb.Lien_page');
		$this->db->where('page_fb.operatrice', $prenom);
		//$this->db->where('personnel.Matricule', $user);
		$this->db->where('page_fb.statut', 'on');
		return $this->db->get('page_fb')->result_object();
	}


	public function totalchiffre_d_affaires($date)
	{

		$this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->like('facture.Date', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
		public function totalsomme($date)
	{
		$this->db->select('facture.Date,detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->like('livraison.date_de_livraison', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}


	public function total_chiffre_d_affaires_reel_non_livre($date)
	{
		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('facture.data_de_livraison', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->where('facture.Status', "confirmer");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function chiffre_d_affaires_reel_du_jour($date, $opl)
	{
		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_reel_du_jour($opls, $date)
	{
		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, produit.Designation,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opls);
		$this->db->like('facture.Date', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function previlivre($opls, $date)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,produit.Designation, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opls);
		$this->db->where('livraison.date_de_livraison', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}



	
	public function total_ca_reel_du_jour($date)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,produit.Designation, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->like('facture.Date', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

		


	public function ca_facture($opls, $date)
	{
		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, produit.Designation,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opls);
		//$this->db->like('facture.Date', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->like('livraison.date_de_livraison', $date);
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function chiffre_d_affaires_livre($date, $opls)
	{

		$this->db->select('facture.Date,facture.Val_bon_achat, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opls);
		$this->db->like('livraison.date_de_livraison', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function chiffre_d_affaires_livre_reporte($date, $opls)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opls);
		$this->db->like('livraison.dateRep', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}


	public function ca_facture_op1($opls, $date)
	{
		$this->db->select('detailvente.statut, facture.Matricule_personnel, produit.Designation,detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Val_bon_achat, facture.Matricule_personnel');
		$this->db->where('facture.Matricule_personnel', $opls);
		$this->db->where('facture.date',$date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->where('facture.Status', "confirmer");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	

	
	

	public function login($pass, $user)
	{
		$this->db->where('Mode_de_pass_login ', $pass);
		$this->db->where('Matricule', $user);
		return $this->db->get('personnel')->row_object();
	}
	public function  user($matricule)
	{
		$this->db->select('Prenom');
		$this->db->where('matricule', $matricule);
		return $this->db->get('personnel')->row_object();
	}
	public function S2($dateD = null, $dateF = null, $opl)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function S3($dateD = null, $dateF = null)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		//$this->db->where('personnel.Prenom', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	//////////////////////////////////////////////////////////LIVRE////////////////////////////////////////////////////////////////////
	public function livre($dateD = null, $dateF = null, $opl)
	{
		$this->db->select('facture.Date, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where("livraison.date_de_livraison BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function livre1($dateD = null, $dateF = null)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		//$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where("livraison.date_de_livraison BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	//////////////////////////////////////////////////////////REEL////////////////////////////////////////////////////////////////////
	public function reel($dateD = null, $dateF = null, $opl)
	{
		$this->db->select('facture.Date, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function reel1($dateD = null, $dateF = null)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		//$this->db->where('personnel.Prenom', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_de_vente($date, $status = FALSE, $user = FALSE)
	{
		//$dt = new dateTime($date);
		//$dte = $dt->format('Y-m-d');
		$this->db->select('detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->where('facture.Date', $date);
		if ($status != FALSE) {
			$this->db->where('facture.Status', $status);
		}
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		if ($user == FALSE) {
			$this->db->where('facture.Matricule_personnel', $this->session->userdata('matricule'));
		} else {
			$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		}
	}
	///////////////////////////////////////produit user hebdomadaire/////////////////////////////////////////////
	public function produits($opls, $dt5)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('personnel.Prenom', $opls);
		$this->db->where('facture.Date', $dt5);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_de_vent($dt5, $status = FALSE, $user = FALSE)
	{
		$dt5 = new dateTime();
		$dt5->modify('-6day');

		$this->db->select('detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->where('facture.Date', $dt5);
		if ($status != FALSE) {
			$this->db->where('facture.Status', $status);
		}
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		if ($user == FALSE) {
			$this->db->where('facture.Matricule_personnel', $this->session->userdata('matricule'));
		} else {
			$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		}
	}
	public function produittotal($date)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		//$this->db->where('facture.Matricule_personnel',$oplg);
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function ca_facture_opl_total($date)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Code_produit,produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_op($opls, $date)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('personnel.Prenom', $opls);
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	
	

	
	public function ca_facture_opls($date,$opls)
	{
		$this->db->select('detailvente.statut, facture.Matricule_personnel, produit.Designation,detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('livraison.date_de_livraison', $date);
		$this->db->where('facture.Matricule_personnel', $opls);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->where('facture.Status', "confirmer");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}



	public function chiffre_d_affaires_reel_non_livre($date, $opl)
	{
		$this->db->select('facture.Date, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where('livraison.date_de_livraison', $date);
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "confirmer");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');		
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_op1_total($date)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('livraison.date_de_livraison', $date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->where('facture.Status', "confirmer");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}


	public function chiffre_d_affaires_livr($date)
	{
		$this->db->select('facture.Date, detailvente.statut, produit.Designation, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail');
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->like('livraison.date_de_livraison',$date);
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function detail_produit($dateD = null, $dateF = null, $opl)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where("livraison.date_de_livraison BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function detail_produits($dateD = null, $dateF = null)
	{
		$this->db->select('facture.Date, detailvente.statut, produit.Designation, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		//$this->db->where('personnel.Prenom', $opl);
		$this->db->where("livraison.date_de_livraison BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function detail_produit_previ($dateD = null, $dateF = null, $opl)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function detail_produit_reel($dateD = null, $dateF = null, $opl)
	{
		$this->db->select('detailvente.statut, facture.Matricule_personnel, facture.Val_bon_achat,produit.Designation,detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function detail_produit_reels($dateD = null, $dateF = null)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		//$this->db->where('personnel.Prenom', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function detail_produit_previs($dateD = null, $dateF = null)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel,facture.Val_bon_achat, produit.Designation,detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, facture.Val_bon_achat, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		//$this->db->where('personnel.Prenom', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function detail_produits_reels($dateD = null, $dateF = null)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Val_bon_achat, facture.Matricule_personnel');
		$this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		//$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_mensuel_previ($mois, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_mensuel_previsionnelle($mois, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_mensuel_previs($mois, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, facture.Val_bon_achat, detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_mensuel_reel($mois, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.data_de_livraison', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_mensuel_reels($mois, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_mensuel_reeltotal($mois)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatParMatriculePrevi($mois, $oplg)
	{

		$this->db->select('facture.Val_bon_achat, detailvente.statut,detailvente.Quantite,prix.Prix_detail');
		$this->db->like('facture.Matricule_personnel', $oplg);
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatParMatriculePagePrevi($mois, $oplg, $page)
	{

		$this->db->select('facture.Val_bon_achat, detailvente.statut,detailvente.Quantite,prix.Prix_detail');
		$this->db->like('facture.Matricule_personnel', $oplg);
		$this->db->like('facture.Date', $mois);
		$this->db->where('facture.Page', $page);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_mensuel_previtotal($mois)
	{
		$this->db->select('facture.Val_bon_achat, detailvente.statut,detailvente.Quantite,prix.Prix_detail');
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_mensuel_livre($mois, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('livraison.date_de_livraison', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_mensuel_livres($mois, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('livraison.date_de_livraison', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_mensuel_livretotal($mois)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->like('livraison.date_de_livraison', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function table_ca1($mois)
	{
		$this->db->group_by('personnel.Prenom');
		//$this->db->distinct();
		$this->db->select('facture.Matricule_personnel, facture.Val_bon_achat, personnel.Prenom,personnel.Matricule');
		$this->db->like('facture.Date', $mois, 'after');
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('facture')->result_object();
	}
	public function ca_opl($opl, $date)
	{
		$this->db->select('detailvente.statut,  facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix,prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_opl($opl, $date)
	{
		$this->db->select('detailvente.statut, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_ope($mois = null, $opl)
	{
		$mois = date('Y-m');
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $mois, 'after');
		/*if ($mois != null) {
      $this->db->like('facture.Date', $mois, 'after');
    } else {
      $this->db->where("(facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }*/
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_mois_passe($month1 = null, $opl)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $month1, 'after');
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_jour_passe($dat = null, $opl)
	{

		$this->db->select('facture.Date, detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $dat);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

		public function ca_facture_jour_passe_page($dat = null, $page)
	{

		$this->db->select('facture.Date, detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('facture.Date', $dat);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture_jour_passe($dat = null, $opl)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $dat);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_jour1($dat1 = null, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $dat1);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_jour1_page($dat1 = null, $page)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('facture.Date', $dat1);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function rapport_ca_facture_jour1($dat1 = null, $opl)
	{

		$this->db->select('facture.Date, detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $dat1);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

		public function ca_facture_jour2($dat2 = null, $opl)
	{

		$this->db->select('facture.Date, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $dat2);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_jour2_page($dat2 = null, $page)
	{

		$this->db->select('facture.Date, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('facture.Date', $dat2);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture_jour2($dat2 = null, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $dat2);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_jour3($dat3 = null, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $dat3);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_jour3_page($dat3 = null, $page)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('facture.Date', $dat3);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture_jour3($dat3 = null, $opl)
	{
		$this->db->select('facture.Date, detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $dat3);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_jour4($dat4 = null, $opl)
	{
		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $dat4);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_jour4_page($dat4 = null, $page)
	{
		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('facture.Date', $dat4);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture_jour4($dat4 = null, $opl)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $dat4);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_jour5($dat5 = null, $opl)
	{

		$this->db->select('facture.Date, detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $dat5);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_jour5_page($dat5 = null, $opl)
	{

		$this->db->select('facture.Date, detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $opl);
		$this->db->like('facture.Date', $dat5);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture_jour5($dat5 = null, $opl)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $dat5);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_total_previ($date, $dat5, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,  facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dat5 . "'AND'" . $date . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_total_previ_page($date, $dat5, $page)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,  facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->where("facture.Date BETWEEN '" . $dat5 . "'AND'" . $date . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture_total_previ($date, $dat5, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dat5 . "'AND'" . $date . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_total_reel($date, $dat5, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dat5 . "'AND'" . $date . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}


	public function ca_facture_total_reel_page($date, $dat5, $page)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->where("facture.Date BETWEEN '" . $dat5 . "'AND'" . $date . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture_total_reel($date, $dat5, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dat5 . "'AND'" . $date . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_oplivre($opl, $dat4 = null)
	{

		$this->db->select('facture.Date, detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $dat4);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_oplivre_page($page, $dat4 = null)
	{

		$this->db->select('facture.Date, detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('facture.Date', $dat4);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_oplivre($opl, $dat4 = null)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $dat4);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_oplivreR( $date = null, $opl)
	{
		$this->db->select('detailvente.statut,facture.Matricule_personnel,  facture.Val_bon_achat, produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->like('facture.Matricule_personnel', $opl);
		$this->db->where('facture.date',$date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->where('facture.Status', "livre");
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_oplivr($mois = null, $opl)
	{
		$mois = date('Y-m');
		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $mois, 'after');
		$this->db->where('facture.Status', "livre");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_jour3l($dat3 = null, $opl)
	{
		$this->db->select('facture.Date,  facture.Val_bon_achat, detailvente.statut,  facture.Val_bon_achat, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix,detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $dat3);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_jour3l_page($dat3 = null, $page)
	{
		$this->db->select('facture.Date,  facture.Val_bon_achat, detailvente.statut,  facture.Val_bon_achat, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix,detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('facture.Date', $dat3);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture_jour3l($dat3 = null, $opl)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $dat3);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_jour2l($dat2 = null, $opl)
	{

		$this->db->select('facture.Date, detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $dat2);
		$this->db->where('facture.Status', "livre");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_jour2l_page($dat2 = null, $page)
	{

		$this->db->select('facture.Date, detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('facture.Date', $dat2);
		$this->db->where('facture.Status', "livre");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture_jour2l($dat2 = null, $opl)
	{
		$this->db->select('facture.Date,  facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $dat2);
		$this->db->where('facture.Status', "livre");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_jour1l($dat1 = null, $opl)
	{
		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $dat1);
		$this->db->where('facture.Status', "livre");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_jour1l_page($dat1 = null, $page)
	{
		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('facture.Date', $dat1);
		$this->db->where('facture.Status', "livre");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function rapport_ca_facture_jour1l($dat1 = null, $opl)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $dat1);
		$this->db->where('facture.Status', "livre");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_jour($date, $opl)
	{
		$this->db->select('detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Status', "livre");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
		public function ca_facture_jour_page($date, $page)
	{
		$this->db->select('detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('facture.page', $page);
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Status', "livre");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture_jour($date, $opl)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix,prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Status', "livre");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_jour_passel($dat = null, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $dat);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture_jour_passel_page($dat = null, $page)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('facture.Date', $dat);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture_jour_passel($dat = null, $opl)
	{

		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $dat);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture5($dat5 = null, $opl)
	{

		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $dat5);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_facture5_page($dat5 = null, $page)
	{

		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('facture.Date', $dat5);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture5($dat5 = null, $opl)
	{

		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('facture.Date', $dat5);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_livre($opl, $dat4 = null)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('livraison.date_de_livraison', $dat4);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_livre_page($page, $dat4 = null)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('livraison.date_de_livraison', $dat4);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_livre($opl, $dat4 = null)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('livraison.date_de_livraison', $dat4);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function totalHebdoLivre($opl, $dateD,$date)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('facture.Matricule_personnel', $opl);
		$this->db->where("livraison.date_de_livraison BETWEEN '" . $dateD . "'AND'" . $date . "'");
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function totalHebdoLivres( $dateD,$date)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where("livraison.date_de_livraison BETWEEN '" . $dateD . "'AND'" . $date . "'");
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_livre1($dat3 = null, $opl)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('livraison.date_de_livraison', $dat3);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_livre1_page($dat3 = null, $page)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('livraison.date_de_livraison', $dat3);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_livre1($dat3 = null, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('livraison.date_de_livraison', $dat3);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_livre2($dat2 = null, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('livraison.date_de_livraison', $dat2);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_livre2_page($dat2 = null, $page)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('livraison.date_de_livraison', $dat2);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_livre2($dat2 = null, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('livraison.date_de_livraison', $dat2);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_livre3($dat1 = null, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('livraison.date_de_livraison', $dat1);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_livre3_page($dat1 = null, $page)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('livraison.date_de_livraison', $dat1);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function ca_livre4($date, $opl)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('livraison.date_de_livraison', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_livre4_page($date, $page)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('livraison.date_de_livraison', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_livre5($dat, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('livraison.date_de_livraison', $dat);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_livre5_page($dat, $page)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('livraison.date_de_livraison', $dat);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	
	public function ca_livre6($dat5 = null, $opl)
	{

		$this->db->select('facture.Date,  facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, facture.Val_bon_achat, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('livraison.date_de_livraison', $dat5);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_livre6_page($dat5 = null, $page)
	{

		$this->db->select('facture.Date,  facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, facture.Val_bon_achat, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->like('livraison.date_de_livraison', $dat5);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_livre3($dat1 = null, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('livraison.date_de_livraison', $dat1);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function rapport_ca_livre4($date, $opl)
	{
		$this->db->select('facture.Date, detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('livraison.date_de_livraison', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_livre5($dat, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('livraison.date_de_livraison', $dat);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	
	public function rapport_ca_livre6($dat5 = null, $opl)
	{

		$this->db->select('facture.Date, detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->like('livraison.date_de_livraison', $dat5);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_total_livre($date, $dat5, $opl)
	{

		$this->db->select('facture.Date, detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where("livraison.date_de_livraison BETWEEN '" . $dat5 . "'AND'" . $date . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_total_livre_page($date, $dat5, $page)
	{

		$this->db->select('facture.Date, detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.page', $page);
		$this->db->where("livraison.date_de_livraison BETWEEN '" . $dat5 . "'AND'" . $date . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function rapport_ca_facture_total_livre($date, $dat5, $opl)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('personnel.Prenom', $opl);
		$this->db->where("livraison.date_de_livraison BETWEEN '" . $dat5 . "'AND'" . $date . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function detail_produit_mois_previ($opls, $mois)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->like('facture.Matricule_personnel', $opls);
		$this->db->like('facture.Date', $mois);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function totalproduitprevi($mois)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix,prix.Prix_detail, facture.Matricule_personnel');
		$this->db->like('facture.Date', $mois);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function detail_produit_mois_reel($opls, $mois)
	{
		$this->db->select('detailvente.statut, facture.Matricule_personnel, produit.Designation,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix,prix.Prix_detail, facture.Val_bon_achat, facture.Matricule_personnel');
		$this->db->like('facture.Matricule_personnel', $opls);
		$this->db->like('facture.Date', $mois);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function detail_produit_total_mois_reel($mois)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->like('facture.Date', $mois);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function detail_produit_mois_livre($opls, $mois)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,produit.Designation, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('facture.Matricule_personnel', $opls);
		$this->db->like('livraison.date_de_livraison', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function detail_produit_total_mois_livre($mois)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('livraison.date_de_livraison', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function produithebdo($opls, $date)
	{
		$this->db->select('detailvente.statut, facture.Matricule_personnel, produit.Designation,detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel,facture.Val_bon_achat');
		$this->db->like('facture.Matricule_personnel', $opls);
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Status', "livre");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function Totalproduithebdo($opls, $dat5, $date)
	{
		$this->db->select('detailvente.statut, facture.Matricule_personnel, produit.Designation,detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel,facture.Val_bon_achat');
		$this->db->like('facture.Matricule_personnel', $opls);
		$this->db->where("facture.Date BETWEEN '" . $dat5 . "'AND'" . $date . "'");
		$this->db->where('facture.Status', "livre");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function Totalproduithebdos($dat5, $date)
	{
		$this->db->select('detailvente.statut, facture.Matricule_personnel, produit.Designation,detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel,facture.Val_bon_achat');
		$this->db->where("facture.Date BETWEEN '" . $dat5 . "'AND'" . $date . "'");
		$this->db->where('facture.Status', "livre");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function produitprevisionnel($opls, $date)
	{

		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('facture.Matricule_personnel', $opls);
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function produitlivre($opls, $date)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('facture.Matricule_personnel', $opls);
		$this->db->like('livraison.date_de_livraison', $date);
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function produitreel($opls, $date)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('facture.Matricule_personnel', $opls);
		$this->db->like('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function produittotallivre($date)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('livraison.date_de_livraison', $date);
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function produitreeltotal($date)
	{
		$this->db->select('detailvente.statut, facture.Matricule_personnel, produit.Designation,detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->where('facture.Status', "livre");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	///////////////////////////////////////////performance//////////////////////////////////////////////////////
	public function reppublication($user, $date)
	{
		$this->db->select('Code_publication');
		$this->db->like('Date', $date, 'after');
		$this->db->where('user', $user);
		return $this->db->get('autres_outils')->result_object();
	}

	public function reppublicationmois($user, $mois)
	{
		$this->db->select('Code_publication');
		$this->db->like('Date', $mois, 'after');
		$this->db->where('user', $user);
		return $this->db->get('autres_outils')->result_object();
	}

	public function commentaire($user, $date)
	{
		$this->db->select('Code_publication');
		$this->db->like('Date', $date, 'after');
		$this->db->where('Actions', "COMMENTAIRE");
		$this->db->where('user', $user);
		return $this->db->get('autres_outils')->result_object();
	}

	public function table_rapport($date, $user)
	{
		//$this->db->or_like('discussion_content.heure',$date,'after');
		$this->db->join('personnel', 'personnel.Matricule=discussion.operatrice');
		$this->db->join('discussion_content', 'discussion.id_discussion=discussion_content.Id_discussion');
		$this->db->like('discussion_content.heure', $date, 'after');
		$this->db->where('discussion.operatrice', $user);
		$this->db->group_by('discussion.id_discussion');
		return $this->db->get('discussion')->result_object();
	}
	public function repopl($date, $user)
	{
		//$this->db->join('personnel', 'personnel.Matricule=discussion.operatrice');
		$this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
		$this->db->join('comptefb', 'discussion_content.page=comptefb.id');
		$this->db->like('discussion_content.heure', $date, 'after');
		$this->db->where('discussion.operatrice', $user);
		$this->db->where('discussion_content.sender', 'OPL');
		return $this->db->get('discussion_content')->result_object();
	}
	public function nbr_produits($opls, $date)
	{
		$this->db->select('detailvente.statut, facture.Matricule_personnel, facture.Val_bon_achat, produit.Designation,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix,prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('personnel.Matricule', $opls);
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function produits_details($opls, $date)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('personnel.Matricule', $opls);
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function produits_details_mensuel($date, $opls)
	{
		$this->db->select('detailvente.statut, facture.Matricule_personnel, facture.Val_bon_achat, produit.Designation,detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail,facture.Matricule_personnel');
		$this->db->like('facture.Date', $date,'after');
		$this->db->where('personnel.Matricule', $opls);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function total_produits_details($date)
	{
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite, detailvente.Id_prix,detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function statut($client, $user, $date = FALSE)
	{

		$this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
		$this->db->where('discussion.operatrice', $user);
		$this->db->where('discussion.client', $client);
		$this->db->like('discussion_content.heure', $date, 'after');
		return $this->db->get('discussion_content')->result_object();
	}

	public function detail_discussion_operatrice($date, $user, $client)
	{
		$this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
		$this->db->like('discussion_content.heure', $date, 'after');
		$this->db->where('discussion.operatrice', $user);
		$this->db->where('discussion.client', $client);
		return $this->db->get('discussion_content')->result_object();
	}
	public function table_listeclient($date, $matricule)
	{
		$this->db->distinct();
		$this->db->select('discussion.client');
		$this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
		$this->db->where('discussion.operatrice', $matricule);
		$this->db->where('discussion_content.heure', $date, 'after');
		return $this->db->get('discussion_content')->result_object();
	}

	public function commentairemois($user, $mois)
	{
		$this->db->select('Code_publication');
		$this->db->like('Date', $mois, 'after');
		$this->db->where('Actions', "COMMENTAIRE");
		$this->db->where('user', $user);
		return $this->db->get('autres_outils')->result_object();
	}

	public function table_rapportmois($mois, $user)
	{
		//$this->db->or_like('discussion_content.heure',$date,'after');
		$this->db->join('personnel', 'personnel.Matricule=discussion.operatrice');
		$this->db->join('discussion_content', 'discussion.id_discussion=discussion_content.Id_discussion');
		$this->db->like('discussion_content.heure', $mois, 'after');
		$this->db->where('discussion.operatrice', $user);
		$this->db->group_by('discussion.id_discussion');
		return $this->db->get('discussion')->result_object();
	}
	public function repoplmois($mois, $user)
	{
		//$this->db->join('personnel', 'personnel.Matricule=discussion.operatrice');
		$this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
		$this->db->join('comptefb', 'discussion_content.page=comptefb.id');
		$this->db->like('discussion_content.heure', $mois, 'after');
		$this->db->where('discussion.operatrice', $user);
		$this->db->where('discussion_content.sender', 'OPL');
		return $this->db->get('discussion_content')->result_object();
	}
	public function nbr_produits_mois($opls, $mois)
	{
		$mois = date('Y-m');
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where('personnel.Matricule', $opls);
		$this->db->like('facture.Date', $mois);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function total_produits_details_mensuel($date)
	{
		
		$this->db->select('detailvente.statut, facture.Val_bon_achat, facture.Matricule_personnel, produit.Designation,detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->like('facture.Date', $date,'after');
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}
	public function etat_test($date, $page, $opls)
    {
	$this->db->distinct('comptefb.Nom_page');	
	$this->db->select('personnel.Matricule,  facture.Val_bon_achat, personnel.Prenom,comptefb.Nom_page,facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
	$this->db->where('personnel.Matricule', $opls);
	$this->db->like('comptefb.Nom_page', $page);
	$this->db->like('facture.Date', $date);
	$this->db->like('page_fb.statut', "on");
	//$this->db->like('comptefb.statut', "on");	
	$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
	$this->db->join('facture', 'detailvente.Facture=facture.Id');
	$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
	$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
	$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
	$this->db->join('comptefb', 'facture.Page=comptefb.id');
	$this->db->join('page_fb', 'page_fb.Lien_page=comptefb.Lien_page');	
	return $this->db->get('detailvente')->result_object();
    }
	public function liste_oplg($date)
	{
		$this->db->group_by('session.operatrice');
		$this->db->select('personnel.Prenom,session.operatrice');
		$this->db->where('(operatrice LIKE "VB%" OR operatrice LIKE "VH%" OR operatrice LIKE "CT%" OR operatrice LIKE "VK%" OR operatrice LIKE "VN%" OR operatrice LIKE "VD%" OR operatrice LIKE "VO%" OR operatrice LIKE "VM%"  )');		
		$this->db->like('session.date', $date);
		$this->db->join('personnel', 'session.operatrice=personnel.Matricule');
		return $this->db->get('session')->result_object();
	}

	public function liste_oplgg($mois)
	{
		$this->db->group_by('session.operatrice');
		$this->db->select('personnel.Prenom,session.operatrice');
		$this->db->where('(operatrice LIKE "VB%" OR operatrice LIKE "VH%" OR operatrice LIKE "CT%" OR operatrice LIKE "VK%" OR operatrice LIKE "VN%" OR operatrice LIKE "VD%" OR operatrice LIKE "VO%" OR operatrice LIKE "VM%" )');	
		$this->db->like('session.date', $mois,'after');
		$this->db->join('personnel', 'session.operatrice=personnel.Matricule');
		return $this->db->get('session')->result_object();
	}

	public function liste_oplg2($date,$opl)
	{
		$this->db->group_by('session.operatrice');
		$this->db->select('personnel.Prenom,session.operatrice');
		$this->db->like('operatrice',$opl);
		$this->db->like('session.date', $date);
		$this->db->join('personnel', 'session.operatrice=personnel.Matricule');
		return $this->db->get('session')->result_object();
	}
	public function heure($oplg,$date)
	{
		$this->db->select('heure');		
		$this->db->limit(1);
		$this->db->order_by('id', 'ASC');
		$this->db->like('date',$date);
		$this->db->like('action',"connexion");
		$this->db->where('operatrice',$oplg);
		return $this->db->get('session')->row_object();
	}
	public function heure_premiere_discussion($oplg,$date)
	{
		$this->db->select('heure');	
		$this->db->where('date',$date);
		$this->db->where('(action like "message" OR action like "VENTE_PRODUIT")');
		$this->db->where('operatrice',$oplg);
		$this->db->limit(1);
		$this->db->order_by('id', 'ASC');
	
		return $this->db->get('session')->row_object();
	}

	public function heure_derniere_discussion($oplg,$date)
	{
		$this->db->select('heure');	
		$this->db->where('date',$date);
		$this->db->where('(action like "message" OR action like "VENTE_PRODUIT")');
		$this->db->where('operatrice',$oplg);	
		$this->db->limit(1);
		$this->db->order_by('id', 'DESC');
		return $this->db->get('session')->row_object();
	}
	public function debut_tache($oplg,$date)
	{
		$this->db->select('session.heure,taches.taches');
		$this->db->where('session.date',$date);
		$this->db->where('taches.statut',"on");
		$this->db->where('session.operatrice',$oplg);	
		$this->db->limit(1);
		$this->db->order_by('session.id', 'ASC');
		$this->db->join('taches','taches.codes=session.action');
		return $this->db->get('session')->row_object();		
	}
	public function fin_tache($oplg,$date)
	{
		$this->db->select('session.heure,taches.taches');
		$this->db->where('session.date',$date);
		$this->db->where('taches.statut',"on");
		$this->db->where('session.operatrice',$oplg);	
		$this->db->limit(1);
		$this->db->order_by('session.id', 'DESC');
		$this->db->join('taches','taches.codes=session.action');
		return $this->db->get('session')->row_object();		
	}
	public function intervalle($date,$heureD,$heureF,$oplg)
	{
		$this->db->select('id');	
		$this->db->where('date',$date);	
		$this->db->where("heure BETWEEN '" . $heureD . "'AND'" . $heureF . "'");		
		$this->db->where('operatrice',$oplg);
		return $this->db->get('session')->result_object();
	}

	public function comptage($oplg,$date,$act)
	{
		$this->db->group_by('session.id');
		$this->db->select('session.id');
		$this->db->like('session.tache',$act);
		$this->db->like('session.date',$date);
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('typeaction','typeaction.codes=session.action');		
		$this->db->join('taches','taches.codes=typeaction.codes');
		return $this->db->get('session')->result_object();
	}

	public function comptagge($oplg,$date,$act)
	{
		$this->db->select('session.idaction');
		$this->db->where('typeaction.id',$act);
		$this->db->like('session.date',$date);
		$this->db->where('session.operatrice',$oplg);				
		$this->db->join('typeaction','typeaction.codes=session.action');
		return $this->db->get('session')->result_object();;
	}
	public function comptejm($date,$oplg)
	{
		$this->db->distinct('session.client');
		$this->db->select('session.idaction,clientpo.lien_facebook');
		$this->db->where('session.date',$date);
		$this->db->like('session.types',"REA_CLT_J'AIME");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function comptejm_mois($oplg,$mois)
	{
		$this->db->distinct('session.client');
		$this->db->select('session.idaction');
		$this->db->like('session.date',$mois,'after');
		$this->db->like('session.types',"REA_CLT_J'AIME");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function countPROP_CLT_AAC07($date,$oplg)
	{
		$this->db->distinct('session.client');
		$this->db->select('session.idaction');
		$this->db->where('session.date',$date);
		$this->db->like('session.types',"PROP_CLT_AAC07");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function countPROP_CLT_AAC07_mois($oplg,$mois)
	{
		$this->db->distinct('session.client');
		$this->db->select('session.idaction');
		$this->db->like('session.date',$mois,'after');
		$this->db->like('session.types',"PROP_CLT_AAC07");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function countPROP_CLT_AAC14($date,$oplg)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('session.idaction');
		$this->db->where('session.date',$date);
		$this->db->like('session.types',"PROP_CLT_AAC14");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function countPROP_CLT_AAC14_mois($oplg,$mois)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('session.idaction');
		$this->db->like('session.date',$mois,'after');
		$this->db->like('session.types',"PROP_CLT_AAC14");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function countRELN_CLT_SAC07($date,$oplg)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('session.id');
		$this->db->where('session.date',$date);
		$this->db->like('session.types',"RELN_CLT_SAC07");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function countRELN_CLT_SAC07_mois($oplg,$mois)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('session.id');
		$this->db->like('session.date',$mois,'after');
		$this->db->like('session.types',"RELN_CLT_SAC07");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}
	public function countREAP_CLT_AAC30($date,$oplg)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('session.idaction');
		$this->db->where('session.date',$date);
		$this->db->like('session.types',"REAP_CLT_AAC30");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function countREAP_CLT_AAC30_mois($oplg,$mois)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('session.idaction');
		$this->db->like('session.date',$mois,'after');
		$this->db->like('session.types',"REAP_CLT_AAC30");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}


	public function countTRTM_VTE_NNLIV($date,$oplg)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.heure');
		$this->db->select('session.idaction');
		$this->db->where('session.date',$date);
		$this->db->like('session.types',"TRTM_VTE_NNLIV");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function countTRTM_VTE_NNLIV_mois($oplg,$mois)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('session.id');
		$this->db->select('session.idaction');
		$this->db->like('session.date',$mois,'after');
		$this->db->like('session.types',"TRTM_VTE_NNLIV");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function jaime_mois($oplg,$mois,$act)
	{
		
		$this->db->select('session.idaction');
		$this->db->where('typeaction.id',$act);
		$this->db->like('session.date',$mois,'after');
		$this->db->where('session.operatrice',$oplg);				
		$this->db->join('typeaction','typeaction.codes=session.action');
		return $this->db->get('session')->result_object();;
	}



	public function comptages($oplg,$mois,$act)
	{
		$this->db->select('session.idaction');
		$this->db->like('session.tache',$act);
		$this->db->like('session.date',$mois);
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('typeaction','typeaction.codes=session.action');		
		$this->db->join('taches','taches.codes=typeaction.codes');
		return $this->db->get('session')->result_object();
	}

	public function counttache($date,$heureD,$heureF,$oplg)
	{
		$this->db->select('id');	
		$this->db->where('date',$date);	
		$this->db->where("heure BETWEEN '" . $heureD . "'AND'" . $heureF . "'");
		$this->db->where('(action LIKE "P%" OR action LIKE "E%" OR action LIKE "R%" OR action LIKE "message%" OR action LIKE "vente%" OR action LIKE "connexion%" )');		
		$this->db->where('operatrice',$oplg);
		return $this->db->get('session')->result_object();
	}

	public function retard($mois,$oplg)
	{  
		$query=$this->db->query("SELECT (
			SELECT session.heure from session WHERE date = content.date and session.action='connexion' and session.operatrice='$oplg' LIMIT 1 ) as Date
		,content.date  from session as content WHERE content.action = 'connexion' AND content.date LIKE '$mois%' AND  content.operatrice='$oplg' AND content.heure > '07:15:00' GROUP by content.date ORDER BY `id` DESC ");
		return $query->result();
	}
	public function recuperation($mois,$oplg)
	{	
		$query=$this->db->query("SELECT `heure` FROM `session` WHERE `heure` > '16:00:00' AND `date` LIKE '$mois%' ESCAPE '!' AND `operatrice` = '$oplg' GROUP BY `date`");
		return $query->result();
		}

	public function presence($mois,$oplg){
		$query=$this->db->query("SELECT * FROM `session` WHERE `operatrice` LIKE '%VB%' ESCAPE '!' AND `date` LIKE '$mois%' ESCAPE '!' AND `operatrice` = '$oplg' GROUP BY `date`");
		return $query->result();
	}
	public function detailretard($mois){
		$query=$this->db->query("SELECT * FROM `session` WHERE `operatrice` LIKE '%VB%' ESCAPE '!' AND `date` LIKE '$mois%' ESCAPE '!'  GROUP BY `date`");
		return $query->result();
	}
	public function detailretards($mois){		
		$this->db->group_by('date');
		$this->db->select('date');
		//$this->db->like('operatrice',"VB");
		$this->db->where('(operatrice LIKE "VB%" OR operatrice LIKE "VH%" OR operatrice LIKE "CT%" OR operatrice LIKE "VK%" OR operatrice LIKE "VN%" OR operatrice LIKE "VD%" OR operatrice LIKE "VO%" OR operatrice LIKE "VM%" )');	
		$this->db->like('date', $mois,'after');
		return $this->db->get('session')->result_object();
	}

	public function sommerecup($mois,$oplg)
	{
		$query=$this->db->query("SELECT (TIMEDIFF(`heure`,'16:00:00')) as Diff, `heure`,`date` FROM `session` WHERE `heure` > '16:00:00' AND `date` LIKE '$mois%' ESCAPE '!' AND `operatrice` = '$oplg' GROUP BY `date` ORDER BY `id` DESC ");
		return $query->result();
	}
	

	public function sommerecup1($mois,$oplg)
	{
		$query=$this->db->query("SELECT (TIMEDIFF(`heure`,'16:00:00')) as Diff  FROM `session` WHERE `heure` > '16:00:00' AND `date` LIKE '$mois%' ESCAPE '!' AND `operatrice` = '$oplg' GROUP BY `date` ");
		return $query->result();
	}

	public function heureavance($mois,$oplg)
	{
		$query=$this->db->query("SELECT (TIMEDIFF('07:00:00',`heure`)) as Diffe, `heure`,`date` FROM `session` WHERE `heure` < '07:00:00' AND `date` LIKE '$mois%' ESCAPE '!' AND `operatrice` = '$oplg' GROUP BY `date`");
		return $query->result();
	}
	public function sommeretard($mois,$oplg)
	{
		$query=$this->db->query("SELECT (
			SELECT session.heure from session WHERE date =content.date and session.action='connexion' and session.heure > '07:15:00' and session.operatrice='$oplg'  ORDER BY session.id ASC LIMIT 1 ) as Date,
            
            (
			SELECT session.heure  from session WHERE date = content.date AND session.heure > '16:00:00' AND session.operatrice = '$oplg'  ORDER BY session.id DESC LIMIT 1) AS sortie,
            (
            SELECT  (TIMEDIFF((session.heure),'16:00:00'))  from session WHERE date = content.date AND session.heure > '16:00:00' AND session.operatrice = '$oplg'  ORDER BY session.id DESC LIMIT 1) AS solde,
            (
            SELECT  (TIMEDIFF((session.heure),'07:00:00'))  from session WHERE date = content.date AND session.heure > '07:00:00' AND session.operatrice = '$oplg'  ORDER BY session.id ASC LIMIT 1) AS entree 
            
		,content.date  from session as content WHERE content.action = 'connexion' AND content.date LIKE '$mois%' AND  content.operatrice='$oplg' AND content.heure > '07:15:00' GROUP by content.date ORDER BY `id` DESC ");
		return $query->result();
	}

	public function sommesolde($mois,$oplg)
	{
		$query=$this->db->query("SELECT ( SELECT TIME_TO_SEC((TIMEDIFF((session.heure),'16:00:00'))) from session WHERE date = content.date AND session.heure > '16:00:00' AND session.operatrice = '$oplg' ORDER BY session.id DESC LIMIT 1) AS secrecup , ( SELECT TIME_TO_SEC((TIMEDIFF((session.heure),'07:00:00'))) from session WHERE date = content.date AND session.heure > '07:00:00' AND session.operatrice = '$oplg' ORDER BY session.id ASC LIMIT 1) AS secentree ,content.date from session as content WHERE content.action = 'connexion' AND content.date LIKE '$mois%' AND content.operatrice='$oplg' AND content.heure > '07:15:00' GROUP by content.date ORDER BY `id` DESC; ");
		return $query->result();
	}

	public function oplg_session($mois)
	{
		$query = $this->db->query("SELECT personnel.Matricule, personnel.Prenom FROM session join personnel on personnel.Matricule=session.operatrice WHERE session.date like '$mois%' and (session.operatrice LIKE 'VB%' OR session.operatrice LIKE 'VH%' OR session.operatrice LIKE 'CT%' OR operatrice LIKE 'VK%' OR operatrice LIKE 'VN%' OR operatrice LIKE 'VD%')  GROUP BY personnel.Matricule");
		return $query->result();
	}

	public function solde($mois, $oplg)
	{
		$query=$this->db->query(" SELECT      (
            SELECT  (TIMEDIFF((session.heure),'16:00:00'))  from session WHERE date = content.date AND session.heure > '16:00:00' AND session.operatrice = '$oplg'  ORDER BY session.id DESC LIMIT 1) AS recup,
            (
            SELECT  (TIMEDIFF((session.heure),'07:00:00'))  from session WHERE date = content.date AND session.heure > '07:00:00' AND session.operatrice = '$oplg'  ORDER BY session.id ASC LIMIT 1) AS entree,
            (
            SELECT  TIME_TO_SEC((TIMEDIFF((session.heure),'16:00:00')))  from session WHERE date = content.date AND session.heure > '16:00:00' AND session.operatrice = '$oplg'  ORDER BY session.id DESC LIMIT 1) AS secrecup ,
            (
            SELECT  TIME_TO_SEC((TIMEDIFF((session.heure),'07:00:00')))  from session WHERE date = content.date AND session.heure > '07:00:00' AND session.operatrice = '$oplg'  ORDER BY session.id ASC LIMIT 1) AS secentree
            
		,content.date  from session as content WHERE content.action = 'connexion' AND content.date LIKE '$mois%' AND  content.operatrice='$oplg' AND content.heure > '07:15:00' GROUP by content.date ORDER BY `id` DESC");

		return $query->result();
	}


	public function details_recup($mois,$oplg)
	{
		$query=$this->db->query("SELECT `heure` FROM `session` WHERE `heure` > '16:00:00' AND `date` LIKE '$mois%' ESCAPE '!' AND `operatrice` = '$oplg' GROUP BY `date` ");
		return $query->result();
	}	 

	public function liste_clients($date,$oplg)
	{
		$this->db->order_by('id', 'ASC');
		$this->db->where('datedenregistrement',$date);
		$this->db->where('Matricule_personnel',$oplg);
		return $this->db->get('clientpo')->result_object();
	}

	public function liste_clients_mois($mois,$oplg)
	{
		$this->db->order_by('id', 'ASC');
		$this->db->like('datedenregistrement',$mois,'after');
		$this->db->where('Matricule_personnel',$oplg);
		return $this->db->get('clientpo')->result_object();
	}

	public function nombre_discu($date,$oplg,$client)
	{
		$this->db->order_by('clientpo.id', 'ASC');		
		$this->db->like('session.action',"message");
		$this->db->where('session.client',$client);
		$this->db->where('clientpo.datedenregistrement',$date);
		$this->db->where('clientpo.Matricule_personnel',$oplg);
		$this->db->join('session','clientpo.Code_client=session.client');
		return $this->db->get('clientpo')->result_object();
	}

	public function liste_client_mois($oplg, $mois)
	{
		
		$this->db->like('datedenregistrement',$mois,'after');
		$this->db->where('Matricule_personnel',$oplg);
		return $this->db->get('clientpo')->result_object();
	}

	

	public function liste_clients_jaime($date,$oplg)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('clientpo.Code_client,session.heure, clientpo.lien_facebook,clientpo.Compte_facebook');
		$this->db->where('session.date',$date);
		$this->db->like('session.types',"REA_CLT_J'AIME");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function PROP_CLT_AAC07($date,$oplg)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.heure');
		$this->db->where('session.date',$date);
		$this->db->like('session.types',"PROP_CLT_AAC07");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}
	public function PROP_CLT_AAC14($date,$oplg)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.heure');
		$this->db->where('session.date',$date);
		$this->db->like('session.types',"PROP_CLT_AAC14");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}
	
	public function RELN_CLT_SAC07($date,$oplg)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.heure');
		$this->db->where('session.date',$date);
		$this->db->like('session.types',"RELN_CLT_SAC07");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function REAP_CLT_AAC30($date,$oplg)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.heure');
		$this->db->where('session.date',$date);
		$this->db->like('session.types',"REAP_CLT_AAC30");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	

	public function liste_clientAAC7($oplg)
	{
		$query=$this->db->query("SELECT clientpo.Code_client,  clientpo.lien_facebook, clientpo.Compte_facebook FROM facture INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
		WHERE facture.Matricule_personnel ='$oplg' AND facture.Status ='livre' AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 7 DAY GROUP BY clientpo.Code_client");
		return $query->result();
	}

	

	public function livraison_previ_du_jour($oplg)
	{
		$query=$this->db->query("SELECT `facture`.`Date`,  `facture`.`Val_bon_achat`, `detailvente`.`statut`, `detailvente`.`Quantite`, `detailvente`.`Id_prix`, `detailvente`.`Type_de_prix`, `prix`.`Prix_detail` FROM `detailvente` 
			JOIN `facture` ON `detailvente`.`Facture`=`facture`.`Id` 
			JOIN `prix` ON `detailvente`.`Id_prix`=`prix`.`Id` 
			JOIN `personnel` ON `facture`.`Matricule_personnel`=`personnel`.`Matricule`
			JOIN `livraison` ON `facture`.`Id_facture` =`livraison`.`Id_facture`
			WHERE `facture`.`Matricule_personnel`='$oplg'  AND `livraison`.`date_de_livraison` LIKE CURRENT_DATE()  AND `facture`.`Id_de_la_mission` LIKE '%FACEBOOK%' ESCAPE '!' ");
		return $query->result();
	}

	public function liste_clientAAC14($oplg)
	{
		$query=$this->db->query("SELECT clientpo.Code_client, facture.Val_bon_achat ,clientpo.lien_facebook, clientpo.Compte_facebook FROM facture INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
		WHERE facture.Matricule_personnel ='$oplg' AND facture.Status ='livre' AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 14 DAY GROUP BY clientpo.Code_client");
		return $query->result();
	}

	public function countpage($oplg,$date,$act)
	{
		$this->db->group_by('session.id');
		$this->db->select('session.id');
		$this->db->where('session.tache',$act);
		$this->db->like('session.date',$date);
		//$this->db->orlike
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('typeaction','typeaction.codes=session.action');		
		$this->db->join('taches','taches.codes=typeaction.codes');
		return $this->db->get('session')->result_object();;
	}

	public function countpagess($oplg,$date)
	{
		$this->db->group_by('session.client');
		$this->db->select('session.id');
		$this->db->like('session.date',$date);
		$this->db->where('session.operatrice',$oplg);
		$this->db->where('(session.tache LIKE "ENVOYER UN VISUEL + COMMENTAIRE%" OR session.tache LIKE "ENVOYER UNE PHOTO + COMMENTAIRE%")');
    	return $this->db->get('session')->result_object();
	}

	public function countpages($oplg,$date,$act)
	{
		$this->db->select('session.idaction');
		$this->db->where('session.action',$act);
		$this->db->like('session.date',$date);
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('typeaction','typeaction.codes=session.action');		
		$this->db->join('taches','taches.codes=typeaction.codes');
		return $this->db->get('session')->result_object();
	}

	public function countpagemensuelle($oplg,$mois,$act)
	{
		$this->db->select('session.idaction');
		$this->db->where('session.tache',$act);
		$this->db->like('session.date',$mois,'after');
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('typeaction','typeaction.codes=session.action');		
		$this->db->join('taches','taches.codes=typeaction.codes');
		return $this->db->get('session')->result_object();;
	}

	public function countpagemensuelles($oplg,$mois,$act)
	{
		$this->db->select('session.idaction');
		$this->db->where('session.action',$act);
		$this->db->like('session.date',$mois,'after');
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('typeaction','typeaction.codes=session.action');		
		$this->db->join('taches','taches.codes=typeaction.codes');
		return $this->db->get('session')->result_object();;
	}

	public function cleintSAC07_mois($oplg,$mois)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.date');
		$this->db->like('session.date',$mois,'after');
		$this->db->like('session.types',"RELN_CLT_SAC07");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}
	
	public function cleintAAC14_mois($oplg,$mois)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.date');
		$this->db->like('session.date',$mois,'after');
		$this->db->like('session.types',"PROP_CLT_AAC14");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}

	public function cleintAAC30_mois($oplg,$mois)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.date');
		$this->db->like('session.date',$mois,'after');
		$this->db->like('session.types',"REAP_CLT_AAC30");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}	

	public function clientsaa7($user){
    $user = $this->session->userdata('matricule'); 
    $query = $this->db->query("SELECT session.client, facture.Val_bon_achat, clientpo.Compte_facebook,clientpo.lien_facebook, session.date,session.idaction, comptefb.Nom_page,session.operatrice,
    (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY AND CURRENT_DATE() AND facture.Code_client = session.client  LIMIT 1 ) AS 'FACTURE',
    (SELECT sess.client FROM session AS sess WHERE   sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK'
    FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client
        AND session.action <> 'vente' AND session.sender like 'OPL' 
        AND session.date =CURRENT_DATE() - INTERVAL 7 DAY
        AND session.operatrice = '$user'
        GROUP BY session.client");
    return $query->result();
	}

	public function countappel($date,$oplg)
	{
		
		$query = $this->db->query(" SELECT session.client FROM clientpo JOIN session on session.client = clientpo.Code_client where session.date like '$date' and (session.types like 'APP_CLT_ECHOUE%' or session.types like 'APP_CLT_ABOU%') and session.operatrice ='$oplg' "); 
		return $query->result();
	}

	public function appel($date,$oplg)
	{
		$query = $this->db->query(" SELECT session.client, session.types, clientpo.lien_facebook, clientpo.Compte_facebook FROM clientpo JOIN session on session.client = clientpo.Code_client where session.date like '%$date%' and (session.types like 'APP_CLT_ECHOUE%' or session.types like 'APP_CLT_ABOU%') and session.operatrice ='$oplg' ");
		return $query->result();
	}

	public function appel_vente($date,$oplg)
	{
		$query = $this->db->query(" SELECT session.client, session.action, clientpo.lien_facebook, clientpo.Compte_facebook FROM clientpo JOIN session on session.client = clientpo.Code_client where session.date like '%$date%'  and session.operatrice ='$oplg' and session.action='vente'");
		return $query->result();
	}

	public function testlien($date,$oplg)
	{
		$query = $this->db->query(" SELECT session.client, session.action, clientpo.lien_facebook, clientpo.Compte_facebook FROM clientpo JOIN session on session.client = clientpo.Code_client where session.date like '%$date%'  and session.operatrice ='$oplg' ");
		return $query->result();
	}

	public function appelconclu($date,$oplg)
	{
		$query = $this->db->query(" SELECT session.id FROM clientpo JOIN session on session.client = clientpo.Code_client where session.date like '%$date%' and (session.types like 'APP_CLT_ABOU%') and session.operatrice ='$oplg' ");
		return $query->result();
	}

	public function appelechoue($date,$oplg)
	{
		$query = $this->db->query(" SELECT session.id  FROM clientpo JOIN session on session.client = clientpo.Code_client where session.date like '%$date%' and (session.types like 'APP_CLT_ECHOUE%') and session.operatrice ='$oplg' ");
		return $query->result();
	}

	public function detailappem($client)
	{
		$query = $this->db->query("SELECT `Date`,`Code_client`,`Status` FROM `facture` WHERE `Code_client` like '$client' and `Status`='livre'");
		return $query->result();
	}

	public function stat($client)
	{
	  $query = $this->db->query("SELECT facture.Date, facture.Val_bon_achat, comptefb.Nom_page,clientpo.Compte_facebook,facture.contacts,produit.Code_produit,detailvente.Quantite,prix.Prix_detail,produit.Designation FROM facture 
	  JOIN detailvente ON facture.Id = detailvente.Facture 
	  JOIN prix ON prix.Id=detailvente.Id_prix 
	  JOIN clientpo ON clientpo.Code_client=facture.Code_client 
	  JOIN produit ON produit.Code_produit=prix.Code_produit
	  JOIN comptefb ON comptefb.id=facture.Page
	  WHERE facture.Code_client ='$client'
	  ORDER BY facture.Date DESC");
	
	  return $query->result_object();
	}

	public function totalconfirmer()
	{
		$query = $this->db->query("SELECT  `detailvente`.`statut`, `facture`.`Val_bon_achat`, `produit`.`Designation`, `detailvente`.`Quantite`, `detailvente`.`Id_prix`, `detailvente`.`Type_de_prix`, `prix`.`Prix_detail` FROM `detailvente` 
			JOIN `facture` ON `detailvente`.`Facture`=`facture`.`Id` 
			JOIN `prix` ON `detailvente`.`Id_prix`=`prix`.`Id` 
			JOIN `livraison` ON `facture`.`Id_facture`=`livraison`.`Id_facture` 
			JOIN `produit` ON `produit`.`Code_produit`=`prix`.`Code_produit` WHERE `livraison`.`date_de_livraison` = CURRENT_DATE() + INTERVAL 1 DAY AND `facture`.`Id_de_la_mission` LIKE '%FACEBOOK%' ESCAPE '!'");
		return $query->result();
	}

	public function chiffre_d_affaires_confirme($oplg,$date)
	{
		$query=$this->db->query("SELECT `facture`.`Date`, `facture`.`Val_bon_achat`, `detailvente`.`statut`, `detailvente`.`Quantite`, `detailvente`.`Id_prix`, `detailvente`.`Type_de_prix`, `prix`.`Prix_detail` FROM `detailvente` 
			JOIN `facture` ON `detailvente`.`Facture`=`facture`.`Id` 
			JOIN `prix` ON `detailvente`.`Id_prix`=`prix`.`Id` 
			JOIN `livraison` ON `facture`.`Id_facture`=`livraison`.`Id_facture` 
			WHERE `facture`.`Matricule_personnel`='$oplg'  AND `livraison`.`date_de_livraison` LIKE '$date' AND `facture`.`Id_de_la_mission` LIKE '%FACEBOOK%' ESCAPE '!' ");
		return $query->result();
	}


	public function confirmer($oplg)
	{
		$query = $this->db->query("SELECT  `detailvente`.`statut`, `facture`.`Val_bon_achat`, `produit`.`Designation`, `detailvente`.`Quantite`, `detailvente`.`Id_prix`, `detailvente`.`Type_de_prix`, `prix`.`Prix_detail` FROM `detailvente` 
			JOIN `facture` ON `detailvente`.`Facture`=`facture`.`Id` 
			JOIN `prix` ON `detailvente`.`Id_prix`=`prix`.`Id` 
			JOIN `livraison` ON `facture`.`Id_facture`=`livraison`.`Id_facture` 
			JOIN `produit` ON `produit`.`Code_produit`=`prix`.`Code_produit` WHERE `livraison`.`date_de_livraison` = CURRENT_DATE() + INTERVAL 1 DAY AND `facture`.`Id_de_la_mission` LIKE '%FACEBOOK%' ESCAPE '!' AND `facture`.`Matricule_personnel` like '$oplg'");
		return $query->result();
	}

	public function nouveaux_clients_AC($date, $oplg)
	{
		$query = $this->db->query("SELECT `facture`.`Code_client`, `facture`.`Val_bon_achat`, `clientpo`.`Compte_facebook`, `clientpo`.`lien_facebook` FROM `facture` JOIN `clientpo` ON `facture`.`Code_client`=`clientpo`.`Code_client` WHERE `facture`.`Date` = '$date'  AND `clientpo`.`datedenregistrement` = '$date' AND `facture`.`Matricule_personnel` = '$oplg' GROUP BY `facture`.`Code_client`");
		return $query->result();
	}

	public function nouveaux_clients_AC_mois($mois, $oplg)
	{
		$query = $this->db->query("SELECT `facture`.`Code_client`, `facture`.`Val_bon_achat`, `clientpo`.`Compte_facebook`,`clientpo`.`lien_facebook` FROM `facture` JOIN `clientpo` ON `facture`.`Code_client`=`clientpo`.`Code_client` WHERE `facture`.`Date` like '$mois%'  AND `clientpo`.`datedenregistrement` like '$mois%' AND `clientpo`.`Matricule_personnel` = '$oplg' GROUP BY `facture`.`Code_client`");
		return $query->result();
	}

	public function nouveaux_clients_SAC($date, $oplg)
	{
		$query = $this->db->query("SELECT session.client, clientpo.Compte_facebook,clientpo.lien_facebook, session.date,session.idaction, comptefb.Nom_page,session.operatrice,
		(SELECT facture.Id_facture FROM facture WHERE facture.Date = $date AND facture.Code_client = session.client  LIMIT 1 ) AS 'FACTURE',
		(SELECT sess.client FROM session AS sess WHERE   sess.sender ='OPL' AND sess.client = session.client AND sess.date = $date LIMIT 1 ) AS 'AVANT_DERNIER_DISK'
		FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client
			AND session.action <> 'vente' AND session.sender like 'OPL' 
			AND session.date =$date 
			AND clientpo.datedenregistrement =$date 
		   AND session.operatrice = '$oplg'
			GROUP BY session.client");
		return $query->result();
	}

	public function liste_clients_derniers($oplg)
	{
		$query = $this->db->query("	SELECT * FROM `clientpo` WHERE `datedenregistrement` BETWEEN CURRENT_DATE() - INTERVAL 30 DAY  AND CURRENT_DATE() AND `Matricule_personnel` = '$oplg' ORDER BY `id` ASC");
		return $query->result();
	}

	

	public function nouveaux_clients_30AC($oplg)
	{
		$query = $this->db->query("SELECT `facture`.`Code_client`,`clientpo`.`Compte_facebook`,`clientpo`.`lien_facebook` FROM `facture` JOIN `clientpo` ON `facture`.`Code_client`=`clientpo`.`Code_client` WHERE `facture`.`Date` BETWEEN CURRENT_DATE() - INTERVAL 30 DAY  AND CURRENT_DATE()  AND `clientpo`.`datedenregistrement` BETWEEN CURRENT_DATE() - INTERVAL 30 DAY  AND CURRENT_DATE() AND `clientpo`.`Matricule_personnel` = '$oplg' GROUP BY `facture`.`Code_client`");
		return $query->result();
	}

	public function premier_achat7 ($oplg,$date)
	{
		$query = $this->db->query("SELECT facture.Code_client,facture.Date,clientpo.datedenregistrement, clientpo.Compte_facebook, facture.Id_facture, facture.Status FROM clientpo JOIN facture ON clientpo.Code_client = facture.Code_client WHERE  clientpo.datedenregistrement = '$date' + INTERVAL 7 DAY AND facture.Matricule_personnel like '$oplg' group by facture.Code_client");
		return $query->result();
	}
	public function premier_achat14 ($oplg,$date)
	{
		$query = $this->db->query("SELECT facture.Code_client,facture.Date,clientpo.datedenregistrement, clientpo.Compte_facebook, facture.Id_facture, facture.Status FROM clientpo JOIN facture ON clientpo.Code_client = facture.Code_client WHERE  clientpo.datedenregistrement = '$date' + INTERVAL 14 DAY AND facture.Matricule_personnel like '$oplg' group by facture.Code_client");
		return $query->result();
	}
	public function premier_achat28 ($oplg,$date)
	{
		$query = $this->db->query("SELECT facture.Code_client,facture.Date,clientpo.datedenregistrement, clientpo.Compte_facebook, facture.Id_facture, facture.Status FROM clientpo JOIN facture ON clientpo.Code_client = facture.Code_client WHERE  clientpo.datedenregistrement = '$date' + INTERVAL 28 DAY AND facture.Matricule_personnel like '$oplg' group by facture.Code_client");
		return $query->result();
	}
	public function premier_achat42 ($oplg,$date)
	{
		$query = $this->db->query("SELECT facture.Code_client,facture.Date,clientpo.datedenregistrement, clientpo.Compte_facebook, facture.Id_facture, facture.Status FROM clientpo JOIN facture ON clientpo.Code_client = facture.Code_client WHERE  clientpo.datedenregistrement = '$date' + INTERVAL 42 DAY AND facture.Matricule_personnel like '$oplg' group by facture.Code_client");
		return $query->result();
	}

	public function premier_achat49 ($oplg,$date)
	{
		$query = $this->db->query("SELECT facture.Code_client,facture.Date,clientpo.datedenregistrement, clientpo.Compte_facebook, facture.Id_facture, facture.Status FROM clientpo JOIN facture ON clientpo.Code_client = facture.Code_client WHERE  clientpo.datedenregistrement = '$date' + INTERVAL 49 DAY AND facture.Matricule_personnel like '$oplg' group by facture.Code_client");
		return $query->result();
	}

	public function ca_annuel_previtotal($ans)
	{
		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('facture.Date', $ans);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		//$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_annuel_reel($ans)
	{
		$this->db->select('facture.Date,detailvente.statut, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('facture.Date', $ans);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function listeoperatrice($date)
	{
		$this->db->group_by('facture.Matricule_personnel');
		//$this->db->distinct();
		$this->db->select('facture.Matricule_personnel,personnel.Prenom');
		$this->db->like('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('facture')->result_object();
	}

	public function listeoperatrices($date)
	{
		$this->db->group_by('facture.Matricule_personnel');
		//$this->db->distinct();
		$this->db->select('facture.Matricule_personnel,personnel.Prenom, comptefb.Code_page');
		$this->db->like('facture.Date', $date);
		$this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('comptefb', 'comptefb.id=facture.Page');
		return $this->db->get('facture')->result_object();
	}

	public function ca_annuel_livre($ans)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('livraison.date_de_livraison', $ans);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	/*public function timeline($oplg)
	{
		$query = $this->db->query("SELECT `date`,`heure`, `tache`,`action`,`client`  FROM `session` WHERE `operatrice` LIKE '$oplg' and `date`=CURRENT_DATE");
		return $query->result_object();; 
	}*/

	

	public function timeliness()
	{
		$query = $this->db->query("SELECT `date`,`heure`, `tache`,`action`,`client`  FROM `session` WHERE  `date`=CURRENT_DATE");
		return $query->result_object();
	}




	public function mensuel_previ($mois, $opl)
	{
		$this->db->select('facture.Date, detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		return $this->db->get('detailvente')->result_object();
	}

	public function mensuel_reel($mois, $opl)
	{

		$this->db->select('facture.Date,detailvente.statut,  facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.data_de_livraison', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		return $this->db->get('detailvente')->result_object();
	}

	public function liste_produit_reel($dateD = null, $dateF = null, $opl)
	{
		$this->db->select('facture.Date,detailvente.statut, produit.Designation, detailvente.Quantite, detailvente.Id_prix, facture.Val_bon_achat, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function liste_oplg_en_fonction()
	{
		$this->db->where('Etat', 'on');
		$this->db->where('Fonction_actuelle',8);
		return $this->db->get('personnel')->result_object();
	}

	/* SELECT facture.Date, comptefb.Nom_page as "Page", clientpo.Compte_facebook AS "Nom client",clientpo.lien_facebook AS "Lien Fb", facture.contacts AS "Téléphone",facture.District, produit.Code_produit, produit.Designation, detailvente.Quantite, prix.Prix_detail as "Prix Unitaire",(detailvente.Quantite * prix.Prix_detail ) as Montant FROM facture JOIN detailvente ON facture.Id = detailvente.Facture JOIN prix ON prix.Id=detailvente.Id_prix JOIN clientpo ON clientpo.Code_client=facture.Code_client JOIN produit ON produit.Code_produit=prix.Code_produit JOIN comptefb ON comptefb.id=facture.Page WHERE facture.Page ='47' and facture.Date like '2021-11%' ORDER BY facture.Date DESC */


	public function timeline($oplg)
	{
		$this->db->select('session.date,comptefb.Nom_page, session.heure, session.tache, session.action, session.client');
		$this->db->where('session.operatrice',$oplg);
		$this->db->where('(session.date like CURRENT_DATE)');
		$this->db->join('comptefb', 'comptefb.id=session.page');
		return $this->db->get('session')->result_object();
	}

	public function operatrice($oplg)
	{
		$this->db->select('Prenom,Matricule');
		$this->db->where('Matricule',$oplg);
		return $this->db->get('personnel')->result_object();
	}

	public function CodeOperatrice($oplg)
	{
		$this->db->group_by('oplg.Prenom');
		$this->db->select('personnel.Prenom,personnel.Matricule,personnel.Contact_du_personnel');
		$this->db->like('personnel.Matricule',$oplg);
		$this->db->join('oplg', 'oplg.Prenom =personnel.Prenom');
		return $this->db->get('personnel')->row();
	}

	public function ca_par_oplg($opl,$date)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		//$this->db->where('(facture.Date like CURRENT_DATE)');
		$this->db->like('facture.Date',$date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		//$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		return $this->db->get('detailvente')->result_object();
	}

	public function infoclient($client)
	{
		$this->db->select('clientpo.Nom,clientpo.Code_client,clientpo.lien_facebook,facture.contacts');
		$this->db->where('clientpo.Code_client',$client);
		$this->db->join('facture', 'facture.Code_client=clientpo.Code_client');
		return $this->db->get('clientpo')->row();
	}

	public function infoclients($client)
	{
		$this->db->select('Nom,Code_client,lien_facebook');
		$this->db->where('Code_client',$client);
		return $this->db->get('clientpo')->row();
	}

	public function ca_par_client($client)
	{
		$this->db->select('facture.data_de_livraison,  facture.Val_bon_achat, detailvente.statut,produit.Code_produit, produit.Designation, detailvente.Quantite,  facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Code_client', $client);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function listeClients($client)
	{
		$query = $this->db->query("SELECT session.heure, session.client, clientpo.Nom, clientpo.lien_facebook FROM session JOIN clientpo on session.client = clientpo.Code_client  WHERE session.date like CURRENT_DATE and session.operatrice like '$client' GROUP BY session.client ORDER BY session.heure DESC");
		return $query->result_object();
	}
	public function telephone($client)
	{
		$this->db->select('facture.contacts');
		$this->db->where('clientpo.Code_client',$client);
		$this->db->join('facture', 'facture.Code_client=clientpo.Code_client');
		return $this->db->get('clientpo')->result_object();
	}

	public function listeclientsjaimemois($mois,$oplg)
	{
		$this->db->order_by('session.id', 'ASC');
		$this->db->group_by('clientpo.lien_facebook');
		$this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.date');
		$this->db->like('session.date',$mois,'after');
		$this->db->like('session.types',"REA_CLT_J'AIME");
		$this->db->where('session.operatrice',$oplg);
		$this->db->join('clientpo','session.client=clientpo.Code_client');
		return $this->db->get('session')->result_object();
	}
	public function client_avec_achat($oplg,$date)
	{	
		$this->db->group_by('facture.Id_facture');
		$this->db->select('facture.contacts,clientpo.lien_facebook,clientpo.Compte_facebook,clientpo.Code_client');
		$this->db->like('facture.Date',$date);
		$this->db->where('facture.Matricule_personnel',$oplg);
		$this->db->join('facture', 'facture.Code_client=clientpo.Code_client');
		return $this->db->get('clientpo')->result_object();
	}

	public function chiffre_d_affaires($date, $opl)
	{
		$this->db->select('facture.Date,facture.Val_bon_achat, detailvente.statut, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->where('facture.Date', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');	
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		//$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		return $this->db->get('detailvente')->result_object();
	}

	public function nvx_Clients($oplg)
	{
		$query = $this->db->query("SELECT  clientpo.Compte_facebook,clientpo.lien_facebook ,facture.Code_client,facture.Matricule_personnel,  detailvente.Quantite*prix.Prix_detail as 'Total'  FROM detailvente 
		JOIN facture ON detailvente.Facture=facture.Id 
		JOIN prix ON detailvente.Id_prix=prix.Id 
		JOIN produit ON produit.Code_produit=prix.Code_produit
		JOIN clientpo on facture.Code_client = clientpo.Code_client
		WHERE facture.date = CURRENT_DATE 
		AND clientpo.datedenregistrement = CURRENT_DATE
		AND facture.Matricule_personnel like '$oplg'
		AND facture.Id_de_la_mission = 'FACEBOOK' ");
		return $query->result_object();
	}

	public function ca_facture_opl($opls, $date)
	{
		$this->db->select('detailvente.statut,facture.Matricule_personnel,  facture.Val_bon_achat, produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->like('facture.Matricule_personnel', $opls);
		$this->db->where('facture.date',$date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function totalProduit($opls, $dateD, $dateF)
	{
		$this->db->select('detailvente.statut,facture.Matricule_personnel,  facture.Val_bon_achat, produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->like('facture.Matricule_personnel', $opls);
		$this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}


	public function totalProduits($dateD, $dateF)
	{
		$this->db->select('detailvente.statut,facture.Matricule_personnel,  facture.Val_bon_achat, produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function ca_facture_oplR($opls, $date)
	{
		$this->db->select('detailvente.statut,facture.Matricule_personnel,  facture.Val_bon_achat, produit.Designation, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail, facture.Matricule_personnel');
		$this->db->like('facture.Matricule_personnel', $opls);
		$this->db->like('facture.date',$date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->where('facture.Status', "livre");
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}

	public function designation($opls, $date)
	{
		$this->db->group_by('produit.Designation');
		$this->db->select(' produit.Designation');
		$this->db->like('facture.Matricule_personnel', $opls);
		$this->db->where('facture.date',$date);
		$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
		return $this->db->get('detailvente')->result_object();
	}


	public function total_nvx_Clients ($oplg)
	{
		$query = $this->db->query("SELECT  SUM(detailvente.Quantite*prix.Prix_detail) as 'Total'  FROM detailvente 
		JOIN facture ON detailvente.Facture=facture.Id 
		JOIN prix ON detailvente.Id_prix=prix.Id 
		JOIN produit ON produit.Code_produit=prix.Code_produit
		JOIN clientpo on facture.Code_client = clientpo.Code_client
		WHERE facture.Matricule_personnel like '$oplg'
		AND facture.date = CURRENT_DATE 
		AND clientpo.datedenregistrement = CURRENT_DATE
		AND facture.Id_de_la_mission = 'FACEBOOK' ");
		return $query->row_object();
	}

	public function total_ancien_clients($oplg)
	{
		$query = $this->db->query("SELECT   SUM(detailvente.Quantite*prix.Prix_detail) as 'Total'  FROM detailvente 
		JOIN facture ON detailvente.Facture=facture.Id 
		JOIN prix ON detailvente.Id_prix=prix.Id 
		JOIN produit ON produit.Code_produit=prix.Code_produit
		JOIN clientpo on facture.Code_client = clientpo.Code_client
		WHERE facture.Matricule_personnel like '$oplg'
		AND facture.date = CURRENT_DATE 
		AND clientpo.datedenregistrement <> CURRENT_DATE		
		AND facture.Id_de_la_mission = 'FACEBOOK' ");
		return $query->row_object();
	}
	



	public function ancien_clients($oplg)
	{
		$query = $this->db->query("SELECT  clientpo.Compte_facebook,clientpo.lien_facebook,facture.Code_client , facture.Matricule_personnel, detailvente.Quantite*prix.Prix_detail as 'Total'  FROM detailvente 
		JOIN facture ON detailvente.Facture=facture.Id 
		JOIN prix ON detailvente.Id_prix=prix.Id 
		JOIN produit ON produit.Code_produit=prix.Code_produit
		JOIN clientpo on facture.Code_client = clientpo.Code_client
		WHERE facture.date = CURRENT_DATE 
		AND clientpo.datedenregistrement <> CURRENT_DATE
		AND facture.Matricule_personnel like '$oplg'
		AND facture.Id_de_la_mission = 'FACEBOOK'
		group by clientpo.lien_facebook ");
		return $query->result_object();
	}

	public function ca_ancien_clients($oplg,$client)
	{
		$query = $this->db->query("SELECT  SUM(detailvente.Quantite*prix.Prix_detail) as 'Total'  FROM detailvente 
		JOIN facture ON detailvente.Facture=facture.Id 
		JOIN prix ON detailvente.Id_prix=prix.Id 
		JOIN produit ON produit.Code_produit=prix.Code_produit
		JOIN clientpo on facture.Code_client = clientpo.Code_client
		WHERE facture.date = CURRENT_DATE 
		AND clientpo.datedenregistrement <> CURRENT_DATE
		AND facture.Matricule_personnel like '$oplg'
		AND facture.Id_de_la_mission = 'FACEBOOK'
		AND facture.Code_client like '$client' ");
		return $query->result_object();
	}

	public function ca_nvx_Clients($oplg,$client)
	{
		$query = $this->db->query("SELECT  SUM(detailvente.Quantite*prix.Prix_detail) as 'Total'  FROM detailvente 
		JOIN facture ON detailvente.Facture=facture.Id 
		JOIN prix ON detailvente.Id_prix=prix.Id 
		JOIN produit ON produit.Code_produit=prix.Code_produit
		JOIN clientpo on facture.Code_client = clientpo.Code_client
		WHERE facture.date = CURRENT_DATE 
		AND clientpo.datedenregistrement = CURRENT_DATE
		AND facture.Matricule_personnel like '$oplg'
		AND facture.Id_de_la_mission = 'FACEBOOK' 
		AND facture.Code_client like '$client'");
		return $query->result_object();
	}

	public function detail_achat($produit, $oplg)
	{
		$query = $this->db->query("SELECT facture.Matricule_personnel,sum(detailvente.Quantite) as 'Qte', SUM(detailvente.Quantite*prix.Prix_detail) as 'CA'  FROM detailvente 
		JOIN facture ON detailvente.Facture=facture.Id 
		JOIN prix ON detailvente.Id_prix=prix.Id 
		JOIN produit ON produit.Code_produit=prix.Code_produit
		WHERE facture.Date = CURRENT_DATE 
		AND produit.Designation like '$produit'
		AND facture.Matricule_personnel like '$oplg'		
		AND facture.Id_de_la_mission = 'FACEBOOK' ");
		return $query->row_object();

	}

	public function detail_oplg($produit)
	{
		$query = $this->db->query("SELECT facture.Matricule_personnel FROM detailvente 
		JOIN facture ON detailvente.Facture=facture.Id 
		JOIN prix ON detailvente.Id_prix=prix.Id 
		JOIN produit ON produit.Code_produit=prix.Code_produit
		WHERE facture.Date = CURRENT_DATE 
		AND produit.Designation like '$produit'
		AND facture.Id_de_la_mission = 'FACEBOOK' GROUP BY facture.Matricule_personnel
		 ");
		return $query->result_object();

	}

	public function detail_achats($produit)
	{
		$query = $this->db->query("SELECT facture.Matricule_personnel,detailvente.Quantite, facture.Val_bon_achat,  detailvente.Quantite*prix.Prix_detail as 'CA'  FROM detailvente 
		JOIN facture ON detailvente.Facture=facture.Id 
		JOIN prix ON detailvente.Id_prix=prix.Id 
		JOIN produit ON produit.Code_produit=prix.Code_produit
		JOIN livraison on livraison.Id_facture = facture.Id_facture
		WHERE livraison.date_de_livraison = CURRENT_DATE
		AND produit.Designation like '$produit'
		AND facture.Status like 'confirmer'
		AND facture.Id_de_la_mission = 'FACEBOOK' ");
		return $query->result_object();

	}

	public function detail_achats_livr($produit)
	{
		$query = $this->db->query("SELECT facture.Matricule_personnel, facture.Val_bon_achat, detailvente.Quantite, detailvente.Quantite*prix.Prix_detail as 'CA'  FROM detailvente 
		JOIN facture ON detailvente.Facture=facture.Id 
		JOIN prix ON detailvente.Id_prix=prix.Id 
		JOIN produit ON produit.Code_produit=prix.Code_produit
		JOIN livraison on livraison.Id_facture = facture.Id_facture
		WHERE livraison.date_de_livraison = CURRENT_DATE
		AND facture.Status like 'livre'
		AND produit.Designation like '$produit'
		AND facture.Id_de_la_mission = 'FACEBOOK' ");
		return $query->result_object();

	}

public function getkotysmiletotalpossible($facture)
  {
    $query = $this->db->query("SELECT produit.Designation,  SUM(
        CASE 
          WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite
          ELSE  '0'
        END 
      ) AS 'smiles',
      SUM(
        CASE 
          WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`*detailvente.Quantite
          ELSE  '0'
        END 
      ) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix` JOIN produit ON produit.Code_produit = prix.Code_produit   WHERE  facture.Id_facture like '$facture'");
    return $query->result();
  }

   public function gettotalsmileskotyGlobale($Code_client)
  {
    $query = $this->db->query("SELECT SUM(
  CASE 
    WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite
    ELSE  '0'
  END 
) AS 'smiles',
SUM(
  CASE 
    WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`*detailvente.Quantite
    ELSE  '0'
  END 
) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix`   WHERE facture.`Code_client` LIKE '$Code_client' AND facture.`data_de_livraison` BETWEEN '2022-10-01' and '2022-12-31'  ");
    return $query->result();
  }

  public function dernier_contact($client)
{
  $query = $this->db->query("SELECT discussion_content.heure FROM discussion_content JOIN discussion ON discussion_content.Id_discussion = discussion.id_discussion WHERE discussion.client ='$client' AND discussion_content.sender like 'OPL'  ORDER BY discussion_content.Id DESC LIMIT 1 ");

return $query->row_object();
}

public function getclientstatuttrimes($smiles)
  {
    if ($smiles <= 1499 and $smiles >= 0) {
      $statut = "LEVEL 1";
      return $statut;
    } elseif ($smiles <= 2499 and $smiles >= 1500) {
      $statut = "LEVEL 2";
      return $statut;
    } elseif ($smiles <= 4999 and $smiles >= 2500) {
      $statut = "LEVEL 3";
      return $statut;
    } elseif ($smiles <= 9999 and $smiles >= 5000) {
      $statut = "LEVEL 4";
      return $statut;
    } elseif ($smiles <= 99999999 and $smiles >= 10000) {
      $statut = "LEVEL 5";
      return $statut;
    } else {

      $statut = "Votre statut n'est pas validé, veillez consulter le responsable technique";
      return $statut;
    }
  }

   public function getclientstatutAnnuel($smiles)
  {
    if ($smiles <= 14999 and $smiles >= 0) {
      $statut = "BLUE";
      return $statut;
    } elseif ($smiles <= 24999 and $smiles >= 15000) {
      $statut = "BRONZE";
      return $statut;
    } elseif ($smiles <= 44999 and $smiles >= 25000) {
      $statut = "SILVER";
      return $statut;
    } elseif ($smiles <= 99999 and $smiles >= 50000) {
      $statut = "GOLD";
      return $statut;
    } elseif ($smiles <= 9999999 and $smiles >= 100000) {
      $statut = "PLATINIUM";
      return $statut;
    } else {
      $statut = "Votre statut n'est pas valide, veillez consulter le responsable technique";
      return $statut;
    }
  }

    public function stats($client)
{
  $query = $this->db->query("SELECT facture.Date, facture.Quartier ,facture.Val_bon_achat, facture.Ress_sec_oplg,facture.Code_client, comptefb.Nom_page, facture.Matricule_personnel, facture.Id_facture, clientpo.Compte_facebook,clientpo.lien_facebook,facture.contacts,produit.Code_produit,detailvente.Quantite,prix.Prix_detail,produit.Designation FROM facture 
  JOIN detailvente ON facture.Id = detailvente.Facture 
  JOIN prix ON prix.Id=detailvente.Id_prix 
  JOIN clientpo ON clientpo.Code_client=facture.Code_client 
  JOIN produit ON produit.Code_produit=prix.Code_produit
  JOIN comptefb ON comptefb.id=facture.Page
  WHERE facture.Code_client ='$client'
  ORDER BY facture.Date DESC");

  return $query->result_object();
}

public function historique_discussion($client)
{
  $query = $this->db->query("SELECT session.operatrice,personnel.Prenom,session.date,session.heure,comptefb.Nom_page,session.action FROM session join comptefb on comptefb.id=session.page join personnel on personnel.Matricule=session.operatrice WHERE session.client like '$client'  ORDER BY session.date DESC");
  return $query->result_object();
}

 public function count_nouv_client_journalier($page){
    $query = $this->db->query("SELECT DISTINCT clientpo.Code_client , session.page FROM clientpo JOIN session ON clientpo.Code_client = session.client WHERE clientpo.datedenregistrement = CURRENT_DATE and session.page ='$page'");
    $resultat = $query->result();
    return count($resultat);
  }

 public function count_client_existant($page){
 	$query = $this->db->query("SELECT id FROM session WHERE client IN (SELECT facture.Code_client FROM facture JOIN clientpo on clientpo.Code_client=facture.Code_client WHERE facture.Date BETWEEN CURRENT_DATE - INTERVAL 90 day and CURRENT_DATE AND clientpo.datedenregistrement <> CURRENT_DATE) and page = '$page' and date=CURRENT_DATE GROUP BY client");
 	$resultat = $query->result();
    return count($resultat);
 }

 public function count_total_client($page)
 {
 	$query = $this->db->query("SELECT `client` FROM `session` WHERE `page` =$page AND `date`=CURRENT_DATE AND `client`<>'NULL' GROUP BY `client`");
 	$resultat = $query->result();
    return count($resultat);
 }

 public function prenom($matricule){
 	$query = $this->db->query("SELECT `Prenom` FROM `personnel` WHERE `Matricule` like '$matricule'");
  	return $query->row_object();
 }

 public function prime ($oplg, $date)
 {
 $query = $this->db->query("SELECT SUM(detailvente.Quantite) as 'nombre' FROM facture 
  JOIN detailvente ON facture.Id = detailvente.Facture 
  JOIN prix ON prix.Id=detailvente.Id_prix 
  JOIN produit ON produit.Code_produit=prix.Code_produit
  WHERE produit.Code_produit LIKE 'LES%' AND facture.Matricule_personnel LIKE '$oplg' and facture.Date like '$date%' AND facture.Status like 'livre'");
  return $query->row_object();
  }

  public function produit_prime($oplg, $date)
  {
  $query = $this->db->query(" SELECT SUM(detailvente.Quantite) as 'nombre', produit.Code_produit, produit.Designation  FROM facture JOIN detailvente ON facture.Id = detailvente.Facture JOIN prix ON prix.Id=detailvente.Id_prix JOIN produit ON produit.Code_produit=prix.Code_produit WHERE produit.Code_produit LIKE 'LES%' AND facture.Matricule_personnel LIKE '$oplg' and facture.Date like '$date%' AND facture.Status like 'livre' GROUP by produit.Code_produit ");
  	return $query->result_object();
  }

  public function detail_prime($poduit, $date)
  {
  $query = $this->db->query(" SELECT produit.Code_produit ,produit.Designation, detailvente.Quantite as 'nombre' FROM facture 
  JOIN detailvente ON facture.Id = detailvente.Facture 
  JOIN prix ON prix.Id=detailvente.Id_prix 
  JOIN clientpo ON clientpo.Code_client=facture.Code_client
  JOIN produit ON produit.Code_produit=prix.Code_produit
  WHERE produit.Code_produit LIKE '$poduit' and facture.Date like '$date%' AND facture.Status like 'livre'");
  	return $query->row_object();
  }

  public function prenom_oplg()
  {
  	$query = $this->db->query("SELECT personnel.Prenom, personnel.Matricule FROM personnel 
	JOIN facture ON facture.Matricule_personnel=personnel.Matricule
	WHERE  facture.Date BETWEEN CURRENT_DATE - INTERVAL 30 day AND CURRENT_DATE AND facture.Id_de_la_mission like 'FACEBOOK'  GROUP BY personnel.Prenom");
  	return $query->result_object();
  }
   public function listeDesOplg()
   {
   	$query = $this->db->query("SELECT personnel.Matricule, personnel.Prenom FROM session JOIN personnel on session.operatrice=personnel.Matricule  WHERE session.date BETWEEN CURRENT_DATE - INTERVAL 30 day and CURRENT_DATE AND personnel.Fonction_actuelle = 8 GROUP BY session.operatrice");
   	return $query->result_object();
   }

   public function prenom_operatrice()
  {
  	$query = $this->db->query("SELECT personnel.Prenom, personnel.Matricule FROM facture JOIN personnel ON facture.Matricule_personnel=personnel.Matricule WHERE  facture.Date BETWEEN CURRENT_DATE - INTERVAL 6 day AND CURRENT_DATE AND facture.Id_de_la_mission LIKE 'FACEBOOK' GROUP BY Matricule_personnel");
  	return $query->result_object();
  }

  public function codification_page($oplg)
  {
  	$query = $this->db->query("SELECT comptefb.Code_page  ,comptefb.id FROM comptefb join page_fb on comptefb.Lien_page=page_fb.Lien_page WHERE page_fb.operatrice like '$oplg' AND comptefb.statut like 'on' AND page_fb.statut like 'on' AND comptefb.Type like 'page'");
  	return $query->row_object();
  }
  public function liste_compte_fb($requette = array()){
   return $this->db->where($requette)->get('comptefb')->result_object();

  }

  public function get_compte_fb($requette = array()){
	return $this->db->where($requette)->get('comptefb')->row_object();
 
   }

  public function return_liste_client_page($param=array()){
	return $this->db->where($param)->group_by("client")->get("discussion")->result_object();

  }

  public function return_liste_page($param=array()){
	return $this->db->where($param)->group_by("page")->get("discussion")->result_object();

  }

  public function codification_pages($oplg)
  {
  	$query = $this->db->query("SELECT comptefb.Code_page FROM comptefb join page_fb on comptefb.Lien_page=page_fb.Lien_page WHERE page_fb.operatrice like '$oplg' AND comptefb.statut like 'on' AND page_fb.statut like 'on' AND comptefb.Type like 'page'");
  	return $query->result_object();
  }

  public function previsionnels($oplg){
  	$query = $this->db->query("SELECT `detailvente`.`statut`, `facture`.`Matricule_personnel`, `produit`.`Designation`, `detailvente`.`Quantite`, `detailvente`.`Id_prix`, `detailvente`.`Type_de_prix`, `prix`.`Prix_detail`, `facture`.`Matricule_personnel` FROM `detailvente` JOIN `facture` ON `detailvente`.`Facture`=`facture`.`Id` JOIN `prix` ON `detailvente`.`Id_prix`=`prix`.`Id` JOIN `produit` ON `produit`.`Code_produit`=`prix`.`Code_produit` WHERE `facture`.`Matricule_personnel` = '$oplg' AND `facture`.`Date` BETWEEN CURRENT_DATE - INTERVAL 6 day AND CURRENT_DATE AND `facture`.`Id_de_la_mission` = 'FACEBOOK'");
  	return $query->result_object();
  } 
  public function anarana_page($Code, $oplg)
  {
  	$query = $this->db->query("SELECT page_fb.Nom_page FROM comptefb join page_fb on comptefb.Lien_page=page_fb.Lien_page WHERE comptefb.Code_page like '$Code' AND comptefb.statut like 'on' AND page_fb.operatrice LIKE '$oplg' and page_fb.statut like 'on' AND comptefb.Type like 'page' LIMIT 1");
  	return $query->result_object();
  }

public function ca_opl_page($page, $date)
{
	$this->db->select('detailvente.statut,  facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix,prix.Prix_detail, facture.Matricule_personnel');
	$this->db->where('facture.Page', $page);
	$this->db->where('facture.Date', $date);
	$this->db->where('facture.Id_de_la_mission', "FACEBOOK");
	$this->db->join('facture', 'detailvente.Facture=facture.Id');
	$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
	//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');		
	return $this->db->get('detailvente')->result_object();
	}

public function page_list()
{
	$query = $this->db->query("SELECT comptefb.id,comptefb.Nom_page, comptefb.Type FROM facture JOIN comptefb ON facture.Page=comptefb.id WHERE facture.Date BETWEEN CURRENT_DATE - INTERVAL 6 DAY AND CURRENT_DATE GROUP BY facture.Page");
	return $query->result_object();
} 

public function date_de_livraison($oplg){
    $query = $this->db->query("SELECT DISTINCT(livraison.date_de_livraison) as 'Date_livraison'FROM detailvente JOIN facture ON detailvente.Facture=facture.Id JOIN prix ON detailvente.Id_prix=prix.Id JOIN livraison on livraison.Id_facture = facture.Id_facture WHERE livraison.date_de_livraison BETWEEN '2022-10-03' AND '2022-10-08' AND facture.Matricule_personnel LIKE '$oplg' AND facture.Status like 'livre' AND facture.Id_de_la_mission = 'FACEBOOK' ORDER BY livraison.date_de_livraison ASC ");
    return $query->result();
 }

public function dateAchat($date)
{
	$query = $this->db->query("SELECT  facture.Date, facture.Matricule_personnel,facture.Code_client, detailvente.Quantite*prix.Prix_detail as 'CA'  FROM detailvente 
		JOIN facture ON detailvente.Facture=facture.Id 
		JOIN prix ON detailvente.Id_prix=prix.Id 
		JOIN produit ON produit.Code_produit=prix.Code_produit
		WHERE facture.date like '$date%' 
		AND facture.Id_de_la_mission = 'FACEBOOK' GROUP BY facture.Date");
	return $query->result();
}

public function CaParJourMois($date,$oplg){
    $query = $this->db->query("SELECT sum(detailvente.Quantite*prix.Prix_detail) as 'CA' FROM detailvente 
    	JOIN facture ON detailvente.Facture=facture.Id 
    	JOIN prix ON detailvente.Id_prix=prix.Id 
    	JOIN livraison on livraison.Id_facture = facture.Id_facture WHERE facture.date like '$date' and  facture.Matricule_personnel LIKE '%$oplg%' AND facture.Id_de_la_mission = 'FACEBOOK' ORDER BY facture.date ASC ");
    return $query->row();
}

public function CaParJourMoisReel($date,$oplg){
    $query = $this->db->query("SELECT sum(detailvente.Quantite*prix.Prix_detail) as 'CA' FROM detailvente 
    	JOIN facture ON detailvente.Facture=facture.Id 
    	JOIN prix ON detailvente.Id_prix=prix.Id 
    	JOIN livraison on livraison.Id_facture = facture.Id_facture WHERE facture.date like '$date' and facture.Status like 'livre' and  facture.Matricule_personnel LIKE '%$oplg%' AND facture.Id_de_la_mission = 'FACEBOOK' ORDER BY facture.date ASC ");
    return $query->row();
}

public function CaParJourMoisLivre($date,$oplg){
    $query = $this->db->query("SELECT sum(detailvente.Quantite*prix.Prix_detail) as 'CA' FROM detailvente 
    	JOIN facture ON detailvente.Facture=facture.Id 
    	JOIN prix ON detailvente.Id_prix=prix.Id 
    	JOIN livraison on livraison.Id_facture = facture.Id_facture WHERE livraison.date_de_livraison like '$date' and facture.Status like 'livre' and  facture.Matricule_personnel LIKE '%$oplg%' AND facture.Id_de_la_mission = 'FACEBOOK' ORDER BY facture.date ASC ");
    return $query->row();
}
public function get_sum_colum($param = array(), $colum, $table)
{
  return $this->db->where($param)->select_sum($colum)->get($table)->row_object();
}

	public function listeJours($mois)
	{
		$query = $this->db->query("SELECT  facture.Date FROM facture WHERE facture.date like '$mois%' AND facture.Id_de_la_mission = 'FACEBOOK' GROUP BY facture.Date");
		return $query->result_object();
	}
	public function etatGlobalPrevi($date)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, facture.Val_bon_achat, prix.Prix_detail');
		$this->db->like('facture.Date', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatGlobalReel($mois)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatGlobalReels($mois, $oplg)
	{

		$this->db->select(' facture.Val_bon_achat, detailvente.Quantite,  detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Matricule_personnel', $oplg);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}


	public function etatGlobalLivre($mois)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->like('livraison.date_de_livraison', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatGlobalLivres($mois, $oplg)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->like('livraison.date_de_livraison', $mois);
		$this->db->like('facture.Matricule_personnel', $oplg);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		return $this->db->get('detailvente')->result_object();
	}

	 public function ListeMatriculeOplg()
  {
  	$query = $this->db->query("SELECT  personnel.Matricule, personnel.Prenom FROM personnel 
	JOIN facture ON facture.Matricule_personnel=personnel.Matricule
	WHERE  facture.Date BETWEEN CURRENT_DATE - INTERVAL 36 day and CURRENT_DATE  AND facture.Id_de_la_mission like 'FACEBOOK'  GROUP BY personnel.Prenom");
  	return $query->result_object();
  }

  

	public function etatParMatriculePreviTotal($mois)
	{

		$this->db->select('facture.Val_bon_achat, detailvente.statut,detailvente.Quantite,prix.Prix_detail');
		//$this->db->like('facture.Matricule_personnel', $oplg);
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}


	public function etatParMatriculePrevis($mois, $oplg)
	{

		$this->db->select('facture.Val_bon_achat, detailvente.Quantite,prix.Prix_detail');
		$this->db->like('facture.Matricule_personnel', $oplg);
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatParMatriculePrevisJour($jour)
	{

		$this->db->select('facture.Val_bon_achat, detailvente.Quantite,prix.Prix_detail');
		$this->db->like('facture.Date', $jour);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatParMatriculeReel($mois, $oplg)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('facture.Matricule_personnel', $oplg);
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatParMatriculePageReel($mois, $oplg, $page)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('facture.Matricule_personnel', $oplg);
		$this->db->like('facture.Date', $mois);
		$this->db->where('facture.Page', $page);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatParMatriculeReelTotal($mois)
	{

		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.statut,detailvente.Quantite, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		//$this->db->like('facture.Matricule_personnel', $oplg);
		$this->db->like('facture.Date', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatParMatriculeLivre($mois, $oplg)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->like('livraison.date_de_livraison', $mois);
		$this->db->like('facture.Matricule_personnel', $oplg);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatParMatriculePageLivre($mois, $oplg, $page)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->like('livraison.date_de_livraison', $mois);
		$this->db->like('facture.Matricule_personnel', $oplg);
		$this->db->where('facture.Page', $page);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatParMatriculeLivreTotal($mois)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->like('livraison.date_de_livraison', $mois);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		return $this->db->get('detailvente')->result_object();
	}

	public function etatGlobalReelsJour($jour)
	{
		$this->db->select('facture.Val_bon_achat, detailvente.Quantite, detailvente.Id_prix,  prix.Prix_detail');
		$this->db->like('facture.Date', $jour);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		//$this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
		return $this->db->get('detailvente')->result_object();
	}
	public function etatGlobalLivresJour($jour)
	{
		$this->db->select('facture.Date, facture.Val_bon_achat, detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
		$this->db->like('livraison.date_de_livraison', $jour);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		$this->db->where('facture.Status', "livre");
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		return $this->db->get('detailvente')->result_object();
	}
    public function get_nouveau_contact($param){
    	return $this->db->where($param)->get('nuveau_contact')->result_object();
    }
	public function countNvxClient($oplg, $mois,$date=null){
		if($date==null){
			$date = date('Y-m-d');
		}
    $query = $this->db->query("SELECT session.client, clientpo.datedenregistrement FROM clientpo JOIN session ON session.client = clientpo.Code_client WHERE session.operatrice like '%$oplg%' AND session.date ='$date' AND clientpo.datedenregistrement like '$mois%' AND session.client <> 'NULL' GROUP BY session.client");
    $resultat = $query->result();
    return count($resultat);
  	}

  	public function totalNvxClient($mois){
    $query = $this->db->query("SELECT session.client, clientpo.datedenregistrement FROM clientpo JOIN session ON session.client = clientpo.Code_client WHERE  session.date =CURRENT_DATE AND clientpo.datedenregistrement like  '$mois%' AND session.client <> 'NULL' GROUP BY session.client");
    $resultat = $query->result();
    return count($resultat);
  	}

  	public function countAncienClient($oplg, $date_du_jour,$date=null){
		if($date==null){
			$date = date('Y-m-d');
		}
    $query = $this->db->query("SELECT session.client, clientpo.datedenregistrement FROM clientpo JOIN session ON session.client = clientpo.Code_client WHERE session.operatrice like '%$oplg%' AND session.date ='$date' AND clientpo.datedenregistrement < '$date_du_jour' AND session.client <> 'NULL' GROUP BY session.client");
    $resultat = $query->result();
    return count($resultat);
  	}
  	public function totalAncienClient($date){
    $query = $this->db->query("SELECT session.client, clientpo.datedenregistrement FROM clientpo JOIN session ON session.client = clientpo.Code_client WHERE session.date =CURRENT_DATE AND clientpo.datedenregistrement < '$date' AND session.client <> 'NULL' GROUP BY session.client");
    $resultat = $query->result();
    return count($resultat);
  	}
  	public function oplgListgroupe()
  	{
  		$query = $this->db->query("SELECT personnel.Matricule, personnel.Prenom FROM session JOIN personnel on session.operatrice=personnel.Matricule WHERE session.date BETWEEN CURRENT_DATE - INTERVAL 7 day AND CURRENT_DATE AND personnel.Fonction_actuelle = 8 GROUP by personnel.Prenom ");
  		return $query->result_object();
  	}
  	public function oplgList()
  	{
  		$query = $this->db->query("SELECT personnel.Matricule, personnel.Prenom FROM session JOIN personnel on session.operatrice=personnel.Matricule WHERE session.date BETWEEN CURRENT_DATE - INTERVAL 7 day AND CURRENT_DATE AND personnel.Fonction_actuelle = 8 GROUP by session.operatrice ");
  		return $query->result_object();
  	}

  	public function listeJour()
  	{
  		$query = $this->db->query("SELECT DISTINCT(`Date`) FROM `facture` WHERE `Date` BETWEEN CURRENT_DATE - INTERVAL 7 day and CURRENT_DATE");
  		return $query->result_object();
  	}

  	public function ListeNvxClients($oplg,$mois){
    $query = $this->db->query("SELECT session.client, clientpo.Compte_facebook,clientpo.lien_facebook FROM clientpo JOIN session ON session.client = clientpo.Code_client WHERE session.operatrice like '$oplg%' AND session.date =CURRENT_DATE AND clientpo.datedenregistrement like '$mois%' AND session.client <> 'NULL' GROUP BY session.client");
    return $query->result_object();
  	}

  	public function ListeAncienClient($oplg, $date){
    $query = $this->db->query("SELECT session.client, clientpo.Compte_facebook,clientpo.lien_facebook FROM clientpo JOIN session ON session.client = clientpo.Code_client WHERE session.operatrice like '$oplg%' AND session.date =CURRENT_DATE AND clientpo.datedenregistrement < '$date' AND session.client <> 'NULL' GROUP BY session.client");
    return $query->result_object();
  	}

  	public function listePage()
  	{
  	$query = $this->db->query("SELECT comptefb.id,comptefb.Code_page, comptefb.Nom_page FROM facture JOIN comptefb on facture.Page=comptefb.id WHERE facture.Date BETWEEN CURRENT_DATE - INTERVAL 30 day and CURRENT_DATE AND facture.Id_de_la_mission like 'FACEBOOK' AND comptefb.statut like 'on'  GROUP BY facture.Page");
    return $query->result_object();
  	}

  	public function countClientParPage($page,$date=null)
  	{ 
		if($date==null){
			$date = date('Y-m-d');
		}
  		$query = $this->db->query("SELECT client FROM session JOIN comptefb ON comptefb.id=session.page WHERE session.client <> 'NULL' AND session.date ='$date' AND comptefb.Code_page like '$page' GROUP BY session.client");
    	$resultat = $query->result();
    	return count($resultat);
  	}

  	public function NvxClientParPage($page, $mois,$date=null)
  	{ 
		if($date==null){
			$date = date('Y-m-d');
		}
  		$query = $this->db->query("SELECT session.client FROM session JOIN comptefb ON comptefb.id=session.page JOIN clientpo ON   clientpo.Code_client=session.client WHERE session.client <> 'NULL' AND session.date ='$date' AND clientpo.datedenregistrement like '$mois%' AND comptefb.Code_page like '$page' GROUP BY session.client");
    	$resultat = $query->result();
    	return count($resultat);
  	}

  	public function DataParPage($date, $page)
  	{
  		$query =$this->db->query(" SELECT detailvente.Quantite, prix.Prix_detail FROM detailvente 
	      JOIN facture ON detailvente.Facture=facture.Id 
	      JOIN prix ON detailvente.Id_prix=prix.Id 
	      JOIN livraison on livraison.Id_facture = facture.Id_facture 
        JOIN comptefb on comptefb.id = facture.Page
        WHERE facture.date like '$date' and comptefb.Code_page like '$page' and facture.Id_de_la_mission = 'FACEBOOK' ORDER BY facture.date ASC");
        return $query->result_object();
  	}
	  
	  public function chiffre_page($date, $page)
  	{
  		$query =$this->db->query(" SELECT SUM(detailvente.Quantite * prix.Prix_detail ) AS 'Somme' FROM detailvente 
	      JOIN facture ON detailvente.Facture=facture.Id 
	      JOIN prix ON detailvente.Id_prix=prix.Id 
	      JOIN livraison on livraison.Id_facture = facture.Id_facture 
        JOIN comptefb on comptefb.id = facture.Page
        WHERE facture.date like '$date' and comptefb.Code_page like '$page' and facture.Id_de_la_mission = 'FACEBOOK' ORDER BY facture.date ASC");
        return $query->row_object();
  	}

	  public function somme_select_vente($date, $page)
  	{
  		$query =$this->db->query(" SELECT SUM(detailvente.Quantite*prix.Prix_detail ) AS 'Somme' FROM detailvente 
	      JOIN facture ON detailvente.Facture=facture.Id 
	      JOIN prix ON detailvente.Id_prix=prix.Id 
          JOIN comptefb on comptefb.id = facture.Page
        WHERE facture.date like '$date%' and comptefb.Code_page like '$page' and facture.Id_de_la_mission = 'FACEBOOK' ORDER BY facture.date ASC");
        return $query->row_object();
  	}

	  public function somme_select_vente_param($date, $page,$statu)
  	{
  		$query =$this->db->query(" SELECT SUM(detailvente.Quantite*prix.Prix_detail ) AS 'Somme' FROM detailvente 
	      JOIN facture ON detailvente.Facture=facture.Id 
	      JOIN prix ON detailvente.Id_prix=prix.Id 
          JOIN comptefb on comptefb.id = facture.Page
        WHERE (facture.date like '$date%' and comptefb.Code_page like '$page' ) and (facture.Id_de_la_mission = 'FACEBOOK' and facture.Status ='$statu') ORDER BY facture.date ASC");
        return $query->row_object();
  	}

	  

  	public function DataParPageReel($date, $page)
  	{
  		$query =$this->db->query(" SELECT detailvente.Quantite, prix.Prix_detail FROM detailvente 
	      JOIN facture ON detailvente.Facture=facture.Id 
	      JOIN prix ON detailvente.Id_prix=prix.Id 
	      JOIN livraison on livraison.Id_facture = facture.Id_facture 
        JOIN comptefb on comptefb.id = facture.Page
        WHERE facture.date like '$date' and comptefb.Code_page like '$page' and facture.Status like 'livre' and facture.Id_de_la_mission = 'FACEBOOK' ORDER BY facture.date ASC");
        return $query->result_object();
  	}


  	public function TotalDataParPageReel($date)
  	{
  		$query =$this->db->query(" SELECT detailvente.Quantite, prix.Prix_detail FROM detailvente 
	      JOIN facture ON detailvente.Facture=facture.Id 
	      JOIN prix ON detailvente.Id_prix=prix.Id 
	      JOIN livraison on livraison.Id_facture = facture.Id_facture 
        JOIN comptefb on comptefb.id = facture.Page
        WHERE facture.date like '$date' and facture.Status like 'livre' and facture.Id_de_la_mission = 'FACEBOOK' ORDER BY facture.date ASC");
        return $query->result_object();
  	}

  	public function DataParPageLivre($date, $page)
  	{
  		$query =$this->db->query(" SELECT detailvente.Quantite, prix.Prix_detail FROM detailvente 
	      JOIN facture ON detailvente.Facture=facture.Id 
	      JOIN prix ON detailvente.Id_prix=prix.Id 
	      JOIN livraison on livraison.Id_facture = facture.Id_facture 
        JOIN comptefb on comptefb.id = facture.Page
        WHERE livraison.date_de_livraison like '$date' and comptefb.Code_page like '$page' and facture.Status like 'livre' and facture.Id_de_la_mission = 'FACEBOOK' ORDER BY facture.date ASC");
        return $query->result_object();
  	}


  	public function TotalDataParPageLivre($date)
  	{
  		$query =$this->db->query(" SELECT detailvente.Quantite, prix.Prix_detail FROM detailvente 
	      JOIN facture ON detailvente.Facture=facture.Id 
	      JOIN prix ON detailvente.Id_prix=prix.Id 
	      JOIN livraison on livraison.Id_facture = facture.Id_facture 
        JOIN comptefb on comptefb.id = facture.Page
        WHERE livraison.date_de_livraison like '$date'  and facture.Status like 'livre' and facture.Id_de_la_mission = 'FACEBOOK' ORDER BY facture.date ASC");
        return $query->result_object();
  	}

  	public function premier_contact($client)
  	{
  		$query =$this->db->query("SELECT discussion_content.heure FROM discussion_content join discussion ON discussion_content.Id_discussion=discussion.id_discussion WHERE discussion.client like '$client' ORDER by discussion_content.Id ASC LIMIT 1");
  		return $query->row_object();
  	}

  	public function listeCommercial()
  	{
  		$query =$this->db->query("SELECT personnel.Matricule,personnel.Nom, personnel.Prenom, personnel.Contact_du_personnel,personnel.Mode_de_pass_login FROM personnel join facture ON personnel.Matricule=facture.Matricule_personnel WHERE facture.Date BETWEEN CURRENT_DATE - INTERVAL 30 day and CURRENT_DATE and personnel.Fonction_actuelle = 8 GROUP BY personnel.Prenom  ");
  		return $query->result_object();
  	}

  	public function listePageOn($oplg)
  	{
  		$query =$this->db->query("SELECT comptefb.Code_page,comptefb.id, comptefb.Nom_page FROM page_fb JOIN comptefb ON page_fb.Lien_page=comptefb.Lien_page WHERE page_fb.statut like 'on' AND (page_fb.operatrice like '%$oplg%') GROUP BY comptefb.Code_page ");
  		return $query->result_object();
  	}

  	  public function getlivraison($oplg)
	  {    

	    $Current = Date('N');

	    $DaysToSunday = 7 - $Current;

	    $DaysFromMonday = $Current - 1;

	    $Sunday = Date('Y-m-d', StrToTime("+ {$DaysToSunday} Days"));

	    $Monday = Date('Y-m-d', StrToTime("- {$DaysFromMonday} Days"));

	    $query = $this->db->query("SELECT `facture`.`Matricule_personnel`, `clientpo`.`Nom`, `clientpo`.`lien_facebook`, `facture`.`Ville`, `facture`.`contacts`, `prix`.`Code_produit`, `livraison`.`date_de_livraison`, `livraison`.`frais`, `facture`.`Code_client`, `detailvente`.`statut`, `detailvente`.`Quantite`, `detailvente`.`Id_prix`, `facture`.`Status`, `facture`.`lieu_de_livraison`, `facture`.`Id_facture`, `prix`.`Prix_detail`, `facture`.`date` FROM `detailvente` JOIN `facture` ON `facture`.`Id` = `detailvente`.`Facture` JOIN `prix` ON `prix`.`Id` = `detailvente`.`Id_prix` JOIN `produit` ON `produit`.`Code_produit` = `prix`.`Code_produit` JOIN `livraison` ON `livraison`.`Id_facture`=`facture`.`Id_facture` JOIN `clientpo` ON `facture`.`Code_client`=`clientpo`.`Code_client` WHERE facture.Matricule_personnel like '$oplg' and livraison.date_de_livraison BETWEEN '$Monday' and '$Sunday' ");
	    return $query->result();
	    
	  }

	public function getCaLivraison($date, $opl)
	{
		$this->db->select('facture.Date, detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->where('facture.Matricule_personnel', $opl);
		$this->db->like('livraison.date_de_livraison', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		return $this->db->get('detailvente')->result_object();
	}

		public function getTotalCaLivraison($date)
	{
		$this->db->select('facture.Date, detailvente.statut, detailvente.Quantite, facture.Val_bon_achat, detailvente.Id_prix, detailvente.Type_de_prix, prix.Prix_detail');
		$this->db->like('livraison.date_de_livraison', $date);
		$this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
		$this->db->join('prix', 'detailvente.Id_prix=prix.Id');
		$this->db->join('facture', 'detailvente.Facture=facture.Id');
		$this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
		return $this->db->get('detailvente')->result_object();
	}

	public function getlivraisonS($date,$oplg)
	  {    
	    $query = $this->db->query("SELECT `facture`.`Matricule_personnel`, `clientpo`.`Nom`, `clientpo`.`lien_facebook`, `facture`.`Ville`, `facture`.`contacts`, `prix`.`Code_produit`, `livraison`.`date_de_livraison`, `livraison`.`frais`, `facture`.`Code_client`, `detailvente`.`statut`, `detailvente`.`Quantite`, `detailvente`.`Id_prix`, `facture`.`Status`, `facture`.`lieu_de_livraison`, `facture`.`Id_facture`, `prix`.`Prix_detail`, `facture`.`date` FROM `detailvente` JOIN `facture` ON `facture`.`Id` = `detailvente`.`Facture` JOIN `prix` ON `prix`.`Id` = `detailvente`.`Id_prix` JOIN `produit` ON `produit`.`Code_produit` = `prix`.`Code_produit` JOIN `livraison` ON `livraison`.`Id_facture`=`facture`.`Id_facture` JOIN `clientpo` ON `facture`.`Code_client`=`clientpo`.`Code_client` WHERE facture.Matricule_personnel like '$oplg' and livraison.date_de_livraison LIKE '$date' ");
	    return $query->result();
	    
	  }


	  public function get_livraisonS($requette)
	  {    
	   return $this->db->query("SELECT `facture`.`Level`,`prix`.`Zen_LV1`, `prix`.`Zen_LV2`, `prix`.`Zen_LV3`, `prix`.`Zen_LV4`, `prix`.`Zen_LV5`, `prix`.`Smile_LV1`, `prix`.`Smile_LV2`, `prix`.`Smile_LV3`, `prix`.`Smile_LV4`, `prix`.`Smile_LV5`,`comptefb`.`Nom_page`,`facture`.`lieu_livre_clt`,`facture`.`Matricule_personnel`,`facture`.`Localite`,`facture`.`District`,`facture`.`Lieu`, `clientpo`.`Nom`, `clientpo`.`lien_facebook`, `facture`.`Ville`, `facture`.`contacts`, `prix`.`Code_produit`, `livraison`.`date_de_livraison`, `livraison`.`frais`, `facture`.`Page`, `facture`.`Code_client`, `detailvente`.`statut`, `detailvente`.`Quantite`, `detailvente`.`Id_prix`, `facture`.`Status`, `facture`.`lieu_de_livraison`, `facture`.`Id_facture`, `prix`.`Prix_detail`, `facture`.`date` FROM `detailvente` JOIN `facture` ON `facture`.`Id` = `detailvente`.`Facture` JOIN `prix` ON `prix`.`Id` = `detailvente`.`Id_prix` JOIN `produit` ON `produit`.`Code_produit` = `prix`.`Code_produit` JOIN `livraison` ON `livraison`.`Id_facture`=`facture`.`Id_facture` JOIN `clientpo` ON `facture`.`Code_client`=`clientpo`.`Code_client` JOIN `comptefb` ON `comptefb`.`id` = `facture`.`page` WHERE $requette")->result();

	    
	  }
	  public function select_client($param=array()){
		return $this->db->where($param)->get('clientpo')->row_object();
	  }
}

