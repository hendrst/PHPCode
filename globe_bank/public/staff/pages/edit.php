<?php require_once("../../../private/initialize.php");

require_login();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}
$id=$_GET['id'];
$subject_id = '';
$menu_name='';
$position = '';
$visible = '1';
$content = '';
$page = [];

if(is_post_request()) {
    // Handle form values sent by new.php
    $page['id'] = $id;
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';
    
    $result = update_page($page);
    if($result === true) {
        $_SESSION['status'] = 'Edit sucessfully saved.';
        redirect_to(url_for('/staff/pages/show.php?id=' . $page['id']));        
    } else {
        $errors = $result;
    }
} else {
    $page = find_page_by_id($id);    
} 

$page_count = count_pages_by_subject_id($page['subject_id'], ['visible' => false]);

$subjects_set = find_subject_names();
?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

	<a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id']))); ?>">&laquo; Back to Subjects</a>
  
  <div class="subject edit">
    <h1>Edit Page</h1>

  <?php echo display_errors($errors);?>  

    <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id']))); ?>" method="post">
      <dl>
      	<dt>Subject</dt>
      	<dd>
      	  <select name="subject_id">
            <?php
            while($subject = mysqli_fetch_assoc($subjects_set)) {
                echo "<option value=\"${subject['id']}\"";
                if($page['subject_id'] == $subject['id']) {
                    echo " selected";
                }
                echo ">${subject['menu_name']}</option>";
            }
            ?>      	  	
      	  </select>
      </dl>    
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']);?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
          <?php 
          for($i = 1; $i <= $page_count; $i++) {
              echo "<option value=\"${i}\"";
              if ($page['position'] == $i) {
                  echo " selected";
              }
              echo ">${i}</option>";
          }
          ?>
          </select>
        </dd>
      </dl>
      <dl>
      	<dt>Content</dt>
        <dd><textarea name="content" cols = "40" rows = "5"><?php echo h($page['content']);?></textarea>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
		  <input type="checkbox" name="visible" value="1"<?php if($page['visible'] == "1") { echo " checked"; }?> />            
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>

  </div>

</div>
<?php
    if(isset($subjects_set)) {
        mysqli_free_result($subjects_set);
    }
?>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>

