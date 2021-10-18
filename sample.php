<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $dbh = new PDO('oci:dbname=192.168.8.226/XE', 'ORACLE', 'oracle');
    //var_dump($dbh);
	try {
	    $s = $dbh->prepare("select * from oracle.amanabank");
	    $s->execute();

	    $results =  $s->fetchAll(PDO::FETCH_ASSOC);

	    $conn = mysqli_connect('192.168.8.226', 'root', 'root', 'crud');

		if($conn->connect_error){
			die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);
		}

	    foreach ($results as $result){

			$title             = $result["SALUTATION"];
			$customer_cif      = $result["CIF"];
			$cif_type          = $result["CIF_TYPE"];
			$primary_nic       = $result["ID_NUMBER"];
			$branch            = $result["CIF_BRANCH"];
			$dob               = $result["BIRTHDATE"];
			$long_name         = $result["CIF_NAME"];
			$home_number       = $result["TPH_NUMBER"];
			$work_number       = $result["WORK_NUMBER"];
			$mobile_number     = $result["MOBILE_NUMBER"];
			$email             = $result["EMAIL"];
			$add_ln1           = $result["ADDRESS1"];
			$add_ln2           = $result["ADDRESS2"];
			$add_ln3           = $result["ADDRESS3"];
			$city              = $result["CIF_BRANCH"];
			$rec_type          = 'N';


			$sql = "INSERT INTO list (title, customer_cif, cif_type, primary_nic, branch, dob, long_name, home_number, work_number, mobile_number, email, add_ln1, add_ln2, add_ln3, city, rec_type) VALUES ('$title', '$customer_cif', '$cif_type', '$primary_nic', '$branch', '$dob', '$long_name', '$home_number', '$work_number', '$mobile_number', '$email', '$add_ln1', '$add_ln2', '$add_ln3', '$city', '$rec_type')";

			if($conn->query($sql)){
				echo 'Data inserted successfully';
			}
			else{
				echo 'Error '.$conn->error;
			}
		}


	}
	catch (PDOException $e) 
	{
	    echo 'Connection failed: ' . $e->getMessage();
	    exit;
	}
  } 
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

	

?>
