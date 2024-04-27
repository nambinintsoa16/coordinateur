<?php
defined('BASEPATH') or exit('No direct script access allowed');
$type_user = "Administrateur|administrateur|Developpeur|developpeur|Coordinateur|coordinateur";
$route["($type_user)"] = 'accueil';
$route['default_controller'] = 'Authentification';
$route['404_override'] = '';
$route['Authentification'] = 'authentification';
/*------------ client ----------------------- */
$route["($type_user)/client/liste"] = 'client/liste';
$route["($type_user)/client/Page_facebook_client_client"] = 'client/pageclient';
$route["($type_user)/client/client_par_page"] = 'client/pageclient/';
$route["($type_user)/client/client_par_page/(:any)"] = 'client/pageclient/$2';
$route["($type_user)/client/export_pageClient"] = 'client/export_pageClient';
$route["($type_user)/client/data_discussion"] = 'client/data_discussion';
$route["($type_user)/client/clientsac"] = 'client/clientsac';
$route["($type_user)/client/rang"] = 'client/rang';
$route["($type_user)/client/rangs"] = 'client/rangs';
$route["($type_user)/client/liste_des_clients"] = 'client/liste_des_clients';

/*-------------------mensuel-----------------------*/
$route["($type_user)/mensuel/mois"] = 'mensuel/mois';
$route["($type_user)/mensuel/bilan"] = 'mensuel/bilan';
$route["($type_user)/mensuel/etatGlobal"] = 'mensuel/etatGlobal';
$route["($type_user)/mensuel/etatGlobalReel"] = 'mensuel/etatGlobalReel';
$route["($type_user)/mensuel/etatGlobalLivre"] = 'mensuel/etatGlobalLivre';
$route["($type_user)/mensuel/etatParMatricule"] = 'mensuel/etatParMatricule';
$route["($type_user)/mensuel/etatParPage"] = 'mensuel/etatParPage';
$route["($type_user)/mensuel/etatReel"] = 'mensuel/etatReel';
$route["($type_user)/mensuel/etatLivre"] = 'mensuel/etatLivre';
$route["($type_user)/mensuel/previsionnel"] = 'mensuel/previsionnel';
$route["($type_user)/mensuel/reel"] = 'mensuel/reel';
$route["($type_user)/mensuel/livre"] = 'mensuel/livre';
/*-------------------prime-----------------------*/
$route["($type_user)/prime/prime"] = 'prime/prime';

/*-------------------listeOplg-----------------------*/
$route["($type_user)/operatrice/listeOplg"] = 'operatrice/listeOplg';
$route["($type_user)/operatrice/livraison"] = 'operatrice/livraison';
/*-------------------semaine-----------------------*/
$route["($type_user)/semaine/previsionnel"] = 'semaine/previsionnel';
$route["($type_user)/semaine/livre"] = 'semaine/livre';
$route["($type_user)/semaine/reel"] = 'semaine/reel';
/*-------------------hebdomadaire-----------------------*/
$route["($type_user)/hebdomadaire/previsionnel"] = 'hebdomadaire/previsionnel';
$route["($type_user)/hebdomadaire/livre"] = 'hebdomadaire/livre';
$route["($type_user)/hebdomadaire/reel"] = 'hebdomadaire/reel';

$route["($type_user)/hebdomadaire/rapport_previsionnel"] = 'hebdomadaire/rapport_previsionnel';
$route["($type_user)/hebdomadaire/rapport_livre"] = 'hebdomadaire/rapport_livre';
$route["($type_user)/hebdomadaire/rapport_reel"] = 'hebdomadaire/rapport_reel';

$route["($type_user)/hebdomadaire/detailPrevisionnel"] = 'hebdomadaire/detailPrevisionnel';
$route["($type_user)/hebdomadaire/detailReel"] = 'hebdomadaire/detailReel';
$route["($type_user)/hebdomadaire/detailLivre"] = 'hebdomadaire/detailLivre';
$route["($type_user)/Hebdomadaire/par_matricule"] = 'hebdomadaire/par_matricule';
$route["($type_user)/Hebdomadaire/par_page"] = 'hebdomadaire/par_page';
$route["($type_user)/Hebdomadaire/par_mensuel"] = 'hebdomadaire/par_mensuel';

/*-------------------performance-----------------------*/
$route["($type_user)/performance/perfo"] = 'performance/perfo';
$route["($type_user)/performance/liste_clients"] = 'performance/liste_clients';
$route["($type_user)/performance/mois"] = 'performance/mois';
$route["($type_user)/performance/mensuelle"] = 'performance/mensuelle';
$route["($type_user)/performance/jour"] = 'performance/jour';
$route["($type_user)/performance/jaime"] = 'performance/jaime';
$route["($type_user)/performance/like"] = 'performance/like';
$route["($type_user)/performance/page"] = 'performance/page';
$route["($type_user)/performance/like_detail"] = 'performance/like_detail';
$route["($type_user)/performance/page_mensuelle"] = 'performance/page_mensuelle';
$route["($type_user)/performance/appel"] = 'performance/appel';
$route["($type_user)/performance/detail_appel"] = 'performance/detail_appel';
$route["($type_user)/performance/journalier"] = 'performance/journalier';
$route["($type_user)/performance/prime"] = 'performance/prime';
$route["($type_user)/performance/discussionJournaliere"] = 'performance/discussionJournaliere';
$route["($type_user)/performance/discussionParMatricule"] = 'performance/discussionParMatricule';
$route["($type_user)/performance/EtatDiscussion"] = 'performance/EtatDiscussion';
$route["($type_user)/performance/etatNouveauxClt"] = 'performance/etatNouveauxClt';
$route["($type_user)/performance/etatAncienClt"] = 'performance/etatAncienClt';
$route["($type_user)/performance/etatParPage"] = 'performance/etatParPage';


/*-------------------ca_test-----------------------*/
$route["($type_user)/chiffre_d_affaire/etat_previsionnel"] = 'chiffre_d_affaire/etat_previsionnel';
$route["($type_user)/chiffre_d_affaire/etat_reel"] = 'chiffre_d_affaire/etat_reel';
$route["($type_user)/chiffre_d_affaire/etat_livre"] = 'chiffre_d_affaire/etat_livre';

/*-------------------assiduité-----------------------*/
$route["($type_user)/assiduite/presence"]= 'assiduite/presence';
$route["($type_user)/assiduite/presence_mensuelle"]= 'assiduite/presence_mensuelle';
$route["($type_user)/assiduite/details_intervalle"]= 'assiduite/details_intervalle';
$route["($type_user)/assiduite/detail_calendrier"]= 'assiduite/detail_calendrier';
$route["($type_user)/assiduite/assiduit"]= 'assiduite/assiduit';

/*-------------------nouveaux clients-----------------------*/
$route["($type_user)/nouveaux/journalier"]= 'nouveaux/journalier';
$route["($type_user)/nouveaux/jours_derniers"]= 'nouveaux/jours_derniers';
$route["($type_user)/nouveaux/mensuel"]= 'nouveaux/mensuel';
$route["($type_user)/nouveaux/detail_liste"]= 'nouveaux/detail_liste';
$route["($type_user)/nouveaux/listeclients"]= 'nouveaux/listeclients';
$route["($type_user)/nouveaux/liste_produit"]= 'nouveaux/liste_produit';
$route["($type_user)/nouveaux/premier_achat"]= 'nouveaux/premier_achat';
$route["($type_user)/nouveaux/detail_clients"]= 'nouveaux/detail_clients';
$route["($type_user)/nouveaux/liste_premier_achat"]= 'nouveaux/liste_premier_achat';
/*-------------------facture-----------------------*/
$route["($type_user)/facture/Rapport_facture"]= 'Performance/liste_facture';


/*-------------------assiduité-----------------------*/
$route["($type_user)/relance/rapportRelance"]= 'relance/rapportRelance';


/*-------------------tsenakoty-----------------------*/
$route["($type_user)/tsenakoty/etat_tsenakoty"] = 'tsenakoty/etat_tsenakoty';
$route["($type_user)/tsenakoty/goodies"] = 'tsenakoty/goodies';
$route["($type_user)/tsenakoty/offre_promo"] = 'tsenakoty/offre_promo';
/*-----------------------------------------------------*/



$route["($type_user)/semaine"] = 'semaine';
$route["($type_user)/mensuel"] = 'mensuel';
$route["($type_user)/livre"] = 'livre';
$route["($type_user)/reel"] = 'reel';
$route["($type_user)/hebdo"] = 'hebdo';
$route["($type_user)/hebdo_livre"] = 'hebdo_livre';
$route["($type_user)/hebdo2"] = 'hebdo2';
$route["($type_user)/login/(:any)/(:any)"] = 'accueil/logindata/$2/$3';
$route['translate_uri_dashes'] = FALSE;
