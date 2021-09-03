<?php
    
	
	
	
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://connect.squareupsandbox.com/v2/payments');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n    \"amount_money\": {\n      \"currency\": \"USD\",\n      \"amount\": ".$_POST["name"]."\n    },\n    \"idempotency_key\": \"".uniqid('', true)."\",\n    \"source_id\": \"cnon:card-nonce-ok\"\n  }");

	$headers = array();
	$headers[] = 'Square-Version: 2021-08-18';
	$headers[] = 'Authorization: Bearer EAAAEMcwm0zg-bCbyUyAONTRKy_8WfEoN5vVPuZzY1D56uhrlH8VZpdnHdNFK8FB';
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
?>