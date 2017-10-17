<?php 
                session_start();

		        include('snippets/db.php');
                $DBH    = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                $sql    = 'TRUNCATE TABLE bsbulding.cart';                
                $sth = $DBH->prepare($sql);
                $sth->execute();
                setcookie (session_id(), "", time() - 3600);
                session_unset();
                session_destroy();
                header("location:Index.php");
                exit();

?>

