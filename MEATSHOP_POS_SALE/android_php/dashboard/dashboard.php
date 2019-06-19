<?php
	
	header("Content-type: text/html; charset=utf-8");
	
	//database connection
	$include_connect ="../connection.php";
	
	//function declaration
	$function = filter_input(INPUT_POST,"function");
		
	//object declaration

	
	
	//switch cases for function
	switch($function){
			
		case "getSales_data":
			getSales_data($include_connect);
		break;
	
		DEFAULT:
			echo "No Function";
		break;
	}
	

	//ALL FUNCTIONS
	//getsales data
	function getSales_data($include_connect){
		include($include_connect);
		
		$getSales_data = mysqli_query($connect,"SELECT * FROM sales") or die("Bad Query getSales_Data");
		if($getSales_data){
			$sum = 0;
			while($row = mysqli_fetch_assoc($getSales_data)){
				$sum = $sum + $row["sales_item_total"];
			}
			echo $sum;
		}else{
			echo "failed";
		}
		
	}
	
	
	
?>