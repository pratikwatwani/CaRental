<?php
session_start();

require 'connect.php';
if(isset($_POST['change']))
{
if($_GET['remove']==1)
		{
			    echo  "Old number :".$_GET['old'];
				
				if(!isset($_POST['photo']))
				{
					
					$image=$_SESSION['image'];
				}
				else
				{
					$image=$_POST['photo'];
				}
				$query="UPDATE vehicle
				SET name='" .$_POST['name']. "',age='" .$_POST['age']. "',regnum='" .$_POST['reg']. "',fee='" .$_POST['fee']. "',type='" .$_POST['type']. "'
				WHERE regnum='" .$_GET['old']. "'";
				mysql_query($query,$db) or die('data update error');
				echo '<br>Query processed';
		}
}
if(isset($_POST['submit']))
{
	if($_GET['response']==2)
	{
		$query="DELETE FROM vehicle WHERE regnum='". $_POST['num'] . "'";
		mysql_query($query,$db) or die('Unable to delete');
		echo 'Successfully Removed';
	}
	elseif($_GET['response']==3)
	{
		if($_GET['update']==0)
		{
		echo '<form name="register" action="agentProcess.php?remove=1&old=' .$_POST['num']. '" method="post" enctype="multipart/form-data">
				<p><label  for="type">Type :</label><select name="type" id="type"><option value="">Car catrgory</option>';
								
								$query="select type from vehicle where regnum='". $_POST['num'] . "'";
								$result=mysql_query($query,$db) or die('data fetch error');
								$type=mysql_fetch_array($result);
								
								$query='SELECT * from v_type where tid>0';
								$result=mysql_query($query,$db) or die(mysql_error($db));
	
								while($row=mysql_fetch_array($result))
								{
									extract($row);
									if($type['type']==$tid)
										echo '<option selected value="'. $tid . '">'. $type . '</option>';
									else
										echo '<option value="'. $tid . '">'. $type . '</option>'; 
								}
				$query="select name,fee,age,image from vehicle where regnum='". $_POST['num'] . "'";
				$row=mysql_query($query,$db) or die('data fetch error');
				$result=mysql_fetch_assoc($row);
				$_SESSION['image']=$result['image'];
				echo '</select></p>
				<p><label for="name">Name :</label><input type="text" name="name" id="name" maxlength="60" value="'. $result['name'] .'"/></p>
				<p><label  for="age">Age :</label><input type="number" name="age" id="age" max="10" min="0" value="'.$result['age']. '"/></p>
				<p><label  for="reg">Registration Number :</label><input type="text" name="reg" id="reg" maxlength="11" value="'.$_POST['num'].'"/></p>
				<p><label  for="photo">photo :</label><a href="' .$result['image']. '" target="_blank">click to view pic</a></p>
				<p><label  for="fee">Hourly Rate :</label><input type="number" name="fee" id="fee" min="100" step="100" value="' .$result['fee']. '"/></p>
				<p><input type="reset" name="clear"/>&nbsp;&nbsp;<input type="submit" value="Update" name="change"/></p>
			</form>';
		}
		else
		{
				echo 'error response 3.0';
		}
		
	}
	elseif($_GET['response']==4)
	{
		echo 'welcome<br/>
		<html><head>
		<title>Agent | data | CaRental.com</title>
		</head>
		<body>
		<table border="1">
		<tr><th>Category</th><th>Number of Vehicle</th</tr>
		';
		$query="	SELECT v_type.type,count(vehicle.regnum) as nunber from v_type LEFT JOIN vehicle
						ON v_type.tid=vehicle.type
						GROUP BY v_type.type";
		$result=mysql_query($query,$db) or die('Data Fetch Error');
								while($row=mysql_fetch_array($result))
								{
									extract($row);
										echo '<tr><td>' .$type. '</td><td>' .$count. '</td></tr>'; 
								}
		echo '
		</table>
		</body>
		</html>
		';
		
	}
	else
	{
		echo 'error';
	}
}
?>