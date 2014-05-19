<?PHP
/*	--------------------------------------------------------------------------------------------------------------
		Auteur 	: Guillaume ROUAN						Titre	: accueil.php
		Contact	: g.rouan.free.fr						Date 	: 26/12/04
		Pour	: Kandida							Version	: 2
	--------------------------------------------------------------------------------------------------------------
		(c) Droits de reproduction et d'utilisation soumis à autorisation. Merci de me contacter.
	--------------------------------------------------------------------------------------------------------------	*/

	// Includes
	include_once	('include/fonctions/connexion.func.php');
	include_once	('include/fonctions/deconnexion.func.php');
	include_once	('include/fonctions/divers.func.php');
	
	// connexion
	connexion();
	
	// Session
	@session_start();
	$session 	= 	session_id();
	$login		= 	$_SESSION['login'];


?>
<!----------------------------------------------------------------------------------------------------------------
		Auteur 	: Guillaume ROUAN						Titre	: accueil.php
		Contact	: g.rouan.free.fr						Date 	: 26/12/04
		Pour	: Kandida							Version	: 2
	--------------------------------------------------------------------------------------------------------------
		(c) Droits de reproduction et d'utilisation soumis à autorisation. Merci de me contacter.
	---------------------------------------------------------------------------------------------------------------->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>

<head>

	<title>Kandida : gestion professionnelle</title>

	<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="fr">
	<meta name="Robots" content="noindex, nofollow">
	<meta name="author" content="GUR">

	<script language="JavaScript" type="text/JavaScript" src="js/page.js"></script>
	<LINK href="css/kandida.css" rel="stylesheet" type="text/css">
<?PHP
	// Redirection vers Candidature
	 echo '<meta http-equiv="refresh" content="0; URL=candidature.php?session='.$session.'&mod=liste">';
?>
</head>

<body leftmargin="0" topmargin="0" lang="fr">

<div id="conteneur">

	<div id="contenu_logo_accueil">
		<div id="contenu_logo_gauche_accueil">
			<div id="contenu_logo_gauche_01">&nbsp;</div>
			<div id="contenu_logo_gauche_02">&nbsp;</div>
			<div id="contenu_logo_gauche_03">&nbsp;</div>
		</div>
		<div id="contenu_logo_img_accueil">
			<a href="/kandida/" target="_self"><div id="contenu_logo_img_logo_quit">&raquo; Déconnexion</div></a>
			<a href="accueil.php?session=<?PHP echo $_GET['session']; ?>" target="_self"><div id="contenu_logo_img_logo_accueil">&nbsp;</div></a>
		</div>
	</div> <!-- FIN contenu_logo -->

	<div id="contenu_menu">
		<div id="contenu_menu_gauche">
			<div id="contenu_menu_gauche_01">&nbsp;</div>
			<div id="contenu_menu_gauche_02">&nbsp;</div>
			<div id="contenu_menu_gauche_03">&nbsp;</div>
		</div>
		<div id="contenu_menu_liste">
			<?PHP
				//afficheListeMenu ();
			?>
		</div>
	</div> <!-- FIN contenu_menu -->

	<table class="contenu_page" width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign="top" class="contenu_page_texte_droit_01" height="100%"><div id="contenu_page_texte_droit_01_colonne">&nbsp;</div></td>
		<td valign="top" class="contenu_page_texte_droit_02" height="100%"><div id="contenu_page_texte_droit_02_colonne">&nbsp;</div></td>
		<td valign="top" class="contenu_page_texte_droit_03" height="100%">
			<div id="contenu_page_texte_droit_03_colonne">
<!-- /// PAGE CENTRALE ///////////////////////////////////////////////////////////////////////////////////////////-->
<?PHP
	//echo '<div><a href="admin.php?session='.$session.'" target="_self">&raquo; Administration</a></div>';
?>
<!-- /// FIN PAGE CENTRALE ///////////////////////////////////////////////////////////////////////////////////////-->
			</div>
		</td>
		<td valign="top" class="contenu_page_texte_droit_04" height="100%"><div id="contenu_page_texte_droit_04_colonne">&nbsp;</div></td>
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
</html>
<?PHP deconnexion(); ?>
