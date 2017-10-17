

<?php

// create the connection
// select the correct table
	include ("snippets/db.php");

if (isset($_GET['menu'])){
$username = $_SESSION['username'];
}else{
$username = $_GET['username'];
}

$q = $DBH->prepare("SELECT * FROM bsbulding.users WHERE u_username= :username "); 
$q->bindValue(':username', $username);

$q->execute();
// get the answer and put it in a variable
$check = $q->fetchAll(PDO::FETCH_ASSOC); foreach($check as $row){
//echo "  <a href='viewproduct.php?id=".$row['p_id']."'>PRODUCT   No  " .$row['p_name']."</a><br><br>";
$firstname = $row['u_firstname'];
$surname = $row['u_surname'];
$address = $row['u_addre'];
$email = $row['u_email'];
$tel = $row['u_tel'];
$type = $row['u_type'];
$password = $row['u_pass'];

}
?>



<div id="creaccount">
<div data-role="content">
  			<h3>Edit your account</h3>
  			<label id="errors"><p class="aler2">Please complete</p>

  			</label>
  			<form action="register.php" method="POST" data-mini="true">
  						<div data-role="fieldcontain">

  							<label for="firstname" data-mini="true">Firstname:</label>
							<input id="firstname" type="text" class="form-control" name="firstname" placeholder="first name" value="<?php echo $firstname ?>">
							<p id="errorfirstname" class="aler2">- Invalid Firstname [ letters a-z, 3-6 letters ]</p>
							<label for="surname" data-mini="true">Surname:</label>
							<input id="surname" type="text"  class="form-control"  name="surname" placeholder="surname" value="<?php echo $surname ?>">
							<p id="errorsurname" class="aler2">- Invalid Surname [ letters a-z, 3-6 letters ]</p>
					
							<label for="address" data-mini="true">Address:</label>
							 <textarea id="address" class="form-control" rows="5"  name="address" placeholder="address"  ><?php echo $address ?></textarea>
							 <p id="erroraddress" class="aler2">- Invalid Address [ letters a-z, numbers 0-9 ]</p>

							<label for="email" data-mini="true">Email:</label>

							 <input id="email" type="email" class="form-control" name="email" placeholder="e-mail" value="<?php echo $email ?>" >
							<p id="erroremail" class="aler2">- Invalid Email</p>
						<label for="telephone" data-mini="true">Telephone:</label>

							<input id="telephone" type="tel"  class="form-control"  name="telephone" placeholder="telephone" value="<?php echo $tel ?>" >
							<p id="errortelephone" class="aler2">- Invalid telephone [ numbers 0-9 or/and () + - ]</p>

							<br><label for="username" data-mini="true">Username:  <?php echo $username ?></label><br><br>

							<input id="username" type="hidden" name="username" value="<?php echo $username ?>" >


<?php 
if ($_SESSION['type']=='user')
{
 echo "<input id='type' type='hidden' name='type' value='". $type ."' >
<label for='password' data-mini='true'>Password:</label>

<input id='password' type='password'  class='form-control' name='password' placeholder='password' value='' >
<p id='errorpassword' class='aler2'>- Invalid password [ letters a-z, numbers 0-9, 3-6 chars ]</p>

<label for='repassword' data-mini='true'>Confirm Password:</label>

<input type='password' class='form-control' id='repassword' name='repassword' placeholder='confirm password' value='' >
<p id='errorrepassword' class='aler2'> - Passwords do not match</p>";
}
elseif($_SESSION['type']=='admin')
{
echo '<input type="hidden" id="hiddenuser" name="admin" value="admin" />
	  <input type="hidden" id="password" name="password" value="'.$password.'" />
	<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
    <legend>Usertype:</legend>
        <input name="usertype" id="radio-choice-c" value="user" '; 
        if($type=='user'){echo'checked="checked"';} 
echo ' type="radio"><label for="radio-choice-c">User</label>

        <input name="usertype" id="radio-choice-d" value="staff"';
        if($type=='staff'){echo'checked="checked"';} 
echo ' type="radio">
        <label for="radio-choice-d">Staff</label>

        <input name="usertype" id="radio-choice-e" value="deliver"';
        if($type=='deliver'){echo'checked="checked"';} 
echo   ' type="radio">
        <label for="radio-choice-e">Deliver</label>

        <input name="usertype" id="radio-choice-f" value="admin"'; 
        if($type=='admin'){echo'checked="checked"';} 
echo   ' type="radio">
        <label for="radio-choice-f">Admin</label>
</fieldset>';


}
?>
							
						
							
							<input type="button" id="submit" data-role="button" data-inline="true" data-theme="b" data-transition="flow"  name="submit" value="Submit" data-ajax="false" >

						</div>
			

<script type="text/javascript">

var valid = 0;

$( document ).ready(function() {
});





$("#submit").click(function() {

		var firstname = $("#firstname").val();

		if (firstname.match(/^[a-zA-Z]{3,16}/))
   		 {
			$("#errorfirstname").css("font-size", "0em");
			$("#firstname").css("border-color","lightgray");
			++valid;
$("#errors").html(valid);





		} else {  

			$("#errorfirstname").css("font-size", ".8em");
			$("#firstname").css("border-color","red");
						

			}

});
$("#submit").click(function() {

		var surname = $("#surname").val();

		if (surname.match(/^[a-zA-Z]{3,16}/))
   		 {
			$("#errorsurname").css("font-size", "0em");
			$("#surname").css("border-color","lightgray");
			++valid;
$("#errors").append(valid);


		} else {  


			$("#errorsurname").css("font-size", ".8em");
			$("#surname").css("border-color","red");

			}

});
$("#submit").click(function() {

		var address = $("#address").val();

		if (address.match(/^[A-Za-z0-9'\.\-\s\,]/))
   		 {
   		 	$("#erroraddress").css("font-size", "0em");
			$("#address").css("border-color","lightgray");
			++valid;
$("#errors").append(valid);

			
		} else {  

			$("#erroraddress").css("font-size", ".8em");
			$("#address").css("border-color","red");

			}

});
$("#submit").click(function() {

		var email = $("#email").val();

		if (email.match(/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+.[A-Za-z]{2,4}$/))
   		 {

   		 	$("#erroremail").css("font-size", "0em");
			$("#email").css("border-color","lightgray");
			++valid;
$("#errors").append(valid);

			
		} else {  
			$("#erroremail").css("font-size", ".8em");
			$("#email").css("border-color","red");


			}

});
$("#submit").click(function() {

		var telephone = $("#telephone").val();

		if (telephone.match(/[0-9-()+]{3,20}/))
   		 {

   		 	$("#errortelephone").css("font-size", "0em");
			$("#telephone").css("border-color","lightgray");
			++valid;
$("#errors").append(valid);
			$("#errors").css("font-size", ".8em");


			
		} else {  
			$("#errortelephone").css("font-size", ".8em");
			$("#telephone").css("border-color","red");


			}

});

<?php 

if ($_SESSION['type']=='user')
{ 
echo '$("#submit").click(function() {

		var password = $("#password").val();

		if (password.match(/^[A-Za-z0-9_-]{3,16}$/))
   		 {

   		 	$("#errorpassword").css("font-size", "0em");
			$("#password").css("border-color","lightgray");
			++valid;
$("#errors").append(valid);

			
		} else {  
			$("#errorpassword").css("font-size", ".8em");
			$("#password").css("border-color","red");



			}

});
$("#submit").click(function() {

		var repassword = document.getElementById("repassword");
		var password = document.getElementById("password");

		if (repassword.value==password.value)
   		 {

   		 	$("#errorrepassword").css("font-size", "0em");
			$("#repassword").css("border-color","lightgray");

			++valid;
$("#errors").append(valid);

			
		} else {  
			$("#errorrepassword").css("font-size", ".8em");
			$("#repassword").css("border-color","red");


			}

});
$("#submit").click(function() {

		if (valid>6){
   		 	$("#submit").attr("type", "submit");
			   		 	valid=0;



			
		} else {  
   		 	$("#submit").attr("type", "button");

			

   		 	valid=0;

			}

});
';}else if($_SESSION['type']=='admin')
{
echo '$("#submit").click(function() {

		var user = document.getElementById("hiddenuser");
		var reuser = document.getElementById("hiddenuser");

		if (user.value==reuser.value)
   		 {

   		 	$("#errorfirstname").css("font-size", "0em");

			++valid;
$("#errors").append(valid);

			
		} else {  
			$("#errorfirstname").css("font-size", ".8em");


			}

});



$("#submit").click(function() {

		if (valid>5){
   		 	$("#submit").attr("type", "submit");
			   		 	valid=0;


			
		} else {  
   		 	$("#submit").attr("type", "button");

			

   		 	valid=0;

			}

});';} ?>

</script>
</form>
						</div>
						</div>
