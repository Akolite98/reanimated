<?php
require_once('private/initialize.php');
$errors = [];
if(is_post_request()) {

  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  

  // Validations
  if(is_blank($email)) {
    $errors[] = "email cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }
  if(empty($errors)){
    $sql = "SELECT * FROM register ";
    $sql .= "WHERE email='". db_escape($db,$email)."'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user=mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      if($user){
          if(password_verify($password , $user['password'])){
              log_in_user($user);
              redirect_to(url_for('read.php'));
          }else{
            //matnumber found but password does not match
            $errors[] = "Please enter the correct email and password";
            
          }
      }
      else{
        //no matnumber was found
         $errors[] = "log in not successful";
            
      }
  }

}



?>
<style>
  
  #click{
    color:white;
  width: 300px;
  float:left;
  padding: 10px 20px 40px 50px;
   margin: 50px 40px 100px 400px;
  border-radius: 10px;
  background-image: url(assets/img/map.png);
  background-size: cover;


}

</style>


<body>
   <!--<img src="img/flathouse.jpg" class="signupContent" alt=""> -->
  

	
    <div class="container" >
    <div class="row " id="Click" > 
        <div class="col-md-6 col-lg-6 col-sm-6" >
	        <h1 class="text-black" style="color: white " text-aglin:center>If you don't have an account you can register here?</h1><h4 style="text-align: center;"><a href="register.php" style="color: red">Click Here</a></h4>
            <?php  echo display_errors($errors);?>
        </div>
        <div class="col-md-3 col-lg-4 col-sm-6">
            <div class="card">
            <div class="card-header">
            <div class="card-subtitle">
                <h4 class="text-success">Login form</h4>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Enter Your email" required style="color:green" ><br><br> 
                    </div>
                    <div class="form-group">
                        <input type="password"  name="password"  required placeholder="Enter Your Password" class="form-control theForm">
                    </div>
                    <div class="btn text-center"><br><br>
                            <button type="submit"  name="login" class="btn btn-primary">Submit</button>
                           
                    </div>
                </form>
            </div>
            </div>
            </div>

        </div>
    
    </div>
    </div>
    