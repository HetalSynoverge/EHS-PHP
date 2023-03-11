<?php
require_once 'db.php';
$row = 1;
if (($handle = fopen("tt.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		//if($row == 1) continue;
		
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
		if($row != 1){
		$query = "insert into vehicle (brand_name,style,color,cost,retail_price) values('".$data[0]."','".$data[1]."','".$data[2]."','".trim(str_replace(',','',str_replace('$','',$data[3])))."','".trim(str_replace(',','',str_replace('$','',$data[4])))."')";
        $conn->query($query);
		}
		$row++;
        
    }
    fclose($handle);
}

?>