<?PHP	
	
/////// Déconnexion //////////////////////////////////////////////////////////////////////////////////////////

	// Cette fonction est en général inutile puisqu'une connexion (non persistante)
	// avec MySQL est fermée à la fin du script

	function deconnexion () {
		mysql_close();
	}
	
?>