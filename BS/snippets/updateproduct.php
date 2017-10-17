<?php
session_start();
// create the connection
include ("meta.html");
include ("header.php");

include ("db.php");
// select the correct table
$id = $_GET['id'];
$q = $DBH->prepare("SELECT * FROM bsbulding.products WHERE p_id= :id "); 
$q->bindValue(':id', $id);

$q->execute();
// get the answer and put it in a variable
$check = $q->fetchAll(PDO::FETCH_ASSOC); foreach($check as $row){
//echo "  <a href='viewproduct.php?id=".$row['p_id']."'>PRODUCT   No  " .$row['p_name']."</a><br><br>";
$name = $row['p_name'];
$description = $row['p_description'];
$price = $row['p_price'];
$stock = $row['p_stock'];
}
?>


<div id="creaccount">
<div data-role="content">
  			<h3>Update a Product</h3>
  			<label id="errors"><p class="aler2">Please complete</p>

  			</label>
  			<form action="../registerproduct.php" method="POST" data-mini="true">
  						<div data-role="fieldcontain">

  							<label for="id" data-mini="true"><b>ID: <?php echo $id ?> </b></label>
							<input id="id" type="hidden" class="form-control" name="id" placeholder="ID" value="<?php echo $id ?>"><br><br>

							<label for="name" data-mini="true">Product name:</label>

							<input id="name" type="text" class="form-control" name="name" placeholder="Product name" value="<?php echo $name ?>" >
							<p id="errorname" class="aler2">- Invalid name [letters a-z, numbers 0-9]</p>

							<label for="description" data-mini="true">Description:</label>
							<input id="description" type="text"  class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description ?>">
							<p id="errordescription" class="aler2">-Invalid Description [ letters a-z, numbers 0-9 ]</p>
					
							<label for="price" data-mini="true">Price:</label>

							<input id="price" type="tel"  class="form-control" id="price" name="price" placeholder="Price" value="<?php echo $price ?>">
							<p id="errorprice" class="aler2">- Invalid price [ numbers 0-9 ]</p>

							<label for="stock" data-mini="true">Stock Available:</label>

							<input id="stock" type="tel"  class="form-control" id="stock" name="stock" placeholder="Stock available" value="<?php echo $stock ?>">
							<p id="errorstock" class="aler2">- Invalid Stock [ numbers 0-9 ]</p>

							<input type="button" id="submit" data-role="button" data-inline="true" data-theme="b" data-transition="flow"  name="submit" value="Submit" ssdata-ajax="false"  >

						</div>
			</form>
						</div>
						</div>

<?php include('footer.php'); ?>



<script type="text/javascript">
var valid = 0;

$( document ).ready(function() {

});

$("#submit").click(function() {

		var name = $("#name").val();

		if (name.match(/^[A-Za-z0-9'\.\-\s\,]{3,26}/))
   		 {
			$("#errorname").css("font-size", "0em");
			$("#name").css("border-color","lightgray");
			++valid;


		} else {  


			$("#errorname").css("font-size", ".8em");
			$("#name").css("border-color","red");

			}

});
$("#submit").click(function() {

		var description = $("#description").val();

		if (description.match(/^[A-Za-z0-9'\.\-\s\,]/))
   		 {
   		 	$("#errordescription").css("font-size", "0em");
			$("#description").css("border-color","lightgray");
			++valid;

			
		} else {  

			$("#errordescription").css("font-size", ".8em");
			$("#description").css("border-color","red");

			}

});
$("#submit").click(function() {

		var price = $("#price").val();

		if (price.match(/[0-9.]{1,6}/))
   		 {

   		 	$("#errorprice").css("font-size", "0em");
			$("#price").css("border-color","lightgray");
			++valid;

			
		} else {  
			$("#errorprice").css("font-size", ".8em");
			$("#price").css("border-color","red");


			}

});
$("#submit").click(function() {

		var stock = $("#stock").val();

		if (stock.match(/^(\d+)?$/))
   		 {

   		 	$("#errorstock").css("font-size", "0em");
			$("#stock").css("border-color","lightgray");
			++valid;

			
		} else {  
			$("#errorstock").css("font-size", ".8em");
			$("#stock").css("border-color","red");


			}

});

$("#submit").click(function() {

		if (valid>3){
   		 	$("#submit").attr("type", "submit");



			
		} else {  
   		 	$("#submit").attr("type", "button");
   		 	valid=0;

			}

});

</script>