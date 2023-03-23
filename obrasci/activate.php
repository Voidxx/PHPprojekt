<?php
	require_once("../config.php");

        
        
        
        
	if(!empty($_GET["id"])) {
	$query = "UPDATE WebDiP2020x080.korisnik SET aktiviran= 'Da' WHERE korisnik_id='" . $_GET["id"]. "'";
	$result = $db->prepare($query);
        $result->execute();
		if($result) {
			echo "Your account is activated.";
                        
		} else {
			echo "Problem in account activation.";
		}
	}
?>