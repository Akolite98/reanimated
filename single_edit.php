<?php

require_once('private/initialize.php');
require_user_login();
include('header.php');
// we are getting the id from the url 
$id = $_GET['id'];

// we are quering the database using the id
$sql = "SELECT * FROM contact ";
$sql .= "WHERE id='". db_escape($db,$id)."'";
$result = mysqli_query($db, $sql);
confirm_result_set($result);
$contact=mysqli_fetch_assoc($result);
  mysqli_free_result($result);


  //check if it is a post request
  if(is_post_request()){
  //collect form inputs
  $name = h($_POST['name']);
  $email = h($_POST['email']);
  $subject = h($_POST['subject']);
  $message = h($_POST['message']);


  //run the update query
  $sql = "UPDATE contact SET ";
  $sql .= "name='" . db_escape($db, $name) ."',";
  $sql .= "email='" . db_escape($db, $email)."',";
  $sql .= "subject='" . db_escape($db, $subject)."',";
  $sql .= "message='" . db_escape($db, $message)."'";
  $sql .= "WHERE id='" . $id ."'";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);

  if($result){
    $_SESSION['message'] = 'user edited successful.';
    redirect_to(url_for('single_read.php?id=' .$id));
   return true;
 }else{
   echo mysqli_error($db);
     db_disconnect($db);
     exit;
 }

  }

  

  
 
 



?>
<div class="container">
  <div class="row">
    <div class="col-md-4 mb-3">
      <form action="<?php echo url_for('/single_edit.php?id='. h($id)); ?>" method="POST">
        <div id="sendmessage">Your message has been sent. Thank you!</div>
        <div id="errormessage"></div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="form-group">
              <input type="text" name="name" required class="form-control" id="name" placeholder="Your Name"
                value="<?php echo h($contact['name']); ?>"  />
              <div class="validation"></div>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <div class="form-group">
              <input type="email" class="form-control" required name="email" id="email" placeholder="Your Email"
              value="<?php echo h($contact['email']); ?>"   />
              <div class="validation"></div>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <div class="form-group">
              <input type="text" class="form-control" required name="subject" id="subject" placeholder="Subject"
              value="<?php echo h($contact['subject']); ?>"   />
              <div class="validation"></div>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <div class="form-group">
              <textarea class="form-control" required name="message" rows="5" data-rule="required"
                data-msg="Please write something for us" placeholder="Message">  <?php echo h($contact['message']); ?> </textarea>
              <div class="validation"></div>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="button button-a button-big button-rouded">Send Message</button>
          </div>
        </div>
      </form>
    </div>
   
  </div>
</div>
