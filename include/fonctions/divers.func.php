<?PHP

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// GENERAL /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Date du jour au format littéral ------------------------------------------------------------------------------------------
	function setDate () {
		$tab 	= explode ("/",date("d/m/Y"));	// $tab[0] = dd / $tab[1] = mm / $tab[2] = YYYY		
		// Paramétrage de la date
		$jour	= $tab[0];
		$annee	= $tab[2];
		if ($tab[1] == "01")	$mois = "janvier";
		if ($tab[1] == "02")	$mois = "février";
		if ($tab[1] == "03")	$mois = "mars";
		if ($tab[1] == "04")	$mois = "avril";
		if ($tab[1] == "05")	$mois = "mai";
		if ($tab[1] == "06")	$mois = "juin";
		if ($tab[1] == "07")	$mois = "juillet";
		if ($tab[1] == "08")	$mois = "août";
		if ($tab[1] == "09")	$mois = "septembre";
		if ($tab[1] == "10")	$mois = "octobre";
		if ($tab[1] == "11")	$mois = "novembre";
		if ($tab[1] == "12")	$mois = "décembre";
		// Affichage
		$date = "$jour $mois $annee";
		return $date;
	}

// Date X au format littéral ------------------------------------------------------------------------------------------
	function changeFormatDate ($date) { // $date = YYYY-mm-dd
		$tab 	= explode ("-",$date);	// $tab[0] = YYYY / $tab[1] = mm / $tab[2] = dd		
		// Paramétrage de la date
		$jour	= $tab[2];
		$annee	= $tab[0];
		if ($tab[1] == "01")	$mois = "janvier";
		if ($tab[1] == "02")	$mois = "février";
		if ($tab[1] == "03")	$mois = "mars";
		if ($tab[1] == "04")	$mois = "avril";
		if ($tab[1] == "05")	$mois = "mai";
		if ($tab[1] == "06")	$mois = "juin";
		if ($tab[1] == "07")	$mois = "juillet";
		if ($tab[1] == "08")	$mois = "août";
		if ($tab[1] == "09")	$mois = "septembre";
		if ($tab[1] == "10")	$mois = "octobre";
		if ($tab[1] == "11")	$mois = "novembre";
		if ($tab[1] == "12")	$mois = "décembre";
		// Affichage
		$date = "$jour $mois $annee";
		return $date;
	}
// Date X au MINI format littéral ------------------------------------------------------------------------------------------
	function changeFormatDateMini ($date) { // $date = YYYY-mm-dd
		$tab 	= explode ("-",$date);	// $tab[0] = YYYY / $tab[1] = mm / $tab[2] = dd		
		// Paramétrage de la date
		$jour	= $tab[2];
		$annee	= $tab[0];
		if ($tab[1] == "01")	$mois = "jan";
		if ($tab[1] == "02")	$mois = "fév";
		if ($tab[1] == "03")	$mois = "mar";
		if ($tab[1] == "04")	$mois = "avr";
		if ($tab[1] == "05")	$mois = "mai";
		if ($tab[1] == "06")	$mois = "juin";
		if ($tab[1] == "07")	$mois = "juil";
		if ($tab[1] == "08")	$mois = "août";
		if ($tab[1] == "09")	$mois = "sept";
		if ($tab[1] == "10")	$mois = "oct";
		if ($tab[1] == "11")	$mois = "nov";
		if ($tab[1] == "12")	$mois = "déc";
		// Affichage
		$date = "$jour $mois $annee";
		return $date;
	}

// Heure actuelle --------------------------------------------------------------------------------------------------------------
	function setHeure () {
		//print	(date("H:i"));
		$a	=	date("H");
		$b	=	"h";
		$c	=	date("i");
		$heure = $a.$b.$c;
		return $heure;
	}
			// menu déroulant des images
			function img() {
			$req = "SELECT idImage,src,alt FROM image ORDER BY alt DESC";
			$res = mysql_query($req);
			if (mysql_num_rows($res) == 0) {
				echo	"<TD>";
				echo	"<SELECT name=\"idImage\" id=\"idImage\">";
				echo	"<OPTION value=\"\">Aucune image n'est disponible</OPTION>";
				echo	"</SELECT>";
				echo	"</TD>";
			}
			else {
				echo	"<TD>";
				echo	"<SELECT name=\"idImage\" id=\"idImage\">";
				while ($blabla = mysql_fetch_object($res)) {
					if (empty($blabla->alt)) 	{ $alt = $blabla->src; }
					else						{ $alt = $blabla->alt; }
					echo	"<OPTION value=\"".$blabla->idImage."\">".$alt."</OPTION>";
				}
				echo	"</SELECT>";
				echo	"</TD>";
			}
		}
		
// Envoi de mail ---------------------------------------------------------------------------------------------------------------
	function envoiMail ($subject,$message,$from,$mail,$date) {
	
		// envoi du mail
		$mail = mail("xxx@xxx.xxx", $subject, $message, // remplacer par votre adresse de courriel
		 "De : ".$from." (".$mail.")\r\n"
		."Date : ".$date."\r\n"
		."Mailer : PHP/" . phpversion());
	
		// réponse et affichage
		if ($mail) {
			echo	"<h1>Merci de votre envoi</h1>";
			echo	"<hr>";
			echo	"Votre message a bien été envoyé.<br>";
			echo	"<b>De :</b> ".$from." (".$mail.")<br>";
			echo	"<b>Date :</b> ".$date."<br>";
			echo	"<hr>";
			echo	"Je vous répondrai dans les meilleurs délais.<br><br><br><A href=\"../index.php\" target=\"_self\">retour au site</A>";
		}
		else { echo	"Une ERREUR s'est produite lors de l'envoi de votre message.<br><br>Essayez directement avec votre messagerie habituelle à l'adresse suivante : <A href=\"mailto:xxx@xxx.xxx?subject=kandida\" target=\"_blank\">xxx@xxx.xxx</A>"; }
	}

	function afficheEnTete () {
		echo	"<tr>";
		echo		"<td height=\"10\" width=\"30%\" class=\"enTete\" align=\"center\" valign=\"middle\">";
		@setlocale("LC_TIME", "fr_FR");
		echo strftime("%A %d %B %Y - %Hh%M");
		echo		"</td>";
		echo		"<td height=\"10\" width=\"30%\" class=\"enTete\" align=\"center\" valign=\"middle\">";
		echo			"<IMG src=\"images/menu_vide.jpg\" border=\"0\">";
		echo			"<a href=\"liste.php?session=".$_GET['session']."&mod=entreprises\" target=\"_self\" title=\"Voir la liste des entreprises\"><IMG src=\"images/menu_ent.jpg\" border=\"0\"></a>";
		echo			"<IMG src=\"images/menu_vide.jpg\" border=\"0\">";
		echo			"<a href=\"liste.php?session=".$_GET['session']."&mod=contacts\" target=\"_self\" title=\"Voir la liste des contacts\"><IMG src=\"images/menu_cont.jpg\" border=\"0\"></a>";
		echo			"<IMG src=\"images/menu_vide.jpg\" border=\"0\">";
		echo			"<a href=\"liste.php?session=".$_GET['session']."&mod=agenda\" target=\"_self\" title=\"Voir la liste des événements\"><IMG src=\"images/menu_agen.jpg\" border=\"0\"></a>";
		echo			"<IMG src=\"images/menu_vide.jpg\" border=\"0\">";
		echo			"<a href=\"index.php\" target=\"_self\" title=\"Quitter kandida\"><IMG src=\"images/menu_quitter.jpg\" border=\"0\"></a>";
		echo			"<IMG src=\"images/menu_vide.jpg\" border=\"0\">";
		echo		"</td>";
		echo	"</tr>";
	}

	function afficheEnTeteErreur () {
		echo	"<tr>";
		echo		"<td height=\"10\" width=\"30%\" class=\"enTete\" align=\"center\" valign=\"middle\">";
		$date	= setDate();
		$heure	= setHeure();
		echo			"$date &middot; $heure";
		echo		"</td>";
		echo		"<td height=\"10\" width=\"30%\" class=\"enTete\" align=\"center\" valign=\"middle\">";
		echo			"<IMG src=\"images/menu_vide.jpg\" border=\"0\">";
		echo			"<a href=\"index.php\" target=\"_self\" title=\"Quitter kandida\"><IMG src=\"images/menu_quitter.jpg\" border=\"0\"></a>";
		echo			"<IMG src=\"images/menu_vide.jpg\" border=\"0\">";
		echo		"</td>";
		echo	"</tr>";
	}
	
	function affichePiedPage () {
		echo	"<td height=\"10\" class=\"piedPage\" align=\"right\">";
		echo		"&copy; Guillaume ROUAN | kandida v.2 | PHP-MySQL-Apache";
		echo	"</td>";
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// PASS ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function verifPass ($login,$pass) {
		$req = "SELECT login,pass FROM kandida_cactus WHERE login='$login' AND pass='".md5($pass)."'";
		$res = mysql_query($req);
		$nb = mysql_num_rows($res);
		if ($nb == 1) 	{ return 1; }
		else			{ return 0; }
	}
	function changePass ($login,$oldpass,$newpass,$newpass2) {
		if ($newpass != $newpass2) { return 2; }
		else {
			$req = "UPDATE kandida_cactus SET pass='".md5($newpass)."' WHERE login='$login' AND pass='".md5($oldpass)."' LIMIT 1";
			$res = mysql_query($req);
			//$nb = mysql_num_rows($res);
			if ($res) 	{ return 1; }
			else			{ return 0; }
		}
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ETABLISSEMENTS //////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function entreprise ($identreprise) { // > $tab des références d'une entreprise
	$req = "SELECT identreprise,nom,secteur,adr1,adr2,cp,ville,tel1,tel2,fax1,fax2,email,web,notes FROM kandida_entreprise WHERE identreprise='$identreprise' LIMIT 1";
	$res = mysql_query($req);
	while ($bub = mysql_fetch_object($res)) {
		$tab[0]		= $bub->identreprise;
		$tab[1] 	= $bub->nom;
		$tab[2] 	= $bub->secteur;
		$tab[3] 	= $bub->adr1;
		$tab[4] 	= $bub->adr2;
		$tab[5] 	= $bub->cp;
		$tab[6] 	= $bub->ville;
		$tab[7] 	= $bub->tel1;
		$tab[8] 	= $bub->tel2;
		$tab[9] 	= $bub->fax1;
		$tab[10]	= $bub->fax2;
		$tab[11]	= $bub->email;
		$tab[12]	= $bub->web;
		$tab[13]	= $bub->notes;
		return $tab; // $tab[0=identreprise/1=nom/2=secteur/3=adr1/4=adr2/5=cp/6=ville/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes]
	}
}
	function entreprises_contacts ($orderby) { // > $tab des entreprises + leurs contacts
		// $orderby : identreprise / nom...
		$req = "SELECT identreprise,nom,secteur,adr1,adr2,cp,ville,tel1,tel2,fax1,fax2,email,web,notes FROM kandida_entreprise ORDER BY $orderby";
		$res = mysql_query($req);
		$i=0;
		while ($bub = mysql_fetch_object($res)) {
			// ID établissement
			$tab[$i][0] = $bub->identreprise;
			// Nom de l'établissement
			$tab[$i][1] = $bub->nom;
			// liste des contacts de cet établissement
			$tab[$i][2] = idContacts_etbl ($bub->identreprise,$orderby);
			$i++;
		}
		return $tab;
		// $tab[$i][0=identreprise/1=nom/2=tabContacts]
		// $tabContact[$j][0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
	}
	
	function entreprises ($orderby) { // > $tab des entreprises
		// $orderby : identreprise / nom...
		$req = "SELECT identreprise,nom,secteur,adr1,adr2,cp,ville,tel1,tel2,fax1,fax2,email,web,notes FROM kandida_entreprise ORDER BY $orderby";
		$res = mysql_query($req);
		$i=0;
		while ($bub = mysql_fetch_object($res)) {
			$tab[$i][0] = $bub->identreprise;
			$tab[$i][1] = $bub->nom;
			$tab[$i][2] = $bub->secteur;
			$tab[$i][3] = $bub->adr1;
			$tab[$i][4] = $bub->adr2;
			$tab[$i][5] = $bub->cp;
			$tab[$i][6] = $bub->ville;
			$tab[$i][7] = $bub->tel1;
			$tab[$i][8] = $bub->tel2;
			$tab[$i][9] = $bub->fax1;
			$tab[$i][10] = $bub->fax2;
			$tab[$i][11] = $bub->email;
			$tab[$i][12] = $bub->web;
			$tab[$i][13] = $bub->notes;
			$i++;
		}
		return $tab; // $tab[$i][0=identreprise/1=nom/2=secteur/3=adr1/4=adr2/5=cp/6=ville/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes]
	}
function insertEtbl ($nom,$secteur,$adr1,$adr2,$cp,$ville,$tel1,$tel2,$fax1,$fax2,$email,$web,$notes) {
	$req = "INSERT INTO kandida_entreprise (nom, secteur, adr1, adr2, cp, ville, tel1, tel2, fax1, fax2, email, web, notes) VALUES ('$nom', '$secteur', '$adr1', '$adr2', '$cp', '$ville', '$tel1', '$tel2', '$fax1', '$fax2', '$email', '$web', '$notes')";
	$res = mysql_query($req);
	if ($res==1) { return 1; } else { return 0; }
}
function modifEtbl ($identreprise,$nom,$secteur,$adr1,$adr2,$cp,$ville,$tel1,$tel2,$fax1,$fax2,$email,$web,$notes) {
	$req = "UPDATE kandida_entreprise SET nom='$nom', secteur='$secteur', adr1='$adr1', adr2='$adr2', cp='$cp', ville='$ville', tel1='$tel1', tel2='$tel2', fax1='$fax1', fax2='$fax2', email='$email', web='$web', notes='$notes' WHERE identreprise='$identreprise' LIMIT 1";
	$res = mysql_query($req);
	if ($res==1) { return 1; } else { return 0; }
}
function supprEtbl ($identreprise) {
	$req = "DELETE FROM kandida_entreprise WHERE identreprise='$identreprise' LIMIT 1";
// ATTENTION : supprimer récursivement tous les événements liés à cette entreprise !!
//echo '<br><br>'.$req.'<br><br>idconcours = ['.$idconcours.']<br><br>res = ['.$res.']<br><br>';
	$res = mysql_query($req);
	if ($res==1) { return 1; } else { return 0; }
}

///////////////////
	
	function afficheDerniereEntreprise ($tabEntreprises,$nbEntreprises) {
		echo	"<b>".$tabEntreprises[$nbEntreprises-1][1]."</b><br>"; // nom
		echo	"".$tabEntreprises[$nbEntreprises-1][2]." (".$tabEntreprises[$nbEntreprises-1][6].")<br>"; // secteur / ville
		echo	"<a href=\"liste.php?session=".$_GET['session']."&mod=entreprises&id=".$tabEntreprises[$nbEntreprises-1][0]."\" target=\"_self\" alt=\"voir la fiche complète\">&raquo; fiche complète</a>";
	}
	
	function listeContactsEntreprise ($identreprise) {
		$req = "SELECT idcontact,civ,nom,prenom,fonction,loc1,loc2,tel1,tel2,fax1,fax2,email,web,notes,identreprise FROM kandida_contact WHERE identreprise='$identreprise' ORDER BY nom";
		$res = mysql_query($req);
		$i = 0;
		while ($bub = mysql_fetch_object($res)) {
			$tab[$i][0] = $bub->idcontact;
			$tab[$i][1] = $bub->civ;
			$tab[$i][2] = $bub->nom;
			$tab[$i][3] = $bub->prenom;
			$tab[$i][4] = $bub->fonction;
			$tab[$i][5] = $bub->loc1;
			$tab[$i][6] = $bub->loc2;
			$tab[$i][7] = $bub->tel1;
			$tab[$i][8] = $bub->tel2;
			$tab[$i][9] = $bub->fax1;
			$tab[$i][10] = $bub->fax2;
			$tab[$i][11] = $bub->email;
			$tab[$i][12] = $bub->web;
			$tab[$i][13] = $bub->notes;
			$tab[$i][14] = $bub->identreprise;
			$i++;
		}
		return $tab; // $tab[$i][0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
	}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CONTACTS ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function contacts ($orderby) { // > $tab des contacts
		// $orderby : idcontact / nom...
		$req = "SELECT idcontact,civ,nom,prenom,fonction,loc1,loc2,tel1,tel2,fax1,fax2,email,web,notes,identreprise FROM kandida_contact ORDER BY $orderby";
		$res = mysql_query($req);
		$i=0;
		while ($bub = mysql_fetch_object($res)) {
			$tab[$i][0] = $bub->idcontact;
			$tab[$i][1] = $bub->civ;
			$tab[$i][2] = $bub->nom;
			$tab[$i][3] = $bub->prenom;
			$tab[$i][4] = $bub->fonction;
			$tab[$i][5] = $bub->loc1;
			$tab[$i][6] = $bub->loc2;
			$tab[$i][7] = $bub->tel1;
			$tab[$i][8] = $bub->tel2;
			$tab[$i][9] = $bub->fax1;
			$tab[$i][10] = $bub->fax2;
			$tab[$i][11] = $bub->email;
			$tab[$i][12] = $bub->web;
			$tab[$i][13] = $bub->notes;
			$tab[$i][14] = $bub->identreprise;
			$i++;
		}
		return $tab; // $tab[$i][0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
	}
	
	function idContacts_etbl ($idEntreprise,$orderby) { // > $tab des contacts d'un établissement
		// $orderby : idcontact / nom...
		$req2 = "SELECT idcontact,civ,nom,prenom,fonction,loc1,loc2,tel1,tel2,fax1,fax2,email,web,notes,identreprise FROM kandida_contact ORDER BY $orderby";
		$res2 = mysql_query($req2);
		for ($j=0;$bub = mysql_fetch_object($res2);$j++) { $tab[$j] = $bub->idcontact; }
		return $tab; // $tab[$j][0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
	}

	function afficheDernierContact ($tabContacts,$nbContacts) {
		echo	"<b>".$tabContacts[$nbContacts-1][1]." ".$tabContacts[$nbContacts-1][3]." ".$tabContacts[$nbContacts-1][2]."</b><br>"; // nom / prénom
		$tabEnt = entreprise($tabContacts[$nbContacts-1][14]);
		echo	"".$tabContacts[$nbContacts-1][4]." (".$tabEnt[1].")<br>"; // fonction / nom entreprise
		echo	"<a href=\"liste.php?session=".$_GET['session']."&mod=contacts&id=".$tabContacts[$nbContacts-1][0]."\" target=\"_self\" alt=\"voir la fiche complète\">&raquo; fiche complète</a>";
	}

	function afficheListeContacts ($orderby) {
		// $tab[0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
		echo	"<hr>";
		echo	"<TABLE width=\"95%\" cellpadding=\"0\" cellspacing=\"0\">";
		$req = "SELECT idcontact,civ,nom,prenom,fonction,loc1,loc2,tel1,tel2,fax1,fax2,email,web,notes,identreprise FROM kandida_contact ORDER BY $orderby";
		$res = mysql_query($req);
		$i=0;
		while ($bub = mysql_fetch_object($res)) {
			if (pair($i)) { $class = 'pair'; } else { $class = 'impair'; }
			echo	"<TR class=\"$class\" height=\"30\">";
			echo		"<TD width=\"230\" align=\"left\"><SPAN class=\"texteTab\"><A href=\"liste.php?session=".$_GET['session']."&mod=contacts&id=".$bub->idcontact."\" target=\"_self\" title=\"Voir la fiche descriptive\">".$bub->civ." <b>".strtoupper($bub->nom)."</b> ".$bub->prenom."</A></SPAN></TD>";
			$tabEnt = entreprise ($bub->identreprise);
			echo		"<TD width=\"230\" align=\"left\"><SPAN class=\"texteTab\"><A href=\"liste.php?session=".$_GET['session']."&mod=entreprises&id=".$bub->identreprise."\" target=\"_self\" title=\"Voir la fiche descriptive\">".$tabEnt[1]."</A></SPAN></TD>";
			echo		"<TD width=\"100\" align=\"left\"><SPAN class=\"texteTab\">".$bub->fonction."</SPAN></TD>";
			echo		"<TD align=\"center\"><SPAN class=\"texteTab\">";
				if ($bub->email != '') { echo	"<A href=\"mailto:".$bub->email."\" target=\"_blank\"><img src=\"images/ico_email.png\" border=\"0\" title=\"Envoyer un message\" alt=\"Envoyer un message\"></A></SPAN>"; }
				else { echo	"-"; }
			echo		"</TD>";
			echo		"<TD align=\"center\"><SPAN class=\"texteTab\">";
				if ($bub->web != '') { echo	"<A href=\"".$bub->web."\" target=\"_blank\"><img src=\"images/ico_web.png\" border=\"0\" title=\"Visiter le site web\" alt=\"Visiter le site web\"></A></SPAN>"; }
				else { echo	"-"; }
			echo		"</TD>";
			echo	"</TR>";
			$i++;
		}
		echo	"</TABLE>";
		echo	"<br><hr>";
		echo	"<FORM method=\"POST\" action=\"liste.php?session=".$_GET['session']."&mod=contacts\" target=\"_self\">";
		echo	"Trier par : ";
		echo		"<SELECT name=\"orderby\" class=\"texteTab\">";
		echo			"<OPTION name=\"nom\">nom</OPTION>";
		echo			"<OPTION name=\"identreprise\">identreprise</OPTION>";
		echo			"<OPTION name=\"fonction\">fonction</OPTION>";
		echo		"</SELECT>";
		echo	" <INPUT type=\"submit\" name=\"Submit\" class=\"bouton\" value=\"Trier\">";
		echo	"</FORM>";
	}
	
	function contact ($idcontact) { // > $tab des références d'un contact
		$req = "SELECT idcontact,civ,nom,prenom,fonction,loc1,loc2,tel1,tel2,fax1,fax2,email,web,notes,identreprise FROM kandida_contact WHERE idcontact='$idcontact' LIMIT 1";
		$res = mysql_query($req);
		while ($bub = mysql_fetch_object($res)) {
			$tab[0] = $bub->idcontact;
			$tab[1] = $bub->civ;
			$tab[2] = $bub->nom;
			$tab[3] = $bub->prenom;
			$tab[4] = $bub->fonction;
			$tab[5] = $bub->loc1;
			$tab[6] = $bub->loc2;
			$tab[7] = $bub->tel1;
			$tab[8] = $bub->tel2;
			$tab[9] = $bub->fax1;
			$tab[10] = $bub->fax2;
			$tab[11] = $bub->email;
			$tab[12] = $bub->web;
			$tab[13] = $bub->notes;
			$tab[14] = $bub->identreprise;
			return $tab; // $tab[0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
		}
	}
	
	function afficheFicheContact ($idcontact) {
				
		$tabCon = contact ($idcontact);
		// $tab[0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
		$tabEnt = entreprise ($tabCon[14]);
		// $tab[0=identreprise/1=nom/2=secteur/3=adr1/4=adr2/5=cp/6=ville/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes]
		
		// nom du contact
		echo	"<TABLE width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">";
		echo	"<TR height=\"30\">";
		echo		"<TD align=\"left\"><SPAN class=\"titreTab\"><DIV align=\"right\"><b>".$tabCon[1]." ".$tabCon[2]." ".$tabCon[3]."</b></DIV></SPAN></TD>";
		echo	"</TR>";
		echo	"</TABLE>";
		//echo	"<hr>";

		// références pro
		echo	"<SPAN class=\"titreRub\"><IMG src=\"images/img_ent_mini.jpg\" border=\"0\"> <b>COORDONNEES</b></SPAN><br>";
		echo	"<TABLE width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabRub\">";
		if ($tabEnt[1] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\" width=\"50%\"><SPAN class=\"texteTab\">Entreprise :</SPAN></TD>";
		echo		"<TD width=\"5%\" class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\"><A href=\"liste.php?session=".$_GET['session']."&mod=entreprises&id=".$tabCon[14]."\" target=\"_self\">".$tabEnt[1]."</A></SPAN></TD>";
		echo	"</TR>";
		}
		echo	"<TR height=\"20\" valign=\"top\"><TD>&nbsp;</TD><TD width=\"20\"class=\"impair\">&nbsp;</TD><TD class=\"impair\">&nbsp;</TD></TR>";
		if ($tabCon[4] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">Fonction :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\">".$tabCon[4]."</SPAN></TD>";
		echo	"</TR>";
		}
		if ($tabCon[5] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">Localisation :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\">".$tabCon[5]."</SPAN></TD>";
		echo	"</TR>";
		}
		if ($tabCon[6] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\" ><SPAN class=\"texteTab\">&nbsp;</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\">".$tabCon[6]."</SPAN></TD>";
		echo	"</TR>";
		}
		if ($tabCon[7] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">Téléphone :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\">".$tabCon[7]."</SPAN></TD>";
		echo	"</TR>";
		}
		if ($tabCon[8] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\" ><SPAN class=\"texteTab\">&nbsp;</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\">".$tabCon[8]."</SPAN></TD>";
		echo	"</TR>";
		}
		if ($tabCon[9] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">Fax :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\">".$tabCon[9]."</SPAN></TD>";
		echo	"</TR>";
		}
		if ($tabCon[10] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\" ><SPAN class=\"texteTab\">&nbsp;</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\">".$tabCon[10]."</SPAN></TD>";
		echo	"</TR>";
		}
		echo	"<TR height=\"20\" valign=\"top\"><TD>&nbsp;</TD><TD class=\"impair\">&nbsp;</TD><TD class=\"impair\">&nbsp;</TD></TR>";
		if ($tabCon[11] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">E-mail :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\"><A href=\"mailto:".$tabCon[11]."\" target=\"_blank\">".$tabCon[11]."</A></SPAN></TD>";
		echo	"</TR>";
		}
		if ($tabCon[12] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">Site web :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\"><A href=\"".$tabCon[12]."\" target=\"_blank\">".$tabCon[12]."</A></SPAN></TD>";
		echo	"</TR>";
		}
		echo	"<TR height=\"20\" valign=\"top\"><TD>&nbsp;</TD><TD class=\"impair\">&nbsp;</TD><TD class=\"impair\">&nbsp;</TD></TR>";
		if ($tabCon[13] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">Commentaires :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\"><i>".$tabCon[13]."</i></SPAN></TD>";
		echo	"</TR>";
		}
		echo	"</TABLE>";

		//echo	"<hr>";
		
		// agenda du contact
		$tabAg = evenementsCon ($idcontact);
		// $tab[$i][0=idagenda/1=identreprise/2=idcontact/3=dateEv/4=heure/5=evenement/6=notes]
		$nbAg = count($tabAg);
		if ($nbAg > 0) {
			echo	"<br><SPAN class=\"titreRub\"><IMG src=\"images/img_agen_mini.jpg\" border=\"0\"> <b>AGENDA</b></SPAN><br>";
			echo	"<TABLE width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabRub\">";
			for ($i=0 ; $i<$nbAg; $i++) {
				if (pair($i)) { $class = 'pair'; } else { $class = 'impair'; }
				if (verifDateEv($tabAg[$i][3])) 	{ $classTab = 'texteTab'; 	$verif = '1'; }
				else 							{ $classTab = 'texteGris'; 	$verif = '0'; }
				echo	"<TR class=\"$class\" height=\"30\">";
				$dateEv = changeFormatDate ($tabAg[$i][3]);
				echo		"<TD width=\"120\" align=\"left\"><SPAN class=\"$classTab\">".$dateEv."</SPAN></TD>";
				echo		"<TD width=\"50\" align=\"left\"><SPAN class=\"$classTab\">".$tabAg[$i][4]."</SPAN></TD>";
				$tabCon = contact ($tabAg[$i][2]);
				if ($verif == '0') {
					echo		"<TD align=\"left\"><A href=\"liste.php?session=".$_GET['session']."&mod=contacts&id=".$tabAg[$i][2]."\" target=\"_self\" title=\"Voir la fiche descriptive\"><SPAN class=\"$classTab\">".$tabCon[1]." ".$tabCon[2]." ".$tabCon[3]."</SPAN></A></TD>";
					echo		"<TD align=\"left\"><A href=\"liste.php?session=".$_GET['session']."&mod=agenda&id=".$tabAg[$i][0]."\" target=\"_self\"><SPAN class=\"$classTab\">".$tabAg[$i][5]."</SPAN></A>";
				}
				else {
					echo		"<TD align=\"left\"><SPAN class=\"$classTab\"><A href=\"liste.php?session=".$_GET['session']."&mod=contacts&id=".$tabAg[$i][2]."\" target=\"_self\" title=\"Voir la fiche descriptive\">".$tabCon[1]." ".$tabCon[2]." ".$tabCon[3]."</A></SPAN></TD>";
					echo		"<TD align=\"left\"><SPAN class=\"$classTab\"><A href=\"liste.php?session=".$_GET['session']."&mod=agenda&id=".$tabAg[$i][0]."\" target=\"_self\">".$tabAg[$i][5]."</A></SPAN>";
				}
				echo	"</TR>";
			}
			echo	"</TABLE>";
			//echo	"<hr>";
		}
		echo	"<br>";
		
		echo	"<A href=\"suppr.php?session=".$_GET['session']."&mod=contacts&id=$idcontact\" target=\"_self\">";
		echo		"<IMG src=\"images/bouton_supprimer.jpg\" border=\"0\">";
		echo	"</A> ";
		echo	"<A href=\"modif.php?session=".$_GET['session']."&mod=contacts&id=$idcontact\" target=\"_self\">";
		echo		"<IMG src=\"images/bouton_modifier.jpg\" border=\"0\">";
		echo	"</A> ";
		echo	"<A href=\"ajouter.php?session=".$_GET['session']."&mod=agenda&id=$idcontact\" target=\"_self\">";
		echo		"<IMG src=\"images/bouton_event.jpg\" border=\"0\">";
		echo	"</A> ";

	}
	
	function afficheHistoContact ($idcontact) {
	}
	
function insertContact ($identreprise,$civ,$nom,$prenom,$fonction,$loc1,$loc2,$tel1,$tel2,$fax1,$fax2,$email,$web,$notes) {
	$req = "INSERT INTO kandida_contact (identreprise,civ,nom,prenom,fonction,loc1,loc2,tel1,tel2,fax1,fax2,email,web,notes) VALUES ('$identreprise','$civ','$nom','$prenom','$fonction','$loc1','$loc2','$tel1','$tel2','$fax1','$fax2','$email','$web','$notes')";
	$res = mysql_query($req);
	if ($res==1) { return 1; } else { return 0; }
}
function modifContact ($idcontact,$identreprise,$civ,$nom,$prenom,$fonction,$loc1,$loc2,$tel1,$tel2,$fax1,$fax2,$email,$web,$notes) {
	$req = "UPDATE kandida_contact SET identreprise='$identreprise', civ='$civ', nom='$nom', prenom='$prenom', fonction='$fonction', loc1='$loc1', loc2='$loc2', tel1='$tel1', tel2='$tel2', fax1='$fax1', fax2='$fax2', email='$email', web='$web', notes='$notes' WHERE idcontact='$idcontact' LIMIT 1";
	$res = mysql_query($req);
	if ($res==1) { return 1; } else { return 0; }
}
function supprContact ($idContact) {
	$req = "DELETE FROM kandida_contact WHERE idcontact='$idContact' LIMIT 1";
	$res = mysql_query($req);
	if ($res==1) { return 1; } else { return 0; }
}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// AGENDA //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function evenements ($orderby) { // > $tab des événements
		// $orderby : identreprise / nom...
		$req = "SELECT idagenda,identreprise,idcontact,dateEv,heure,evenement,notes FROM kandida_agenda ORDER BY $orderby";
		$res = mysql_query($req);
		$i=0;
		while ($bub = mysql_fetch_object($res)) {
			$tab[$i][0] = $bub->idagenda;
			$tab[$i][1] = $bub->identreprise;
			$tab[$i][2] = $bub->idcontact;
			$tab[$i][3] = $bub->dateEv;
			$tab[$i][4] = $bub->heure;
			$tab[$i][5] = $bub->evenement;
			$tab[$i][6] = $bub->notes;
			$i++;
		}
		return $tab; // $tab[0=idagenda/1=identreprise/2=idcontact/3=dateEv/4=heure/5=evenement/6=notes]
	}
	
	function evenementsEnt ($identreprise) { // > $tab des événements
		// $orderby : identreprise / nom...
		$req = "SELECT idagenda,identreprise,idcontact,dateEv,heure,evenement,notes FROM kandida_agenda WHERE identreprise='$identreprise' ORDER BY dateEv DESC";
		$res = mysql_query($req);
		$i=0;
		while ($bub = mysql_fetch_object($res)) {
			$tab[$i][0] = $bub->idagenda;
			$tab[$i][1] = $bub->identreprise;
			$tab[$i][2] = $bub->idcontact;
			$tab[$i][3] = $bub->dateEv;
			$tab[$i][4] = $bub->heure;
			$tab[$i][5] = $bub->evenement;
			$tab[$i][6] = $bub->notes;
			$i++;
		}
		return $tab; // $tab[$i][0=idagenda/1=identreprise/2=idcontact/3=dateEv/4=heure/5=evenement/6=notes]
	}
	
	function evenementsCon ($idcontact) { // > $tab des événements
		// $orderby : identreprise / nom...
		$req = "SELECT idagenda,identreprise,idcontact,dateEv,heure,evenement,notes FROM kandida_agenda WHERE idcontact='$idcontact' ORDER BY dateEv DESC";
		$res = mysql_query($req);
		$i=0;
		while ($bub = mysql_fetch_object($res)) {
			$tab[$i][0] = $bub->idagenda;
			$tab[$i][1] = $bub->identreprise;
			$tab[$i][2] = $bub->idcontact;
			$tab[$i][3] = $bub->dateEv;
			$tab[$i][4] = $bub->heure;
			$tab[$i][5] = $bub->evenement;
			$tab[$i][6] = $bub->notes;
			$i++;
		}
		return $tab; // $tab[$i][0=idagenda/1=identreprise/2=idcontact/3=dateEv/4=heure/5=evenement/6=notes]
	}
	
	function verifDateEv ($dateEv) {
		// vérification de la dateEv > dateDuJour
		$annee	= date('Y');
		$mois	= date('m');
		$jour	= date('d');
		$t 	= explode ("-",$dateEv);	// $t[0] = AAAA / $t[1] = mm / $t[2] = jj
				
		// annee
		if ($t[0] > $annee)	{ return true; }
		if ($t[0] < $annee)	{ return false; }
		// mois
		if ($t[0] == $annee) {
			if ($t[1] > $mois) { return true; }
			if ($t[1] < $mois) { return false; }
			// jour
			if ($t[1] == $mois) {
				if ($t[2] > $jour) { return true; }
				if ($t[2] < $jour) { return false; }
				if ($t[2] == $jour) { return true; }
			}
		}
	}
	
	function evenementsRestants ($orderby) {
		$req = "SELECT idagenda,identreprise,idcontact,dateEv,heure,evenement,notes FROM kandida_agenda ORDER BY $orderby";
		$res = mysql_query($req);
		$i=0;
		while ($bub = mysql_fetch_object($res)) {
			// vérification de la date de l'événement			
			if (verifDateEv($bub->dateEv)) {
				$tab[$i][0] = $bub->idagenda;
				$tab[$i][1] = $bub->identreprise;
				$tab[$i][2] = $bub->idcontact;
				$tab[$i][3] = $bub->dateEv;
				$tab[$i][4] = $bub->heure;
				$tab[$i][5] = $bub->evenement;
				$tab[$i][6] = $bub->notes;
			}
			$i++;
		}
		return $tab; // $tab[0=idagenda/1=identreprise/2=idcontact/3=dateEv/4=heure/5=evenement/6=notes]
	}
	
	function afficheProchainEvenement ($tabEvenementsRestants) {
		$newDate = changeFormatDate ($tabEvenementsRestants[0][3]);
		echo	"Le <b>".$newDate."</b> à <b>".$tabEvenementsRestants[0][4]."</b><br>"; // date / heure
		$tabCon = contact ($tabEvenementsRestants[0][2]);		// civ = 1 / nom = 2 / prenom = 3
		$tabEnt = entreprise ($tabEvenementsRestants[0][1]); 	// nom = 1
		echo	"".$tabCon[1]." ".$tabCon[3]." ".$tabCon[2]." (".$tabEnt[1].")<br>"; //  civ nom prénom contact / nom entreprise
		echo	"<a href=\"liste.php?session=".$_GET['session']."&mod=agenda&id=".$tabEvenementsRestants[0][0]."\" target=\"_self\" alt=\"voir la fiche complète\">&raquo; fiche complète</a>";
	}

	function afficheListeEvenements ($orderby) {
		// $tab[0=idagenda/1=identreprise/2=idcontact/3=dateEv/4=heure/5=evenement/6=notes]
		echo	"<hr>";
		echo	"<TABLE width=\"95%\" cellpadding=\"0\" cellspacing=\"0\">";
		if ($orderby == 'dateEv') {
			$req = "SELECT idagenda,identreprise,idcontact,dateEv,heure,evenement,notes FROM kandida_agenda ORDER BY $orderby DESC";
		}
		else {
			$req = "SELECT idagenda,identreprise,idcontact,dateEv,heure,evenement,notes FROM kandida_agenda ORDER BY $orderby";
		}
		$res = mysql_query($req);
		$i=0;
		while ($bub = mysql_fetch_object($res)) {
			if (verifDateEv($bub->dateEv)) 	{ $classTab = 'texteTab'; 	$verif = '1'; }
			else 							{ $classTab = 'texteGris'; 	$verif = '0'; }
			if (pair($i)) { $class = 'pair'; } else { $class = 'impair'; }
			echo	"<TR class=\"$class\" height=\"30\">";
			$dateEv = changeFormatDate ($bub->dateEv);
			echo		"<TD width=\"120\" align=\"left\"><SPAN class=\"$classTab\">".$dateEv."</SPAN></TD>";
			echo		"<TD width=\"50\" align=\"left\"><SPAN class=\"$classTab\">".$bub->heure."</SPAN></TD>";
			$tabEnt = entreprise ($bub->identreprise);
			$tabCon = contact ($bub->idcontact);
			if ($verif == '0') {
				echo		"<TD align=\"left\"><A href=\"liste.php?session=".$_GET['session']."&mod=entreprises&id=".$bub->identreprise."\" target=\"_self\" title=\"Voir la fiche descriptive\"><SPAN class=\"$classTab\"><b>".$tabEnt[1]."</b></SPAN></A></TD>";
				echo		"<TD align=\"left\"><A href=\"liste.php?session=".$_GET['session']."&mod=contacts&id=".$bub->idcontact."\" target=\"_self\" title=\"Voir la fiche descriptive\"><SPAN class=\"$classTab\">".$tabCon[1]." ".$tabCon[2]." ".$tabCon[3]."</SPAN></A></TD>";
				echo		"<TD align=\"left\"><A href=\"liste.php?session=".$_GET['session']."&mod=agenda&id=".$bub->idagenda."\" target=\"_self\"><SPAN class=\"$classTab\">".$bub->evenement."</SPAN></A>";
			}
			else {
				echo		"<TD align=\"left\"><SPAN class=\"$classTab\"><A href=\"liste.php?session=".$_GET['session']."&mod=entreprises&id=".$bub->identreprise."\" target=\"_self\" title=\"Voir la fiche descriptive\"><b>".$tabEnt[1]."</b></A></SPAN></TD>";
				echo		"<TD align=\"left\"><SPAN class=\"$classTab\"><A href=\"liste.php?session=".$_GET['session']."&mod=contacts&id=".$bub->idcontact."\" target=\"_self\" title=\"Voir la fiche descriptive\">".$tabCon[1]." ".$tabCon[2]." ".$tabCon[3]."</A></SPAN></TD>";
				echo		"<TD align=\"left\"><SPAN class=\"$classTab\"><A href=\"liste.php?session=".$_GET['session']."&mod=agenda&id=".$bub->idagenda."\" target=\"_self\">".$bub->evenement."</A></SPAN>";
			}
			echo	"</TR>";
			$i++;
		}
		echo	"</TABLE>";
		echo	"<br><hr>";
		echo	"<FORM method=\"POST\" action=\"liste.php?session=".$_GET['session']."&mod=agenda\" target=\"_self\">";
		echo	"Trier par : ";
		echo		"<SELECT name=\"orderby\" class=\"texteTab\">";
		echo			"<OPTION name=\"dateEv\">dateEv</OPTION>";
		echo			"<OPTION name=\"identreprise\">identreprise</OPTION>";
		echo		"</SELECT>";
		echo	" <INPUT type=\"submit\" name=\"Submit\" class=\"bouton\" value=\"Trier\">";
		echo	"</FORM>";


	}
	
	function evenement ($idagenda) { // > $tab des références d'un événement
		$req = "SELECT idagenda,identreprise,idcontact,dateEv,heure,evenement,notes FROM kandida_agenda WHERE idagenda='$idagenda' LIMIT 1";
		$res = mysql_query($req);
		while ($bub = mysql_fetch_object($res)) {
			$tab[0] = $bub->idagenda;
			$tab[1] = $bub->identreprise;
			$tab[2] = $bub->idcontact;
			$tab[3] = $bub->dateEv;
			$tab[4] = $bub->heure;
			$tab[5] = $bub->evenement;
			$tab[6] = $bub->notes;
			return $tab; // $tab[0=idagenda/1=identreprise/2=idcontact/3=dateEv/4=heure/5=evenement/6=notes]
		}
	}
	
	function afficheFicheEvenement ($idagenda) {
						
		$tabEv = evenement ($idagenda);
		// $tab[0=idagenda/1=identreprise/2=idcontact/3=dateEv/4=heure/5=evenement/6=notes]
		$tabEnt = entreprise ($tabEv[1]);
		// $tab[0=identreprise/1=nom/2=secteur/3=adr1/4=adr2/5=cp/6=ville/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes]
		$tabCon = contact ($tabEv[2]);
		// $tab[0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
		$dateEv = changeFormatDate ($tabEv[3]);
		
		// RDV
		echo	"<TABLE width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">";
		echo	"<TR height=\"30\">";
		echo		"<TD align=\"left\"><SPAN class=\"titreTab\"><DIV align=\"right\"><b>".$dateEv." - ".$tabEv[4]."</b></DIV></SPAN></TD>";
		echo	"</TR>";
		echo	"</TABLE>";
		
		// références pro
		echo	"<SPAN class=\"titreRub\"><IMG src=\"images/img_agen_mini.jpg\" border=\"0\"> <b>EVENEMENT</b></SPAN><br>";
		echo	"<TABLE width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabRub\">";
		if ($tabEv[1] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\" width=\"50%\"><SPAN class=\"texteTab\">Entreprise :</SPAN></TD>";
		echo		"<TD width=\"5%\" class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\"><A href=\"liste.php?session=".$_GET['session']."&mod=entreprises&id=".$tabEv[1]."\" target=\"_self\">".$tabEnt[1]."</A></SPAN></TD>";
		echo	"</TR>";
		}
		if ($tabEv[2] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">Contact :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\"><A href=\"liste.php?session=".$_GET['session']."&mod=contacts&id=".$tabEv[2]."\" target=\"_self\">".$tabCon[1]." ".strtoupper($tabCon[2])." ".$tabCon[3]."</A></SPAN></TD>";
		echo	"</TR>";
		}
		echo	"<TR height=\"20\" valign=\"top\"><TD>&nbsp;</TD><TD width=\"20\"class=\"impair\">&nbsp;</TD><TD class=\"impair\">&nbsp;</TD></TR>";
		if ($tabEv[5] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">Evénement :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\">".$tabEv[5]."</SPAN></TD>";
		echo	"</TR>";
		}
		echo	"<TR height=\"20\" valign=\"top\"><TD>&nbsp;</TD><TD width=\"20\"class=\"impair\">&nbsp;</TD><TD class=\"impair\">&nbsp;</TD></TR>";
		if ($tabEv[6] != '') {
		echo	"<TR>";
		echo		"<TD align=\"left\" ><SPAN class=\"texteTab\">Commentaires :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\"><SPAN class=\"texteTab\"><i>".$tabEv[6]."</i></SPAN></TD>";
		echo	"</TR>";
		}
		echo	"</TABLE>";

		//echo	"<hr>";
		
		echo	"<br>";
		
		echo	"<A href=\"suppr.php?session=".$_GET['session']."&mod=agenda&id=$idagenda\" target=\"_self\">";
		echo		"<IMG src=\"images/bouton_supprimer.jpg\" border=\"0\">";
		echo	"</A> ";
		echo	"<A href=\"modif.php?session=".$_GET['session']."&mod=agenda&id=$idagenda\" target=\"_self\">";
		echo		"<IMG src=\"images/bouton_modifier.jpg\" border=\"0\">";
		echo	"</A> ";

	}
	
	function ajoutEvenement ($idcontact) {
		echo	"<FORM method=\"POST\" action=\"ajouter.php?session=".$_GET['session']."&mod=agenda&valid=1\" name=\"ajoutEvenement\">";
		// coordonnées
		echo	"<SPAN class=\"titreRub\"><IMG src=\"images/img_agen_mini.jpg\" border=\"0\"> <b>REFERENCES</b></SPAN><br>";
		echo	"<TABLE width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabRub\">";
		echo	"<TR>";
		echo		"<TD align=\"left\" width=\"50%\"><SPAN class=\"texteTab\">Contact :</SPAN></TD>";
		echo		"<TD width=\"5%\" class=\"impair\">&nbsp;</TD>";
		$tabCon = contact ($idcontact);
		// $tab[0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
		echo		"<TD align=\"left\" class=\"impair\" height=\"30\"><SPAN class=\"texteTab\"><INPUT class=\"texte\" type=\"text\" size=\"35\" name=\"entreprise\" value=\"".$tabCon[1]." ".$tabCon[2]." ".$tabCon[3]."\" disabled><INPUT type=\"hidden\" name=\"identreprise\" value=\"".$tabCon[14]."\"><INPUT type=\"hidden\" name=\"idcontact\" value=\"$idcontact\"></SPAN></TD>";
		echo	"</TR>";
		echo	"<TR>";
		echo		"<TD align=\"left\" width=\"50%\"><SPAN class=\"texteTab\">Date :</SPAN></TD>";
		echo		"<TD width=\"5%\" class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\" height=\"30\"><SPAN class=\"texteTab\">";
		echo			"<SELECT class=\"texte\" name=\"jour\">";
		for ($i=01; $i<32; $i++) { echo	"<option value=\"$i\">$i</option>"; }
		echo			"</SELECT> ";
		echo			"<SELECT class=\"texte\" name=\"mois\">";
		echo				"<option value=\"01\">janvier</option>";
		echo				"<option value=\"02\">février</option>";
		echo				"<option value=\"03\">mars</option>";
		echo				"<option value=\"04\">avril</option>";
		echo				"<option value=\"05\">mai</option>";
		echo				"<option value=\"06\">juin</option>";
		echo				"<option value=\"07\">juillet</option>";
		echo				"<option value=\"08\">août</option>";
		echo				"<option value=\"09\">septembre</option>";
		echo				"<option value=\"10\">octobre</option>";
		echo				"<option value=\"11\">novembre</option>";
		echo				"<option value=\"12\">décembre</option>";
		echo			"</SELECT> ";
		echo			"<SELECT class=\"texte\" name=\"annee\">";
		for ($i=2005; $i<2011; $i++) { echo	"<option value=\"$i\">$i</option>"; }
		echo			"</SELECT> ";
		echo	"</TR>";
		echo		"<TD align=\"left\" width=\"50%\"><SPAN class=\"texteTab\">Heure :</SPAN></TD>";
		echo		"<TD width=\"5%\" class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\" height=\"30\"><SPAN class=\"texteTab\"><INPUT class=\"texte\" type=\"text\" size=\"5\" name=\"hour\"> h <INPUT class=\"texte\" type=\"text\" size=\"5\" name=\"min\"></SPAN></TD>";
		echo	"</TR>";
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">Evénement :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\" height=\"30\"><SPAN class=\"texteTab\"><INPUT class=\"texte\" type=\"text\" size=\"35\" name=\"evenement\"></SPAN></TD>";
		echo	"</TR>";
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">Commentaires :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\" height=\"30\"><SPAN class=\"texteTab\"><INPUT class=\"texte\" type=\"text\" size=\"35\" name=\"notes\"></SPAN></TD>";
		echo	"</TR>";

		echo	"</TABLE>";
		echo	"<br>";
		echo	"<INPUT type=\"submit\" class=\"bouton\" value=\"Ajouter cet événement\">";
		echo	"</FORM>";
	}
	
	function modifEvenement ($idagenda) {
	
		$tabEv = evenement ($idagenda);
		// $tab[0=idagenda/1=identreprise/2=idcontact/3=dateEv/4=heure/5=evenement/6=notes]
		$tabCon = contact ($tabEv[2]);
		// $tab[0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
		// Paramétrage de la date
		$tabD 	= explode ("-",$tabEv[3]);	// $tab[0] = YYYY / $tab[1] = mm / $tab[2] = dd		
		$annee	= $tabD[0];			$mois = $tabD[1]; 		$jour	= $tabD[2];
		// Paramétrage de l'heure
		$tabH	= explode ("h",$tabEv[4]);
		$hour 	= $tabH[0];			$min = $tabH[1];
		
		echo	"<FORM method=\"POST\" action=\"modif.php?session=".$_GET['session']."&mod=agenda&id=".$idagenda."&valid=1\" name=\"modifEvenement\">";
		// coordonnées
		echo	"<SPAN class=\"titreRub\"><IMG src=\"images/img_agen_mini.jpg\" border=\"0\"> <b>REFERENCES</b></SPAN><br>";
		echo	"<TABLE width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabRub\">";
		echo	"<TR>";
		echo		"<TD align=\"left\" width=\"50%\"><SPAN class=\"texteTab\">Contact :</SPAN></TD>";
		echo		"<TD width=\"5%\" class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\" height=\"30\"><SPAN class=\"texteTab\"><INPUT class=\"texte\" type=\"text\" size=\"35\" name=\"entreprise\" value=\"".$tabCon[1]." ".$tabCon[2]." ".$tabCon[3]."\" disabled><INPUT type=\"hidden\" name=\"identreprise\" value=\"".$tabCon[14]."\"><INPUT type=\"hidden\" name=\"idcontact\" value=\"".$tabEv[2]."\"></SPAN></TD>";
		echo	"</TR>";
		echo	"<TR>";
		echo		"<TD align=\"left\" width=\"50%\"><SPAN class=\"texteTab\">Date :</SPAN></TD>";
		echo		"<TD width=\"5%\" class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\" height=\"30\"><SPAN class=\"texteTab\">";
		echo			"<SELECT class=\"texte\" name=\"jour\">";
		for ($i=01; $i<32; $i++) {
			if ($jour == $i) 	{ echo	"<option value=\"$i\" selected>$i</option>"; }
			else				{ echo	"<option value=\"$i\">$i</option>"; }
		}
		echo			"</SELECT> ";
		echo			"<SELECT class=\"texte\" name=\"mois\">";
		if ($mois == 1) 	{ echo "<option value=\"01\" selected>janvier</option>"; }
		else				{ echo "<option value=\"01\">janvier</option>"; }
		if ($mois == 2) 	{ echo "<option value=\"02\" selected>février</option>"; }
		else				{ echo "<option value=\"02\">février</option>"; }
		if ($mois == 3) 	{ echo "<option value=\"03\" selected>mars</option>"; }
		else				{ echo "<option value=\"03\">mars</option>"; }
		if ($mois == 4) 	{ echo "<option value=\"04\" selected>avril</option>"; }
		else				{ echo "<option value=\"04\">avril</option>"; }
		if ($mois == 5) 	{ echo "<option value=\"05\" selected>mai</option>"; }
		else				{ echo "<option value=\"05\">mai</option>"; }
		if ($mois == 6) 	{ echo "<option value=\"06\" selected>juin</option>"; }
		else				{ echo "<option value=\"06\">juin</option>"; }
		if ($mois == 7) 	{ echo "<option value=\"07\" selected>juillet</option>"; }
		else				{ echo "<option value=\"07\">juillet</option>"; }
		if ($mois == 8) 	{ echo "<option value=\"08\" selected>août</option>"; }
		else				{ echo "<option value=\"08\">août</option>"; }
		if ($mois == 9) 	{ echo "<option value=\"09\" selected>septembre</option>"; }
		else				{ echo "<option value=\"09\">septembre</option>"; }
		if ($mois == 10) 	{ echo "<option value=\"10\" selected>octobre</option>"; }
		else				{ echo "<option value=\"10\">octobre</option>"; }
		if ($mois == 11) 	{ echo "<option value=\"11\" selected>novembre</option>"; }
		else				{ echo "<option value=\"11\">novembre</option>"; }
		if ($mois == 12) 	{ echo "<option value=\"12\" selected>décembre</option>"; }
		else				{ echo "<option value=\"12\">décembre</option>"; }
		echo			"</SELECT> ";
		echo			"<SELECT class=\"texte\" name=\"annee\">";
		for ($i=2005; $i<2011; $i++) {
			if ($annee == $i) 	{ echo	"<option value=\"$i\" selected	>$i</option>"; }
			else				{ echo	"<option value=\"$i\">$i</option>"; }
		}
		echo			"</SELECT> ";
		echo	"</TR>";
		echo		"<TD align=\"left\" width=\"50%\"><SPAN class=\"texteTab\">Heure :</SPAN></TD>";
		echo		"<TD width=\"5%\" class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\" height=\"30\"><SPAN class=\"texteTab\"><INPUT class=\"texte\" type=\"text\" size=\"5\" name=\"hour\" value=\"$hour\"> h <INPUT class=\"texte\" type=\"text\" size=\"5\" name=\"min\" value=\"$min\"></SPAN></TD>";
		echo	"</TR>";
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">Evénement :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\" height=\"30\"><SPAN class=\"texteTab\"><INPUT class=\"texte\" type=\"text\" size=\"35\" name=\"evenement\" value=\"".$tabEv[5]."\"></SPAN></TD>";
		echo	"</TR>";
		echo	"<TR>";
		echo		"<TD align=\"left\"><SPAN class=\"texteTab\">Commentaires :</SPAN></TD>";
		echo		"<TD class=\"impair\">&nbsp;</TD>";
		echo		"<TD align=\"left\" class=\"impair\" height=\"30\"><SPAN class=\"texteTab\"><INPUT class=\"texte\" type=\"text\" size=\"35\" name=\"notes\" value=\"".$tabEv[6]."\"></SPAN></TD>";
		echo	"</TR>";

		echo	"</TABLE>";
		echo	"<br>";
		echo	"<INPUT type=\"submit\" class=\"bouton\" value=\"Modifier cet événement\">";
		echo	"</FORM>";
	}
	
	function supprEvenement ($idagenda) {
	}


// Version 2 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////


function couleur ($titre) {
	$tCouleurs = array ('B8860B','6C0','09C','FC0','969','FF6347','8FBC8F'); /* marron / vert / bleu / orange / violet / tomate / vert d'eau */
	$tTitre = array ('Candidatures','Concours','Formations','Actualités','Calendrier','Contacts','Etablissements');
	for ($i=0;$i<count($tTitre);$i++) { if ($tTitre[$i]==$titre) { return '#'.$tCouleurs[$i]; } }
}

function afficheListeMenu () {
	echo '<table cellpadding="0" cellspacing="0" border="0">';
	echo '<tr class="contenu_menu_liste">';
	// Candidatures --------------------------------------------------------------------------------------------------
	$lCEC = listeCandidaturesEnCours(0,'idcandidature DESC'); $lCP = listeCandidaturesPassees(0,'idcandidature DESC');
	$nbCEC = count($lCEC); if ($nbCEC==0) { $nbCandidaturesEnCours='Aucune en cours'; } else {
		$tabLastCand = candidature ($lCEC[0]); $tabLastCandEtbl = entreprise ($tabLastCand[1]);
		$canRef = '<b>'.$tabLastCand[8].'</b> ('.$tabLastCand[10].') &rarr; '.$tabLastCandEtbl[1];
		if ($nbCEC==1) { $nbCandidaturesEnCours='<b>1</b> en cours'; } else { $nbCandidaturesEnCours='<b>'.$nbCEC.'</b> en cours'; }
	}
	$nbCP = count($lCP); if ($nbCP==0) { $nbCandidaturesPassees='Aucune archive'; } else { if ($nbCP==1) { $nbCandidaturesPassees='<b>1</b> archive'; } else { $nbCandidaturesPassees='<b>'.$nbCP.'</b> archives'; } }
	echo '<td class="contenu_menu_liste_01" valign="top"><a href="candidature.php?session='.$_GET['session'].'&mod=liste" target="_self"><div id="contenu_menu_liste_texte"><div><img src="images/ico_mini_encours.png" border="0"> '.$nbCandidaturesEnCours.'</div><div><img src="images/ico_mini_passe.png" border="0"> '.$nbCandidaturesPassees.'</div><div style="font-size:14px;margin-top:10px;"><img src="images/ico_cand.png" border="0"> '.$canRef.'</div></div></a></td>'; // candidatures
	// Concours --------------------------------------------------------------------------------------------------------
	/*
	$lCEC = listeConcoursEnCours('idconcours DESC'); $lCP = listeConcoursPasses('idconcours DESC');
	$nbCEC = count($lCEC); if ($nbCEC==0) { $nbCandidaturesEnCours='Aucun en cours'; } else {
		$tabLastCand = concours ($lCEC[0]); $tabLastCandEtbl = entreprise ($tabLastCand[1]);
		$canRef = '<b>'.$tabLastCand[3].'</b> ('.$tabLastCand[4].' &middot; '.$tabLastCand[5].') &rarr; '.$tabLastCandEtbl[1];
		if ($nbCEC==1) { $nbCandidaturesEnCours='<b>1</b> en cours'; } else { $nbCandidaturesEnCours='<b>'.$nbCEC.'</b> en cours'; }
	}
	$nbCP = count($lCP); if ($nbCP==0) { $nbCandidaturesPassees='Aucune archive'; } else { if ($nbCP==1) { $nbCandidaturesPassees='<b>1</b> archive'; } else { $nbCandidaturesPassees='<b>'.$nbCP.'</b> archives'; } }
	echo '<td class="contenu_menu_liste_02" valign="top"><a href="concours.php?session='.$_GET['session'].'&mod=liste" target="_self"><div id="contenu_menu_liste_texte"><div><img src="images/ico_mini_encours.png" border="0"> '.$nbCandidaturesEnCours.'</div><div><img src="images/ico_mini_passe.png" border="0"> '.$nbCandidaturesPassees.'</div><div style="font-size:14px;margin-top:10px;"><img src="images/ico_cand.png" border="0"> '.$canRef.'</div></div></a></td>'; // concours
	echo '<td class="contenu_menu_liste_03" valign="top"><a href="formation.php?session='.$_GET['session'].'&mod=liste" target="_self"><div id="contenu_menu_liste_texte">&raquo; menu3</div></a></td>'; // formations
	echo '<td class="contenu_menu_liste_04" valign="top"><a href="actualite.php?session='.$_GET['session'].'&mod=liste" target="_self"><div id="contenu_menu_liste_texte">&raquo; menu4</div></a></td>'; // actualités
	echo '<td class="contenu_menu_liste_05" valign="top"><a href="calendrier.php?session='.$_GET['session'].'&mod=liste" target="_self"><div id="contenu_menu_liste_texte">&raquo; menu5</div></a></td>'; // calendrier
	*/
// Etablissements --------------------------------------------------------------------------------------------------------
	$lCEC = entreprises ('identreprise DESC');
	$nbCEC = count($lCEC); if ($nbCEC==0) { $nbCandidaturesEnCours='Aucun établissement'; } else {
		$tabLastCand = entreprise ($lCEC[0][0]);
		if ($nbCEC==1) { $nbCandidaturesEnCours='<b>1</b> établissement'; } else { $nbCandidaturesEnCours='<b>'.$nbCEC.'</b> établissements'; }
// $tab[0=identreprise/1=nom/2=secteur/3=adr1/4=adr2/5=cp/6=ville/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes]
		$canRef = '<b>'.$tabLastCand[1].'</b> &rarr; '.$tabLastCand[2].'';
	}
	echo '<td class="contenu_menu_liste_07" valign="top"><a href="entreprise.php?session='.$_GET['session'].'&mod=liste" target="_self"><div id="contenu_menu_liste_texte"><div><img src="images/ico_mini_encours.png" border="0"> '.$nbCandidaturesEnCours.'</div><div style="font-size:14px;margin-top:10px;"><img src="images/ico_cand.png" border="0"> '.$canRef.'</div></div></a></td>'; // etabli.
// Contacts --------------------------------------------------------------------------------------------------------
	$lCEC = contacts ('idcontact DESC');
	$nbCEC = count($lCEC); if ($nbCEC==0) { $nbCandidaturesEnCours='Aucun contact'; } else {
		$tabLastCand = contact ($lCEC[0][0]);
		if ($nbCEC==1) { $nbCandidaturesEnCours='<b>1</b> contact'; } else { $nbCandidaturesEnCours='<b>'.$nbCEC.'</b> contacts'; }
// $tab[0=idcontact/1=civ/2=nom/3=prenom/4=fonction/5=loc1/6=loc2/7=tel1/8=tel2/9=fax1/10=fax2/11=email/12=web/13=notes/14=identreprise]
		$canRef = '<b>'.$tabLastCand[2].' '.$tabLastCand[3].'</b>';
	}
	echo '<td class="contenu_menu_liste_06" valign="top"><a href="contact.php?session='.$_GET['session'].'&mod=liste" target="_self"><div id="contenu_menu_liste_texte"><div><img src="images/ico_mini_encours.png" border="0"> '.$nbCandidaturesEnCours.'</div><div style="font-size:14px;margin-top:10px;"><img src="images/ico_cand.png" border="0"> '.$canRef.'</div></div></a></td>'; // contacts
	echo '</tr>';
	echo '</table>';
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CANDIDATURE /////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function candidature ($idcandidature) { // > $tab des références d'une candidature
	$req = "SELECT idcandidature,identreprise,idcontact,refCDG,webCDG,refLocal,webLocal,domaine,titre,filiere,grade,direction,service,region,
departement,ville,dateParution,dateFin,dateEnvoi,modeEnvoi,dateReponse,reponse,notes,type,emploi FROM kandida_candidature WHERE idcandidature='$idcandidature' LIMIT 1";
	$res = mysql_query($req);
	while ($bub = mysql_fetch_object($res)) {
		$tab[0] = $bub->idcandidature;
		$tab[1] = $bub->identreprise;
		$tab[2] = $bub->idcontact;
		$tab[3] = $bub->refCDG;
		$tab[4] = $bub->webCDG;
		$tab[5] = $bub->refLocal;
		$tab[6] = $bub->webLocal;
		$tab[7] = $bub->domaine;
		$tab[8] = $bub->titre;
		$tab[9] = $bub->filiere;
		$tab[10] = $bub->grade;
		$tab[11] = $bub->direction;
		$tab[12] = $bub->service;
		$tab[13] = $bub->region;
		$tab[14] = $bub->departement;
		$tab[15] = $bub->ville;
		$tab[16] = $bub->dateParution;
		$tab[17] = $bub->dateFin;
		$tab[18] = $bub->dateEnvoi;
		$tab[19] = $bub->modeEnvoi; // poste / email / depot
		$tab[20] = $bub->dateReponse;
		$tab[21] = $bub->reponse; // positive / négative / 0
		$tab[22] = $bub->notes;
		$tab[23] = $bub->type; // spontanée / annonce
		$tab[24] = $bub->emploi; // CDI / CDD / stage / mission
		return $tab; // $tab [0=idcandidature] [1=identreprise] [2=idcontact] [3=refCDG] [4=webCDG] [5=refLocal] [6=webLocal] [7=domaine] [8=titre] [9=filiere] [10=grade] [11=direction] [12=service] [13=region] [14=departement] [15=ville] [16=dateParution] [17=dateFin] [18=dateEnvoi] [19=modeEnvoi] [20=dateReponse] [21=reponse] [22=notes] [23=type] [24=emploi]
	}
}

function listeCandidaturesEnCours ($idEtablissement,$orderby) {
	if ($idEtablissement != 0) { // lister les candidature d'un établissement donné
		$req = "SELECT idcandidature FROM kandida_candidature WHERE (identreprise='$idEtablissement' AND dateReponse='0000-00-00') ORDER BY $orderby";
	}
	else { // lister toutes les candidatures
		$req = "SELECT idcandidature FROM kandida_candidature WHERE dateReponse='0000-00-00' ORDER BY $orderby";
	}
	$res = mysql_query($req);
	$i=0;
	while ($bub = mysql_fetch_object($res)) { $tab[$i] = $bub->idcandidature; $i++; }
	return $tab;
}

function listeCandidaturesPassees ($idEtablissement,$orderby) {
	if ($idEtablissement != 0) { // lister les candidatures d'un établissement donné
		$req = "SELECT idcandidature FROM kandida_candidature WHERE (identreprise='$idEtablissement' AND dateReponse!='0000-00-00') ORDER BY $orderby";
	}
	else { // lister toutes les candidatures
		$req = "SELECT idcandidature FROM kandida_candidature WHERE dateReponse!='0000-00-00' ORDER BY $orderby";
	}
	$res = mysql_query($req);
	$i=0;
	while ($bub = mysql_fetch_object($res)) { $tab[$i] = $bub->idcandidature; $i++; }
	return $tab;
}
function insertCandidature ($identreprise,$idcontact,$refCDG,$webCDG,$refLocal,$webLocal,$domaine,$titre,$filiere,$grade,$direction,$service,$region,$departement,$ville,$dateParution,$dateFin,$dateEnvoi,$modeEnvoi,$dateReponse,$reponse,$notes,$type,$emploi) {
	$req = "INSERT INTO kandida_candidature (identreprise, idcontact, refCDG, webCDG, refLocal, webLocal, domaine, titre, filiere, grade, direction, service, region, departement, ville, dateParution, dateFin, dateEnvoi, modeEnvoi, dateReponse, reponse, notes, type, emploi) VALUES ('$identreprise', '$idcontact', '$refCDG', '$webCDG', '$refLocal', '$webLocal', '$domaine', '$titre', '$filiere', '$grade', '$direction', '$service', '$region', '$departement', '$ville', '$dateParution', '$dateFin', '$dateEnvoi', '$modeEnvoi', '$dateReponse', '$reponse', '$notes', '$type', '$emploi')";
	$res = mysql_query($req);
	if ($res==1) { return 1; } else { return 0; }
}
function modifCandidature ($idcandidature,$identreprise,$idcontact,$refCDG,$webCDG,$refLocal,$webLocal,$domaine,$titre,$filiere,$grade,$direction,$service,$region,$departement,$ville,$dateParution,$dateFin,$dateEnvoi,$modeEnvoi,$dateReponse,$reponse,$notes,$type,$emploi) {
	$req = "UPDATE kandida_candidature SET identreprise='$identreprise', idcontact='$idcontact', refCDG='$refCDG', webCDG='$webCDG', refLocal='$refLocal', webLocal='$webLocal', domaine='$domaine', titre='$titre', filiere='$filiere', grade='$grade', direction='$direction', service='$service', region='$region', departement='$departement', ville='$ville', dateParution='$dateParution', dateFin='$dateFin', dateEnvoi='$dateEnvoi', modeEnvoi='$modeEnvoi', dateReponse='$dateReponse', reponse='$reponse', notes='$notes', type='$type', emploi='$emploi' WHERE idcandidature='$idcandidature' LIMIT 1";
	$res = mysql_query($req);
	if ($res==1) { return 1; } else { return 0; }
}
function supprCandidature ($idCandidature) {
	$req = "DELETE FROM kandida_candidature WHERE idcandidature='$idCandidature' LIMIT 1";
// ATTENTION : supprimer récursivement tous les événements liés à cette candidature !!
//echo '<br><br>'.$req.'<br><br>idcandidature = ['.$idCandidature.']<br><br>res = ['.$res.']<br><br>';
	$res = mysql_query($req);
	if ($res==1) { return 1; } else { return 0; }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CONCOURS ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function concours ($idconcours) { // > $tab des références d'un concours
	$req = "SELECT idconcours, idorganisateur, session, intitule, categorie, modalite, web, dateRetraitDossierDebut, dateRetraitDossierFin, dateLimiteDepotDossier, dateEcrit, dateOral, dateResultatEcrit, dateResultatOral, resultatEcrit, resultatOral, nbPostesOuverts, notes FROM kandida_concours WHERE idconcours='$idconcours' LIMIT 1";
	$res = mysql_query($req);
	while ($bub = mysql_fetch_object($res)) {
		$tab[0] = $bub->idconcours;
		$tab[1] = $bub->idorganisateur; // idEntreprise
		$tab[2] = $bub->session; // YYYY
		$tab[3] = $bub->intitule;
		$tab[4] = $bub->categorie; // A / B / C
		$tab[5] = $bub->modalite; // 'externe','interne','troisième voie','examen professionnel'
		$tab[6] = $bub->web;
		$tab[7] = $bub->dateRetraitDossierDebut;
		$tab[8] = $bub->dateRetraitDossierFin;
		$tab[9] = $bub->dateLimiteDepotDossier;
		$tab[10] = $bub->dateEcrit;
		$tab[11] = $bub->dateOral;
		$tab[12] = $bub->dateResultatEcrit;
		$tab[13] = $bub->dateResultatOral;
		$tab[14] = $bub->resultatEcrit; // 0 / positif / négatif
		$tab[15] = $bub->resultatOral; // 0 / positif / négatif / aucun
		$tab[16] = $bub->nbPostesOuverts;
		$tab[17] = $bub->notes;
		return $tab; // $tab [0=idconcours] [1=idorganisateur] [2=session] [3=intitule] [4=categorie] [5=modalite] [6=web] [7=dateRetraitDossierDebut] [8=dateRetraitDossierFin] [9=dateLimiteDepotDossier] [10=dateEcrit] [11=dateOral] [12=dateResultatEcrit] [13=dateResultatOral] [14=resultatEcrit] [15=resultatOral] [16=nbPostesOuverts] [17=notes]
	}
}

function listeConcoursEnCours ($orderby) {
	if (!isset($orderby)) { $orderby = 'idconcours'; }
	$req = "SELECT idconcours FROM kandida_concours WHERE resultatOral='0' ORDER BY $orderby";
	$res = mysql_query($req);
	$i=0;
	while ($bub = mysql_fetch_object($res)) { $tab[$i] = $bub->idconcours; $i++; }
	return $tab;
}
function listeConcoursPasses ($orderby) {
	if (!isset($orderby)) { $orderby = 'idconcours'; }
	$req = "SELECT idconcours FROM kandida_concours WHERE resultatOral!='0' ORDER BY $orderby";
	$res = mysql_query($req);
	$i=0;
	while ($bub = mysql_fetch_object($res)) { $tab[$i] = $bub->idconcours; $i++; }
	return $tab;
}
function insertConcours ($idorganisateur,$session,$intitule,$categorie,$modalite,$web,$dateRetraitDossierDebut,$dateRetraitDossierFin,$dateLimiteDepotDossier,$dateEcrit,$dateOral,$dateResultatEcrit,$dateResultatOral,$resultatEcrit,$resultatOral,$nbPostesOuverts,$notes) {
	$req = "INSERT INTO kandida_concours (idorganisateur, session, intitule, categorie, modalite, web, dateRetraitDossierDebut, dateRetraitDossierFin, dateLimiteDepotDossier, dateEcrit, dateOral, dateResultatEcrit, dateResultatOral, resultatEcrit, resultatOral, nbPostesOuverts, notes) VALUES ('$idorganisateur', '$session', '$intitule', '$categorie', '$modalite', '$web', '$dateRetraitDossierDebut', '$dateRetraitDossierFin', '$dateLimiteDepotDossier', '$dateEcrit', '$dateOral', '$dateResultatEcrit', '$dateResultatOral', '$resultatEcrit', '$resultatOral', '$nbPostesOuverts', '$notes')";
	$res = mysql_query($req);
	if ($res==1) { return 1; } else { return 0; }
}
function modifConcours ($idconcours,$idorganisateur,$session,$intitule,$categorie,$modalite,$web,$dateRetraitDossierDebut,$dateRetraitDossierFin,$dateLimiteDepotDossier,$dateEcrit,$dateOral,$dateResultatEcrit,$dateResultatOral,$resultatEcrit,$resultatOral,$nbPostesOuverts,$notes) {
	$req = "UPDATE kandida_concours SET idorganisateur='$idorganisateur', session='$session', intitule='$intitule', categorie='$categorie', modalite='$modalite', web='$web', dateRetraitDossierDebut='$dateRetraitDossierDebut', dateRetraitDossierFin='$dateRetraitDossierFin', dateLimiteDepotDossier='$dateLimiteDepotDossier', dateEcrit='$dateEcrit', dateOral='$dateOral', dateResultatEcrit='$dateResultatEcrit', dateResultatOral='$dateResultatOral', resultatEcrit='$resultatEcrit', resultatOral='$resultatOral', nbPostesOuverts='$nbPostesOuverts', notes='$notes' WHERE idconcours='$idconcours' LIMIT 1";
	$res = mysql_query($req);
	if ($res==1) { return 1; } else { return 0; }
}
function supprConcours ($idconcours) {
	$req = "DELETE FROM kandida_concours WHERE idconcours='$idconcours' LIMIT 1";
// ATTENTION : supprimer récursivement tous les événements liés à ce concours !!
//echo '<br><br>'.$req.'<br><br>idconcours = ['.$idconcours.']<br><br>res = ['.$res.']<br><br>';
	$res = mysql_query($req);
	if ($res==1) { return 1; } else { return 0; }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FLUX RSS ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function listeRss ($orderby) {
	$req = "SELECT idrss, type, idtype, flux, titre, notes FROM kandida_rss ORDER BY $orderby";
	$res = mysql_query($req);
	$i=0;
	while ($bub = mysql_fetch_object($res)) {
		$tab[$i][0] = $bub->idrss;
		$tab[$i][1] = $bub->type;
		$tab[$i][2] = $bub->idtype;
		$tab[$i][3] = $bub->flux;
		$tab[$i][4] = $bub->titre;
		$tab[$i][5] = $bub->notes;
		$i++;
	}
	return $tab; // $tab[$i][0=idrss/1=type/2=idtype/3=flux/4=titre/5=notes]
	
}
function listeRssType ($type,$id) {
	
}


?>
