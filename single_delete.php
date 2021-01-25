<?php 

require_once('private/initialize.php');
require_user_login();
include('header.php');
// we are getting the id from the url 
$id = $_GET['id'];


$sql = "SELECT * FROM contact ";
$sql .= "WHERE id='". db_escape($db,$id)."'";
$result = mysqli_query($db, $sql);
confirm_result_set($result);
$contact=mysqli_fetch_assoc($result);
  mysqli_free_result($result);
 

if(is_post_request()){

    $sql = "DELETE FROM contact ";
    $sql .= "WHERE id='" . db_escape($db,$id) ."'";
     $sql .= "LIMIT 1";
     $result = mysqli_query($db, $sql);
    
     // For DELETE statements, $result is true/false
     if($result) {
      $_SESSION['message'] = "user deleted succesfully";
      redirect_to(url_for('/read.php'));
    
     return true;
       
     } 
     else {
       // DELETE failed
       echo mysqli_error($db);
       db_disconnect($db);
       exit;
     }


}



?>

<h4 class="text-info">Are You Sure You Want To Delete <?php echo h($contact['name']); ?></h4>

<form action="<?php echo url_for('/single_delete.php?id=' . h($contact['id'])); ?>" method="post">
  <div id="operations">
    <input type="submit" name="commit" value="Delete User" />
  </div>
</form>