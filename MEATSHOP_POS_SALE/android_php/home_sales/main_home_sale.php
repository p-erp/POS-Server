<?php
	$include_connect ="../connection.php";
	
	//declaration for function
	$function = filter_input(INPUT_POST,"function");
	
	
	//modules for getUserData
	$get_username = filter_input(INPUT_POST,"get_username");
	
	
	/// switches for function
	switch($function){
		
		case "getUserData":
			getUserData($include_connect,$get_username);
		break;
		
		DEFAULT:
			echo "No Function";
		break;
	}

	
	//ALL FUNCTIONS
	function getUserData($include_connect,$get_username){
		include($include_connect);
		
		echo "from var ".$get_username." ";
		
		//getUserData for navigation drawaer info
		$getUserData = mysqli_query($connect, "SELECT * FROM users where username = '$get_username'") or die("Bad Query GetUserData");
		if($getUserData){
				
				echo "<br><br>";
				
				
				
				if(mysqli_num_rows($getUserData)>0){
					
				}else{
				echo " No Value For [select * from users where username =".$get_username."] ";
				}
				
				/*
				$data = array();
					while($row=mysqli_fetch_assoc($getUserData)){
						$data[] = array(
							"user_id"		 => $row["user_id"],
							"first_name" 	 => $row["first_name"],
							"last_name"	 	 => $row["last_name"],
							"age"		 	 => $row["age"],
							"contact_number" => $row["contact_number"],
							"address"		 => $row["address"]
						);
					}
					$result["user_data"] = $data;
					echo json_encode($result);
					mysqli_close($connect);
					*/
						
		}else{
			echo "failed";
		}
		
		
	}
	
	
?>