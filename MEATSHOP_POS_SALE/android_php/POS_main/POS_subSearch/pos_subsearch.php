<?php
	
	header("Content-type: text/html; charset=utf-8");
	
	//database connection
	$include_connect ="../../connection.php";
	
	//function declaration
	$function = filter_input(INPUT_POST,"function");
		
	//object declaration for search item
	$search_item = filter_input(INPUT_POST,"search_item");
	
	
	//switch cases for function
	switch($function){
		
		case "getSearchItem":
			getSearchItem($include_connect,$search_item);
		break;
		
		DEFAULT:
			echo "No Function";
		break;
	}
	
	

	//ALL FUNCTIONS
	function getSearchItem($include_connect,$search_item){
		include($include_connect);
		
		$searchItem = mysqli_query($connect,"select i.item_id as item_id,
											i.category_name as category_name,
											i.item_name as item_name,
											i.item_price as item_price,
											i.item_desc as item_desc,
											i.item_image as item_image,
											inv.stock as item_stock 
											from items i,inventory inv where 
		(i.category_name LIKE '%$search_item%') or (i.item_name LIKE '%$search_item%') or (i.item_id LIKE '%$search_item%') 
		and (i.item_name = inv.inventory_item_name) group by i.item_name") or die("Bad Query searchItem");
		if($searchItem){
			if(mysqli_num_rows($searchItem)>0){
				
				$data = array();
				while($row=mysqli_fetch_assoc($searchItem)){
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
				
				$result["search_data"] = $data;
				echo json_encode($result);
				mysqli_close($connect);
			}else{
				echo "not_exists";
			}
		}else{
			echo "failed";
		}
	}
	
	
	
	
	
?>