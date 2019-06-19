<?php
	
	$include_connect = "../connection.php";
	
	$function = filter_input(INPUT_POST,"function");
	
	//register
	$reg_first_name 	= filter_input(INPUT_POST,"first_name");
	$reg_last_name 		= filter_input(INPUT_POST,"last_name");
	$reg_age 			= filter_input(INPUT_POST,"age");
	$reg_contact_number = filter_input(INPUT_POST,"contact_number");
	$reg_address 		= filter_input(INPUT_POST,"address");
	$reg_username 		= filter_input(INPUT_POST,"username");
	$reg_password		= filter_input(INPUT_POST,"password");
	
	
	switch($function){
		case "insertNewUser":
			VerifyNewUser($include_connect,$reg_first_name,$reg_last_name,$reg_age,$reg_contact_number,$reg_address,$reg_username,$reg_password);
		break;
		
		
		DEFAULT:
			echo "No Function";
		break;
	}


	function VerifyNewUser($include_connect,$reg_first_name,$reg_last_name,$reg_age,$reg_contact_number,$reg_address,$reg_username,$reg_password){
		include($include_connect);
		
		$isUserExists = mysqli_query($connect,"SELECT * FROM users where (username ='$reg_username' and password = '$reg_password')") or die("Bad Query isUserExists");
		if($isUserExists){
			if(mysqli_num_rows($isUserExists)>0){
				echo "userExists";
			}else{
				insertUser($include_connect,$reg_first_name,$reg_last_name,$reg_age,$reg_contact_number,$reg_address,$reg_username,$reg_password);
			}
		}else{
			echo "failed";
		}
	}
	
	function insertUser($include_connect,$reg_first_name,$reg_last_name,$reg_age,$reg_contact_number,$reg_address,$reg_username,$reg_password){
		include($include_connect);
		
		$insertUser = mysqli_query($connect,"INSERT INTO users (first_name,last_name,age,contact_number,address,username,password) 
											values 
											('$reg_first_name',
											'$reg_last_name',
											'$reg_age',
											'$reg_contact_number',
											'$reg_address',
											'$reg_username',
											'$reg_password')") or die("Bad Query insertUser");
		if($insertUser){
			echo "success";
		}else{
			echo "failed";
		}
		
	}
	

?>