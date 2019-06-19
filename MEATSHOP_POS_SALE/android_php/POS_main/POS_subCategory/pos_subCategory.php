<?php
	
	header("Content-type: text/html; charset=utf-8");
	
	//database connection
	$include_connect ="../../connection.php";
	
	//function declaration
	$function = filter_input(INPUT_POST,"function");
	
	
	//Function for category getting the items
	$get_getItem = filter_input(INPUT_POST,"cat_getItem");
	
	
	//switch cases for function
	switch($function){
		
		case "getCategoryList":
			getCategoryList($include_connect);
		break;
		
		case "getItem":
			getItem($include_connect,$get_getItem);
		break;
		
		DEFAULT:
			echo "No Function";
		break;
	}
	
	

	//ALL FUNCTIONS
	function getCategoryList($include_connect){
		include($include_connect);
		
		//get category list
		$getCatList = mysqli_query($connect,"Select * from categories") or die("Bad query getCategory");
		if($getCatList){
			if(mysqli_num_rows($getCatList)>0){
				$data = array();
				while($row = mysqli_fetch_assoc($getCatList)){
					$data[] = array(
						"category_name" => $row["category_name"]
					);
				}
				$result["category_data"] = $data;
				echo json_encode($result);
				mysqli_close($connect);
			}else{
				echo "No_categories";
			}
		}else{
			echo "failed";
		}
	}
	
	function getItem($include_connect,$get_getItem){
		include($include_connect);
		
		$getCatItem = mysqli_query($connect,"select i.item_id as item_id,
											i.category_name as category_name,
											i.item_name as item_name,
											i.item_price as item_price,
											i.item_desc as item_desc,
											i.item_image as item_image,
											inv.stock as item_stock 
											from items i,inventory inv where 
		(i.category_name = '$get_getItem') and (i.item_name = inv.inventory_item_name)") or die("Bad Query GetItem");
		if($getCatItem){
			if(mysqli_num_rows($getCatItem)>0){
				$data = array();
				while($row = mysqli_fetch_assoc($getCatItem)){
					$data[] = array(
						"item_id" 		=> $row["item_id"],
						"category_name"	=> $row["category_name"],
						"item_name"		=> $row["item_name"],
						"item_price"	=> $row["item_price"],
						"item_desc"		=> $row["item_desc"],
						"item_image"	=> $row["item_image"],
						"item_stock"	=> $row["item_stock"]
					);
				}
				$result["item_result"] = $data;
				echo json_encode($result);
				mysqli_close($connect);
			}else{
				echo "no_item";
				
			}
			
		}else{
			echo "failed";
		}
	}
	
?>