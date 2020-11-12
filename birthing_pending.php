<!DOCTYPE html>
<?php
	require_once'logincheck.php';
	$conn = new mysqli("localhost", "root", "", "hcpms") or die(mysqli_error());
	$query = $conn->query("SELECT * FROM `user` WHERE `user_id` = '$_SESSION[user_id]'") or die(mysqli_error());
	$fetch = $query->fetch_array();
?>
<html lang = "en">
	<head>	
		<title>Clinincal Diagnosis Expert System</title>
		<meta charset = "UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "images/logo.png" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/customize.css" />
	</head>
	<body>
	<div class = "navbar navbar-default navbar-fixed-top">
		<img src = "images/logo.png" style = "float:left;" height = "55px" /><label class = "navbar-brand">Clinincal Diagnosis Expert System </label>
		<ul class = "nav navbar-right">	
				<li class = "dropdown">
					<a class = "user dropdown-toggle" data-toggle = "dropdown" href = "#">
						<span class = "glyphicon glyphicon-user"></span>
						<?php echo $fetch['firstname']." ".$fetch['lastname'] ?>
						<b class = "caret"></b>
					</a>
				<ul class = "dropdown-menu">
					<li>
						<a class = "me" href = "logout.php"><span class = "glyphicon glyphicon-log-out"></span> Logout</a>
					</li>
				</ul>
				</li>
			</ul>
	</div>
	<br />
	<br />
	<br />
	<div class = "well">
		<div class = "panel panel-warning">
			<div class = "panel-heading">
				<center><label>MATERNITY</label></center>
			</div>
		</div>	
		<div class = "panel panel-success">
			<div class = "panel-heading">
				<label>MATERNITY REQUEST</label>
				<a style = "float:right; margin-top:-4px;" href = "view_maternity.php?itr_no=<?php echo $_GET['itr_no']?>" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
			<div class = "panel-body">
			<?php
				$id = $_GET['itr_no'];
				$q1 = $conn->query("SELECT * FROM `itr` WHERE `itr_no` = '$id'") or die(mysqli_error());
				$f1 = $q1->fetch_array();
				$q = $conn->query("SELECT * FROM `complaints` WHERE `status` = 'Pending' && `section` = 'Maternity' && `itr_no` = '$id'") or die(mysqli_error());
				while($f = $q->fetch_array()){
					echo "<label style = 'color:#3399f3;'>".$f1['firstname']." ".$f1['lastname']."</label>"."<textarea  style = 'resize:none;' disabled = 'disabled' class = 'form-control'>".$f['remark']."</textarea>".$f['date']."<br /><a class = 'btn btn-primary' href = 'birthing.php?itr_no=".$id."&comp_id=".$f['com_id']."'><span class = 'glyphicon glyphicon-check'></span> Confirm</a><br /><br />";
				}	
			?>
		</div>
	</div>
	<div id = "footer">
		<label class = "footer-title">&copy; Clinincal Diagnosis Expert <?=date('Y')?></label>
	</div>
	</body>
		<?php require "script.php" ?>
</html>