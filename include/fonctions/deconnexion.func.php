<?PHP	
	
/////// D�connexion //////////////////////////////////////////////////////////////////////////////////////////

	// Cette fonction est en g�n�ral inutile puisqu'une connexion (non persistante)
	// avec MySQL est ferm�e � la fin du script

	function deconnexion () {
		mysql_close();
	}
	
?>