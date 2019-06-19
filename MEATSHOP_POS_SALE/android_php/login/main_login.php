<?php
	
	$include_connect = "../connection.php";
	
	$function = filter_input(INPUT_POST,"function");
	
	//loginFunction
	$login_username = filter_input(INPUT_POST,"username");
	$login_password = filter_input(INPUT_POST,"password");
	
	
	//getUserData Function
	$get_username	= filter_input(INPUT_POST,"get_username");
	
	
	
	switch($function){
		case "loginUser":
			loginUser($include_connect,$login_username,$login_password);
		break;
		
		case "getUserData":
			getUserData($include_connect,$get_username);
		break;
		
		
		DEFAULT:
			echo "No Function";
		break;
	}

	
	//fucntion for validating user account
	function loginUser($include_connect,$login_username,$login_password){
		include($include_connect);
		
		//Verify User if exists
		$verifyUser = mysqli_query($connect,"select * from users where (username = '$login_username' and password = '$login_password')")
		or die ("Bad Query VerifyUser");
		if($verifyUser){
			if(mysqli_num_rows($verifyUser)>0){
				while($row=mysqli_fetch_assoc($verifyUser)){
					echo $row["username"];
				}
			}else{
				echo "user_not_exists";
			}
		}else{
			echo "failed";
		}
	}
	
	//function for getting the userid for session id
	function getUserData($include_connect,$get_username){
		include($include_connect);
		
		//query data to retrieve the id
		$getUserData = mysqli_query($connect,"SELECT * from users where username = '$get_username'") or die("BAd Qery getUserData");
		if($getUserData){
			while($row = mysqli_fetch_assoc($getUserData)){
				echo $row["username"];
			}
		}else{
			echo "failed";
		}
	}

?>