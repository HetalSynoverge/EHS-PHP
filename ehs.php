<?php
	require_once 'calculation.php';
?>

<html>
	<head>
    <title>EHS Cycle</title>		
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	<style>
	.table-content{border-top:#CCCCCC 4px solid; width:50%;}
	.table-content th {padding:5px 20px; background: #F0F0F0;vertical-align:top;} 
	.table-content td {padding:5px 20px; border-bottom: #F0F0F0 1px solid;vertical-align:top;} 
	</style>
	</head>
	
	<body>
    <div class="demo-content">
		<h2 class="title_with_link">Selling Season</h2>
  <form id="frmSearch" name="frmSearch" method="post" action="">
	 <p class="search_input">
		<input type="text" placeholder="Season Start Date" id="post_at" name="search[post_at]"  value="<?php echo $post_at; ?>" class="input-control" />
	    <input type="text" placeholder="Season End Date" id="post_at_to_date" name="search[post_at_to_date]" style="margin-left:10px"  value="<?php echo $post_at_to_date; ?>" class="input-control"  />
		<input type="text" placeholder="Check Profit For Date" id="post_at_for_date" name="search[post_at_for_date]" style="margin-left:10px"  value="<?php echo $post_at_for_date; ?>" class="input-control"  />		
		<input type="submit" name="go" value="Search" >
		<input type="submit" id="clear" onClick='$("#post_at").val("")' value="Clear" >
	</p>
<?php if(!empty($result))	 { ?>
<table class="table-content">
          <thead>
        <tr>
                      
          <th><span>Bike Brand</span></th>
          <th><span>Color</span></th>          
          <th><span>Style</span></th>
		  <th><span>Cost</span></th>
		  <th><span>Ratail Price</span></th>
		  <th><span>Sell Price</span></th>
		<th><span>Profit</span></th>		  
        </tr>
      </thead>
    <tbody>
	<?php
		foreach($resultArr as $row) {
	?>
        <tr>
			<td><?php echo $row["brand_name"]; ?></td>
			<td><?php echo $row["color"]; ?></td>
			<td><?php echo $row["style"]; ?></td>
			<td><?php echo "$".number_format($row["cost"], 2); ?></td>
			<td><?php echo "$".number_format($row["retail_price"],2); ?></td>
			<td><?php echo "$".number_format($row["sell_price"],2); ?></td>
			<td><?php echo "$".number_format($row["profit"],2); ?></td>
		</tr>
   <?php
		}
   ?>
   <tbody>
  </table>
<?php } ?>
  </form>
  </div>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="ehs.js"></script>
<script>
$.datepicker.setDefaults({
showOn: "button",
buttonImage: "datepicker.png",
buttonText: "Date Picker",
buttonImageOnly: true,
dateFormat: 'dd-mm-yy'  
});
$(function() {
$('#post_at').datepicker({
	dateFormat: "dd-M-yy",
});
$('#post_at_to_date').datepicker({
	dateFormat: "dd-M-yy",
});
$('#post_at_for_date').datepicker({
	dateFormat: "dd-M-yy",
});
});

$('#post_at').datepicker({
	dateFormat: "dd-M-yy",
            onSelect: function(dateText,inst){
				$('#post_at_to_date').datepicker('option','minDate',new Date(dateText));
				$('#post_at_for_date').datepicker('option','minDate',new Date(dateText));
            }
        });
</script>
</body></html>
