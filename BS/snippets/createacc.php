<?php $_SESSION['username']=''; ?>
<div id="creaccount">
<div data-role="content">
  			<h3>Create an account</h3>
  			<label id="errors"><p class="aler2">Please complete</p>

  			</label>
  			<form action="register.php" method="POST" data-mini="true">
  						<div data-role="fieldcontain">

  							<label for="firstname" data-mini="true">Firstname:</label>
							<input id="firstname" type="text" class="form-control" name="firstname" placeholder="first name" >
							<p id="errorfirstname" class="aler2">- Invalid Firstname [ letters a-z, 3-6 letters ]</p>
							<label for="surname" data-mini="true">Surname:</label>
							<input id="surname" type="text"  class="form-control" id="surname" name="surname" placeholder="surname">
							<p id="errorsurname" class="aler2">- Invalid Surname [ letters a-z, 3-6 letters ]</p>
					
							<label for="address" data-mini="true">Address:</label>
							 <textarea id="address" class="form-control" rows="5" id="address" name="address" placeholder="address" ></textarea>
							 <p id="erroraddress" class="aler2">- Invalid Address [ letters a-z, numbers 0-9 ]</p>

							<label for="email" data-mini="true">Email:</label>

							 <input id="email" type="email" class="form-control" name="email" placeholder="e-mail">
							<p id="erroremail" class="aler2">- Invalid Email</p>
						<label for="telephone" data-mini="true">Telephone:</label>

							<input id="telephone" type="tel"  class="form-control" id="telephone" name="telephone" placeholder="telephone">
							<p id="errortelephone" class="aler2">- Invalid telephone [ numbers 0-9 or/and () + - ]</p>

							<label for="username" data-mini="true">Username:</label>

							<input id="username" type="text" class="form-control" name="username" placeholder="username"><p id="errorusername" class="aler2">- Invalid Username [ letters a-z, 3-16 letters ] </p>
						

							<label for="password" data-mini="true">Password: </label>

							<input id="password" type="password"  class="form-control" id="password" name="password" placeholder="password">
							<p id="errorpassword" class="aler2">- Invalid password [ letters a-z, numbers 0-9, 3-6 chars ]</p>


						<label for="repassword" data-mini="true">Confirm Password:</label>

						<input type="password" id="repassword" class="form-control" id="repassword" name="repassword" placeholder="confirm password">
							<p id="errorrepassword" class="aler2"> - Passwords do not match</p>
						
							
							<input type="button" id="submit" data-role="button" data-inline="true" data-theme="b" data-transition="flow"  name="submit" value="Submit">

						</div>
			</form>
						</div>
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

			
		} else {  
			$("#errortelephone").css("font-size", ".8em");
			$("#telephone").css("border-color","red");


			}

});
$("#submit").click(function() {

		var username = $("#username").val();

		if (username===("admin")||username===("staff")||username===("user")||username===("deliver"))
   		 {




		$("#errorusername").css("font-size", ".8em");
			$("#username").css("border-color","red");

			
		} else if (username.match(/^[A-Za-z0-9]{3,16}$/)){
		$("#errorusername").css("font-size", "0em");
			$("#username").css("border-color","lightgray");
				++valid;

		}

		else{  
			$("#errorusername").css("font-size", ".8em");
			$("#username").css("border-color","red");


			}

});
$("#submit").click(function() {

		var password = $("#password").val();

		if (password.match(/^[A-Za-z0-9_-]{3,16}$/))
   		 {

   		 	$("#errorpassword").css("font-size", "0em");
			$("#password").css("border-color","lightgray");
			++valid;

			
		} else {  
			$("#errorpassword").css("font-size", ".8em");
			$("#password").css("border-color","red");



			}

});
$("#submit").click(function() {

		var repassword = document.getElementById('repassword');
		var password = document.getElementById('password');

		if (repassword.value==password.value)
   		 {

   		 	$("#errorrepassword").css("font-size", "0em");
			$("#repassword").css("border-color","lightgray");

			++valid;

			
		} else {  
			$("#errorrepassword").css("font-size", ".8em");
			$("#repassword").css("border-color","red");


			}

});

$("#submit").click(function() {

		if (valid>7){
   		 	$("#submit").attr("type", "submit");
			$("#submit").attr("value", "valid");



			
		} else {  
   		 	$("#submit").attr("type", "button");
   		 	$("#submit").attr("value", "valid");


   		 	valid=0;

			}

});

</script>