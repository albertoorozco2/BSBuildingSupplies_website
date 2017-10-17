
<?php include("snippets/meta.html"); ?>
<div data-role="page">
<?php
session_start();
include ("snippets/db.php");
$_SESSION['nav']= "";
$_SESSION['item']="";


if (!isset($_SESSION['LOGGEDIN']) || $_SESSION['LOGGEDIN'] == FALSE)
{

      if ($_POST)
      {
            if ($_POST['captcha2'] == $_SESSION['captcha']['code'])
            {
                  $username = $_POST["username"];
                  $password = md5($_POST["password"]."SWH");
                  $q = $DBH->prepare('SELECT * FROM users WHERE u_username= :username AND u_pass= :password LIMIT 1');
                  $q->bindValue(':username', $username);
                  $q->bindValue(':password', $password);
                  $q->execute();
                  $check = $q->fetch(PDO::FETCH_ASSOC);
                  $row = $q->fetch(PDO::FETCH_ASSOC);
                  if (!empty($check))
                  {
                        $_SESSION['LOGGEDIN'] = TRUE;
                        $_SESSION['type'] = $check['u_type'];
                        $_SESSION['username'] = $username;
                        $_SESSION['details'] = "Name:  " . $check['u_firstname'] . " , " . $check['u_surname'] . " /  Address: " . $check['u_addre'] . "  / Tel: " . $check['u_tel'] . " / Email: " . $check['u_email'];
                        header('Location: Index.php');
                  }
                  else
                  {
                      $_SESSION['LOGGEDIN'] = FALSE;
                      include ("snippets/header.php");
                      echo "<p class='aler' >wrong credentials</p>";
                      include ("snippets/login.php");

                  }
            }
            else
            {
            $_SESSION['LOGGEDIN'] = FALSE;
            include ("snippets/header.php");
            echo "<p class='aler' >wrong captcha</p>";
            include ("snippets/login.php");
            }
      }  
      else
      {
      $_SESSION['LOGGEDIN'] = FALSE;
      include ("snippets/header.php");
      include ("snippets/login.php");

      }
}
elseif (isset($_SESSION['LOGGEDIN']) || $_SESSION['LOGGEDIN'] == TRUE)
{
      $username = $_SESSION['username'];
      $q = $DBH->prepare('SELECT * FROM users WHERE u_username= :username');
      $q->bindValue(':username', $username);
      $q->execute();
      $check = $q->fetch(PDO::FETCH_ASSOC);
      $row = $q->fetch(PDO::FETCH_ASSOC);
      $_SESSION['type'] = $check['u_type'];
      $_SESSION['details'] = "Name:  " . $check['u_firstname'] . " , " . $check['u_surname'] . "  /  Address: " . $check['u_addre'] . "  / Tel: " . $check['u_tel'] . "  / Email: " . $check['u_email'];
                  


      if($_SESSION['type'] == 'admin')
      {
            if($_GET){
            $_SESSION['nav']= "HO";
            include ("snippets/header.php");
            include ("snippets/updateacc.php");

            }else{

            $_SESSION['nav']= "O";     
            include ("snippets/header.php");
            include ("snippets/viewlist.php");
            }
      }
       else if($_SESSION['type'] == 'deliver')
      {
      $_SESSION['nav']= "O";     
      include ("snippets/header.php");
      include ("snippets/viewlist.php");
      }
       else if($_SESSION['type'] == 'staff')
      {     $_SESSION['id']=null; 
            if(!isset($_GET['menu']))
            {
            $_SESSION['nav']= "O";           
            include ("snippets/header.php");
            include ("snippets/menu.php");
            }
            elseif($_GET['menu']==1)//view products
            {
            $_SESSION['nav']= "HO";
            include ("snippets/header.php");
            include ("snippets/viewlist.php");
            } 
            elseif($_GET['menu']==2)
            {
            $_SESSION['nav']= "HO";     
            include ("snippets/header.php");
            include ("snippets/createproduct.php");
            }
            else
            {
            include ("snippets/header.php");
            include ("snippets/menu.php");
            }



      } 
      else
      {
            if(!isset($_GET['menu']))
            {
            $_SESSION['nav']= "CO";     
            include ("snippets/header.php");
            include ("snippets/menu.php");
            }
            elseif($_GET['menu']== 1)//view products
            {
            $_SESSION['nav']= "HCO";     
            $_SESSION['submenu']=1;     
            include ("snippets/header.php");
            include ("snippets/viewlist.php");
            }
            elseif($_GET['menu']== 2)//view orders
            {
            $_SESSION['nav']= "HCO";     
            $_SESSION['submenu']=2;
            $_SESSION['item']='order';
            include ("snippets/header.php");
            include ("snippets/viewlist.php");
            }
            elseif($_GET['menu']==3)
            {
            $_SESSION['nav']= "HCO";     
            include ("snippets/header.php");
            include ("snippets/updateacc.php");
            }
            elseif($_GET['menu']==4)//cart
            {
            $_SESSION['nav']= "HO";
            $_SESSION['submenu']=3;
            include ("snippets/header.php");
            include ("snippets/viewlist.php");
            }
            else
            {
            include ("snippets/header.php");
            include ("snippets/menu.php");
            }

        
      }
}
else
{
      $_SESSION['LOGGEDIN'] = FALSE;
      include ("snippets/header.php");
      include ("snippets/login.php");
}

?>
<?php include ("snippets/footer.php"); 
?>
</body>
</html>
