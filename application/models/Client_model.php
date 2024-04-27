<?php
class Client_model extends CI_Model
{
public function dataClientInfo(){
  return $this->db->query("SELECT CLT.`Code_client` AS 'CODECLIENT',CLT.`lien_facebook` AS 'LIENFACEBOOK',CLT.`Compte_facebook` AS 'COMPTEFACEBOOK',(SELECT `facture`.`contacts` FROM `facture` WHERE `facture`.`Code_client` =CLT.`Code_client` LIMIT 1 ) AS 'CONTACT',(SELECT SUM(`detailvente`.`Quantite`*`prix`.`Prix_detail`) FROM `detailvente` JOIN `prix` ON `prix`.`Id`=`detailvente`.`Id_prix` JOIN `facture` ON `facture`.`Id`=`detailvente`.`Facture` WHERE `detailvente`.`Facture` = `facture`.`Id` AND `facture`.`Code_client`=CLT.`Code_client` ) AS 'CHIFFREAFFAIRE',
  (SELECT SUM(`detailvente`.`Quantite`) FROM `detailvente` JOIN `facture` ON `facture`.`Id`=`detailvente`.`Facture`  WHERE `facture`.`Code_client` = CLT.`Code_client` ) AS 'NBREDARTICLESACHETES',
(SELECT COUNT(fact.`Id`) FROM `facture` as fact WHERE fact.`Code_client`= CLT.`Code_client`)  AS 'NBREDACHATSEFFECTUES'
,(SELECT `prix`.`Code_produit` FROM `detailvente` JOIN `prix` ON `prix`.`Id`=`detailvente`.`Id_prix` JOIN `facture` ON `facture`.`Id`=`detailvente`.`Facture` WHERE `detailvente`.`Facture` = `facture`.`Id` AND `facture`.`Code_client`=CLT.`Code_client` ORDER BY `detailvente`.`Id` DESC  LIMIT 1) AS 'DERNIERARTICLEACHETE',
(SELECT `facture`.`Date` FROM `facture` WHERE `facture`.`Code_client` =CLT.`Code_client`  ORDER BY `facture`.`Id` DESC LIMIT 1 ) AS 'DATEDERNIEREACHAT',
(SELECT `facture`.`District` FROM `facture` WHERE `facture`.`Code_client` =CLT.`Code_client`  ORDER BY `facture`.`Id` DESC LIMIT 1 ) AS 'DERNIEREDISTRICTDELIVRAISON',
(SELECT `facture`.`Ville` FROM `facture` WHERE `facture`.`Code_client` =CLT.`Code_client`  ORDER BY `facture`.`Id` DESC LIMIT 1 ) AS 'DERNIEREVILLERDELIVRAISON',
(SELECT `facture`.`Quartier` FROM `facture` WHERE `facture`.`Code_client` =CLT.`Code_client`  ORDER BY `facture`.`Id` DESC LIMIT 1 ) AS 'DERNIEREQUARTIERDELIVRAISON',
(SELECT COUNT(DISTINCT(`facture`.`Page`)) FROM `facture` WHERE `Code_client`= CLT.`Code_client`) AS 'NOMBREDEPAGECONTACTE',
(SELECT SUM(
  CASE 
    WHEN `facture`.`Level` = 'Level_1' THEN `prix`.`Smile_LV1`
    WHEN `facture`.`Level` = 'Level_2' THEN `prix`.`Smile_LV2`
    WHEN `facture`.`Level` = 'Level_3' THEN `prix`.`Smile_LV3`
    WHEN `facture`.`Level` = 'Level_4' THEN `prix`.`Smile_LV4`
    WHEN `facture`.`Level` = 'Level_5' THEN `prix`.`Smile_LV5`
    ELSE  '0'
  END 
*`detailvente`.`Quantite`) FROM `facture` JOIN `detailvente` ON  `facture`.`Id` = `detailvente`.`Facture` JOIN `prix` ON `prix`.`Id` = `detailvente`.`Id_prix`   WHERE `facture`.`Code_client` =CLT.`Code_client` AND `facture`.`data_de_livraison` BETWEEN '2021-04-01' AND '2021-07-31')  AS 'SMILES',
(SELECT 
  SUM(
  CASE 
    WHEN `facture`.`Level` = 'Level_1' THEN `prix`.`Zen_LV1`
    WHEN `facture`.`Level` = 'Level_2' THEN `prix`.`Zen_LV2`
    WHEN `facture`.`Level` = 'Level_3' THEN `prix`.`Zen_LV3`
    WHEN `facture`.`Level` = 'Level_4' THEN `prix`.`Zen_LV4`
    WHEN `facture`.`Level` = 'Level_5' THEN `prix`.`Zen_LV5`
    ELSE  '0'
  END 
*`detailvente`.`Quantite`) FROM `facture` JOIN `detailvente` ON  `facture`.`Id` = `detailvente`.`Facture` JOIN `prix` ON `prix`.`Id` = `detailvente`.`Id_prix`   WHERE `facture`.`Code_client` =CLT.`Code_client` AND `facture`.`data_de_livraison` BETWEEN '2021-04-01' AND '2021-07-31') AS 'KOTY' 

 FROM `clientpo` AS CLT WHERE CLT.`Code_client` LIKE 'CMT-FB-%'")->result_object();
  }
  public function pageliste(){
  	return $this->db->get("page_fb")->result_object();
  }
  public function listeClient(){
  		return $this->db->get("clientpo")->result_object();
  }
 public function nombre_client()
    {
      return $this->db->count_all_results('clientpo');
    }
 public function get_client($limit, $start) {
      $this->db->limit($limit, $start);
      return $this->db->get('clientpo')->result();
   }
  public function testPage($Code_client,$Id){
  	return $this->db->query("SELECT `discussion_content`.`heure` As 'date' FROM `discussion_content` join  `discussion` ON `discussion_content`.Id_discussion = `discussion`.`id_discussion` WHERE `discussion`.`Page` = '".$Id."'AND `discussion`.`client` = '".$Code_client."' ORDER BY `discussion_content`.`Id` DESC LIMIT 1")->row_object();
  }  
  public function discussion_content(){
    $this->db->select("`Id_discussion`,`heure`,`Page`");
    return $this->db->get('discussion_content')->result_object();
  }
  public function inserdiscussioncontent($data){
    return $this->db->insert("discussion_content",$data);
  }
  public function client_a_traiterAAC7($user){
		$user = $this->session->userdata('matricule'); 
		$query = $this->db->query("SELECT session.client,clientpo.Compte_facebook,clientpo.lien_facebook, session.date,session.idaction, comptefb.Nom_page,session.operatrice,
		(SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY AND CURRENT_DATE() AND facture.Code_client = session.client  LIMIT 1 ) AS 'FACTURE',
		(SELECT sess.client FROM session AS sess WHERE   sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK'
		FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client
			AND session.action <> 'vente' AND session.sender like 'OPL' 
			AND session.date =CURRENT_DATE() - INTERVAL 21 DAY
			AND session.operatrice = '$user'
			GROUP BY session.client");
		return $query->result();
	  }

    /*public function client_a_traiterAAC7S(){
      $query = $this->db->query("SELECT session.client,session.operatrice,clientpo.Compte_facebook,clientpo.lien_facebook, session.date,session.idaction, comptefb.Nom_page,session.operatrice, (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY AND CURRENT_DATE() AND facture.Code_client = session.client LIMIT 1 ) AS 'FACTURE', (SELECT sess.client FROM session AS sess WHERE sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK' FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client AND session.action <> 'vente' AND session.sender like 'OPL' AND session.date =CURRENT_DATE() - INTERVAL 21 DAY  GROUP BY session.client");
      return $query->result();
    }*/

    public function client_a_traiterAAC7S($user){
      $query = $this->db->query("SELECT session.client,session.operatrice,clientpo.Compte_facebook,clientpo.lien_facebook, session.date,session.idaction, comptefb.Nom_page,session.operatrice, (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY AND CURRENT_DATE() AND facture.Code_client = session.client LIMIT 1 ) AS 'FACTURE', (SELECT sess.client FROM session AS sess WHERE sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK' FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client AND session.action <> 'vente' AND session.sender like 'OPL' AND session.date =CURRENT_DATE() - INTERVAL 21 DAY and session.operatrice = '$user'  GROUP BY session.client");
      return $query->result();
    }
    public function client_a_traiterAAC7Sa($user){
      $query = $this->db->query("SELECT session.client, (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY AND CURRENT_DATE() AND facture.Code_client = session.client LIMIT 1 ) AS 'FACTURE', (SELECT sess.client FROM session AS sess WHERE sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK' FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client AND session.action <> 'vente' AND session.sender like 'OPL' AND session.date =CURRENT_DATE() - INTERVAL 42 DAY and session.operatrice = '$user'  GROUP BY session.client");
      return $query->result();
    }

    public function client_a_traiterAAC7SSS($user){
      $query = $this->db->query("SELECT session.client,session.operatrice,clientpo.Compte_facebook,clientpo.lien_facebook, session.date,session.idaction, comptefb.Nom_page,session.operatrice, (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY AND CURRENT_DATE() AND facture.Code_client = session.client LIMIT 1 ) AS 'FACTURE', (SELECT sess.client FROM session AS sess WHERE sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK' FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client AND session.action <> 'vente' AND session.sender like 'OPL' AND session.date =CURRENT_DATE() - INTERVAL 28 DAY and session.operatrice = '$user'  GROUP BY session.client");
      return $query->result();
    }

    public function client_a_traiterAAC735($user){
      $query = $this->db->query("SELECT session.client, (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY AND CURRENT_DATE() AND facture.Code_client = session.client LIMIT 1 ) AS 'FACTURE', (SELECT sess.client FROM session AS sess WHERE sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK' FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client AND session.action <> 'vente' AND session.sender like 'OPL' AND session.date =CURRENT_DATE() - INTERVAL 35 DAY and session.operatrice = '$user'  GROUP BY session.client");
      return $query->result();
    }

    public function client_a_traiterAAC749($user){
      $query = $this->db->query("SELECT session.client, (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY AND CURRENT_DATE() AND facture.Code_client = session.client LIMIT 1 ) AS 'FACTURE', (SELECT sess.client FROM session AS sess WHERE sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK' FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client AND session.action <> 'vente' AND session.sender like 'OPL' AND session.date =CURRENT_DATE() - INTERVAL 49 DAY and session.operatrice = '$user'  GROUP BY session.client");
      return $query->result();
    }


    public function client_a_traiterAAC7Ss($user){
      $query = $this->db->query("SELECT session.client,clientpo.Compte_facebook,clientpo.lien_facebook, session.date,session.idaction, comptefb.Nom_page,session.operatrice, (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY AND CURRENT_DATE() AND facture.Code_client = session.client LIMIT 1 ) AS 'FACTURE', (SELECT sess.client FROM session AS sess WHERE sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK' FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client AND session.action <> 'vente' AND session.sender like 'OPL' AND session.date =CURRENT_DATE() - INTERVAL 28 DAY AND session.operatrice = '$user' GROUP BY session.client");
      return $query->result();
    }

    public function dataOPL()
    {
      $this->db->DISTINCT('operatrice');
      $this->db->select('operatrice');
      $this->db->where('statut','on');
      return $this->db->get('page_fb')->result_object();
    }

    /*public function liste_oplgg($mois)
    {      
      $query=$this->db->query("SELECT `personnel`.`Prenom`, `session`.`operatrice` FROM `session` JOIN `personnel` ON `session`.`operatrice`=`personnel`.`Matricule` WHERE `operatrice` LIKE 'VB%' OR `operatrice` LIKE 'VH%' OR `operatrice` LIKE 'CT%'  AND `session`.`date` LIKE '$mois%'  GROUP BY `session`.`operatrice`");
      return $query->result();
    }*/

    public function liste_oplgg($mois)
    {
      $this->db->group_by('personnel.Prenom');
      //$this->db->distinct();
      $this->db->select('facture.Matricule_personnel,personnel.Prenom');
      $this->db->like('facture.Date', $mois, 'after');
      $this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
      $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
      return $this->db->get('facture')->result_object();
    }
    public function insertclient_a_traiter($data){
        return $this->db->insert('client_a_traiter',$data);
    }

  public function insertparametreRelance($data){
      return $this->db->insert('parametreRelance',$data);
   }
   public function updateParametre($parametre,$data){
    return $this->db->where($parametre)->update('parametreRelance',$data);

   }

   public function rang_koty()
{
  $query = $this->db->query("SELECT facture.Code_client,facture.Date,comptefb.Nom_page,facture.Id_facture,clientpo.Compte_facebook,facture.contacts,produit.Code_produit,detailvente.Quantite,prix.Prix_detail,produit.Designation FROM facture 
  JOIN detailvente ON facture.Id = detailvente.Facture 
  JOIN prix ON prix.Id=detailvente.Id_prix 
  JOIN clientpo ON clientpo.Code_client=facture.Code_client 
  JOIN produit ON produit.Code_produit=prix.Code_produit
  JOIN comptefb ON comptefb.id=facture.Page
  ORDER BY facture.Date  DESC LIMIT 100");

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
    ) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix` JOIN produit ON produit.Code_produit = prix.Code_produit   WHERE  facture.Id_facture like '$facture' order by koty ");
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
) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix`   WHERE facture.`Code_client` LIKE '$Code_client' and facture.data_de_livraison like '2021%' ");
    return $query->result();
  }

  public function gettotalsmileskoty($Code_client)
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
) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix`   WHERE facture.`Code_client` LIKE '$Code_client' AND facture.`data_de_livraison` BETWEEN '2021-04-01' AND '2021-07-31'");
    return $query->result();
  }

  public function dernier_contact($client)
{
  $query = $this->db->query("SELECT heure FROM discussion_content JOIN discussion ON discussion_content.Id_discussion = discussion.id_discussion WHERE discussion.client ='$client'  ORDER BY discussion_content.Id DESC LIMIT 1 ");

return $query->row_object();
}

public function getkotyetsmilesdetail($facture)
  {
    $query = $this->db->query("SELECT produit.Designation, detailvente.Quantite, 
        CASE 
          WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`
          WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`
          WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`
          WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`
          WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`
          ELSE  '0'
        END 
      AS 'smiles',
     
        CASE 
          WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`
          WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`
          WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`
          WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`
          WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`
          ELSE  '0'
        END 
      AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix` JOIN produit ON produit.Code_produit = prix.Code_produit   WHERE  facture.Id_facture like '$facture' and facture.data_de_livraison like '2021%'");
    return $query->result();
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

      $statut = "Votre statut n'est pas valide, veillez consulter le responsable technique";
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

  public function client()
  {  
    $query = $this->db->query("SELECT facture.Code_client,clientpo.Compte_facebook,clientpo.lien_facebook,comptefb.Nom_page FROM facture JOIN comptefb on comptefb.id = facture.Page JOIN clientpo ON clientpo.Code_client = facture.Code_client  GROUP BY facture.Code_client ");
    return $query->result_object();
  }

  public function clients()
  {  
    $query = $this->db->query("SELECT facture.Code_client,clientpo.Compte_facebook,comptefb.Nom_page FROM facture JOIN comptefb on comptefb.id = facture.Page JOIN clientpo ON clientpo.Code_client = facture.Code_client and comptefb.id=5  GROUP BY facture.Code_client ");
    return $query->result_object();
  }

  public function client1()
  {  
    $query = $this->db->query("SELECT facture.Code_client,clientpo.Compte_facebook,comptefb.Nom_page FROM facture JOIN comptefb on comptefb.id = facture.Page JOIN clientpo ON clientpo.Code_client = facture.Code_client and comptefb.id=12  GROUP BY facture.Code_client ");
    return $query->result_object();
  }

public function stat($client)
{
  $query = $this->db->query("SELECT  clientpo.lien_facebook,facture.Date,facture.Matricule_personnel,facture.Ress_sec_oplg,comptefb.Nom_page,facture.Id_facture,clientpo.Compte_facebook,facture.contacts,produit.Code_produit,detailvente.Quantite,prix.Prix_detail,produit.Designation FROM facture 
  JOIN detailvente ON facture.Id = detailvente.Facture 
  JOIN prix ON prix.Id=detailvente.Id_prix 
  JOIN clientpo ON clientpo.Code_client=facture.Code_client 
  JOIN produit ON produit.Code_produit=prix.Code_produit
  JOIN comptefb ON comptefb.id=facture.Page
  WHERE facture.Code_client ='$client'
  GROUP BY facture.Id
  ORDER BY facture.Date DESC");

  return $query->result_object();
}

public function vivitecwjii()
{  
  $query = $this->db->query("SELECT facture.Code_client,clientpo.Compte_facebook,comptefb.Nom_page FROM facture JOIN comptefb on comptefb.id = facture.Page JOIN clientpo ON clientpo.Code_client = facture.Code_client and comptefb.id=45  GROUP BY facture.Code_client ");
  return $query->result_object();
}

public function viviteccjia()
{  
  $query = $this->db->query("SELECT facture.Code_client,clientpo.Compte_facebook,comptefb.Nom_page FROM facture JOIN comptefb on comptefb.id = facture.Page JOIN clientpo ON clientpo.Code_client = facture.Code_client and comptefb.id=91  GROUP BY facture.Code_client ");
  return $query->result_object();
}

public function viviteccjii()
{  
  $query = $this->db->query("SELECT facture.Code_client,clientpo.Compte_facebook,comptefb.Nom_page FROM facture JOIN comptefb on comptefb.id = facture.Page JOIN clientpo ON clientpo.Code_client = facture.Code_client and comptefb.id=47  GROUP BY facture.Code_client ");
  return $query->result_object();
}

public function viviteswjii()
{  
  $query = $this->db->query("SELECT facture.Code_client,clientpo.Compte_facebook,comptefb.Nom_page FROM facture JOIN comptefb on comptefb.id = facture.Page JOIN clientpo ON clientpo.Code_client = facture.Code_client and comptefb.id=48  GROUP BY facture.Code_client ");
  return $query->result_object();
}

public function gelnbiifl()
{  
  $query = $this->db->query("SELECT facture.Code_client,clientpo.Compte_facebook,comptefb.Nom_page FROM facture JOIN comptefb on comptefb.id = facture.Page JOIN clientpo ON clientpo.Code_client = facture.Code_client and comptefb.id=103  GROUP BY facture.Code_client ");
  return $query->result_object();
}

public function gelnpjiifl()
{  
  $query = $this->db->query("SELECT facture.Code_client,clientpo.Compte_facebook,comptefb.Nom_page FROM facture JOIN comptefb on comptefb.id = facture.Page JOIN clientpo ON clientpo.Code_client = facture.Code_client and comptefb.id=35  GROUP BY facture.Code_client ");
  return $query->result_object();
}

public function gelnpfpji()
{  
  $query = $this->db->query("SELECT facture.Code_client,clientpo.Compte_facebook,comptefb.Nom_page FROM facture JOIN comptefb on comptefb.id = facture.Page JOIN clientpo ON clientpo.Code_client = facture.Code_client and comptefb.id=106  GROUP BY facture.Code_client ");
  return $query->result_object();
}

public function getkotyclient($client)
{
  $this->db->select('Koty');
  $this->db->where('Client',$client);
  return $this->db->get('Compte')->result_object();
}
public function insertRelanceDiscussion($param){
   return $this->db->insert('relanceDiscussion',$param);
   
}  

public function selectsRelanceDiscussion($param){
   return $this->db->where($param)->get('relanceDiscussion')->result_object();
   
}  
public function selectRelanceDiscussion($param){
   return $this->db->where($param)->get('relanceDiscussion')->row_object();
   
}  

public function deleteRelanceDiscussion($param){
   return $this->db->where($param)->delete('relanceDiscussion');
   
} 
public function get_ca_haours($requette){
  $requete ="SELECT SUM(prix.Prix_detail * detailvente.Quantite) AS 'vente' FROM facture JOIN detailvente ON detailvente.Facture = facture.Id JOIN prix on detailvente.Id_prix = prix.Id WHERE $requette AND facture.Id_de_la_mission ='FACEBOOK'";
  return $this->db->query($requete)->row_object();
}
public function get_ca_haours_client($requette){
  $requete ="SELECT SUM(prix.Prix_detail * detailvente.Quantite) AS 'vente',facture.Matricule_personnel AS 'matricule',personnel.Nom ,personnel.Prenom FROM facture JOIN personnel ON facture.Matricule_personnel = personnel.Matricule JOIN detailvente ON detailvente.Facture = facture.Id JOIN prix on detailvente.Id_prix = prix.Id WHERE $requette AND facture.Id_de_la_mission ='FACEBOOK' group by facture.Matricule_personnel";
  return $this->db->query($requete)->result_object();
}
public function get_page_facture($param){
  $requete = "SELECT comptefb.Nom_page,comptefb.id,comptefb.Code_page FROM facture JOIN comptefb ON comptefb.id = facture.Page WHERE $param GROUP BY facture.Page ";
   return $this->db->query($requete)->result_object();
}
public function select_client($param=array()){
  return $this->db->where($param)->get('clientpo')->row_object();
}

}


