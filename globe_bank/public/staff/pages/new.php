<?php require_once("../../../private/initialize.php");

require_login();

// if(!isset($_GET['id'])) {
//     redirect_to(url_for('/staff/subjects/index.php'));
// }
//$id=$_GET['id'];
// $menu_name=''; 
// $subject_id='';
// $position = '';
// $visible = '';
// $content = '';
// $subject = [];
// $page = [];

 if(is_post_request()) {
     // Handle form values sent by new.php
     $page['menu_name'] = $_POST['menu_name'] ?? '';
     $page['subject_id'] = $_POST['subject_id'];
//     $page['subject_id'] = $_POST['subject_id'] ?? '';
     $page['position'] = $_POST['position'] ?? '';
     $page['visible'] = $_POST['visible'] ?? '';
     $page['content'] = h($_POST['content'] ?? '');
    
     $result = insert_page($page);
     if($result === true) {
         $_SESSION['status'] = 'Pages sucessfully created.';
         $new_id = mysqli_insert_id($db);
         redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));
     } else {
         $errors = $result;
     }
 } else {
     $page = [];
     $page['subject_id'] =  $_GET['subject_id'] ?? '';
     $page['menu_name'] = '';
     $page['position'] = '';
     $page['visible'] = '';
     $page['content'] = '';     
     
 }
 
$page_count = count_pages_by_subject_id($page['subject_id'], ['visible' => false]) + 1;
 $subjects_set = find_subject_names();
?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

	<a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id']))); ?>">&laquo; Back to Subjects</a>

  <div class="subject new">
    <h1>Create Page</h1>

    <?php echo display_errors($errors);?>

     <form action="<?php echo url_for('/staff/pages/new.php');?>" method="post">
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
      	</dd>	
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
                if($page['position'] == $i) {
                    echo " selected";
                }
                echo ">${i}</option>";
            }
            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
           <input type="checkbox" name="visible" value="1"<?php if($page['visible'] == "1") { echo " checked"; }?> /> 
        </dd>
      </dl>
      <dl>
      	<dt>Content</dt>
      	<dd>
      	   <textarea name="content" cols="40" rows="10"><?php echo h($page['content']);?></textarea>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>

  </div>

</div>
<?php mysqli_free_result($subjects_set);?>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
