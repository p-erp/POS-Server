<?php
	
	header("Content-type: text/html; charset=utf-8");
	
	//database connection
	$include_connect ="../../connection.php";
	
	//function declaration
	$function = filter_input(INPUT_POST,"function");
		
	//object declaration for 
	$get_receiptID = filter_input(INPUT_POST,"getReceipt_ID");
	
	//object declaration for receipt_delete
	$del_deviceID = filter_input(INPUT_POST,"del_deviceID");
	
	
	//switch cases for function
	switch($function){
	
		case "get_receiptItem":
			get_receiptItem($include_connect,$get_receiptID);
		break;
		
		case "deleteFrom_rcpt":
			deleteFrom_rcpt($include_connect,$del_deviceID);	
		break;
	
		DEFAULT:
			echo "No Function";
		break;
	}
	

	//ALL FUNCTIONS
	function get_receiptItem($include_connect,$get_receiptID){
		include($include_connect);
		
		//query receipt item
		$getReceipt_item = mysqli_query($connect,"SELECT receipt_id,receipt_date,receipt_inChange,
													receipt_deviceID,
													receipt_itemName,
													receipt_itemPrice,
													receipt_itemQuantity,
													receipt_itemTotal,
													sum(receipt_itemTotal) as 'total' FROM receipts where receipt_deviceID = '$get_receiptID'") or die("Bad Query getReceipt_item");
		if($getReceipt_item){
			$data = array();
			while($row = mysqli_fetch_assoc($getReceipt_item)){
				$data[] = array(
					"receipt_id" 		=> $row["receipt_id"],
					"receipt_date" 		=> $row["receipt_date"],
					"receipt_inCharge"	=> $row["receipt_inChange"],
					"receipt_deviceID"	=> $row["receipt_deviceID"],
					"receipt_itemName"	=> $row["receipt_itemName"],
					"receipt_itemPrice"	=> $row["receipt_itemPrice"],
					"receipt_itemQuantity" => $row["receipt_itemQuantity"],
					"receipt_itemTotal"	=> $row["receipt_itemTotal"],
					"receipt_sumTotal"	=> $row["total"]
				);
			}
			$result["receipt_data"] = $data;
			echo json_encode($result);
			mysqli_close($connect);
		}else{
			echo "failed";
		}
		
		
	}
	
	//delete from receipt
	function deleteFrom_rcpt($include_connect,$del_deviceID){
		include($include_connect);
		
		//query 
		$dlt_fromReceipt = mysqli_query($connect,"DELETE FROM receipts where receipt_deviceID = '$del_deviceID'") or die("Bad Query dlt_fromReceipt");
		if($dlt_fromReceipt){
			echo "success";
		}else{
			echo "failed";
		}
		
	}
	
	
	
	
?>