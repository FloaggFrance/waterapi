<?php
/*
 * -------------------- PHP -- WaterAPI -------------------- 
 * --------------------------------------------------------- 
 * ----- Mars 2023 ------------ Julie Crispin -------------- 
 * --------------------------------------------------------- 
 * --------------------------------------------------------- 
 */
class water_api {
	private $adress = "https://works.floagg.org/waterapi/[key_api]/";
	private $reponse = null; // Format TEXT

	public $body = null; // Formatage OBJECT 
	public $error = null;

	function __construct($Call, array $POST = []) {
		$this->adress .= $Call;

		$HTTPBuild = http_build_query($POST); // transformer la requette POST en requette HTTP
		$headerHTTP = array("http"=>
			array(
				"method" => "POST",
				"header" =>	'Content-Type: application/x-www-form-urlencoded',
				'content' => $HTTPBuild
			)
		);
		$context  = stream_context_create($headerHTTP);
		$this->reponse = file_get_contents($this->adress, false, $context);
	}

	public function parse() {
		if($HTTP = json_decode($this->reponse)) { // Transformer le retour JSON en Object PHP.
			if(isset($HTTP->body)) {
				$this->body; // recuperré les donnée, de retoure
			}

			if(isset($HTTP->header->ERROR) && $HTTP->header->ERROR == true) { // verifier si il y as pas d'erreur.
				$this->error = true;
			}
		}
	}
}