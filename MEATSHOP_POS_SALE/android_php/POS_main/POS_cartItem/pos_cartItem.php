<?php
	
	header("Content-type: text/html; charset=utf-8");
	
	//database connection
	$include_connect ="../../connection.php";
	
	//function declaration
	$function = filter_input(INPUT_POST,"function");
		
	
	//declaration for insert item to cart
	$ins_customerId 	= filter_input(INPUT_POST,"ins_customerId");
	$ins_itemName 		= filter_input(INPUT_POST,"ins_itemName");
	$ins_itemQuantity 	= filter_input(INPUT_POST,"ins_itemQuantity");
	$ins_itemPrice 		= filter_input(INPUT_POST,"ins_itemPrice");
	
	//declaration for getCartList
	$get_cartCustomerId = filter_input(INPUT_POST,"get_cartCustomerId");
	
	
	//declration for get cart item for edit cart
	$get_cartItem = filter_input(INPUT_POST,"get_cartItem");
	
	
	//Declaration for delete item_name
	$onDeleteItem_name = filter_input(INPUT_POST,"onDeleteItem_name");
	$onDeleteItem_customerID = filter_input(INPUT_POST,"onDeleteItem_customerID");
	
	
	//Declaration for updateItem
	$onUpdate_itemName 		= filter_input(INPUT_POST,"onUpdate_itemName");
	$onUpdate_itemQuantity 	= filter_input(INPUT_POST,"onUpdate_itemQuantity");
	$onUpdate_customerId 	= filter_input(INPUT_POST,"onUpdate_customerId");
	
	
	//switch cases for function
	switch($function){
		
		case "insertToCart":
			insertToCart($include_connect,$ins_customerId,$ins_itemName,$ins_itemQuantity,$ins_itemPrice);
		break;
		
		case "getCartList":
			getCartList($include_connect,$get_cartCustomerId);
		break;
		
		case "getCartItem":
			getCartItem($include_connect,$get_cartItem);
		break;
		
		case "deleteItem":
			onDeleteItem_name($include_connect,$onDeleteItem_name,$onDeleteItem_customerID);
		break;
		
		case "updateItem":
			updateItem($include_connect,$onUpdate_itemName,$onUpdate_itemQuantity,$onUpdate_customerId);
		break;
		
		DEFAULT:
			echo "No Function";
		break;
	}
	
	

	//ALL FUNCTIONS
	function insertToCart($include_connect,$ins_customerId,$ins_itemName,$ins_itemQuantity,$ins_itemPrice){
		include($include_connect);
		
		//verify if item is already exists
		$ifItemExists = mysqli_query($connect,"SELECT * from temp_cart where item_name = '$ins_itemName'") or die("Bad Query ifItemExists insertToCart");
		if($ifItemExists){
			
			$quantity = 1;
				
			if(mysqli_num_rows($ifItemExists)>0){
				while($row = mysqli_fetch_assoc($ifItemExists)){
					$num = (double) $row["item_quantity"];
					
				}
				$quantity = $quantity + $num;
				
				///if Item exists (update item quantity)
				$exists = "exists";
				insertToCartVerified($include_connect,$ins_customerId,$ins_itemName,$quantity,$ins_itemPrice,$exists);
			}else{
				//If item not exists (Insert data)
				$exists = "not_exists";
				insertToCartVerified($include_connect,$ins_customerId,$ins_itemName,$ins_itemQuantity,$ins_itemPrice,$exists);
			}
		}else{
			echo "failed";
		}
	}
	
	
	//Insert to temporary cart
	function insertToCartVerified($include_connect,$ins_customer_id,$ins_itemName,$ins_itemQuantity,$ins_itemPrice,$exists){
		include($include_connect);
		
		//Check if value is exists
		switch($exists){
			
			//Insert to item cart meaning the data is new
			case "exists":
					$insertToItemCart = mysqli_query($connect,"UPDATE temp_cart SET item_quantity = '$ins_itemQuantity' where item_name ='$ins_itemName'") 
															or die("Bad Query insertTOItemQuery");
					if($insertToItemCart){
						echo "success exists";
					}else{
						echo "failed";
					}
			break;
			
			//Update price tag meaning the item already exists and need to double the value of price
			case "not_exists":
				$insertToItemCart = mysqli_query($connect,"INSERT INTO temp_cart 
															(customer_id,item_name,item_quantity,item_price) values 
															('$ins_customer_id','$ins_itemName','$ins_itemQuantity','$ins_itemPrice')") 
															or die("Bad Query insertTOItemQuery");
					if($insertToItemCart){
						echo "success not exists";
					}else{
						echo "failed";
					}
			break;
			
		}
		
		
	}
	
	//Function for getCartList
	function getCartList($include_connect,$get_cartCustomerId){
		include($include_connect);
		
		//get the cart item list
		$getCartList = mysqli_query($connect,"Select * from temp_cart where customer_id = '$get_cartCustomerId'") or die("Bad Query getCartlist");
		if($getCartList){
			$data = array();
				while($row = mysqli_fetch_assoc($getCartList)){
					$data[] = array(
						"cart_id" 		=> $row["cart_id"],
						"customer_id" 	=> $row["customer_id"],
						"item_name"		=> $row["item_name"],
						"item_quantity"	=> $row["item_quantity"],
						"item_price"	=> $row["item_price"],
						"item_image"	=> $row["item_image"]
					);
				}
				$result["cart_data"] = $data;
				echo json_encode($result);
				mysqli_close($connect);
		}else{
			echo "failed";
		}
	}
	
	//function for getCart Item for edit cart
	function getCartItem($include_connect,$get_cartItem){
		include($include_connect);
		
		$getCartItem = mysqli_query($connect,"SELECT * FROM temp_cart where cart_id = '$get_cartItem'") or die("Bad Query getCart Item");
		if($getCartItem){
			$data = array();
			while($row=mysqli_fetch_assoc($getCartItem)){
				$data[] = array(
					"item_name" 	=> $row["item_name"],
					"item_quantity" => $row["item_quantity"]
				);
				
			}
			$result["cart_data"] = $data;
			echo json_encode($result);
			mysqli_close($connect);
		}else{
				echo "failed";
		}
		
	}
	
	function onDeleteItem_name($include_connect,$onDeleteItem_name,$onDeleteItem_customerID){
		include($include_connect);
		
		$deleteItem = mysqli_query($connect,"DELETE from temp_cart where (customer_id = '$onDeleteItem_customerID') and
											item_name = '$onDeleteItem_name'") or die("Bad Query Delete Item");
											
		if($deleteItem){
			echo "success";
		}else{
			echo "failed";
		}	
	}
	
	function updateItem($include_connect,$onUpdate_itemName,$onUpdate_itemQuantity,$onUpdate_customerId){
		include($include_connect);
		
		
		$updateItem = mysqli_query($connect, "UPDATE temp_cart SET item_quantity = '$onUpdate_itemQuantity'
												WHERE (item_name = '$onUpdate_itemName') and 
												(customer_id = '$onUpdate_customerId')") or die("Bad Query updateItem");
												
		if($updateItem){
			echo "success";
		}else{
			echo "failed";
		}
		
	}
	
	
	
?>