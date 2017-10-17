<?php include("snippets/meta.html"); ?>
<div data-role="page">
<div id="creaccount">
<?php
session_start();
include ("snippets/db.php");
      $username = $_SESSION['username'];
      $q = $DBH->prepare('SELECT * FROM users WHERE u_username= :username');
      $q->bindValue(':username', $username);
      $q->execute();
      $check = $q->fetch(PDO::FETCH_ASSOC);
      $row = $q->fetch(PDO::FETCH_ASSOC);
      $_SESSION['type'] = $check['u_type'];


$id = $_GET['id'];

$reset = "<a href='snippets/password.php?id=". $id." ><button 'data-role='button' name='mainmenu' data-inline='true' data-theme='b' >Reset Password </button></a>";
$ship = "<a href='status.php?id=". $id ."' data-role='button' name='mainmenu' data-inline='true' data-transition='flow' >change status - SHIPPED </a>";
$print = "<a href='snippets/pdf.php?id=". $id ."' data-role='button' name='mainmenu' data-inline='true' data-theme='b' > PDF File </a>";
$cart =  "<input type='submit' id='submit' data-role='button' data-inline='true' data-theme='b'   name='submit' value='Add to cart' data-transition='flow'></form>";
$back = "<a href='Index.php' data-role='button' name='mainmenu' data-inline='true' data-transition='flow' >back </a>";
$items = "";
$mainmenu = "<br><a href='Index.php' data-role='button' name='mainmenu' data-inline='true' data-transition='flow' data-theme='b' >Home</a>";


if($_SESSION['type']=='admin')
{
		$_SESSION['nav']="HO";
		include ("snippets/header.php");
		$q = $DBH->prepare("SELECT * FROM users WHERE u_id= :pid"); 
		$q->bindValue(':pid', $id);
		$q->execute();
		$row = $q->fetch(PDO::FETCH_ASSOC);
		echo "<div id='details'><h3> ID:". $row["u_id"]." <br> Username: ".$row['u_username']."</h3>" ." <p> <b>User type: </b>  ".$row['u_type']."<p><b> Name:</b> ".$row['u_firstname']." ".$row['u_surname']."<p><b> Address:</b> ".$row['u_addre']."<p><b> Email: </b>".$row['u_email']."<br>"."<p><b> Tel: </b>".$row['u_tel']."<br>";
		echo $back . $reset. "<a href='Index.php?username=". $row['u_username']."' ><button 'data-role='button' name='mainmenu' data-inline='true' data-theme='b' >Edit details</button></a>";;
}
elseif($_SESSION['type']=='staff')
{
		$_SESSION['nav']="HO";
		include ("snippets/header.php");
		$q = $DBH->prepare("SELECT * FROM Products WHERE p_id= :pid"); 
		$q->bindValue(':pid', $id);
		$q->execute();
		$row = $q->fetch(PDO::FETCH_ASSOC);
		$_SESSION['id']=$row["p_id"];
		$_SESSION['type'] == 'staff';
		echo "<div id='details'><h3> ". $row["p_id"]." - ".$row['p_name']."</h3><img class='imgproduct' src='images/";
			if(file_exists('images/'.$row['p_id'].'.jpg')){echo $row['p_id'].'.jpg';}else {echo 'NIA.png';} 
		echo "' />" ." <p> <b>Description:</b><br>  ".$row['p_description']."<p><b> Available:</b> ".$row['p_stock']." units</p>". "<p><b> Price: € </b>".$row['p_price']."<br>";
		echo $back;
		echo "<a href='snippets/updateproduct.php?id=". $row["p_id"]."' ><button 'data-role='button' name='mainmenu' data-inline='true' data-theme='b'>Modify Product</button></a>";

}
elseif($_SESSION['type']=='deliver')
{

		$_SESSION['nav']="HO";
		include ("snippets/header.php");
		$q = $DBH->prepare("SELECT * FROM orders WHERE o_id= :pid"); 
		$q->bindValue(':pid', $id);
		$q->execute();
		$row = $q->fetch(PDO::FETCH_ASSOC);
		echo "<div id='details'><h3> ID:". $row["o_id"]." <br> Status: ".$row['o_status']."</h3>" ." <p> <b>Items:</b><br>  ".$row['o_items']."<p><b> Details:</b> ".$row['o_details']." </p>". "<p><b> Total: € </b>".$row['o_total']."<br>";
		echo  $back . $print."<a href='snippets/status.php?id=". $id." ><button 'data-role='button' name='mainmenu' data-inline='true' data-theme='b' >Change status: SHIPPED</button></a>";
		;

}
elseif($_SESSION['type']=='user')
{
		if($_SESSION['item']=='product')
		{
				$_SESSION['nav']="HCO";
				include ("snippets/header.php");
				$q = $DBH->prepare("SELECT * FROM Products WHERE p_id= :pid"); 
				$q->bindValue(':pid', $id);
				$q->execute();
				$row = $q->fetch(PDO::FETCH_ASSOC);
				echo "<div id='details'><h3> ". $row["p_id"]." - ".$row['p_name']."</h3><img class='imgproduct' alt='item' src='images/";
				if(file_exists('images/'.$row['p_id'].'.jpg')){echo $row['p_id'].'.jpg';}else {echo 'NIA.png';} 
				echo "' />" ." <p> <b>Description:</b><br>  ".$row['p_description']."<p><b> Available:</b> ".$row['p_stock']." units</p>". "<p><b> Price: € </b>".$row['p_price']."<br>";
				echo 
				"<form action='Index.php?menu=4' method='POST' data-mini='true'>
				<input type='hidden' name='p_id' value='".$row['p_id']."'>
				<input type='hidden' name='p_name' value='".$row['p_name']."'>
				<input type='hidden' name='p_price' value='".$row['p_price']."'>
				<label class='quantity' for='p_quantity' data-mini='true'>Quantity:</label>
				<input type='number' name='p_quantity' min='1' max='".$row['p_stock']."' class='form-control' id='p_quantity' placeholder='quantity'>
				<p id='errorquantity' class='aler2'>- Invalid number</p>";

				echo  "<a href='Index.php?menu=1' data-role='button' name='mainmenu' data-inline='true' data-transition='flow' >back </a><input type='submit' id='submit' data-role='button' data-inline='true' data-theme='b'   name='submit' value='Add to cart' data-transition='flow'></form>";

				echo "</div><script type='text/javascript'>
					$( document ).ready(function() {
					});
					$('#submit').click(function() {
					var quantity = $('#p_quantity').val();
					if (quantity==''){
					$('#errorquantity').css('font-size', '.8em');
					$('#p_quantity').css('border-color','red');
					$('#submit').attr('type', '');
					} else if (quantity!=''){  
					$('#errorquantity').css('font-size', '0em');
					$('#p_quantity').css('border-color','black');
					$('#submit').attr('type', 'submit');}
					});
					</script>";


		}elseif($_SESSION['item']=='order')
		{
				$_SESSION['nav']="HCO";
				include ("snippets/header.php");
				$q = $DBH->prepare("SELECT * FROM orders WHERE o_id= :pid"); 
				$q->bindValue(':pid', $id);
				$q->execute();
				$row = $q->fetch(PDO::FETCH_ASSOC);
				echo "<div id='details'><h3> ID:". $row["o_id"]." <br> Status: ".$row['o_status']."</h3>" ." <p> <b>Items:</b><br>  ".$row['o_items']."<p><b> Details:</b> ".$row['o_details']." </p>". "<p><b> Total: € </b>".$row['o_total']."<br>";
				echo  "<a href='Index.php?menu=2' data-role='button' name='mainmenu' data-inline='true' data-transition='flow' >back </a>". $print;

		}elseif($_SESSION['item']=='ordercomplete')
		{
				$_SESSION['nav']="HO";
				include ("snippets/header.php");
				$DBH    = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
				$q = $DBH->prepare("SELECT * FROM bsbulding.cart"); 
				$q->execute();
				$check = $q->fetchAll(PDO::FETCH_ASSOC); foreach($check as $row){
				$items .= $items.$row['p_id']." - ".$row['p_name']." - ".$row['c_quantity']." units for  € ".$row['c_price']." each	/	";
				$items;}

				$status = "to ship";
				$username = $_SESSION['username'];
				$total = $_SESSION['total'];
				$details = $_SESSION['details'];

				$DBH    = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		        $sql    = "INSERT INTO orders (o_id, o_status, u_username, o_items, o_total, o_details) VALUES (?,?,?,?,?,?)";
		                
		        $sth = $DBH->prepare($sql);
		                                
                $sth->bindParam(1, $id, PDO::PARAM_STR);
                $sth->bindParam(2, $status, PDO::PARAM_STR);
                $sth->bindParam(3, $username, PDO::PARAM_STR);
                $sth->bindParam(4, $items, PDO::PARAM_STR);
                $sth->bindParam(5, $total, PDO::PARAM_STR);
                $sth->bindParam(6, $details, PDO::PARAM_STR);

                $sth->execute();
                
				$DBH    = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                $sql    = 'TRUNCATE TABLE bsbulding.cart';
                
                $sth = $DBH->prepare($sql);
                $sth->execute();
				echo  "<br> Dear: ".$_SESSION['username']." <br><br>  your order is completed and ready to be send by post to you,<br><br> Your deliver details are: <br> ".$_SESSION['details']." <br><br>  your order is ".$items. "for the total amount of <b>€". $_SESSION['total']." <br><br> your order ID number is " . $id."</b><br>".$mainmenu.$print;

                $_SESSION['total']='';



		}

}	




?>
</div>
<?php include ("snippets/footer.php");?>
</div>
</body>
</html>