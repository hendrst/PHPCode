<?php
    if(!isset($page_title)) {$page_title = 'Staff Area';}
    $username = $_SESSION['username'] ?? '';
    //if(!isset($_SESSION['username'])) {$_SESSION['username'] = $username;}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<link rel = "stylesheet" media = "all" href="<?php echo url_for('/stylesheets/staff.css');?>" /> 
<title>GBI - <?php echo h($page_title);?></title>
</head>
    <body>
     <header>
      <h1>GBI Staff Area</h1>
     </header>
     
     <navigation>
     	<ul>
     	    <li>User: <?php echo $username;?></li>
     		<li><a href="<?php echo url_for('/staff/index.php'); ?>">Menu</a></li>
     		<li><a href="<?php echo url_for('/staff/logout.php'); ?>">Logout</a></li>
     	</ul>
     </navigation>
     
     <?php echo display_session_message(); ?>