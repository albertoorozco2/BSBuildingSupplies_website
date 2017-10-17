
        
<?php
session_start();
include("snippets/meta.html");
include("snippets/db.php");

if ($_POST) 
{

      if($_POST['id']==null){
            header("Location: Index.php");     
      }
      else if($_POST['id']==$_SESSION['id'])
      {

            $id  = $_POST['id'];
            $name  = $_POST['name'];
            $description     = $_POST['description'];
            $price = $_POST['price'];
            $stock   = $_POST['stock']; 
            try {
            $DBH    = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $sql1 = "UPDATE bsbulding.products SET p_name=?, p_description=?, p_price=?, p_stock=? WHERE p_id=?";
            $sth = $DBH->prepare($sql1);
                
            $sth->bindParam(1, $name, PDO::PARAM_STR);
            $sth->bindParam(2, $description, PDO::PARAM_STR);
            $sth->bindParam(3, $price, PDO::PARAM_STR);
            $sth->bindParam(4, $stock, PDO::PARAM_STR);
            $sth->bindParam(5, $id, PDO::PARAM_STR);  
            $sth->execute();
            }catch (PDOException $e) {echo 'Error';}
            include("snippets/header.php");
            echo "<br><br><br><h3>Product ".$id ." - ". $name . " is updated!</h3><br><br><a href='Index.php' data-theme='b' data-role='button' name='log in'data-transition='flow' >Home</a><br><br>" ;
            include("snippets/footer.php");
      }
      else
      {
            $id = $_POST['id'];
            $DBH = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
            $q = $DBH->prepare('SELECT * FROM products WHERE p_id= :id');
            $q->bindValue(':id', $id);
            $q->execute();
            $check = $q->fetch(PDO::FETCH_ASSOC);
            if (!empty($check))
            {          # code...
                    $_SESSION['nav']="HO";
                    include("snippets/header.php");
                    echo "<br><br><h3>Product ID already taken please try again.</h3><br><br><a href='Index.php' data-role='button' name='mainmenu' data-theme='b' data-transition='flow' >Home</a><br><br>";
                    include("snippets/footer.php");
            } 
            else 
            {
                    $id  = $_POST['id'];
                    $name  = $_POST['name'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $stock   = $_POST['stock'];
                             
                    try {
                    $DBH    = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                    $sql    = "INSERT INTO products (p_id, p_name, p_description, p_price, p_stock) VALUES (?,?,?,?,?)";
                        
                    $sth = $DBH->prepare($sql);    
                    $sth->bindParam(1, $id, PDO::PARAM_STR);
                    $sth->bindParam(2, $name, PDO::PARAM_STR);
                    $sth->bindParam(3, $description, PDO::PARAM_STR);
                    $sth->bindParam(4, $price, PDO::PARAM_STR);
                    $sth->bindParam(5, $stock, PDO::PARAM_STR);
                    $sth->execute();
                        
                    }catch (PDOException $e) {echo 'Error';}
                    include("snippets/header.php");
                    echo "<br><br><h3>The product ".$id." - ".$name." - " ." has been added!</h3><br><br>
                    <a href='Index.php' data-role='button' name='mainmenu' data-theme='b' data-transition='flow' >Home</a><br><br>";
                    include("snippets/footer.php");
            }  
      }
                
} else 
{
header("Location: Index.php");

}

?>


    