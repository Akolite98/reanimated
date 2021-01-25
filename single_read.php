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
 
  

?>

<style>
#message{
  color:white;
  background-color:green;
  padding:24px;
  border-radius: 24px;
  width: 200px;
}
</style>

<table class="table">
  <p id="<?php echo $_SESSION['message'] == null ? '' : 'message'  ?>"><?php echo  get_and_clear_session_message()?></p>  
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">EMAIL</th>
      <th scope="col">SUBJECT</th>
      <th scope="col">MESSAGE</th>
      <th scope="col">TIME</th>
    </tr>
  </thead>
  <tbody>


		<tr>
			<td><?php echo h($contact['id']); ?></td>
			<td><?php echo h($contact['name']); ?></td>
			<td><?php echo h($contact['email']); ?></td>
            <td><?php echo h($contact['subject']); ?></td>
			<td><?php echo $contact['message']; ?></td>
			<td><?php echo $contact['time']; ?></td>
			
		</tr>

   
  </tbody>
</table>





<?php include('footer.php');?>