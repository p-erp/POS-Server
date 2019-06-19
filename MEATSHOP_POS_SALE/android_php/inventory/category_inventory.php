<?php

	//declaration for database connection
	$include_connect ="../connection.php";
	
	//declaration for function_exists
	$function = filter_input(INPUT_POST,"function");
	
	//object declaration
	$addCat_name	= filter_input(INPUT_POST,"addCat_name");
	
	
	
	//switch function
	switch($function){
		
		case "addCategory":
			addCategory($include_connect,$addCat_name);
		break;
		
		DEFAULT:
			echo "No Function";
		break;
	}
	
	
	
	//ALL FUNCTIONS
	function addCategory($include_connect,$addCat_name){
		include($include_connect);
		
		//verify if category exists
		$ifExists = mysqli_query($connect,"select * from categories where category_name = '$addCat_name'") or die("Bad Query addCategory IfExists");
		
		//validate if will return true
		if($ifExists){
			if(mysqli_num_rows($ifExists)>0){
				echo "category_exists";
			}else{
				if_categoryVerified($include_connect,$addCat_name);
			}
		}else{
			echo "failed";
		}
	}
	
	//function for category if verified
	function if_categoryVerified($include_connect,$addCat_name){
		include($include_connect);
		
		$addCategory = mysqli_query($connect,"INSERT INTO categories (category_name,category_added) values ('$addCat_name','sample')") or die("Bad Query addCategory");
		
		if($addCategory){
			echo "success";
		}else{
			echo "failed";
		}
	}
	


?>