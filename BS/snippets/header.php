<?php 
if (file_exists(getcwd().'/images')) {
    $logopath = "images/1.jpg";
    $path = "";
} else {
    $logopath =  "../images/1.jpg"; 
    $path = "../";
}
?>

<img id="indexlogo" alt="Logo BS Building Supplies" src="<?php echo $logopath ?>">
<div data-role="navbar" data-theme="b" id="navbar" >
<ul>

<?php 
$nav = $_SESSION['nav'];
$home = "<li><a href='".$path."Index.php' data-icon='home' data-theme='b' data-transition='flow' >Home</a></li>";
$cart = "<li><a href='".$path."Index.php?menu=4' data-icon='check' data-theme='b' data-transition='flow'>Cart</a></li>";
$out = "<li><a href='".$path."logout.php' data-icon='delete' data-theme='b' data-transition='flow'>Log out</a></li>";

if($nav=="O")
{
	echo $out;
}
elseif($nav=="H")
{
	echo $home;
}
elseif($nav=="CO")
{
	echo $cart . $out;
}
elseif($nav=="HO")
{
	echo $home . $out;
}
elseif($nav=="HCO")
{
	echo $home . $cart . $out;
}
else
{
	echo "<li><a data-theme='b' ></a></li>";
}

?>	
	
</ul>
</div>