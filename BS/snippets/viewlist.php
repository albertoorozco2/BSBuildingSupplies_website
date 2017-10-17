<br>
<div class="content-primary">	
<ul data-role="listview" data-filter="true" data-input="#filterControlgroup-input">
<?php
// create the connection
include ("snippets/db.php");


if($_SESSION['type']=='user')
{	
		if(isset($_SESSION['submenu']))
		{
				if ($_SESSION['submenu']==1) 
				{	
						$_SESSION['item']="product";
						// select the correct table
						$q = $DBH->prepare("SELECT * FROM bsbulding.products"); $q->execute();
						// get the answer and put it in a variable
						$check = $q->fetchAll(PDO::FETCH_ASSOC); foreach($check as $row)
						{
						echo "<li><a href='viewitem.php?id=".$row['p_id']."' data-transition='flow'><img src='images/";
							if(file_exists('images/'.$row['p_id'].'.jpg'))
							{echo $row['p_id'].'.jpg';}else {echo 'NIA.png';} 
						echo "'/><h3>".$row['p_id']." - ".$row['p_name']."</h3><p> Price €".$row['p_price']."</p></a></li>";
						}
				}
				else if ($_SESSION['submenu']==2) 
				{
						$_SESSION['item']="order";
						// select the correct table
						$username = $_SESSION['username'];
						$q = $DBH->prepare("SELECT * FROM bsbulding.orders WHERE u_username= :username "); 
						$q->bindValue(':username', $username);
						$q->execute();
						// get the answer and put it in a variable
						$check = $q->fetchAll(PDO::FETCH_ASSOC); foreach($check as $row)
						{
						echo "<li> <a href='viewitem.php?id=".$row['o_id']."' data-transition='flow'><img src='images/order.jpg' /><h3>ID:".$row['o_id']."</h3><p> sta:".$row['o_status']." Total €".$row['o_total']."</p></a></li>";
						}
				}
				else if ($_SESSION['submenu']==3)
				{

						if($_POST)
						{
							    $_SESSION['nav']="HCO";
								$username = $_SESSION['username'];
								$id = $_POST['p_id'];
								$name = $_POST['p_name'];
								$quantity = $_POST['p_quantity'];
								$price = $_POST['p_price'];
								$total = $price*$quantity;
								try {
							    $sql    = "INSERT INTO cart (u_username, p_id, p_name, c_quantity, c_price, c_total) VALUES (?,?,?,?,?,?)";
						         
						        $sth = $DBH->prepare($sql);        
						        $sth->bindParam(1, $username, PDO::PARAM_STR);
						        $sth->bindParam(2, $id, PDO::PARAM_STR);
						        $sth->bindParam(3, $name, PDO::PARAM_STR);
						        $sth->bindParam(4, $quantity, PDO::PARAM_STR);
						        $sth->bindParam(5, $price, PDO::PARAM_STR);
						        $sth->bindParam(6, $total, PDO::PARAM_STR);
	  			                $sth->execute();
						        }catch (PDOException $e) {echo 'Error';}
								echo "<br><h3>The item <br> ".$id ."-". $name ." <br>". $quantity . " units <br> is added to your cart. </h3> <br><a href='Index.php?menu=1' data-role='button' name='mainmenu' data-inline='false' data-theme='b'  data-transition='flow' >Keep shopping </a><br><br>";
								
						} 
						else 
						{
								$_SESSION['nav']="HO";
								
								$q = $DBH->prepare("SELECT * FROM bsbulding.cart"); 
								$q->execute();
								$check = $q->fetchAll(PDO::FETCH_ASSOC); 
								if (!empty($check))
								{
									echo "<table data-mode='columntoggle' id='my-table' data-mode='reflow' >  <thead> <tr><th>Product Name</th><th>Price</th><th>Units</th><th>Total</th></tr>  </thead> <tbody>";
									foreach($check as $row){
									echo "<tr><td>".$row['p_id'].$row['p_name']."</td><td> €".$row['c_price']."</td><td>".$row['c_quantity']."</td><td> €". $row['c_total']."</td></tr>";}
									$STH_SELECT = $DBH->query("SELECT SUM(c_total) FROM bsbulding.cart");
									$sof = $STH_SELECT->fetchColumn();
									$_SESSION['total']= $sof;
									echo "<tr id='total' ><td><b>TOTAL</b></td><td></td><td></td><td><b>€".$sof."</b></tr></td></tbody></table>";
									$_SESSION['item']='ordercomplete';
									echo "<a href='viewitem.php?id=".time()."' data-role='button' name='register' data-inline='true' data-theme='b' data-transition='flow' >Place an order</a>";
									 
								}else
								{
									echo "<br><p>NOTHING IN YOUR CART</p><a href='Index.php' data-role='button' name='mainmenu' data-inline='true' data-transition='flow' data-theme='b' >Home</a>";
								}
						}
				}
				else
				{
				header("Location: Index.html");		
				}		
		}
		else
		{
		header("Location: Index.html");		
		}	
}
elseif($_SESSION['type']=='staff')
{
		// select the correct table
		$q = $DBH->prepare("SELECT * FROM bsbulding.products"); $q->execute();
		// get the answer and put it in a variable
		$check = $q->fetchAll(PDO::FETCH_ASSOC); foreach($check as $row)
		{
		echo "<li><a href='viewitem.php?id=".$row['p_id']."' data-transition='flow'><img src='images/";
		if(file_exists('images/'.$row['p_id'].'.jpg')){echo $row['p_id'].'.jpg';}else {echo 'NIA.png';} 
		echo "'/><h3>".$row['p_id']." - ".$row['p_name']."</h3><p> Price €".$row['p_price']."</p></a></li>";
		}

}
elseif($_SESSION['type']=='deliver')
{
	 echo "<h3>ORDERS TO SHIP</h3>";
		$_SESSION['item']="order";
		$status = 'to ship';
		$q = $DBH->prepare("SELECT * FROM bsbulding.orders WHERE o_status= :status "); 
		$q->bindValue(':status', $status);
		$q->execute();

		// get the answer and put it in a variable
		$check = $q->fetchAll(PDO::FETCH_ASSOC); foreach($check as $row)
		{
		echo "<li> <a href='viewitem.php?id=".$row['o_id']."' data-transition='flow'><img src='images/order.jpg' /><h3>".$row['o_id']."</h3><p> sts:".$row['o_status']." Total €".$row['o_total']."</p></a></li>";
		}
}
elseif($_SESSION['type']=='admin')
{		
		echo "<h3>LIST OF USERS</h3>";
		$username = $_SESSION['username'];
		$q = $DBH->prepare("SELECT * FROM bsbulding.users "); 
		$q->execute();
		// get the answer and put it in a variable
		$check = $q->fetchAll(PDO::FETCH_ASSOC); foreach($check as $row)
		{
		echo "<li> <a href='viewitem.php?id=".$row['u_id']."' data-transition='flow'><img src='images/user.jpg' /><h3>user: <span style='text-transform: uppercase;'>".$row['u_username']."</span></h3><p> type of user : ".$row['u_type']."</p></a></li>";
		}
}
else
{
  header("Location: Index.html");	
}





?>
</ul>
</div>