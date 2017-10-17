
<?php

            include("meta.html");
            include("db.php");
            $_SESSION['nav']="HO";
            include("header.php");
           $id = $_GET['id'];
           $status = "shipped";

try {
                $DBH    = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                $sql1 = "UPDATE bsbulding.orders SET o_status=? WHERE o_id=?";
                $sth = $DBH->prepare($sql1);
                $sth->bindParam(1, $status, PDO::PARAM_STR);
                $sth->bindParam(2, $id, PDO::PARAM_STR);
                $sth->execute();    
                 }catch (PDOException $e) {echo 'Error';}
            echo "<br><br><h3>Status updated successfully!</h3><br><br><a href='../Index.php' data-role='button' data-theme='b' name='log in'data-transition='flow' >Home</a><br><br>";
 include("footer.php"); ?>


        </body>
        </html>
