<?php 


require_once('private/initialize.php');
require_user_login();
include('header.php');
//query to read all data from the database.
$sql = "SELECT * FROM contact ";
$sql .= "ORDER BY id ASC";
$contacts = mysqli_query($db, $sql);
confirm_result_set($contacts);

?>
<style>
#message{
  color:white;
  background-color:red;
  padding:24px;
  border-radius: 24px;
  width: 200px;
}
</style>



<table class="table">
<p id="<?php echo $_SESSION['message'] == null ? '' : 'message'  ?>"><?php echo  get_and_clear_session_message()?></p>  
  <thead class="thead-dark">
<h1 style="color:blue;">Welcome <?php echo $_SESSION['name']; ?> <a href="logout.php" style="color:red">Logout</a> </h1>
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

  <?php while($contact = mysqli_fetch_assoc($contacts)) {?>
		<tr>
			<td><?php echo h($contact['id']); ?></td>
			<td><?php echo h($contact['name']); ?></td>
			<td><?php echo h($contact['email']); ?></td>
            <td><?php echo h($contact['subject']); ?></td>
			<td><?php echo $contact['message']; ?></td>
			<td><?php echo $contact['time']; ?></td>
			<td class="btn btn-secondary"><a class="action" href="<?php echo url_for('/single_read.php?id=' . $contact['id']) ;?>">CLICK TO VIEW</a></td>
			<td class="btn btn-primary"><a class="action" href="<?php echo url_for('/single_edit.php?id=' . $contact['id']) ;?>">CLICK TO EDIT</a></td>
			<td class="btn btn-primary"><a class="action" href="<?php echo url_for('/single_delete.php?id=' . $contact['id']) ;?>">CLICK TO DELETE</a></td>
		</tr>
	<?php }?>
   
  </tbody>
</table>

<?php
  mysqli_free_result($contacts);
 ?>



<?php include('footer.php');?>