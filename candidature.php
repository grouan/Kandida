<?PHP

	// Includes
	include_once	('include/fonctions/connexion.func.php');
	include_once	('include/fonctions/deconnexion.func.php');
	include_once	('include/fonctions/divers.func.php');
	
	// connexion
	@connexion();
	
	// mod
	$mod = $_GET['mod'];

	// Session
	@session_start();
	$session 	= 	@session_id();
	$login		= 	$_SESSION['login'];
	
	// id
	if (isset($_GET['id'])) { $id = $_GET['id']; }

	// couleur
	$couleur = couleur ('Candidatures');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>

<head>

	<title>Kandida : candidatures</title>

	<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="fr">
	<meta name="Robots" content="noindex, nofollow">
	<meta name="author" content="GUR">

	<script language="JavaScript" type="text/JavaScript" src="js/page.js"></script>
	<LINK href="css/kandida.css" rel="stylesheet" type="text/css">
<?PHP
	echo'<script type="text/css">A.candidature_titre:hover,A.candidature_etbl:hover{color:'.$couleur.';}</script>';
	
	// Redirection en cas d'ajout et de modification --------------------
	if ($_GET['mod'] == 'ajout') { // Ajout
		$insertCand = insertCandidature ($_POST['identreprise'],$_POST['idcontact'],$_POST['refCDG'],$_POST['webCDG'],$_POST['refLocal'],$_POST['webLocal'],$_POST['domaine'],$_POST['titre'],$_POST['filiere'],$_POST['grade'],$_POST['direction'],$_POST['service'],$_POST['region'],$_POST['departement'],$_POST['ville'],$_POST['dateParution'],$_POST['dateFin'],$_POST['dateEnvoi'],$_POST['modeEnvoi'],$_POST['dateReponse'],$_POST['reponse'],$_POST['notes'],$_POST['type'],$_POST['emploi']);
		$identifiant = mysql_insert_id();
		if ($insertCand != 0) { echo '<meta http-equiv="refresh" content="0; URL=candidature.php?session='.$session.'&mod=fiche&id='.$identifiant.'">'; }
	}
	if ( ($_GET['mod'] == 'modif') && ($_GET['statut'] == 'verif') ) { // Modification
		$modifCand = modifCandidature ($id,$_POST['identreprise'],$_POST['idcontact'],$_POST['refCDG'],$_POST['webCDG'],$_POST['refLocal'],$_POST['webLocal'],$_POST['domaine'],$_POST['titre'],$_POST['filiere'],$_POST['grade'],$_POST['direction'],$_POST['service'],$_POST['region'],$_POST['departement'],$_POST['ville'],$_POST['dateParution'],$_POST['dateFin'],$_POST['dateEnvoi'],$_POST['modeEnvoi'],$_POST['dateReponse'],$_POST['reponse'],$_POST['notes'],$_POST['type'],$_POST['emploi']);
		if ($modifCand != 0) { echo '<meta http-equiv="refresh" content="0; URL=candidature.php?session='.$session.'&mod=fiche&id='.$id.'">'; }
	}
	
?>

</head>

<body leftmargin="0" topmargin="0" lang="fr">

<div id="conteneur">

	<div id="contenu_logo">
		<div id="contenu_logo_gauche">
			<div id="contenu_logo_gauche_01">&nbsp;</div>
		</div>
		<div id="contenu_logo_img">
			<a href="/kandida/" target="_self"><div id="contenu_logo_img_logo_quit">&raquo; Déconnexion</div></a>
			<a href="accueil.php?session=<?PHP echo $_GET['session']; ?>" target="_self"><div id="contenu_logo_img_logo">&nbsp;</div></a>
		</div>
	</div> <!-- FIN contenu_logo -->

	<div id="contenu_menu">
		<div id="contenu_menu_gauche">
			<div id="contenu_menu_gauche_01">&nbsp;</div>
			<div id="contenu_menu_gauche_02">&nbsp;</div>
			<div id="contenu_menu_gauche_03">&nbsp;</div>
		</div>
		<div id="contenu_menu_liste">
			<?PHP if ($_GET['session'] == $session) { afficheListeMenu (); } ?>
		</div>
	</div> <!-- FIN contenu_menu -->

	<table class="contenu_page" width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign="top" class="contenu_page_texte_droit_01" height="100%"><div id="contenu_page_texte_droit_01_colonne">
<!-- /////////////////////////////// -->
<?PHP
	if ($_GET['session'] == $session) {
		if ($_GET['mod'] == 'liste') {
			
		}
		if ($_GET['mod'] == 'fiche') {
			echo '<a href="candidature.php?session='.$session.'&mod=modif&id='.$id.'" target="_self" title="Modifier cette candidature"><div id="contenu_page_gauche_modif">&nbsp;</div></a>';
			echo '<a href="candidature.php?session='.$session.'&mod=suppr&id='.$id.'" target="_self" title="Supprimer une candidature"><div id="contenu_page_gauche_suppr">&nbsp;</div></a>';
		}
	}
?>
<!-- /////////////////////////////// -->
</div></td>
		<td valign="top" class="contenu_page_texte_droit_02" height="100%"><div id="contenu_page_texte_droit_02_colonne">&nbsp;</div></td>
		<td valign="top" class="contenu_page_texte_droit_03" height="100%">
			<div id="contenu_page_texte_droit_03_colonne">
<!-- /// PAGE CENTRALE ///////////////////////////////////////////////////////////////////////////////////////////-->
<?PHP
if ($_GET['session'] == $session) {

	if ($_GET['mod'] == 'liste') { // Liste des candidatures ------------------------------

echo '<div id="page_titre" style="background-color:'.$couleur.';color:#FFF;">Liste des candidatures</div>';

if (isset($_POST['orderby'])) { $orderby = $_POST['orderby']; } else { $orderby = 'dateFin ASC'; }
$tabCandEnCours = listeCandidaturesEnCours(0,$orderby);
$tabCandPassees = listeCandidaturesPassees(0,$orderby);
		echo '<div id="enCours">'; /* En cours */

// Tri
echo '<div style="margin-bottom:20px;color:#999;text-align:right;"><FORM method="post" action="candidature.php?session='.$session.'&mod=liste">';
	echo '<img src="images/ico_engrenage.png" border="0" title="Trier par..."> <SELECT name="orderby">';
		echo '<OPTION value="dateFin" selected>Date limite</OPTION>';
		echo '<OPTION value="domaine">Domaine</OPTION>';
		echo '<OPTION value="titre">Titre</OPTION>';
		echo '<OPTION value="filiere">Filière</OPTION>';
		echo '<OPTION value="grade">Grade</OPTION>';
		echo '<OPTION value="region">Région</OPTION>';
		echo '<OPTION value="departement">Département</OPTION>';
		echo '<OPTION value="ville">Ville</OPTION>';
		echo '<OPTION value="identreprise">N° d\'établissement</OPTION>';
		echo '<OPTION value="type">Type d\'annonce</OPTION>';
		echo '<OPTION value="emploi">Type d\'emploi</OPTION>';
	echo '</SELECT>';
	echo '<INPUT type="submit" name="Submit" class="bouton" value="&raquo; Trier">';
echo '</FORM></div>';

			echo '<div id="page_sousTitre2"><img src="images/ico_encours.png" border="0" style="width:30px;height:30px;"> '.count($tabCandEnCours).' en cours</div>';			
			if (count($tabCandEnCours)>=1) {
				echo '<table class="liste_texte" border="0" cellpadding="0" cellspacing="0" width="100%">';
				echo '<tr class="liste_resultats" width="100%" style="background-color:#EEE;">';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">Titre</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">Etablissement</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">Secteur</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">Parution</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">Limite</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">Délais</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">E</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">M</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">S</td>';
					echo '</tr>';
				for ($m=0;$m<count($tabCandEnCours);$m++) {
					$tabCandidature = candidature ($tabCandEnCours[$m]);
					$tabEntreprise = entreprise ($tabCandidature[1]);
					if (empty($tabCandidature[4])) { $webCandidature = $tabCandidature[6]; } else { $webCandidature = $tabCandidature[4]; }
					if (($m%2)!=0) { /*impair*/$classe='liste_resultats2'; } else { /*pair*/$classe='liste_resultats'; }
					echo '<tr class="'.$classe.'">';
						//echo '<td class="liste_resultats" border="0"><img src="images/dossier.png" style="width:20px;height:20px;"></td>';
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="candidature.php?session='.$session.'&mod=fiche&id='.$tabCandidature[0].'" target="_self" class="candidature_titre" title="Voir cette candidature">'.$tabCandidature[8].'</a></td>'; // Titre
						//echo '<td class="liste_resultats" border="0">('.$tabCandidature[10].')</td>'; // (Grade)
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="entreprise.php?session='.$session.'&mod=fiche&id='.$tabCandidature[1].'" target="_self" class="candidature_etbl" title="Voir cet établissement">'.$tabEntreprise[1].'</a></td>'; // Etblt
						//echo '<td class="liste_resultats" border="0">('.$tabCandidature[15].')</td>'; // (ville)
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;">'.$tabEntreprise[2].'</td>';
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;">'.changeFormatDateMini($tabCandidature[16]).'</td>';
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;">'.changeFormatDateMini($tabCandidature[17]).'</td>';
						// Temps restant OU révolu
						// CSS personnalisée en fonction du temps <div style="..."> $styleTemps
						// >= 1 mois = background-color:vert / 1mois < > 15jours = orange / 15jours <> 7jours = rouge / <= 7jours = violet / révolu = noir == à clore
						$dateToday = date("Y-m-d");
						$tpsRestant = round((strtotime($tabCandidature[17]) - strtotime($dateToday))/(60*60*24)); // en nb de jours
							$styleTemps = "margin:1px 2px;padding:2px 4px;text-align:right;font-size:11px;";
							if ($tpsRestant >= 30) { $styleTemps .= "background-color:#9F0;color:black;"; } // + 1 mois = vert
							if (($tpsRestant < 30) && ($tpsRestant >= 15)) { $styleTemps .= "background-color:#FC3;color:black;"; } // 15j-1mois = orange clair 
							if (($tpsRestant < 15) && ($tpsRestant >= 7)) { $styleTemps .= "background-color:#F60;color:black;"; } // 1sem-15j = orange
							if ($tpsRestant < 7) { $styleTemps .= "background-color:#C00;color:white;"; } // 1sem = rouge
							if ($tpsRestant <= 0) { $styleTemps .= "background-color:#606060;color:white;"; } // dépassé = noir
							if ($tabCandidature[18] != "0000-00-00") { $styleTemps .= "background-color:#0099FF;color:white;"; } // envoyé = bleu = en attente de réponse...
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><div style="'.$styleTemps.'">'.$tpsRestant.' jours</td>';
						//echo '<td class="liste_resultats" border="0"><a href="'.$webCandidature.'" target="_blank" title="Voir la fiche en ligne"><img src="images/ico_web.png" border="0"></a></td>'; // web
						if ($tabCandidature[18] == "0000-00-00") { $envoye_image="envoye_non.gif"; $envoye_title="Répondre..."; } else { $envoye_image="envoye.png"; $envoye_title="La réponse a été envoyée le ".changeFormatDate($tabCandidature[18]); }
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><img src="images/'.$envoye_image.'" border="0" title="'.$envoye_title.'"></td>'; // envoyé ?
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="candidature.php?session='.$session.'&mod=modif&id='.$tabCandidature[0].'" target="_self" title="Modifier"><img src="images/ico_modif.png" border="0"></a></td>'; // modifier
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="candidature.php?session='.$session.'&mod=suppr&id='.$tabCandidature[0].'" target="_self" title="Supprimer"><img src="images/ico_suppr.png" border="0"></a></td>'; // supprimer
					echo '</tr>';
				}
				echo '</table>';
			}
			else { echo 'Aucune candidature n\'est actuellement en cours de traitement.'; }
		echo '</div>';
		echo '<div id="passe">'; /* Passées */
			echo '<div id="page_sousTitre2"><img src="images/ico_passe.png" border="0" style="width:30px;height:30px;"> '.count($tabCandPassees).' archives</div>';
			if (count($tabCandPassees)>=1) {
				echo '<table class="liste_texte" border="0" cellpadding="0" cellspacing="0" width="100%">';
				echo '<tr class="liste_resultats" width="100%" style="background-color:#EEE;">';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">Titre</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">Etablissement</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">Secteur</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">Limite</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">M</td>';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">S</td>';
					echo '</tr>';
				for ($m=0;$m<count($tabCandPassees);$m++) {
					$tabCandidature = candidature ($tabCandPassees[$m]);
					$tabEntreprise = entreprise ($tabCandidature[1]);
					if (empty($tabCandidature[4])) { $webCandidature = $tabCandidature[6]; } else { $webCandidature = $tabCandidature[4]; }
					echo '<tr class="liste_resultats">';
						echo '<td class="liste_resultats" border="0" style="border-bottom:1px solid #EEE;font-size:10px;padding:2px;"><a href="candidature.php?session='.$session.'&mod=fiche&id='.$tabCandidature[0].'" target="_self" class="candidature_titre" title="Voir cette candidature">'.$tabCandidature[8].'</a></td>'; // Titre
						echo '<td class="liste_resultats" border="0" style="border-bottom:1px solid #EEE;font-size:10px;padding:2px;"><a href="entreprise.php?session='.$session.'&mod=fiche&id='.$tabCandidature[1].'" target="_self" class="candidature_etbl" title="Voir cet établissement">'.$tabEntreprise[1].'</a></td>'; // Etblt
						echo '<td class="liste_resultats" border="0" style="border-bottom:1px solid #EEE;font-size:10px;padding:2px;">'.$tabEntreprise[2].'</td>';
						echo '<td class="liste_resultats" border="0" style="border-bottom:1px solid #EEE;font-size:10px;padding:2px;">'.changeFormatDateMini($tabCandidature[17]).'</td>';
						echo '<td class="liste_resultats" border="0" style="border-bottom:1px solid #EEE;font-size:10px;padding:2px;"><a href="candidature.php?session='.$session.'&mod=modif&id='.$tabCandidature[0].'" target="_self" title="Modifier"><img src="images/ico_modif.png" border="0"></a></td>'; // modifier
						echo '<td class="liste_resultats" border="0" style="border-bottom:1px solid #EEE;font-size:10px;padding:2px;"><a href="candidature.php?session='.$session.'&mod=suppr&id='.$tabCandidature[0].'" target="_self" title="Supprimer"><img src="images/ico_suppr.png" border="0"></a></td>'; // supprimer
					echo '</tr>';
				}
				echo '</table>';
			}
			else { echo 'Aucune candidature n\'est archivée.'; }
		echo '</div>';

	}
	if ($_GET['mod'] == 'fiche') { // AFFICHER une candidature -----------------------------

		$tabCandidature = candidature ($id);
		$tabEtbl = entreprise ($tabCandidature[1]);
		$tabCont = contact ($tabCandidature[2]);

	echo '<div id="page_titre" style="color:'.$couleur.';">'.$tabCandidature[8].'</div>';

		echo '<div id="enCours">'; /* En cours */		

// Etat et délais de la candidature
		echo '<div style="float:right;">';
			if ($tabCandidature[18] == "0000-00-00") { $envoye_image="envoye_non.gif"; $envoye_title="Répondre..."; } else { $envoye_image="envoye.png"; $envoye_title="La réponse a été envoyée le ".changeFormatDate($tabCandidature[18]); }
			$dateToday = date("Y-m-d");
			$tpsRestant = round((strtotime($tabCandidature[17]) - strtotime($dateToday))/(60*60*24)); // en nb de jours
				$styleTemps = "margin:10px;padding:5px 10px;text-align:right;font-size:14px;border:3px solid #DDD;";
				if ($tpsRestant >= 30) { $styleTemps .= "background-color:#9F0;color:black;"; } // + 1 mois = vert
				if (($tpsRestant < 30) && ($tpsRestant >= 15)) { $styleTemps .= "background-color:#FC3;color:black;"; } // 15j-1mois = orange clair 
				if (($tpsRestant < 15) && ($tpsRestant >= 7)) { $styleTemps .= "background-color:#F60;color:black;"; } // 1sem-15j = orange
				if ($tpsRestant < 7) { $styleTemps .= "background-color:#C00;color:white;"; } // 1sem = rouge
				if ($tpsRestant <= 0) { $styleTemps .= "background-color:#606060;color:white;"; } // dépassé = noir
				if ($tabCandidature[18] != "0000-00-00") { $styleTemps .= "background-color:#0099FF;color:white;"; } // envoyé = bleu = en attente de réponse...
				if (($tpsRestant == 1)||($tpsRestant == 0)) { $jours = 'jour'; } else { $jours = 'jours'; }
			echo '<img src="images/'.$envoye_image.'" border="0" title="'.$envoye_title.'"> <span style="border-bottom:1px solid #DDD;'.$styleTemps.'"><b>'.$tpsRestant.'</b> '.$jours.'</span>';
		echo '</div>';

// Administration
echo '<div id="texte_titre"><img src="images/ico_admin.png" border="0"> Informations administratives</div>';
echo '<div id="texte_texte">';
if ($tabCandidature[23]=='spontanée') { echo '<div>Candidature spontanée</div>'; } else {
	if ($tabCandidature[4]!='0') { $lienRefCDG = '<a href="'.$tabCandidature[4].'" target="_blank" title="Voir l\'annonce">';  $lienRefClose = '</a>';} else { $lienRefCDG = ''; $lienRefClose = ''; }
	if ($tabCandidature[3]!='0') { echo '<div><font color="#CCCCCC">Références CDG :</font> '.$lienRefCDG.' '.$tabCandidature[3].' '.$lienRefClose.'</div>'; }
	if ($tabCandidature[6]!='0') { $lienRefLocal = '<a href="'.$tabCandidature[6].'" target="_blank" title="Voir l\'annonce">';  $lienRefClose2 = '</a>';} else { $lienRefLocal = ''; $lienRefClose2 = ''; }
	if ($tabCandidature[5]!='0') { echo '<div><font color="#CCCCCC">Références :</font> '.$lienRefLocal.' '.$tabCandidature[5].' '.$lienRefClose2.'</div>'; }	
}
if ($tabCandidature[9]!='0') { echo '<div><font color="#CCCCCC">Filière :</font> '.$tabCandidature[9].'</div>'; }
if ($tabCandidature[10]!='0') { echo '<div><font color="#CCCCCC">Grade :</font> '.$tabCandidature[10].'</div>'; }
if ($tabCandidature[7]!='0') { echo '<div><font color="#CCCCCC">Domaine :</font> '.$tabCandidature[7].'</div>'; }
if ($tabCandidature[24]!='0') { echo '<div><font color="#CCCCCC">Contrat :</font> '.$tabCandidature[24].'</div>'; }
if ($tabCandidature[11]!='0') { echo '<div><font color="#CCCCCC">Direction :</font> '.$tabCandidature[11].'</div>'; }
if ($tabCandidature[12]!='0') { echo '<div><font color="#CCCCCC">Service :</font> '.$tabCandidature[12].'</div>'; }
if (($tabCandidature[13]!='0')||($tabCandidature[14]!='0')||($tabCandidature[15]!='0')) { echo '<div><font color="#CCCCCC">Localisation :</font> '; }
	if ($tabCandidature[13]!='0') { echo ' '.$tabCandidature[13].' '; }
	if ($tabCandidature[14]!='0') { echo ', '.$tabCandidature[14].' '; }
	if ($tabCandidature[15]!='0') { echo ', '.$tabCandidature[15].' '; }
if (($tabCandidature[13]!='0')||($tabCandidature[14]!='0')||($tabCandidature[15]!='0')) { echo '</div>'; }
echo '</div>';

// Calendrier
echo '<div id="texte_titre"><img src="images/ico_agenda.png" border="0"> Calendrier</div>';
echo '<div id="texte_texte">';
if ($tabCandidature[16]!='0000-00-00') { echo '<div><font color="#CCCCCC">Début de parution :</font> '.changeFormatDate($tabCandidature[16]).'</div>'; }
if ($tabCandidature[17]!='0000-00-00') { echo '<div><font color="#CCCCCC">Fin de parution :</font> '.changeFormatDate($tabCandidature[17]).'</div>'; }
if ($tabCandidature[18]!='0000-00-00') { echo '<div><font color="#CCCCCC">Envoi :</font> '.changeFormatDate($tabCandidature[18]).' (par '.$tabCandidature[19].')</div>'; }
if ($tabCandidature[21]!='0') { echo '<div><font color="#CCCCCC">Réponse :</font> '.$tabCandidature[21].' ('.changeFormatDate($tabCandidature[20]).')</div>'; }
echo '<div><img src="images/ico_cal_ajout.gif" border="0"> <a href="candidature.php?session='.$session.'&mod=modif&id='.$id.'" target="_self" >Ajouter un événement à cette candidature</a></div>'; // ajouter un événement
echo '</div>';


		echo '</div>';
		echo '<div id="passe">'; /* Archives */
			// Notes
			echo '<div id="texte_titre"><img src="images/ico_rem.png" border="0"> Remarques</div>';
			echo '<div id="texte_texte">';
			if ($tabCandidature[22]!='0') { echo '<div>'.$tabCandidature[22].'</div>'; }
			echo '</div>';
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
	}
	if ($_GET['mod'] == 'ajout') { // AJOUTER une candidature -----------------------------

		echo '<div id="page_titre" style="color:'.$couleur.';">Ajout de candidature</div>';
		echo '<div id="enCours">'; /* En cours */		
			//$insertCand = insertCandidature ($_POST['identreprise'],$_POST['idcontact'],$_POST['refCDG'],$_POST['webCDG'],$_POST['refLocal'],$_POST['webLocal'],$_POST['domaine'],$_POST['titre'],$_POST['filiere'],$_POST['grade'],$_POST['direction'],$_POST['service'],$_POST['region'],$_POST['departement'],$_POST['ville'],$_POST['dateParution'],$_POST['dateFin'],$_POST['dateEnvoi'],$_POST['modeEnvoi'],$_POST['dateReponse'],$_POST['reponse'],$_POST['notes'],$_POST['type'],$_POST['emploi']);
if ($insertCand == 0) { echo '<font color="red">Une erreur est survenue lors de l\'ajout de cette candidature !</font>'; }
else { echo '<font color="green">Votre candidature a été ajoutée avec succès !</font>'; }
		echo '</div>';
		echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
	}
	if ($_GET['mod'] == 'modif') { // MODIFIER une candidature -----------------------------

		if ($_GET['statut'] == 'verif') { // vérif formulaire modif
			echo '<div id="page_titre" style="color:'.$couleur.';">Modification de candidature</div>';
			echo '<div id="enCours">'; /* En cours */
			//$modifCand = modifCandidature ($id,$_POST['identreprise'],$_POST['idcontact'],$_POST['refCDG'],$_POST['webCDG'],$_POST['refLocal'],$_POST['webLocal'],$_POST['domaine'],$_POST['titre'],$_POST['filiere'],$_POST['grade'],$_POST['direction'],$_POST['service'],$_POST['region'],$_POST['departement'],$_POST['ville'],$_POST['dateParution'],$_POST['dateFin'],$_POST['dateEnvoi'],$_POST['modeEnvoi'],$_POST['dateReponse'],$_POST['reponse'],$_POST['notes'],$_POST['type'],$_POST['emploi']);
if ($modifCand == 0) { echo '<font color="red">Une erreur est survenue lors de la modification de cette candidature !</font>'; }
else {
	echo '<font color="green">Votre candidature a été modifiée avec succès !</font>';
	echo '<a href="candidature.php?session='.$session.'&mod=fiche&id='.$id.'" target="_self"><div>&raquo; voir la fiche de cette candidature</div></a>';
}
			echo '</div>';
			echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
		}
		else { // affichage formulaire modif
			$tabCand = candidature($id);
			echo '<div id="page_titre" style="color:'.$couleur.';">Modification de candidature</div>';
			echo '<div id="enCours">'; /* En cours */
			echo '<FORM method="post" action="candidature.php?session='.$session.'&mod=modif&id='.$id.'&statut=verif">';
			// Administration
			$tabEntreprises = entreprises('nom');
			echo '<div><font color="#CCCCCC">Entreprise :</font> <SELECT name="identreprise">';
				for ($e=0;$e<count($tabEntreprises);$e++) {
					echo '<OPTION value="'.$tabEntreprises[$e][0].'"';
					if ($tabEntreprises[$e][0]==$tabCand[1]) { echo ' selected'; }
					echo '>'.$tabEntreprises[$e][1].'</OPTION>';
				}
			echo '</SELECT> <a href="entreprise.php?session='.$session.'&mod=ajout" target="_self"><img src="images/ico_plus.png" border="0" title="Ajouter un établissement"></a></div>';
			$tabContacts = contacts('nom');
			echo '<div><font color="#CCCCCC">Contact :</font> <SELECT name="idcontact">';
				for ($e=0;$e<count($tabContacts);$e++) {
					echo '<OPTION value="'.$tabContacts[$e][0].'"';
					if($tabContacts[$e][0]==$tabCand[2]) { echo ' selected'; }
					echo '>'.$tabContacts[$e][1].' '.$tabContacts[$e][2].' '.$tabContacts[$e][3].'</OPTION>';
				}
			echo '</SELECT> <a href="contact.php?session='.$session.'&mod=ajout" target="_self"><img src="images/ico_plus.png" border="0" title="Ajouter un contact"></a></div>';
			echo '<div><font color="#CCCCCC">Candidature :</font> <SELECT name="type">';
			$tabType = array ('annonce','spontanée');
			for ($e=0;$e<count($tabType);$e++) {
					echo '<OPTION value="'.$tabType[$e].'"';
					if($tabType[$e]==$tabCand[23]) { echo ' selected'; }
					echo '>'.$tabType[$e].'</OPTION>';
				}
			echo '</SELECT></div>';
			echo '<div><font color="#CCCCCC">Contrat :</font><SELECT name="emploi">';
			$tabEmploi = array ('CDI','CDD','stage','mission');
			for ($e=0;$e<count($tabEmploi);$e++) {
					echo '<OPTION value="'.$tabEmploi[$e].'"';
					if($tabEmploi[$e]==$tabCand[24]) { echo ' selected'; }
					echo '>'.$tabEmploi[$e].'</OPTION>';
				}
			echo '</SELECT></div>';
			echo '<div><font color="#CCCCCC">Titre :</font> <INPUT type="text" size="30px" name="titre" value="'.$tabCand[8].'"></div><br><br>';
			echo '<div id="texte_titre"><img src="images/ico_admin.png" border="0"> Informations administratives</div>';
			echo '<div id="texte_texte">';
				echo '<div><font color="#CCCCCC">Références CDG :</font> <INPUT type="text" size="14px" name="refCDG" value="'.$tabCand[3].'"> <img src="images/ico_web.png" border="0"><INPUT type="text" size="14px" name="webCDG" value="'.$tabCand[4].'"></div>';
				echo '<div><font color="#CCCCCC">Références :</font> <INPUT type="text" size="14px" name="refLocal" value="'.$tabCand[5].'"> <img src="images/ico_web.png" border="0"><INPUT type="text" size="14px" name="webLocal" value="'.$tabCand[6].'"></div>';
				echo '<div><font color="#CCCCCC">Filière :</font> <INPUT type="text" size="20px" name="filiere" value="'.$tabCand[9].'"></div>';
				echo '<div><font color="#CCCCCC">Grade :</font> <INPUT type="text" size="20px" name="grade" value="'.$tabCand[10].'"></div>';
				echo '<div><font color="#CCCCCC">Domaine :</font> <INPUT type="text" size="20px" name="domaine" value="'.$tabCand[7].'"></div>';
				echo '<div><font color="#CCCCCC">Direction :</font> <INPUT type="text" size="20px" name="direction" value="'.$tabCand[11].'"></div>';
				echo '<div><font color="#CCCCCC">Service :</font> <INPUT type="text" size="20px" name="service" value="'.$tabCand[12].'"></div>';
				echo '<div><font color="#CCCCCC">Ville :</font> <INPUT type="text" size="20px" name="ville" value="'.$tabCand[15].'"></div>';
				echo '<div><font color="#CCCCCC">Département :</font> <INPUT type="text" size="20px" name="departement" value="'.$tabCand[14].'"></div>';
				echo '<div><font color="#CCCCCC">Région :</font> <INPUT type="text" size="20px" name="region" value="'.$tabCand[13].'"></div>';
			echo '</div>';

			// Calendrier
			echo '<div id="texte_titre"><img src="images/ico_agenda.png" border="0"> Calendrier</div>';
			echo '<div id="texte_texte">';
				echo '<div><font color="#CCCCCC">Début de parution :</font> <INPUT type="text" size="14px" name="dateParution" value="'.$tabCand[16].'"> AAAA-MM-JJ</div>';
				echo '<div><font color="#CCCCCC">Fin de parution :</font> <INPUT type="text" size="14px" name="dateFin" value="'.$tabCand[17].'"></div>';
				echo '<div><font color="#CCCCCC">Date d\'envoi :</font> <INPUT type="text" size="14px" name="dateEnvoi" value="'.$tabCand[18].'"></div>';
				echo '<div><font color="#CCCCCC">Mode d\'envoi :</font><SELECT name="modeEnvoi">';
				$tabModeEnvoi = array ('poste','email','depot');
				$tabModeEnvoiLegende = array('par la poste','par email','dépôt sur place');
				for ($e=0;$e<count($tabModeEnvoi);$e++) {
					echo '<OPTION value="'.$tabModeEnvoi[$e].'"';
					if($tabModeEnvoi[$e]==$tabCand[19]) { echo ' selected'; }
					echo '>'.$tabModeEnvoiLegende[$e].'</OPTION>';
				}
				echo '</SELECT></div>';
				echo '<div><font color="#CCCCCC">Date de réponse :</font> <INPUT type="text" size="14px" name="dateReponse" value="'.$tabCand[20].'"></div>';
				echo '<div><font color="#CCCCCC">Réponse :</font><SELECT name="reponse">';
				$tabReponse = array ('0','positive','négative');
				$tabReponseLegende = array('aucune','positive','négative');
				for ($e=0;$e<count($tabReponse);$e++) {
					echo '<OPTION value="'.$tabReponse[$e].'"';
					if($tabReponse[$e]==$tabCand[21]) { echo ' selected'; }
					echo '>'.$tabReponseLegende[$e].'</OPTION>';
				}
				echo '</SELECT></div>';
			echo '</div>';
		
			// Remarques
			echo '<div id="texte_titre"><img src="images/ico_rem.png" border="0"> Remarques</div>';
				echo '<div id="texte_texte">';
				echo '<div><font color="#CCCCCC">Remarques :</font> <TEXTAREA size="14px" name="notes" '
					.'value="'.$tabCand[22].'">'.$tabCand[22].'</TEXTAREA></div>';
				echo '</div>';

			echo '<INPUT type="submit" name="Submit" class="bouton" value="&raquo; Modifier cette candidature">';
			echo '</FORM>';

			echo '</div>';
			echo '<div id="passe">'; /* Archives */
				echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
			echo '</div>';
		}
	}
	if ($_GET['mod'] == 'suppr') { // SUPPRIMER une candidature -----------------------------

		if ($_GET['statut'] == 'verif') { // suppression effective
			echo '<div id="page_titre" style="color:'.$couleur.';">Suppression de candidature</div>';
			echo '<div id="enCours">'; /* En cours */
			$supprCand = supprCandidature ($id);
if ($supprCand == 0) { echo '<font color="red">Une erreur est survenue lors de la suppression de cette candidature !</font>'; }
else { echo '<font color="green">Votre candidature a été supprimée !</font>'; }
			echo '</div>';
			echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
		}
		else { // confirmation suppression ?
			echo '<div id="page_titre" style="color:'.$couleur.';">Suppression de candidature</div>';
			echo '<div id="enCours">'; /* En cours */
				echo '<FORM method="post" action="candidature.php?session='.$session.'&mod=suppr&id='.$id.'&statut=verif">';
				echo '<div style="color:red;margin-bottom:20px;">Souhaitez-vous réellement supprimer la candidature #<b>'.$id.'</b> ?</div>';
////////////////////////
echo '<table class="liste_texte" border="0" cellpadding="0" cellspacing="0" width="100%">';
					$tabCandidature = candidature ($id);
					$tabEntreprise = entreprise ($tabCandidature[1]);
					if (empty($tabCandidature[4])) { $webCandidature = $tabCandidature[6]; } else { $webCandidature = $tabCandidature[4]; }
					echo '<tr class="liste_resultats" width="100%">';
						echo '<td class="liste_resultats" border="0"><img src="images/dossier.png" style="width:20px;height:20px;"></td>';
						echo '<td class="liste_resultats" border="0"><a href="candidature.php?session='.$session.'&mod=fiche&id='.$tabCandidature[0].'" target="_self" class="candidature_titre" title="Voir cette candidature">'.$tabCandidature[8].'</a> '; // Titre
						echo ' &rarr; <i><a href="entreprise.php?session='.$session.'&mod=fiche&id='.$tabCandidature[1].'" target="_self" class="candidature_etbl" title="Voir cet établissement">'.$tabEntreprise[1].'</a></i></td>'; // Etblt
						echo '<td class="liste_resultats" border="0"><a href="'.$webCandidature.'" target="_blank" title="Voir la fiche en ligne"><img src="images/ico_web.png" border="0"></a></td>'; // web
						echo '<td class="liste_resultats" border="0"><a href="candidature.php?session='.$session.'&mod=modif&id='.$tabCandidature[0].'" target="_self" title="Modifier"><img src="images/ico_modif.png" border="0"></a></td>'; // modifier
						echo '<td class="liste_resultats" border="0"><a href="candidature.php?session='.$session.'&mod=suppr&id='.$tabCandidature[0].'" target="_self" title="Supprimer"><img src="images/ico_suppr.png" border="0"></a></td>'; // supprimer
					echo '</tr>';
				echo '</table>';
////////////////////////////
				echo '<br><br><INPUT type="submit" name="Submit" class="bouton" value="&raquo; Supprimer cette candidature">';
				echo '</FORM>';
			echo '</div>';
			echo '<div id="passe">'; /* Archives */
				echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
			echo '</div>';
		}
		
	}
}
?>
<!-- /// FIN PAGE CENTRALE ///////////////////////////////////////////////////////////////////////////////////////-->
			</div>
		</td>
		<td valign="top" class="contenu_page_texte_droit_04" height="100%">
			<div id="contenu_page_texte_droit_04_colonne">
<!-- // Menu de droite -->
<?PHP
if ($_GET['session'] == $session) {

	include_once ('inc.ephemeride.php');

	if ($_GET['mod'] == 'liste') { // LISTER les candidatures ------------------------------
		echo '<FORM method="post" action="candidature.php?session='.$session.'&mod=ajout">';
		// Administration
		$tabEntreprises = entreprises('nom');
		echo '<div><SELECT name="identreprise">';
			if (!isset($_GET['idEtbl'])) { echo '<OPTION selected>--- Choisir un établissement ---</OPTION>'; } else {  }
			for ($e=0;$e<count($tabEntreprises);$e++) {
				if ((isset($_GET['idEtbl']))&&($_GET['idEtbl']==$tabEntreprises[$e][0])) { $selected='selected'; } else { $selected=''; }
				echo '<OPTION value="'.$tabEntreprises[$e][0].'" '.$selected.' Onclick="javascript:location=\'candidature.php?session='.$session.'&mod=liste&idEtbl='.$tabEntreprises[$e][0].'\'">'.$tabEntreprises[$e][1].'</OPTION>';
			}
		echo '</SELECT> <a href="entreprise.php?session='.$session.'&mod=liste" target="_self"><img src="images/ico_plus.png" border="0" title="Ajouter un établissement"></a></div>';
		if (isset($_GET['idEtbl'])) { // L'établissement est choisi => afficher les contacts de cet établissement
			$tabContacts = listeContactsEntreprise($_GET['idEtbl']);
			echo '<div><SELECT name="idcontact">';
				for ($e=0;$e<count($tabContacts);$e++) {
					if (!empty($tabContacts[$e][5])) { $loc=' '.$tabContacts[$e][5].''; } else { $loc=''; }
					echo '<OPTION value="'.$tabContacts[$e][0].'">'.$tabContacts[$e][1].' '.$tabContacts[$e][2].' ('.$tabContacts[$e][4].''.$loc.')</OPTION>';
				}
			echo '</SELECT> <a href="contact.php?session='.$session.'&mod=liste" target="_self"><img src="images/ico_plus.png" border="0" title="Ajouter un contact"></a></div>';
		}
		else { // Afficher un SELECT désactivé
			echo '<div><SELECT name="type"><OPTION disabled></OPTION></SELECT></div>';
		}
		echo '<div><SELECT name="type"><OPTION value="annonce">annonce</OPTION><OPTION value="spontanée">spontanée</OPTION></SELECT> <SELECT name="emploi"><OPTION value="cdi">CDI</OPTION><OPTION value="cdd">CDD</OPTION><OPTION value="stage">stage</OPTION><OPTION value="mission">mission</OPTION></SELECT></div>';
		echo '<div><font color="#CCCCCC">Titre :</font> <INPUT type="text" size="30px" name="titre"></div><br><br>';
		echo '<div id="texte_titre"><img src="images/ico_admin.png" border="0"> Informations administratives</div>';
		echo '<div id="texte_texte">';
			echo '<div><font color="#CCCCCC">Références CDG :</font> <INPUT type="text" size="14px" name="refCDG"> <img src="images/ico_web.png" border="0"><INPUT type="text" size="14px" name="webCDG"></div>';
			echo '<div><font color="#CCCCCC">Références :</font> <INPUT type="text" size="14px" name="refLocal"> <img src="images/ico_web.png" border="0"><INPUT type="text" size="14px" name="webLocal"></div>';
			echo '<div><font color="#CCCCCC">Filière :</font> <INPUT type="text" size="20px" name="filiere"></div>';
			echo '<div><font color="#CCCCCC">Grade :</font> <INPUT type="text" size="20px" name="grade"></div>';
			echo '<div><font color="#CCCCCC">Domaine :</font> <INPUT type="text" size="20px" name="domaine"></div>';
			echo '<div><font color="#CCCCCC">Direction :</font> <INPUT type="text" size="20px" name="direction"></div>';
			echo '<div><font color="#CCCCCC">Service :</font> <INPUT type="text" size="20px" name="service"></div>';
			echo '<div><font color="#CCCCCC">Ville :</font> <INPUT type="text" size="20px" name="ville"></div>';
			echo '<div><font color="#CCCCCC">Département :</font> <INPUT type="text" size="20px" name="departement"></div>';
			echo '<div><font color="#CCCCCC">Région :</font> <INPUT type="text" size="20px" name="region"></div>';
		echo '</div>';

		// Calendrier
		echo '<div id="texte_titre"><img src="images/ico_agenda.png" border="0"> Calendrier</div>';
		echo '<div id="texte_texte">';
			echo '<div><font color="#CCCCCC">Début de parution :</font> <INPUT type="text" size="14px" name="dateParution"> AAAA-MM-JJ</div>';
			echo '<div><font color="#CCCCCC">Fin de parution :</font> <INPUT type="text" size="14px" name="dateFin"></div>';
			echo '<div><font color="#CCCCCC">Date d\'envoi :</font> <INPUT type="text" size="14px" name="dateEnvoi"> <SELECT name="modeEnvoi"><OPTION value="poste">par la poste</OPTION><OPTION value="email">par email</OPTION><OPTION value="depot">depôt sur place</OPTION></SELECT></div>';
			echo '<div><font color="#CCCCCC">Date de réponse :</font> <INPUT type="text" size="14px" name="dateReponse"> <SELECT name="reponse"><OPTION value="0">aucune</OPTION><OPTION value="positive">positive</OPTION><OPTION value="négative">négative</OPTION></SELECT></div>';
		echo '</div>';

		echo '<INPUT type="submit" name="Submit" class="bouton" value="&raquo; Ajouter cette candidature">';
		echo '</FORM>';
	}
	if ($_GET['mod'] == 'fiche') { // AFFICHER une candidature -----------------------------
		// Etablissement
		echo '<div id="texte_titre"><img src="images/ico_etbl.png" border="0"> Etablissement</div>';
		echo '<div id="texte_texte">';
		if (!empty($tabEtbl[1])) { echo '<div><a href="entreprise.php?session='.$session.'&mod=fiche&id='.$tabCandidature[1].'" target="_self" title="Voir la fiche de cet établissement"><b>'.$tabEtbl[1].'</b></a></div>'; } // nom
		if (!empty($tabEtbl[3])) { echo '<div>'.$tabEtbl[3].'</div>'; } // adr1
		if (!empty($tabEtbl[4])) { echo '<div>'.$tabEtbl[4].'</div>'; } // adr2
		if (!empty($tabEtbl[5])) { echo '<div>'.$tabEtbl[5].'</div>'; } // cp
		if (!empty($tabEtbl[6])) { echo '<div>'.$tabEtbl[6].'</div>'; } // ville
		if (!empty($tabEtbl[7])) { echo '<div><img src="images/ico_tel.png" border="0"> '.$tabEtbl[7].'</div>'; } // tel1
		if (!empty($tabEtbl[8])) { echo '<div><img src="images/ico_tel.png" border="0"> '.$tabEtbl[8].'</div>'; } // tel2
		if (!empty($tabEtbl[9])) { echo '<div><img src="images/ico_fax.png" border="0"> '.$tabEtbl[9].'</div>'; } // fax1
		if (!empty($tabEtbl[10])) { echo '<div><img src="images/ico_fax.png" border="0"> '.$tabEtbl[10].'</div>'; } // fax2
		if (!empty($tabEtbl[11])) { echo '<div><img src="images/ico_email.png" border="0"> <a href="mailto:'.$tabEtbl[11].'" title="Ecrire">'.$tabEtbl[11].'</a></div>'; } // email
		if (!empty($tabEtbl[12])) { echo '<div><img src="images/ico_web.png" border="0"> <a href="'.$tabEtbl[12].'" target="_blank" title="Visiter le site de cet établissement">'.$tabEtbl[12].'</a></div>'; } // web
		if (!empty($tabEtbl[2])) { echo '<div><i>'.$tabEtbl[2].'</i></div>'; } // secteur
		if (!empty($tabEtbl[13])) { echo '<div>{ <i>'.$tabEtbl[13].'</i> }</div>'; } // notes
		echo '</div>';

		// Contact
		echo '<div id="texte_titre"><img src="images/ico_contact.png" border="0"> Contact</div>';
		echo '<div id="texte_texte">';
		if (!empty($tabCont[1])) { echo '<div><a href="contact.php?session='.$session.'&mod=fiche&id='.$tabCandidature[2].'" target="_self" title="Voir la fiche de ce contact"><b>'.$tabCont[1].' '.$tabCont[2].' '.$tabCont[3].'</b></a></div>'; } // nom
		if (!empty($tabCont[4])) { echo '<div>'.$tabCont[4].'</div>'; } // fonction
		if (!empty($tabCont[5])) { echo '<div>'.$tabCont[5].'</div>'; } // loc1
		if (!empty($tabCont[6])) { echo '<div>'.$tabCont[6].'</div>'; } // loc2
		if (!empty($tabCont[7])) { echo '<div><img src="images/ico_tel.png" border="0"> '.$tabCont[7].'</div>'; } // tel1
		if (!empty($tabCont[8])) { echo '<div><img src="images/ico_tel.png" border="0"> '.$tabCont[8].'</div>'; } // tel2
		if (!empty($tabCont[9])) { echo '<div><img src="images/ico_fax.png" border="0"> '.$tabCont[9].'</div>'; } // fax1
		if (!empty($tabCont[10])) { echo '<div><img src="images/ico_fax.png" border="0"> '.$tabCont[10].'</div>'; } // fax2
		if (!empty($tabCont[11])) { echo '<div><img src="images/ico_email.png" border="0"> <a href="mailto:'.$tabCont[11].'" title="Ecrire">'.$tabCont[11].'</a></div>'; } // email
		if (!empty($tabCont[12])) { echo '<div><img src="images/ico_web.png" border="0"> <a href="'.$tabCont[12].'" target="_blank" title="Visiter le site de ce contact">'.$tabCont[12].'</a></div>'; } // web
		if (!empty($tabCont[13])) { echo '<div>{ <i>'.$tabCont[13].'</i> }</div>'; } // notes
		echo '</div>';

	} // fin AFFICHER

}
?>
<!-- // FIN Menu de droite -->
			</div>
		</td>
	</tr>
	</table> <!-- FIN contenu_page -->

	<div id="contenu_pied">
		<div id="contenu_pied_gauche">&nbsp;</div>
		<div id="contenu_pied_droit">
			<div id="contenu_pied_droit_carre">&nbsp;</div>
			<div id="contenu_pied_droit_texte">&rarr; kandida | 2010 | version 2</div>
			<div id="contenu_pied_droit_img">&nbsp;</div>
		</div>
	</div> <!-- FIN contenu_pied -->

</div> <!-- FIN conteneur-->

</body>
</HTML>
<?PHP deconnexion(); ?>
