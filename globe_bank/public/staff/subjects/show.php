<?php require_once("../../../private/initialize.php");?>

<?php require_login();?>

<?php
    //set default value of 'id' if none exists
    //php 7.0 specific
    //alternate ternary expression for this
    //$id = isset($_GET["id"]) ? $_GET["id"] : '1';
    //echo h($id);    //h() calls htmlspecialchars which renders special chars to test, prevents cross site scripting
    $id = $_GET['id'] ?? '1';
    
    $subject = find_subject_by_id($id);
    $pages_set = find_pages_by_subject_id($id, ['visible' => false]);
?>
<?php include(SHARED_PATH . "/staff_header.php");?>

	<a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>
	
    <h1>Subject: <?php echo h($subject['menu_name']); ?></h1>
    
    <div class="attributes">
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($subject['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($subject['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
      <hr />
	<div class = "Pages Listing">
    	<h2>Pages</h2>
    	<div class = "actions">
    		<a class = "action" href="<?php echo url_for('/staff/pages/new.php?subject_id=' . h(u($subject['id'])));?>">Create New Page</a>
    	</div>
    	
    	<table class = 'list'>
    		<tr>
    			<th>ID</th>
    		    <th>Position</th>
    		    <th>Visible</th>
    		    	<th>Name</th>
    		    	<th>&nbsp;</th>
    		    	<th>&nbsp;</th>
    		    	<th>&nbsp;</th>
    		 </tr>
    		 
    		 <?php while($page = mysqli_fetch_assoc($pages_set)) { ?>
    		 	<tr>
    		 		<td><?php echo h($page['id']);?></td>
    		 		<?php
//     		 		   $subject = find_subject_name_by_id(h($page['subject_id']));
//     		 		   if(isset($subject)) {
//     		 		       echo "<td>" . $subject['menu_name'] . "</td>";    		 		       
//     		 		   } else {
//     		 		       echo "<td>Not Defined</td>";
//     		 		   }
//     		 		?>
    		 		<td><?php echo h($page['position']);?></td>
    		 		<td><?php echo $page['visible'] == 1? 'true' :'false';?></td>
    		 		<td><?php echo h($page['menu_name']);?></td>
    		 		<td><a class = "action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id'])));?>">"View"</a></td>
    		 		<td><a class = "action" href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id'])));?>">"Edit"</a></td>
    		 		<td><a class = "action" href="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id'])));?>">"Delete"</a></td>    		 		
    		 	</tr>
    		 <?php }?>	
    	</table>
    	<?php mysqli_free_result($pages_set);?>
	</div>      
    </div>
	<br/>
<?php include(SHARED_PATH . "/staff_footer.php");?>   

<!--urlencode for parameters-->
<!-- rawurlencode for anything before parameter -->
<!-- <a href="show.php?name=<?php echo u('John Doe'); ?>">Link</a><br /> --->
<!-- <a href="show.php?company=<?php echo u('Widgets&More'); ?>">Link</a><br /> -->
<!-- <a href="show.php?query=<?php echo u('!#*?'); ?>">Link</a><br /> -->