<?php

	//Encoding
	header("Content-type: text/html; charset=utf-8");
	
	
	$include_connect ="../connection.php";
	
	//declaration for function
	$function = filter_input(INPUT_POST,"function");
	//$function = "unique";
	
	//declaration for onAddItems
	$onAdd_imageString 		= filter_input(INPUT_POST,"onAdd_imageString");
	$onAdd_item_category 	= filter_input(INPUT_POST,"onAdd_itemCategory");
	$onAdd_product_name		= filter_input(INPUT_POST,"onAdd_productName");
	$onAdd_product_price	= filter_input(INPUT_POST,"onAdd_productPrice");
	$onAdd_product_stock	= filter_input(INPUT_POST,"onAdd_productStock");
	$onAdd_product_desc		= filter_input(INPUT_POST,"onAdd_productDesc");
	
	//declaration for deleteItem
	$onDel_item_name		= filter_input(INPUT_POST,"onDel_item_name");
	
	
	//declaration for addCategory
	$addCat_name			= filter_input(INPUT_POST,"addCat_name");
	
	//declaration for get Top Item per Category
	$get_topItemCategory	= filter_input(INPUT_POST,"get_topItemCategory");
	
	
	
	
	//declartion for local storage path file
	$path = $_SERVER['DOCUMENT_ROOT'] ."/MEATSHOP_POS_SALE/image_upload/";
	
	/// switches for function
	switch($function){
		
		//Get inventory Items
		case "getInvItems":
			getInvItems($include_connect);
		break;
		
		//Add items
		case "onAddItems":
			onAddItems($include_connect,$onAdd_imageString,
						$onAdd_item_category,
						$onAdd_product_name,
						$onAdd_product_price,
						$onAdd_product_stock,
						$onAdd_product_desc);
		break;
		
		//Read Items
		case "onReadItemCat":
			onReadItemCat($include_connect);
		break;
		
		//Delete Items
		case "deleteItem":
			deleteItem($include_connect,$onDel_item_name);
		break;
		
		//Add Category
		case "addCategory":
			addCategory($include_connect,$addCat_name);
		break;
		
		//get Top Items Per category
		case "getTopItemPerCategory":
			getTopItemPerCategory($include_connect,$get_topItemCategory);
		break;
		
		
		DEFAULT:
			echo "No Function";
		break;
	}


	//ALL FUNCTIONS
	function getInvItems($include_connect){
		include($include_connect);
		
		$getItems = mysqli_query($connect,"select 
											it.item_id as 'item_id',
											it.category_name as 'category_id',
											it.item_price as 'item_price',
											it.item_name as 'item_name',
											it.item_desc as 'item_desc',
											inv.stock as 'stock',
											it.item_image as 'item_image'
											from items it, inventory inv where (it.item_name = inv.inventory_item_name)") or die("Bad Query GetItems");
		if($getItems){
			if(mysqli_num_rows($getItems)>0){
				$data = array();
				
				while($row=mysqli_fetch_assoc($getItems)){
					$data[] = array(
						"item_id" 		=> $row["item_id"],
						"category_id"	=> $row["category_id"],
						"item_price"	=> $row["item_price"],
						"item_name"		=> $row["item_name"],
						"item_desc"		=> $row["item_desc"],
						"item_stock"	=> $row["stock"],
						"item_image"	=> $row["item_image"]
					);
				}
				
				$result["items_data"] = $data;
				echo json_encode($result);
				mysqli_close($connect);
			}else{
				echo "no_items";
			}
		}else{
			echo "failed";
		}
	}
	
	
	//Function for onAddItems
	function onAddItems($include_connect,$onAdd_imageString,
						$onAdd_item_category,
						$onAdd_product_name,
						$onAdd_product_price,
						$onAdd_product_stock,
						$onAdd_product_desc){
	include($include_connect);
	
	$isItemExists  = mysqli_query($connect,"SELECT * from items where item_name = '$onAdd_product_name'") or
									die("Bad Query isItemExists");
									
									if($isItemExists){
										if(mysqli_num_rows($isItemExists)>0){
											echo "item_exists";
										}else{
											onAddItems_verified($include_connect,$onAdd_imageString,$onAdd_item_category,
																$onAdd_product_name,$onAdd_product_price,
																$onAdd_product_stock,$onAdd_product_desc);
										}
									}else{
										echo "failed";
									}
	}
	
	
	///function onaddItemsVerified
	function onAddItems_verified($include_connect,$onAdd_imageString,$onAdd_item_category,$onAdd_product_name,$onAdd_product_price,$onAdd_product_stock,
									$onAdd_product_desc){
		include($include_connect);
		
		//Generate name for product image
		
		if($onAdd_imageString == "noImage"){
			$onAdd_imageName = "noImage.png";
		}else{
			$onAdd_imageName = $onAdd_product_name."_.jpg";
		}
		
		//Insert if Item verified
		$onAddItem_verified = mysqli_query($connect, "INSERT INTO items 
											(item_name,
											item_price,
											item_desc,
											item_image,
											category_name) values 
											('$onAdd_product_name','$onAdd_product_price','$onAdd_product_desc','$onAdd_imageName','$onAdd_item_category')")
											or die("Bad Query onAddItem_verified");
											
								
		if($onAddItem_verified){
			//Insert to inventory
			$insertToInventory = mysqli_query($connect,"INSERT INTO inventory (inventory_item_name,stock,updated_by) 
														values 
														('$onAdd_product_name','$onAdd_product_stock','noName')") or die("Bad Query insertToInventory");
			if($insertToInventory){
				
				//Upload item product image to local storage
				$path = $_SERVER['DOCUMENT_ROOT'] ."/MEATSHOP_POS_SALE/image_upload/";
				
					file_put_contents($path.$onAdd_imageName,base64_decode($onAdd_imageString));
				
				echo "success";
			}else{
				echo "failed";
			}
			
			
		}else{
			echo "failed";
		}
		
	}
	
	
	//function for reading itemCat
	function onReadItemCat($include_connect){
		include($include_connect);
		
		$onReadItem_get = mysqli_query($connect,"SELECT * from categories") or die("Bad Query onReadItem");
		
		//getting category list item
		if($onReadItem_get){
			if(mysqli_num_rows($onReadItem_get)>0){
				$data = array();
					while($row = mysqli_fetch_assoc($onReadItem_get)){
						$data[] = array(
							"category_id"		=> $row["category_id"],
							"category_name" 	=> $row["category_name"],
							"category_added"	=> $row["category_added"]
						);
					}
					
					//converting to json format
					$result["category_data"] = $data;
					echo json_encode($result);
					mysqli_close($connect);
					
			}else{
				echo "not_exists";
			}
			
		}else{
			echo "failed";
		}
	}
	
	//function for deleting item from inventory and items table
	function deleteItem($include_connect,$onDel_item_name){
		include($include_connect);
	
		//delete from item table
		$deleteItem = mysqli_query($connect,"Delete from items where item_name = '$onDel_item_name'") or die("Bad Query DeleteItem");
		if($deleteItem){
			
			//Delete from inventory table
			$deleteFromInventory = mysqli_query($connect,"Delete from inventory where inventory_item_name = '$onDel_item_name'") or die("Bad Query deleteFromInventory");
			if($deleteFromInventory){
				echo "success";
			}else{
				echo "failed";
			}
		}else{
			echo "failed";
		}
	}
	
	
	//Function for adding categories
	function addCategory($include_connect,$addCat_name){
		include($include_connect);
		
		$ifCategoryExists = mysqli_query($connect,"select * from categories where category_name = '$addCat_name'") or die("Bad Query AddCategoryIfExists");
		if($ifCategoryExists){
			if(mysqli_num_rows($ifCategoryExists)>0){
				echo "category_exists";
			}else{
				//If category doesn't exists
				addCategory_verified($include_connect,$addCat_name);
			}
		}else{
			echo "failed";
		}
	}
	
	//ifCategoryVerified
	function addCategory_verified($include_connect,$addCat_name){
		include($include_connect);
		
		$addCategory = mysqli_query($connect,"INSERT INTO categories (category_name) values ('$addCat_name')") or die("BAd Query addCategoryVerified");
		if($addCategory){
			echo "success";
		}else{
			echo "failed";
		}
	}

	//function for get top item per category
	function getTopItemPerCategory($include_connect,$get_topItemCategory){
		include($include_connect);
		
		$getTop_itemPerCat = mysqli_query($connect,"SELECT i.item_id as item_id,
													i.category_name as category_name,
													i.item_name as item_name,
													i.item_price as item_price,
													i.item_desc as item_desc,
													i.item_image as item_image,
													sum(s.sales_item_total) as sales_total
													from items i,sales s where i.category_name = '$get_topItemCategory'
													AND (i.item_name = s.sales_item_name) group by s.sales_item_name order by sales_total desc") or die("Bad Query getTopItemPerCat");
													
		if($getTop_itemPerCat){
			$data = array();
			while($row = mysqli_fetch_assoc($getTop_itemPerCat)){
				$data[] = array(
					"item_id" 		=> $row["item_id"],
					"category_name" => $row["category_name"],
					"item_name"		=> $row["item_name"],
					"item_price"	=> $row["item_price"],
					"item_desc"		=> $row["item_desc"],
					"item_image"	=> $row["item_image"],
					"sales_total"	=> $row["sales_total"]
				);
			}
			$result["item_data"] = $data;
			echo json_encode($result);
			mysqli_close($connect);
		}else{
			echo "failed";
		}
	}


	
	
	
?>