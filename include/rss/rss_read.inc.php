<?php
// -------------------------------------------------------
	var $rss_encoding;
	var $to_replace;
	var $mode_agrege;
	/*
	** initialisation de la classe
	*/
	function rss_read()
	{
		$this -> class_version = '2.1c';
		$this -> rss_encoding = '';
		$this -> to_replace = array();
		$this -> mode_agrege = true;
	}
	
	/*
	** initialise le mode
	*/	
	{
		$this -> mode_agrege = false;
	}

	/*
	** initialise les tableau pour remplacement de caract�res avant traitement du flux
	*/	
	{
		if (!empty($avant)) {
			$this -> to_replace = $avant;
		}

			$this -> replace_with = $apres;
		}
	}
	
	/*
	** analyse les ent�tes pour trouver Last-Modified
	** retourne la donn�e sous forme timestamp ou telle quelle
	*/
	function header_last_modified($headers, $format = true) {
		if (preg_match('/HTTP\/1.1 404/', $headers)) {
			return false;
		}
		else if (preg_match("/Last-Modified: ([^\r]*)\r/i", $headers ,$temp)) {
			$date_modif = $temp[1];
		}
		else {
			$date_modif = '';
		}
		
		if ($format == true) {
			if (empty($date_modif)) {
				return 0;
			}
			else {
				return strtotime($date_modif);
			}
		}
		else {
			return $date_modif;
		}
	}
	
	/*
	** date de modification avec fsockopen 
	*/
	function get_last_modified($url = '', $format = true) {
		
		$url_array = parse_url($url);
		$host = $url_array['host'];
		$path = $url_array['path'];
		
		if (empty($url) or empty($host) or empty($path)) {
			return false;
		}
		$fp = @fsockopen($host, 80);
		if (!$fp) {
		   return false;
		}
		
		$out = 'HEAD '.$path.' HTTP/1.1'."\r\n".
			'Host: '.$host."\r\n".
			'Connection: Close'."\r\n\r\n";
		
		$lines = '';
		fwrite($fp, $out);
		while (!feof($fp)) {
			$lines .= fgets($fp, 1024);
		}
		fclose($fp);
		
		if (empty($lines)) {
			return false;
		}
		else {
			return $this -> header_last_modified($lines, $format);
		}
	}// fin gest_last_modified
	
	/*
	** date de modification avec bibliotheque curl 
	*/
	function curl_get_last_modified($url = '', $format = true) {
		if (empty ($url)) {
			return false;
		}
		$ch = curl_init($url);
		// curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$lines = curl_exec ($ch);
		curl_close ($ch);
		
		if (empty($lines)) {
			return false;
		}
		else {
			return $this -> header_last_modified($lines, $format);
		}
	}
	
	/*
	** analyse le flux
	function parse_data($data, $max_item = 0)
		if (preg_match('/encoding="([^"]*)"/i', $data ,$temp)) {
			$this -> rss_encoding = strtolower($temp[1]);
		}
		
		// remplacement eventuel
		if (!empty($this -> to_replace) and !empty($this -> replace_with)) {
			$data = str_replace($this -> to_replace, $this -> replace_with, $data);
		}

		$xml_parser = xml_parser_create();
		xml_parse_into_struct($xml_parser, $data, $vals);
		
		$parent = array();
		$n_item = 0;
		// RSS ou FEED
		$fil_type = $vals[0]['tag'];
		// $vals = tableau associatif d�termin� par la structure du fil
		//print_r($vals);
			// $row = tableau associatif correspondant � une ligne de $vals
			// 4 indices : tag, type, level, value
			foreach ($row as $key => $val) {
				${$key} = $val;
			}
			
			$tag = strtolower($tag);
			
			switch ($type) {	
			case 'open' :
				$parent[$level] = $tag ;
				if (($tag == 'item') or ($tag == 'entry')) {
					$n_item++;
				}
			break;
			
			case 'close' :
				if ($parent[$level] == $tag) {
					$parent[$level] = '';
				}
			break;
			
			case 'complete' :
				// cas specifiques � atom
				if (($fil_type == 'FEED') and ($tag == 'link')) {
					$value = $attributes['HREF'];
				}
				
				if (($fil_type == 'FEED') and ($tag == 'category')) {
					$value = $attributes['label'];
				}
				// cas non sp�cifiques
				if ($this -> mode_agrege) {
				switch ($tag) {
					case 'dc:subject' :
						$tag = 'category';
					break;
					
					case 'date':
					case 'dc:date':
					case 'published':
					case 'issued':
						$tag = 'pubdate';
					break;
					
					case 'updated':
						$tag = 'modified';
					break;
					
					case 'dc:description':
					case 'summary':
					case 'content:encoded':
						$tag = 'description';
					break;
					
					case 'dc:rights':
					
					case 'dc:creator':
				} // fin switch
				} // fin if mode agrege
				
				switch ($parent[$level - 1]) {
					case 'feed':
					case 'channel':
						$this -> rss_channel[$tag] = $value;
					break;
					
					case 'entry':
					case 'item':
						if(($n_item <= $max_item) or ($max_item == 0)) {
							$this -> rss_items[$n_item - 1][$tag] = $value;
						}
					break;
					
					case 'image':
						$this -> rss_image[$tag] = $value;
					break;
					
					case 'textinput':
						$this -> rss_textinput[$tag] = $value;
					break;
				} // fin switch $parent
			break;
			} // fin switch $type
		} // fin foreach
		
		xml_parser_free($xml_parser);
	/*
	** ouvrir et lire le flux avec fopen
	*/
	function parsefile($filename, $max_item = 0) {
		if(!$fp = @fopen($filename, 'r')) {
		
		// ou php >= 4.3
		
		if (empty($lines)) {
			return false;
		}
		else {
			$this -> parse_data($lines, $max_item, $mode);
			return true;
		}
	} // fin parsefile
	
	/*
	** ouvrir et lire le flux avec bibliotheque curl
	*/
	function curl_parsefile($filename ='', $max_item = 0) {
		if (empty($filename)) {
			return false;
		}
		
		$lines = '';
		$ch = curl_init($filename);
		// curl_setopt($ch, CURLOPT_URL, $filename);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$lines = curl_exec ($ch);
		curl_close ($ch);

		if (empty($lines)) {
			return false;
		}
		else {
			$this -> parse_data($lines, $max_item, $mode);
			return true;
		}
	} // fin curl_parsefile

	
	function get_encoding() {
	