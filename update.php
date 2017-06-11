<?php
    include 'conn.php';
    
    if(!$_SESSION['loggedinUser']){
        header('location:index.php');
    }
    
    
    if(isset($_POST['update'])){
       $emp_name = $_POST['name'];
       $emp_email = $_POST['email'];
       $emp_paidleave = $_POST['paidleave'];
       $emp_unpaidleave = $_POST['unpaidleave'];
       $emp_salary = $_POST['salary'];
     
        if($stmt = $conn->query("update employees set emp_name='".$emp_name."' , emp_email='".$emp_email."' ,  emp_paidleave='".$emp_paidleave."' , emp_unpaidleave = '".$emp_unpaidleave."' , emp_salary = '".$emp_salary."' where emp_id = '".$_GET['id']."' ")){
            header('location:dashboard.php');
        }  
    }
?>

<html>
    <head>
        <title>Holiday Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                        <a href="#" title="ADD EMPLOYEE" data-toggle="modal" data-target="#myModal">ADD Employee</a>
                        <a href="logout.php" title="Click To Logout">logout</a>
                    </div>
                </div>
            </div>    
            
            
            <div class="employee">
                <div class="employee_info">
                
                
                 <?php 
                 if($stmt = $conn->query("select * from employees where emp_id='".$_GET['id']."'")){
                        while($s = $stmt->fetch_array(MYSQLI_ASSOC)){
                   ?>
                
                    <form method="post" action="" class="updateform">
                        <div class="form-group">
                            <label for="emp_id">Employee ID</label>
                            <input type="text" name="employee_id" value=<?php echo $s['emp_id'] ?> id="emp_id" readonly="readonly="/>
                            <label for="emp_name">Employee Name</label>
                            <input type="text" name="name" value="<?php echo $s['emp_name'] ?>" id="emp_name"  />
                            <label for="emp_email">Employee E-mail</label>
                            <input type="text" name="email" value=<?php echo $s['emp_email'] ?> id="emp_email" />
                            <label for="emp_paidleave">Employee Paid Leave</label>
                            <input type="number" name="paidleave" value=<?php echo $s['emp_paidleave']  ?> id="emp_paidleave" />
                            <label for="emp_unpaidleave">Employee Unpaid Leave</label>
                            <input type="number" name="unpaidleave" value=<?php echo $s['emp_unpaidleave'] ?> id="emp_unpaidleave" />
                            <label for="emp_salary">Employee Salary</label>
                            <input type="text" name="salary" value=<?php echo $s['emp_salary'] ?> id="emp_salary" />
                            <input type="submit" value="UPDATE" name="update"/>
                        </div>
                    </form>
                    
                    <?php
                    
                        }
                 }
                    ?>
                    
                </div>
            </div>
            
              <footer>
                <div class="footer_container">
                    &copy; Holiday Management System
                </div>
            </footer>
        </div>
        
        
        <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Holiday Management System</h4>
        </div>
        <div class="modal-body">
          
         
          
          <form method="post" action="#">
            <input type="text" id="emp_id" placeholder="emp-id:- 121" name="id" required="required"/>
            <input type="text" id="emp_name" placeholder="emp-name:- rahul sharma" name="name" required="required" />
            <input type="email" id="emp_email" placeholder="emp-email:- rahul.sharma@gmail.com" name="email" required="required"/>
            <input type="number" min="0" max="10" value="2" name="paidleave" required="required"/>
            <input type="text" placeholder="emp-salary:- 50000" name="salary" required="required" />
            <input type="submit" value="ADD EMPLOYEE" name="submit" />
          </form>
          
        </div>
      </div>
      
    </div>
  </div>
    </body>
</html>