<?php 
include "c.php";
session_start();

if(!isset($_SESSION['email']))

{
    header('location:firstpage.php');			

}

?>
<?php
 
 
  $username = "";
 
  $host="localhost";
  $password='';
  $db="attendance";
  $_SESSION['co']='';
  $_SESSION['fname']='';
  
  $conn=mysqli_connect("$host","root","$password","$db");
  if (isset($_POST['login']))
  {
         $course = $_POST['course'];
         $fname = $_POST['fname'];
         $sem = $_POST['sem'];
         $sub = $_POST['sub'];
         $date = $_POST['date'];
         $batch=$_POST['batch'];
         $class=$_POST['class'];
         if(empty($course) || empty($fname) ||empty($sem) || empty($sub)||empty($date)||empty($batch) ||empty($class))
         {
             echo "<script>alert('input fileds are empty')</script>";
         }
         else
         {
           //fetching subject
        
                                           
             $_SESSION['cor'] = $course;
             $_SESSION['fname'] = $fname;
             $_SESSION['sem']=$sem;
             $_SESSION['sub']=$sub;
             $_SESSION['a_date']=$date;
             $_SESSION['batch']=$batch;
             $_SESSION['class']=$class;
 
 
             header('location:attendancedata.php');			
           }
           
         
  
 
  }
 
 
 
 
 
 
 
 
 
 
 
 ?>
<!doctype html>
<html>
<head>
<title>SDM B.voc</title>
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="jquery-1.12.0.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $("#sel_depart").change(function(){
                var deptid = $(this).val();

                $.ajax({
                    url: 'getUsers.php',
                    type: 'post',
                    data: {depart:deptid},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;

                        $("#sel_user").empty();
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var name = response[i]['name'];

                            $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");

                        }
                    }
                });
            });

        });
    </script>
  
</head>
<body >


        
            
<div class="container">  
       
</div> 

<div class="d-flex align-items-stretch" style="background-image: url(back15.jpg);background-repeat:no-repeat;background-size:cover;">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <h1><a href="#" class="logo" style="background:orange;color:#fff;">SDM B.voc</a></h1>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="main.php"><span class="fa fa-home mr-3"></span> Scheduled Class</a>
                </li>
                <li>
                    <a href="changepassword.php"><span class="fa fa-key mr-3"></span> Change password</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-file mr-3"></span>View attendance</a>
                </li>
                <li>
                    <a href="attendanceSummary.php"><span class="fa fa-clipboard mr-2"></span>Attendance Summary</a>
                </li>
                <li>
                    <a href="downloadattendancefile.php"><span class="fa fa-download mr-3"></span>Download attendance File</a>
                </li>
                
                <li>
                    <a href="logout.php"><span class="fa fa-sign-out mr-3"></span> Logout</a>
                </li>

            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <form action ="" method="POST">
            <?php $mail=$_SESSION['email'];
                 $q="select faculty_name,course from faculty where faculty_email='$mail' "; 
                 $res=mysqli_query($conn,$q);
                 $row=mysqli_fetch_assoc($res);
                 $name=$row['faculty_name'];
                 $courses=$row['course'];
                
                 
                   ?>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="color:#000;font-weight: bold;;font-size:16px;">Selected Course</label>
                    <input type="text" id="browser" name="course" list="course" value="<?php echo $courses;   ?>" placeholder="  Select Your course" class="col-lg-12 col-sm-12 col-12 p-2" style="outline:none;color:#000;border:none;text-indent:5px;background:#f1f1f1;cursor: not-allowed;" readonly >
                      
                   
                </div>
               
                <div class="form-group">
               
                    <label for="exampleInputEmail1" style="color:#000;font-weight: bold;;font-size:16px;">Selected Faculty Name</label>
                    <input type="text" id="browser" name="fname"  value="<?php echo $name;   ?>" placeholder="  Select Your Name" class="col-lg-12 col-sm-12 col-12 p-2" style="outline:none;border:none;text-indent:5px;color:#000;background:#f1f1f1;cursor: not-allowed;" readonly > 
                       
                 
                </div>
                <div class="form-group">
                <label for="exampleFormControlSelect1" style="color:#000;font-weight: bold;font-size:16px;">Select Batch Year</label>
                <select class="form-control" name="batch"  required="required">
                <option value=""> Select batch </option>
                <option value="2019">Batch 2019</option>
                <option value="2020">Batch 2020</option>
                <option value="2021">Batch 2021</option>
                <option value="2022">Batch 2022</option>
                <option value="2023">Batch 2023</option>
                </select>
               </div>
                <div class="form-group">
    <label for="exampleFormControlSelect1" style="color:#000;font-weight: bold;font-size:16px;">Select Sem</label>
    <select  id="sel_depart" name="sem" class="form-control"  required="required">
    <option value=""> Select Your Sem </option>
    <?php 
            // Fetch Department
            $sql_department = "SELECT * FROM semester";
            $department_data = mysqli_query($con,$sql_department);
            while($row = mysqli_fetch_assoc($department_data) ){
                $departid = $row['id'];
                $depart_name = $row['sem_name'];
              
                // Option
                echo "<option value='".$departid."' >".$depart_name."</option>";
            }
            ?>
     </select>

  </div>
        <div class="clear"></div>

      
      
                <div class="form-group">
            <label for="exampleFormControlSelect1"  style="color:#000;font-weight: bold;;font-size:16px;">Select Subject</label>
            <select   id="sel_user" class="form-control" name="sub" required="required">
            <option value="0"> Select Your Subject </option>
            </select>
        </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" style="color:#000;font-weight: bold;;font-size:16px;" required >Select Date</label>
                    <input type="date" name="date"  max="<?php 
         echo date('Y-m-d');
     ?>"  class="form-control border" id="exampleInputdate"   required="required">
                </div>
                <div class="form-group">
                <label for="exampleFormControlSelect1" style="color:#000;font-weight: bold;font-size:16px;">Select Class</label>
                <select class="form-control" name="class"  required="required">
                <option value=""> Select Class </option>
                <option value="1">Class 1</option>
                <option value="2">Class 2</option>
                <option value="3">Class 3</option>
                <option value="4">Class 4</option>
                <option value="5">Class 5</option>
                </select>
               </div>

                <button type="submit" name="login" class="btn btn-danger">Submit</button>

               
            </form>
        </div>

    </div>
    <?php include 'footer.html';?>
    <script src="js/main.js"></script>
</body>

</html>
