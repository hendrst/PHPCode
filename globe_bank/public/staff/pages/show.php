<?php require_once("../../../private/initialize.php");?>

<?php require_login();?>

<?php
    $id = $_GET['id'] ?? '1';
    $page = find_page_by_id($id);
    $subject = find_subject_by_id($page['subject_id']);
?>
<?php include (SHARED_PATH . "/staff_header.php");?>
	<a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($subject['id']))); ?>">&laquo; Back to Subjects</a>
	
    <h1>Page: <?php echo h($page['menu_name']); ?></h1>
    <div class="actions">
    	<a class="action" href=<?php echo url_for('/index.php?id=' . h(u($page['id'])) . "&preview=true ");?> target="_blank">Preview Content</a>
    </div>
    <div class="attributes">
      <dl>
      	<dt>Subject</dt>
      	<dd><?php echo $subject['menu_name'];?></dd>
      </dl>    
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($page['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($page['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
      <dl>
      	<dt>Content</dt>
      	<dd><?php echo h($page['content']);?>
      </dl>
    </div>
	<br/>
 <?php include (SHARED_PATH . "/staff_footer.php");?>