<?php
	
	header("Content-type: text/html; charset=utf-8");
	
	//database connection
	$include_connect ="../../connection.php";
	
	//function declaration
	$function = filter_input(INPUT_POST,"function");
		
	//object declaration for payment to sales
	$get_salesDay 	= filter_input(INPUT_POST,"sales_day");
	$get_salesMonth = filter_input(INPUT_POST,"sales_month");
	$get_salesYear 	= filter_input(INPUT_POST,"sales_year");
	$get_sales_cart_id = filter_input(INPUT_POST,"cart_id");

	
	
	//switch cases for function
	switch($function){
	
		case "submitPay_toSales":
			submitPay_toSales($include_connect,$get_salesDay,$get_salesMonth,$get_salesYear,$get_sales_cart_id);
		break;
	
		DEFAULT:
			echo "No Function";
		break;
	}
	

	//ALL FUNCTIONS
	//Submit cart(Payment) to sales
	function submitPay_toSales($include_connect,$get_salesDay,$get_salesMonth,$get_salesYear,$get_sales_cart_id){
		include($include_connect);
		
		//object declaration
		//generate date
		$date = date('Y-m-d H:i:s');
		
		//get Item from cart
		$getItem_fromCart = mysqli_query($connect,"select * from temp_cart where customer_id = '$get_sales_cart_id'") or die("Bad Query getItem_fromCart");
		
		if($getItem_fromCart){
			
			while($row = mysqli_fetch_assoc($getItem_fromCart)){
				$customer_id 	= $row["customer_id"];
				$item_name 		= $row["item_name"];
				$item_quantity 	= $row["item_quantity"];
				$item_price 	= $row["item_price"];
				//generate total for quantity and price
				$item_total = $item_quantity * $item_price;
				
				//Insert cart(Payment) to sales
				$insert_toSales  = mysqli_query($connect, "INSERT INTO sales 
															(sales_day,
															sales_month,
															sales_year,
															sales_item_name,
															sales_item_price,
															sales_item_quantity,
															sales_item_total)
															values 
															('$get_salesDay',
															'$get_salesMonth',
															'$get_salesYear',
															'$item_name',
															'$item_price',
															'$item_quantity',
															'$item_total')") or die("Bad Query insert_toSales");
															
															if($insert_toSales){
																
															}else{
																echo "failed";
															}
															
			//Insert from receipt table to ogenerate receipts
			$insert_toReceipts = mysqli_query($connect,"INSERT INTO receipts 
			(receipt_date,
			receipt_inChange,
			receipt_deviceID,
			receipt_itemName,
			receipt_itemPrice,
			receipt_itemQuantity,
			receipt_itemTotal) 
			values 
			('$date','POS_SYSTEM','$get_sales_cart_id','$item_name','$item_price','$item_quantity','$item_total')") or die("Bad Query insert_toReceipts");
			if($insert_toReceipts){
				echo "success";
			}else{
				echo "failed";
			}
			
			//Update Inventory Item
			$getInventory_item = mysqli_query($connect,"SELECT * from inventory where inventory_item_name = '$item_name'") or die("Bad Query getInventory_item");
			if($getInventory_item){
				while($row = mysqli_fetch_assoc($getInventory_item)){
					$getStock = $row["stock"];
					
					$updated_stock = $getStock - $item_quantity;
					
					//update inventory Stock;
					$updateInv_stock = mysqli_query($connect, "UPDATE inventory set stock = '$updated_stock' where inventory_item_name = '$item_name'")
					or die("Bad Query updateInv_stock");
					if($updateInv_stock){
						
						//delete from cart
						$delete_fromCart = mysqli_query($connect, "DELETE FROM temp_cart where customer_id = '$get_sales_cart_id'") or die("Bad Query delete_fromCart");
					}else{
						echo "failed";
					}
				}
			}else{
				echo "failed";
			}
			
			
			
			
			}
		}else{
			echo "failed";
		}
		
	}
	
	
	
	
	
	
?>