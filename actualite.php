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
	$couleur = couleur ('Actualites');
	// RSS-Atom Universel
	include_once ('include/rss-atom/universal-reader.php');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" dir="ltr" lang="fr">

<head>

	<title>Kandida : actualités</title>

	<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="fr">
	<meta name="Robots" content="noindex, nofollow">
	<meta name="author" content="Guillaume ROUAN">

	<script language="JavaScript" type="text/JavaScript" src="js/page.js"></script>
	<LINK href="css/kandida.css" rel="stylesheet" type="text/css">
<?PHP
	echo'<script type="text/css">A.candidature_titre:hover,A.candidature_etbl:hover{color:'.$couleur.';}</script>';

	// lecteur RSS
	include_once ("include/rsslib/rsslib.php");
	//include_once ("css/rss-style.css");
?>

	<script language="JavaScript">
		var sizelist = [ 5, 10, 15, 20, 25, -1];
		function setSize()
		{
			var options = [ "5", "10", "15", "20", "25", "-1" ];

			var selected = document.rss.idx.selectedIndex;
			var value = options[selected];
			document.rss.size.value = value;
	
		}
	</script>

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

	if ($_GET['mod'] == 'liste') { // Liste des actualités ------------------------------

		echo '<div id="page_titre" style="color:'.$couleur.';">Liste des actualités</div>';

		echo '<div id="enCours">'; /* En cours */
			// Calcul liste des flux
			echo '<FORM name="rss" method="POST" action="actualite.php?session='.$session.'&mod=fiche">';
				$tabListeRss = listeRss ('titre'); // $tab[$i][0=idrss/1=type/2=idtype/3=flux/4=titre/5=notes]
				echo '<SELECT name="flux">';
				for ($r=0;$r<count($tabListeRss);$r++) {
					echo '<OPTION value="'.$tabListeRss[$r][3].'">'.$tabListeRss[$r][4].'</OPTION>';
				}
				echo '</SELECT>';
				echo '<INPUT type="submit" value="&raquo; Voir les actualités de ce flux">';
			echo '</FORM>';
		echo '</div>';
		echo '<div id="passe">'; /* Passées */
		echo '</div>';

	}
	if ($_GET['mod'] == 'fiche') { // AFFICHER un concours -----------------------------

// Flux
$flux = $_POST['flux'];

	echo '<div id="page_titre" style="color:'.$couleur.';">'.$flux.'</span></div>';

		echo '<div id="enCours">'; /* En cours */


// Lecteur RSS --------------------------------------------------------------------------------------------------------------- RSS
?>

<h1>Universal Reader - D&eacute;monstration pour afficher un flux en tout format</h1>
<p>Cette d&eacute;monstration utilise la librairie universal-reader.php pour afficher 
  un flux Atom ou RSS dans toutes versions.<br>
</p>
<?PHP echo '<FORM name="rss" method="POST" action="actualite.php?session='.$session.'&mod=fiche">'; ?>
<fieldset>
  <p>Donnez l'URL d'un fichier Atom, RSS 2.0 ou 1.0: 
<!--    <input type="text" name="dyn" size="48" value="http://www.xul.fr/rss-fr.xml">	-->

<!-- -->
<?PHP
			// Calcul liste des flux
			//echo '<FORM name="rss" method="POST" action="actualite.php?session='.$session.'&mod=fiche">';
				$tabListeRss = listeRss ('titre'); // $tab[$i][0=idrss/1=type/2=idtype/3=flux/4=titre/5=notes]
				echo '<SELECT name="dyn">';
				for ($r=0;$r<count($tabListeRss);$r++) {
					echo '<OPTION value="'.$tabListeRss[$r][3].'">'.$tabListeRss[$r][4].'</OPTION>';
				}
				echo '</SELECT>';
				//echo '<INPUT type="submit" value="&raquo; Voir les actualités de ce flux">';
			//echo '</FORM>';
?>
<!-- -->
  </p>
  <span> Options d'affichage &nbsp;&nbsp;Max </span> 
  <select name="idx" size="1" onChange="setSize();">
	<option>5</option>
     <option selected>10</option>
     <option>15</option>
     <option>20</option>
     <option>25</option>
     <option>All</option>
    </select>
    <input type="text" name="size" size="1" maxlength="3" value="10">
    <span class="label">Canal</span> 
    
  <input type="checkbox" name="channel" value="true" checked>
    <span class="label">Descriptions</span> 
    <input type="checkbox" name="desc" value="true" checked>
    <span class="label">Dates</span>
    
  <input type="checkbox" name="date" value="true">

<p>
	
    <INPUT type="submit" value="Afficher le flux">
</p>
</fieldset>

</FORM><p>(c) 2007 <a href="http://www.xul.fr" target="_parent" >Xul.fr</a> 
  - Licence Mozilla 1.1.</p>

<?PHP
// FIN Lecteur Rss ----------------------------------------------------------------------------------------------------------- RSS
		echo '</div>';
		echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
	}
	if ($_GET['mod'] == 'ajout') { // AJOUTER un flux -----------------------------

		echo '<div id="page_titre" style="color:'.$couleur.';">Ajout de concours</div>';
		echo '<div id="enCours">'; /* En cours */		
		echo '</div>';
		echo '<div id="passe">'; /* Archives */
			// Retour
			echo '<a href="javascript:history.go(-1)" target="_self" title="Retour"><div id="retour" style="margin-top:10px;"><img src="images/ico_retour.png" border="0"> Retour à la page précédente</div></a>';
		echo '</div>';
	}
	if ($_GET['mod'] == 'modif') { // MODIFIER un flux -----------------------------

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
	if ($_GET['mod'] == 'suppr') { // SUPPRIMER un flux -----------------------------

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

	if ($_GET['mod'] == 'liste') { // LISTER les actualites ------------------------------
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
	if ($_GET['mod'] == 'fiche') { // AFFICHER un flux -----------------------------
		// Etablissement
		echo '<div id="texte_titre"><img src="images/ico_etbl.png" border="0"> Etablissement organisateur</div>';
		echo '<div id="texte_texte">';
Atom_Links ($_POST['flux']);
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
