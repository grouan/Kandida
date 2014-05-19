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
	$couleur = couleur ('Contacts');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>

<head>

	<title>Kandida : contacts</title>

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
		$insertCand = insertContact ($_POST['identreprise'],$_POST['civ'],$_POST['nom'],$_POST['prenom'],$_POST['fonction'],$_POST['loc1'],$_POST['loc2'],$_POST['tel1'],$_POST['tel2'],$_POST['fax1'],$_POST['fax2'],$_POST['email'],$_POST['web'],$_POST['notes']);
		$identifiant = mysql_insert_id();
		if ($insertCand != 0) { echo '<meta http-equiv="refresh" content="0; URL=contact.php?session='.$session.'&mod=fiche&id='.$identifiant.'">'; }
	}
	if ( ($_GET['mod'] == 'modif') && ($_GET['statut'] == 'verif') ) { // Modification
		$modifCand = modifContact ($id,$_POST['identreprise'],$_POST['civ'],$_POST['nom'],$_POST['prenom'],$_POST['fonction'],$_POST['loc1'],$_POST['loc2'],$_POST['tel1'],$_POST['tel2'],$_POST['fax1'],$_POST['fax2'],$_POST['email'],$_POST['web'],$_POST['notes']);
		if ($modifCand != 0) { echo '<meta http-equiv="refresh" content="0; URL=contact.php?session='.$session.'&mod=fiche&id='.$id.'">'; }
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
			echo '<a href="contact.php?session='.$session.'&mod=modif&id='.$id.'" target="_self" title="Modifier ce contact"><div id="contenu_page_gauche_modif">&nbsp;</div></a>';
			echo '<a href="contact.php?session='.$session.'&mod=suppr&id='.$id.'" target="_self" title="Supprimer un contact"><div id="contenu_page_gauche_suppr">&nbsp;</div></a>';
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

	if ($_GET['mod'] == 'liste') { // Liste des contacts ------------------------------

echo '<div id="page_titre" style="background-color:'.$couleur.';color:#FFF;">Liste des contacts</div>';

if (isset($_POST['orderby'])) { $orderby = $_POST['orderby']; } else { $orderby = 'idcontact DESC'; }
$tabCandEnCours = contacts($orderby);
// $tab[$i][0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]

		echo '<div id="enCours">'; /* En cours */

// Tri
echo '<div style="margin-bottom:20px;color:#999;text-align:right;"><FORM method="post" action="contact.php?session='.$session.'&mod=liste">';
	echo '<img src="images/ico_engrenage.png" border="0" title="Trier par..."> <SELECT name="orderby">';
		echo '<OPTION value="nom" selected>Nom</OPTION>';
		echo '<OPTION value="fonction">Fonction</OPTION>';
		echo '<OPTION value="civ">Civilité</OPTION>';
		echo '<OPTION value="identreprise">Etablissement</OPTION>';
		echo '<OPTION value="idcontact">Numéro</OPTION>';
	echo '</SELECT>';
	echo '<INPUT type="submit" name="Submit" class="bouton" value="&raquo; Trier">';
echo '</FORM></div>';

			echo '<div id="page_sousTitre2"><img src="images/ico_encours.png" border="0" style="width:30px;height:30px;"> '.count($tabCandEnCours).' contacts</div>';			
			if (count($tabCandEnCours)>=1) {
				echo '<table class="liste_texte" border="0" cellpadding="0" cellspacing="0" width="100%">';
				for ($m=0;$m<count($tabCandEnCours);$m++) {
// $tab[$i][0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
					if (($m%2)!=0) { /*impair*/$classe='liste_resultats2'; } else { /*pair*/$classe='liste_resultats'; }
					echo '<tr class="'.$classe.'">';
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><img src="images/dossier.png" style="width:20px;height:20px;"></td>';
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="contact.php?session='.$session.'&mod=fiche&id='.$tabCandEnCours[$m][0].'" target="_self" class="candidature_titre" title="Voir ce contact">'.$tabCandEnCours[$m][1].'</a></td> '; // Civ
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="contact.php?session='.$session.'&mod=fiche&id='.$tabCandEnCours[$m][0].'" target="_self" class="candidature_titre" title="Voir ce contact">'.$tabCandEnCours[$m][2].'</a></td> '; // Nom
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="contact.php?session='.$session.'&mod=fiche&id='.$tabCandEnCours[$m][0].'" target="_self" class="candidature_titre" title="Voir ce contact">'.$tabCandEnCours[$m][3].'</a></td> '; // Prénom
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;">'.$tabCandEnCours[$m][4].'</td> '; // Fonction
						if (!empty($tabCandEnCours[$m][11])) { echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="mailto:'.$tabCandEnCours[$m][11].'" target="_blank" title="Ecrire à ce contact"><img src="images/ico_email.png" border="0"></a></td>'; /* mail*/ }
							else { echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><img src="images/blank.png" border="0"></td>'; }
						if (!empty($tabCandEnCours[$m][12])) { echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="'.$tabCandEnCours[$m][12].'" target="_blank" title="Voir le site web de ce contact"><img src="images/ico_web.png" border="0"></a></td>'; /* web */ }
							else { echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><img src="images/blank.png" border="0"></td>'; }
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="contact.php?session='.$session.'&mod=modif&id='.$tabCandEnCours[$m][0].'" target="_self" title="Modifier"><img src="images/ico_modif.png" border="0"></a></td>'; // modifier
						echo '<td class="liste_resultats" border="0" style="padding:0px 3px;border-bottom:1px solid #DDD;"><a href="contact.php?session='.$session.'&mod=suppr&id='.$tabCandEnCours[$m][0].'" target="_self" title="Supprimer"><img src="images/ico_suppr.png" border="0"></a></td>'; // supprimer
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
	if ($_GET['mod'] == 'fiche') { // AFFICHER un contact -----------------------------

		$tabCandidature = contact ($id);
		// $tab[0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
		$tabEtbl = entreprise ($tabCandidature[14]);
		// $tab[0=identreprise/1=nom/2=secteur/3=adr1/4=adr2/5=cp/6=ville/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes]

		echo '<div id="page_titre" style="color:'.$couleur.';">'.$tabCandidature[1].' '.$tabCandidature[3].' '.$tabCandidature[2].'</div>';

		echo '<div id="enCours">'; /* En cours */		
// Administration
echo '<div id="texte_texte">';
	if ($tabCandidature[4]!='0') { echo '<div><font color="#CCCCCC">Fonction :</font> '.$tabCandidature[4].'</div>'; }
	if ($tabCandidature[5]!='0') { echo '<div><font color="#CCCCCC">Localisation :</font> '.$tabCandidature[5].'</div>'; }
	if ($tabCandidature[6]!='0') { echo '<div><font color="#FFFFFF">Localisation :</font> '.$tabCandidature[6].'</div>'; }
	if ($tabCandidature[7]!='0') { echo '<div><font color="#CCCCCC">Téléphone :</font> '.$tabCandidature[7].'</div>'; }
	if ($tabCandidature[8]!='0') { echo '<div><font color="#FFFFFF">Téléphone :</font> '.$tabCandidature[8].'</div>'; }
	if ($tabCandidature[9]!='0') { echo '<div><font color="#CCCCCC">Fax :</font> '.$tabCandidature[9].'</div>'; }
	if ($tabCandidature[10]!='0') { echo '<div><font color="#FFFFFF">Fax :</font> '.$tabCandidature[10].'</div>'; }
	if ($tabCandidature[11]!='0') { echo '<div><font color="#CCCCCC">Email :</font> <a href="mailto:'.$tabCandidature[11].'" target="_self">'.$tabCandidature[11].'</a></div>'; }
	if ($tabCandidature[12]!='0') { echo '<div><font color="#CCCCCC">Web :</font> <a href="'.$tabCandidature[12].'" target="_blank">'.$tabCandidature[12].'</a></div>'; }
	
echo '</div>';

		echo '</div>';
		echo '<div id="passe">'; /* Archives */
			// Notes
			echo '<div id="texte_titre"><img src="images/ico_rem.png" border="0"> Remarques</div>';
			echo '<div id="texte_texte">';
			if ($tabCandidature[13]!='0') { echo '<div>'.$tabCandidature[13].'</div>'; }
			echo '</div>';
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
	}
	if ($_GET['mod'] == 'ajout') { // AJOUTER un contact -----------------------------
		echo '<div id="page_titre" style="color:'.$couleur.';">Ajout de contact</div>';
		if ($_GET['statut'] == 'verif') { // vérif formulaire modif
			echo '<div id="enCours">'; /* En cours */
			if ($insertCand == 0) { echo '<font color="red">Une erreur est survenue lors de l\'ajout de ce contact !</font>'; }
			else { echo '<font color="green">Votre contact a été ajouté avec succès !</font>'; }
		echo '</div>';
		}
		else {
			echo '<div id="enCours">'; /* En cours */
			echo '</div>';
		}
		echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
	}
	if ($_GET['mod'] == 'modif') { // MODIFIER un contact -----------------------------

		if ($_GET['statut'] == 'verif') { // vérif formulaire modif
			echo '<div id="page_titre" style="color:'.$couleur.';">Modification de contact</div>';
			echo '<div id="enCours">'; /* En cours */
if ($modifCand == 0) { echo '<font color="red">Une erreur est survenue lors de la modification de ce contact !</font>'; }
else { 
	echo '<div><font color="green">Votre contact a été modifié avec succès !</font></div>';
	echo '<a href="contact.php?session='.$session.'&mod=fiche&id='.$id.'" target="_self"><div>&raquo; voir la fiche de ce contact</div></a>';
}
			echo '</div>';
			echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
		}
		else { // affichage formulaire modif
			$tabCand = concours($id);
			echo '<div id="page_titre" style="color:'.$couleur.';">Modification de contact</div>';
			echo '<div id="enCours">'; /* En cours */
			echo '<FORM method="post" action="contact.php?session='.$session.'&mod=modif&id='.$id.'&statut=verif">';
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
	if ($_GET['mod'] == 'suppr') { // SUPPRIMER un contact -----------------------------

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
				echo '<FORM method="post" action="contact.php?session='.$session.'&mod=suppr&id='.$id.'&statut=verif">';
				echo '<div style="color:red;margin-bottom:20px;">Souhaitez-vous réellement supprimer le concours #<b>'.$id.'</b> ?</div>';
////////////////////////
echo '<table class="liste_texte" border="0" cellpadding="0" cellspacing="0" width="100%">';
					$tabCandidature = concours ($id);
					$tabEntreprise = entreprise ($tabCandidature[1]);
// $tab [0=idconcours] [1=idorganisateur] [2=session] [3=intitule] [4=categorie] [5=modalite] [6=web] [7=dateRetraitDossierDebut] [8=dateRetraitDossierFin] [9=dateLimiteDepotDossier] [10=dateEcrit] [11=dateOral] [12=dateResultatEcrit] [13=dateResultatOral] [14=resultatEcrit] [15=resultatOral] [16=nbPostesOuverts] [17=notes]
					$webCandidature = $tabCandidature[6];
					echo '<tr class="liste_resultats" width="100%">';
						echo '<td class="liste_resultats" border="0"><img src="images/dossier.png" style="width:20px;height:20px;"></td>';
						echo '<td class="liste_resultats" border="0"><a href="contact.php?session='.$session.'&mod=fiche&id='.$tabCandidature[0].'" target="_self" class="candidature_titre" title="Voir ce concours">'.$tabCandidature[3].'</a> '; // Titre
						echo ' &rarr; <i><a href="etablissement.php?session='.$session.'&mod=fiche&id='.$tabCandidature[1].'" target="_self" class="candidature_etbl" title="Voir cet établissement organisateur">'.$tabEntreprise[1].'</a></i></td>'; // Etblt
						echo '<td class="liste_resultats" border="0"><a href="'.$webCandidature.'" target="_blank" title="Voir la fiche en ligne"><img src="images/ico_web.png" border="0"></a></td>'; // web
						echo '<td class="liste_resultats" border="0"><a href="contact.php?session='.$session.'&mod=modif&id='.$tabCandidature[0].'" target="_self" title="Modifier"><img src="images/ico_modif.png" border="0"></a></td>'; // modifier
						echo '<td class="liste_resultats" border="0"><a href="contact.php?session='.$session.'&mod=suppr&id='.$tabCandidature[0].'" target="_self" title="Supprimer"><img src="images/ico_suppr.png" border="0"></a></td>'; // supprimer
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

	if ($_GET['mod'] == 'liste') { // LISTER les contact ------------------------------
		echo '<FORM method="post" action="contact.php?session='.$session.'&mod=ajout">';
			// Administration
			$tabEntreprises = entreprises('nom');
			echo '<div><font color="#CCCCCC">Etablissement :</font> <SELECT name="identreprise">';
				for ($e=0;$e<count($tabEntreprises);$e++) {
					if ((isset($_GET['idEtbl']))&&($_GET['idEtbl']==$tabEntreprises[$e][0])) { $selected='selected'; } else { $selected=''; }
					echo '<OPTION value="'.$tabEntreprises[$e][0].'" '.$selected.'>'.$tabEntreprises[$e][1].'</OPTION>';
				}
// $tab[0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
			echo '</SELECT> <a href="entreprise.php?session='.$session.'&mod=ajout" target="_self"><img src="images/ico_plus.png" border="0" title="Ajouter un établissement"></a></div>';
			echo '<div><font color="#CCCCCC">Civilité :</font> <SELECT name="civ">';
			$tabType = array ('Mme','Mlle','M');
			for ($e=0;$e<count($tabType);$e++) {
					echo '<OPTION value="'.$tabType[$e].'">'.$tabType[$e].'</OPTION>';
				}
			echo '</SELECT></div>';
			echo '<div><font color="#CCCCCC">Nom :</font> <INPUT type="text" size="30px" name="nom"></div>';
			echo '<div><font color="#CCCCCC">Prénom :</font> <INPUT type="text" size="30px" name="prenom"></div>';
			echo '<div><font color="#CCCCCC">Fonction :</font> <INPUT type="text" size="30px" name="fonction"></div>';
			
			echo '<div><font color="#CCCCCC">Localisation :</font> <INPUT type="text" size="30px" name="loc1"></div>'; // adr1
			echo '<div><font color="transparent">Localisation :</font> <INPUT type="text" size="30px" name="loc2"></div>'; // adr2
			echo '<div><font color="#CCCCCC">Téléphone :</font> <img src="images/ico_tel.png" border="0"> <INPUT type="text" size="15px" name="tel1"></div>'; // tel1
			echo '<div><font color="transparent">Téléphone :</font> <img src="images/ico_tel.png" border="0"> <INPUT type="text" size="15px" name="tel2"></div>'; // tel2
			echo '<div><font color="#CCCCCC">Fax :</font> <img src="images/ico_tel.png" border="0"> <INPUT type="text" size="15px" name="fax1"></div>'; // fax1
			echo '<div><font color="transparent">Fax :</font> <img src="images/ico_tel.png" border="0"> <INPUT type="text" size="15px" name="fax2"></div>'; // fax2
			echo '<div><font color="#CCCCCC">Messagerie :</font> <img src="images/ico_email.png" border="0"> <INPUT type="text" size="30px" name="email"></div>'; // email
			echo '<div><font color="#CCCCCC">Site web :</font> <img src="images/ico_web.png" border="0"> <INPUT type="text" size="30px" name="web"></div><br><br>'; // web
			
			// Remarques
			echo '<div id="texte_titre"><img src="images/ico_rem.png" border="0"> Remarques</div>';
				echo '<div id="texte_texte">';
				echo '<div><font color="#CCCCCC">Remarques :</font> <TEXTAREA size="14px" name="notes"></TEXTAREA></div>';
				echo '</div>';

			echo '<INPUT type="submit" name="Submit" class="bouton" value="&raquo; Ajouter ce contact">';
			echo '</FORM>';
	}
	if ($_GET['mod'] == 'fiche') { // AFFICHER un contact -----------------------------
		// Etablissement
		echo '<div id="texte_titre"><img src="images/ico_etbl.png" border="0"> Etablissement</div>';
		echo '<div id="texte_texte">';
		if (!empty($tabEtbl[1])) { echo '<div><a href="entreprise.php?session='.$session.'&mod=fiche&id='.$tabEtbl[0].'" target="_self" title="Voir la fiche de cet établissement"><b>'.$tabEtbl[1].'</b></a></div>'; } // nom
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
