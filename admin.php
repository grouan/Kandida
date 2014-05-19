<?PHP


	// Includes
	include_once	('include/fonctions/connexion.func.php');
	include_once	('include/fonctions/deconnexion.func.php');
	include_once	('include/fonctions/divers.func.php');
	
	// connexion
	connexion();
	
	// mod
	$mod = $_GET['mod'];
	
	// Session
	@session_start();
	$session 		= 	session_id();
	$login		= 	$_SESSION['login'];

	
	// suppr
	// if (isset($_GET['suppr'])) { $valid = $_GET['suppr']; }
	// valid
	// if (isset($_GET['valid'])) { $valid = $_GET['valid']; }

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>

<head>

	<title>Kandida : gestion de candidatures en ligne</title>

	<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="fr">
	<meta name="Robots" content="noindex, nofollow">
	<meta name="author" content="Guillaume ROUAN">

	<script language="JavaScript" type="text/JavaScript" src="js/page.js"></script>
	<LINK href="css/kandida.css" rel="stylesheet" type="text/css">

</head>

<body leftmargin="0" topmargin="0" lang="fr">
<center>
  <table class="conteneur" width="700" height="100%" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0">
    <tr> 
      <td height="50" width="700"><?PHP echo "<a href=\"accueil.php?session=".$_GET['session']."\" target=\"_self\">"; ?>
	  	<IMG src="images/logo.jpg" border="0" alt="Accueil"></a></td>
    </tr>
	<tr> 
    	<td height="100%" class="cadrePage" valign="top">
			<table cellpadding="0" cellspacing="0" width="100%">
	  			<?PHP
					if ($_GET['session'] == $session) {
						// En-tête
						afficheEnTete();
					}
					else {
						afficheEnTeteErreur();
					}
				?>
			</table>
			<table cellpadding="0" cellspacing="0" width="100%">
				<?PHP
					// espace
					echo	"<tr><td height=\"10\">&nbsp;</td></tr>";
				?>
			</table>
			<table cellpadding="0" cellspacing="0" width="100%">
				<?PHP
					if ($_GET['session'] == $session) {
						// TITRE --------------------------------------------------------------------------------------
						echo	"<tr>";
						echo		"<td width=\"3\">&nbsp;</td>";
						echo		"<td>";
						echo			"<IMG src=\"images/titre_admin.jpg\" border=\"0\">";
						echo		"</td>";
						echo		"<td width=\"2\">&nbsp;</td>";
						echo	"</tr>";					
						
						// SAISIE / VERIF --------------------------------------------------------------------------------
						echo	"<tr>";
						echo		"<td width=\"3\">&nbsp;</td>";
						echo		"<td class=\"cadreModuleBot\" valign=\"middle\" align=\"left\" bgcolor=\"green\">";
						if ($mod == 'mdpchange') {
							if (!isset($verif)) {
								echo	"<tr>";
								echo		"<td>&nbsp;</td>";
								echo		"<td class=\"cadreModuleTop\" width=\"100%\" valign=\"middle\" align=\"center\">";
								echo			"<FORM method=\"POST\" name=\"mdpchange\" action=\"admin.php?session=".$_GET['session']."&mod=mdpchange&verif=1\">";
								echo			"<TABLE cellspacing=\"0\" cellpading=\"0\">";
								echo				"<TR>";
								echo					"<TD rowspan=\"5\" width=\"150\"><IMG src=\"images/img_cont.jpg\" border=\"0\"></TD>";
								echo					"<TD align=\"left\" class=\"texteGris\">Nom :<br><INPUT class=\"textemdp\" type=\"text\" size=\"10\" name=\"login\" value=\"".$_SESSION['login']."\"disabled></TD>";
								echo				"</TR>";
								echo				"<TR>";
								echo					"<TD align=\"left\" class=\"texteGris\">Ancien mot de passe :<br><INPUT class=\"textemdp\" type=\"password\" size=\"10\" name=\"oldpass\"></TD>";
								echo				"</TR>";
								echo				"<TR>";
								echo					"<TD align=\"left\" class=\"texteGris\">Nouveau mot de passe :<br><INPUT class=\"textemdp\" type=\"password\" size=\"10\" name=\"newpass\"></TD>";
								echo				"</TR>";
								echo				"<TR>";
								echo					"<TD align=\"left\" class=\"texteGris\">Confirmez le nouveau mot de passe :<br><INPUT class=\"textemdp\" type=\"password\" size=\"10\" name=\"newpass2\"></TD>";
								echo				"</TR>";
								echo				"<TR>";
								echo					"<TD align=\"left\"><INPUT class=\"bouton\" type=\"submit\" name=\"submit\" value=\"Changer le mot de passe\"></TD>";
								echo				"</TR>";					
								echo			"</TABLE>";
								echo			"</FORM>";
								echo		"</td>";
								echo		"<td>&nbsp;</td>";
								echo	"</tr>";
							}
							else {
								$cp = changePass ($login,$_POST['oldpass'],$_POST['newpass'],$_POST['newpass2']);
								if ($cp == 0) { // Erreur
									echo	"Une erreur est survenue lors du changement de mot de passe !<br>Pour réessayer, retournez à l'accueil.<br>";
								}
								if ($cp == 1) { // OK
									echo	"Votre nouveau mot de passe est bien pris en compte.<br>";
								}
								if ($cp == 2) { // Les 2 pass ne sont pas identiques
									echo	"Vous avez saisi 2 nouveaux mots de passe différents !<br>Pour réessayer, retournez à l'accueil.<br>";
								}
							}
						}
						echo	"<br><A href=\"accueil.php?session=".$_GET['session']."\" target=\"_self\"><IMG src=\"images/bouton_accueil.jpg\" border=\"0\"></A>";
						echo		"</td>";
						echo	"</tr>";
					}
				?>
			</table>
			<table cellpadding="0" cellspacing="0" width="100%" height="100%">
				<tr>
					<td height="100%">&nbsp;</td>
				</tr>
			</table>
	  	</td>
    </tr>
	<tr> 
      <?PHP affichePiedPage(); ?>
    </tr>
  </table>
</center>
</body>
</html>
<?PHP deconnexion(); ?>
