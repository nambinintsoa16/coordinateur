<?php
class tsenakoty_model extends CI_Model{
 public function __construct(){

 }

 public function liste_client_facture_tsena_koty($mois)
  {
    $this->db->select('facture.id as fatcure,detailvente.Id,detailvente.statut,produit.Code_produit,detailvente.statut,prix.Prix_detail,produit.Designation,detailvente.Quantite, clientpo.Compte_facebook, facture.lieu_de_livraison,facture.data_de_livraison,facture.Status');
    $this->db->like('facture.data_de_livraison', $mois);
    $this->db->like('facture.source', 'tsena_koty');
    $this->db->like('facture.Status', 'livre');
    $this->db->join('facture', 'facture.Id=detailvente.facture');
    $this->db->join('clientpo', 'facture.Code_client=clientpo.Code_client');
    $this->db->join('prix', 'prix.Id=detailvente.Id_prix');
    $this->db->join('produit', 'prix.Code_produit=produit.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }

   public function listeOplg($mois)
    {
      $this->db->group_by('facture.Ress_sec_oplg');
      $this->db->select('facture.Ress_sec_oplg');
       $this->db->where('(facture.Ress_sec_oplg LIKE "VB%" OR facture.Ress_sec_oplg LIKE "VH%" OR facture.Ress_sec_oplg LIKE "CT%"  OR facture.Ress_sec_oplg LIKE "VN%")');
      $this->db->where('facture.Id_de_la_mission', 'TSENA_KOTY');
      $this->db->like('facture.Date',$mois);
      $this->db->join('facture','facture.Matricule_personnel = personnel.Matricule');
      return $this->db->get('personnel')->result_object();
    }

  public function listecommerciales($mois)
    {
      $this->db->group_by('facture.Matricule_personnel');
      $this->db->select('facture.Matricule_personnel');
       $this->db->where('(facture.Matricule_personnel LIKE "VB%" OR facture.Matricule_personnel LIKE "VH%" OR facture.Matricule_personnel LIKE "CT%"  OR facture.Matricule_personnel LIKE "VN%")');
      $this->db->where('facture.typeFacture', 'Promotion');
      $this->db->like('facture.Date',$mois);
      $this->db->join('facture','facture.Matricule_personnel = personnel.Matricule');
      return $this->db->get('personnel')->result_object();
    }


    public function goodies()
    {

    }

  public function countProduits($oplg, $date,$code_produit)
  {
    $this->db->where('facture.Ress_sec_oplg', $oplg);
    $this->db->like('facture.Date', $date);
    $this->db->like('produit.Code_produit', $code_produit);
    $this->db->where('facture.Id_de_la_mission', 'TSENA_KOTY');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    return $this->db->count_all_results('detailvente');
  }

  public function count_Produits($oplg, $date)
  {
    $this->db->where('facture.Ress_sec_oplg', $oplg);
    $this->db->like('facture.Date', $date);
    $this->db->where('(produit.Code_produit LIKE "PK-LES003" OR produit.Code_produit LIKE "PK-LES004")');
    $this->db->where('facture.Id_de_la_mission', 'TSENA_KOTY');
    $this->db->where('(facture.Ress_sec_oplg LIKE "VB%" OR facture.Ress_sec_oplg LIKE "VH%" OR facture.Ress_sec_oplg LIKE "CT%"  OR facture.Ress_sec_oplg LIKE "VN%")');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    return $this->db->count_all_results('detailvente');
  }

  public function count_Produit($date)
  {
    //$this->db->where('facture.Ress_sec_oplg', $oplg);
    $this->db->like('facture.Date', $date);
    $this->db->where('(produit.Code_produit LIKE "PK-LES003" OR produit.Code_produit LIKE "PK-LES004")');
    $this->db->where('facture.Id_de_la_mission', 'TSENA_KOTY');
    $this->db->where('(facture.Ress_sec_oplg LIKE "VB%" OR facture.Ress_sec_oplg LIKE "VH%" OR facture.Ress_sec_oplg LIKE "CT%"  OR facture.Ress_sec_oplg LIKE "VN%")');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    return $this->db->count_all_results('detailvente');
  }
   public function countProduitsMensuels($date,$code_produit)
  {
    $this->db->like('facture.Date', $date);
    $this->db->like('produit.Code_produit', $code_produit);
    $this->db->where('facture.Id_de_la_mission', 'TSENA_KOTY');
    $this->db->where('(facture.Ress_sec_oplg LIKE "VB%" OR facture.Ress_sec_oplg LIKE "VH%" OR facture.Ress_sec_oplg LIKE "CT%"  OR facture.Ress_sec_oplg LIKE "VN%")');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    return $this->db->count_all_results('detailvente');
  }

  public function listeClients($date,$code_produit)
  {
    $this->db->group_by('clientpo.Code_client');
    $this->db->select('clientpo.Code_client, clientpo.Compte_facebook, clientpo.lien_facebook');
    //$this->db->where('facture.Ress_sec_oplg', $oplg);
    $this->db->like('facture.Date', $date);
    $this->db->like('produit.Code_produit', $code_produit);
     $this->db->where('(facture.Ress_sec_oplg LIKE "VB%" OR facture.Ress_sec_oplg LIKE "VH%" OR facture.Ress_sec_oplg LIKE "CT%"  OR facture.Ress_sec_oplg LIKE "VN%")');
    $this->db->where('facture.Id_de_la_mission', 'TSENA_KOTY');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    $this->db->join('clientpo', 'clientpo.Code_client=facture.Code_client');
    return $this->db->get('detailvente')->result_object();;
  }

   public function liste_Clients($date)
  {
    $this->db->group_by('clientpo.Code_client');
    $this->db->select('clientpo.Code_client, clientpo.Compte_facebook, clientpo.lien_facebook');
    //$this->db->where('facture.Ress_sec_oplg', $oplg);
    $this->db->like('facture.Date', $date);
    $this->db->where('(produit.Code_produit LIKE "PK-LES003" OR produit.Code_produit LIKE "PK-LES004")');
     $this->db->where('(facture.Ress_sec_oplg LIKE "VB%" OR facture.Ress_sec_oplg LIKE "VH%" OR facture.Ress_sec_oplg LIKE "CT%"  OR facture.Ress_sec_oplg LIKE "VN%")');
    $this->db->where('facture.Id_de_la_mission', 'TSENA_KOTY');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    $this->db->join('clientpo', 'clientpo.Code_client=facture.Code_client');
    return $this->db->get('detailvente')->result_object();;
  }

  public function ca_promotion_livre($mois)
  {
    $this->db->select('facture.id as fatcure,detailvente.Id,detailvente.statut, produit.Code_produit,detailvente.statut,prix.Prix_detail, produit.Designation, detailvente.Quantite, clientpo.Compte_facebook, facture.lieu_de_livraison, facture.data_de_livraison, facture.Status');
    $this->db->like('facture.data_de_livraison', $mois);
    //$this->db->like('facture.source', 'tsena_koty');
    $this->db->like('facture.Status', 'livre');
    $this->db->like('facture.typeFacture', "Promotion");
    $this->db->join('facture', 'facture.Id=detailvente.facture');
    $this->db->join('clientpo', 'facture.Code_client=clientpo.Code_client');
    $this->db->join('prix', 'prix.Id=detailvente.Id_prix');
    $this->db->join('produit', 'prix.Code_produit=produit.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }

   public function ca_previ_par_oplg($mois,$oplg)
  {
    $this->db->select('facture.id as fatcure,detailvente.Id,detailvente.statut, produit.Code_produit,detailvente.statut,prix.Prix_detail, produit.Designation, detailvente.Quantite,  facture.lieu_de_livraison, facture.data_de_livraison, facture.Status');
    $this->db->like('livraison.date_de_livraison', $mois);
    $this->db->like('facture.Matricule_personnel', $oplg);
    //$this->db->like('facture.Status', 'livre');
    $this->db->like('facture.typeFacture', "Promotion");
    $this->db->join('facture', 'facture.Id=detailvente.facture');
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    $this->db->join('prix', 'prix.Id=detailvente.Id_prix');
    $this->db->join('produit', 'prix.Code_produit=produit.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }

  public function ca_livre_par_oplg($mois,$oplg)
  {
    $this->db->select('facture.id as fatcure,detailvente.Id,detailvente.statut, produit.Code_produit,detailvente.statut,prix.Prix_detail, produit.Designation, detailvente.Quantite,  facture.lieu_de_livraison, facture.data_de_livraison, facture.Status');
    $this->db->like('livraison.date_de_livraison', $mois);
    $this->db->like('facture.Matricule_personnel', $oplg);
    $this->db->like('facture.Status', 'livre');
    $this->db->like('facture.typeFacture', "Promotion");
    $this->db->join('facture', 'facture.Id=detailvente.facture');
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    $this->db->join('prix', 'prix.Id=detailvente.Id_prix');
    $this->db->join('produit', 'prix.Code_produit=produit.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }

  public function ca_reel_par_oplg($mois,$oplg)
  {
    $this->db->select('facture.id as fatcure,detailvente.Id,detailvente.statut, produit.Code_produit,detailvente.statut,prix.Prix_detail, produit.Designation, detailvente.Quantite, clientpo.Compte_facebook, facture.lieu_de_livraison, facture.data_de_livraison, facture.Status');
    $this->db->like('facture.date', $mois);
    $this->db->like('facture.Matricule_personnel', $oplg);
    $this->db->like('facture.Status', 'livre');
    $this->db->like('facture.typeFacture', "Promotion");
    $this->db->join('facture', 'facture.Id=detailvente.facture');
    $this->db->join('clientpo', 'facture.Code_client=clientpo.Code_client');
    $this->db->join('prix', 'prix.Id=detailvente.Id_prix');
    $this->db->join('produit', 'prix.Code_produit=produit.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }

  public function type_promotion()
  {
    $this->db->distinct('codePromo');
    $this->db->select('codePromo');
    $this->db->where('typeFacture',"Promotion");
    return $this->db->get('facture')->result_object();
  }


  public function offre_promotion()
  {
    $this->db->select('Pr_Code_Promo');
    $this->db->where('(Pr_Montant <> 0)');
    return $this->db->get('promotion')->result_object();

  }

  public function offre_promotionnel()
  {
    $this->db->select('Pr_Code_Promo');
    $this->db->where('(Pr_Montant <> 0)');
    $this->db->like('Pr_Status','en_cours');
    return $this->db->get('promotion')->result_object();

  }




}