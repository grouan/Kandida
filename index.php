<?PHP
/*	--------------------------------------------------------------------------------------------------------------
		Auteur 	: Guillaume ROUAN						Titre	: index.php
		Contact	: @grouan							Date 	: 26/12/04
		Pour		: Kandida							Version: 2
	--------------------------------------------------------------------------------------------------------------
		Licence : Attribution 4.0 International (CC BY 4.0) http://creativecommons.org/licenses/by/4.0/
	--------------------------------------------------------------------------------------------------------------	*/

	// Includes
	// include_once	('include/fonctions.inc.php');
	include_once	('include/fonctions/divers.func.php');
	
	// Session
	@session_set_cookie_params(3600); // 3600sec. = 1h
	@session_destroy();
	unset($_SESSION['login']);
	unset($_SESSION['date']);
	unset($_SESSION['heure']);
	
	// Pour la vérification
	if (isset($_GET['verif'])) {
		// Includes
		include_once	('include/fonctions/connexion.func.php');
		include_once	('include/fonctions/deconnexion.func.php');	
		$verif = $_GET['verif'];
		// Paramétrages
		@connexion();
		// Paramétrage login/pass
		$login = $_POST['login']; $pass = $_POST['pass']; 
		// Vérification de l'accès
		$verifPass = verifPass ($login,$pass);
	}
	// verif
	//if (isset($_GET['verif'])) { $verif = $_GET['verif']; }

	if ($verifPass == 1) {
		// Session
			@session_set_cookie_params(3600); // 3600sec. = 1h
			@session_start ();
			$session = session_id ();
			$_SESSION['login'] 	= $login;
			$_SESSION['date'] 	= date('d/m/Y');
			$_SESSION['heure'] 	= date('H:i');
		// Redirection de la page
			$url = "accueil.php?session=".$session;
			header ("Location: $url");
	}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>

<head>

	<title>Kandida : gestion professionnelle</title>

	<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="fr">
	<meta name="Robots" content="noindex, nofollow">
	<meta name="author" content="Guillaume ROUAN">

	<script language="JavaScript" type="text/JavaScript" src="js/page.js"></script>
	<LINK href="css/kandida.css" rel="stylesheet" type="text/css">

</head>

<body leftmargin="0" topmargin="0" lang="fr">

<div id="conteneur">

	<div id="contenu_logo">
		<div id="contenu_logo_gauche">
			<div id="contenu_logo_gauche_01">&nbsp;</div>
			<div id="contenu_logo_gauche_02">&nbsp;</div>
			<div id="contenu_logo_gauche_03">&nbsp;</div>
		</div>
		<div id="contenu_logo_img">
			<div id="contenu_logo_img_logo">&nbsp;</div>
		</div>
	</div> <!-- FIN contenu_logo -->

	<div id="contenu_menu">
		<div id="contenu_menu_gauche">
			<div id="contenu_menu_gauche_01">&nbsp;</div>
			<div id="contenu_menu_gauche_02">&nbsp;</div>
		</div>
		<div id="contenu_menu_liste">	<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
			<table cellpadding="0" cellspacing="0">
				<?PHP
					if (!isset($_GET['verif'])) {			// formulaire de connexion
					echo	"<tr>";
					echo		"<td width=\"40%\">&nbsp;</td>";
					echo		"<td class=\"cadreModuleTop\" valign=\"middle\" align=\"center\">";
					echo			"<FORM method=\"POST\" name=\"connexion\" action=\"index.php?verif=1\">";
					echo			"<TABLE cellspacing=\"0\" cellpading=\"0\">";
					echo				"<TR>";
					echo					"<TD rowspan=\"3\" width=\"50px\"><IMG src=\"images/cadenas.png\" border=\"0\"></TD>";
					echo					"<TD align=\"left\" class=\"texteGris\">Nom :<br><INPUT class=\"textemdp\" type=\"text\" size=\"10\" name=\"login\"></TD>";
					echo				"</TR>";
					echo				"<TR>";
					echo					"<TD align=\"left\" class=\"texteGris\">Mot de passe :<br><INPUT class=\"textemdp\" type=\"password\" size=\"10\" name=\"pass\"></TD>";
					echo				"</TR>";
					echo				"<TR>";
					echo					"<TD colspan=\"2\" align=\"center\"><INPUT class=\"bouton\" type=\"submit\" name=\"submit\" value=\"Se connecter\"></TD>";
					echo				"</TR>";					
					echo			"</TABLE>";
					echo			"</FORM>";
					echo		"</td>";
					echo		"<td width=\"40%\">&nbsp;</td>";
															
					// --------------------------
					// infos techniques
					// --------------------------
					
					/*echo	"</tr>";
					echo	"<tr>";
					echo		"<td colspan=\"7\" height=\"20\">&nbsp;</td>";
					echo	"</tr>";
					echo	"<tr>";
					echo		"<td width=\"3\">&nbsp;</td>";
					echo		"<td colspan=\"5\"  class=\"borderCadre\" valign=\"middle\" align=\"left\" height=\"100%\">";
					echo			"<SPAN class=\"texteGris\">";
					echo			"Pour compléter la base de donnée, tu dois respecter l'ordre de saisie suivant :<br><br><ul><li>Ajouter une nouvelle entreprise,</li><li>Ajouter un nouveau contact,</li><li>Ajouter un nouvel événement.</li></ul>";
					echo			"</SPAN>";
					echo		"</td>";
					//echo		"<td width=\"3\">&nbsp;</td>";
					*/
					
					// espace
					//echo	"<tr><td height=\"50%\">&nbsp;</td></tr>";
					}
					else {			// VERIFICATION DU FORMULAIRE
						echo	"<tr>";
						echo		"<td width=\"40%\">&nbsp;</td>";
						echo		"<td class=\"cadreModuleTop\" valign=\"middle\" align=\"center\">";						
						// champs vides
						if (empty($login) || empty($pass)) {
							echo	"<FONT color=\"red\">Veuillez compléter tous les champs...</FONT><br><br>";
							echo	"<A href=\"javascript:history.go(-1)\" target=\"_self\"><INPUT type=\"submit\" class=\"bouton\" value=\"&laquo; Retour\"</A>";
						}
						// vérification dans la bdd
						else {
							if ($verifPass == 1) { // OUI
								/*echo	"<SPAN class=\"titreTab\">Bienvenue <b>$login</b> !</SPAN><br><br>";
								echo	"<A href=\"accueil.php\" target=\"_self\">[ Clique ici pour accéder au site ]</A>";
							*/}
							else { // NON
								echo	"<FONT color=\"red\">Vous n'êtes pas autorisé(e) à accéder à ce site</FONT><br><br>";
								echo	"<A href=\"javascript:history.go(-1)\" target=\"_self\"><INPUT type=\"submit\" class=\"bouton\" value=\"&laquo; Retour\"</A>";
							}
						}
						
						echo		"</td>";
						echo		"<td width=\"40%\">&nbsp;</td>";
					}
				?>
			</table>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		</div>
	</div> <!-- FIN contenu_menu -->

	<div id="contenu_pied">
		<div id="contenu_pied_gauche">&nbsp;</div>
		<div id="contenu_pied_droit">
			<div id="contenu_pied_droit_carre">&nbsp;</div>
			<div id="contenu_pied_droit_texte">{ Kandida | <?PHP echo date('Y'); ?> | version 2 }</div>
			<div id="contenu_pied_droit_img">&nbsp;</div>
		</div>
	</div> <!-- FIN contenu_pied -->

</div> <!-- FIN conteneur-->

</body>
</html>
<?PHP if (isset($_GET['verif'])) { deconnexion(); } ?>
