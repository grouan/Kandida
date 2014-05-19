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
	$couleur = couleur ('Etablissements');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>

<head>

	<title>Kandida : établissement</title>

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
		$insertCand = insertEtbl ($_POST['nom'],$_POST['secteur'],$_POST['adr1'],$_POST['adr2'],$_POST['cp'],$_POST['ville'],$_POST['tel1'],$_POST['tel2'],$_POST['fax1'],$_POST['fax2'],$_POST['email'],$_POST['web'],$_POST['notes']);
		$identifiant = mysql_insert_id();
		if ($insertCand != 0) { echo '<meta http-equiv="refresh" content="0; URL=entreprise.php?session='.$session.'&mod=fiche&id='.$identifiant.'">'; }
	}
	if ( ($_GET['mod'] == 'modif') && ($_GET['statut'] == 'verif') ) { // Modification
		$modifCand = modifEtbl ($id,$_POST['nom'],$_POST['secteur'],$_POST['adr1'],$_POST['adr2'],$_POST['cp'],$_POST['ville'],$_POST['tel1'],$_POST['tel2'],$_POST['fax1'],$_POST['fax2'],$_POST['email'],$_POST['web'],$_POST['notes']);
		if ($modifCand != 0) { echo '<meta http-equiv="refresh" content="0; URL=entreprise.php?session='.$session.'&mod=fiche&id='.$id.'">'; }
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
			echo '<a href="entreprise.php?session='.$session.'&mod=modif&id='.$id.'" target="_self" title="Modifier cet établissement"><div id="contenu_page_gauche_modif">&nbsp;</div></a>';
			echo '<a href="entreprise.php?session='.$session.'&mod=suppr&id='.$id.'" target="_self" title="Supprimer cet établissement"><div id="contenu_page_gauche_suppr">&nbsp;</div></a>';
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

	if ($_GET['mod'] == 'liste') { // Liste des établissements ------------------------------

echo '<div id="page_titre" style="background-color:'.$couleur.';color:#FFF;">Liste des établissements</div>';

if (isset($_POST['orderby'])) { $orderby = $_POST['orderby']; } else { $orderby = 'identreprise DESC'; }
$tabCandEnCours = entreprises($orderby); // tab[$i][]

		echo '<div id="enCours">'; /* En cours */

// Tri
echo '<div style="margin-bottom:20px;color:#999;text-align:right;"><FORM method="post" action="entreprise.php?session='.$session.'&mod=liste">';
	echo '<img src="images/ico_engrenage.png" border="0" title="Trier par..."> <SELECT name="orderby">';
		echo '<OPTION value="nom" selected>Nom</OPTION>';
		echo '<OPTION value="secteur">Secteur</OPTION>';
		echo '<OPTION value="ville">Ville</OPTION>';
		echo '<OPTION value="identreprise">Numéro</OPTION>';
	echo '</SELECT>';
	echo '<INPUT type="submit" name="Submit" class="bouton" value="&raquo; Trier">';
echo '</FORM></div>';

			echo '<div id="page_sousTitre2"><img src="images/ico_encours.png" border="0" style="width:30px;height:30px;"> '.count($tabCandEnCours).' établissements</div>';			
			if (count($tabCandEnCours)>=1) {
				echo '<table class="liste_texte" border="0" cellpadding="0" cellspacing="0" width="100%">';
				for ($m=0;$m<count($tabCandEnCours);$m++) {
// $tab[$i][0=identreprise/1=nom/2=secteur/3=adr1/4=adr2/5=cp/6=ville/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes]
					if (($m%2)!=0) { /*impair*/$classe='liste_resultats2'; } else { /*pair*/$classe='liste_resultats'; }
					echo '<tr class="'.$classe.'">';
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><img src="images/dossier.png" style="width:20px;height:20px;"> </td>';
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="entreprise.php?session='.$session.'&mod=fiche&id='.$tabCandEnCours[$m][0].'" target="_self" class="candidature_titre" title="Voir cet établissement">'.$tabCandEnCours[$m][1].'</a></td> '; // Titre
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;font-size:9px;">'.$tabCandEnCours[$m][2].'</td> '; // Secteur
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;font-size:9px;">'.$tabCandEnCours[$m][6].'</td>'; // Ville
							$tabEC = listeCandidaturesEnCours($tabCandEnCours[$m][0],'dateFin ASC');	$nbEnCours = count($tabEC);
							$tabCP = listeCandidaturesPassees($tabCandEnCours[$m][0],'dateFin ASC');	$nbPassees = count($tabCP);
							if ($nbEnCours>=1) { echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><img src="images/ico_actualite.png" title="Candidatures en cours"></td>'; /*(candidatures en cours)*/ } else { echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><img src="images/blank.png"></td>'; }
							if ($nbPassees>=1) { echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><img src="images/ico_archive.gif" title="Candidatures archivées"></td>'; /*(candidatures archivées)*/ } else { echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><img src="images/blank.png"></td>'; }
						if (!empty($tabCandEnCours[$m][11])) { echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="mailto:'.$tabCandEnCours[$m][11].'" target="_blank" title="Ecrire à cet établissement"><img src="images/ico_email.png" border="0"></a></td>'; /* mail*/ }
							else { echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><img src="images/blank.png" border="0" style="padding:0px 5px;"> </td>'; }
						if (!empty($tabCandEnCours[$m][12])) { echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="'.$tabCandEnCours[$m][12].'" target="_blank" title="Voir le site web de cet établissement"><img src="images/ico_web.png" border="0"></a></td>'; /* web */ }
							else { echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><img src="images/blank.png" border="0" style="padding:0px 5px;"></td>'; }
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="contact.php?session='.$session.'&mod=liste&idEtbl='.$tabCandEnCours[$m][0].'" target="_self" title="Ajouter un contact"><img src="images/ico_contact.png" border="0"></a></td>'; // + contact
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="candidature.php?session='.$session.'&mod=liste&idEtbl='.$tabCandEnCours[$m][0].'" target="_self" title="Ajouter une candidature"><img src="images/ico_plus.png" border="0"></a></td>'; // + candidature
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="entreprise.php?session='.$session.'&mod=modif&id='.$tabCandEnCours[$m][0].'" target="_self" title="Modifier"><img src="images/ico_modif.png" border="0"></a></td>'; // modifier
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="entreprise.php?session='.$session.'&mod=suppr&id='.$tabCandEnCours[$m][0].'" target="_self" title="Supprimer"><img src="images/ico_suppr.png" border="0"></a></td>'; // supprimer
					echo '</tr>';
				}
				echo '</table>';
			}
			else { echo 'Aucun établissement n\'est disponible actuellement.'; }
		echo '</div>';
		echo '<div id="passe">'; /* Passées */
		// Retour
		echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';	
		echo '</div>';

	}
	if ($_GET['mod'] == 'fiche') { // AFFICHER un établissement -----------------------------

		$tabEtbl = entreprise ($id);

	echo '<div id="page_titre" style="color:'.$couleur.';">'.$tabEtbl[1].'</div>';

		echo '<div id="enCours">'; /* En cours */		
// Etablissement
			echo '<div id="texte_titre"><img src="images/ico_etbl.png" border="0"> Etablissement</div>';
			echo '<div id="texte_texte">';
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
			if (!empty($tabEtbl[13])) { echo '<div style="margin:20px 0px;background-color:#EAEAEA;border:1px dashed #999;padding:14px;color:#666">'.$tabEtbl[13].'</div>'; } // notes
			echo '</div>';
		echo '</div>';
		echo '<div id="passe">'; /* Archives */
			// Candidatures
			$tabCandEnCours = listeCandidaturesEnCours($id,'dateFin ASC');	$nbEnCours = count($tabCandEnCours);
			$tabCandPassees = listeCandidaturesPassees($id,'dateFin ASC');	$nbPassees = count($tabCandPassees);
			if ($nbEnCours==0) { echo '<div id="texte_titre"><img src="images/ico_rem.png" border="0"> Aucune candidature n\'est en cours</div>'; }
			else {
				if ($nbEnCours==1) { $candid='candidature'; } else { $candid='candidatures'; }
				echo '<div id="texte_titre"><img src="images/ico_rem.png" border="0"> '.$nbEnCours.' '.$candid.' en cours</div>';
				echo '<div id="texte_texte">';
					echo '<table class="liste_texte" border="0" cellpadding="0" cellspacing="0" width="100%">';
				echo '<tr class="liste_resultats" width="100%" style="background-color:#EEE;">';
						echo '<td style="font-size:11px;text-transform:uppercase;font-weight:bold;">Titre</td>';
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
					echo '<tr class="liste_resultats" width="100%">';
						//echo '<td class="liste_resultats" border="0"><img src="images/dossier.png" style="width:20px;height:20px;"></td>';
						echo '<td class="liste_resultats" border="0" style="border-bottom:1px solid #DDD;font-size:10px;padding:2px;"><a href="candidature.php?session='.$session.'&mod=fiche&id='.$tabCandidature[0].'" target="_self" class="candidature_titre" title="Voir cette candidature">'.$tabCandidature[8].'</a></td>'; // Titre
						//echo '<td class="liste_resultats" border="0">('.$tabCandidature[10].')</td>'; // (Grade)
						//echo '<td class="liste_resultats" border="0">('.$tabCandidature[15].')</td>'; // (ville)
						echo '<td class="liste_resultats" border="0" style="border-bottom:1px solid #DDD;font-size:11px;padding:2px;">'.$tabEntreprise[2].'</td>';
						echo '<td class="liste_resultats" border="0" style="border-bottom:1px solid #DDD;font-size:11px;padding:2px;">'.changeFormatDateMini($tabCandidature[16]).'</td>';
						echo '<td class="liste_resultats" border="0" style="border-bottom:1px solid #DDD;font-size:11px;padding:2px;">'.changeFormatDateMini($tabCandidature[17]).'</td>';
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
						echo '<td class="liste_resultats" border="0"><div style="border-bottom:1px solid #DDD;'.$styleTemps.'">'.$tpsRestant.' jours</div></td>';
						//echo '<td class="liste_resultats" border="0"><a href="'.$webCandidature.'" target="_blank" title="Voir la fiche en ligne"><img src="images/ico_web.png" border="0"></a></td>'; // web
						if ($tabCandidature[18] == "0000-00-00") { $envoye_image="envoye_non.gif"; $envoye_title="Répondre..."; } else { $envoye_image="envoye.png"; $envoye_title="La réponse a été envoyée le ".changeFormatDate($tabCandidature[18]); }
						echo '<td class="liste_resultats" border="0"><div style="border-bottom:1px solid #DDD;"><img src="images/'.$envoye_image.'" border="0" title="'.$envoye_title.'"></div></td>'; // envoyé ?
						echo '<td class="liste_resultats" border="0"><div style="border-bottom:1px solid #DDD;"><a href="candidature.php?session='.$session.'&mod=modif&id='.$tabCandidature[0].'" target="_self" title="Modifier"><img src="images/ico_modif.png" border="0"></a></div></td>'; // modifier
						echo '<td class="liste_resultats" border="0"><div style="border-bottom:1px solid #DDD;"><a href="candidature.php?session='.$session.'&mod=suppr&id='.$tabCandidature[0].'" target="_self" title="Supprimer"><img src="images/ico_suppr.png" border="0"></a></div></td>'; // supprimer
					echo '</tr>';
				}
				echo '</table>';
				echo '</div>';
			}
			
			if ($nbPassees==0) { echo '<div id="texte_titre"><img src="images/ico_rem.png" border="0"> Aucune candidature n\'est archivée</div>'; }
			else {
				if ($nbPassees==1) { $candid='candidature'; } else { $candid='candidatures'; }
				echo '<div id="texte_titre"><img src="images/ico_rem.png" border="0"> '.$nbPassees.' '.$candid.' dans les archives</div>';
				echo '<div id="texte_texte">';
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
				echo '</div>';
			}
			
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
	}
	if ($_GET['mod'] == 'ajout') { // AJOUTER un établissement -----------------------------

		echo '<div id="page_titre" style="color:'.$couleur.';">Ajout d\'un établissement</div>';
		echo '<div id="enCours">'; /* En cours */		
			//$insertCand = insertEtbl ($_POST['nom'],$_POST['secteur'],$_POST['adr1'],$_POST['adr2'],$_POST['cp'],$_POST['ville'],$_POST['tel1'],$_POST['tel2'],$_POST['fax1'],$_POST['fax2'],$_POST['email'],$_POST['web'],$_POST['notes']);
if ($insertCand == 0) { echo '<font color="red">Une erreur est survenue lors de l\'ajout de cet établissement !</font>'; }
else { echo '<font color="green">Votre établissement a été ajouté avec succès !</font>'; }
		echo '</div>';
		echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
	}
	if ($_GET['mod'] == 'modif') { // MODIFIER un établissement -----------------------------

		if ($_GET['statut'] == 'verif') { // vérif formulaire modif
			echo '<div id="page_titre" style="color:'.$couleur.';">Modification d\'un établissement</div>';
			echo '<div id="enCours">'; /* En cours */
			//$modifCand = modifEtbl ($id,$_POST['nom'],$_POST['secteur'],$_POST['adr1'],$_POST['adr2'],$_POST['cp'],$_POST['ville'],$_POST['tel1'],$_POST['tel2'],$_POST['fax1'],$_POST['fax2'],$_POST['email'],$_POST['web'],$_POST['notes']);
if ($modifCand == 0) { echo '<font color="red">Une erreur est survenue lors de la modification de cet établissement !</font>'; }
else { 
	echo '<div><font color="green">Votre établissement a été modifié avec succès !</font></div>';
	echo '<a href="entreprise.php?session='.$session.'&mod=fiche&id='.$id.'" target="_self"><div>&raquo; voir la fiche de cet établissement</div></a>';
}
			echo '</div>';
			echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
		}
		else { // affichage formulaire modif
			echo '<div id="page_titre" style="color:'.$couleur.';">Modification d\'un établissement</div>';
			echo '<div id="enCours">'; /* En cours */
			$tabEtbl = entreprise ($id);
			echo '<FORM method="post" action="entreprise.php?session='.$session.'&mod=modif&id='.$id.'&statut=verif">';
			echo '<div id="texte_titre"><img src="images/ico_etbl.png" border="0"> Etablissement</div>';
			echo '<div id="texte_texte">';
			echo '<div><font color="#CCCCCC">Nom :</font> <INPUT type="text" size="30px" name="nom" value="'.$tabEtbl[1].'"></div>'; // nom
			echo '<div><font color="#CCCCCC">Secteur :</font> <INPUT type="text" size="30px" name="secteur" value="'.$tabEtbl[2].'"></div>'; // secteur
			echo '<div><font color="#CCCCCC">Adresse :</font> <INPUT type="text" size="30px" name="adr1" value="'.$tabEtbl[3].'"></div>'; // adr1
			echo '<div><font color="transparent">Adresse :</font> <INPUT type="text" size="30px" name="adr2" value="'.$tabEtbl[4].'"></div>'; // adr2
			echo '<div><font color="transparent">Adresse :</font> <INPUT type="text" size="5px" name="cp" value="'.$tabEtbl[5].'"> <INPUT type="text" size="20px" name="ville" value="'.$tabEtbl[6].'"></div>'; // cp + ville
			echo '<div><font color="#CCCCCC">Téléphone :</font> <img src="images/ico_tel.png" border="0"> <INPUT type="text" size="15px" name="tel1" value="'.$tabEtbl[7].'"></div>'; // tel1
			echo '<div><font color="#CCCCCC">Téléphone :</font> <img src="images/ico_tel.png" border="0"> <INPUT type="text" size="15px" name="tel2" value="'.$tabEtbl[8].'"></div>'; // tel2
			echo '<div><font color="#CCCCCC">Fax :</font> <img src="images/ico_tel.png" border="0"> <INPUT type="text" size="15px" name="fax1" value="'.$tabEtbl[9].'"></div>'; // fax1
			echo '<div><font color="#CCCCCC">Fax :</font> <img src="images/ico_tel.png" border="0"> <INPUT type="text" size="15px" name="fax2" value="'.$tabEtbl[10].'"></div>'; // fax2
			echo '<div><font color="#CCCCCC">Messagerie :</font> <img src="images/ico_email.png" border="0"> <INPUT type="text" size="30px" name="email" value="'.$tabEtbl[11].'"></div>'; // email
			echo '<div><font color="#CCCCCC">Site web :</font> <img src="images/ico_web.png" border="0"> <INPUT type="text" size="30px" name="web" value="'.$tabEtbl[12].'"></div>'; // web
			echo '<div><font color="#CCCCCC">Remarques :</font> <TEXTAREA size="14px" name="notes" value="'.$tabEtbl[13].'">'.$tabEtbl[13].'</TEXTAREA></div>';
			echo '</div>';
			echo '<INPUT type="submit" name="Submit" class="bouton" value="&raquo; Modifier cet établissement">';
			echo '</FORM>';

			echo '</div>';
			echo '<div id="passe">'; /* Archives */
				echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
			echo '</div>';
		}
	}
	if ($_GET['mod'] == 'suppr') { // SUPPRIMER un établissement -----------------------------

		if ($_GET['statut'] == 'verif') { // suppression effective
			echo '<div id="page_titre" style="color:'.$couleur.';">Suppression d\'un établissement</div>';
			echo '<div id="enCours">'; /* En cours */
			$supprCand = supprEtbl ($id);
if ($supprCand == 0) { echo '<font color="red">Une erreur est survenue lors de la suppression de cet établissement !</font>'; }
else { echo '<font color="green">Votre établissement a été supprimé !</font>'; }
			echo '</div>';
			echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
		}
		else { // confirmation suppression ?
			echo '<div id="page_titre" style="color:'.$couleur.';">Suppression d\'un établissement</div>';
			echo '<div id="enCours">'; /* En cours */
				echo '<FORM method="post" action="entreprise.php?session='.$session.'&mod=suppr&id='.$id.'&statut=verif">';
				echo '<div style="color:red;margin-bottom:20px;">Souhaitez-vous réellement supprimer l\'établissement #<b>'.$id.'</b> ?</div>';
////////////////////////
echo '<table class="liste_texte" border="0" cellpadding="0" cellspacing="0" width="100%">';
// $tab[$i][0=identreprise/1=nom/2=secteur/3=adr1/4=adr2/5=cp/6=ville/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes]
$tabCandEnCours = entreprise($id);
					echo '<tr class="liste_resultats" width="100%">';
						echo '<td class="liste_resultats" border="0"><img src="images/dossier.png" style="width:20px;height:20px;"></td>';
						echo '<td class="liste_resultats" border="0"><a href="entreprise.php?session='.$session.'&mod=fiche&id='.$tabCandEnCours[0].'" target="_self" class="candidature_titre" title="Voir cet établissement">'.$tabCandEnCours[1].' (<i>'.$tabCandEnCours[2].'</i>)</a> '; // Titre
						echo '<td class="liste_resultats" border="0">'.$tabCandEnCours[6].'</td>'; // (ville)
						echo '<td class="liste_resultats" border="0"><a href="'.$tabCandEnCours[12].'" target="_blank" title="Voir la fiche en ligne"><img src="images/ico_web.png" border="0"></a></td>'; // web
						echo '<td class="liste_resultats" border="0"><a href="contact.php?session='.$session.'&mod=liste&id='.$tabCandEnCours[0].'" target="_self" title="Ajouter un contact"><img src="images/ico_contact.png" border="0"></a></td>'; // + contact
echo '<td class="liste_resultats" border="0"><a href="entreprise.php?session='.$session.'&mod=modif&id='.$tabCandEnCours[0].'" target="_self" title="Modifier"><img src="images/ico_modif.png" border="0"></a></td>'; // modifier
						echo '<td class="liste_resultats" border="0"><a href="entreprise.php?session='.$session.'&mod=suppr&id='.$tabCandEnCours[0].'" target="_self" title="Supprimer"><img src="images/ico_suppr.png" border="0"></a></td>'; // supprimer
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

	if ($_GET['mod'] == 'liste') { // LISTER les établissements ------------------------------
echo '<FORM method="post" action="entreprise.php?session='.$session.'&mod=ajout">';
			echo '<div id="texte_titre"><img src="images/ico_etbl.png" border="0"> Etablissement</div>';
			echo '<div id="texte_texte">';
			echo '<div><font color="#CCCCCC">Nom :</font> <INPUT type="text" size="30px" name="nom"></div>'; // nom
			echo '<div><font color="#CCCCCC">Secteur :</font> <INPUT type="text" size="30px" name="secteur"></div>'; // secteur
			echo '<div><font color="#CCCCCC">Adresse :</font> <INPUT type="text" size="30px" name="adr1"></div>'; // adr1
			echo '<div><font color="transparent">Adresse :</font> <INPUT type="text" size="30px" name="adr2"></div>'; // adr2
			echo '<div><font color="transparent">Adresse :</font> <INPUT type="text" size="5px" name="cp"> <INPUT type="text" size="20px" name="ville"></div>'; // cp + ville
			echo '<div><font color="#CCCCCC">Téléphone :</font> <img src="images/ico_tel.png" border="0"> <INPUT type="text" size="15px" name="tel1"></div>'; // tel1
			echo '<div><font color="#CCCCCC">Téléphone :</font> <img src="images/ico_tel.png" border="0"> <INPUT type="text" size="15px" name="tel2"></div>'; // tel2
			echo '<div><font color="#CCCCCC">Fax :</font> <img src="images/ico_tel.png" border="0"> <INPUT type="text" size="15px" name="fax1"></div>'; // fax1
			echo '<div><font color="#CCCCCC">Fax :</font> <img src="images/ico_tel.png" border="0"> <INPUT type="text" size="15px" name="fax2"></div>'; // fax2
			echo '<div><font color="#CCCCCC">Messagerie :</font> <img src="images/ico_email.png" border="0"> <INPUT type="text" size="30px" name="email"></div>'; // email
			echo '<div><font color="#CCCCCC">Site web :</font> <img src="images/ico_web.png" border="0"> <INPUT type="text" size="30px" name="web"></div>'; // web
			echo '<div><font color="#CCCCCC">Remarques :</font> <TEXTAREA size="14px" name="notes"></TEXTAREA></div>';
			echo '</div>';
			echo '<INPUT type="submit" name="Submit" class="bouton" value="&raquo; Ajouter cet établissement">';
			echo '</FORM>';
	}
	if ($_GET['mod'] == 'fiche') { // AFFICHER un établissement -----------------------------

		// Contacts
		$tabContacts = listeContactsEntreprise ($id);
		if (count($tabContacts)>=1) {
			for ($p=0;$p<count($tabContacts);$p++) {
				echo '<div id="texte_titre"><img src="images/ico_contact.png" border="0"> Contact</div>';
				echo '<div id="texte_texte">';echo '<div><a href="contact.php?session='.$session.'&mod=fiche&id='.$tabContacts[$p][0].'" target="_self" title="Voir la fiche de ce contact"><b>'.$tabContacts[$p][1].' '.$tabContacts[$p][2].' '.$tabContacts[$p][3].'</b></a></div>'; // nom
				if (!empty($tabContacts[$p][4])) { echo '<div>'.$tabContacts[$p][4].'</div>'; } // fonction
				if (!empty($tabContacts[$p][5])) { echo '<div>'.$tabContacts[$p][5].'</div>'; } // loc1
				if (!empty($tabContacts[$p][6])) { echo '<div>'.$tabContacts[$p][6].'</div>'; } // loc2
				if (!empty($tabContacts[$p][7])) { echo '<div><img src="images/ico_tel.png" border="0"> '.$tabContacts[$p][7].'</div>'; } // tel1
				if (!empty($tabContacts[$p][8])) { echo '<div><img src="images/ico_tel.png" border="0"> '.$tabContacts[$p][8].'</div>'; } // tel2
				if (!empty($tabContacts[$p][9])) { echo '<div><img src="images/ico_fax.png" border="0"> '.$tabContacts[$p][9].'</div>'; } // fax1
				if (!empty($tabContacts[$p][10])) { echo '<div><img src="images/ico_fax.png" border="0"> '.$tabContacts[$p][10].'</div>'; } // fax2
				if (!empty($tabContacts[$p][11])) { echo '<div><img src="images/ico_email.png" border="0"> <a href="mailto:'.$tabCont[11].'" title="Ecrire">'.$tabContacts[$p][11].'</a></div>'; } // email
				if (!empty($tabContacts[$p][12])) { echo '<div><img src="images/ico_web.png" border="0"> <a href="'.$tabContacts[$p][12].'" target="_blank" title="Visiter le site de ce contact">'.$tabContacts[$p][12].'</a></div>'; } // web
				if (!empty($tabContacts[$p][13])) { echo '<div>{ <i>'.$tabContacts[$p][13].'</i> }</div>'; } // notes
				echo '</div>';
			}
		}
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
