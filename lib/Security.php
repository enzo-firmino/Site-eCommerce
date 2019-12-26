<?php
class Security {

	private static $seed = 'CAWVAOK0N8';

	function chiffrer($texte_en_clair) {
		$texte_inter = self::$seed . $texte_en_clair;
  		$texte_chiffre = hash('sha256', $texte_inter);
  		return $texte_chiffre;
	}

	static public function getSeed() {
   		return self::$seed;
	}

	public function generateRandomHex() {
  		// Generate a 32 digits hexadecimal number
  		$numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
  		$bytes = openssl_random_pseudo_bytes($numbytes); 
  		$hex   = bin2hex($bytes);
  		return $hex;
	}
	
}
?>