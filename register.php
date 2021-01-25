<?php 
require_once('private/initialize.php');
$errors=[];
// we will get the user details
// to check if a post request was made
if(is_post_request()){
    //To collect user input and using htmlspecialchar function
    $name = h($_POST['name']);
    $email = h($_POST['email']);
    $password = h($_POST['password']);
    $confirm_password = h($_POST['confirm_password']);
    

    // validating password
    if(is_blank($password)) {
        $errors[] = "Password cannot be blank.";
    }
      // } elseif (!has_length($password, array('min' => 4))) {
      //   $errors[] = "Password must contain 8 or more characters";
      // } elseif (!preg_match('/[A-Z]/', $password)) {
      //   $errors[] = "Password must contain at least 1 uppercase letter";
      // } elseif (!preg_match('/[a-z]/', $password)) {
      //   $errors[] = "Password must contain at least 1 lowercase letter";
      // } elseif (!preg_match('/[0-9]/', $password)) {
      //   $errors[] = "Password must contain at least 1 number";
      // } elseif (!preg_match('/[^A-Za-z0-9\s]/', $password)) {
      //   $errors[] = "Password must contain at least 1 symbol";
      // }
  // check if password is equal to confirm password
      if(is_blank($confirm_password)) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($password !== $confirm_password) {
        $errors[] = "Password and confirm password must match.";
      }

    // hash password

    if(empty($errors)){
        //send to the database


        //hash password 
        $hashed_password = password_hash( $password , PASSWORD_BCRYPT);
    

         //write sql query
        $sql = "INSERT INTO register ";
        $sql .= "(name,email,password)";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $name). "',";
        $sql .= "'" . db_escape($db, $email). "',";
        $sql .= "'" . db_escape($db, $hashed_password). "'";
        $sql .= ")";
      
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);


        if($result){
            //echo "<script> alert('Registeration Successful') </script>";
            redirect_to(url_for('read.php'));
           
             }
             else{
                echo mysqli_error($db);
                db_disconnect($db);
                exit;
              }
      
      }
    
   
  
    
    }
    
   




//insert the user details to the database





?>


<style>
#get{
  color:white;
  background-color:rgb(110,180,110);
  padding:4px;
  border-radius: 4px;
  text-align:center;
  
  
}
#name{

    text-align:center;
}
</style>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        <form action="register.php" method="post" >
            <div >
            <h1 id='get'>ACCOUNT</h1>
            </div>
            <?php  echo display_errors($errors);?>
            </div >
                <input type="name" name="name" placeholder="Name"><br><br>
            </div>
            <div>
                <input type="email" name="email" placeholder="Email"><br><br>
            </div>

            <div>
                <input type="password" name="password" placeholder="Password"><br><br>
                <input type="password" name="confirm_password" placeholder="Confirm password">
            </div><br>
            <div>
           
            <input type="submit" value="Register" >
            </div>
          
              