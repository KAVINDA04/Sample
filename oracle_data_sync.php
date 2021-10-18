<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set('Asia/Colombo');

    $conn = mysqli_connect('localhost', 'root', 'passw0rd', 'phonikip_db');
	//$conn = '';
	if(!$conn){
		die('Not connect'.mysqli_error());
	}
		try {
    		    $dbh = new PDO('oci:dbname=abl-scan.amanabank.int:1528/imalprod', 'iphonik_user', 'iphk_21aBl');
    		   
			try {
 			    
     			$cur_date = date('Y-m-d');
 				$to_date  = date('d-m-Y', strtotime($cur_date. ' -1 day'));

     			$log_sql = "SELECT * FROM tbl_imal_cusinfo_sync_log ORDER BY id DESC LIMIT 1";
     			$log_data_sql = $conn->query($log_sql);
     			$row_log_data = $log_data_sql->FETCH_ASSOC();

     			$inserted_log = $row_log_data["total_inserted"];
     			$updated_log  = $row_log_data["total_updated"];

     			if (($inserted_log === '0') && ($updated_log === '0')) {
     				$from_date  = date('d-m-Y', strtotime($cur_date. ' -2 day'));
     			}else{
     				$from_date  = date('d-m-Y', strtotime($cur_date. ' -1 day'));
     			}


				$insert = $dbh->prepare("select * from table(pgmis_registered_cif.fmis_new_registered_cif_new(vFromDate_in =>to_date('".$from_date." 00:00:00','dd-mm-rrrr hh24:mi:ss'),vToDate_in =>to_date('".$to_date." 23:59:59','dd-mm-rrrr hh24:mi:ss') ))");
     			    
     			    $insert->execute();

			    	$insert_results = $insert->fetchAll(PDO::FETCH_ASSOC);
			    	$insert_count   = count($insert_results);
			    	//echo "oracle insert :".$insert_count;
			    	

			    $update = $dbh->prepare("select * from table(pgmis_registered_cif.fmis_new_updated_cif_new(vFromDate_in =>to_date('".$from_date." 00:00:00','dd-mm-rrrr hh24:mi:ss'),vToDate_in =>to_date('".$to_date." 23:59:59','dd-mm-rrrr hh24:mi:ss') ))");
     			    
     			    $update->execute();

			    	$update_results = $update->fetchAll(PDO::FETCH_ASSOC);
			    	$update_count   = count($update_results);
			    	//echo "oracle update :".$update_count;

			    	$total = $insert_count + $update_count;
			    	//echo "oracle total :".$total;

			    	$inserted = 0;
			    	$not_inserted = 0;
			    	$updated  = 0;
			    	$not_updated  = 0;


			    	foreach ($insert_results as $result) {
			    	
			    		//var_dump($result["SALUTATION"]);

			    		
				    	$Title             = addslashes($result["SALUTATION"]);
	                    $Customer_CIF      = addslashes($result["CIF"]);
	                    $CIF_Type          = addslashes($result["CIF_TYPE"]);
	                    $Primary_NIC       = addslashes($result["ID_NUMBER"]);
	                    $Branch            = addslashes($result["CIF_BRANCH"]);
	                    $DOB               = addslashes($result["BIRTHDATE"]);
	                    $Long_Name         = addslashes($result["CIF_NAME"]);
	                    $Home_Number       = addslashes($result["TPH_NUMBER"]);
	                    $Work_Number       = addslashes($result["WORK_NUMBER"]);
	                    $Mobile_Number     = addslashes($result["MOBILE_NUMBER"]);
	                    $Email             = addslashes($result["EMAIL"]);
	                    $Add_ln1           = addslashes($result["ADDRESS1"]);
	                    $Add_ln2           = addslashes($result["ADDRESS2"]);
	                    $Add_ln3           = addslashes($result["ADDRESS3"]);
	                    $City              = addslashes($result["CIF_BRANCH"]);
	                    $Rec_Type          = "N";

			    		if (!empty($Customer_CIF && $Primary_NIC && $Home_Number)) {

			    			if (strlen($Primary_NIC) > 9) {

			    				$sql = 'INSERT INTO tbl_imal_cusinfo_sync (Title, Customer_CIF, CIF_Type, Primary_NIC, Branch, DOB, Long_Name, Home_Number, Work_Number, Mobile_Number, Email, Add_ln1, Add_ln2, Add_ln3, City, Rec_Type) VALUES ("'.$Title.'", "'.$Customer_CIF.'", "'.$CIF_Type.'", "'.$Primary_NIC.'", "'.$Branch.'", "'.$DOB.'", "'.$Long_Name.'", "'.$Home_Number.'", "'.$Work_Number.'", "'.$Mobile_Number.'", "'.$Email.'", "'.$Add_ln1.'", "'.$Add_ln2.'", "'.$Add_ln3.'", "'.$City.'", "'.$Rec_Type.'")';

					    		if ($conn->query($sql)) {
					    			//echo "New inserted successfully";
					    			$inserted++;
					    		}
					    		else{
					    			//echo "Error".$sql;
					    			$not_inserted++;
					    		}			    				
			    			}			    				
			    		}
			    	}
			    	$total_inserted = $inserted;
			    	$total_not_inserted = $not_inserted;
			    	//echo "total inserted :".$total_inserted;
			    	//echo "total not inserted :".$total_not_inserted;

			    	foreach ($update_results as $result) {

			    		$Title             = addslashes($result["SALUTATION"]);
	                    $Customer_CIF      = addslashes($result["CIF"]);
	                    $CIF_Type          = addslashes($result["CIF_TYPE"]);
	                    $Primary_NIC       = addslashes($result["ID_NUMBER"]);
	                    $Branch            = addslashes($result["CIF_BRANCH"]);
	                    $DOB               = addslashes($result["BIRTHDATE"]);
	                    $Long_Name         = addslashes($result["CIF_NAME"]);
	                    $Home_Number       = addslashes($result["TPH_NUMBER"]);
	                    $Work_Number       = addslashes($result["WORK_NUMBER"]);
	                    $Mobile_Number     = addslashes($result["MOBILE_NUMBER"]);
	                    $Email             = addslashes($result["EMAIL"]);
	                    $Add_ln1           = addslashes($result["ADDRESS1"]);
	                    $Add_ln2           = addslashes($result["ADDRESS2"]);
	                    $Add_ln3           = addslashes($result["ADDRESS3"]);
	                    $City              = addslashes($result["CIF_BRANCH"]);
	                    $Rec_Type          = "U";

			    		if (!empty($Customer_CIF && $Primary_NIC && $Home_Number)) {

			    			if (strlen($Primary_NIC) > 9) {

			    				$sql = 'INSERT INTO tbl_imal_cusinfo_sync (Title, Customer_CIF, CIF_Type, Primary_NIC, Branch, DOB, Long_Name, Home_Number, Work_Number, Mobile_Number, Email, Add_ln1, Add_ln2, Add_ln3, City, Rec_Type) VALUES ("'.$Title.'", "'.$Customer_CIF.'", "'.$CIF_Type.'", "'.$Primary_NIC.'", "'.$Branch.'", "'.$DOB.'", "'.$Long_Name.'", "'.$Home_Number.'", "'.$Work_Number.'", "'.$Mobile_Number.'", "'.$Email.'", "'.$Add_ln1.'", "'.$Add_ln2.'", "'.$Add_ln3.'", "'.$City.'", "'.$Rec_Type.'")';

					    		if ($conn->query($sql)) {
					    			//echo "Update inserted successfully";
					    			$updated++;
					    		}
					    		else{
					    			//echo "Error".$sql;
					    			$not_updated++;
					    		}			    				
			    			}				    		
				    	}			    		
			    	}
			    	$total_updated = $updated;
			    	$total_not_updated = $not_updated;
					//echo "total updated :".$total_updated;
			    	//echo "total not updated :".$total_not_updated;

			    	/*$file = fopen("Amana_oracle_data_function_04.csv", "w");

			    	$columns = "CIF_CREATED_DATE, CIF_UPDATED_DATE, CIF, SALUTATION, CIF_NAME, BIRTHDATE, ID_NUMBER, TPH_NUMBER, MOBILE_NUMBER, WORK_NUMBER, HOME_NUMBER, OTHER_NUMBER, ADDRESS1, ADDRESS2, ADDRESS3, CIF_TYPE, CIF_BRANCH, EMAIL\n";

			    	foreach ($results as $value) {
			    		
			    			$columns .=$value['CIF_CREATED_DATE'].",";
			    			$columns .=$value['CIF_UPDATED_DATE'].",";
			    			$columns .=$value['CIF'].",";
			    			$columns .=$value['SALUTATION'].",";
			    			$columns .=$value['CIF_NAME'].",";
			    			$columns .=$value['BIRTHDATE'].",";
			    			$columns .=$value['ID_NUMBER'].",";
			    			$columns .=$value['TPH_NUMBER'].",";
			    			$columns .=$value['MOBILE_NUMBER'].",";
			    			$columns .=$value['WORK_NUMBER'].",";
			    			$columns .=$value['HOME_NUMBER'].",";
			    			$columns .=$value['OTHER_NUMBER'].",";
			    			$columns .=$value['ADDRESS1'].",";
			    			$columns .=$value['ADDRESS2'].",";
			    			$columns .=$value['ADDRESS3'].",";
			    			$columns .=$value['CIF_TYPE'].",";
			    			$columns .=$value['CIF_BRANCH'].",";
			    			$columns .=$value['EMAIL'].",";

			    			$columns .="\n";
			    		
			    	}

			    	fwrite($file, $columns);

			    	fclose($file);*/

			    	$sql_log = 'INSERT INTO tbl_imal_cusinfo_sync_log (oracle_fetched, oracle_new, oracle_update, total_inserted, total_updated, cre_datetime) VALUES ("'.$total.'", "'.$insert_count.'", "'.$update_count.'", "'.$total_inserted.'", "'.$total_updated.'", "'.date('Y-m-d H:i:s').'")';

			    	$conn->query($sql_log);
	  	    }
			catch (PDOException $e) {

				//$sync_error =  'SQL Query Failed' . $e->getMessage();
			    //$sync_error =  'SQL Query Failed';

			    exit;
			}
	    } 
		catch (PDOException $e) {

			$sync_error = $e->getMessage();
		    //$sync_error = 'Oracle Connection Failed';
		    $sql_error = 'INSERT INTO tbl_imal_cusinfo_sync_log (sync_error, cre_datetime) VALUES ("'.$sync_error.'", "'.date('Y-m-d H:i:s').'")';
		    $conn->query($sql_error);
  		    exit;
		}
?>
