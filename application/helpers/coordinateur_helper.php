<?php

function breadcrumb($uri){
	$breadcrumb = $uri;
	if ( $uri[1] == "authentification" || $uri[1] == "Authentification"  ): return "";?>
  

	<?php elseif (!isset($uri[2]) || !isset($_SESSION["matricule"]) ):?>

		<nav aria-label="breadcrumb" class="w-100">
			 <ol class="breadcrumb">
			 <li class="breadcrumb-item"><a href="<?= base_url("$uri[1]/") ?>">Accueil</a></li>
			 	</ol>
		</nav>
     
     <?php 

elseif ( $uri[2] != "Compte" ):
		?>

		<nav aria-label="breadcrumb" class="w-100">
			<ol class="breadcrumb">
			<!-- <li class="breadcrumb-item"><a href="<?= base_url("$uri[1]/") ?>">Accueil</a></li>!-->
				<?php
				for($i = 2; $i <= count($breadcrumb); $i++){
					if ($i == (count($breadcrumb)) || $i < 3 ):
						?>
						<li class="breadcrumb-item active" aria-current="page"><?= tobreadcrumb($uri[$i]) ?></li>

						<?php

					else:

						$link = [];
						for ($j = $i; $j >= 1 ; $j--) {
							$link[] = $uri[$j];
						}
						$link = implode("/", array_reverse($link));

						?>

						<li class="breadcrumb-item "><a href="<?= base_url("$link") ?>"><?= tobreadcrumb($uri[$i]) ?></a></li>

						<?php
					endif;
				}
				?>
			</ol>
		</nav>
		<?php
	endif;

}

function tobreadcrumb($txt_){
	$txt_ = str_split($txt_);
	$txt = "";
	foreach ($txt_ as $char) {
		if (ord($char) <= 90)  {
			$txt .= " $char";
		}
		else{
			$txt .= "$char";
		}
	}

	$txt = str_replace(".php", "", $txt);
	$txt = str_replace("_", " ", $txt);

	return ucfirst(strtolower(trim($txt)));
}

function code_produit_img_link($code_produit){
	$cd =  str_replace("0", "00", $code_produit);

	$link = base_url("images/produit/poduit_default.jpeg");

	if (file_exists("images/produit/$code_produit.jpg")) {
		$link = base_url("images/produit/$code_produit.jpg");
	}elseif(file_exists("images/produit/$cd.jpg")){
		$link = base_url("images/produit/$cd.jpg");
	}
	return $link;
}

function type_utilisateur_for_uri($id_designation){
	if ( in_array($id_designation, [1, 4, 6])) {
		return "Administrateur";
	}

	if ( in_array($id_designation, [3])) {
		return "Developpeur";
	}

	if ( in_array($id_designation, [5,2])) {
		return "Utilisateurs";
	}
	if ( in_array($id_designation, [10])) {
		return "promoteur";
	}

	if ( in_array($id_designation, [7])) {
		return "magasiner";
	}
}

function code_client_img_link($code_client){
	$cd =  str_replace("0", "00", $code_client);
	$link ="https://magesty-prod.combo.fun/images/client/$code_client.jpg";
	if (file_exists("https://magesty-prod.combo.fun/images/client/$code_client.jpg")) {
		$link = base_url("https://magesty-prod.combo.fun/images/client/$code_client.jpg");
	}elseif(file_exists("https://magesty-prod.combo.fun/images/client/$code_client.jpg")){
		$link = base_url("https://magesty-prod.combo.fun/images/client/$code_client.jpg");
	}
	return $link;
}

function code_client_img_linkaa($code_produit){
	$cd =  str_replace("0", "00", $code_produit);

	$link =base_url('images/default_user.png');

	if (file_exists("images/client/$code_produit.jpg")) {
		$link = base_url("images/client/$code_produit.jpg");
	}elseif(file_exists("images/client/$cd.jpg")){
		$link = base_url("images/client/$cd.jpg");
	}
	return $link;
}

function PhotoUser_img_link($code_produit){
	$cd =  str_replace("0", "00", $code_produit);

	$link ="https://magesty-prod.combo.fun/images/operatrice/PhotoUser/$code_produit.jpg";

	if (file_exists("https://magesty-prod.combo.fun/images/operatrice/PhotoUser/$code_produit.jpg")) {
		$link = base_url("https://magesty-prod.combo.fun/images/operatrice/PhotoUser/$code_produit.jpg");
	}elseif(file_exists("https://magesty-prod.combo.fun/images/operatrice/PhotoUser/$cd.jpg")){
		$link = base_url("https://magesty-prod.combo.fun/images/operatrice/PhotoUser/$cd.jpg");
	}
	return $link;
}


function false($var){
	return $var === FALSE || $var === "null" || $var === 0;
}

function to_autocomplete($array){
	$r = [];

	foreach ($array as $val){
		$r[] = implode(" | ", $val);
	}

	return json_encode($r);
}

function date_fr($date){
	return (new DateTime($date))->format('d/m/Y');
}

function pourcentage($max, $val){
	return ($val * 100) / $max;
}


function mois($num){
	return ["Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"][$num - 1];

}

function jour($num){
	return ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"][$num];
}