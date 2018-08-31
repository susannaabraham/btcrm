<?php 

		$ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL,"http://192.168.56.101/json.php");
        curl_setopt($ch, CURLOPT_URL,"http://172.16.15.12/Customer/getCustomer");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($ch);
        curl_close($ch);
        $a=json_decode($output);



?>