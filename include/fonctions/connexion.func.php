<?PHP

/////// Paramètres de connexions //////////////////////////////////////////////////////////////////////////////////////////

	function connexion () {
	
		// Constantes
		//define 	('NOM', "xxxloginxxx");			// login utilisateur
		//define	('PASSE', "xxxmotdepassexxx");			// mot de passe
		//define	('SERVEUR', "xxxserveursqlxxx");		// sql.free.fr ...
		
		// Constantes
		/* Connexion distante */
		define 	('NOM', "xxxloginxxx");						// HOST, ROOT si local
		define	('PASSE', "xxxmotdepassexxx");					// mot de passe utilisateur
		define	('SERVEUR', "xxxserveursqlxxx");				// nom du serveur
		define	('BASE', "xxxbasededonneesxxx");					// base de données
		

		// Requête de connexion
		
		$connexion = mysql_pconnect (SERVEUR, NOM, PASSE);
	
		if (!$connexion)	{	echo "Désolé, connexion au serveur <b>".strtoupper(constant('SERVEUR'))."</b> impossible\n";	exit; }
		//else { echo	"<br><br><FONT color=\"green\">Connexion au serveur OK</FONT><br><br>"; }
		// Connexion à la base
		if (!mysql_select_db (BASE, $connexion)) {
			echo "Désolé, accès à la base $pBase impossible\n";
			echo "<B>Message de MySQL :</B> " . mysql_error($connexion);
			exit;
		}
		//else { echo	"<br><br><FONT color=\"green\">Connexion à la base OK</FONT><br><br>"; }
		
	}

?>
