<?php
session_start();
require  'connect.php';
$num=$_GET['vehicle'];
$_SESSION['num']=$num;
$query="SELECT name,fee,age FROM vehicle where regnum='".$num."'";
$row=mysql_query($query,$db) or die('data fetch error');
$result=mysql_fetch_assoc($row);

//operation to find date difference
$time1=strtotime($_SESSION['start_date']);
$time2=strtotime($_SESSION['end_date']);
$diff=($time2-$time1)/3600;
$total=$diff*$result['fee'];
if(isset($_GET['offer']))
{
	$diff=48;
	$total=$diff*$_GET['offer'];
}
if($_SESSION['start_date']==$_SESSION['end_date'])
{
	echo 'Please select different date';
	exit();
}
$_SESSION['total']=$total*1.1;
echo '
<html>
<head>
<title>Order | CaRental.com</title>
<script src="script/order.js"></script>
</head>
<body>
<section>
	<article>
		<header>
		<h1>Payment Portal</h1>
		<p>Your satisfaction is our moto</p>
		</header>
		<div>
		<p>Total : <span id="total">'.$total.'</span></p>
		<p>Tax : <span id="tax">' .$total*0.1 .'</span></p>
		<p>Grand Total : <span id="grand">'. $_SESSION['total'] .'</span></p>
		</div>
	</article>
	<article>
		<p>Your order details:</p>
		<p>Name : <span>' . $result['name'] . '</span></p>
		<p>Rate/hr : <span>' . $result['fee'] . '</span></p>
		<p>Age :<span>' . $result['age'] . '</span></p>
		<p>Vehicle Number : <span>' . $num . '</span></p>
	</article>
	<article>
	<form action="booking.php" method="get">
		<input type="submit" name="status" value="book"/>&nbsp;&nbsp;&nbsp;<button onclick="">Cancel</button>
	</form>
	</article>
</section>
</body>
</html>';
$_SESSION['pay']=$total*0.1;
?>