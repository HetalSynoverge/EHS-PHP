<?php
	require_once 'db.php';
	/**
	Purpose: Calculate profit for bikes on given date
	Create Date: 03/10/2023
	Author: Hetal Patel
	*/
	
	/* set initial values of form*/
	$post_at = "";
	$post_at_to_date = "";
	$post_at_for_date = "";
	$resultArr = array();
	
	/* Check for Form submit with proper data */
	if(!empty($_POST["search"]["post_at"]) && !empty($_POST["search"]["post_at_to_date"]) && !empty($_POST["search"]["post_at_for_date"])) {	
		
		$post_at = $_POST["search"]["post_at"];
		$post_at_to_date = $_POST["search"]["post_at_to_date"];
		$post_at_for_date = $_POST["search"]["post_at_for_date"];
		
		/* Use stored procedure to get data of all bikes */
		$sql = "call getBikes()";
		$result = mysqli_query($conn,$sql);
		
		/* Check date difference to calculate profit*/
		$diff = strtotime($post_at_for_date, 0) - strtotime($post_at_to_date, 0);
		if($diff <= 0){
			$seasonPass = 0;
		} else {
			$seasonPass = 1;
			$diff = strtotime($post_at_for_date, 0) - strtotime($post_at_to_date, 0);
			$seasonPass = floor($diff / 604800); // Date difference in week
		
		}
		while($row = $result->fetch_array(MYSQLI_BOTH)) {
			if($seasonPass == 0){ // if season is not pass
				$row['sell_price'] = $row['profit'] = $row["retail_price"];
			} else { // user given date is after season end date
				if($row['style'] == 'Fat'){ // for Fat bike price increase 5% every week
					$sellPrice =  $row["retail_price"] + ($row["retail_price"] * 0.05 * $seasonPass);
				} else if($row['color'] == 'Red'){ // for Red Color bike price decrease 2% every week
					$sellPrice =  $row["retail_price"] - ($row["retail_price"] * 0.02 * $seasonPass);
				} else { // for other bike price decrease 3% every week
					$sellPrice =  $row["retail_price"] - ($row["retail_price"] * 0.03 * $seasonPass);
				}
				if($sellPrice <= $row['cost']){ // bike sell price would not be less than cost price
					$row['sell_price'] = $row["cost"];
					$row['profit'] = '0';
				} else {
					$row['sell_price'] = $sellPrice;
					$row['profit'] = $sellPrice - $row['cost']; // calculate actual profit
				}
			}
			$resultArr[] = $row;
			
		}
	} else if(!empty($_POST["go"])){ // in case of no any date selected
		echo "<label style='color:red;'>Please set all date first</label>";
	}
	
?>