<p class='usertype'> <?php echo "Username: " .$_SESSION['username']. "  <br> ". $_SESSION['details']; ?> </p>
<div data-role="controlgroup">

<?php 


if($_SESSION['type']=='user')
{

 echo "<a href='Index.php?menu=1' class='menu' data-transition='flow' data-role='button'>View Products</a>";
 echo "<a href='Index.php?menu=2' class='menu' data-transition='flow' data-role='button'>View Orders</a>";
 echo "<a href='Index.php?menu=3' class='menu' data-transition='flow' data-role='button'>Edit Account</a>";

 
}
else if($_SESSION['type']=='staff')
{
 echo "<a href='Index.php?menu=1' class='menu' data-transition='flow' data-role='button'>View & Modify Products</a>";
 echo "<a href='Index.php?menu=2' class='menu' data-transition='flow' data-role='button'>Add Products</a>";
}

?>

<a href="logout.php" class="menu" data-transition="flow" data-role="button">Log out</a>

</div>
<br><br>
