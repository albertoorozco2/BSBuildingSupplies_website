
        
<?php
session_start();
include("snippets/meta.html");
include("snippets/db.php");
      $_SESSION['nav']="H";

if ($_POST) 
{

      if($_POST['username']==null){
            include("snippets/header.php");
            include("snippets/createacc.php");
            include("snippets/footer.php");     
      }
        else if($_SESSION['username']==$_POST['username']||$_SESSION['username']=='admin')
      {

            $username  = $_POST['username'];
            $password  = md5($_POST['password']."SWH");
            $email     = $_POST['email'];
            $firstname = $_POST['firstname'];
            $surname   = $_POST['surname'];
            $address   = $_POST['address'];
            $telephone = $_POST['telephone'];
            if(!isset($_POST['usertype'])){$type="user";}
            else{$type = $_POST['usertype'];}
            
            try {
                $DBH    = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

                $sql1 = "UPDATE bsbulding.users SET u_firstname=?, u_surname=?, u_addre=?, u_email=?, u_tel=?, u_pass=?, u_type=? WHERE u_username=?";

                $sth = $DBH->prepare($sql1);
                
                $sth->bindParam(1, $firstname, PDO::PARAM_STR);
                $sth->bindParam(2, $surname, PDO::PARAM_STR);
                $sth->bindParam(3, $address, PDO::PARAM_STR);
                $sth->bindParam(4, $email, PDO::PARAM_STR);
                $sth->bindParam(5, $telephone, PDO::PARAM_STR);
                $sth->bindParam(6, $password, PDO::PARAM_STR);               
                $sth->bindParam(7, $type, PDO::PARAM_STR);
                $sth->bindParam(8, $username, PDO::PARAM_STR);
   
                $sth->execute();
                
                 }catch (PDOException $e) {echo 'Error';}
                include("snippets/header.php");
                echo "<br><br><br><h3>Details updated!</h3><br><br><a href='Index.php' data-theme='b' data-role='button' name='log in'data-transition='flow' >Home</a><br><br>" ;
                include("snippets/footer.php");

       

      }
      else
      {
        $username = $_POST['username'];
        $DBH = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
        $q = $DBH->prepare('SELECT * FROM users WHERE u_username= :username LIMIT 1');
      $q->bindValue(':username', $username);
      $q->execute();
      $check = $q->fetch(PDO::FETCH_ASSOC);
      if (!empty($check))
        {          # code...
        
//if number of rows fields is bigger them 0 that means it's NOT available '  
            include("snippets/header.php");
            echo '<br><br><h3>username already taken please try again.</h3><br><br>
            <button onclick="history.go();" data-transition="flow" >Back </button><br><br>';
            include("snippets/footer.php");
        } 
        else 
        {
            $username  = $_POST['username'];
            $password  = md5($_POST['password']."SWH");
            $email     = $_POST['email'];
            $firstname = $_POST['firstname'];
            $surname   = $_POST['surname'];
            $address   = $_POST['address'];
            $telephone = $_POST['telephone'];
            $type      = "user";
            
            
            try {

                $DBH    = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                $sql    = "INSERT INTO users (u_username, u_pass, u_email, u_firstname, u_surname, u_addre, u_tel, u_type) VALUES (?,?,?,?,?,?,?,?)";
                
                $sth = $DBH->prepare($sql);
                
                $sth->bindParam(1, $username, PDO::PARAM_STR);
                $sth->bindParam(2, $password, PDO::PARAM_STR);
                $sth->bindParam(3, $email, PDO::PARAM_STR);
                $sth->bindParam(4, $firstname, PDO::PARAM_STR);
                $sth->bindParam(5, $surname, PDO::PARAM_STR);
                $sth->bindParam(6, $address, PDO::PARAM_STR);
                $sth->bindParam(7, $telephone, PDO::PARAM_STR);
                $sth->bindParam(8, $type, PDO::PARAM_STR);
                
                $sth->execute();
                
                 }catch (PDOException $e) {echo 'Error';}
            include("snippets/header.php");
            
            echo "<br><br><h3>Thank you for your registration!</h3><br><br>
            <a href='Index.php' data-role='button' date-theme='b' name='log in'data-transition='flow' >Home</a><br><br>";
            include("snippets/footer.php");

          }  
        }
                
} else 
{
    include("snippets/header.php");
    include("snippets/createacc.php");
    include("snippets/footer.php");

}

?>


    