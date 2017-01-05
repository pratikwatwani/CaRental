<?php
//start session which will hold the date value
session_start();
error_reporting(0);

require 'connect.php';
 if(isset($_GET['go']))
 {
	 /*using procedure we are implementing search function*/
	 if(is_numeric($_GET['search']))
	 {
		 $query='drop PROCEDURE if EXISTS get_car';
		$result1=mysql_query($query,$db) or die(mysql_error($db));
	 
		$query='create PROCEDURE get_car(IN num int)
				BEGIN
					SELECT * FROM vehicle where fee<=num;
				END';
		$result2=mysql_query($query,$db) or die(mysql_error($db));
	 
	 $query='call get_car(' .$_GET['search']. ')';
	 $result3=mysql_query($query,$db) or die(mysql_error($db));
	 $i=0;
	 echo '<html><head><title>Result</title>
	 <script src="script/product1.js"></script>
	 <link type="text/css" rel="stylesheet" href="./style/product1.css"/>
	 </head><body><table id="result" name="response" border="1">';
	 echo '<tr><th>Index </th><th>Name </th><th> fee  </th><th>Age</th><th>Number</th><th> Images</th><tr>';
	 while($row=mysql_fetch_array($result3))
	 {
		 extract($row);
		 echo '<tr><td>'.++$i . '</td><td><p>'.$name. '</p><p><button name="book" id="event'.$i.'" onclick="message(this)">Hire</button></p></td><td>' . $fee . ' </td><td > ' . $age . '  </td><td id="event'.$i.'reg'.'">' . $regnum . ' </td><td><img src="' . $image .  '" /></td></tr>';
	 }
	 echo '</table>
	 </body></html>';
	 }
	else echo 'Not a Number';
 }
 else if($_GET['offer']>0)
 {
	 $query='drop function if EXISTS get_offer';
	 $result1=mysql_query($query,$db) or die(mysql_error($db));
	 
	 $query='create function get_offer(id int) RETURNS float
		BEGIN
			RETURN(SELECT fee*0.8 from vehicle where vid = id);
		END';
	 $result2=mysql_query($query,$db) or die(mysql_error($db));
	 
	 $query='select name,get_offer(vid) as offer_price,age,regnum,image from vehicle where vid%5=0';
	 $result3=mysql_query($query,$db) or die(mysql_error($db));
	 
	 /*print_r($result1);
	 print_r($result2);
	 print_r($result3);*/
	 $i=0;
	 echo '<html><head><title>Result</title>
	 <script src="script/product1.js"></script>
	 <link type="text/css" rel="stylesheet" href="./style/product1.css"/>
	 </head><body><table name="response" border="1">';
	 echo '<tr><th>Index </th><th>Name </th><th> fee  </th><th>Age</th><th>Number</th><th> Images</th><tr>';
	 while($row=mysql_fetch_array($result3))
	 {
		 extract($row);
		 echo '<tr><td>'.++$i . '</td><td><p>'.$name. '</p><p><button name="book" id="event'.$i.'" onclick="offer(this,'. $i.')">Hire</button></p></td><td id="offer'. $i .'">' . $offer_price . ' </td><td > ' . $age . '  </td><td id="event'.$i.'reg'.'">' . $regnum . ' </td><td><img src="' . $image .  '" /></td></tr>';
	 }
	 echo '</table>
	 </body></html>';
 }
 else if(isset($_GET['submit']))
 {
	$_SESSION['start_date']=$_GET['sdate'];
	$_SESSION['end_date']=$_GET['edate'];
	$query="SELECT v.fee,v.age,v.regnum,v.image,v.name from v_type,vehicle as v where v.type='" . $_GET['type'] . "' AND v.available > 0 AND v_type.tid='" . $_GET['type'] . "'";
	 $result=mysql_query($query,$db) or die(mysql_error($db));
	 $i=0;
	 echo '<html><head><title>Result</title>
	 <script src="script/product1.js"></script>
	 <link type="text/css" rel="stylesheet" href="./style/product1.css"/>
	 </head><body><table name="response" border="1">';
	 echo '<tr><th>Index </th><th>Name </th><th> fee  </th><th>Age</th><th>Number</th><th> Images</th><tr>';
	 while($row=mysql_fetch_array($result))
	 {
		 extract($row);
		 echo '<tr><td>'.++$i . '</td><td><p>'.$name. '</p><p><button name="book" id="event'.$i.'" onclick="message(this)">Hire</button></p></td><td>' . $fee . ' </td><td > ' . $age . '  </td><td id="event'.$i.'reg'.'">' . $regnum . ' </td><td><img src="' . $image .  '" /></td></tr>';
	 }
	 echo '</table>
	 </body></html>';
 }
 else
 {
	
	$query='SELECT * from v_type where tid>0';
	$result=mysql_query($query,$db) or die(mysql_error($db));
	echo '<html><head>
	<title>Type</title><link type="text/css" rel="stylesheet" href="./style/product1.css"/>
	</head>
	<body>
	<form id="query" action="?" method="get">
	<select id="type" name="type" required >
	<option>Select for Car catrgory</option>'; 
	while($row=mysql_fetch_array($result))
	{
		extract($row);
		echo '<option value="'. $tid . '">'. $type . '</option>'; 
	}
	echo '</select><br/>
	<label for="loc">Location : </label><select id="loc" name="loc">
	<option >  Select  </option>
	<option value="mum">Mumbai</option><option value="pune">Pune</option><option value="goa">Goa</option>
	</select>
	<label for="start">Start Date : </label><input type="date" name="sdate" id="start" required/>
	<label for="end">Return Date : </label><input type="date" name="edate" id="end" required/>
	<input type="submit" name="submit" value="search"/></form>
	</body></html>';
 }
?>