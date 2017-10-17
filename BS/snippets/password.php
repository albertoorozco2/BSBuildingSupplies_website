
<?php
                include("meta.html");
                $_SESSION['nav']="HO";
                include("header.php");


                try {
				$id = $_GET['id'];
                $password = "12345678";
                include("db.php");
                $DBH    = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                $sql = "UPDATE bsbulding.users SET u_pass=? WHERE u_id=?";
                $sth = $DBH->prepare($sql);
                $sth->bindParam(1, $password, PDO::PARAM_STR);
                $sth->bindParam(2, $id, PDO::PARAM_STR);
                $sth->execute();
                 }catch (PDOException $e) {echo 'Error';}
            
                echo "<br><br><h3>Password reset successfully!</h3><br><br><a href='../Index.php' data-role='button' name='' data-transition='flow' data-theme='b' >Home</a> <br><br>" ;
                include("footer.php"); 
?>


