<?php
  include 'conn.php';
  if(isset($_POST['login'])){
     $username = $_POST['username'];
     $password = $_POST['password'];
    
                    if($stmt=$conn->query("SELECT *  from admin where username ='".$username."' and password = '".$password."'")){
                        if($stmt->num_rows>0){
                            $_SESSION['loggedinUser'] = $username;
                            header('location:dashboard.php');
                        }
                       }
  }
?>

<html>
    <head>
        <title>Holiday Management System</title>
        <link href="css/style.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div class="main_wrapper">
            <div class="header"/>
                <div class="header_container">
                    <a class="logo_content" href="#" title="Holiday Management System">
                        Holiday Management System
                    </a>
                    <div class="header_nav">
                        <a href="login.php" title="Login">Login</a>
                    </div>
                </div>
            </div>
            <div class="login_wrapper">
            
                <h2 style="text-transform: uppercase;text-align: center;font-weight: bold;padding-top: 15px;">Login</h2>
            
                <form method="post" action="#">
                    <input type="text" id="username" name="username" placeholder="Username" required="required" />
                    <input type="password" id="password" name="password" placeholder="Password" required="required"/>
                    <input type="submit" value="login" name="login" id="login" />
                </form>
            </div>
             <footer>
                <div class="footer_container">
                    &copy; Holiday Management System
                </div>
            </footer>
        </div>
    </body>
</html>