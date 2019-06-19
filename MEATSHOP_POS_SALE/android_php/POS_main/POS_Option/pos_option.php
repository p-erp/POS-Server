<?php
	
	header("Content-type: text/html; charset=utf-8");
	
	//database connection
	$include_connect ="../../connection.php";
	
	//function declaration
	$function = filter_input(INPUT_POST,"function");
		
	$save_capitalValue = filter_input(INPUT_POST,"save_capitalValue");
	$save_capitalMonth = filter_input(INPUT_POST,"save_capitalMonth");
	
	//switch cases for function
	switch($function){
	
		case "saveCapital":
			saveCapital($include_connect,$save_capitalValue,$save_capitalMonth);
		break;
	
		DEFAULT:
			echo "No Function";
		break;
	}
	

	//ALL FUNCTIONS
	
	//Save the monthly Capital
	function saveCapital($include_connect,$save_capitalValue,$save_capitalMonth){
		include($include_connect);
		
		
		//Verify if capital exists
		$ifMonth_exists = mysqli_query($connect,"SELECT * from monthly_capital where month = '$save_capitalMonth'") or die("Bad Query ifMonth_exists");
		if($ifMonth_exists){
			if(mysqli_num_rows($ifMonth_exists)>0){
				echo "exists";
			}else{
				//if Verified
				ifVerified($include_connect,$save_capitalValue,$save_capitalMonth);
			}
		}else{
			echo "failed";
		}
	
	}
	
	function ifVerified($include_connect,$save_capitalValue,$save_capitalMonth){
		include($include_connect);
		
		//Store value
		$onCapitalSave = mysqli_query($connect,"INSERT INTO monthly_capital (month,capital_month) values ('$save_capitalMonth','$save_capitalValue')") or die("Bad Query onCapitalSave");
		if($onCapitalSave){
			echo "success";
		}else{
			echo "failed";
		}
		
	}
	
	
?>