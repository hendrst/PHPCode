<?php require_once("../../../private/initialize.php");?>

<?php require_login();?>

<?php
    $id = $_GET['id'] ?? '1';
    $admin = find_admin_by_id($id);
?>
<?php include (SHARED_PATH . "/staff_header.php");?>
	<a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>
	
    <h1>Admin: <?php echo h($admin['username']); ?></h1>
    <div class="attributes">
      <dl>
      	<dt>First Name</dt>
      	<dd><?php echo $admin['first_name'];?></dd>
      </dl>    
      <dl>
        <dt>Last Name</dt>
        <dd><?php echo h($admin['last_name']); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($admin['email']); ?></dd>
      </dl>
      <dl>
      	<dt>Username</dt>
      	<dd><?php echo h($admin['username']);?>
      </dl>
    </div>
	<br/>
 <?php include (SHARED_PATH . "/staff_footer.php");?>