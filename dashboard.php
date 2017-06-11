<?php
    include 'conn.php';
    
    if(!$_SESSION['loggedinUser']){
        header('location:index.php');
    }
    
    
    if(isset($_POST['submit'])){
       $emp_id = $_POST['id'];
       $emp_name = $_POST['name'];
       $emp_email = $_POST['email'];
       $emp_paidleave = $_POST['paidleave'];
       $emp_salary = $_POST['salary'];
       $admin_id = 1;
       $emp_unpaidleave = 0;
       
       if($stmt = $conn->prepare("INSERT into employees set emp_id = ?,emp_name = ?,emp_email = ?,emp_paidleave = ?,emp_unpaidleave = ?,emp_salary = ?,admin_id = ?")){
           $stmt->bind_param('sssssss',$emp_id,$emp_name,$emp_email,$emp_paidleave,$emp_unpaidleave,$emp_salary,$admin_id);
           $stmt->execute();
           if($stmt->affected_rows==1){
              
           }
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
            
            <div class="employee_details">
                <div class="employee_container">
                    <h1>Employees</h1>
                    <table class="table">
                    <thead>
                        <tr>
                            <th>Employee_id</th>
                            <th>Employee_name</th>
                            <th>Employee_email</th>
                            <th>Employee_paidleave</th>
                            <th>Employee_unpaidleave</th>
                            <th>Employee_salary</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                <?php
                    if($stmt = $conn->query("SELECT * from employees")){
                        while ($r = $stmt->fetch_array(MYSQLI_ASSOC)){
                        $net_salary = $r['emp_salary'] - ( ($r['emp_salary'] / 30) * $r['emp_unpaidleave']);                                                    
                ?>
                
                        <tr>
                            <td><?php echo $r['emp_id'] ?></td>
                            <td><?php echo $r['emp_name'] ?></td>
                            <td><?php echo $r['emp_email'] ?></td>
                            <td><?php echo $r['emp_paidleave'] ?></td>
                            <td><?php echo $r['emp_unpaidleave'] ?></td>
                            <td><?php echo round($net_salary,0) ?></td>
                            <td>
                                <a href="delete.php?id=<?php echo $r['id'] ?>" id="delete" title="delete">Delete</a>
                                <a href="update.php?id=<?php echo $r['emp_id'] ?>" id="update" title="update">Update</a>
                            </td>
                        </tr>
                        
                <?php
                    
                        }
                    }              
                ?>
                        
                    </tbody>
                </table>
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