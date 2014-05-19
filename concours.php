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
	$couleur = couleur ('Concours');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>

<head>

	<title>Kandida : concours</title>

	<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="fr">
	<meta name="Robots" content="noindex, nofollow">
	<meta name="author" content="Guillaume ROUAN">

	<script language="JavaScript" type="text/JavaScript" src="js/page.js"></script>
	<LINK href="css/kandida.css" rel="stylesheet" type="text/css">
<?PHP
	echo'<script type="text/css">A.candidature_titre:hover,A.candidature_etbl:hover{color:'.$couleur.';}</script>';
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
			echo '<a href="concours.php?session='.$session.'&mod=modif&id='.$id.'" target="_self" title="Modifier ce concours"><div id="contenu_page_gauche_modif">&nbsp;</div></a>';
			echo '<a href="concours.php?session='.$session.'&mod=suppr&id='.$id.'" target="_self" title="Supprimer un concours"><div id="contenu_page_gauche_suppr">&nbsp;</div></a>';
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

	if ($_GET['mod'] == 'liste') { // Liste des concours ------------------------------

echo '<div id="page_titre" style="color:'.$couleur.';">Liste des concours</div>';
$tabCandEnCours = listeConcoursEnCours();
$tabCandPassees = listeConcoursPasses();
		echo '<div id="enCours">'; /* En cours */
			echo '<div id="page_sousTitre2"><img src="images/ico_encours.png" border="0" style="width:30px;height:30px;"> '.count($tabCandEnCours).' en cours</div>';			
			if (count($tabCandEnCours)>=1) {
				echo '<table class="liste_texte" border="0" cellpadding="0" cellspacing="0" width="100%">';
				for ($m=0;$m<count($tabCandEnCours);$m++) {
					$tabCandidature = concours ($tabCandEnCours[$m]);
					$tabEntreprise = entreprise ($tabCandidature[1]); // organisateur
					$webCandidature = $tabCandidature[6];
					echo '<tr class="liste_resultats" width="100%">';
						echo '<td class="liste_resultats" border="0"><img src="images/dossier.png" style="width:20px;height:20px;"></td>';
						echo '<td class="liste_resultats" border="0"><a href="concours.php?session='.$session.'&mod=fiche&id='.$tabCandidature[0].'" target="_self" class="candidature_titre" title="Voir ce concours">'.$tabCandidature[3].' ('.$tabCandidature[4].')</a> '; // Titre
						//echo '<td class="liste_resultats" border="0">('.$tabCandidature[10].')</td>'; // (Grade)
						echo ' &rarr; <i><a href="etablissement.php?session='.$session.'&mod=fiche&id='.$tabCandidature[1].'" target="_self" class="candidature_etbl" title="Voir cet établissement">'.$tabEntreprise[1].'</a></i></td>'; // Etblt
						//echo '<td class="liste_resultats" border="0">('.$tabCandidature[15].')</td>'; // (ville)
						echo '<td class="liste_resultats" border="0"><a href="'.$webCandidature.'" target="_blank" title="Voir la fiche en ligne"><img src="images/ico_web.png" border="0"></a></td>'; // web
						echo '<td class="liste_resultats" border="0"><a href="concours.php?session='.$session.'&mod=modif&id='.$tabCandidature[0].'" target="_self" title="Modifier"><img src="images/ico_modif.png" border="0"></a></td>'; // modifier
						echo '<td class="liste_resultats" border="0"><a href="concours.php?session='.$session.'&mod=suppr&id='.$tabCandidature[0].'" target="_self" title="Supprimer"><img src="images/ico_suppr.png" border="0"></a></td>'; // supprimer
					echo '</tr>';
				}
				echo '</table>';
			}
			else { echo 'Aucun concours n\'est actuellement en cours de traitement.'; }
		echo '</div>';
		echo '<div id="passe">'; /* Passées */
			echo '<div id="page_sousTitre2"><img src="images/ico_passe.png" border="0" style="width:30px;height:30px;"> '.count($tabCandPassees).' archives</div>';
			if (count($tabCandPassees)>=1) {
				echo '<table class="liste_texte" border="0" cellpadding="0" cellspacing="0" width="100%">';
				for ($m=0;$m<count($tabCandPassees);$m++) {
					$tabCandidature = concours ($tabCandPassees[$m]);
					$tabEntreprise = entreprise ($tabCandidature[1]); // organisateur
					$webCandidature = $tabCandidature[6];
					echo '<tr class="liste_resultats">';
						echo '<td class="liste_resultats" border="0"><img src="images/dossier.png" style="width:20px;height:20px;"></td>';
						echo '<td class="liste_resultats" border="0"><a href="concours.php?session='.$session.'&mod=fiche&id='.$tabCandidature[0].'" target="_self" class="candidature_titre" title="Voir ce concours">'.$tabCandidature[3].' ('.$tabCandidature[4].')</a> '; // Titre
						//echo '<td class="liste_resultats" border="0">('.$tabCandidature[10].')</td>'; // (Grade)
						echo ' &rarr; <i><a href="etablissement.php?session='.$session.'&mod=fiche&id='.$tabCandidature[1].'" target="_self" class="candidature_etbl" title="Voir cet établissement">'.$tabEntreprise[1].'</a></i></td>'; // Etblt
						//echo '<td class="liste_resultats" border="0">('.$tabCandidature[15].')</td>'; // (ville)
						echo '<td class="liste_resultats" border="0"><a href="'.$webCandidature.'" target="_blank" title="Voir la fiche en ligne"><img src="images/ico_web.png" border="0"></a></td>'; // web
						echo '<td class="liste_resultats" border="0"><a href="concours.php?session='.$session.'&mod=modif&id='.$tabCandidature[0].'" target="_self" title="Modifier"><img src="images/ico_modif.png" border="0"></a></td>'; // modifier
						echo '<td class="liste_resultats" border="0"><a href="concours.php?session='.$session.'&mod=suppr&id='.$tabCandidature[0].'" target="_self" title="Supprimer"><img src="images/ico_suppr.png" border="0"></a></td>'; // supprimer
					echo '</tr>';
				}
				echo '</table>';
			}
			else { echo 'Aucun concours n\'est archivé.'; }
		echo '</div>';

	}
	if ($_GET['mod'] == 'fiche') { // AFFICHER un concours -----------------------------

		$tabCandidature = concours ($id);
		$tabEtbl = entreprise ($tabCandidature[1]);

	echo '<div id="page_titre" style="color:'.$couleur.';">'.$tabCandidature[3].'<br><span style="color:#BBB;">session '.$tabCandidature[2].'</span></div>';

		echo '<div id="enCours">'; /* En cours */		
// Administration
echo '<div id="texte_titre"><img src="images/ico_admin.png" border="0"> Informations administratives</div>';
echo '<div id="texte_texte">';
	if ($tabCandidature[4]!='0') { echo '<div><font color="#CCCCCC">Catégorie :</font> '.$tabCandidature[4].'</div>'; }
	echo '<div><font color="#CCCCCC">Modalité :</font> '.$tabCandidature[5].'</div>';
	if ($tabCandidature[6]!='0') { echo '<div><font color="#CCCCCC">Fiche web :</font> <a href="'.$tabCandidature[6].'" target="_blank">'.$tabCandidature[6].'</a></div>'; }
	if ($tabCandidature[16]!='0') { echo '<div><font color="#CCCCCC">Nombre de postes ouverts :</font> '.$tabCandidature[16].'</div>'; }
echo '</div>';

// Calendrier
echo '<div id="texte_titre"><img src="images/ico_agenda.png" border="0"> Calendrier</div>';
echo '<div id="texte_texte">';
if ($tabCandidature[7]!='0000-00-00') {
	echo '<div><font color="#CCCCCC">Retrait du dossier :</font> '.changeFormatDate($tabCandidature[7]);
	if ($tabCandidature[8]!='0000-00-00') { echo ' <font color="#CCCCCC">&rarr;</font> '.changeFormatDate($tabCandidature[8]); }
	echo '</div>';
}
if ($tabCandidature[9]!='0000-00-00') { echo '<div><font color="#CCCCCC">Limite de dépôt du dossier :</font> '.changeFormatDate($tabCandidature[9]).'</div>'; }
if ($tabCandidature[10]!='0000-00-00') {
	echo '<div><font color="#CCCCCC">Epreuves écrites :</font> '.changeFormatDate($tabCandidature[10]).'';
	if ($tabCandidature[12]!='0000-00-00') { echo ' <font color="#CCCCCC">&rarr; Résultats :</font> '.changeFormatDate($tabCandidature[12]);}
	if ($tabCandidature[14]!='0') { echo ' &middot; '.$tabCandidature[14]; }
	echo '</div>';
}
if ($tabCandidature[11]!='0000-00-00') {
	echo '<div><font color="#CCCCCC">Epreuves orales :</font> '.changeFormatDate($tabCandidature[11]).'';
	if ($tabCandidature[13]!='0000-00-00') { echo ' <font color="#CCCCCC">&rarr; Résultats :</font> '.changeFormatDate($tabCandidature[13]);}
	if ($tabCandidature[15]!='0') { echo ' &middot; '.$tabCandidature[15]; }
	echo '</div>';
}
echo '<div><img src="images/ico_cal_ajout.gif" border="0"> <a href="agenda.php?session='.$session.'&mod=ajout&type=concours&id='.$id.'" target="_blank" title="Hors : parution | envoi | réponse">Ajouter un événement à ce concours</a></div>'; // ajouter un événement
echo '</div>';

		echo '</div>';
		echo '<div id="passe">'; /* Archives */
			// Notes
			echo '<div id="texte_titre"><img src="images/ico_rem.png" border="0"> Remarques</div>';
			echo '<div id="texte_texte">';
			if (!empty($tabCandidature[17])) { echo '<div>'.$tabCandidature[17].'</div>'; }
			echo '</div>';
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
	}
	if ($_GET['mod'] == 'ajout') { // AJOUTER un concours -----------------------------

		echo '<div id="page_titre" style="color:'.$couleur.';">Ajout de concours</div>';
		echo '<div id="enCours">'; /* En cours */		
			$insertCand = insertConcours ($_POST['idorganisateur'],$_POST['session'],$_POST['intitule'],$_POST['categorie'],$_POST['modalite'],$_POST['web'],$_POST['dateRetraitDossierDebut'],$_POST['dateRetraitDossierFin'],$_POST['dateLimiteDepotDossier'],$_POST['dateEcrit'],$_POST['dateOral'],$_POST['dateResultatEcrit'],$_POST['dateResultatOral'],$_POST['resultatEcrit'],$_POST['resultatOral'],$_POST['nbPostesOuverts'],$_POST['notes']);
if ($insertCand == 0) { echo '<font color="red">Une erreur est survenue lors de l\'ajout de ce concours !</font>'; }
else { echo '<font color="green">Votre concours a été ajoutée avec succès !</font>'; }
		echo '</div>';
		echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
	}
	if ($_GET['mod'] == 'modif') { // MODIFIER un concours -----------------------------

		if ($_GET['statut'] == 'verif') { // vérif formulaire modif
			echo '<div id="page_titre" style="color:'.$couleur.';">Modification de concours</div>';
			echo '<div id="enCours">'; /* En cours */
			$modifCand = modifConcours ($id,$_POST['idorganisateur'],$_POST['session'],$_POST['intitule'],$_POST['categorie'],$_POST['modalite'],$_POST['web'],$_POST['dateRetraitDossierDebut'],$_POST['dateRetraitDossierFin'],$_POST['dateLimiteDepotDossier'],$_POST['dateEcrit'],$_POST['dateOral'],$_POST['dateResultatEcrit'],$_POST['dateResultatOral'],$_POST['resultatEcrit'],$_POST['resultatOral'],$_POST['nbPostesOuverts'],$_POST['notes']);
if ($modifCand == 0) { echo '<font color="red">Une erreur est survenue lors de la modification de ce concours !</font>'; }
else { 
	echo '<div><font color="green">Votre concours a été modifié avec succès !</font></div>';
	echo '<a href="concours.php?session='.$session.'&mod=fiche&id='.$id.'" target="_self"><div>&raquo; voir la fiche de ce concours</div></a>';
}
			echo '</div>';
			echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
		}
		else { // affichage formulaire modif
			$tabCand = concours($id);
			echo '<div id="page_titre" style="color:'.$couleur.';">Modification de concours</div>';
			echo '<div id="enCours">'; /* En cours */
			echo '<FORM method="post" action="concours.php?session='.$session.'&mod=modif&id='.$id.'&statut=verif">';
			// Administration
			$tabEntreprises = entreprises('nom');
			echo '<div><font color="#CCCCCC">Organisateur :</font> <SELECT name="idorganisateur">';
				for ($e=0;$e<count($tabEntreprises);$e++) {
					echo '<OPTION value="'.$tabEntreprises[$e][0].'"';
					if ($tabEntreprises[$e][0]==$tabCand[1]) { echo ' selected'; }
					echo '>'.$tabEntreprises[$e][1].'</OPTION>';
				}
			echo '</SELECT> <a href="entreprise.php?session='.$session.'&mod=ajout" target="_self"><img src="images/ico_plus.png" border="0" title="Ajouter un établissement"></a></div>';
			echo '<div><font color="#CCCCCC">Catégorie :</font> <SELECT name="categorie">';
			$tabType = array ('A','B','C');
			for ($e=0;$e<count($tabType);$e++) {
					echo '<OPTION value="'.$tabType[$e].'"';
					if($tabType[$e]==$tabCand[4]) { echo ' selected'; }
					echo '>'.$tabType[$e].'</OPTION>';
				}
			echo '</SELECT> ';
			echo ' <font color="#CCCCCC">Modalité :</font> <SELECT name="modalite">';
			$tabEmploi = array ('externe','interne','troisième voie','examen professionnel');
			for ($e=0;$e<count($tabEmploi);$e++) {
					echo '<OPTION value="'.$tabEmploi[$e].'"';
					if($tabEmploi[$e]==$tabCand[5]) { echo ' selected'; }
					echo '>'.$tabEmploi[$e].'</OPTION>';
				}
			echo '</SELECT></div>';
			echo '<div><font color="#CCCCCC">Intitule :</font> <INPUT type="text" size="30px" name="intitule" value="'.$tabCand[3].'"> <font color="#CCCCCC">Session :</font> <INPUT type="text" size="4px" name="session" value="'.$tabCand[2].'"></div><br><br>';
			echo '<div id="texte_titre"><img src="images/ico_admin.png" border="0"> Informations administratives</div>';
			echo '<div id="texte_texte">';
				echo '<div><font color="#CCCCCC">Site web :</font> <img src="images/ico_web.png" border="0"><INPUT type="text" size="30px" name="web" value="'.$tabCand[6].'"></div>';
				echo '<div><font color="#CCCCCC">Nombre de postes ouverts :</font> <INPUT type="text" size="3px" name="nbPostesOuverts" value="'.$tabCand[16].'"></div>';
			echo '</div>';

			// Calendrier
			echo '<div id="texte_titre"><img src="images/ico_agenda.png" border="0"> Calendrier</div>';
			echo '<div id="texte_texte">';
			echo '<div><font color="#CCCCCC">Retrait du dossier d\'inscription :</font> <INPUT type="text" size="10px" name="dateRetraitDossierDebut" value="'.$tabCand[7].'"><font color="#CCCCCC"> &rarr; </font><INPUT type="text" size="10px" name="dateRetraitDossierFin" value="'.$tabCand[8].'"></div>';
			echo '<div><font color="#CCCCCC">Limite dépôt dossier :</font> <INPUT type="text" size="10px" name="dateLimiteDepotDossier" value="'.$tabCand[9].'"></div>';
			echo '<div><font color="#CCCCCC">Ecrit :</font> <INPUT type="text" size="10px" name="dateEcrit" value="'.$tabCand[10].'"> <font color="#CCCCCC">&rarr; Résultats :</font> <INPUT type="text" size="10px" name="dateResultatEcrit" value="'.$tabCand[12].'"> <SELECT name="resultatEcrit">';
			$tabEmploi = array ('0','positif','négatif');
			for ($e=0;$e<count($tabEmploi);$e++) {
					echo '<OPTION value="'.$tabEmploi[$e].'"';
					if($tabEmploi[$e]==$tabCand[14]) { echo ' selected'; }
					echo '>'.$tabEmploi[$e].'</OPTION>';
				}
			echo '</SELECT></div>';
			echo '<div><font color="#CCCCCC">Oral :</font> <INPUT type="text" size="10px" name="dateOral" value="'.$tabCand[11].'"> <font color="#CCCCCC">&rarr; Résultats :</font> <INPUT type="text" size="10px" name="dateResultatOral" value="'.$tabCand[13].'"> <SELECT name="resultatOral">';
			$tabEmploi = array ('0','positif','négatif','aucun');
			for ($e=0;$e<count($tabEmploi);$e++) {
					echo '<OPTION value="'.$tabEmploi[$e].'"';
					if($tabEmploi[$e]==$tabCand[15]) { echo ' selected'; }
					echo '>'.$tabEmploi[$e].'</OPTION>';
				}
			echo '</SELECT></div>';
			echo '</div>';
			// Remarques
			echo '<div id="texte_titre"><img src="images/ico_rem.png" border="0"> Remarques</div>';
				echo '<div id="texte_texte">';
				echo '<div><font color="#CCCCCC">Remarques :</font> <TEXTAREA size="14px" name="notes" '
					.'value="'.$tabCand[17].'">'.$tabCand[17].'</TEXTAREA></div>';
				echo '</div>';

			echo '<INPUT type="submit" name="Submit" class="bouton" value="&raquo; Modifier ce concours">';
			echo '</FORM>';

			echo '</div>';
			echo '<div id="passe">'; /* Archives */
				echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
			echo '</div>';
		}
	}
	if ($_GET['mod'] == 'suppr') { // SUPPRIMER un concours -----------------------------

		if ($_GET['statut'] == 'verif') { // suppression effective
			echo '<div id="page_titre" style="color:'.$couleur.';">Suppression de concours</div>';
			echo '<div id="enCours">'; /* En cours */
			$supprCand = supprConcours ($id);
if ($supprCand == 0) { echo '<font color="red">Une erreur est survenue lors de la suppression de ce concours !</font>'; }
else { echo '<font color="green">Votre concours a été supprimé !</font>'; }
			echo '</div>';
			echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
		}
		else { // confirmation suppression ?
			echo '<div id="page_titre" style="color:'.$couleur.';">Suppression de concours</div>';
			echo '<div id="enCours">'; /* En cours */
				echo '<FORM method="post" action="concours.php?session='.$session.'&mod=suppr&id='.$id.'&statut=verif">';
				echo '<div style="color:red;margin-bottom:20px;">Souhaitez-vous réellement supprimer le concours #<b>'.$id.'</b> ?</div>';
////////////////////////
echo '<table class="liste_texte" border="0" cellpadding="0" cellspacing="0" width="100%">';
					$tabCandidature = concours ($id);
					$tabEntreprise = entreprise ($tabCandidature[1]);
// $tab [0=idconcours] [1=idorganisateur] [2=session] [3=intitule] [4=categorie] [5=modalite] [6=web] [7=dateRetraitDossierDebut] [8=dateRetraitDossierFin] [9=dateLimiteDepotDossier] [10=dateEcrit] [11=dateOral] [12=dateResultatEcrit] [13=dateResultatOral] [14=resultatEcrit] [15=resultatOral] [16=nbPostesOuverts] [17=notes]
					$webCandidature = $tabCandidature[6];
					echo '<tr class="liste_resultats" width="100%">';
						echo '<td class="liste_resultats" border="0"><img src="images/dossier.png" style="width:20px;height:20px;"></td>';
						echo '<td class="liste_resultats" border="0"><a href="concours.php?session='.$session.'&mod=fiche&id='.$tabCandidature[0].'" target="_self" class="candidature_titre" title="Voir ce concours">'.$tabCandidature[3].'</a> '; // Titre
						echo ' &rarr; <i><a href="etablissement.php?session='.$session.'&mod=fiche&id='.$tabCandidature[1].'" target="_self" class="candidature_etbl" title="Voir cet établissement organisateur">'.$tabEntreprise[1].'</a></i></td>'; // Etblt
						echo '<td class="liste_resultats" border="0"><a href="'.$webCandidature.'" target="_blank" title="Voir la fiche en ligne"><img src="images/ico_web.png" border="0"></a></td>'; // web
						echo '<td class="liste_resultats" border="0"><a href="concours.php?session='.$session.'&mod=modif&id='.$tabCandidature[0].'" target="_self" title="Modifier"><img src="images/ico_modif.png" border="0"></a></td>'; // modifier
						echo '<td class="liste_resultats" border="0"><a href="concours.php?session='.$session.'&mod=suppr&id='.$tabCandidature[0].'" target="_self" title="Supprimer"><img src="images/ico_suppr.png" border="0"></a></td>'; // supprimer
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

	echo '<div id="aujourdhui">&raquo; Nous sommes le <b>'.setDate().'</b>, il est <b>'.setHeure().'</b></div>';

	if ($_GET['mod'] == 'liste') { // LISTER les concours ------------------------------
		echo '<FORM method="post" action="concours.php?session='.$session.'&mod=ajout">';
			// Administration
			$tabEntreprises = entreprises('nom');
			echo '<div><font color="#CCCCCC">Organisateur :</font> <SELECT name="idorganisateur">';
				for ($e=0;$e<count($tabEntreprises);$e++) {
					echo '<OPTION value="'.$tabEntreprises[$e][0].'">'.$tabEntreprises[$e][1].'</OPTION>';
				}
			echo '</SELECT> <a href="entreprise.php?session='.$session.'&mod=liste" target="_self"><img src="images/ico_plus.png" border="0" title="Ajouter un établissement"></a></div>';
			echo '<div><font color="#CCCCCC">Catégorie :</font> <SELECT name="categorie">';
			$tabType = array ('A','B','C');
			for ($e=0;$e<count($tabType);$e++) {
					echo '<OPTION value="'.$tabType[$e].'">'.$tabType[$e].'</OPTION>';
				}
			echo '</SELECT> ';
			echo ' <font color="#CCCCCC">Modalité :</font> <SELECT name="modalite">';
			$tabEmploi = array ('externe','interne','troisième voie','examen professionnel');
			for ($e=0;$e<count($tabEmploi);$e++) {
					echo '<OPTION value="'.$tabEmploi[$e].'">'.$tabEmploi[$e].'</OPTION>';
				}
			echo '</SELECT></div>';
			echo '<div><font color="#CCCCCC">Intitule :</font> <INPUT type="text" size="30px" name="intitule"> <font color="#CCCCCC">Session :</font> <INPUT type="text" size="4px" name="session"></div><br><br>';
			echo '<div id="texte_titre"><img src="images/ico_admin.png" border="0"> Informations administratives</div>';
			echo '<div id="texte_texte">';
				echo '<div><font color="#CCCCCC">Site web :</font> <img src="images/ico_web.png" border="0"><INPUT type="text" size="30px" name="web"></div>';
				echo '<div><font color="#CCCCCC">Nombre de postes ouverts :</font> <INPUT type="text" size="3px" name="nbPostesOuverts"></div>';
			echo '</div>';

			// Calendrier
			echo '<div id="texte_titre"><img src="images/ico_agenda.png" border="0"> Calendrier</div>';
			echo '<div id="texte_texte">';
			echo '<div><font color="#CCCCCC">Retrait du dossier d\'inscription :</font> <INPUT type="text" size="10px" name="dateRetraitDossierDebut"><font color="#CCCCCC"> &rarr; </font><INPUT type="text" size="10px" name="dateRetraitDossierFin"></div>';
			echo '<div><font color="#CCCCCC">Limite dépôt dossier :</font> <INPUT type="text" size="10px" name="dateLimiteDepotDossier"></div>';
			echo '<div><font color="#CCCCCC">Ecrit :</font> <INPUT type="text" size="10px" name="dateEcrit"> <font color="#CCCCCC">&rarr; Résultats :</font> <INPUT type="text" size="10px" name="dateResultatEcrit"> <SELECT name="resultatEcrit">';
			$tabEmploi = array ('0','positif','négatif');
			for ($e=0;$e<count($tabEmploi);$e++) {
					echo '<OPTION value="'.$tabEmploi[$e].'">'.$tabEmploi[$e].'</OPTION>';
				}
			echo '</SELECT></div>';
			echo '<div><font color="#CCCCCC">Oral :</font> <INPUT type="text" size="10px" name="dateOral"> <font color="#CCCCCC">&rarr; Résultats :</font> <INPUT type="text" size="10px" name="dateResultatOral"> <SELECT name="resultatOral">';
			$tabEmploi = array ('0','positif','négatif','aucun');
			for ($e=0;$e<count($tabEmploi);$e++) {
					echo '<OPTION value="'.$tabEmploi[$e].'">'.$tabEmploi[$e].'</OPTION>';
				}
			echo '</SELECT></div>';
			echo '</div>';
			// Remarques
			echo '<div id="texte_titre"><img src="images/ico_rem.png" border="0"> Remarques</div>';
				echo '<div id="texte_texte">';
				echo '<div><font color="#CCCCCC">Remarques :</font> <TEXTAREA size="14px" name="notes">'.$tabCand[17].'</TEXTAREA></div>';
				echo '</div>';

			echo '<INPUT type="submit" name="Submit" class="bouton" value="&raquo; Ajouter ce concours">';
			echo '</FORM>';
	}
	if ($_GET['mod'] == 'fiche') { // AFFICHER un concours -----------------------------
		// Etablissement
		echo '<div id="texte_titre"><img src="images/ico_etbl.png" border="0"> Etablissement organisateur</div>';
		echo '<div id="texte_texte">';
		if (!empty($tabEtbl[1])) { echo '<div><a href="etablissement.php?session='.$session.'&mod=fiche&id='.$tabCandidature[1].'" target="_self" title="Voir la fiche de cet établissement"><b>'.$tabEtbl[1].'</b></a></div>'; } // nom
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
