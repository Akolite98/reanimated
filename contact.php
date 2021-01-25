<?php

require_once('private/initialize.php');
// to check if a post request was made
if(is_post_request()){
//To collect user input and using htmlspecialchar function
$name = h($_POST['name']);
$email = h($_POST['email']);
$subject = h($_POST['subject']);
$message = h($_POST['message']);

//send to the database

//write sql query
	$sql = "INSERT INTO contact ";
	$sql .= "(name,email,subject,message)";
	$sql .= "VALUES (";
	$sql .= "'" . db_escape($db, $name). "',";
  $sql .= "'" . db_escape($db, $email). "',";
  $sql .= "'" . db_escape($db, $subject). "',";
  $sql .= "'" . db_escape($db, $message). "'";
  $sql .= ")";
  
 


  //run sql query function that will send data to database
  $result = mysqli_query($db, $sql);
  
  //check if the query successful
	confirm_result_set($result);

	if($result){
      //redirect to the homepage.
      redirect_to('contact.php');
    }
	else{
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
  }
}


 

 
 ?>
 
 
  <?php include('header.php');?>                                                                                                          
<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">

      <div class="container">

        <div class="section-title">
          <h2 style="color:green">Contact</h2>
         
        </div>

        <div class="row" data-aos="fade-in">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"  style="color:green"></i>
                <h4>Location:</h4>
                <p><strong>Nigerian</strong></p>
              </div>

              <div class="email">
                <i class="icofont-envelope" style="color:green"></i>
                <h4>Email:</h4>
                <p><strong>canicechideraphy@gmail.com</strong></p>
              </div>

              <div class="phone">
                <i class="icofont-phone"  style="color:green"></i>
                <h4>Call:</h4>
                <p><strong>+2349031546475,  +2348100212184</strong></p>
                
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="contact.php" method="POST">
            
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" required class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" required  name="email" id="email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Subject</label>
                <input type="text" class="form-control" required  name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <label for="name">Message</label>
                <textarea class="form-control" required  name="message" rows="10" data-rule="required" data-msg="Please write something for us"></textarea>
                <div class="validate"></div>
              </div>
              
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->
    <?php include('footer.php')?>
    

 